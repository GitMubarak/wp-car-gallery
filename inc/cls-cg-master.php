<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once CG_PATH . 'core/core.php';
include_once CG_PATH . 'core/general-settings.php';
include_once CG_PATH . 'core/listing-content.php';
include_once CG_PATH . 'core/listing-styles.php';
include_once CG_PATH . 'core/single-content.php';
include_once CG_PATH . 'core/single-styles.php';

/**
 * Class: Main
 */
class CG_Master {

	protected $cg_loader;
	protected $cg_version;

	function __construct() {

		$this->cg_version = CG_VERSION;
		add_action( 'plugins_loaded', array( $this, 'cg_load_plugin_textdomain' ) );
		$this->cg_load_dependencies();
		$this->cg_trigger_admin_hooks();
		$this->cg_trigger_front_hooks();
	}

	function cg_load_plugin_textdomain() {
		load_plugin_textdomain( CG_TXT_DOMAIN, FALSE, CG_TXT_DOMAIN . '/languages/' );
	}

	private function cg_load_dependencies() {

		require_once CG_PATH . 'admin/' . CG_CLS_PRFX . 'admin.php';
		require_once CG_PATH . 'front/' . CG_CLS_PRFX . 'front.php';
		require_once CG_PATH . 'inc/' . CG_CLS_PRFX . 'loader.php';
		$this->cg_loader = new CG_Loader();
	}

	private function cg_trigger_admin_hooks() {

		$cg_admin = new CG_Admin( $this->cg_version() );
		$this->cg_loader->add_action('admin_enqueue_scripts', $cg_admin, CG_PRFX . 'enqueue_assets');
		$this->cg_loader->add_action('admin_menu', $cg_admin, CG_PRFX . 'admin_menu', 0);
		$this->cg_loader->add_action('init', $cg_admin, CG_PRFX . 'custom_post_type', 0);
		$this->cg_loader->add_action('init', $cg_admin, CG_PRFX . 'taxonomy', 0);
		$this->cg_loader->add_action('add_meta_boxes', $cg_admin, CG_PRFX . 'metaboxes');
		$this->cg_loader->add_action('save_post', $cg_admin, CG_PRFX . 'save_meta_value', 1, 1);
		$this->cg_loader->add_action('admin_init', $cg_admin, CG_PRFX . 'flush_rewrite');
	}

	function cg_trigger_front_hooks() {

		$cg_front = new CG_Front( $this->cg_version() );
		$this->cg_loader->add_action('wp_enqueue_scripts', $cg_front, CG_PRFX . 'front_assets');
		$this->cg_loader->add_filter('single_template', $cg_front, CG_PRFX . 'single_template', 10);
		$cg_front->cg_load_shortcode();
	}

	function cg_run() {

		$this->cg_loader->cg_run();
	}

	function cg_version() {

		return $this->cg_version;
	}

	function cg_create_tables() {
		
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'cg_applied';
		
		//$sqlTblExist = "DROP TABLE IF EXISTS $table_name";
		//$wpdb->query( $sqlTblExist );
		
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			//table not in database. Create new table
			$charset_collate = $wpdb->get_charset_collate();
			$sql = "CREATE TABLE $table_name (
					job_id INT(11) NOT NULL AUTO_INCREMENT,
					job_post_id INT(11) NOT NULL,
					applied_for VARCHAR(155),
					applicant_name VARCHAR(155) NOT NULL,
					applicant_email VARCHAR(155) NOT NULL,
					applicant_phone VARCHAR(55),
					applicant_message TEXT,
					resume_name VARCHAR(155) NOT NULL,
					applied_on DATETIME,
					PRIMARY KEY (`job_id`)
			) $charset_collate;";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	}
}