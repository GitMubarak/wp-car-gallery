<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//print_r( $cgSingleContent );
foreach ( $cgSingleContent as $option_name => $option_value ) {
    if ( isset( $cgSingleContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="cg_single_content_settings_form" role="form" class="form-horizontal" method="post" action="" id="cg-single-content-settings-form">
    <table class="cg-single-settings-table">
        <tr>
            <th scope="row">
                <label for="cg_single_hide_overview"><?php _e('Hide Overview', 'wp-car-gallery'); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_overview" class="cg_single_hide_overview" id="cg_single_hide_overview"
                    <?php echo $cg_single_hide_overview ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', 'wp-car-gallery'); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_overview_text" id="cg_single_overview_text" class="regular-text" value="<?php esc_attr_e( $cg_single_overview_text ); ?>" />
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateSingleContent" name="updateSingleContent" class="button button-primary cg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php _e('Save Settings', 'wp-car-gallery'); ?>
        </button>
    </p>

</form>