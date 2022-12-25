<?php

namespace Queents\ConsoleHelpers;

use Illuminate\Support\ServiceProvider;

class ConsoleHelpersServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/console-helpers.php', 'console-helpers');

        //Publish Config file
        $this->publishes([
            __DIR__ . '/../config/console-helpers.php' => config_path('console-helpers.php'),
        ], 'config');
    }

    public function boot()
    {
        //
    }
}
