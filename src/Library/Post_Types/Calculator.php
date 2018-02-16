<?php

  namespace TreeCanada\Library\Post_Types;

  class Calculator {
    public function __construct(){
      add_action( 'init', array($this,'create_post_type') );
      add_action( 'save_post', array($this,'save_meta'), 1, 2 );
      // add_action( 'init', array($this, 'create_province_taxonomy') );
    }

    public function create_province_taxonomy(){
      register_taxonomy(
    		'province',
    		'calculator',
    		array(
    			'label' => __( 'Provinces' ),
    		)
    	);
    }

    public function create_post_type(){
      register_post_type( 'calculator',
        array(
          'labels' => array(
            'name' => __( 'Calculators' ),
            'singular_name' => __( 'Calculator' )
          ),
          'menu_icon' =>  "dashicons-analytics",
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'calculators'),
          'supports' => array(
        		'title',
        		// 'thumbnail',
        		// 'revisions',
            // 'page-attributes'
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
      //   'calculator',
      //   'Calculator',
      //   array($this,'meta_calculator'),
      //   'calculator',
      //   'normal',
      //   'default'
      // );
    }

    public function save_meta($post_id,$post){
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
    		return $post_id;
    	}
      if ( ! wp_verify_nonce( $_POST['calculator_fields'], basename(__FILE__) ) ) {
    		return $post_id;
    	}
      if(isset($_POST['calculator'])){
        update_post_meta($post_id,'calculator',$_POST['calculator']);
      }
    }

    public function meta_calculator(){
      global $post;
      wp_nonce_field( basename( __FILE__ ), 'calculator_fields' );
      $calculator = get_post_meta( $post->ID, 'calculator', true );
      echo '<input type="text" name="calculator" value="' . esc_textarea( $calculator )  . '" class="widefat">';
    }

  }

 ?>
