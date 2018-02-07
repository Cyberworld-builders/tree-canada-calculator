<?php

  namespace MyPlugin\Library;

  class Enqueues {


    public function __construct(){

      $this->register_scripts();
      //enqueue default scripts
      $this->enqueue_default_scripts();
      //localize standard php variables
      $this->localize_js_vars();


    }




    public function register_scripts(){
      wp_register_script( 'myplugin-scripts-js',  MY_PLUGIN_URL . 'js/scripts.js', array('jquery'));
    }

    public function enqueue_default_scripts(){
      wp_enqueue_script( 'myplugin-scripts-js' );
    }

    public function localize_js_vars(){
      wp_localize_script( 'myplugin-scripts-js', 'site_vars', array(
        'url'=>site_url(),
        'plugin_url'=> MY_PLUGIN_URL
      ) );
    }


  }


 ?>
