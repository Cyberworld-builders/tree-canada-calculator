<?php

  namespace TreeCanada\Library\Dependencies;

  class Acf {
    public function __construct(){

      // including acf in our plugin as a dependency
      add_filter('acf/settings/path', array($this,'my_acf_settings_path'));
      add_filter('acf/settings/dir', array($this,'my_acf_settings_dir'));
      add_filter('acf/settings/show_admin', array($this,'__return_false'));
      include_once( TREE_CANADA_PATH . '/acf/acf.php' );

      // customizations to acf
      // add_filter('acf/load_field/name=color', array($this,'acf_load_color_field_choices'));

      $this->addDefaultFields();

    }

    public function addDefaultFields(){
      if(function_exists("register_field_group"))
      {
      	register_field_group(array (
      		'id' => 'acf_carbon-calculator',
      		'title' => 'Carbon Calculator',
      		'fields' => array (
      			array (
      				'key' => 'field_5a874ea8d412e',
      				'label' => 'Instructions',
      				'name' => 'instructions',
      				'type' => 'wysiwyg',
      				'instructions' => 'This is the paragraph below the heading and above the actual calculator. The old calculator used this to provide some basic instructions and you can too. Or leave it blank and it will show nothing.',
      				'default_value' => '',
      				'toolbar' => 'full',
      				'media_upload' => 'yes',
      			),
      			array (
      				'key' => 'field_5a8ae0be02c27',
      				'label' => 'Footer',
      				'name' => 'footer',
      				'type' => 'wysiwyg',
      				'default_value' => '',
      				'toolbar' => 'full',
      				'media_upload' => 'yes',
      			),
      		),
      		'location' => array (
      			array (
      				array (
      					'param' => 'post_type',
      					'operator' => '==',
      					'value' => 'calculator',
      					'order_no' => 0,
      					'group_no' => 0,
      				),
      			),
      		),
      		'options' => array (
      			'position' => 'normal',
      			'layout' => 'no_box',
      			'hide_on_screen' => array (
      			),
      		),
      		'menu_order' => 0,
      	));
      	register_field_group(array (
      		'id' => 'acf_energy-types',
      		'title' => 'Energy Types',
      		'fields' => array (
      			array (
      				'key' => 'field_5a875ee7f9cc9',
      				'label' => 'Unit',
      				'name' => 'unit',
      				'type' => 'text',
      				'default_value' => '',
      				'placeholder' => '',
      				'prepend' => '',
      				'append' => '',
      				'formatting' => 'html',
      				'maxlength' => '',
      			),
      		),
      		'location' => array (
      			array (
      				array (
      					'param' => 'post_type',
      					'operator' => '==',
      					'value' => 'energytype',
      					'order_no' => 0,
      					'group_no' => 0,
      				),
      			),
      		),
      		'options' => array (
      			'position' => 'normal',
      			'layout' => 'no_box',
      			'hide_on_screen' => array (
      			),
      		),
      		'menu_order' => 0,
      	));
      	register_field_group(array (
      		'id' => 'acf_factor-fields',
      		'title' => 'Factor Fields',
      		'fields' => array (
      			array (
      				'key' => 'field_5a8b39c9202a2',
      				'label' => 'Factor',
      				'name' => 'factor',
      				'type' => 'number',
      				'default_value' => '',
      				'placeholder' => '',
      				'prepend' => '',
      				'append' => '',
      				'min' => '',
      				'max' => '',
      				'step' => '',
      			),
      			array (
      				'key' => 'field_5a8b3abe4b693',
      				'label' => 'Factor Type',
      				'name' => 'factor_type',
      				'type' => 'radio',
      				'choices' => array (
      					'Energy Factor' => 'Energy Factor',
      					'Air Factor' => 'Air Factor',
      					'Road Factor' => 'Road Factor',
      					'Other Factor' => 'Other Factor',
      				),
      				'other_choice' => 0,
      				'save_other_choice' => 0,
      				'default_value' => '',
      				'layout' => 'vertical',
      			),
      			array (
      				'key' => 'field_5a8b3c5f155ea',
      				'label' => 'Province',
      				'name' => 'province',
      				'type' => 'post_object',
      				'conditional_logic' => array (
      					'status' => 1,
      					'rules' => array (
      						array (
      							'field' => 'field_5a8b3abe4b693',
      							'operator' => '==',
      							'value' => 'Energy Factor',
      						),
      					),
      					'allorany' => 'all',
      				),
      				'post_type' => array (
      					0 => 'province',
      				),
      				'taxonomy' => array (
      					0 => 'all',
      				),
      				'allow_null' => 0,
      				'multiple' => 0,
      			),
      			array (
      				'key' => 'field_5a8b3a49956e8',
      				'label' => 'Energy Type',
      				'name' => 'energy_type',
      				'type' => 'post_object',
      				'conditional_logic' => array (
      					'status' => 1,
      					'rules' => array (
      						array (
      							'field' => 'field_5a8b3abe4b693',
      							'operator' => '==',
      							'value' => 'Energy Factor',
      						),
      					),
      					'allorany' => 'all',
      				),
      				'post_type' => array (
      					0 => 'energytype',
      				),
      				'taxonomy' => array (
      					0 => 'all',
      				),
      				'allow_null' => 0,
      				'multiple' => 0,
      			),
      			array (
      				'key' => 'field_5a8b3cce493fc',
      				'label' => 'Residential/Commercial',
      				'name' => 'residential/commercial',
      				'type' => 'radio',
      				'conditional_logic' => array (
      					'status' => 1,
      					'rules' => array (
      						array (
      							'field' => 'field_5a8b3abe4b693',
      							'operator' => '==',
      							'value' => 'Energy Factor',
      						),
      					),
      					'allorany' => 'all',
      				),
      				'choices' => array (
      					'Residential' => 'Residential',
      					'Commercial' => 'Commercial',
      				),
      				'other_choice' => 0,
      				'save_other_choice' => 0,
      				'default_value' => '',
      				'layout' => 'vertical',
      			),
      			array (
      				'key' => 'field_5a8b3cfd61baf',
      				'label' => 'Air Class',
      				'name' => 'air_class',
      				'type' => 'post_object',
      				'conditional_logic' => array (
      					'status' => 1,
      					'rules' => array (
      						array (
      							'field' => 'field_5a8b3abe4b693',
      							'operator' => '==',
      							'value' => 'Air Factor',
      						),
      					),
      					'allorany' => 'all',
      				),
      				'post_type' => array (
      					0 => 'airclass',
      				),
      				'taxonomy' => array (
      					0 => 'all',
      				),
      				'allow_null' => 0,
      				'multiple' => 0,
      			),
      			array (
      				'key' => 'field_5a8b3d1a5c7d0',
      				'label' => 'Minimum Distance',
      				'name' => 'minimum_distance',
      				'type' => 'number',
      				'conditional_logic' => array (
      					'status' => 1,
      					'rules' => array (
      						array (
      							'field' => 'field_5a8b3abe4b693',
      							'operator' => '==',
      							'value' => 'Air Factor',
      						),
      					),
      					'allorany' => 'all',
      				),
      				'default_value' => '',
      				'placeholder' => '',
      				'prepend' => '',
      				'append' => '',
      				'min' => '',
      				'max' => '',
      				'step' => '',
      			),
      			array (
      				'key' => 'field_5a8b3d2f203f2',
      				'label' => 'Maximum Distance',
      				'name' => 'maximum_distance',
      				'type' => 'number',
      				'conditional_logic' => array (
      					'status' => 1,
      					'rules' => array (
      						array (
      							'field' => 'field_5a8b3abe4b693',
      							'operator' => '==',
      							'value' => 'Air Factor',
      						),
      					),
      					'allorany' => 'all',
      				),
      				'default_value' => '',
      				'placeholder' => '',
      				'prepend' => '',
      				'append' => '',
      				'min' => '',
      				'max' => '',
      				'step' => '',
      			),
      			array (
      				'key' => 'field_5a8b3d4adbf3d',
      				'label' => 'Road Class',
      				'name' => 'road_class',
      				'type' => 'post_object',
      				'conditional_logic' => array (
      					'status' => 1,
      					'rules' => array (
      						array (
      							'field' => 'field_5a8b3abe4b693',
      							'operator' => '==',
      							'value' => 'Road Factor',
      						),
      					),
      					'allorany' => 'all',
      				),
      				'post_type' => array (
      					0 => 'roadclass',
      				),
      				'taxonomy' => array (
      					0 => 'all',
      				),
      				'allow_null' => 0,
      				'multiple' => 0,
      			),
      			array (
      				'key' => 'field_5a8b3d7046be2',
      				'label' => 'Fuel Type',
      				'name' => 'fuel_type',
      				'type' => 'post_object',
      				'conditional_logic' => array (
      					'status' => 1,
      					'rules' => array (
      						array (
      							'field' => 'field_5a8b3abe4b693',
      							'operator' => '==',
      							'value' => 'Road Factor',
      						),
      					),
      					'allorany' => 'all',
      				),
      				'post_type' => array (
      					0 => 'fueltype',
      				),
      				'taxonomy' => array (
      					0 => 'all',
      				),
      				'allow_null' => 0,
      				'multiple' => 0,
      			),
      			array (
      				'key' => 'field_5a8b3d8cd1333',
      				'label' => 'Transport Type',
      				'name' => 'transport_type',
      				'type' => 'post_object',
      				'conditional_logic' => array (
      					'status' => 1,
      					'rules' => array (
      						array (
      							'field' => 'field_5a8b3abe4b693',
      							'operator' => '==',
      							'value' => 'Other Factor',
      						),
      					),
      					'allorany' => 'all',
      				),
      				'post_type' => array (
      					0 => 'transporttype',
      				),
      				'taxonomy' => array (
      					0 => 'all',
      				),
      				'allow_null' => 0,
      				'multiple' => 0,
      			),
      		),
      		'location' => array (
      			array (
      				array (
      					'param' => 'post_type',
      					'operator' => '==',
      					'value' => 'factor',
      					'order_no' => 0,
      					'group_no' => 0,
      				),
      			),
      		),
      		'options' => array (
      			'position' => 'normal',
      			'layout' => 'no_box',
      			'hide_on_screen' => array (
      			),
      		),
      		'menu_order' => 0,
      	));
      }

    }

    public function acf_load_color_field_choices($field){
      // reset choices
      $field['choices'] = array();


      // get the textarea value from options page without any formatting
      $choices = get_field('my_select_values', 'option', false);


      // explode the value so that each line is a new array piece
      $choices = explode("\n", $choices);


      // remove any unwanted white space
      $choices = array_map('trim', $choices);


      // loop through array and add to field 'choices'
      if( is_array($choices) ) {

          foreach( $choices as $choice ) {

              $field['choices'][ $choice ] = $choice;

          }

      }


      // return the field
      return $field;

    }

    public function my_acf_settings_path( $path ) {
      // update path
      $path = TREE_CANADA_PATH . '/acf/';
      return $path;
    }
    public function my_acf_settings_dir( $dir ) {
      // update path
      $dir = TREE_CANADA_PATH . '/acf/';
      return $dir;
    }

  }

 ?>
