<?php

  namespace TreeCanada\Library;

  class Enqueues {

    // register all of your enqueues here. that way you can manage them all in one place and enqueue them with a simple handle.
    // if you need to change the dependencies or order do it right here
    // you can also enqueue by default but be careful. you don't want to have to go back and undo your enqueues that's just messy.


    public function __construct(){

      $this->register_scripts();
      //enqueue default scripts
      $this->enqueue_default_scripts();
      //localize standard php variables
      $this->localize_js_vars();

      $this->register_styles();

      $this->enqueue_default_styles();


    }




    public function register_scripts(){
      wp_register_script('treecanada-bootstrap-js', TREE_CANADA_URL . 'bootstrap/js/bootstrap.min.js',array('jquery'));
      wp_register_script( 'treecanada-scripts-js',  TREE_CANADA_URL . 'js/scripts.js', array('jquery'));
      wp_register_script( 'treecanada-carbon-calculator-js',  TREE_CANADA_URL . 'js/carbon-calculator.js', array('jquery','treecanada-scripts-js'));
      wp_register_script( 'fontawesome-js',  TREE_CANADA_URL . 'js/fontawesome-all.js');
      // wp_register_script( 'fontawesome-js',  TREE_CANADA_URL . 'js/fontawesome-all.js');

    }

    public function enqueue_default_scripts(){
      wp_enqueue_script('treecanada-bootstrap-js');
      wp_enqueue_script( 'treecanada-scripts-js' );
      wp_enqueue_script( 'fontawesome-js' );

    }

    public function localize_js_vars(){
      wp_localize_script( 'treecanada-scripts-js', 'site_vars', array(
        'url'=>site_url(),
        'plugin_url'=> TREE_CANADA_URL
      ) );
    }

    public function register_styles(){
      wp_register_style('treecanada-bootstrap-css', TREE_CANADA_URL . 'bootstrap/css/bootstrap.min.css');
      wp_register_style('treecanada-carbon-calculator-css', TREE_CANADA_URL . 'css/styles.css');
      wp_register_style('treecanada-main-css', TREE_CANADA_URL . 'css/main.css');
      wp_register_style('fontawesome-css', TREE_CANADA_URL . 'css/fa-svg-with-js.css');
      // wp_register_style('fontawesome-css', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css");

    }

    public function enqueue_default_styles(){
      wp_enqueue_style('treecanada-bootstrap-css');
      wp_enqueue_style('treecanada-main-css');
      wp_enqueue_style('fontawesome-css');

    }

  }


 ?>
