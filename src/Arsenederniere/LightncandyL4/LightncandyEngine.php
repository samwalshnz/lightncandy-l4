<?php
namespace ArseneDerniere\LightnCandyL4;

use Illuminate\View\Engines\EngineInterface;
use Illuminate\Filesystem\Filesystem;
use LightnCandy;
use File;

class LightnCandyEngine implements EngineInterface {

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $app = app();
        $this->config = $app['config']->get('lightncandy-l4::config');
        if(!isset($this->config['template_class_prefix']))
        {
            $this->config['template_class_prefix'] = '';
        }
    }
    
    public function getCompiledPath($path)
    {
        return $this->config['cachePath'].'/'.$this->config['template_class_prefix'].md5($path);
    }

    public function isExpired($path)
    {
        // If the compiled file doesn't exist we will indicate that the view is expired
        // so that it can be re-compiled. Else, we will verify the last modification
        // of the views is less than the modification times of the compiled views.
        if ( ! $this->files->exists($this->compiledPath))
        {
            return true;
        }

        $lastModified = $this->files->lastModified($path);

        return $lastModified >= $this->files->lastModified($this->compiledPath);
    }

    public function get($path, array $data = array())
    {
        $view = $this->files->get($path);
        $m = new LightnCandy();

        $data = array_map(function($item){
            return (is_object($item) && method_exists($item, 'toArray')) ? $item->toArray() : $item;
        }, $data);

        $this->compiledPath = $this->getCompiledPath($path);
        if( !$this->config['cache'] || $this->isExpired($path) )
        {
            $phpStr = $m->compile($view, $this->config);
            file_put_contents($this->compiledPath, $phpStr);
        }

        $renderer = include($this->compiledPath);
        return $renderer($data);
    }

}