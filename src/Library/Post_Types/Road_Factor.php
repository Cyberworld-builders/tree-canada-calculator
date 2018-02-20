<?php

  namespace TreeCanada\Library\Post_Types;

  class Road_Factor {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'roadfactor',
        array(
          'labels' => array(
            'name' => __( 'Road Factors' ),
            'singular_name' => __( 'Road Factor' )
          ),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'roadfactors'),
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
        'roadfactor',
        'Road Factor',
        array($this,'meta_roadfactor'),
        'roadfactor',
        'normal',
        'default'
      );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['roadfactor_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['roadfactor'])){
        update_post_meta($post_id,'roadfactor',$_POST['roadfactor']);
      }
    }

    public function meta_roadfactor(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'roadfactor_fields' );
      $roadfactor = get_post_meta( $post->ID, 'roadfactor', true );
      echo '<input type="text" name="roadfactor" value="' . esc_textarea( $roadfactor )  . '" class="widefat">';
    }

  }

 ?>
