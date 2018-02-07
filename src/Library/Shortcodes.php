<?php

  namespace TreeCanada\Library;

  class Shortcodes {
    public function __construct(){
      add_shortcode('treecanada_carbon_calculator',array($this, 'carbon_calculator'));
    }
    public function carbon_calculator($atts){

      $form_number = (isset($atts['form_number']))?$atts['form_number']:0;

      wp_enqueue_style('treecanada-carbon-calculator-css');
      wp_enqueue_script('treecanada-carbon-calculator-js');

      echo "test";

      // ob_start();
      // include TREE_CANADA_PATH . 'src/Views/Shortcodes/Carbon_Calculator.php';
      // return ob_get_clean();

    }
  }

?>
