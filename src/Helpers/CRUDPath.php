<?php
/**
 * Created by cuongpm/modularize.
 * User: vincent
 * Date: 4/13/17
 * Time: 5:21 PM
 */

namespace Modularize\Helpers;

use Modularize\src\Helpers\BuildInput;

class CRUDPath
{
    static function viewPath()
    {
        return dirname(__DIR__) . ('/views');
    }

    static function inConstant()
    {
        return (static::viewPath() . '/const/DBConst.txt');
    }

    static function outConstant($table, $path = 'app')
    {
        return base_path('Constants/' . $table . 'db.php');
    }

    /**
     * Design patent
     */
    static function inObserver()
    {
        return (static::viewPath() . '/design_patent/observer.txt');
    }

    static function outObServer($table, $path = 'app')
    {
        return base_path($path . '/Observers/' . BuildInput::classe($table) . 'Observer.php');
    }
}
