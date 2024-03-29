<?php
/**
 * Created by cuongpm/modularize.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 1/19/18
 * Time: 5:29 PM
 */

namespace Modularize\Core\Components\Http\ViewComposers;

use Modularize\Core\Components\BaseComponent;

class ViewComposerComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    private function getSource()
    {
        return $this->getViewPath( '/form/update.html');
    }
}
