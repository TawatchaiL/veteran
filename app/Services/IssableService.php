<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Services\ECCP;
use App\Services\ECCPUnauthorizedException;
use App\Services\ECCPConnFailedException;
use Exception;


class IssableService
{
    protected $remote;
    protected $eccp;
    protected $_agent;
    protected $_user;
    protected $errMsg;
    protected $_agentPass;
    protected $eccp_host;
    protected $sUsernameECCP;
    protected $sPasswordECCP;


    private function _formatoErrorECCP($x)
    {
        if (isset($x->failure)) {
            return (int)$x->failure->code . ' - ' . (string)$x->failure->message;
        } else {
            return '';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() // Inject AsteriskAmiService
    {
        $this->eccp = new ECCP();

        $this->eccp_host = config('asterisk.eccp.eccp_host');
        $this->sUsernameECCP = config('asterisk.eccp.eccp_user');
        $this->sPasswordECCP = config('asterisk.eccp.eccp_password');
        $this->_user = Auth::user();
    }

    public function _obtenerConexion()
    {
        //if (!is_null($this->eccp)) return $this->eccp;
        /*
        $cr = $this->eccp->connect($eccp_host, $sUsernameECCP, $sPasswordECCP); */
        //$sUsernameECCP = 'agentconsole';
        //$sPasswordECCP = 'agentconsole';
        $cr = $this->eccp->connect($this->eccp_host, $this->sUsernameECCP, $this->sPasswordECCP);
        if (isset($cr->failure)) {
            throw new ECCPUnauthorizedException('Failed to authenticate to ECCP')
                . ': ' . ((string)$cr->failure->message);
        }

        if (!is_null($this->_agent)) {
            $this->eccp->setAgentNumber($this->_agent);
        }

        $tupla = DB::connection('remote_connection')
            ->table('call_center.agent')
            ->select('eccp_password')
            ->whereRaw("CONCAT(type, '/', number) = ?", [$this->_agent])
            ->where('estatus', 'A')
            ->get();

        if (!is_object($tupla))
            throw new ECCPConnFailedException('Failed to retrieve agent password');
        if (count($tupla) <= 0)
            throw new ECCPUnauthorizedException('Agent not found');
        if (is_null($tupla[0]->eccp_password))
            throw new ECCPUnauthorizedException('Agent not authorized for ECCP - ECCP password not set');
        $this->eccp->setAgentPass($tupla[0]->eccp_password);

        return $this->eccp;
    }

    public function esperarResultadoLogin()
    {
        $this->errMsg = '';
        try {
            $oECCP = $this->_obtenerConexion();
            $oECCP->wait_response(1);
            while ($e = $oECCP->getEvent()) {
                foreach ($e->children() as $ee) $evt = $ee;

                if ($evt->getName() == 'agentloggedin' && $evt->agent == $this->_agent)
                    return 'logged-in';
                if ($evt->getName() == 'agentfailedlogin' && $evt->agent == $this->_agent)
                    return 'logged-out';
                // TODO: devolver mismatch si logoneo con éxito a consola equivocada.
            }
            return 'logging';   // No se recibieron eventos relevantes
        } catch (Exception $e) {
            $this->errMsg = '(internal) esperarResultadoLogin: ' . $e->getMessage();
            return 'error';
        }
    }


    public function transfer($phone, $sTransferExt)
    {
        $this->errMsg = '';
        $this->_agent = 'SIP/' . $phone;
        $trannum = $sTransferExt;
        try {
            $oECCP = $this->_obtenerConexion('ECCP');
            $respuesta = $oECCP->transfercall($trannum);
            if (isset($respuesta->failure)) {
                $this->errMsg = 'Unable to transfer call' . ' - ' . $this->_formatoErrorECCP($respuesta);
                return FALSE;
            }
            return TRUE;
        } catch (Exception $e) {
            $this->errMsg = '(internal) transfercall: ' . $e->getMessage();
            return FALSE;
        }
    }

    public function atx_transfer($phone, $sTransferExt)
    {
        $this->errMsg = '';
        $this->_agent = 'SIP/' . $phone;
        $trannum = $sTransferExt;
        try {
            $oECCP = $this->_obtenerConexion('ECCP');
            $respuesta = $oECCP->atxfercall($trannum);
            if (isset($respuesta->failure)) {
                $this->errMsg = 'Unable to transfer call' . ' - ' . $this->_formatoErrorECCP($respuesta);
                return FALSE;
            }
            return TRUE;
        } catch (Exception $e) {
            $this->errMsg = '(internal) transfercall: ' . $e->getMessage();
            return FALSE;
        }
    }


    public function agent_login($phone)
    {
        $this->_agent = 'SIP/' . $phone;
        $regs = NULL;
        $sExtension = (preg_match('|^(\w+)/(\d+)$|', $this->_agent, $regs)) ? $regs[2] : NULL;
        //$sPasswordCallback = '1234';
        //$this->_agentPass = $sPasswordCallback;
        $iTimeoutMin = 15;
        try {
            $oECCP = $this->_obtenerConexion();
            $loginResponse = $oECCP->loginagent($sExtension, NULL, $iTimeoutMin * 60);
            if (isset($loginResponse->failure))
                $this->errMsg = '(internal) loginagent: ' . $this->_formatoErrorECCP($loginResponse);
            //return ($loginResponse->status == 'logged-in' || $loginResponse->status == 'logging');
            return TRUE;
        } catch (Exception $e) {
            $this->errMsg = '(internal) loginagent: ' . $e->getMessage();
            return FALSE;
        }
    }

    public function agent_logoff($phone)
    {
        $this->_agent = 'SIP/' . $phone;
        //fix
        try {
            $oECCP = $this->_obtenerConexion();
            $response = $oECCP->logoutagent();

            if (isset($response) && isset($response->failure)) {
                $this->errMsg = '(internal) logoutagent: ' . $this->_formatoErrorECCP($response);
                return FALSE;
            }

            return TRUE;
        } catch (Exception $e) {
            $this->errMsg = '(internal) logoutagent: ' . $e->getMessage();
            return FALSE;
        }
    }

    public function agent_break($phone, $idBreak)
    {
        $this->_agent = 'SIP/' . $phone;
        $id = (int) $idBreak;
        try {
            $oECCP = $this->_obtenerConexion('ECCP');
            $respuesta = $oECCP->pauseagent($id);
            if (isset($respuesta->failure)) {
                $this->errMsg = 'Unable to start break' . ' - ' . $this->_formatoErrorECCP($respuesta);
                return FALSE;
            }
            return TRUE;
        } catch (Exception $e) {
            $this->errMsg = '(internal) pauseagent: ' . $e->getMessage();
            return FALSE;
        }
    }

    public function agent_unbreak($phone)
    {
        $this->_agent = 'SIP/' . $phone;
        try {
            $oECCP = $this->_obtenerConexion('ECCP');
            $respuesta = $oECCP->unpauseagent();
            if (isset($respuesta->failure)) {
                $this->errMsg = 'Unable to stop break' . ' - ' . $this->_formatoErrorECCP($respuesta);
                return FALSE;
            }
            return TRUE;
        } catch (Exception $e) {
            $this->errMsg = '(internal) unpauseagent: ' . $e->getMessage();
            return FALSE;
        }
    }
}
