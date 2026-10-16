<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Master Class: Admin
*/
class CG_Admin
{
	use CG_Core, CG_Currency,
	CG_General_Settings, 
	CG_Listing_Content_Settings, 
	CG_Listing_Styles_Settings, 
	CG_Single_Content_Settings, 
	CG_Single_Styles_Settings;

	private $cg_version;
	private $cg_assets_prefix;

	function __construct( $version ) {

		$this->cg_version = $version;
		$this->cg_assets_prefix = substr( CG_PRFX, 0, -1 ) . '-';
	}

	/**
	 *	Function For Loading Admin Assets
	 */
	function cg_enqueue_assets() {

		wp_enqueue_style(
            $this->cg_assets_prefix . 'font-awesome',
            CG_ASSETS . 'css/fontawesome/css/all.min.css',
            array(),
            $this->cg_version,
            FALSE
        );

		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_script( 'wp-color-picker');

		wp_enqueue_style(
			$this->cg_assets_prefix . 'admin',
			CG_ASSETS . 'css/' . $this->cg_assets_prefix . 'admin.css',
			array(),
			$this->cg_version,
			FALSE
		);

		wp_enqueue_style(
			'jquery-ui',
			CG_ASSETS . 'css/jquery-ui.css',
			array(),
			$this->cg_version,
			FALSE
		);

		if ( ! wp_script_is('jquery') ) {
			wp_enqueue_script('jquery');
		}
		
		wp_enqueue_script('jquery-ui-datepicker');
		
		wp_enqueue_script(
			$this->cg_assets_prefix . 'admin',
			CG_ASSETS . 'js/' . $this->cg_assets_prefix . 'admin.js',
			array('jquery'),
			$this->cg_version,
			TRUE
		);
	}

	/**
	 *	Function For Loading Admin Menu
	 */
	function cg_admin_menu() {

		$cg_cpt_menu = 'edit.php?post_type=car';

		add_submenu_page(
			$cg_cpt_menu,
			__('General Settings', 'hm-car-listings'),
			__('General Settings', 'hm-car-listings'),
			'manage_options',
			'cg-general-settings',
			array($this, CG_PRFX . 'general_settings'),
		);

		add_submenu_page(
			$cg_cpt_menu,
			__('Listing Page Settings', 'hm-car-listings'),
			__('Listing Page Settings', 'hm-car-listings'),
			'manage_options',
			'cg-listing-settings',
			array($this, CG_PRFX . 'listing_settings'),
		);

		add_submenu_page(
			$cg_cpt_menu,
			__('Detail Page Settings', 'hm-car-listings'),
			__('Detail Page Settings', 'hm-car-listings'),
			'manage_options',
			'cg-single-settings',
			array($this, CG_PRFX . 'single_settings'),
		);
	}

