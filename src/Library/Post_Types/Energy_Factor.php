<?php

  namespace TreeCanada\Library\Post_Types;

  class Energy_Factor {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'energyfactor',
        array(
          'labels' => array(
            'name' => __( 'Energy Factors' ),
            'singular_name' => __( 'Energy Factor' )
          ),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'energyfactors'),
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
        'energyfactor',
        'Energy Factor',
        array($this,'meta_energyfactor'),
        'energyfactor',
        'normal',
        'default'
      );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['energyfactor_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['energyfactor'])){
        update_post_meta($post_id,'energyfactor',$_POST['energyfactor']);
      }
    }

    public function meta_energyfactor(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'energyfactor_fields' );
      $energyfactor = get_post_meta( $post->ID, 'energyfactor', true );
      echo '<input type="text" name="energyfactor" value="' . esc_textarea( $energyfactor )  . '" class="widefat">';
    }

  }

 ?>
