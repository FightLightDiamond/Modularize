<?php
/**
 * Created by cuongpm/Modularize.
 * User: vincent
 * Date: 5/25/17
 * Time: 4:02 PM
 */

namespace Modularize\Core\Components\Http\Repositories;


use Modularize\Core\Components\BaseComponent;

class RepositoryComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    public function building($table, $namespace)
    {
        $this->buildNameSpace($namespace);
        $this->buildClassName($table);
        $this->buildVariable($table);
        return $this->source;
    }

    private function getSource()
    {
        return $this->getRepositoryPath('/repository.txt');
    }
}
