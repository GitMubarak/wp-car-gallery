<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Search Items
$keyword_s	= isset( $_GET['keyword_s'] ) ? sanitize_text_field( wp_unslash( $_GET['keyword_s'] ) ) : '';
$min_price = ( isset( $_GET['min_price_s'] ) && '' !== $_GET['min_price_s'] ) ? absint( $_GET['min_price_s'] ) : '';
$max_price = ( isset( $_GET['max_price_s'] ) && '' !== $_GET['max_price_s'] ) ? absint( $_GET['max_price_s'] ) : '';
$min_year = ( isset( $_GET['min_year_s'] ) && '' !== $_GET['min_year_s'] ) ? absint( $_GET['min_year_s'] ) : '';
$max_year = ( isset( $_GET['max_year_s'] ) && '' !== $_GET['max_year_s'] ) ? absint( $_GET['max_year_s'] ) : '';

// Search Keyword
if ( '' != $keyword_s ) {

    $cgQueryArr['s'] = $keyword_s;
    // Optional: Let WordPress sort by relevancy instead of date when searching
    unset( $cgQueryArr['orderby'] ); 
    unset( $cgQueryArr['order'] );

    // NEW: Restricts the 's' keyword search strictly to the book title column
    // Works on: WordPress 6.2 or higher
    //$wbgBooksArr['search_columns'] = array( 'post_title' ); 
}

// Search Price range
if ( '' !== $min_price || '' !== $max_price ) {

    $price_query = array(
        'key'     => 'cg_car_price',
        'type'    => 'NUMERIC',
    );

    if ( '' !== $min_price && '' !== $max_price ) {

        $price_query['value']   = array( $min_price, $max_price );
        $price_query['compare'] = 'BETWEEN';

    } elseif ( '' !== $min_price ) {

        $price_query['value']   = $min_price;
        $price_query['compare'] = '>=';

    } elseif ( '' !== $max_price ) {

        $price_query['value']   = $max_price;
        $price_query['compare'] = '<=';
    }

    $cgQueryArr['meta_query'][] = $price_query;
}

if ( '' !== $min_year || '' !== $max_year ) {

    $year_query = array(
        'key'  => 'cg_year',
        'type' => 'NUMERIC',
    );

    if ( '' !== $min_year && '' !== $max_year ) {

        $year_query['value']   = array( $min_year, $max_year );
        $year_query['compare'] = 'BETWEEN';

    } elseif ( '' !== $min_year ) {

        $year_query['value']   = $min_year;
        $year_query['compare'] = '>=';

    } elseif ( '' !== $max_year ) {

        $year_query['value']   = $max_year;
        $year_query['compare'] = '<=';
    }

    $cgQueryArr['meta_query'][] = $year_query;
}

// Array for Meta query
$cg_search_meta_filters = array(
    'transmission_s'	=> 'cg_car_transmission',
    'condition_s'	=> 'cg_car_condition',
);

foreach ( $cg_search_meta_filters as $get_key => $meta_key ) {
    
    if ( isset( $_GET[ $get_key ] ) && '' !== trim( $_GET[ $get_key ] ) ) {
        
        $cg_clean_search_params[ $get_key ] = sanitize_text_field( wp_unslash( $_GET[ $get_key ] ) );

        $cgQueryArr['meta_query'][] = array(
            'key'     => $meta_key,
            'value'   => $cg_clean_search_params[ $get_key ],
            'compare' => '=',
        );

    } else {
        $cg_clean_search_params[ $get_key ] = '';
    }
}

// Array for tax query
$cg_search_tax_filters = array(
    'car_make_s'    => 'car_make',
	'car_model_s'	=> 'car_model',
	'car_fuel_s'	=> 'car_fuel',
	'car_body_type_s'	=> 'body_type',
);

