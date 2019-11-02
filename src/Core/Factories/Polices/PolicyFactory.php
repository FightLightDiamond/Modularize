<?php
/**
 * Created by cuongpm/Modularize.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:35 PM
 */

namespace Modularize\Core\Factories\Polices;

use Modularize\Core\Components\Policies\PolicyComponent;
use Modularize\Core\Factories\_Interface;
use Modularize\Core\Factories\BaseFactory;
use Modularize\Http\Facades\FormatFa;

class PolicyFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Policies/';
    protected $fileName = 'Policy.php';

    public function __construct(PolicyComponent $component)
    {
        $this->component = $component;
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $this->table = $table;
        $material = $this->component->building($table, $namespace);
        $this->produce($material, $path);
    }
}
