<?php

namespace App\Services;

require_once '../vendor/welltime/phpagi/src/phpagi-asmanager.php';

use AGI_AsteriskManager as as_manager;

class AsteriskAmiService
{
    protected $managerHost;
    protected $managerUser;
    protected $managerPass;
    protected $remoteContext;

    public function __construct()
    {
        $this->managerHost = config('asterisk.manager.host');
        $this->managerUser = config('asterisk.manager.user');
        $this->managerPass = config('asterisk.manager.password');
        $this->remoteContext = config('asterisk.manager.remote_context');
        // Initialize $managerHost
    }

    public function asterisk_ami()
    {
        $remote = new as_manager();
        $remote->connect($this->managerHost, $this->managerUser, $this->managerPass);

        return $remote;
    }

    function dialplan_reload()
    {
        $remote = $this->asterisk_ami();
        $remote->Command('dialplan reload');
    }

    function exten_state($remote_extension)
    {
        $remote = $this->asterisk_ami();

        if ($remote) {
            $foo[$remote_extension]  = $remote->ExtensionState($remote_extension, $this->remoteContext, '');
            //dd($foo[$remote_extension]);

            switch ($foo[$remote_extension]['Status']) {
                case -1:
                    $phone_state_num = -1;
                    break;
                case 0:
                    $phone_state_num = 0;
                    break;
                case 1:
                    $phone_state_num = 1;
                    break;
                case 2:
                    $phone_state_num = 2;
                    break;
                case 4:
                    $phone_state_num = 4;
                    break;
                case 8:
                    $phone_state_num = 8;
                    break;
                case 9:
                    $phone_state_num = 9;
                    break;
                case 16:
                    $phone_state_num = 16;
                    break;
                default:
                    $phone_state_num = -1;
            }

            $remote->disconnect();

            return $phone_state_num;
        } else {
            echo "Can not connect to remote AGI";
            exit();
        }
    }


    public function queue_log_in($queues, $remote_extension)
    {
        $remote = $this->asterisk_ami();
        $queue = explode(",", $queues);
        foreach ($queue as $qval) {
            $remote->QueueAdd($qval, "SIP/$remote_extension", 0, $remote_extension, "hint:$remote_extension@$this->remoteContext");
            $remote->QueuePause($qval, "SIP/$remote_extension", 'false', '');
        }

        $remote->disconnect();
    }

    public function queue_log_off($queues, $remote_extension)
    {
        $remote = $this->asterisk_ami();
        $queue = explode(",", $queues);
        foreach ($queue as $qval) {
            $remote->QueuePause($qval, "SIP/$remote_extension", 'false', '');
            $remote->QueueRemove($qval, "SIP/$remote_extension");
        }

        $remote->disconnect();
    }
}
