<?php
/**
 * Created by cuongpm/Modularize.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:13 AM
 */

namespace Modularize\Core\Components\Models;


use Modularize\Core\Components\BaseComponent;
use Modularize\Http\Facades\DBFa;
use Modularize\Helpers\DecoHelper;

class MutatorComponent extends BaseComponent
{
    protected $mutator;

    public function buildMutator($field)
    {
        foreach ($field as $column) {
            $this->mutator .= $this->mutator($column);
        }
        return $this->mutator;
    }

    private function mutator($column)
    {
        $content = file_get_contents($this->getSource());
        $content = str_replace(DecoHelper::COLUMN, studly_case($column), $content);
        return str_replace(DecoHelper::NAME, ($column), $content);
    }

    public function building($table, $namespace = 'App\\')
    {
        $field = DBFa::getField($table);
        return $this->buildMutator($field);
    }

    private function getSource()
    {
        return $this->getViewPath('/models/mutator.txt');
    }
}
