<?php

  namespace TreeCanada\Library\Post_Types;

  class Air_Class {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'airclass',
        array(
          'labels' => array(
            'name' => __( 'Air Classes' ),
            'singular_name' => __( 'Air Class' )
          ),
          'menu_icon' =>  "dashicons-lightbulb",
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'airclasss'),
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
      //   'airclass',
      //   'Energytype',
      //   array($this,'meta_airclass'),
      //   'airclass',
      //   'normal',
      //   'default'
      // );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['airclass_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['airclass'])){
        update_post_meta($post_id,'airclass',$_POST['airclass']);
      }
    }

    public function meta_airclass(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'airclass_fields' );
      $airclass = get_post_meta( $post->ID, 'airclass', true );
      echo '<input type="text" name="airclass" value="' . esc_textarea( $airclass )  . '" class="widefat">';
    }

  }

 ?>
