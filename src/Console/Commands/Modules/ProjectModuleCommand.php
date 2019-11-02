<?php

namespace Modularize\Console\Commands\Modules;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modularize\Core\Components\Http\Controllers\APICtrlComponent;
use Modularize\Core\Factories\Http\Controllers\AdminCtrlFactory;
use Modularize\Core\Factories\Http\Controllers\APICtrlFactory;
use Modularize\Core\Factories\Http\Repositories\InterfaceFactory;
use Modularize\Core\Factories\Http\Repositories\RepositoryFactory;
use Modularize\Core\Factories\Http\Requests\RequestFactory;
use Modularize\Core\Factories\Http\Resources\ResourceFactory;
use Modularize\Core\Factories\Http\Services\ServiceFactory;
use Modularize\Core\Factories\Models\ModelFactory;
use Modularize\Core\Factories\Polices\PolicyFactory;
use Modularize\Core\Factories\Routers\RouteAPIFactory;
use Modularize\Core\Factories\Routers\RouterFactory;
use Modularize\Http\Facades\DBFa;
use Modularize\src\Core\Factories\Tests\Feature\FeatureTestFactory;
use Modularize\src\Helpers\BuildInput;

class ProjectModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:project {table?} {--namespace=App}  {--path=app} {--seed=no}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $routeMsg = '';
    private $routeAPIMsg = '';
    private $routeAdminMsg = '';
    private $repositoryMsg = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function getBlackTable()
    {
        return config('modularize.black_tables');
    }

    protected $table, $tables, $namespace, $path, $seed;

    private function input()
    {
        $table = $this->argument('table') ?? '*';
        $this->tables = $this->getTables($table);

        $namespace = $this->option('namespace');
        $namespace = rtrim($namespace, "\\");
        $namespace .= "\\";
        $this->namespace = $namespace;

        $this->path = $this->option('path');
        $this->seed = $this->option('seed');

        $this->info("Table: {$table} ");
        $this->info("Namespace: {$namespace} ");
        $this->info("Path: {$this->path} ");
        $this->info("Seed: {$this->seed} ");
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->input();

        $bar = $this->output->createProgressBar(count($this->tables) * 2);
        $bar->start();

        foreach ($this->tables as $table) {
            if (in_array($table, $this->getBlackTable())) {
                continue;
            }

            $input = $this->fix($table);
//            app(RouteAPIFactory::class)->building($namespace, $path);
//            app(RouterFactory::class)->building($namespace, $path);

            $this->HTTP($input, $table);
            $this->MRP($table);
            $this->admin($input);

            $input = $this->fixTestInput($input);

            app(FeatureTestFactory::class)->building($input);

            $class = BuildInput::classe($table);
            $bar->advance(2);

            if($this->seed === 'yes') {
                $this->runSeed($class);
            }

            $this->buildMessage($table);
        }

        $bar->finish();
        $this->msg();
    }

    private function fixTestInput($input)
    {
        if ($input['path'] === 'app') {
            $input['path'] = '';
        }

        return $input;
    }

    private function getTables($table)
    {
        if ($table === '*') {
            $tables = DBFa::table();
        } else {
            $tables = [$table];
        }

        return $tables;
    }

    private function msg()
    {
        $this->info('');
        $this->line('Please copy to app/routes/api.php');
        $this->info($this->routeAPIMsg);
        $this->line('Please copy to app/routes/admin.php');
        $this->info($this->routeAdminMsg);
        $this->line('Please copy to app/Provider/AppServiceProvider.php at function register()');
        $this->info($this->repositoryMsg);
    }

    private function HTTP($input, $table)
    {
        app(APICtrlFactory::class)->building($input);
        app(ResourceFactory::class)->building($input);
        app(RequestFactory::class)->building($table, $this->namespace, $this->path);
        app(ServiceFactory::class)->building($input);
    }

    private function MRP($table)
    {
        app(RepositoryFactory::class)->building($table, $this->namespace, $this->path);
        app(InterfaceFactory::class)->building($table, $this->namespace, $this->path);
        app(PolicyFactory::class)->building($table, $this->namespace, $this->path);
        app(ModelFactory::class)->building($table, $this->namespace, $this->path);
    }

    private function runSeed($class)
    {
        Artisan::call("make:seeder {$class}Seeder");
        Artisan::call("make:factory {$class}Factory --model={$class}");
    }

    private function admin($input)
    {
        $table = $input['table'];
        $namespace = $input['namespace'];
        $path = $input['path'];

        app(AdminCtrlFactory::class)->building($input);
        app(ServiceFactory::class)
            ->setAuth('Admin')
            ->building($input);

        app(RequestFactory::class)
            ->setAuth('Admin')
            ->building($table, $namespace, $path);

        app(ResourceFactory::class)
            ->setAuth('Admin')
            ->building($input);

        $input = $this->fixTestInput($input);

        app(FeatureTestFactory::class)
            ->setAuth('Admin')
            ->building($input);
    }

    private function fix($table)
    {
        $input['path'] = $this->path;
        $input['table'] = $table;
        $input['prefix'] = '';
        $input['namespace'] = $this->namespace;
        $input['route'] = BuildInput::route($table);
//        $input['viewFolder'] = Str::kebab(Str::camel(Str::singular($table)));

        return $input;
    }

    private function buildMessage($table)
    {
        $name = BuildInput::classe($table);
        $route = BuildInput::route($table);

        $this->routeAdminMsg .= "Route::get('{$route}' , '{$name}AdminController@index'); \n";
        $this->routeAdminMsg .= "Route::post('{$route}' , '{$name}AdminController@store'); \n";
        $this->routeAdminMsg .= "Route::get('{$route}/{id}' , '{$name}AdminController@show'); \n";
        $this->routeAdminMsg .= "Route::put('{$route}/{id}' , '{$name}AdminController@update'); \n";
        $this->routeAdminMsg .= "Route::patch('{$route}/{id}' , '{$name}AdminController@update'); \n";
        $this->routeAdminMsg .= "Route::delete('{$route}/{id}' , '{$name}AdminController@destroy'); \n";
        $this->routeAdminMsg .= "\n";
        $this->routeAPIMsg .= "Route::get('{$route}' , '{$name}APIController@index'); \n";
        $this->routeAPIMsg .= "Route::post('{$route}' , '{$name}APIController@store'); \n";
        $this->routeAPIMsg .= "Route::get('{$route}/{id}' , '{$name}APIController@show'); \n";
        $this->routeAPIMsg .= "Route::put('{$route}/{id}' , '{$name}APIController@update'); \n";
        $this->routeAPIMsg .= "Route::patch('{$route}/{id}' , '{$name}APIController@update'); \n";
        $this->routeAPIMsg .= "Route::delete('{$route}/{id}' , '{$name}APIController@destroy'); \n";
        $this->routeAPIMsg .= "\n";

        $this->repositoryMsg .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";
    }
}
