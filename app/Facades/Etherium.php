<?php

namespace App\Facades;

use App\Etherium\EtheriumProvider;
use Illuminate\Support\Facades\Facade;

class Etherium extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return EtheriumProvider::class;
    }
}
