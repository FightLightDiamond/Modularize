<?php
/**
 * Created by cuongpm/modularize.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:25 AM
 */

namespace Modularize\Core\Components\Models;

use Modularize\Core\Components\BaseComponent;
use Modularize\Http\Facades\DBFa;
use Modularize\Helpers\DecoHelper;

class ModelComponent extends BaseComponent
{
    private function getSource()
    {
        return $this->getModelPath('/model.txt');
    }

    private function buildFillAble($table)
    {
        $fillable = DBFa::produceFillable($table);
        $this->working(DecoHelper::FILL_ABLE, $fillable);
    }

    private function buildTableName($table)
    {
        $this->working(DecoHelper::TABLE, $table);
    }

    private function buildFilter($table)
    {
        $fields = DBFa::getFillable($table);

        $filter = '';

        foreach ($fields as $field) {
            $filter .= "if(isset(\$input['{$field}'])) {
                \$query->where('{$field}', \$input['{$field}']); 
                }\n";
        }

        $this->working(DecoHelper::FILTER, $filter);
    }

    public function building($table, $namespace)
    {

        $this->source = file_get_contents($this->getSource());

        $this->buildNameSpace($namespace);
        $this->buildFillAble($table);
        $this->buildClassName($table);
        $this->buildTableName($table);
        $this->buildFilter($table);

        return $this->source;
    }
}
