<?php

  namespace TreeCanada\Library\Post_Types;

  class Fuel_Type {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'fueltype',
        array(
          'labels' => array(
            'name' => __( 'Fuel Types' ),
            'singular_name' => __( 'Fuel Type' )
          ),
          'menu_icon' =>  "dashicons-lightbulb",
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'fueltypes'),
          'supports' => array(
        		'title',
        		'thumbnail',
        		// 'revisions',
            'page-attributes'
          ),
          'show_in_rest'  =>  true,
          'map_meta_cap'  =>  true,
          'capabililty_type'  =>  'post',
          'hierarchical'  =>  true,
          'register_meta_box_cb'  =>  array($this,'add_metaboxes')
        )
      );
    }

    public function add_metaboxes(){
      // add_meta_box(
      //   'fueltype',
      //   'Energytype',
      //   array($this,'meta_fueltype'),
      //   'fueltype',
      //   'normal',
      //   'default'
      // );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['fueltype_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['fueltype'])){
        update_post_meta($post_id,'fueltype',$_POST['fueltype']);
      }
    }

    public function meta_fueltype(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'fueltype_fields' );
      $fueltype = get_post_meta( $post->ID, 'fueltype', true );
      echo '<input type="text" name="fueltype" value="' . esc_textarea( $fueltype )  . '" class="widefat">';
    }

  }

 ?>
