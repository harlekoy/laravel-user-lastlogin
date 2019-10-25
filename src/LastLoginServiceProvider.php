<?php

namespace Harlekoy\LastLogin;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LastLoginServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Filesystem $filesystem)
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/lastlogin.php' => config_path('lastlogin.php'),
            ], 'lastlogin.config');

            $this->publishes([
                __DIR__.'/../database/migrations/create_logins_tables.php.stub' => $this->getMigrationFileName($filesystem),
            ], 'lastlogin.migrations');


            $this->loadViewsFrom(__DIR__.'/../resources/views', 'lastlogin');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/lastlogin'),
            ], 'views');

        }

        $this->loadViewsFrom(
            __DIR__.'/../resources/views', 'lastlogin'
        );

        $this->registerRoutes();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lastlogin.php', 'lastlogin');
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem): string
    {
        $timestamp = date('Y_m_d_His');
        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path.'*_create_logins_tables.php');
            })->push($this->app->databasePath()."/migrations/{$timestamp}_create_logins_tables.php")
            ->first();
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'domain'     => config('lastlogin.domain', null),
            'namespace'  => 'Harlekoy\LastLogin\Http\Controllers',
            'prefix'     => config('lastlogin.path'),
            'middleware' => 'web',
        ];
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }
}
