<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<table class="form-table cg-specification">
    <tr>
        <th scope="row" colspan="2" style="background-color: #EAEAEA;"><?php _e('Engine Specification', 'wp-car-gallery'); ?></th>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Engine Type', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="text" name="cg_engine_type" value="<?php esc_attr_e( $cg_engine_type ); ?>" class="regular-text">
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Displacement (Cc)', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="number" min="1" max="200000" step="1" name="cg_displacement" value="<?php esc_attr_e( $cg_displacement ); ?>" class="regular-text">
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label><?php _e('Year', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <select name="cg_year" class="medium-text">
                <option value=""><?php _e('Select Year', 'wp-car-gallery'); ?></option>
                <?php
                for ( $i = date('Y'); $i >= 2000; $i-- ) {
                    ?>
                    <option value="<?php esc_attr_e( $i ); ?>" <?php echo ( $i == $cg_year ) ? 'selected' : ''; ?> ><?php printf('%d', $i); ?></option>
                    <?php
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="cg_status"><?php _e('Status', 'wp-car-gallery'); ?></label>
        </th>
        <td>
            <input type="radio" name="cg_status" class="cg_status" id="cg_status_active" value="active" <?php echo ( 'inactive' !== esc_attr( $cg_status ) ) ? 'checked' : ''; ?> >
            <label for="cg_status_active"><span></span><?php _e( 'Active', 'wp-car-gallery' ); ?></label>
            &nbsp;&nbsp;
            <input type="radio" name="cg_status" class="cg_status" id="cg_status_inactive" value="inactive" <?php echo ( 'inactive' === esc_attr( $cg_status ) ) ? 'checked' : ''; ?> >
            <label for="cg_status_inactive"><span></span><?php _e( 'Inactive', 'wp-car-gallery' ); ?></label>
        </td>
    </tr>
</table>