<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//print_r( $cgListingContent );
foreach ( $cgListingContent as $option_name => $option_value ) {
    if ( isset( $cgListingContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="cg_listing_content_settings_form" role="form" class="form-horizontal" method="post" action="" id="cg-listing-content-settings-form">
    <table class="cg-listing-content-settings-table">
        <tr>
            <th scope="row">
                <label for="cg_list_display_overview"><?php _e('Hide Overview', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_list_display_overview" class="cg_list_display_overview" id="cg_list_display_overview"
                    <?php echo $cg_list_display_overview ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label for="wbg_cat_label_txt"><?php _e('Word Lengtht', JOBWP_TXT_DOMAIN); ?>:</label>
            </th>
            <td>
                <input type="number" name="cg_list_overview_length" class="medium-text" min="1" max="150" step="1" value="<?php esc_attr_e( $cg_list_overview_length ); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_list_display_experience"><?php _e('Hide Experience', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_list_display_experience" class="cg_list_display_experience" id="cg_list_display_experience"
                    <?php echo $cg_list_display_experience ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_list_exp_lbl_txt" id="cg_list_exp_lbl_txt" class="regular-text" value="<?php esc_attr_e( $cg_list_exp_lbl_txt ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_list_display_deadline"><?php _e('Hide Deadline', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_list_display_deadline" class="cg_list_display_deadline" id="cg_list_display_deadline"
                    <?php echo $cg_list_display_deadline ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_list_deadline_lbl_txt" id="cg_list_deadline_lbl_txt" class="regular-text" value="<?php esc_attr_e( $cg_list_deadline_lbl_txt ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_list_display_location"><?php _e('Hide Location', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_list_display_location" class="cg_list_display_location" id="cg_list_display_location"
                    <?php echo $cg_list_display_location ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_list_loc_lbl_txt" id="cg_list_loc_lbl_txt" class="regular-text" value="<?php esc_attr_e( $cg_list_loc_lbl_txt ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_list_display_jtype"><?php _e('Hide Job Type', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_list_display_jtype" class="cg_list_display_jtype" id="cg_list_display_jtype"
                    <?php echo $cg_list_display_jtype ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_list_job_type_lbl_txt" id="cg_list_job_type_lbl_txt" class="regular-text" value="<?php esc_attr_e( $cg_list_job_type_lbl_txt ); ?>" />
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateListingContent" name="updateListingContent" class="button button-primary cg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php _e('Save Settings', JOBWP_TXT_DOMAIN); ?>
        </button>
    </p>

</form>