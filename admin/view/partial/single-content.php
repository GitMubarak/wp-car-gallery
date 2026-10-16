<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cgSingleContent = $this->cg_get_single_content_settings();

foreach ( $cgSingleContent as $option_name => $option_value ) {
    if ( isset( $cgSingleContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="cg_single_content_settings_form" role="form" class="form-horizontal" method="post" action="" id="cg-single-content-settings-form">
    <?php wp_nonce_field( 'cg_single_content_settings_nonce_action', 'cg_single_content_settings_nonce_field' ); ?>
    <table class="cg-single-settings-table">
        <tr>
            <th scope="row">
                <label for="cg_single_show_car_title"><?php esc_html_e('Display Car Title', 'hm-car-listings'); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_show_car_title" class="cg_single_show_car_title" id="cg_single_show_car_title" value="1"
                    <?php checked( $cg_single_show_car_title, 1 ); ?>>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_overview"><?php esc_html_e('Hide Overview', 'hm-car-listings'); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_overview" class="cg_single_hide_overview" id="cg_single_hide_overview" value="1"
                    <?php checked( $cg_single_hide_overview, 1 ); ?>>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_contact_seller"><?php esc_html_e('Hide Contact Seller', 'hm-car-listings'); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_contact_seller" class="cg_single_hide_contact_seller" id="cg_single_hide_contact_seller" value="1"
                    <?php checked( $cg_single_hide_contact_seller, 1 ); ?>>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_call_seller"><?php esc_html_e('Hide Call Seller', 'hm-car-listings'); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_call_seller" class="cg_single_hide_call_seller" id="cg_single_hide_call_seller" value="1"
                    <?php checked( $cg_single_hide_call_seller, 1 ); ?>>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateSingleContent" name="updateSingleContent" class="button button-primary cg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php esc_html_e('Save Settings', 'hm-car-listings'); ?>
        </button>
    </p>

</form>