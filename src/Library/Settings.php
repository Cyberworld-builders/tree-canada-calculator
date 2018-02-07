<?php

    namespace TreeCanada\Library;

    class Settings {

      public function __construct(){
        add_action( 'admin_init', array($this, 'settings_init') );
        add_action( 'admin_menu', array($this, 'options_page' ) );
      }

      public function settings_init(){
        register_setting( 'treecanada', 'treecanada_options' );
        add_settings_section(
          'treecanada_section_options', __( 'Carbon Calculator Settings:', 'treecanada' ), array($this,'section_options_cb'),'treecanada'
        );
        add_settings_field(
          'treecanada_option_1',
          __( 'Option 1', 'treecanada' ),
          array($this,'field_basic_cb'),
          'treecanada',
          'treecanada_section_options',
          [
          'label_for' => 'treecanada_option_1',
          'class' => 'treecanada_row',
          'treecanada_custom_data' => 'custom',
          ]
        );
      }

      function section_options_cb(){
        return true;
      }

      function field_basic_cb( $args ) {
         $options = get_option( 'treecanada_options' );
         ?>
         <input
          id="<?php echo esc_attr( $args['label_for'] ); ?>"
          data-custom="<?php echo esc_attr( $args['treecanada_custom_data'] ); ?>"
          name="treecanada_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
          type="<?php echo ( isset($args['input_type']) )?$args['input_type']:"text"; ?>" value="<?php echo $options[ $args['label_for'] ]; ?>"
          placeholder=""
          />
          <p class="description">
          <?php esc_html_e( '', 'treecanada' ); ?>
          </p>
         <?php
      }

      public function options_page() {
          add_menu_page(
            'Tree Canada Plugin Settings',
            'Tree Canada Settings',
            'manage_options',
            'treecanada',
            array($this, 'options_page_html')
          );
      }

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
      }

    }

 ?>
