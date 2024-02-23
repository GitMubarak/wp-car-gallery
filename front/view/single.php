<?php
get_header();

global $post;

if ( have_posts() ) {
?>
<div class="cg-single-body-container">
<?php 
while ( have_posts() ) {
    
    the_post();

    $cg_img 	= CG_ASSETS . 'img/no-image.jpg';

    if ( has_post_thumbnail() ) {
        $cg_img = get_the_post_thumbnail_url( $post->ID,'full' );
    }
    ?>
    <div class="cg-details-container clear">
        <div class="cg-single-image-container left-cell">
            <img src="<?php echo esc_url( $cg_img ); ?>" alt="<?php _e( 'No Image Available', 'wp-car-gallery' ); ?>">
        </div>
        <div class="cg-single-description right-cell">
            <h3 class="cg-single-car-name"><?php the_title(); ?></h3>
            <div class="cg-car-des">
                <?php the_content(); ?>
            </div>
        </div>
        <div class="cg-specification-container clear">
            <table class="form-table cg-specification">
                <tr>
                    <th colspan="2"><?php _e('Engine Specification', 'wp-car-gallery'); ?></th>
                </tr>
                <tr>
                    <th>
                        <label><?php _e('Engine Type', 'wp-car-gallery'); ?></label>
                    </th>
                    <td>
                        Petrol
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php 
}
?>
</div>
<?php
} // if ( have_posts() ) {
    
get_footer(); 
?>