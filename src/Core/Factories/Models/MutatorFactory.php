<?php
/**
 * Created by cuongpm/modularize.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:24 AM
 */

namespace Modularize\Core\Factories\Models;

use Modularize\Core\Components\Models\MutatorComponent;
use Modularize\Core\Factories\_Interface;
use Modularize\Http\Facades\FormatFa;

class MutatorFactory implements _Interface
{
    protected $component, $packet;

    public function __construct(MutatorComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Models'))) {
            mkdir(base_path($path . '\Models'));
        }
        return base_path($path . '/Models/' . FormatFa::formatAppName($table) . 'Mutator.php');
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $material = $this->component->building($table, $namespace);
        $this->produce($table, $material);
    }
}
