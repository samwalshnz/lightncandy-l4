<?php
namespace ArseneDerniere\LightnCandyL4;

use Illuminate\View\Engines\EngineInterface;
use Illuminate\Filesystem\Filesystem;
use LightnCandy;

class LightnCandyEngine implements EngineInterface {

	public function __construct(Filesystem $files)
	{
		$this->files = $files;
	}
	
	public function get($path, array $data = array())
	{
		$view = $this->files->get($path);
		$app = app();
		$m = new LightnCandy( $app['config']->get('lightncandy-l4::config') );
 
 		$data = array_map(function($item){
			return (is_object($item) && method_exists($item, 'toArray')) ? $item->toArray() : $item;
		}, $data);
 
		return $m->render($view, $data);
	}

}
