<?php
/**
 * Created by cuongpm/Modularize.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:25 AM
 */

namespace Modularize\Core\Factories\Models;

use Modularize\Core\Components\Models\ModelComponent;
use Modularize\Core\Factories\BaseFactory;
use Modularize\Http\Facades\FormatFa;

class ModelFactory extends BaseFactory
{
    protected $component;
    protected $sortPath = 'Models/';
    protected $fileName = '.php';

    public function __construct(ModelComponent $component)
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
