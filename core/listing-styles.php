<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Listing Styles Settings
*/
trait CG_Listing_Styles_Settings
{
    protected $fields, $settings, $options;
    
    protected function cg_set_listing_styles_settings( $post ) {

        $this->fields   = $this->cg_listing_styles_option_fileds();

        $this->options  = $this->cg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'cg_listing_styles', $this->options, $post );

        return update_option( 'cg_listing_styles', $this->settings );

    }

    function cg_get_listing_styles_settings() {

        $this->fields   = $this->cg_listing_styles_option_fileds();
		$this->settings = get_option('cg_listing_styles');
        
        return $this->cg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function cg_listing_styles_option_fileds() {

        return [
            [
                'name'      => 'cg_listing_title_font_color',
                'type'      => 'text',
                'default'   => '#242424',
            ],
            [
                'name'      => 'cg_listing_title_font_size',
                'type'      => 'number',
                'default'   => '20',
            ],
            [
                'name'      => 'cg_listing_overview_font_color',
                'type'      => 'text',
                'default'   => '#555555',
            ],
            [
                'name'      => 'cg_listing_overview_font_size',
                'type'      => 'number',
                'default'   => '14',
            ],
        ];
    }
}