<?php

return array(

    // LightnCandy options
    'basedir' => array(
        base_path().'/app/views'
    ),
    'fileext' => array(
        '.lightncandy',
        '.tmpl',
        '.handlebars',
        '.tpl'
    ),

    'cache' => FALSE,
    'cachePath' => storage_path() . '/views',
    // Default flag is FLAG_BESTPERFORMANCE
    //'flags' => LightnCandy::FLAG_BESTPERFORMANCE,

    // The class prefix for compiled templates.
    // Defaults to ''
    'template_class_prefix' => '__LightnCandy_',
);
