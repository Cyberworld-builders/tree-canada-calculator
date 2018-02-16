<?php

  namespace TreeCanada\Library;

  // this class handles all of our short codes. it is instantiated on load.
  // the convention for these shortcodes is similar to an MVC controller and are as follows.
  // any data retrieval and manipulation needs to occur here in php.
  // more sophisticated data queries and database state manipulation needs to happen in a model class.
  // any css styles or javascript needs to be placed in a proper file in the css/ and js/ folders respectively.
  // they then must be registered in src/Library/Enqueues.php in accordance with wordpress enqueue standards. DO NOT jam styles and scripts into your themes header.php or footer.php
  // all html markup needs to be placed into the view template file referenced in the include. back end developers should not be echoing html nor should front end developers be querying sql statements
  // output buffer and return your view template. DO NOT echo.

  class Shortcodes {
    public function __construct(){
      // define all of our shortcodes. right now we just have the one.
      add_shortcode('treecanada_carbon_calculator',array($this, 'carbon_calculator'));
      add_shortcode('treecanada_old_calculator',array($this, 'old_calculator'));

      add_shortcode('treecanada_test_calculator',array($this,'test_calculator'));

    }

    // the following functions handle what happens when the respective shortcode is used

    public function old_calculator(){
      $options = get_option('treecanada');
      wp_enqueue_style('treecanada-old-calculator-css');
      wp_enqueue_script('treecanada-hashchange-js');
      wp_enqueue_script('treecanada-easytabs-js');
      wp_enqueue_script('treecanada-old-calculator-js');
      $lang = 'en';
      $tool_name_calc = site_url() . '/wp-json/treecanada/v1/factors';
      $tool_name_shop  = site_url() . '/wp-json/treecanada/v1/controls';
      wp_localize_script( 'treecanada-scripts-js', 'lang', 'en');
      ob_start();
      include TREE_CANADA_PATH . 'src/Views/Shortcodes/Old_Calculator.php';
      return ob_get_clean();
    }

    public function carbon_calculator($atts){

      // retrieve values passed from the within the short code by the admin
      $form_number = (isset($atts['form_number']))?$atts['form_number']:0;

      // retrieve all of the tree canada options set from the option menu
      $options = get_option('treecanada');

      // enqueue our custom styles and scripts that are unique to this shortcode. there are a few that get enqueued by default. that happens in src/Library/Enqueues.php where these enqueues are actually registered.
      wp_enqueue_style('treecanada-carbon-calculator-css');
      wp_enqueue_script('treecanada-carbon-calculator-js');

      // output buffer for the view template. most of the html is separated out into the following view template for simplified front end editing.
      ob_start();
      include TREE_CANADA_PATH . 'src/Views/Shortcodes/Carbon_Calculator.php';
      return ob_get_clean();

    }

    public function test_calculator($atts){
      $calc = get_post($atts['id']);
      include TREE_CANADA_PATH . 'src/Views/Shortcodes/Test_Calculator.php';
    }

  }

?>
