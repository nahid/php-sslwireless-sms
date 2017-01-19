<?php

namespace Nahid\SslWSms;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class SslWSmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->setupConfig();
    }
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerSslWSms();
    }
    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/sslwsms.php');
        // Check if the application is a Laravel OR Lumen instance to properly merge the configuration file.
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('sslwsms.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('sslwsms');
        }
        $this->mergeConfigFrom($source, 'sslwsms');
    }
    /**
     * Register Talk class.
     */
    protected function registerSslWSms()
    {
        $this->app->singleton('sslwsms', function (Container $app) {
            return new Sms($app['config']->get('sslwsms'));
        });
        $this->app->alias('sslwsms', Sms::class);
    }
    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            Sms::class,
        ];
    }
}
