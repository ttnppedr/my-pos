<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CartHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'carthelper'; // same as bind method in service provider
    }
}
