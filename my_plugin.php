<?php

/**
 * Plugin Name: My Custom Plugin
 * Plugin URI: ''
 * Description: My custom plugin.
 * Version: 0.1
 * Author: Jay Long
 * Author URI:
 * Text Domain:
 * Domain Path:
 *
 * Copyright 2017
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

define('MY_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('MY_PLUGIN_FILE',  'my_plugin.php');
define('MY_PLUGIN_DEV_MODE', true);

// require_once MY_PLUGIN_PATH . 'vendor/autoload.php';

spl_autoload_register( 'my_plugin' );

function my_plugin($class) {

    $prefix = "MyPlugin\\";
    $base_dir = __DIR__ . '/src/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

new MyPlugin\My_Plugin;
