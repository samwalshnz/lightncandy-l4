laravel4-lightncandy
====================

A lightncandy ("A PHP library to support almost all features of handlebars" by zordius) wrapper for Laravel 4.

# Install
Add lightncandy-l4 as a dependency to your `composer.json` file

```json
"require": {
    "laravel/framework": "4.0.*",
    "arsenederniere/lightncandy-l4": "dev-master"
}
```
    
run `composer update`, or `composer install` if this is a brand new project
    
Add the Service Provider

app/config/app.php

```php
...

'Arsenederniere\LightncandyL4\LightncandyL4ServiceProvider',
    
...
```

# Configure

You can alter the configuration options that are passed to lightncandy.php by publishing the config file.
    
    php artisan config:publish arsenederniere/lightncandy-l4
    
The "flags" option is passed to lightncandy's compile method, you may use any "FLAG_" constant used by [lightncandy](https://github.com/zordius/lightncandy).
