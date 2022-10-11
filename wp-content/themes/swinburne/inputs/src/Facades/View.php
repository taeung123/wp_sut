<?php

namespace Vicoders\Input\Facades;

use Illuminate\Support\Facades\Facade;

class View extends Facade
{
	
    protected static function getFacadeAccessor()
    {
        return new \Vicoders\Input\Services\View;
    }
}
