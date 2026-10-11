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
?>
<form name="cg_listing_style_form" role="form" class="form-horizontal" method="post" action="" id="cg-listing-style-form">
    <?php wp_nonce_field( 'cg_listing_style_settings_nonce_action', 'cg_listing_style_settings_nonce_field' ); ?>
    <table class="cg-listing-style-settings-table">
        <!-- Title -->
        <tr>
            <th scope="row" colspan="2">
                <hr><span><?php esc_html_e('Car Title', 'wp-car-gallery'); ?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php esc_html_e('Font Color', 'wp-car-gallery'); ?>:</label>
            </th>
            <td>
                <input class="cg-wp-color" type="text" name="cg_listing_title_font_color" id="cg_listing_title_font_color" value="<?php echo esc_attr( $cg_listing_title_font_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php esc_html_e('Font Size', 'wp-car-gallery'); ?>:</label>
            </th>
            <td>
                <input type="number" class="small-text" min="11" max="50" name="cg_listing_title_font_size" id="cg_listing_title_font_size" value="<?php echo esc_attr( $cg_listing_title_font_size ); ?>">
                <code>px</code>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateListingStyles" name="updateListingStyles" class="button button-primary cg-button">
            <?php esc_html_e('Save Settings', 'wp-car-gallery'); ?>
        </button>
    </p>
</form>