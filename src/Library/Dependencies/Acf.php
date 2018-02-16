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
