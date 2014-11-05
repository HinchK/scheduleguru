<?php namespace ScheduleGuru\Providers;

use Illuminate\Support\ServiceProvider;

class GOAuthServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('google/apiclient');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
	    // Register 'oauth'
		    $this->app['oauth'] = $this->app->share(function($app)
		    {
                // create oAuth instance
                	$oauth = new OAuth();
        		// return oAuth instance
		        	return $oauth;
		    });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}