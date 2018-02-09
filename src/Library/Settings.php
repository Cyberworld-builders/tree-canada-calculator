<?php

    namespace TreeCanada\Library;

    class Settings {

      public function __construct(){
        add_action( 'admin_init', array($this, 'settings_init') );
        add_action( 'admin_menu', array($this, 'options_page' ) );
      }

      public function settings_init(){

        // all of the tree canada options settings are serialized into the treecanada option value
        register_setting( 'treecanada', 'treecanada' );

        // this adds the calculator settings section on the options page
        add_settings_section(
          'treecanada_section_options', __( 'Carbon Calculator Settings:', 'treecanada' ), array($this,'section_options_cb'),'treecanada'
        );

        // the following function calls each create an option field, passing the dynamic part of the field into a re-useable function. to add more options, simply repeat this convention
        add_settings_field(
          'calculator_title',
          __( 'Calculator Title', 'treecanada' ),
          array($this,'field_basic_cb'),
          'treecanada',
          'treecanada_section_options',
          [
          'label_for' => 'calculator_title',
          'class' => 'treecanada_row',
          'treecanada_custom_data' => 'custom',
          ]
        );
        add_settings_field(
          'calculator_description',
          __( 'Description', 'treecanada' ),
          array($this,'field_basic_cb'),
          'treecanada',
          'treecanada_section_options',
          [
          'label_for' => 'calculator_description',
          'class' => 'treecanada_row',
          'treecanada_custom_data' => 'custom',
          'description' =>  "The paragraph at the top under the title heading. ",
          'size'  =>  "large"
          ]
        );
        add_settings_field(
          'calculator_provinces',
          __( 'Provinces', 'treecanada' ),
          array($this,'field_basic_cb'),
          'treecanada',
          'treecanada_section_options',
          [
          'label_for' => 'calculator_provinces',
          'class' => 'treecanada_row',
          'treecanada_custom_data' => 'custom',
          'description' =>  "Comma separated list of provinces. ",
          'size'  =>  "large"
          ]
        );

        add_settings_field(
          'calculator_energytypes',
          __( 'Energy Types', 'treecanada' ),
          array($this,'field_basic_cb'),
          'treecanada',
          'treecanada_section_options',
          [
          'label_for' => 'calculator_energytypes',
          'class' => 'treecanada_row',
          'treecanada_custom_data' => 'custom',
          'description' =>  "Comma separated list of energy types. ",
          'size'  =>  "large"
          ]
        );

        add_settings_field(
          'calculator_airclasses',
          __( 'Air Transportation Classes', 'treecanada' ),
          array($this,'field_basic_cb'),
          'treecanada',
          'treecanada_section_options',
          [
          'label_for' => 'calculator_airclasses',
          'class' => 'treecanada_row',
          'treecanada_custom_data' => 'custom',
          'description' =>  "Comma separated list of air transportation classes. ",
          'size'  =>  "large"
          ]
        );

        add_settings_field(
          'calculator_roadclasses',
          __( 'Road Vehicle Classes', 'treecanada' ),
          array($this,'field_basic_cb'),
          'treecanada',
          'treecanada_section_options',
          [
          'label_for' => 'calculator_roadclasses',
          'class' => 'treecanada_row',
          'treecanada_custom_data' => 'custom',
          'description' =>  "Comma separated list of road vehicle classes. ",
          'size'  =>  "large"
          ]
        );

        add_settings_field(
          'calculator_fueltypes',
          __( 'Road Fuel Types', 'treecanada' ),
          array($this,'field_basic_cb'),
          'treecanada',
          'treecanada_section_options',
          [
          'label_for' => 'calculator_fueltypes',
          'class' => 'treecanada_row',
          'treecanada_custom_data' => 'custom',
          'description' =>  "Comma separated list of road fuel types. ",
          'size'  =>  "large"
          ]
        );

        add_settings_field(
          'calculator_transporttypes',
          __( 'Other Transport Types', 'treecanada' ),
          array($this,'field_basic_cb'),
          'treecanada',
          'treecanada_section_options',
          [
          'label_for' => 'calculator_transporttypes',
          'class' => 'treecanada_row',
          'treecanada_custom_data' => 'custom',
          'description' =>  "Comma separated list of other transport types. ",
          'size'  =>  "large"
          ]
        );



      }

      function section_options_cb(){
        return true;
      }


      // this is the template for creating a basic simple form field for the options menu. most options will use this simple text field template
      function field_basic_cb( $args ) {
         $options = get_option( 'treecanada' );
         $description = (isset($args['description']))?$args['description']:"";
         $size = (isset($args['size']))?$args['size']:"small";

         ?>
         <?php if($size == "large"): ?>
           <textarea
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            data-custom="<?php echo esc_attr( $args['treecanada_custom_data'] ); ?>"
            name="treecanada[<?php echo esc_attr( $args['label_for'] ); ?>]"
            type="<?php echo ( isset($args['input_type']) )?$args['input_type']:"text"; ?>"
            placeholder=""
            style="width: 100%;"
            /><?php echo $options[ $args['label_for'] ]; ?></textarea>

         <?php else: ?>
           <input
            id="<?php echo esc_attr( $args['label_for'] ); ?>"
            data-custom="<?php echo esc_attr( $args['treecanada_custom_data'] ); ?>"
            name="treecanada[<?php echo esc_attr( $args['label_for'] ); ?>]"
            type="<?php echo ( isset($args['input_type']) )?$args['input_type']:"text"; ?>" value="<?php echo $options[ $args['label_for'] ]; ?>"
            placeholder=""
            />
         <?php endif; ?>
          <p class="description">
          <?php esc_html_e( $description, 'treecanada' ); ?>
          </p>
         <?php
      }

      // this is the callback used for droplist select fields
      public function field_droplist_cb(){
        $options = get_option( 'treecanada' );
        var_dump($options);
        ?>
        <select
          id="<?php echo esc_attr( $args['label_for'] ); ?>"
          data-custom="<?php echo esc_attr( $args['treecanada_custom_data'] ); ?>"
          name="treecanada[<?php echo esc_attr( $args['label_for'] ); ?>]"
          value="<?php echo $options[ $args['label_for'] ]; ?>"   >
          <?php foreach($options[$args['label_for']] as $option): ?>
            <option><?php echo $option; ?></option>
          <?php endforeach; ?>
        </select>
        <?php
      }

      // this tells wordpress to add a navigation link to our custom settings page
      public function options_page() {
          add_menu_page(
            'Tree Canada Plugin Settings',
            'Tree Canada Settings',
            'manage_options',
            'treecanada',
            array($this, 'options_page_html')
          );
      }

      // this defines the basic html container for our options page
      public function options_page_html() {
         if ( ! current_user_can( 'manage_options' ) ) {
           return;
         }
         if ( isset( $_GET['settings-updated'] ) ) {
           add_settings_error( 'treecanada_messages', 'treecanada_messages', __( 'Settings Saved', 'treecanada' ), 'updated' );
         }
         settings_errors( 'treecanada_messages' );
         ?>
           <div class="wrap">
             <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
             <form action="options.php" method="post">
               <?php
                 settings_fields( 'treecanada' );
                 do_settings_sections( 'treecanada' );
                 submit_button( 'Save Settings' );
               ?>
             </form>
           </div>
         <?php
         $options = get_option('treecanada');
         var_dump($options);
      }

    }

 ?>
