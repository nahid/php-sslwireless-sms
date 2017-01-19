<?php

namespace Nahid\SslWSms\Facades;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Sms';
    }
}
