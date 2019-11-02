<?php
/**
 * Created by cuongpm/Modularize.
 * User: vincent
 * Date: 5/26/17
 * Time: 3:33 PM
 */

namespace Modularize\Core\Factories\Http\Repositories;


use Modularize\Core\Components\Http\Repositories\InterfaceComponent;
use Modularize\Core\Factories\_Interface;
use Modularize\Core\Factories\BaseFactory;

class InterfaceFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Http/Repositories/';
    protected $fileName = 'Repository.php';

    public function __construct(InterfaceComponent $component)
    {
        $this->component = $component;
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $this->table = $table;
        $material = $this->component->building($table, $namespace);
        $this->produce($material, $path, false);
    }
}
