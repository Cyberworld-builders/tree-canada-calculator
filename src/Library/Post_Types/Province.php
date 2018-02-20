<?php

  namespace TreeCanada\Library\Post_Types;

  class Province {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'province',
        array(
          'labels' => array(
            'name' => __( 'Provinces' ),
            'singular_name' => __( 'Province' )
          ),
          'menu_icon' =>  "dashicons-lightbulb",
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'provinces'),
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
      //   'province',
      //   'Energytype',
      //   array($this,'meta_province'),
      //   'province',
      //   'normal',
      //   'default'
      // );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['province_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['province'])){
        update_post_meta($post_id,'province',$_POST['province']);
      }
    }

    public function meta_province(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'province_fields' );
      $province = get_post_meta( $post->ID, 'province', true );
      echo '<input type="text" name="province" value="' . esc_textarea( $province )  . '" class="widefat">';
    }

  }

 ?>
