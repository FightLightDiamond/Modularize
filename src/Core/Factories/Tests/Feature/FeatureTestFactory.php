<?php
/**
 * Created by cuongpm/modularize.
 * Date: 8/3/19
 * Time: 3:26 PM
 */

namespace Modularize\src\Core\Factories\Tests\Feature;


use Modularize\Core\Factories\BaseFactory;
use Modularize\src\Core\Components\Tests\Feature\FeatureTestComponent;

class FeatureTestFactory extends BaseFactory
{
    protected $component;
    protected $auth = 'API';
    protected $sortPath = 'tests/Feature/';
    protected $fileName = 'Test.php';

    public function __construct(FeatureTestComponent $component)
    {
        $this->component = $component;
    }

    public function building($input)
    {
        $this->table = $input['table'];
        $path = $input['path'];

        $material = $this->component->building($input, $this->auth);
        $this->produce($material, $path);
    }
}
