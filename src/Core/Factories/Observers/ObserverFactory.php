<?php
/**
 * Created by cuongpm/Modularize.
 * User: vincent
 * Date: 4/30/17
 * Time: 12:56 AM
 */

namespace Modularize\Core\Factories\Observers;


use Illuminate\Support\Str;
use Modularize\Core\Components\Observers\ObserverComponent;
use Modularize\Core\Factories\_Interface;

class ObserverFactory implements _Interface
{
    private $component;

    public function __construct(ObserverComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    private function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Observers'))) {
            mkdir(base_path($path . '\Observers'));
        }
        return base_path($path . '/Observers/' . ucfirst(Str::singular($table)) . 'Observer.php');
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $material = $this->component->building($table, $namespace);
        $this->produce($table, $material, $path);
    }
}
