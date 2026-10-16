<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once CG_PATH . 'core/core.php';
include_once CG_PATH . 'inc/cls-cg-currency.php';
include_once CG_PATH . 'core/general-settings.php';
include_once CG_PATH . 'core/listing-content.php';
include_once CG_PATH . 'core/listing-styles.php';
include_once CG_PATH . 'core/single-content.php';
include_once CG_PATH . 'core/single-styles.php';

/**
 * Class: Main
 */
class HMCG_Master {

	protected $cg_loader;
	protected $cg_version;

	function __construct() {

		$this->cg_version = CG_VERSION;
		$this->cg_load_dependencies();
		$this->cg_trigger_admin_hooks();
		$this->cg_trigger_front_hooks();
	}

	private function cg_load_dependencies() {

		require_once CG_PATH . 'admin/' . CG_CLS_PRFX . 'admin.php';
		require_once CG_PATH . 'front/' . CG_CLS_PRFX . 'front.php';
		require_once CG_PATH . 'inc/' . CG_CLS_PRFX . 'loader.php';
		$this->cg_loader = new CG_Loader();
	}

	private function cg_trigger_admin_hooks() {

		$cg_admin = new HMCG_Admin( $this->cg_version() );
		$this->cg_loader->add_action('admin_enqueue_scripts', $cg_admin, 'hmcg_enqueue_assets');
		$this->cg_loader->add_action('admin_menu', $cg_admin, 'hmcg_admin_menu', 0);
		$this->cg_loader->add_action('init', $cg_admin, 'hmcg_custom_post_type', 0);
		$this->cg_loader->add_action('init', $cg_admin, 'hmcg_taxonomy', 0);
		$this->cg_loader->add_action('add_meta_boxes', $cg_admin, 'hmcg_metaboxes');
		$this->cg_loader->add_action('save_post', $cg_admin, 'hmcg_save_meta_value', 1, 1);
		$this->cg_loader->add_action('admin_init', $cg_admin, 'hmcg_flush_rewrite');
	}

	function cg_trigger_front_hooks() {

		$cg_front = new HMCG_Front( $this->cg_version() );
		$this->cg_loader->add_action('wp_enqueue_scripts', $cg_front, 'hmcg_front_assets');
		//$this->cg_loader->add_filter('single_template', $cg_front, CG_PRFX . 'single_template', 10);
		$this->cg_loader->add_filter('the_content', $cg_front, 'hmcg_single_template_only_content', 10);
		$cg_front->hmcg_load_shortcode();
	}

	function cg_run() {

		$this->cg_loader->cg_run();
	}

	function cg_version() {

		return $this->cg_version;
	}
}