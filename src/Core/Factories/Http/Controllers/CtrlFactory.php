<?php
/**
 * Created by cuongpm/Modularize.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:34 PM
 */

namespace Modularize\Core\Factories\Http\Controllers;

use Modularize\Core\Components\Http\Controllers\CtrlComponent;
use Modularize\Core\Factories\_Interface;
use Modularize\Core\Factories\BaseFactory;
use Modularize\Http\Facades\FormatFa;

class CtrlFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Http/Controllers/API';
    protected $fileName = 'APIController.php';

    public function __construct(CtrlComponent $component)
    {
        $this->component = $component;
    }

    public function building($input)
    {
        $this->table = $input['table'];
        $material = $this->component->building($input);
        $this->produce($material, $input['path']);
    }
}
