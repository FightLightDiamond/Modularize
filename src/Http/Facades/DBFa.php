<?php

/**
 * Created by cuongpm/modularize.
 * User: vincent
 * Date: 4/26/17
 * Time: 8:47 AM
 */

namespace Modularize\Http\Facades;

use Illuminate\Support\Facades\Facade;

class DBFa extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'DBFa';
    }
}
