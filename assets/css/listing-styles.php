<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cgListingStyles = $this->cg_get_listing_styles_settings();

foreach ( $cgListingStyles as $option_name => $option_value ) {
    if ( isset( $cgListingStyles[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}

// Build dynamic CSS
$cg_listing_custom_css = "
    .cg-grid-item .cg-car-name a.cg-car-name-link {
        color: {$cg_listing_title_font_color};
        font-size: {$cg_listing_title_font_size}px;
    }
";

return $cg_listing_custom_css;
?>