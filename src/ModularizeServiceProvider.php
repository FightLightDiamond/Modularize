<?php

namespace Modularize;

use Modularize\Console\Commands\Modules\ProjectModuleCommand;
use Modularize\Console\Commands\Modules\ModelModuleCommand;
use Modularize\Console\Commands\Modules\RepositoryModuleCommand;
use Modularize\Console\Commands\Modules\RequestModuleCommand;
use Modularize\Console\Commands\Modules\ServiceModuleCommand;
use Modularize\Console\Commands\Tables\TableName;
use Modularize\Console\Commands\ConstDBCommand;
use Modularize\Console\Commands\Files\FileChange;
use Modularize\Console\Commands\Files\FileRemove;
use Modularize\Console\Commands\Files\FileRename;
use Modularize\Console\Commands\RenderRoute;
use Modularize\Console\Commands\Tables\TableColumn;
use Modularize\Console\Commands\Tables\TableData;
use Modularize\Console\Commands\Modules\TestModuleCommand;
use Modularize\Console\Commands\TransDBCommand;
use Modularize\Http\Facades\DBFun;
use Modularize\Http\Facades\FileFun;
use Modularize\Http\Facades\FormatFun;
use Modularize\Http\Facades\InputFun;

use Illuminate\Support\ServiceProvider;
use Prettus\Repository\Providers\LumenRepositoryServiceProvider;
use Uploader\Facades\UploadFun;
use Uploader\Providers\UploadServiceProvider;

class ModularizeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mod');

        $this->publishes([
            __DIR__ . '/../config/modularize.php' => base_path('config/modularize.php'),
        ], 'modularize');

        $this->mergeConfigFrom(__DIR__ . '/../config/modularize.php', 'modularize');

        if ($this->app->runningInConsole()) {
            $this->commands([
                ConstDBCommand::class,
                FileRemove::class,
                FileChange::class,
                TableColumn::class,
                TableData::class,
                TableName::class,
                RenderRoute::class,
                FileRename::class,
                TransDBCommand::class,

                ModelModuleCommand::class,
                ProjectModuleCommand::class,
                RepositoryModuleCommand::class,
                RequestModuleCommand::class,
                ServiceModuleCommand::class,
                TestModuleCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('DBFa', DBFun::class);
        $this->app->bind('FileFa', FileFun::class);
        $this->app->bind('FormatFa', FormatFun::class);
        $this->app->bind('InputFa', InputFun::class);

        $this->app->register(LumenRepositoryServiceProvider::class);
        $this->app->bind('UploadFa', UploadFun::class);
        $this->app->register(UploadServiceProvider::class);
    }
}
