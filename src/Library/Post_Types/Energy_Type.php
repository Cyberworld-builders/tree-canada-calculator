<?php

  namespace TreeCanada\Library\Post_Types;

  class Energy_Type {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'energytype',
        array(
          'labels' => array(
            'name' => __( 'Energytypes' ),
            'singular_name' => __( 'Energytype' )
          ),
          'menu_icon' =>  "dashicons-lightbulb",
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'energytypes'),
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
      //   'energytype',
      //   'Energytype',
      //   array($this,'meta_energytype'),
      //   'energytype',
      //   'normal',
      //   'default'
      // );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['energytype_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['energytype'])){
        update_post_meta($post_id,'energytype',$_POST['energytype']);
      }
    }

    public function meta_energytype(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'energytype_fields' );
      $energytype = get_post_meta( $post->ID, 'energytype', true );
      echo '<input type="text" name="energytype" value="' . esc_textarea( $energytype )  . '" class="widefat">';
    }

  }

 ?>
