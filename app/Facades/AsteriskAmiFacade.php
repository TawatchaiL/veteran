<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AsteriskAmiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'asterisk_ami-service';
    }
}
