<?php
/**
 * Created by cuongpm/Modularize.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/4/2016
 * Time: 4:55 PM
 */

namespace Modularize\Interfaces;

interface FactoryInterface
{
    public function produce($table, $material);

    public function building($table);
}
