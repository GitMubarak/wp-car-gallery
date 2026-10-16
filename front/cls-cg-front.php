<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Master Class: Front
*/
class HMCG_Front 
{
	use CG_Core,
	CG_General_Settings, 
	CG_Listing_Content_Settings, 
	CG_Listing_Styles_Settings, 
	CG_Single_Content_Settings, 
	CG_Single_Styles_Settings;

	private $hmcg_version;

	function __construct( $version ) {

		$this->hmcg_version = $version;
		$this->hmcg_assets_prefix = substr(CG_PRFX, 0, -1) . '-';
	}
	
	/**
	 * Function for loading front assets
	*/
	function hmcg_front_assets() {
		
		wp_enqueue_style(
            $this->hmcg_assets_prefix . 'font-awesome',
            CG_ASSETS . 'css/fontawesome/css/all.min.css',
            array(),
            $this->hmcg_version,
            FALSE
        );

		wp_enqueue_style(	
			'cg-front',
			CG_ASSETS . 'css/' . $this->hmcg_assets_prefix . 'front.css',
			array(),
			$this->hmcg_version,
			FALSE 
		);

		$cg_listing_custom_css = include CG_PATH . 'assets/css/listing-styles.php';

		wp_add_inline_style( 'cg-front', $cg_listing_custom_css );

		// Styles for Search
		wp_enqueue_style(	
			'cg-front-search',
			CG_ASSETS . 'css/cg-search.css',
			array(),
			$this->hmcg_version,
			FALSE 
		);

		wp_enqueue_style(	
			'cg-front-single',
			CG_ASSETS . 'css/cg-single.css',
			array(),
			$this->hmcg_version,
			FALSE 
		);

		$cg_single_custom_css = include CG_PATH . 'assets/css/single-styles.php';

		wp_add_inline_style( 'cg-front-single', $cg_single_custom_css );

		
		if ( ! wp_script_is( 'jquery' ) ) {
			wp_enqueue_script('jquery');
		}

		wp_enqueue_script(  
			'cg-front',
			CG_ASSETS . 'js/' . $this->hmcg_assets_prefix . 'front.js',
			array('jquery'),
			$this->hmcg_version,
			TRUE 
		);
	}

	/**
	 * Function for loading shortcode
	*/
	function hmcg_load_shortcode() {

		add_shortcode( 'hmcg_car_gallery', array( $this, 'hmcg_load_shortcode_view' ) );
	}

	/**
	 * Function for loading shortcode view
	*/
	function hmcg_load_shortcode_view( $cgAttr ) {

		ob_start();
		
		include CG_PATH . 'front/view/listing.php';
		
		return ob_get_clean();
	}

	/**
	 * Function for loading Single Template
	*/
	function hmcg_single_template( $template ) {
		
		global $post;
		
		if ( 'car' === $post->post_type  ) {
			return CG_PATH . 'front/view/single.php';
		}

		return $template;
	}

	/**
	 * Function for loading only car content in the details page
	*/
	function hmcg_single_template_only_content( $content ) {
		
		if (
			! is_singular( 'car' ) ||
			! is_main_query() ||
			! in_the_loop()
		) {
			return $content;
		}

		ob_start();

		include CG_PATH . 'front/view/single.php';

		return ob_get_clean();
	}
}
?>