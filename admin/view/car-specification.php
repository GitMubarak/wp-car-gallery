<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$cg_engine_type		= get_post_meta( $post->ID, 'cg_engine_type', true );
$cg_engine_size	    = get_post_meta( $post->ID, 'cg_engine_size', true );
$cg_year			= get_post_meta( $post->ID, 'cg_year', true );
$cg_car_price		= get_post_meta( $post->ID, 'cg_car_price', true );
$cg_car_mileage		= get_post_meta( $post->ID, 'cg_car_mileage', true );
$cg_car_color		= get_post_meta( $post->ID, 'cg_car_color', true );
$cg_car_condition   = get_post_meta( $post->ID, 'cg_car_condition', true );
$cg_car_transmission    = get_post_meta( $post->ID, 'cg_car_transmission', true );
$cg_car_drive_type  = get_post_meta( $post->ID, 'cg_car_drive_type', true );
$cg_listing_status  = get_post_meta( $post->ID, 'cg_listing_status', true );

wp_nonce_field( 'cg_car_specification_action', 'cg_car_specification_nonce_fields' );
?>
<table class="form-table cg-specification">
    <tr>
        <th scope="row">
            <label><?php _e('Engine Type / Technology', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="text" name="cg_engine_type" value="<?php esc_attr_e( $cg_engine_type ); ?>" class="regular-text">
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Engine Size (CC)', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="number" min="1" step="1" name="cg_engine_size" value="<?php esc_attr_e( $cg_engine_size ); ?>" class="regular-text">
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Year', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="number" min="1900" max="<?php echo gmdate('Y')+1; ?>" step="1" name="cg_year" value="<?php esc_attr_e( $cg_year ); ?>" class="regular-text">
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Price', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="number" min="0" step="1" name="cg_car_price" value="<?php esc_attr_e( $cg_car_price ); ?>" class="regular-text">
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Mileage (km)', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="number" min="0" step="1" name="cg_car_mileage" value="<?php esc_attr_e( $cg_car_mileage ); ?>" class="regular-text">
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Color', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="text" name="cg_car_color" value="<?php esc_attr_e( $cg_car_color ); ?>" class="regular-text">
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="cg_car_condition"><?php _e('Condition', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="radio" name="cg_car_condition" class="cg_car_condition" id="cg_car_condition_new" value="new" 
                <?php echo ( 'new' == esc_attr( $cg_car_condition ) ) ? 'checked' : ''; ?> >
            <label for="cg_car_condition_new"><span></span><?php _e( 'New', 'wp-car-gallery' ); ?></label>
            &nbsp;&nbsp;
            <input type="radio" name="cg_car_condition" class="cg_car_condition" id="cg_car_condition_used" value="used" 
                <?php echo ( 'used' === esc_attr( $cg_car_condition ) ) ? 'checked' : ''; ?> >
            <label for="cg_car_condition_used"><span></span><?php _e( 'Used', 'wp-car-gallery' ); ?></label>
            &nbsp;&nbsp;
            <input type="radio" name="cg_car_condition" class="cg_car_condition" id="cg_car_condition_pre_owned" value="pre-owned" 
                <?php echo ( 'pre-owned' === esc_attr( $cg_car_condition ) ) ? 'checked' : ''; ?> >
            <label for="cg_car_condition_pre_owned"><span></span><?php _e( 'Certified Pre-Owned', 'wp-car-gallery' ); ?></label>
            &nbsp;&nbsp;
            <input type="radio" name="cg_car_condition" class="cg_car_condition" id="cg_car_condition_reconditioned" value="reconditioned" 
                <?php echo ( 'reconditioned' === esc_attr( $cg_car_condition ) ) ? 'checked' : ''; ?> >
            <label for="cg_car_condition_reconditioned"><span></span><?php _e( 'Reconditioned', 'wp-car-gallery' ); ?></label>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="cg_car_transmission"><?php _e('Transmission', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="radio" name="cg_car_transmission" class="cg_car_transmission" id="cg_car_transmission_automatic" value="automatic" 
                <?php echo ( 'automatic' == esc_attr( $cg_car_transmission ) ) ? 'checked' : ''; ?> >
            <label for="cg_car_transmission_automatic"><span></span><?php _e( 'Automatic', 'wp-car-gallery' ); ?></label>
            &nbsp;&nbsp;
            <input type="radio" name="cg_car_transmission" class="cg_car_transmission" id="cg_car_transmission_manual" value="manual" 
                <?php echo ( 'manual' === esc_attr( $cg_car_transmission ) ) ? 'checked' : ''; ?> >
            <label for="cg_car_transmission_manual"><span></span><?php _e( 'Manual', 'wp-car-gallery' ); ?></label>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="cg_car_drive_type"><?php _e('Drive Type', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="radio" name="cg_car_drive_type" class="cg_car_drive_type" id="cg_car_drive_type_fwd" value="fwd" 
                <?php echo ( 'fwd' == esc_attr( $cg_car_drive_type ) ) ? 'checked' : ''; ?> >
            <label for="cg_car_drive_type_fwd"><span></span><?php _e( 'FWD', 'wp-car-gallery' ); ?></label>
            &nbsp;&nbsp;
            <input type="radio" name="cg_car_drive_type" class="cg_car_drive_type" id="cg_car_drive_type_rwd" value="rwd" 
                <?php echo ( 'rwd' === esc_attr( $cg_car_drive_type ) ) ? 'checked' : ''; ?> >
            <label for="cg_car_drive_type_rwd"><span></span><?php _e( 'RWD', 'wp-car-gallery' ); ?></label>
            &nbsp;&nbsp;
            <input type="radio" name="cg_car_drive_type" class="cg_car_drive_type" id="cg_car_drive_type_awd" value="awd" 
                <?php echo ( 'awd' === esc_attr( $cg_car_drive_type ) ) ? 'checked' : ''; ?> >
            <label for="cg_car_drive_type_awd"><span></span><?php _e( 'AWD', 'wp-car-gallery' ); ?></label>
            &nbsp;&nbsp;
            <input type="radio" name="cg_car_drive_type" class="cg_car_drive_type" id="cg_car_drive_type_4wd" value="4wd" 
                <?php echo ( '4wd' === esc_attr( $cg_car_drive_type ) ) ? 'checked' : ''; ?> >
            <label for="cg_car_drive_type_4wd"><span></span><?php _e( '4WD', 'wp-car-gallery' ); ?></label>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="cg_listing_status"><?php _e('Listing Status', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="radio" name="cg_listing_status" class="cg_listing_status" id="cg_listing_status_active" value="active" 
                <?php echo ( 'inactive' !== esc_attr( $cg_listing_status ) ) ? 'checked' : ''; ?> >
            <label for="cg_listing_status_active"><span></span><?php _e( 'Active', 'wp-car-gallery' ); ?></label>
            &nbsp;&nbsp;
            <input type="radio" name="cg_listing_status" class="cg_listing_status" id="cg_listing_status_inactive" value="inactive" 
                <?php echo ( 'inactive' === esc_attr( $cg_listing_status ) ) ? 'checked' : ''; ?> >
            <label for="cg_listing_status_inactive"><span></span><?php _e( 'Inactive', 'wp-car-gallery' ); ?></label>
        </td>
    </tr>
</table>