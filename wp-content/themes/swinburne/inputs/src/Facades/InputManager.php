<?php

namespace Vicoders\Input\Facades;

use Illuminate\Support\Facades\Facade;
use Vicoders\Input\Manager;

class InputManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new Manager;
    }
}
