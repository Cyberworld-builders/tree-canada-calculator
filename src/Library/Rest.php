<?php

  namespace TreeCanada\Library;

  // use TreeCanada\Models\Review;

  class Rest {


    public function __construct(){

      add_action( 'rest_api_init', array($this,'register_api_hooks') );

    }

    public function register_api_hooks(){
      register_rest_route(
         'treecanada/v1', '/factors',
          array(
           'methods'  => 'POST',
           'callback' => array($this,'get_factor'),
          )
      );
      register_rest_route(
         'treecanada/v1', '/controls',
          array(
           'methods'  => 'POST',
           'callback' => array($this,'use_method'),
          )
      );

    }

    public function get_factor(){
      if($_REQUEST['calctype'] == 'energy') {
        $result = query_posts(array(
          'post_type' =>  "factor",
          'post_status' =>  "publish",
          'meta_query'  =>  array(
            array(
              'relation'  =>  "AND",
              'key' =>  "factor_type",
              'value' =>  "Energy Factor"
            ),
            array(
              'relation'  =>  "AND",
              'key' =>  "energy_type",
              'value' =>  $_REQUEST['energy_type']
            ),
            array(
              'relation'  =>  "AND",
              'key' =>  "province",
              'value' =>  $_REQUEST['province']
            ),
            array(
              'relation'  =>  "AND",
              'key' =>  "residential/commercial",
              'value' =>  $_REQUEST['residential']
            ),
          )
        ));
      	if(is_array($result) && count($result) > 0) {
      		$energy_result = get_post_meta($result[0]->ID,'factor',true) * $_REQUEST['energy_qty'];
      		if(is_numeric($energy_result)) {
      			return round($energy_result/1000, 4);
      		} else {
      			return 'N/A';
      		}
      	} else {
      		return 'N/A';
      	}
      } else if ($_REQUEST['calctype'] == 'airtransport') {
        $result = query_posts(array(
          'post_type' =>  "factor",
          'post_status' =>  "publish",
          'meta_query'  =>  array(
            'relation'  =>  "AND",
            array(
              'key' =>  "factor_type",
              'value' =>  "Air Factor",
              'compare' =>  "=",
            ),
            array(
              'key' =>  "air_class",
              'value' =>  $_REQUEST['class'],
              'compare' =>  "=",
            ),
            array(
              'key' =>  "minimum_distance",
              'compare' =>  "<=",
              'value' =>  $_REQUEST['km'],
            ),
            // array(
            //   'key' =>  "maximum_distance",
            //   'compare' =>  ">",
            //   'value' =>  $_REQUEST['km']
            // ),
          )
        ));
      	if(is_array($result) && count($result) == 1) {
          $options = get_option('treecanada');
      		$total_km_travelled = $_REQUEST['km'];
      		if($_REQUEST['passengers'] > 1) {
      			$total_km_travelled = intval($_REQUEST['passengers']) * $total_km_travelled;
      		}
      		if($_REQUEST['roundtrip'] == 1) {
      			$total_km_travelled = $total_km_travelled*2;
      		}
      		$airtransport_result = get_post_meta($result[0]->ID,'factor',true) * $total_km_travelled * $options['calculator_upliftfactor'];
      		if(is_numeric($airtransport_result)) {
      			return round($airtransport_result/1000, 4);
      		} else {
      			return 'N/A';
      		}
      	} else {
      		return 'N/A';
      	}
      } else if ($_REQUEST['calctype'] == 'roadvehicle') {
        $result = query_posts(array(
          'post_type' =>  "factor",
          'post_status' =>  "publish",
          'meta_query'  =>  array(
            array(
              'relation'  =>  "AND",
              'key' =>  "factor_type",
              'value' =>  "Road Factor"
            ),
            array(
              'relation'  =>  "AND",
              'key' =>  "road_class",
              'value' =>  $_REQUEST['class']
            ),
            array(
              'relation'  =>  "AND",
              'key' =>  "fuel_type",
              'value' =>  $_REQUEST['fuel']
            ),
          )
        ));
      	if(is_array($result) && count($result) > 0) {
      		$roadvehicle_result = $_REQUEST['km'] * get_post_meta($result[0]->ID,'factor',true);
      		if(is_numeric($roadvehicle_result)) {
      			return round($roadvehicle_result/1000, 4);
      		} else {
      			return 'N/A';
      		}
      	} else {
      		return 'N/A';
      	}
      } elseif($_REQUEST['calctype'] == 'othertransport') {
        $result = query_posts(array(
          'post_type' =>  "factor",
          'post_status' =>  "publish",
          'meta_query'  =>  array(
            array(
              'relation'  =>  "AND",
              'key' =>  "factor_type",
              'value' =>  "Other Factor"
            ),
            array(
              'relation'  =>  "AND",
              'key' =>  "transport_type",
              'value' =>  $_REQUEST['type']
            ),
          )
        ));
      	if(is_array($result) && count($result) > 0) {
      		$othertransport_result = $_REQUEST['km'] * get_post_meta($result[0]->ID,'factor',true);
      		if(is_numeric($othertransport_result)) {
      			return round($othertransport_result/1000, 4);
      		} else {
      			return 'N/A';
      		}
      	} else {
      		return 'N/A';
      	}
      }
      return 'N/A';
    }

    public function use_method(){
      $options = get_option( 'treecanada' );
    		$trees_needed = intval(ceil($_REQUEST['total_tco2'] * $options['stems_per_ton']));
    		if(is_int($trees_needed)) {
    			return $trees_needed;
    		} else {
    			return 'N/A';
    		}
    }

  }

 ?>
