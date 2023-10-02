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
