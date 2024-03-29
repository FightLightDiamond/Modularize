<?php
/**
 * Created by cuongpm/modularize.
 * User: vincent
 * Date: 5/26/17
 * Time: 3:33 PM
 */

namespace Modularize\Core\Components\Http\Repositories;


use Modularize\Core\Components\BaseComponent;

class InterfaceComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    public function building($table, $namespace)
    {
        $this->buildNameSpace($namespace);
        $this->buildClassName($table);
        return $this->source;
    }

    private function getSource()
    {
        return $this->getRepositoryPath( '/interfaceRepo.txt');
    }
}
