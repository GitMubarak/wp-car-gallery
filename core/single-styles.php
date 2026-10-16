<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Single Styles Settings
*/
trait CG_Single_Styles_Settings
{
    protected $fields, $settings, $options;
    
    protected function cg_set_single_styles_settings( $post ) {

        $this->fields   = $this->cg_single_styles_option_fileds();

        $this->options  = $this->cg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'cg_single_styles_settings', $this->options );

        return update_option( 'cg_single_styles_settings', $this->settings );

    }

    function cg_get_single_styles_settings() {

        $this->fields   = $this->cg_single_styles_option_fileds();
		$this->settings = get_option('cg_single_styles_settings');
        
        return $this->cg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function cg_single_styles_option_fileds() {

        return [
            [
                'name'      => 'cg_single_car_title_font_color',
                'type'      => 'text',
                'default'   => '#2271b1',
            ],
            [
                'name'      => 'cg_single_title_font_size',
                'type'      => 'number',
                'default'   => '30',
            ],
        ];
    }
}