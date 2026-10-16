<?php
/**
 * Plugin Name:         HM Car Listings
 * Plugin URI:		    https://wordpress.org/plugins/hm-car-listings/
 * Description: 	    Car Listings & Vehicle Inventory for WordPress
 * Version:             1.0.0
 * Author:		        HM Plugin
 * Author URI:	        https://hmplugin.com
 * Requires at least:   6.0
 * Requires PHP:        7.4
 * Text Domain:         hm-car-listings
 * Domain Path:         /languages/
 * License:             GPLv2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('CG_PATH', plugin_dir_path(__FILE__));
define('CG_ASSETS', plugins_url('/assets/', __FILE__));
define('CG_SLUG', plugin_basename(__FILE__));
define('CG_PRFX', 'cg_');
define('CG_CLS_PRFX', 'cls-cg-');
define('CG_TXT_DOMAIN', 'hm-car-listings');
define('CG_VERSION', '1.0.0');

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