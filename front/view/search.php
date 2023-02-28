<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Search Items
$cg_title        =  isset( $_GET['cg_title'] ) ? sanitize_text_field( $_GET['cg_title'] ) : '';
$cg_category_s   =  isset( $_GET['cg_category_s'] ) ? sanitize_text_field( $_GET['cg_category_s'] ) : '';
$cg_type_s       =  isset( $_GET['cg_type_s'] ) ? sanitize_text_field( $_GET['cg_type_s'] ) : '';
$cg_location_s   =  isset( $_GET['cg_location_s'] ) ? sanitize_text_field( $_GET['cg_location_s'] ) : '';

// Search Query Ttitle
if ( '' != $cg_title ) {
    $cgQueryArrParams['s'] = $cg_title;
}

// Search Query Category
if ( '' !== $cg_category_s ) {
    $cgQueryArrParams['tax_query'] = array(
        array(
            'taxonomy' => 'jobs_category',
            'field' => 'name',
            'terms' => urldecode ( $cg_category_s )
        )
    );
}

// Search Query Job Type
if ( '' !== $cg_type_s ) {
    $cgQueryArrParams['tax_query'] = array(
        array(
            'taxonomy' => 'jobs_nature',
            'field' => 'name',
            'terms' => urldecode ( $cg_type_s )
        )
    );
}

// Search by location
if ( '' !== $cg_location_s ) {
    $cgQueryArrParams['tax_query'] = array(
        array(
            'taxonomy' => 'jobs_location',
            'field' => 'name',
            'terms' => urldecode ( $cg_location_s )
        )
    );
}

$cg_categories   = get_terms( array( 'taxonomy' => 'jobs_category', 'hide_empty' => true, 'order' => 'ASC',  'parent' => 0 ) );
$cg_types        = get_terms( array( 'taxonomy' => 'jobs_nature', 'hide_empty' => true, 'order' => 'ASC',  'parent' => 0 ) );
$cg_locations    = get_terms( array( 'taxonomy' => 'jobs_location', 'hide_empty' => true, 'order' => 'ASC',  'parent' => 0 ) );
?>
<form method="GET" action="<?php echo get_permalink( $post->ID ); ?>" id="cg-search-form">

    <div class="cg-search-container">
        
        <div class="cg-search-item">
            <input type="text" name="cg_title" placeholder="<?php _e( 'Keyword', JOBWP_TXT_DOMAIN ); ?>" value="<?php esc_attr_e( $cg_title ); ?>">
        </div>

        <div class="cg-search-item">
            <select id="cg_category_s" name="cg_category_s">
                <option value=""><?php _e( 'All Job Category', JOBWP_TXT_DOMAIN ); ?></option>
                <?php
                foreach ( $cg_categories as $job_category ) {
                    ?>
                    <option value="<?php esc_attr_e( $job_category->name ); ?>" <?php echo ( $cg_category_s == $job_category->name ) ? 'Selected' : ''; ?>><?php esc_html_e( $job_category->name ); ?></option>
                    <?php 
                } 
                ?>
            </select>
        </div>

        <div class="cg-search-item">
            <select id="cg_type_s" name="cg_type_s">
                <option value=""><?php _e( 'All Job Type', JOBWP_TXT_DOMAIN ); ?></option>
                <?php
                foreach ( $cg_types as $cg_type ) {
                    ?>
                    <option value="<?php esc_attr_e( $cg_type->name ); ?>" <?php echo ( $cg_type_s == $cg_type->name ) ? 'Selected' : ''; ?>><?php esc_html_e( $cg_type->name ); ?></option>
                    <?php 
                } 
                ?>
            </select>
        </div>

        <div class="cg-search-item">
            <select id="cg_location_s" name="cg_location_s">
                <option value=""><?php _e( 'All Job Location', JOBWP_TXT_DOMAIN ); ?></option>
                <?php
                foreach ( $cg_locations as $job_location ) {
                    ?>
                    <option value="<?php esc_attr_e( $job_location->name ); ?>" <?php echo ( $cg_location_s == $job_location->name ) ? 'Selected' : ''; ?>><?php esc_html_e( $job_location->name ); ?></option>
                    <?php 
                } 
                ?>
            </select>
        </div>

        <div class="cg-search-item">
            <input type="submit" class="button submit-btn" value="<?php _e( 'Search Job', JOBWP_TXT_DOMAIN ); ?>">
        </div>

        <div class="cg-search-item">
            <a href="<?php echo get_permalink( $post->ID ); ?>" class="fa fa-refresh" id="cg-search-refresh"></a>
        </div>
    
    </div>

</form>