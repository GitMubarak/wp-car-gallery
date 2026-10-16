<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cgSingleStyles = $this->cg_get_single_styles_settings();

foreach ( $cgSingleStyles as $option_name => $option_value ) {
    if ( isset( $cgSingleStyles[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}

// Build dynamic CSS
$cg_single_custom_css = "
    .cg-container .cg-heading h1 {
        color: {$cg_single_car_title_font_color};
        font-size: {$cg_single_title_font_size}px;
    }
";

return $cg_single_custom_css;
?>