<?php
/**
 * Created by cuongpm/modularize.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 1/19/18
 * Time: 5:34 PM
 */

namespace Modularize\Core\Factories\ViewComposers;


use Modularize\Core\Components\Http\ViewComposers\ViewComposerComponent;

class ViewComposerFactory
{
    protected $component;

    public function __construct(ViewComposerComponent $component)
    {
        $this->component = $component;
    }
}
