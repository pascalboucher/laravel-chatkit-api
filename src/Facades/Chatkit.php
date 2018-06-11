<?php

namespace Chess\Chatkit\Facades;

use Illuminate\Support\Facades\Facade;

class Chatkit extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'chatkit';
    }
}