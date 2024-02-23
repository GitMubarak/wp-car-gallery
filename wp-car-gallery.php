<?php
/**
 * Plugin Name:         WP Car Gallery
 * Plugin URI:		    https://wordpress.org/plugins/wp-car-gallery/
 * Description: 	    Display car listings in a page.
 * Version:             1.0
 * Author:		        HM Plugin
 * Author URI:	        https://hmplugin.com
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Tested up to:        6.1.1
 * Text Domain:         wp-car-gallery
 * Domain Path:         /languages/
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('CG_PATH', plugin_dir_path(__FILE__));
define('CG_ASSETS', plugins_url('/assets/', __FILE__));
define('CG_SLUG', plugin_basename(__FILE__));
define('CG_PRFX', 'cg_');
define('CG_CLS_PRFX', 'cls-cg-');
define('CG_TXT_DOMAIN', 'wp-car-gallery');
define('CG_VERSION', '1.2');

require_once CG_PATH . 'inc/' . CG_CLS_PRFX . 'master.php';
$cg = new CG_Master();
$cg->cg_run();

// rewrite_rules upon plugin activation
register_activation_hook( __FILE__, 'cg_myplugin_activate' );
function cg_myplugin_activate() {
	if ( ! get_option( 'cg_flush_rewrite_rules_flag' ) ) {
		add_option( 'cg_flush_rewrite_rules_flag', true );
	}
}

add_action( 'init', 'cg_flush_rewrite_rules_maybe', 10 );
function cg_flush_rewrite_rules_maybe() {
	if( get_option( 'cg_flush_rewrite_rules_flag' ) ) {
		flush_rewrite_rules();
		delete_option( 'cg_flush_rewrite_rules_flag' );
	}
}