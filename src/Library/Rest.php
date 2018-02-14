<?php

  namespace TreeCanada\Library;

  // use TreeCanada\Models\Review;

  class Rest {


    public function __construct(){

      add_action( 'rest_api_init', array($this,'register_api_hooks') );

    }

    public function register_api_hooks(){
      register_rest_route(
         'treecanada/v1', '/factors',
          array(
           'methods'  => 'POST',
           'callback' => array($this,'get_factor'),
          )
      );
      register_rest_route(
         'treecanada/v1', '/controls',
          array(
           'methods'  => 'POST',
           'callback' => array($this,'use_method'),
          )
      );

    }

    public function get_factor(){
      return "factor";
    }

    public function use_method(){
      $options = get_option( 'treecanada' );
      $trees_needed_factor = (isset($options['trees_needed_factor']))?$options['trees_needed_factor']:10;
      $trees_needed = intval(ceil($_REQUEST['total_tco2'] * $trees_needed_factor));
      return $trees_needed;
    }

  }

 ?>
