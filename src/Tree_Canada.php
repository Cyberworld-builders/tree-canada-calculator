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
use TreeCanada\Library\Post_Types\Factor_Field as Factor_Field;

use TreeCanada\Library\Post_Types\Energy_Factor as Energy_Factor;
use TreeCanada\Library\Post_Types\Air_Factor as Air_Factor;
use TreeCanada\Library\Post_Types\Road_Factor as Road_Factor;
use TreeCanada\Library\Post_Types\Other_Factor as Other_Factor;



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

    new Calculator;

    new Factor;
    // new Factor_Field;

    // new Energy_Factor;
    // new Air_Factor;
    // new Road_Factor;
    // new Other_Factor;

    new Energy_Type;
    new Province;
    new Air_Class;
    new Road_Class;
    new Fuel_Type;
    new Transport_Type;


    new Acf;

	}

}