foreach ( $cg_search_tax_filters as $get_key => $meta_key ) {
    
    if ( isset( $_GET[ $get_key ] ) && '' !== trim( $_GET[ $get_key ] ) ) {
        
        $cg_clean_search_params[ $get_key ] = sanitize_text_field( wp_unslash( $_GET[ $get_key ] ) );

        $cgQueryArr['tax_query'][] = array(
            'taxonomy'  => $meta_key,
            'field'     => 'slug',
            'terms'     => $cg_clean_search_params[ $get_key ],
        );

    } else {
        $cg_clean_search_params[ $get_key ] = '';
    }
}
?>
<div class="cg-search-panel">

    <form class="cg-search-form" action="<?php echo esc_url( get_permalink() ); ?>" method="get">

        <!-- Keyword -->
        <div class="cg-field cg-field-keyword">
            <label for="cg-keyword"><?php _e('Keyword', 'wp-car-gallery'); ?></label>
            <input
                type="text"
                id="cg-keyword"
                name="keyword_s"
                placeholder="Search cars..."
				value="<?php esc_attr_e( $keyword_s ); ?>"
            >
        </div>

        <!-- Make -->
        <div class="cg-field">
            <label for="cg-make"><?php _e('Make', 'wp-car-gallery'); ?></label>
            <select id="cg-make" name="car_make_s">
                <option value=""><?php _e('All Makes', 'wp-car-gallery'); ?></option>
				<?php
				$car_makes = get_terms( array( 'taxonomy' => 'car_make', 'hide_empty' => false, 'order' => 'ASC' ) );
				foreach( $car_makes as $make) {
					?>
					<option value="<?php esc_attr_e( $make->slug ); ?>" <?php selected( $cg_clean_search_params['car_make_s'], $make->slug ); ?>><?php esc_html_e( $make->name ); ?></option>
					<?php 
                }
                ?>
            </select>
        </div>

        <!-- Model -->
        <div class="cg-field">
            <label for="cg-model"><?php _e('Model', 'wp-car-gallery'); ?></label>
            <select id="cg-model" name="car_model_s">
                <option value=""><?php _e('All Models', 'wp-car-gallery'); ?></option>
				<?php
				$car_models = get_terms( array( 'taxonomy' => 'car_model', 'hide_empty' => false, 'order' => 'ASC' ) );
				foreach( $car_models as $model) {
					?>
                	<option value="<?php esc_attr_e( $model->slug ); ?>" <?php selected( $cg_clean_search_params['car_model_s'], $model->slug ); ?>><?php esc_html_e( $model->name ); ?></option>
					<?php 
                }
                ?>
            </select>
        </div>

        <!-- Price -->
        <div class="cg-field cg-price-field">
            <label><?php _e('Price', 'wp-car-gallery'); ?></label>

            <div class="cg-range-fields">
                <input
                    type="number"
                    name="min_price_s"
                    placeholder="Min price"
                    min="0"
					value="<?php esc_attr_e( $min_price ); ?>"
                >

                <span>–</span>

                <input
                    type="number"
                    name="max_price_s"
                    placeholder="Max price"
                    min="0"
					value="<?php esc_attr_e( $max_price ); ?>"
                >
            </div>
        </div>

        <!-- Year -->
        <div class="cg-field cg-year-field">
            <label><?php _e('Year', 'wp-car-gallery'); ?></label>

            <div class="cg-range-fields">
                <input
                    type="number"
                    name="min_year_s"
                    placeholder="From"
                    min="1900"
					step="1"
					value="<?php esc_attr_e( $min_year ); ?>"
                >

                <span>–</span>

                <input
                    type="number"
                    name="max_year_s"
                    placeholder="To"
                    min="1900"
					step="1"
					value="<?php esc_attr_e( $max_year ); ?>"
                >
            </div>
        </div>

        <!-- Fuel -->
        <div class="cg-field">
            <label for="cg-fuel"><?php _e('Fuel Type', 'wp-car-gallery'); ?></label>
            <select id="cg-fuel" name="car_fuel_s">
                <option value=""><?php _e('All Fuel Types', 'wp-car-gallery'); ?></option>
				<?php
				$car_fuels = get_terms( array( 'taxonomy' => 'car_fuel', 'hide_empty' => false, 'order' => 'ASC' ) );
				foreach( $car_fuels as $fuel) {
					?>
                	<option value="<?php esc_attr_e( $fuel->slug ); ?>" <?php selected( $cg_clean_search_params['car_fuel_s'], $fuel->slug ); ?>><?php esc_html_e( $fuel->name ); ?></option>
					<?php 
                }
                ?>
            </select>
        </div>

        <!-- Body Type -->
        <div class="cg-field">
            <label for="cg-body-type"><?php _e('Body Type', 'wp-car-gallery'); ?></label>
            <select id="cg-body-type" name="car_body_type_s">
                <option value=""><?php _e('All Body Types', 'wp-car-gallery'); ?></option>
                <?php
				$body_type_s = get_terms( array( 'taxonomy' => 'body_type', 'hide_empty' => false, 'order' => 'ASC' ) );
				foreach( $body_type_s as $body) {
					?>
                	<option value="<?php esc_attr_e( $body->slug ); ?>" <?php selected( $cg_clean_search_params['car_body_type_s'], $body->slug ); ?>><?php esc_html_e( $body->name ); ?></option>
					<?php 
                }
                ?>
            </select>
        </div>

        <!-- Transmission -->
        <div class="cg-field">
            <label for="cg-transmission"><?php _e('Transmission', 'wp-car-gallery'); ?></label>
            <select id="cg-transmission" name="transmission_s">
                <option value=""><?php _e('All Transmissions', 'wp-car-gallery'); ?></option>
                <option value="<?php _e('automatic', 'wp-car-gallery'); ?>" <?php selected( $cg_clean_search_params['transmission_s'], 'automatic' ); ?>><?php _e('Automatic', 'wp-car-gallery'); ?></option>
                <option value="<?php _e('manual', 'wp-car-gallery'); ?>" <?php selected( $cg_clean_search_params['transmission_s'], 'manual' ); ?>><?php _e('Manual', 'wp-car-gallery'); ?></option>
            </select>
        </div>

        <!-- Condition -->
        <div class="cg-field">
            <label for="cg-condition"><?php _e('Condition', 'wp-car-gallery'); ?></label>
            <select id="cg-condition" name="condition_s">
                <option value=""><?php _e('All Conditions', 'wp-car-gallery'); ?></option>
                <option value="<?php _e('new', 'wp-car-gallery'); ?>" <?php selected( $cg_clean_search_params['condition_s'], 'new' ); ?>><?php _e('New', 'wp-car-gallery'); ?></option>
                <option value="<?php _e('used', 'wp-car-gallery'); ?>" <?php selected( $cg_clean_search_params['condition_s'], 'used' ); ?>><?php _e('Used', 'wp-car-gallery'); ?></option>
                <option value="<?php _e('pre-owned', 'wp-car-gallery'); ?>" <?php selected( $cg_clean_search_params['condition_s'], 'pre-owned' ); ?>><?php _e('Certified Pre-Owned', 'wp-car-gallery'); ?></option>
                <option value="<?php _e('reconditioned', 'wp-car-gallery'); ?>" <?php selected( $cg_clean_search_params['condition_s'], 'reconditioned' ); ?>><?php _e('Reconditioned', 'wp-car-gallery'); ?></option>
            </select>
        </div>

        <!-- Button -->
        <div class="cg-search-action">
            <button type="submit" class="cg-search-button">
                <?php _e('Search Cars', 'wp-car-gallery'); ?>
            </button>

			<a href="<?php echo esc_url( get_permalink() ); ?>" class="cg-reset-button"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>

    </form>

</div>