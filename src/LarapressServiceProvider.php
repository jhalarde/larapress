<?php

namespace Jhalarde\Larapress;

use Illuminate\Support\ServiceProvider;

class LarapressServiceProvider extends ServiceProvider
{
	/**
	 * @var string
	 */
	public $configPath = __DIR__.'/../config/larapress.php';
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
	    $this->mergeConfigFrom(
		    realpath($this->configPath), 'larapress'
	    );
	    $this->app->bind('larapress', function () {
	    	return new Larapress;
	    });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->publishes([
		    realpath($this->configPath) => config_path('larapress.php'),
	    ], 'larapress-config');

	    if (config('larapress.enable_routing')) {
		    $this->loadRoutesFrom(__DIR__.'/routes.php');
	    }

	    $this->loadViewsFrom(__DIR__.'/../resources/views', 'larapress');

	    $this->publishes([
		    __DIR__.'/../resources/views' => resource_path('views/vendor/larapress'),
	    ], 'larapress-views');
    }
}
