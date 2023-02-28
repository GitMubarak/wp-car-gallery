<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//$cgListingStyles = [];
foreach ( $cgListingStyles as $option_name => $option_value ) {
    if ( isset( $cgListingStyles[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="cg_listing_style_form" role="form" class="form-horizontal" method="post" action="" id="cg-listing-style-form">
    <table class="cg-listing-style-settings-table">
        <!-- Title -->
        <tr>
            <th scope="row" colspan="2">
                <hr><span><?php _e('Job Title', JOBWP_TXT_DOMAIN); ?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Font Color', JOBWP_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="cg-wp-color" type="text" name="cg_listing_title_font_color" id="cg_listing_title_font_color" value="<?php esc_attr_e( $cg_listing_title_font_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Font Size', JOBWP_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input type="number" class="small-text" min="11" max="50" name="cg_listing_title_font_size" id="cg_listing_title_font_size" value="<?php esc_attr_e( $cg_listing_title_font_size ); ?>">
                <code>px</code>
            </td>
        </tr>
        <!-- Overview -->
        <tr>
            <th scope="row" colspan="2">
                <hr><span><?php _e('Job Overview', JOBWP_TXT_DOMAIN); ?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Font Color', JOBWP_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input class="cg-wp-color" type="text" name="cg_listing_overview_font_color" id="cg_listing_overview_font_color" value="<?php esc_attr_e( $cg_listing_overview_font_color ); ?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Font Size', JOBWP_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input type="number" class="small-text" min="11" max="50" name="cg_listing_overview_font_size" id="cg_listing_overview_font_size" value="<?php esc_attr_e( $cg_listing_overview_font_size ); ?>">
                <code>px</code>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit"><button id="updateListingStyles" name="updateListingStyles" class="button button-primary cg-button"><?php _e('Save Settings', JOBWP_TXT_DOMAIN); ?></button></p>
</form>