	/**
	 *	Function For Loading Listing Settings Page
	 */
	function cg_general_settings() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		require_once CG_PATH . 'admin/view/general.php';
	}

	/**
	 *	Function For Loading Listing Settings Page
	 */
	function cg_listing_settings() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		require_once CG_PATH . 'admin/view/listing.php';
	}

	function cg_single_settings() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		require_once CG_PATH . 'admin/view/single.php';
	}

	/**
	 *	Function For Loading Cars Custom Post Type
	 */
	function cg_custom_post_type() {

		$labels = array(
			'name'                => __('All Cars', 'hm-car-listings'),
			'singular_name'       => __('WP Cars', 'hm-car-listings'),
			'menu_name'           => __('WP Cars', 'hm-car-listings'),
			'parent_item_colon'   => __('Parent Car', 'hm-car-listings'),
			'all_items'           => __('All Cars', 'hm-car-listings'),
			'view_item'           => __('View Car', 'hm-car-listings'),
			'add_new_item'        => __('Add New Car', 'hm-car-listings'),
			'add_new'             => __('Add New', 'hm-car-listings'),
			'edit_item'           => __('Edit Car', 'hm-car-listings'),
			'update_item'         => __('Update Car', 'hm-car-listings'),
			'search_items'        => __('Search Car', 'hm-car-listings'),
			'not_found'           => __('Not Found', 'hm-car-listings'),
			'not_found_in_trash'  => __('Not found in Trash', 'hm-car-listings')
		);

		$args = array(
			'label'               => __('car', 'hm-car-listings'),
			'description'         => __('Description For Car', 'hm-car-listings'),
			'labels'              => $labels,
			'supports'            => array('title', 'editor', 'page-attributes', 'thumbnail'),
			'public'              => true,
			'hierarchical'        => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'has_archive'         => false,
			'can_export'          => true,
			'exclude_from_search' => false,
			'yarpp_support'       => true,
			//'taxonomies' 	      => array('post_tag'),
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'menu_icon'           => 'dashicons-car'
		);

		register_post_type('car', $args);
	}

	/**
	 *	Function For Loading Cars Taxonomy
	 */
	function cg_taxonomy() {

		// Taxonomy: Make
		$make = array(
			'name'                       => __( 'Car Makes', 'hm-car-listings' ),
			'singular_name'              => __( 'Car Make', 'hm-car-listings' ),
			'search_items'               => __( 'Search Car Makes', 'hm-car-listings' ),
			'all_items'                  => __( 'All Car Makes', 'hm-car-listings' ),
			'parent_item'                => __( 'Parent Car Make', 'hm-car-listings' ),
			'parent_item_colon'          => __( 'Parent Car Make:', 'hm-car-listings' ),
			'edit_item'                  => __( 'Edit Car Make', 'hm-car-listings' ),
			'update_item'                => __( 'Update Car Make', 'hm-car-listings' ),
			'add_new_item'               => __( 'Add New Car Make', 'hm-car-listings' ),
			'new_item_name'              => __( 'New Car Make Name', 'hm-car-listings' ),
			'menu_name'                  => __( 'Car Makes', 'hm-car-listings' ),
		);

		register_taxonomy(
			'car_make',
			array( 'car' ),
			array(
				'hierarchical'       => true,
				'labels'             => $make,
				'show_ui'            => true,
				'show_admin_column'  => true,
				'query_var'          => true,
				'rewrite'            => array(
					'slug' => 'car-make',
				),
			)
		);

		// Taxonomy: Model
		$model = array(
			'name'                       => __( 'Car Models', 'hm-car-listings' ),
			'singular_name'              => __( 'Car Model', 'hm-car-listings' ),
			'search_items'               => __( 'Search Car Models', 'hm-car-listings' ),
			'all_items'                  => __( 'All Car Models', 'hm-car-listings' ),
			'parent_item'                => __( 'Parent Car Model', 'hm-car-listings' ),
			'parent_item_colon'          => __( 'Parent Car Model:', 'hm-car-listings' ),
			'edit_item'                  => __( 'Edit Car Model', 'hm-car-listings' ),
			'update_item'                => __( 'Update Car Model', 'hm-car-listings' ),
			'add_new_item'               => __( 'Add New Car Model', 'hm-car-listings' ),
			'new_item_name'              => __( 'New Car Model Name', 'hm-car-listings' ),
			'menu_name'                  => __( 'Car Models', 'hm-car-listings' ),
		);

		register_taxonomy(
			'car_model',
			array( 'car' ),
			array(
				'hierarchical'       => true,
				'labels'             => $model,
				'show_ui'            => true,
				'show_admin_column'  => true,
				'query_var'          => true,
				'rewrite'            => array(
					'slug' => 'car-model',
				),
			)
		);

		// Taxonomy: Body Type
		$body = array(
			'name'                       => __( 'Body Types', 'hm-car-listings' ),
			'singular_name'              => __( 'Body Type', 'hm-car-listings' ),
			'search_items'               => __( 'Search Body Types', 'hm-car-listings' ),
			'all_items'                  => __( 'All Body Types', 'hm-car-listings' ),
			'parent_item'                => __( 'Parent Body Type', 'hm-car-listings' ),
			'parent_item_colon'          => __( 'Parent Body Type:', 'hm-car-listings' ),
			'edit_item'                  => __( 'Edit Body Type', 'hm-car-listings' ),
			'update_item'                => __( 'Update Body Type', 'hm-car-listings' ),
			'add_new_item'               => __( 'Add New Body Type', 'hm-car-listings' ),
			'new_item_name'              => __( 'New Body Type Name', 'hm-car-listings' ),
			'menu_name'                  => __( 'Body Types', 'hm-car-listings' ),
		);

		register_taxonomy(
			'body_type',
			array( 'car' ),
			array(
				'hierarchical'       => true,
				'labels'             => $body,
				'show_ui'            => true,
				'show_admin_column'  => true,
				'query_var'          => true,
				'rewrite'            => array(
					'slug' => 'body-type',
				),
			)
		);

		// Taxonomy: Fuel Type
		$fuel = array(
			'name'                       => __( 'Fuel Types', 'hm-car-listings' ),
			'singular_name'              => __( 'Fuel Type', 'hm-car-listings' ),
			'search_items'               => __( 'Search Fuel Types', 'hm-car-listings' ),
			'all_items'                  => __( 'All Fuel Types', 'hm-car-listings' ),
			'parent_item'                => __( 'Parent Fuel Type', 'hm-car-listings' ),
			'parent_item_colon'          => __( 'Parent Fuel Type:', 'hm-car-listings' ),
			'edit_item'                  => __( 'Edit Fuel Type', 'hm-car-listings' ),
			'update_item'                => __( 'Update Fuel Type', 'hm-car-listings' ),
			'add_new_item'               => __( 'Add New Fuel Type', 'hm-car-listings' ),
			'new_item_name'              => __( 'New Fuel Type Name', 'hm-car-listings' ),
			'menu_name'                  => __( 'Fuel Types', 'hm-car-listings' ),
		);

		register_taxonomy(
			'car_fuel',
			array( 'car' ),
			array(
				'hierarchical'       => true,
				'labels'             => $fuel,
				'show_ui'            => true,
				'show_admin_column'  => true,
				'query_var'          => true,
				'rewrite'            => array(
					'slug' => 'fuel-type',
				),
			)
		);
	}

	/**
	 *	Function For Loading Cars Metaboxes
	 */
	function cg_metaboxes() {

		add_meta_box(
			'cg_metaboxe_specification',
			__('Car Specifications', 'hm-car-listings'),
			array( $this, 'cg_metabox_specification' ),
			'car',
			'normal',
			'high'
		);
	}

	/**
	 *	Function For Loading Cars Meta Content
	 */
	function cg_metabox_specification() {
		
		include_once CG_PATH . 'admin/view/car-specification.php';
	}

	/**
	 *	Function For Saving Cars Meta Data
	 */
	function cg_save_meta_value( $post_id ) {
		
		global $post;

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( ! isset( $_POST['cg_car_specification_nonce_fields'] ) 
			|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cg_car_specification_nonce_fields'] ) ), 'cg_car_specification_action' ) ) {
			return $post_id;
		}

		$cg_meta_params = array(

			'cg_engine_type'	=> isset( $_POST['cg_engine_type'] ) ? sanitize_text_field( wp_unslash( $_POST['cg_engine_type'] ) ) : null,
			'cg_engine_size'	=> isset( $_POST['cg_engine_size'] ) ? sanitize_text_field( wp_unslash( $_POST['cg_engine_size'] ) ) : null,
			'cg_year'			=> isset( $_POST['cg_year'] ) ? sanitize_text_field( wp_unslash( $_POST['cg_year'] ) ) : null,
			'cg_car_price'		=> isset( $_POST['cg_car_price'] ) ? sanitize_text_field( wp_unslash( $_POST['cg_car_price'] ) ) : null,
			'cg_car_mileage'	=> isset( $_POST['cg_car_mileage'] ) ? sanitize_text_field( wp_unslash( $_POST['cg_car_mileage'] ) ) : null,
			'cg_car_color'		=> isset( $_POST['cg_car_color'] ) ? sanitize_text_field( wp_unslash( $_POST['cg_car_color'] ) ) : null,
			'cg_car_condition'	=> isset( $_POST['cg_car_condition'] ) ? sanitize_text_field( wp_unslash( $_POST['cg_car_condition'] ) ) : null,
			'cg_car_transmission'	=> isset( $_POST['cg_car_transmission'] ) ? sanitize_text_field( wp_unslash( $_POST['cg_car_transmission'] ) ) : null,
			'cg_car_drive_type'	=> isset( $_POST['cg_car_drive_type'] ) ? sanitize_text_field( wp_unslash( $_POST['cg_car_drive_type'] ) ) : null,
			'cg_listing_status'	=> isset( $_POST['cg_listing_status'] ) ? sanitize_text_field( wp_unslash( $_POST['cg_listing_status'] ) ) : null,
		);

		foreach( $cg_meta_params as $key => $value ) {

			if ( 'revision' === $post->post_type ) {
				return;
			}

			if ( get_post_meta( $post_id, $key, false ) ) {

				update_post_meta( $post_id, $key, $value );
			} else {

				add_post_meta( $post_id, $key, $value );
			}

			if ( ! $value ) {

				delete_post_meta( $post_id, $key );
			}
		}
	}

	/**
	 *	Flush Rewrite on Plugin initialization
	 */
	function cg_flush_rewrite() {

		if ( get_option('cg_plugin_settings_have_changed') == true ) {
			flush_rewrite_rules();
			update_option('cg_plugin_settings_have_changed', false);
		}
	}

	/**
	 *	Function for loading notification on save / update
	 */
	function cg_display_notification( $type, $msg ) {

		$allowed_types = array(
			'success',
			'error',
			'warning',
			'info',
		);

		if ( ! in_array( $type, $allowed_types, true ) ) {
			$type = 'info';
		}

		$type = sanitize_html_class( $type );
		$title = ucfirst( $type );
		?>
		<div class="cg-alert <?php echo esc_attr( $type ); ?>">
			<span class="cg-closebtn">&times;</span>
			<strong><?php echo esc_html( $title ); ?>!</strong>
			<?php echo esc_html( $msg ); ?>
		</div>
		<?php 
	}
}
?>