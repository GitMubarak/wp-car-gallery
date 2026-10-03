<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//print_r( $cgGeneralSettings );
foreach ( $cgGeneralSettings as $option_name => $option_value ) {
    if ( isset( $cgGeneralSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<div id="wph-wrap-all" class="wrap cg-single-settings-page">

    <div class="settings-banner">
        <h2><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;<?php _e('General Settings', 'wp-car-gallery'); ?></h2>
    </div>

    <?php
    if ( $cgGeneralMessage ) {
        $this->cg_display_notification('success', 'Your information updated successfully.');
        echo '<br>';
    }
    ?>

    <div class="cg-wrap">

        <div class="cg_personal_wrap cg_personal_help" style="width: 76%; float: left;">
            
            <div class="tab-content">
                <form name="cg_general_settings_form" role="form" class="form-horizontal" method="post" action="" id="cg-general-settings-form">
                    <table class="cg-single-settings-table">
                        <tr>
                            <th scope="row">
                                <label><?php _e('Admin Notification Email', 'wp-car-gallery'); ?></label>
                            </th>
                            <td>
                                <input type="text" name="cg_admin_noti_email" id="cg_admin_noti_email" class="regular-text" value="<?php esc_attr_e( $cg_admin_noti_email ); ?>" />
                                <br>
                                <code><?php _e('An email will sent to this email when a candidate submit an applicaiton.', 'wp-car-gallery'); ?></code>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label><?php _e('Job List Layout', 'wp-car-gallery'); ?></label>
                            </th>
                            <td>
                                <input type="radio" name="cg_list_layout" id="cg_list_layout_list" value="list" <?php echo ( 'list' === $cg_list_layout ) ? 'checked' : ''; ?> >
                                <label for="cg_list_layout_list"><span></span><?php _e('List', 'wp-car-gallery'); ?></label>
                                &nbsp;&nbsp;
                                <input type="radio" name="cg_list_layout" id="cg_list_layout_grid" value="grid" <?php echo ( 'grid' === $cg_list_layout ) ? 'checked' : ''; ?> >
                                <label for="cg_list_layout_grid"><span></span><?php _e('Grid', 'wp-car-gallery'); ?></label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="cg_ext_application_form"><?php _e('Use External Apply Form', 'wp-car-gallery'); ?>?</label>
                            </th>
                            <td>
                                <input type="checkbox" name="cg_ext_application_form" class="cg_ext_application_form" id="cg_ext_application_form"
                                    <?php echo $cg_ext_application_form ? 'checked' : ''; ?> >
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <p class="submit">
                        <button id="updateGeneralSettings" name="updateGeneralSettings" class="button button-primary cg-button">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php _e('Save Settings', 'wp-car-gallery'); ?>
                        </button>
                    </p>
                </form>
            </div>
        
        </div>

        <?php include_once('partial/admin-sidebar.php'); ?>

    </div>

</div>