<?php
/*
Plugin Name: Woodstock Extensions
Plugin URI: http://woodstock.temashdesign.com
Description: Extensions for Woodstock Wordpress Theme. Supplied as a separate plugin so that the customer does not find empty shortcodes on changing the theme.
Version: 1.9
Author: Temash Design
Author URI: http://temashdesign.com/
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) die( '-1' );

global $tdl_plugin_dir;

$tdl_plugin_dir = plugin_dir_path( __FILE__ );

//Load Modules

#-----------------------------------------------------------------
# Theme Shortcodes
#-----------------------------------------------------------------

require_once 'modules/theme-shortcodes.php';

/**
 * Load plugin textdomain.
 *
 * @since 1.2.2
 */
function woodstock_extensions_load_textdomain() {
	load_plugin_textdomain( 'woodstock', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

add_action( 'plugins_loaded', 'woodstock_extensions_load_textdomain' );

#-----------------------------------------------------------------#
# Redux Framework
#-----------------------------------------------------------------#

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/framework/woodstock.config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/framework/woodstock.config.php' );
}