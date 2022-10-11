<?php

namespace Vicoders\Input\Facades;

use Illuminate\Support\Facades\Facade;
use Vicoders\Input\Manager;

class ContactFormManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ContactFormManager';
    }
}
