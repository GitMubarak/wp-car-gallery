<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Single Styles Settings
*/
trait CG_General_Settings
{
    protected $fields, $settings, $options;
    
    protected function cg_set_general_settings( $post ) {

        $this->fields   = $this->cg_general_settings_option_fileds();

        $this->options  = $this->cg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'cg_single_styles', $this->options, $post );

        return update_option( 'cg_single_styles', $this->settings );

    }

    function cg_get_general_settings() {

        $this->fields   = $this->cg_general_settings_option_fileds();
		$this->settings = get_option('cg_single_styles');
        
        return $this->cg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function cg_general_settings_option_fileds() {

        return [
            [
                'name'      => 'cg_admin_noti_email',
                'type'      => 'email',
                'default'   => '',
            ],
            [
                'name'      => 'cg_list_layout',
                'type'      => 'string',
                'default'   => 'list',
            ],
            [
                'name'      => 'cg_ext_application_form',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_ext_application_form_shortcode',
                'type'      => 'text',
                'default'   => '',
            ],
        ];
    }
}