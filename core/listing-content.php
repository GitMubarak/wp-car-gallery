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

        $this->settings = apply_filters( 'cg_listing_content_settings', $this->options );

        return update_option( 'cg_listing_content_settings', $this->settings );
    }

    function cg_get_listing_content_settings() {

        $this->fields   = $this->cg_listing_content_option_fileds();
		$this->settings = get_option('cg_listing_content_settings');
        
        return $this->cg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function cg_listing_content_option_fileds() {

        return [
            [
                'name'      => 'cg_listing_limit',
                'type'      => 'number',
                'default'   => 9,
            ],
            [
                'name'      => 'cg_listing_order_by',
                'type'      => 'string',
                'default'   => 'date',
            ],
            [
                'name'      => 'cg_listing_order',
                'type'      => 'string',
                'default'   => 'DESC',
            ],
        ];
    }
}