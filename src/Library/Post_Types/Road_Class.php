<?php

  namespace TreeCanada\Library\Post_Types;

  class Road_Class {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'roadclass',
        array(
          'labels' => array(
            'name' => __( 'Road Classes' ),
            'singular_name' => __( 'Road Class' )
          ),
          'menu_icon' =>  "dashicons-lightbulb",
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'roadclasss'),
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
      //   'roadclass',
      //   'Energytype',
      //   array($this,'meta_roadclass'),
      //   'roadclass',
      //   'normal',
      //   'default'
      // );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['roadclass_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['roadclass'])){
        update_post_meta($post_id,'roadclass',$_POST['roadclass']);
      }
    }

    public function meta_roadclass(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'roadclass_fields' );
      $roadclass = get_post_meta( $post->ID, 'roadclass', true );
      echo '<input type="text" name="roadclass" value="' . esc_textarea( $roadclass )  . '" class="widefat">';
    }

  }

 ?>
