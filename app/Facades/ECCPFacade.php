<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ECCP extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'eccp-service';
    }
}
