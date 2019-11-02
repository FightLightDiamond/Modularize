<?php
/**
 * Created by cuongpm/Modularize.
 * User: CPM
 * Date: 7/23/2018
 * Time: 8:46 PM
 */

namespace Modularize\Core\Factories;


use Modularize\Core\Components\ServiceProviderComponent;

class ServiceProviderFactory
{
    protected $component;
    private $namespace, $path, $material;

    public function __construct(ServiceProviderComponent $component)
    {
        $this->component = $component;
    }

    private function produce()
    {
        $fileForm = fopen($this->outFile(), "w");
        fwrite($fileForm, $this->material);
    }

    public function building($namespace = 'App\\', $path = 'app', $prefix = '')
    {
        if (!is_dir(base_path($path))) {
            try {
                mkdir(base_path($path));
            } catch (\Exception $exception) {
                Log::debug(base_path($path));
            }
        }

        $this->namespace = $namespace;
        $this->path = $path;

        if (!file_exists($this->outFile())) {
            $this->material = $this->component->building($namespace, $prefix);
            $this->produce();
        }
    }

    private function outFile()
    {
        return base_path($this->path . '/' . $this->namespace . 'ServiceProvider.php');
    }
}
