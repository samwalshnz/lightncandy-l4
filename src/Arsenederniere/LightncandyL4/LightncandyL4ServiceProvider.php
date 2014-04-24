<?php namespace Arsenederniere\LightncandyL4;

use Illuminate\Support\ServiceProvider;

class LightncandyL4ServiceProvider extends ServiceProvider {

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
        $this->package('arsenederniere/lightncandy-l4');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->extend('view.engine.resolver', function($resolver, $app)
        {
            $resolver->register('lightncandy', function() use($app)
            {
                return $app->make('Arsenederniere\LightncandyL4\LightncandyEngine');
            });
            return $resolver;
        });

        $app->extend('view', function($env, $app)
        {
            $config = $app['config']->get('lightncandy-l4::config');
            foreach ($config['fileext'] as $fileext)
            {
                $fileext = trim($fileext, '.');
                $env->addExtension($fileext, 'lightncandy');
            }
            
            return $env;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('lightncandy-l4');
    }

}
