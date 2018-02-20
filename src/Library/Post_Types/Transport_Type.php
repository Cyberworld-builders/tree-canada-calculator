<?php

  namespace TreeCanada\Library\Post_Types;

  class Transport_Type {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'transporttype',
        array(
          'labels' => array(
            'name' => __( 'Transport Types' ),
            'singular_name' => __( 'Transport Type' )
          ),
          'menu_icon' =>  "dashicons-lightbulb",
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'transporttypes'),
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
      //   'transporttype',
      //   'Energytype',
      //   array($this,'meta_transporttype'),
      //   'transporttype',
      //   'normal',
      //   'default'
      // );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['transporttype_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['transporttype'])){
        update_post_meta($post_id,'transporttype',$_POST['transporttype']);
      }
    }

    public function meta_transporttype(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'transporttype_fields' );
      $transporttype = get_post_meta( $post->ID, 'transporttype', true );
      echo '<input type="text" name="transporttype" value="' . esc_textarea( $transporttype )  . '" class="widefat">';
    }

  }

 ?>
