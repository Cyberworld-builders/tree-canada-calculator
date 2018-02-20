<?php

  namespace TreeCanada\Library\Post_Types;

  class Factor_Field {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
    }
    public function create_post_type(){
      register_post_type( 'factorfield',
        array(
          'labels' => array(
            'name' => __( 'Factor Fields' ),
            'singular_name' => __( 'Factor Field' )
          ),
          'menu_icon' =>  "dashicons-lightbulb",
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'factorfields'),
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
      register_taxonomy('list-types',array('factorfield'),array(
        'label' =>  "List Types",
        'labels'  =>  array(
          'name'  =>  "List Types",
          'singular_name' =>  "List Type",
        ),
        true,

      ));
    }

    public function add_metaboxes(){
      // add_meta_box(
      //   'factorfield',
      //   'Energytype',
      //   array($this,'meta_factorfield'),
      //   'factorfield',
      //   'normal',
      //   'default'
      // );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['factorfield_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['factorfield'])){
        update_post_meta($post_id,'factorfield',$_POST['factorfield']);
      }
    }

    public function meta_factorfield(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'factorfield_fields' );
      $factorfield = get_post_meta( $post->ID, 'factorfield', true );
      echo '<input type="text" name="factorfield" value="' . esc_textarea( $factorfield )  . '" class="widefat">';
    }

  }

 ?>
