<?php
namespace App\Services;

require_once '../vendor/welltime/phpagi/src/phpagi-asmanager.php';

use AGI_AsteriskManager as as_manager;

class AsteriskAmiService
{

    public static function asterisk_ami()
    {
        $managerHost = config('asterisk.manager.host');
        $managerUser = config('asterisk.manager.user');
        $managerPass = config('asterisk.manager.password');

        $remote = new as_manager();
        $remote->connect($managerHost, $managerUser, $managerPass);
        return $remote;
    }
}
