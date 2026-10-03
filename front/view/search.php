<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Search Items
$cg_title        =  isset( $_GET['cg_title'] ) ? sanitize_text_field( $_GET['cg_title'] ) : '';

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

$cg_categories   = get_terms( array( 'taxonomy' => 'jobs_category', 'hide_empty' => true, 'order' => 'ASC',  'parent' => 0 ) );
?>
<form method="GET" action="<?php echo get_permalink( $post->ID ); ?>" id="cg-search-form">

    <div class="cg-search-container">
        
        <div class="cg-search-item">
            <input type="text" name="cg_title" placeholder="<?php _e( 'Keyword', 'wp-car-gallery' ); ?>" value="<?php esc_attr_e( $cg_title ); ?>">
        </div>

        <div class="cg-search-item">
            <select id="cg_category_s" name="cg_category_s">
                <option value=""><?php _e( 'All Job Category', 'wp-car-gallery' ); ?></option>
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
            <input type="submit" class="button submit-btn" value="<?php _e( 'Search Job', 'wp-car-gallery' ); ?>">
        </div>

        <div class="cg-search-item">
            <a href="<?php echo get_permalink( $post->ID ); ?>" class="fa fa-refresh" id="cg-search-refresh"></a>
        </div>
    
    </div>

</form>