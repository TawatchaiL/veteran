<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\AsteriskAmiService;
use App\Services\ECCP;
use App\Services\ECCPUnauthorizedException;
use App\Services\ECCPConnFailedException;

use App\Models\User;
use Exception;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $remote;
    protected $eccp;
    protected $_agent;
    protected $errMsg;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AsteriskAmiService $asteriskAmiService) // Inject AsteriskAmiService
    {
        $this->middleware('guest')->except('logout');
        $this->remote = $asteriskAmiService; // Initialize $remote
        $this->eccp = new ECCP();
    }
    /*  protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        // Add the 'phone' field to the credentials array
        $credentials['phone'] = $request->phone;

        return Auth::attempt($credentials, $request->filled('remember'));
    } */

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'phone' => 'required|string|max:255', // เพิ่มบรรทัดนี้
        ], [
            $this->username() . '.required' => 'กรุณากรอก' . $this->username(),
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'phone.required' => 'กรุณากรอกหมายเลขโทรศัพท์', // เพิ่มบรรทัดนี้
        ]);
    }

    public function logoff_to_login_phone_error($message)
    {
        auth()->logout();
        return redirect()->route('login')
            ->with('login_error', $message)
            ->withErrors(['phone' => $message]);
    }


    public function _obtenerConexion()
    {
        //if (!is_null($this->eccp)) return $this->eccp;
        $sUsernameECCP = 'agentconsole';
        $sPasswordECCP = 'agentconsole';
        $cr = $this->eccp->connect("10.148.0.4", $sUsernameECCP, $sPasswordECCP);
        if (isset($cr->failure)) {
            throw new ECCPUnauthorizedException('Failed to authenticate to ECCP') . ': ' . ((string)$cr->failure->message);
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
        $this->eccp->setAgentPass($tupla[0]);

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

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            // Update the user's phone if provided
            if ($request->has('phone')) {
                $user = Auth::user();
                $user->phone = $request->phone;

                //check phone status
                $phone_state_num = $this->remote->exten_state($user->phone);
                if ($phone_state_num == 4 || $phone_state_num == -1) {
                    $this->logoff_to_login_phone_error('หมายเลขโทรศัพท์ไม่พร้อมใช้งาน');
                }

                //check in use
                $inuseCount = User::where('phone', $user->phone)
                    ->where('agent_id', '!=', $user->id)
                    ->count();

                if ($inuseCount > 0) {
                    $this->logoff_to_login_phone_error('หมายเลขโทรศัพท์ถูกใช้งานแล้ว');
                } /* else {
                    //check login again with same phone and same agent
                    if ($agent_data['extension'] == $phone) {
                        $not_logout = $this->Agent_model->get_state_not_logout($phone, $agent_data['id_agent']);
                        if ($not_logout) {
                            $this->clear_login(
                                $not_logout['login_datetime'],
                                $not_logout['id_agent'],
                                $not_logout['enable_inbound'],
                                $not_logout['queues_inbound'],
                                $not_logout['extension'],
                                $remote_context,
                                $not_logout['audit_login_id']
                            );
                        }
                    } else {
                        //check not logout same agent not same phone
                        $not_logout = $this->Agent_model->get_agent_not_logout($agent_data['id_agent']);
                        if ($not_logout) {
                            $this->clear_login(
                                $not_logout['login_datetime'],
                                $not_logout['id_agent'],
                                $not_logout['enable_inbound'],
                                $not_logout['queues_inbound'],
                                $not_logout['extension'],
                                $remote_context,
                                $not_logout['audit_login_id']
                            );
                        }
                    }
                }*/
                $this->_agent = 'SIP/' . $user->phone;
                $sNumero = $this->_agent;
                $iTimeoutMin = 15;
                try {
                    $oECCP = $this->_obtenerConexion();
                    $loginResponse = $oECCP->loginagent(9999, NULL, $iTimeoutMin * 60);
                    if (isset($loginResponse->failure))
                        $this->errMsg = '(internal) loginagent: ' . $this->_formatoErrorECCP($loginResponse);
                    return ($loginResponse->status == 'logged-in' || $loginResponse->status == 'logging');
                } catch (Exception $e) {
                    $this->errMsg = '(internal) loginagent: ' . $e->getMessage();
                    return FALSE;
                }
                //$ll = $this->esperarResultadoLogin();

                dd($loginResponse);


                $queueNames = $user->queues->pluck('queue_name')->implode(',');
                $user->queue = $queueNames;
                $user->save();
                //session(['temporary_phone' => Auth::user()->phone]);

                /* $this->remote->QueuePause('4567', "SIP/9999", 'false', '');
                $this->remote->QueueRemove('4567', "SIP/9999");
                $this->remote->QueueAdd('4567', "SIP/9999", 0, "Agent1", "hint:9999@ext-local");
                $this->remote->QueuePause('4567', "SIP/9999", 'true', 'Toilet'); */
                //$this->remote->queue_log_in($queueNames, $request->phone);

            }

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    public function logout(Request $request)
    {
        // Clear the temporary phone from the session
        //$request->session()->forget('temporary_phone');

        // Update the user's phone to an empty value
        $user = Auth::user();
        $this->remote->queue_log_off($user->queue, $user->phone);
        $user->phone = '';
        $user->save();

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function showLoginForm()
    {
        $temporaryPhone = session('temporary_phone'); // Retrieve the value from the session
        return view('auth.login', compact('temporaryPhone'));
    }
}
