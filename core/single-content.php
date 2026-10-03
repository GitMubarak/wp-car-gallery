<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Single Content Settings
*/
trait CG_Single_Content_Settings 
{
    protected $fields, $settings, $options;

    protected function cg_set_single_content_settings( $post ) {

        $this->fields   = $this->cg_single_content_option_fileds();

        $this->options  = $this->cg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'cg_detail_settings', $this->options, $post );

        return update_option( 'cg_detail_settings', serialize( $this->settings ) );

    }

    function cg_get_single_content_settings() {

        $this->fields   = $this->cg_single_content_option_fileds();
		$this->settings = stripslashes_deep( unserialize( get_option('cg_detail_settings') ) );
        
        return $this->cg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function cg_single_content_option_fileds() {

        return [
            [
                'name'      => 'cg_single_hide_overview',
                'type'      => 'boolean',
                'default'   => false,
            ],
        ];
    }
}