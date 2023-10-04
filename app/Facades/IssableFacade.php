<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class IssableFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'issable-service'; // This should match the name you register in the service container.
    }
}
