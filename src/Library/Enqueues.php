<?php

  namespace TreeCanada\Library;

  class Enqueues {


    public function __construct(){

      $this->register_scripts();
      //enqueue default scripts
      $this->enqueue_default_scripts();
      //localize standard php variables
      $this->localize_js_vars();

      $this->register_styles();


    }




    public function register_scripts(){
      wp_register_script( 'treecanada-scripts-js',  TREE_CANADA_URL . 'js/scripts.js', array('jquery'));
      wp_register_script( 'treecanada-carbon-calculator-js',  TREE_CANADA_URL . 'js/carbon-calculator.js', array('jquery','treecanada-scripts-js'));

    }

    public function enqueue_default_scripts(){
      wp_enqueue_script( 'treecanada-scripts-js' );
    }

    public function localize_js_vars(){
      wp_localize_script( 'treecanada-scripts-js', 'site_vars', array(
        'url'=>site_url(),
        'plugin_url'=> TREE_CANADA_URL
      ) );
    }

    public function register_styles(){
      wp_register_style('treecanada-carbon-calculator-css', TREE_CANADA_URL . 'css/styles.css');
    }


  }


 ?>
