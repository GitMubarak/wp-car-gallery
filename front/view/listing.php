<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$cgGeneralSettings = $this->cg_get_general_settings();

foreach ( $cgGeneralSettings as $option_name => $option_value ) {
    if ( isset( $cgGeneralSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}

$cgListingContent = $this->cg_get_listing_content_settings();

foreach ( $cgListingContent as $option_name => $option_value ) {
    if ( isset( $cgListingContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}

$cg_currency_symbol = substr( $cg_car_currency, strrpos( $cg_car_currency, '-' ) + 1 );

// For Pagination
if ( is_front_page() ) {
    $cg_paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
} else {
    $cg_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
}

$cg_display_limit       = isset( $cgAttr['limit'] ) ? max( 1, absint( $cgAttr['limit'] ) ) : $cg_listing_limit;
$cg_listing_order_by    = isset( $cgAttr['order_by'] ) ? sanitize_key( $cgAttr['order_by'] ) : $cg_listing_order_by;
$cg_listing_order       = isset( $cgAttr['order'] ) ? strtoupper( sanitize_key( $cgAttr['order'] ) ) : $cg_listing_order;

if ( ! in_array( $cg_listing_order_by, array( 'date', 'title', 'menu_order' ), true ) ) {
    $cg_listing_order_by = 'date';
}

if ( ! in_array( $cg_listing_order, array( 'ASC', 'DESC' ), true ) ) {
    $cg_listing_order = 'DESC';
} else {
    $cg_listing_order = strtoupper( $cg_listing_order );
}

// Main Query Arguments
$cgQueryArrParams = array(
    'post_type'   => 'car',
    'post_status' => 'publish',
    'orderby'     => $cg_listing_order_by,
    'order'       => $cg_listing_order,
    'posts_per_page' => $cg_display_limit,
    'paged'          => $cg_paged,
    'meta_query'  => array(
        array(
            'key'     => 'cg_listing_status',
            'value'   => 'active',
            'compare' => '='
        ),
    ),
    'tax_query'         => array(
        'relation' => 'AND',
    ),
);

$cgQueryArr = apply_filters( 'cg_listing_query_array', $cgQueryArrParams );
?>
<div class="cg-listing-parent-container">
    <?php
    include 'search.php';

    $cgCars = new WP_Query( $cgQueryArr );

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

                $car_fuel          = wp_get_post_terms( $post->ID, 'hmcg_car_fuel', array('fields' => 'all') );
                
                $cg_img = CG_ASSETS . 'img/no-image.jpg';

                if ( has_post_thumbnail() ) {
                    $cg_img = get_the_post_thumbnail_url( $post->ID,'full' );
                }
                ?>
                <div class="cg-grid-item">

                    <div class="cg-car-image">
                        <img src="<?php echo esc_url( $cg_img ); ?>" alt="<?php esc_html_e( 'No Image Available', 'hm-car-listings' ); ?>">
                    </div>
                    
                    <h3 class="cg-car-name">
                        <a href="<?php the_permalink(); ?>" class="cg-car-name-link"><?php the_title(); ?></a>
                    </h3>

                    <ul class="cg-car-specifications">

                        <?php
                        if ( '' != $cg_car_price ) {
                            ?>
                            <li>
                                <a href="#">
                                    <span class="cg-specification-icon"><i class="fas fa-car"></i></span>
                                    <?php esc_html_e('Price', 'hm-car-listings'); ?> – <?php echo esc_html( $cg_currency_symbol ); ?><?php echo number_format( esc_html( $cg_car_price ) ); ?>
                                </a>
                            </li>
                            <?php
                        }

                        if ( '' != $cg_car_mileage ) {
                            ?>
                            <li>
                                <a href="#">
                                    <span class="cg-specification-icon"><i class="fa-solid fa-gauge-high"></i></span>
                                    <?php esc_html_e('Mileage', 'hm-car-listings'); ?> – <?php echo number_format( esc_html( $cg_car_mileage ) ); ?>&nbsp;<?php esc_html_e('km', 'hm-car-listings'); ?>
                                </a>
                            </li>
                            <?php
                        }

                        if ( ! empty( $car_fuel ) ) {
                            $car_fuel_arr = [];
                            ?>
                            <li>
                                <a href="#">
                                    <span class="cg-specification-icon"><i class="fas fa-gas-pump"></i></span>
                                    <?php esc_html_e('Fuel', 'hm-car-listings'); ?> – 
                                    <?php
                                    foreach( $car_fuel as $fuel ) {
                                        $car_fuel_arr[] = $fuel->name;
                                    }

                                    echo esc_html( implode( ', ', $car_fuel_arr ) );
                                    ?>
                                </a>
                            </li>
                            <?php
                        }

                        if ( '' != $cg_car_transmission ) {
                            ?>
                            <li>
                                <a href="#">
                                    <span class="cg-specification-icon"><i class="fas fa-car"></i></span>
                                    <?php esc_html_e('Transmission', 'hm-car-listings'); ?> – <?php echo esc_html( $cg_car_transmission ); ?>
                                </a>
                            </li>
                            <?php
                        }

                        if ( '' != $cg_engine_size ) {
                            ?>
                            <li>
                                <a href="#">
                                    <span class="cg-specification-icon"><i class="fas fa-car"></i></span>
                                    <?php esc_html_e('Engine', 'hm-car-listings'); ?> – <?php echo esc_html( $cg_engine_size ); ?>&nbsp;<?php esc_html_e('CC', 'hm-car-listings'); ?>
                                </a>
                            </li>
                            <?php
                        }

                        if ( '' != $cg_car_color ) {
                            ?>
                            <li>
                                <a href="#">
                                    <span class="cg-specification-icon"><i class="fas fa-paint-roller"></i></span>
                                    <?php esc_html_e('Color', 'hm-car-listings'); ?> – <?php echo esc_html( $cg_car_color ); ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>

                    <a href="<?php the_permalink(); ?>" class="cg-view-details-button">
                        <?php esc_html_e('View Details', 'hm-car-listings'); ?> →
                    </a>
                
                </div>
                <?php
            }
            ?>
        </div>

        <div class="cg-pagination">
            <?php
            if ( $cgCars->max_num_pages > 1 ) {
                $cgPaginateBig = 999999999; // need an unlikely integer
                $cgPaginateArgs = array(
                    'base'      => str_replace( $cgPaginateBig, '%#%', esc_url( get_pagenum_link( $cgPaginateBig ) ) ),
                    'format'    => '?page=%#%',
                    'total'     => $cgCars->max_num_pages,
                    'current'   => max( 1, $cg_paged ),
                    'end_size'  => 1,
                    'mid_size'  => 2,
                    'prev_text' => '« ',
                    'next_text' => ' »',
                    'type'      => 'list',
                );
                echo wp_kses_post( paginate_links( $cgPaginateArgs ) );
            }
            ?>
        </div>
        <?php
    }
    else {
        ?>
        <p class="cg-no-jobs-found"><?php esc_html_e('No cars found', 'hm-car-listings'); ?></p>
        <?php
    }
    
    // Reset Post Data
    wp_reset_postdata();
    ?>
</div>