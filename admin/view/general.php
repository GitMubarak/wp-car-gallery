<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cgGeneralMessage = false;

if ( isset( $_POST['updateGeneralSettings'] ) ) {

    if ( ! isset( $_POST['cg_general_settings_nonce_field'] ) 
        || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cg_general_settings_nonce_field'] ) ), 'cg_general_settings_nonce_action' ) ) {
        
        wp_die( esc_html__( 'Sorry, your nonce did not verify.', 'wp-car-gallery' ) );
    } 
    
    $cgGeneralMessage = $this->cg_set_general_settings( $_POST );
}

$cgGeneralSettings = $this->cg_get_general_settings();

foreach ( $cgGeneralSettings as $option_name => $option_value ) {
    if ( isset( $cgGeneralSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<div id="wph-wrap-all" class="wrap cg-single-settings-page">

    <div class="settings-banner">
        <h2><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;<?php esc_html_e('General Settings', 'wp-car-gallery'); ?></h2>
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
                    <?php wp_nonce_field( 'cg_general_settings_nonce_action', 'cg_general_settings_nonce_field' ); ?>
                    <table class="cg-single-settings-table">
                        <!-- Currency -->
                        <tr>
                            <th scope="row">
                                <label><?php esc_html_e('Currency', 'wp-car-gallery'); ?></label>
                            </th>
                            <td colspan="5">
                                <select name="cg_car_currency" id="cg_car_currency" class="regular-text">
                                    <option value=""><?php esc_html_e('Select One', 'wp-car-gallery'); ?></option>
                                    <?php
                                    $cgCurrency = $this->hm_get_all_currency();
                                    foreach ( $cgCurrency as $curr ) {
                                        $cg_symbol       = html_entity_decode( $curr->symbol, ENT_QUOTES, 'UTF-8' );
                                        $cg_curr_op_val  = $curr->abbreviation . '-' . $cg_symbol;
                                        $cg_saved_value  = html_entity_decode( $cg_car_currency, ENT_QUOTES, 'UTF-8' );
                                        ?>
                                        <option value="<?php echo esc_attr( $cg_curr_op_val ); ?>" <?php selected( $cg_saved_value, $cg_curr_op_val ); ?>>
                                            <?php echo esc_html( $curr->currency . '-' . $curr->abbreviation . '-' . $cg_symbol ); ?>
                                        </option>
                                        <?php
                                    } 
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label><?php esc_html_e('Contact Seller Email', 'wp-car-gallery'); ?></label>
                            </th>
                            <td>
                                <input type="text" name="cg_contact_seller_email" id="cg_contact_seller_email" class="regular-text" 
                                    value="<?php echo esc_attr( $cg_contact_seller_email ); ?>" />
                                <br>
                                <code><?php esc_html_e('Contact seller button email', 'wp-car-gallery'); ?></code>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label><?php esc_html_e('Contact Seller Tel', 'wp-car-gallery'); ?></label>
                            </th>
                            <td>
                                <input type="text" name="cg_contact_seller_tel" id="cg_contact_seller_tel" class="regular-text" 
                                    value="<?php echo esc_attr( $cg_contact_seller_tel ); ?>" />
                                <br>
                                <code><?php esc_html_e('Contact seller button tel', 'wp-car-gallery'); ?></code>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <p class="submit">
                        <button id="updateGeneralSettings" name="updateGeneralSettings" class="button button-primary cg-button">
                            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php esc_html_e('Save Settings', 'wp-car-gallery'); ?>
                        </button>
                    </p>
                </form>
            </div>
        
        </div>

        <?php include_once('partial/admin-sidebar.php'); ?>

    </div>

</div>