<?php
  /**
  * Plugin Name: Beyonk SDK
  * Plugin URI: https://sdk.beyonk.com/
  * Description: Plugin for integrating with the Beyonk Booking Platform
  * Version: 0.0.1
  * Author: Antony MacKenzie-Jones
  * Author URI: http://beyonk.com/
  **/

  function create_plugin_settings_page () {
    $page_title = 'Beyonk SDK Settings';
    $menu_title = 'Beyonk SDK';
    $capability = 'manage_options';
    $slug = 'beyonk_fields';
    $callback = 'plugin_settings_page_content';
    $icon = 'dashicons-admin-plugins';
    $position = 100;

    add_settings_section( 'experience_details_section', 'Theme', 'section_callback', 'beyonk_fields' );
    add_settings_field( 'theme_colour', 'Theme Colour', 'theme_colour_callback', 'beyonk_fields', 'experience_details_section' );
    register_setting( 'beyonk_fields', 'theme_colour' );

    add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
  }

  function theme_colour_callback( $arguments ) {
    echo '<input name="theme_colour" id="theme_colour" type="color" value="' . get_option( 'theme_colour' ) . '" />';
  }

  function plugin_settings_page_content() { ?>
    <div class="wrap">
        <h2>Beyonk SDK Settings<h2>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'beyonk_fields' );
                do_settings_sections( 'beyonk_fields' );
                submit_button();
            ?>
        </form>
    </div> <?php
  }

  add_action( 'admin_menu', 'create_plugin_settings_page' );

  function beyonk_load_sdk_blocks() {
    wp_enqueue_script(
      'beyonk-booking-form',
      plugin_dir_url(__FILE__) . 'booking-form.js',
      array('wp-blocks','wp-editor'),
      true
    );
  }
     
  add_action('enqueue_block_editor_assets', 'beyonk_load_sdk_blocks');
?>