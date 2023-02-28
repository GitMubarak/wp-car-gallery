<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$cg_list_layout = isset( $cgAttr['layout'] ) ? $cgAttr['layout'] : 'grid';

// Main Query Arguments
$cgQueryArrParams = array(
    'post_type'   => 'car',
    'post_status' => 'publish',
    'orderby'     => 'date',
    'order'       => 'DESC',
    'meta_query'  => array(
        array(
            'key'     => 'cg_status',
            'value'   => 'active',
            'compare' => '='
        ),
    ),
);

$cgQueryArr = apply_filters( 'cg_listing_query_array', $cgQueryArrParams );

$cgCars = new WP_Query( $cgQueryArr );
?>
<div class="cg-listing-body-container <?php esc_attr_e( $cg_list_layout ) ?>">
<?php
if ( $cgCars->have_posts() ) {

    while ( $cgCars->have_posts() ) {

        $cgCars->the_post();
        $cg_img 	= CG_ASSETS . 'img/no-image.jpg';

        if ( has_post_thumbnail() ) {
            $cg_img = get_the_post_thumbnail_url( $post->ID,'full' );
        }
        ?>
        <div class="cg-item">
            <div class="cg-car-image">
                <img src="<?php echo esc_url( $cg_img ); ?>" alt="<?php _e( 'No Image Available', 'wp-car-gallery' ); ?>">
            </div>
            <h3 class="cg-car-name"><a href="<?php the_permalink(); ?>" class="cg-car-name"><?php the_title(); ?></a></h3>
        </div>
        <?php
    }
}
else {
    ?>
    <p class="cg-no-jobs-found"><?php _e('No cARS found', 'wp-car-gallery'); ?></p>
    <?php
}
  
// Reset Post Data
wp_reset_postdata();
?>
</div>