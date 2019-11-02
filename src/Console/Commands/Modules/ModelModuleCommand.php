<?php

namespace Modularize\Console\Commands\Modules;

use Illuminate\Console\Command;
use Modularize\Core\Factories\Models\ModelFactory;
use Modularize\Http\Facades\DBFa;
use Modularize\src\Helpers\BuildInput;

class ModelModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:model {table?} {--namespace=App\}  {--path=app/}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $modelFactory;

    public function __construct(ModelFactory $modelFactory)
    {
        parent::__construct();

        $this->modelFactory = $modelFactory;
    }

    public function handle()
    {
        $table = $this->argument('table') ?? '*';
        $namespace = $this->option('namespace') . "\\";
        $path = $this->option('path');

        if ($table === '*') {
            $tables = DBFa::table($dbName = NULL);
        } else {
            $tables = [$table];
        }

        foreach ($tables as $table) {
            $this->modelFactory->building($table, $namespace, $path);
        }
    }
}
