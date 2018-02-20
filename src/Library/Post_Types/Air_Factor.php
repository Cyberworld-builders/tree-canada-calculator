<?php

  namespace TreeCanada\Library\Post_Types;

  class Air_Factor {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'airfactor',
        array(
          'labels' => array(
            'name' => __( 'Air Factors' ),
            'singular_name' => __( 'Air Factor' )
          ),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'airfactors'),
          'supports' => array(
        		'title',
        		'thumbnail',
        		'revisions',
            'page-attributes'
          ),
          'show_in_rest'  =>  true,
          'map_meta_cap'  =>  true,
          'capabililty_type'  =>  'post',
          'hierarchical'  =>  true,
          // 'register_meta_box_cb'  =>  array($this,'add_metaboxes')
        )
      );
    }

    public function add_metaboxes(){
      add_meta_box(
        'airfactor',
        'Air Factor',
        array($this,'meta_airfactor'),
        'airfactor',
        'normal',
        'default'
      );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['airfactor_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['airfactor'])){
        update_post_meta($post_id,'airfactor',$_POST['airfactor']);
      }
    }

    public function meta_airfactor(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'airfactor_fields' );
      $airfactor = get_post_meta( $post->ID, 'airfactor', true );
      echo '<input type="text" name="airfactor" value="' . esc_textarea( $airfactor )  . '" class="widefat">';
    }

  }

 ?>
