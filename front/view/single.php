<?php
/**
 * Template: single.php
 * * Note: No loop wrapper needed! The global $post is already set up.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once CG_PATH . 'front/cls-cg-front.php';
$cg_front = new CG_Front(CG_VERSION);

$cgGeneralSettings = $cg_front->cg_get_general_settings();

foreach ( $cgGeneralSettings as $option_name => $option_value ) {
    if ( isset( $cgGeneralSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}

$cgSingleContent = $cg_front->cg_get_single_content_settings();

foreach ( $cgSingleContent as $option_name => $option_value ) {
    if ( isset( $cgSingleContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}

$cgSingleStyles = $cg_front->cg_get_single_styles_settings();

foreach ( $cgSingleStyles as $option_name => $option_value ) {
    if ( isset( $cgSingleStyles[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}

$cg_engine_type		= get_post_meta( get_the_ID(), 'cg_engine_type', true );
$cg_engine_size	    = get_post_meta( get_the_ID(), 'cg_engine_size', true );
$cg_year			= get_post_meta( get_the_ID(), 'cg_year', true );
$cg_car_price		= get_post_meta( get_the_ID(), 'cg_car_price', true );
$cg_car_mileage		= get_post_meta( get_the_ID(), 'cg_car_mileage', true );
$cg_car_color		= get_post_meta( get_the_ID(), 'cg_car_color', true );
$cg_car_condition   = get_post_meta( get_the_ID(), 'cg_car_condition', true );
$cg_car_transmission    = get_post_meta( get_the_ID(), 'cg_car_transmission', true );
$cg_car_drive_type  = get_post_meta( get_the_ID(), 'cg_car_drive_type', true );

$car_make          = wp_get_post_terms( get_the_ID(), 'car_make', array('fields' => 'all') );
$car_model         = wp_get_post_terms( get_the_ID(), 'car_model', array('fields' => 'all') );
$car_fuel          = wp_get_post_terms( get_the_ID(), 'car_fuel', array('fields' => 'all') );
$car_body          = wp_get_post_terms( get_the_ID(), 'body_type', array('fields' => 'all') );

$cg_tel_number    = preg_replace( '/[^\d+]/', '', $cg_contact_seller_tel );
$cg_currency_sym = substr( $cg_car_currency, strrpos( $cg_car_currency, '-' ) + 1 );

// Load Styling
include CG_PATH . 'assets/css/single.php';
?>
<div class="cg-container">
    
    <a class="cg-back-link top"
        href="javascript:history.back();">
        &larr; <?php esc_html_e( 'Back to Listings', 'wp-car-gallery' ); ?>
    </a>

    <?php
    if ( $cg_single_show_car_title ) {
        ?>
        <header class="cg-heading">
            <div>
                <h1><?php echo esc_html( get_the_title() ); ?></h1>
            </div>
        </header>
        <?php
    }
    ?>

    <div class="cg-layout">

        <main class="cg-main">

            <section class="cg-panel">
                <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail(
                        'large',
                        array(
                            'class' => 'cg-gallery-main',
                            'alt'   => the_title_attribute(
                                array( 'echo' => false )
                            ),
                        )
                    );
                }
                ?>
            </section>

            <?php
            if ( ! $cg_single_hide_overview ) {
                ?>
                <section class="cg-panel">
                    <h3 class="cg-section-title"><?php esc_html_e('Overview', 'wp-car-gallery'); ?></h3>
                    <?php echo wp_kses_post( $content ); ?>
                </section>
                <?php
            }
            ?>

            <section class="cg-panel">
                <h3 class="cg-section-title"><?php esc_html_e('Key Specifications', 'wp-car-gallery'); ?></h3>
                <div class="cg-detail-list">
                    <?php
                    if ( ! empty( $car_make ) ) {
                        $car_make_arr = [];
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Make', 'wp-car-gallery'); ?></span>
                            <span>
                                <?php
                                foreach( $car_make as $make ) {
                                    $car_make_arr[] = $make->name;
                                }

                                echo esc_html( implode( ', ', $car_make_arr ) );
                                ?>
                            </span>
                        </div>
                        <?php
                    }

                    // Model
                    if ( ! empty( $car_model ) ) {
                        $car_model_arr = [];
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Model', 'wp-car-gallery'); ?></span>
                            <span>
                                <?php
                                foreach( $car_model as $model ) {
                                    $car_model_arr[] = $model->name;
                                }

                                echo esc_html( implode( ', ', $car_model_arr ) );
                                ?>
                            </span>
                        </div>
                        <?php
                    }

                    // Year
                    if ( '' !== $cg_year ) {
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Year', 'wp-car-gallery'); ?></span>
                            <span><?php echo esc_html( $cg_year ); ?></span>
                        </div>
                        <?php
                    }

                    // Price
                    if ( '' !== $cg_car_price ) {
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Price', 'wp-car-gallery'); ?></span>
                            <span><?php echo esc_html( $cg_currency_sym ) . number_format( esc_html( $cg_car_price ) ); ?></span>
                        </div>
                        <?php
                    }

                    // Mileage
                    if ( '' !== $cg_car_mileage ) {
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Mileage', 'wp-car-gallery'); ?></span>
                            <span><?php echo number_format( esc_html( $cg_car_mileage ) ) . '&nbsp;km'; ?></span>
                        </div>
                        <?php
                    }

                    // Fuel Type
                    if ( ! empty( $car_fuel ) ) {
                        $car_fuel_arr = [];
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Fuel Type', 'wp-car-gallery'); ?></span>
                            <span>
                                <?php
                                foreach( $car_fuel as $fuel ) {
                                    $car_fuel_arr[] = $fuel->name;
                                }

                                echo esc_html( implode( ', ', $car_fuel_arr ) );
                                ?>
                            </span>
                        </div>
                        <?php
                    }

                    // Transmission
                    if ( '' !== $cg_car_transmission ) {
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Transmission', 'wp-car-gallery'); ?></span>
                            <span><?php echo esc_html( ucfirst( $cg_car_transmission ) ); ?></span>
                        </div>
                        <?php
                    }

                    // Engine
                    if ( '' !== $cg_engine_size ) {
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Engine', 'wp-car-gallery'); ?></span>
                            <span><?php echo esc_html( ucfirst( $cg_engine_size ) ); ?>&nbsp;CC</span>
                        </div>
                        <?php
                    }

                    // Body Type
                    if ( ! empty( $car_body ) ) {
                        $car_body_arr = [];
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Body Type', 'wp-car-gallery'); ?></span>
                            <span>
                                <?php
                                foreach( $car_body as $body ) {
                                    $car_body_arr[] = $body->name;
                                }

                                echo esc_html( implode( ', ', $car_body_arr ) );
                                ?>
                            </span>
                        </div>
                        <?php
                    }

                    // Exterior Color
                    if ( '' !== $cg_car_color ) {
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Exterior Color', 'wp-car-gallery'); ?></span>
                            <span><?php echo esc_html( ucfirst( $cg_car_color ) ); ?></span>
                        </div>
                        <?php
                    }

                    // Condition
                    if ( '' !== $cg_car_condition ) {
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Condition', 'wp-car-gallery'); ?></span>
                            <span><?php echo esc_html( ucfirst( $cg_car_condition ) ); ?></span>
                        </div>
                        <?php
                    }

                    // Drive Type
                    if ( '' !== $cg_car_drive_type ) {
                        ?>
                        <div class="cg-detail-row">
                            <span><?php esc_html_e('Drive Type', 'wp-car-gallery'); ?></span>
                            <span><?php echo esc_html( ucfirst( $cg_car_drive_type ) ); ?></span>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </section>

        </main>

        <aside class="cg-sidebar">

            <section class="cg-panel">
                <?php
                if ( '' !== $cg_car_price ) {
                    ?>
                    <div class="cg-price">
                        <?php echo esc_html( $cg_currency_sym ) . number_format( esc_html( $cg_car_price ) ); ?>
                    </div>
                    <?php
                }
                ?>
                <div class="cg-specs">
                    <?php
                    // Year
                    if ( '' !== $cg_year ) {
                        ?>
                        <div class="cg-spec">
                            <strong><?php echo esc_html( $cg_year ); ?></strong>
                            <span><?php esc_html_e('Year', 'wp-car-gallery'); ?></span>
                        </div>
                        <?php
                    }

                    // Mileage
                    if ( '' !== $cg_car_mileage ) {
                        ?>
                        <div class="cg-spec">
                            <strong><?php echo number_format( esc_html( $cg_car_mileage ) ) . '&nbsp;km'; ?></strong>
                            <span><?php esc_html_e('Mileage', 'wp-car-gallery'); ?></span>
                        </div>
                        <?php
                    }

                    // Fuel Type
                    if ( ! empty( $car_fuel ) ) {
                        $car_fuel_arr = [];
                        ?>
                        <div class="cg-spec">
                            <strong>
                                <?php
                                foreach( $car_fuel as $fuel ) {
                                    $car_fuel_arr[] = $fuel->name;
                                }

                                echo esc_html( implode( ', ', $car_fuel_arr ) );
                                ?>
                            </strong>
                            <span><?php esc_html_e('Fuel Type', 'wp-car-gallery'); ?></span>
                        </div>
                        <?php
                    }

                    // Transmission
                    if ( '' !== $cg_car_transmission ) {
                        ?>
                        <div class="cg-spec">
                            <strong><?php echo esc_html( ucfirst( $cg_car_transmission ) ); ?></strong>
                            <span><?php esc_html_e('Transmission', 'wp-car-gallery'); ?></span>
                        </div>
                        <?php
                    }

                    // Engine
                    if ( '' !== $cg_engine_size ) {
                        ?>
                        <div class="cg-spec">
                            <strong><?php echo esc_html( ucfirst( $cg_engine_size ) ); ?>&nbsp;CC</strong>
                            <span><?php esc_html_e('Engine', 'wp-car-gallery'); ?></span>
                        </div>
                        <?php
                    }

                    // Body Type
                    if ( ! empty( $car_body ) ) {
                        $car_body_arr = [];
                        ?>
                        <div class="cg-spec">
                            <strong>
                                <?php
                                foreach( $car_body as $body ) {
                                    $car_body_arr[] = $body->name;
                                }

                                echo esc_html( implode( ', ', $car_body_arr ) );
                                ?>
                            </strong>
                            <span><?php esc_html_e('Body Type', 'wp-car-gallery'); ?></span>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                
                <?php
                if ( ! $cg_single_hide_contact_seller ) {
                    ?>
                    <a class="cg-button" href="<?php echo esc_url( 'mailto:' . sanitize_email( $cg_contact_seller_email ) ); ?>">
                        <i class="fa-regular fa-envelope"></i>&nbsp;
                        <?php esc_html_e('Contact Seller', 'wp-car-gallery'); ?>
                    </a>
                    <?php
                }

                if ( ! $cg_single_hide_call_seller ) {
                    ?>
                    <a class="cg-button cg-button-secondary" href="<?php echo esc_url( 'tel:' . $cg_tel_number ); ?>">
                        <i class="fa-solid fa-phone"></i>&nbsp;
                        <?php esc_html_e('Call Seller', 'wp-car-gallery'); ?>
                    </a>
                    <?php
                }
                ?>
            
            </section>

        </aside>
        
    </div>

    <a class="cg-back-link bottom"
        href="javascript:history.back();">
        &larr; <?php esc_html_e( 'Back to Listings', 'wp-car-gallery' ); ?>
    </a>

</div>