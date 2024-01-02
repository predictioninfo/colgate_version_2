<?php

namespace Aizhar777\NumToWord\Facades;

use Illuminate\Support\Facades\Facade;

class NumberToWordsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'NumbersToWords';
    }
}