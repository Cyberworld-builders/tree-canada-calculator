<?php

// all of the code in this plugin is encapsulated into classes. the fundamental classes that are used in the plugin core are instantiated automatically in this file.

namespace TreeCanada;

use TreeCanada\Library\Settings;
use TreeCanada\Library\Enqueues;
use TreeCanada\Library\Utilities;
use TreeCanada\Library\Shortcodes;
use TreeCanada\Library\Rest;

use TreeCanada\Library\Dependencies\Acf;

use TreeCanada\Library\Post_Types\Calculator as Calculator;
use TreeCanada\Library\Post_Types\Factor as Factor;
use TreeCanada\Library\Post_Types\Energy_Type as Energy_Type;
use TreeCanada\Library\Post_Types\Province as Province;
use TreeCanada\Library\Post_Types\Air_Class as Air_Class;
use TreeCanada\Library\Post_Types\Road_Class as Road_Class;
use TreeCanada\Library\Post_Types\Fuel_Type as Fuel_Type;
use TreeCanada\Library\Post_Types\Transport_Type as Transport_Type;

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
    new Utilities;
    new Shortcodes;
    new Rest;

    new Acf;

    new Calculator;
    new Factor;
    new Energy_Type;
    new Province;
    new Air_Class;
    new Road_Class;
    new Fuel_Type;
    new Transport_Type;   

	}

}
