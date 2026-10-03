<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Listing Content Settings
*/
trait CG_Listing_Content_Settings 
{
    protected $fields, $settings, $options;

    protected function cg_set_listing_content_settings( $post ) {

        $this->fields   = $this->cg_listing_content_option_fileds();

        $this->options  = $this->cg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'cg_detail_settings', $this->options, $post );

        return update_option( 'cg_detail_settings', serialize( $this->settings ) );

    }

    function cg_get_listing_content_settings() {

        $this->fields   = $this->cg_listing_content_option_fileds();
		$this->settings = stripslashes_deep( unserialize( get_option('cg_detail_settings') ) );
        
        return $this->cg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function cg_listing_content_option_fileds() {

        return [
            [
                'name'      => 'cg_list_display_overview',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_list_overview_length',
                'type'      => 'number',
                'default'   => 30,
            ],
            [
                'name'      => 'cg_list_exp_lbl_txt',
                'type'      => 'text',
                'default'   => 'Experience',
            ],
        ];
    }
}