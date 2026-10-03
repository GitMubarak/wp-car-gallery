<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//$cgSingleStyles = [];
foreach ( $cgSingleStyles as $option_name => $option_value ) {
    if ( isset( $cgSingleStyles[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="cg_single_style_form" role="form" class="form-horizontal" method="post" action="" id="cg-single-style-form">
    <table class="cg-single-style-settings-table">
        <!-- Title -->
        <tr>
            <th scope="row" colspan="4">
                <hr><span><?php _e('Job Title', 'wp-car-gallery'); ?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php _e('Font Color', 'wp-car-gallery'); ?>:</label>
            </th>
            <td>
                <input class="cg-wp-color" type="text" name="cg_single_title_font_color" id="cg_single_title_font_color" value="<?php esc_attr_e( $cg_single_title_font_color ); ?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php _e('Font Size', 'wp-car-gallery'); ?>:</label>
            </th>
            <td>
                <input type="number" class="small-text" min="11" max="50" name="cg_single_title_font_size" id="cg_single_title_font_size" value="<?php esc_attr_e( $cg_single_title_font_size ); ?>">
                <code>px</code>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit"><button id="updateSingleStyles" name="updateSingleStyles" class="button button-primary cg-button"><?php _e('Save Settings', 'wp-car-gallery'); ?></button></p>
</form>