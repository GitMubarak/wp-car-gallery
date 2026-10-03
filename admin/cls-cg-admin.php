<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Master Class: Admin
*/
class CG_Admin 
{
	use CG_Core, 
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
			__('General Settings', 'wp-car-gallery'),
			__('General Settings', 'wp-car-gallery'),
			'manage_options',
			'cg-general-settings',
			array($this, CG_PRFX . 'general_settings'),
		);

		add_submenu_page(
			$cg_cpt_menu,
			__('Listing Page Settings', 'wp-car-gallery'),
			__('Listing Page Settings', 'wp-car-gallery'),
			'manage_options',
			'cg-listing-settings',
			array($this, CG_PRFX . 'listing_settings'),
		);

		add_submenu_page(
			$cg_cpt_menu,
			__('Detail Page Settings', 'wp-car-gallery'),
			__('Detail Page Settings', 'wp-car-gallery'),
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

		$cgGeneralMessage = false;

		// Content
		if ( isset( $_POST['updateGeneralSettings'] ) ) {

			$cgGeneralMessage = $this->cg_set_general_settings( $_POST );

		}

		$cgGeneralSettings = $this->cg_get_general_settings();

		require_once CG_PATH . 'admin/view/general.php';
	}

	/**
	 *	Function For Loading Listing Settings Page
	 */
	function cg_listing_settings() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
	
		$cgTab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null;

		$cgListingMessage = false;

		// Content
		if ( isset( $_POST['updateListingContent'] ) ) {

			$cgListingMessage = $this->cg_set_listing_content_settings( $_POST );

		}

		$cgListingContent = $this->cg_get_listing_content_settings();

		// Style
		if ( isset( $_POST['updateListingStyles'] ) ) {

            $cgListingMessage = $this->cg_set_listing_styles_settings( $_POST );
        }

        $cgListingStyles = $this->cg_get_listing_styles_settings();

		require_once CG_PATH . 'admin/view/listing.php';
	}

	function cg_single_settings() {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
	
		$cgTab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : null;

		$cgSingleMessage = false;

		// Content
		if ( isset( $_POST['updateSingleContent'] ) ) {

			$cgSingleMessage = $this->cg_set_single_content_settings( $_POST );

		}

		$cgSingleContent = $this->cg_get_single_content_settings();

		// Style
		if ( isset( $_POST['updateSingleStyles'] ) ) {

            $cgSingleMessage = $this->cg_set_single_styles_settings( $_POST );
        }

        $cgSingleStyles = $this->cg_get_single_styles_settings();

		require_once CG_PATH . 'admin/view/single.php';
	}

	/**
	 *	Function For Loading Cars Custom Post Type
	 */
	function cg_custom_post_type() {

		$labels = array(
							'name'                => __('All Cars', 'wp-car-gallery'),
							'singular_name'       => __('WP Cars', 'wp-car-gallery'),
							'menu_name'           => __('WP Cars', 'wp-car-gallery'),
							'parent_item_colon'   => __('Parent Car', 'wp-car-gallery'),
							'all_items'           => __('All Cars', 'wp-car-gallery'),
							'view_item'           => __('View Car', 'wp-car-gallery'),
							'add_new_item'        => __('Add New Car', 'wp-car-gallery'),
							'add_new'             => __('Add New', 'wp-car-gallery'),
							'edit_item'           => __('Edit Car', 'wp-car-gallery'),
							'update_item'         => __('Update Car', 'wp-car-gallery'),
							'search_items'        => __('Search Car', 'wp-car-gallery'),
							'not_found'           => __('Not Found', 'wp-car-gallery'),
							'not_found_in_trash'  => __('Not found in Trash', 'wp-car-gallery')
						);
		$args = array(
						'label'               => __('car', 'wp-car-gallery'),
						'description'         => __('Description For Car', 'wp-car-gallery'),
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

		$make = array(
			'name'                       => __( 'Car Makes', 'wp-car-gallery' ),
			'singular_name'              => __( 'Car Make', 'wp-car-gallery' ),
			'search_items'               => __( 'Search Car Makes', 'wp-car-gallery' ),
			'all_items'                  => __( 'All Car Makes', 'wp-car-gallery' ),
			'parent_item'                => __( 'Parent Car Make', 'wp-car-gallery' ),
			'parent_item_colon'          => __( 'Parent Car Make:', 'wp-car-gallery' ),
			'edit_item'                  => __( 'Edit Car Make', 'wp-car-gallery' ),
			'update_item'                => __( 'Update Car Make', 'wp-car-gallery' ),
			'add_new_item'               => __( 'Add New Car Make', 'wp-car-gallery' ),
			'new_item_name'              => __( 'New Car Make Name', 'wp-car-gallery' ),
			'menu_name'                  => __( 'Car Makes', 'wp-car-gallery' ),
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
				'default_term'       => array(
					'name'        => 'Toyota',
					'slug'        => 'toyota',
					'description' => 'Toyota',
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
			__('Car Specification', 'wp-car-gallery'),
			array( $this, 'cg_metabox_specification' ),
			'car',
			'normal',
			'high'
		);
		/*
		add_meta_box(
			'cg-metabox-responsibilities',
			__( 'Responsibilities:', 'wp-car-gallery' ),
			array( $this, 'cg_metabox_responsibilities' ),
			'car',
			'normal',
			'high'
		);
		*/
	}

	/**
	 *	Function For Loading Cars Meta Content
	 */
	function cg_metabox_specification() {
		
		global $post;

		wp_nonce_field( basename(__FILE__), 'cg_fields' );

		$cg_engine_type		= get_post_meta( $post->ID, 'cg_engine_type', true );
		$cg_displacement	= get_post_meta( $post->ID, 'cg_displacement', true );
		$cg_year			= get_post_meta( $post->ID, 'cg_year', true );
		$cg_status			= get_post_meta( $post->ID, 'cg_status', true );

		include_once CG_PATH . 'admin/view/partial/car-info.php';
	}

	function cg_metabox_responsibilities() {

		global $post;
			
		$cg_responsibilities	= get_post_meta( $post->ID, 'cg_responsibilities', true );
		$settings 				= array('media_buttons' => false, 'editor_height' => 200,);
		$content 				= wp_kses_post( $cg_responsibilities);
		$editor_id 				= 'cg_responsibilities';
		wp_editor( $content, $editor_id, $settings );
	}

	/**
	 *	Function For Saving Cars Meta Data
	 */
	function cg_save_meta_value( $post_id ) {
		
		global $post;

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( ! isset( $_POST['cg_engine_type'] ) || ! wp_verify_nonce( $_POST['cg_fields'], basename(__FILE__) ) ) {
			return $post_id;
		}

		$cg_meta_params = array(

			'cg_engine_type'	=> isset( $_POST['cg_engine_type'] ) ? sanitize_text_field( $_POST['cg_engine_type'] ) : null,
			'cg_displacement'	=> isset( $_POST['cg_displacement'] ) ? sanitize_text_field( $_POST['cg_displacement'] ) : null,
			'cg_year'			=> isset( $_POST['cg_year'] ) ? sanitize_text_field( $_POST['cg_year'] ) : null,
			'cg_status'			=> isset( $_POST['cg_status'] ) ? sanitize_text_field( $_POST['cg_status'] ) : null,
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
		?>
		<div class="cg-alert <?php esc_attr_e( $type ); ?>">
			<span class="cg-closebtn">&times;</span>
			<strong><?php esc_html_e( ucfirst( $type ), 'wp-car-gallery' ); ?>!</strong>
			<?php esc_html_e( $msg, 'wp-car-gallery' ); ?>
		</div>
		<?php 
	}
}
?>