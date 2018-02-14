<?php

  namespace TreeCanada\Library\Post_Types;

  class Factor {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'factor',
        array(
          'labels' => array(
            'name' => __( 'Factors' ),
            'singular_name' => __( 'Factor' )
          ),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'factors'),
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
          'register_meta_box_cb'  =>  array($this,'add_metaboxes')
        )
      );
    }

    public function add_metaboxes(){
      add_meta_box(
        'factor',
        'Factor',
        array($this,'meta_factor'),
        'factor',
        'normal',
        'default'
      );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['factor_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['factor'])){
        update_post_meta($post_id,'factor',$_POST['factor']);
      }
    }

    public function meta_factor(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'factor_fields' );
      $factor = get_post_meta( $post->ID, 'factor', true );
      echo '<input type="text" name="factor" value="' . esc_textarea( $factor )  . '" class="widefat">';
    }

  }

 ?>
