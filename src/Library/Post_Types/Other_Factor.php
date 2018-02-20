<?php

  namespace TreeCanada\Library\Post_Types;

  class Other_Factor {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'otherfactor',
        array(
          'labels' => array(
            'name' => __( 'Other Factors' ),
            'singular_name' => __( 'Other Factor' )
          ),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'otherfactors'),
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
        'otherfactor',
        'Other Factor',
        array($this,'meta_otherfactor'),
        'otherfactor',
        'normal',
        'default'
      );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['otherfactor_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['otherfactor'])){
        update_post_meta($post_id,'otherfactor',$_POST['otherfactor']);
      }
    }

    public function meta_otherfactor(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'otherfactor_fields' );
      $otherfactor = get_post_meta( $post->ID, 'otherfactor', true );
      echo '<input type="text" name="otherfactor" value="' . esc_textarea( $otherfactor )  . '" class="widefat">';
    }

  }

 ?>
