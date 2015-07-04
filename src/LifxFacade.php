<?php

namespace Kz\Lifx;

use Illuminate\Support\Facades\Facade;

class LifxFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Lifx';
    }
}