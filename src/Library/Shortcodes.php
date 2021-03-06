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
    }

    // the following functions handle what happens when the respective shortcode is used

    public function carbon_calculator($atts){

      // retrieve values passed from the within the short code by the admin
      $form_number = (isset($atts['form_number']))?$atts['form_number']:0;

      // retrieve all of the tree canada options set from the option menu
      $options = get_option('treecanada');
      $calc = get_post($atts['id']);

      $provinces = query_posts(array(
        'post_type' =>  "province",
        'post_status' =>  "publish"
      ));

      $energy_types = query_posts(array(
        'post_type' =>  "energytype",
        'post_status' =>  "publish"
      ));

      $air_classes = query_posts(array(
        'post_type' =>  "airclass",
        'post_status' =>  "publish"
      ));

      $road_classes = query_posts(array(
        'post_type' =>  "roadclass",
        'post_status' =>  "publish"
      ));

      $fuel_types = query_posts(array(
        'post_type' =>  "fueltype",
        'post_status' =>  "publish"
      ));

      $transport_types = query_posts(array(
        'post_type' =>  "transporttype",
        'post_status' =>  "publish"
      ));

      // enqueue our custom styles and scripts that are unique to this shortcode. there are a few that get enqueued by default. that happens in src/Library/Enqueues.php where these enqueues are actually registered.
      wp_enqueue_style('treecanada-carbon-calculator-css');
      wp_enqueue_script('treecanada-carbon-calculator-js');

      // output buffer for the view template. most of the html is separated out into the following view template for simplified front end editing.
      ob_start();
      include TREE_CANADA_PATH . 'src/Views/Shortcodes/Carbon_Calculator.php';
      return ob_get_clean();

    }

  }

?>
