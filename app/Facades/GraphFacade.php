<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class GraphFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'graph-service'; // This should match the name you register in the service container.
    }
}
