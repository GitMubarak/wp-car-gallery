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
            'key'     => 'cg_listing_status',
            'value'   => 'active',
            'compare' => '='
        ),
    ),
);

$cgQueryArr = apply_filters( 'cg_listing_query_array', $cgQueryArrParams );

$cgCars = new WP_Query( $cgQueryArr );
?>
<div class="cg-listing-parent-container">
    <?php
    if ( $cgCars->have_posts() ) {
        ?>
        <div class="cg-listing-grid-body-container">
            <?php
            while ( $cgCars->have_posts() ) {

                $cgCars->the_post();
                
                $cg_engine_type		= get_post_meta( $post->ID, 'cg_engine_type', true );
                $cg_engine_size	    = get_post_meta( $post->ID, 'cg_engine_size', true );
                $cg_year			= get_post_meta( $post->ID, 'cg_year', true );
                $cg_car_price		= get_post_meta( $post->ID, 'cg_car_price', true );
                $cg_car_mileage		= get_post_meta( $post->ID, 'cg_car_mileage', true );
                $cg_car_color		= get_post_meta( $post->ID, 'cg_car_color', true );
                $cg_car_condition   = get_post_meta( $post->ID, 'cg_car_condition', true );
                $cg_car_transmission    = get_post_meta( $post->ID, 'cg_car_transmission', true );
                $cg_car_drive_type  = get_post_meta( $post->ID, 'cg_car_drive_type', true );

                $car_fuel          = wp_get_post_terms( $post->ID, 'car_fuel', array('fields' => 'all') );
                
                $cg_img 	= CG_ASSETS . 'img/no-image.jpg';

                if ( has_post_thumbnail() ) {
                    $cg_img = get_the_post_thumbnail_url( $post->ID,'full' );
                }
                ?>
                <div class="cg-grid-item">

                    <div class="cg-car-image">
                        <img src="<?php echo esc_url( $cg_img ); ?>" alt="<?php _e( 'No Image Available', 'wp-car-gallery' ); ?>">
                    </div>
                    
                    <h3 class="cg-car-name">
                        <a href="<?php the_permalink(); ?>" class="cg-car-name-link"><?php the_title(); ?></a>
                    </h3>

                    <ul class="cg-car-specifications">

                        <li>
                            <a href="#">
                                <span class="cg-specification-icon"><i class="fas fa-car"></i></span>
                                <?php _e('Price', 'wp-car-gallery'); ?> - <?php _e('$', 'wp-car-gallery'); ?><?php echo number_format( esc_html( $cg_car_price ) ); ?>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <span class="cg-specification-icon"><i class="fa-solid fa-gauge-high"></i></span>
                                <?php _e('Mileage', 'wp-car-gallery'); ?> - <?php echo number_format( esc_html( $cg_car_mileage ) ); ?>&nbsp;<?php _e('km', 'wp-car-gallery'); ?>
                            </a>
                        </li>

                        <?php
                        if ( ! empty( $car_fuel ) ) {
                            $car_fuel_arr = [];
                            ?>
                            <li>
                                <a href="#">
                                    <span class="cg-specification-icon"><i class="fas fa-gas-pump"></i></span>
                                    <?php _e('Fuel', 'wp-car-gallery'); ?> - 
                                    <?php
                                    foreach( $car_fuel as $fuel ) {
                                        $car_fuel_arr[] = $fuel->name . '';
                                    }
                                    echo implode( ', ', $car_fuel_arr );
                                    ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>

                        <li>
                            <a href="#">
                                <span class="cg-specification-icon"><i class="fas fa-car"></i></span>
                                <?php _e('Transmission', 'wp-car-gallery'); ?> - <?php esc_html_e( $cg_car_transmission ); ?>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <span class="cg-specification-icon"><i class="fas fa-car"></i></span>
                                <?php _e('Engine', 'wp-car-gallery'); ?> - <?php esc_html_e( $cg_engine_size ); ?>&nbsp;<?php _e('CC', 'wp-car-gallery'); ?>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <span class="cg-specification-icon"><i class="fas fa-paint-roller"></i></span>
                                <?php _e('Color', 'wp-car-gallery'); ?> - <?php esc_html_e( $cg_car_color ); ?>
                            </a>
                        </li>

                    </ul>

                    <a href="<?php the_permalink(); ?>" class="cg-view-details-button">
                        <?php _e('View Details', 'wp-car-gallery'); ?> →
                    </a>
                
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    else {
        ?>
        <p class="cg-no-jobs-found"><?php _e('No Cars found', 'wp-car-gallery'); ?></p>
        <?php
    }
    
    // Reset Post Data
    wp_reset_postdata();
    ?>
    </div>
</div>