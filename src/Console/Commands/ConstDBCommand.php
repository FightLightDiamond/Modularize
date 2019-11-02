<?php
/**
 * Created by cuongpm/modularize.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 1/31/18
 * Time: 9:17 AM
 */

namespace Modularize\Console\Commands;


use Illuminate\Console\Command;
use Modularize\Core\Factories\Constants\ConstantFactory;

class ConstDBCommand extends Command
{
    protected $signature = 'render:const';
    private $factory;

    public function __construct(ConstantFactory $factory)
    {
        parent::__construct();
        $this->factory = $factory;
    }

    public function handle()
    {
        $this->factory->building(NULL);
    }
}
