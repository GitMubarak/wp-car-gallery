<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cgListingContent = $this->cg_get_listing_content_settings();

foreach ( $cgListingContent as $option_name => $option_value ) {
    if ( isset( $cgListingContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="cg_listing_content_settings_form" role="form" class="form-horizontal" method="post" action="" id="cg-listing-content-settings-form">
<?php wp_nonce_field( 'cg_listing_content_settings_nonce_action', 'cg_listing_content_settings_nonce_field' ); ?>
    <table class="cg-listing-content-settings-table">
        <tr>
            <th scope="row">
                <label for="cg_listing_limit"><?php esc_html_e('Listing Limit', 'hm-car-listings'); ?></label>
            </th>
            <td>
                <input type="number" name="cg_listing_limit" class="medium-text" min="1" max="150" step="1" value="<?php echo esc_attr( $cg_listing_limit ); ?>">
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_listing_order_by"><?php esc_html_e('Order By', 'hm-car-listings'); ?></label>
            </th>
            <td>
                <select name="cg_listing_order_by" id="cg_listing_order_by">
                    <option value=""><?php esc_html_e('Select One', 'hm-car-listings'); ?></option>
                    <option value="<?php echo esc_attr( 'date' ); ?>" <?php selected( $cg_listing_order_by, 'date' ); ?>><?php esc_html_e('Date', 'hm-car-listings'); ?></option>
                    <option value="<?php echo esc_attr( 'title' ); ?>" <?php selected( $cg_listing_order_by, 'title' ); ?>><?php esc_html_e('Name', 'hm-car-listings'); ?></option>
                    <option value="<?php echo esc_attr( 'menu_order' ); ?>" <?php selected( $cg_listing_order_by, 'menu_order' ); ?>><?php esc_html_e('Post Order', 'hm-car-listings'); ?></option>
                </select>
            </td>
            <th scope="row">
                <label for="cg_listing_order"><?php esc_html_e('Order', 'hm-car-listings'); ?></label>
            </th>
            <td>
                <input type="radio" name="cg_listing_order" id="cg_listing_order_asc" value="ASC" <?php echo ( 'DESC' !== $cg_listing_order ) ? 'checked' : ''; ?> >
                <label for="cg_listing_order_asc"><span></span><?php esc_html_e( 'Ascending', 'hm-car-listings' ); ?></label>
                &nbsp;&nbsp;
                <input type="radio" name="cg_listing_order" id="cg_listing_order_desc" value="DESC" <?php echo ( 'DESC' === $cg_listing_order ) ? 'checked' : ''; ?> >
                <label for="cg_listing_order_desc"><span></span><?php esc_html_e( 'Descending', 'hm-car-listings' ); ?></label>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateListingContent" name="updateListingContent" class="button button-primary cg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php esc_html_e('Save Settings', 'hm-car-listings'); ?>
        </button>
    </p>

</form>