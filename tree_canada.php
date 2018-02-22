<?php

/**
 * Plugin Name: Tree Canada Custom Plugin
 * Plugin URI: ''
 * Description: Custom plugin for Tree Canada. Creates a calculator for tree to carbon ratios.
 * Version: 2.0.1
 * Author: Jay Long
 * Author URI:
 * Text Domain:
 * Domain Path:
 * GitHub Plugin URI: https://github.com/Cyberworld-builders/tree-canada-calculator
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

define('TREE_CANADA_URL', plugin_dir_url( __FILE__ ));
define('TREE_CANADA_PATH', plugin_dir_path( __FILE__ ));
define('TREE_CANADA_FILE',  'tree_canada.php');
define('TREE_CANADA_DEV_MODE', true);

// this statement is commented because we are not yet using composer packages
// require_once TREE_CANADA_PATH . 'vendor/autoload.php';

// this is a class bases plugin that autoloads all of the core plugin code which we place into objects. the main plugin class is defined in src/Tree_Canada.php
// all of the plugin classes are autoloaded in the following function.

spl_autoload_register( 'tree_canada' );

function tree_canada($class) {
    $prefix = "TreeCanada\\";
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

// this instantiates the main plugin class.
new TreeCanada\Tree_Canada;
