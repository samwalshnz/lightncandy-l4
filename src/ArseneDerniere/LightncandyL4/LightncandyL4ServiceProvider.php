<?php namespace ArseneDerniere\LightnCandyL4;

use Illuminate\Support\ServiceProvider;

class LightnCandyL4ServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('arseneDerniere/lightncandy-l4');

		$app = $this->app;

		$app->extend('view.engine.resolver', function($resolver, $app)
		{
			$resolver->register('lightncandy', function() use($app)
			{
				return $app->make('ArseneDerniere\LightnCandyL4\LightnCandyEngine');
			});
			return $resolver;
		});

		$app->extend('view', function($env, $app)
		{
			$env->addExtension('lightncandy', 'lightncandy');
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