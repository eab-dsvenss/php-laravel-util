<?php

namespace se\eab\php\laravel\util\provider;

use Illuminate\Support\ServiceProvider;

class EabUtilServiceProvider extends ServiceProvider
{

    const CONFIG_FILENAME = "eab-utilconfig";
    
    private $basepath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->basepath . "config" . DIRECTORY_SEPARATOR . EabUtilServiceProvider::CONFIG_FILENAME . ".php" => config_path(EabUtilServiceProvider::CONFIG_FILENAME . '.php')
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
