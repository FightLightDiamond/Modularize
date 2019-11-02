<?php
/**
 * Created by cuongpm/Modularize.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:59 PM
 */

namespace Modularize\Core\Factories\Http\Repositories;

use Modularize\Core\Components\Http\Repositories\RepositoryComponent;
use Modularize\Core\Factories\_Interface;
use Modularize\Core\Factories\BaseFactory;

class RepositoryFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Http/Repositories/';
    protected $fileName = 'RepositoryEloquent.php';

    public function __construct(RepositoryComponent $component)
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
