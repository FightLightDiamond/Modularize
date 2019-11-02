<?php
/**
 * Created by cuongpm/modularize.
 * User: CPM
 * Date: 7/23/2018
 * Time: 9:01 PM
 */

namespace Modularize\Core\Components;

class RouterComponent extends BaseComponent
{
    public function building($namespace)
    {
        $this->source = file_get_contents( $this->getRouterPath( '/web.txt'));
        $this->buildNameSpace($namespace);
        return $this->source;
    }
}
