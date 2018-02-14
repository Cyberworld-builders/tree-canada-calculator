<?php

// all of the code in this plugin is encapsulated into classes. the fundamental classes that are used in the plugin core are instantiated automatically in this file.

namespace TreeCanada;

use TreeCanada\Library\Settings;
use TreeCanada\Library\Enqueues;
use TreeCanada\Library\Shortcodes;
use TreeCanada\Library\Rest;


use TreeCanada\Library\Post_Types\Factor as Factor;

class Tree_Canada {

  public function __construct(){
		register_activation_hook( TREE_CANADA_PATH.'/'.TREE_CANADA_FILE, array($this, 'plugin_activated'));
    register_deactivation_hook( TREE_CANADA__PATH.'/'.TREE_CANADA_FILE, array($this, 'plugin_deactivated'));
    $this->_init();
	}

	public function plugin_activated(){

	}

	public function plugin_deactivated(){

	}

	protected function _init(){
    new Settings;
    new Enqueues;
    new Shortcodes;
    new Rest;
    new Factor;
	}

}
