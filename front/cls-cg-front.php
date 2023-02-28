<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Master Class: Front
*/
class CG_Front 
{
	use CG_Core, 
	CG_General_Settings, 
	CG_Listing_Content_Settings, 
	CG_Listing_Styles_Settings, 
	CG_Single_Content_Settings, 
	CG_Single_Styles_Settings;

	private $cg_version;

	function __construct( $version ) {

		$this->cg_version = $version;
		$this->cg_assets_prefix = substr(CG_PRFX, 0, -1) . '-';
	}
	
	/**
	 * Function for loading front assets
	*/
	function cg_front_assets() {
		
		wp_enqueue_style(
            $this->cg_assets_prefix . 'font-awesome',
            CG_ASSETS . 'css/fontawesome/css/all.min.css',
            array(),
            $this->cg_version,
            FALSE
        );

		wp_enqueue_style(	
			'cg-front',
			CG_ASSETS . 'css/' . $this->cg_assets_prefix . 'front.css',
			array(),
			$this->cg_version,
			FALSE 
		);
		
		if ( ! wp_script_is( 'jquery' ) ) {
			wp_enqueue_script('jquery');
		}

		wp_enqueue_script(  
			'cg-front',
			CG_ASSETS . 'js/' . $this->cg_assets_prefix . 'front.js',
			array('jquery'),
			$this->cg_version,
			TRUE 
		);
	}

	/**
	 * Function for loading shortcode
	*/
	function cg_load_shortcode() {

		add_shortcode( 'wp_car_gallery', array( $this, 'cg_load_shortcode_view' ) );
	}

	/**
	 * Function for loading shortcode view
	*/
	function cg_load_shortcode_view( $cgAttr ) {

		$output = '';
		ob_start();
		include_once CG_PATH . 'front/view/listing2.php';
		$output .= ob_get_clean();
		return $output;
	}

	/**
	 * Function for loading Job Single Template
	*/
	function cg_single_template( $template ) {
		
		global $post;
		
		if ( 'car' === $post->post_type  ) {
			return CG_PATH . 'front/view/single.php';
		}

		return $template;
	}
}
?>