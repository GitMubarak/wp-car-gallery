<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Search Items
$keyword_s	= isset( $_GET['keyword_s'] ) ? sanitize_text_field( wp_unslash( $_GET['keyword_s'] ) ) : '';
$min_price = ( isset( $_GET['min_price_s'] ) && '' !== $_GET['min_price_s'] ) ? absint( wp_unslash( $_GET['min_price_s'] ) ) : '';
$max_price = ( isset( $_GET['max_price_s'] ) && '' !== $_GET['max_price_s'] ) ? absint( wp_unslash( $_GET['max_price_s'] ) ) : '';
$min_year = ( isset( $_GET['min_year_s'] ) && '' !== $_GET['min_year_s'] ) ? absint( wp_unslash( $_GET['min_year_s'] ) ) : '';
$max_year = ( isset( $_GET['max_year_s'] ) && '' !== $_GET['max_year_s'] ) ? absint( wp_unslash( $_GET['max_year_s'] ) ) : '';

// Search Keyword
if ( '' != $keyword_s ) {

    $cgQueryArr['s'] = $keyword_s;
    // Optional: Let WordPress sort by relevancy instead of date when searching
    unset( $cgQueryArr['orderby'] ); 
    unset( $cgQueryArr['order'] );
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
    
    if ( isset( $_GET[ $get_key ] ) && is_string( $_GET[ $get_key ] ) && '' !== trim( sanitize_text_field( wp_unslash( $_GET[ $get_key ] ) ) ) ) {
        
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
    'car_make_s'      => 'hmcg_car_make',
    'car_model_s'     => 'hmcg_car_model',
    'car_fuel_s'      => 'hmcg_car_fuel',
    'car_body_type_s' => 'hmcg_body_type',
);

foreach ( $cg_search_tax_filters as $get_key => $meta_key ) {
    
    if ( isset( $_GET[ $get_key ] ) && is_string( $_GET[ $get_key ] ) && '' !== trim( sanitize_text_field( wp_unslash( $_GET[ $get_key ] ) ) ) ) {
        
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
            <label for="cg-keyword"><?php esc_html_e('Keyword', 'hm-car-listings'); ?></label>
            <input
                type="text"
                id="cg-keyword"
                name="keyword_s"
                placeholder="Search cars..."
				value="<?php echo esc_attr( $keyword_s ); ?>"
            >
        </div>

        <!-- Make -->
        <div class="cg-field">
            <label for="cg-make"><?php esc_html_e('Make', 'hm-car-listings'); ?></label>
            <select id="cg-make" name="car_make_s">
                <option value=""><?php esc_html_e('All Makes', 'hm-car-listings'); ?></option>
				<?php
				$car_makes = get_terms( array( 'taxonomy' => 'hmcg_car_make', 'hide_empty' => false, 'order' => 'ASC' ) );
				foreach( $car_makes as $make) {
					?>
					<option value="<?php echo esc_attr( $make->slug ); ?>" <?php selected( $cg_clean_search_params['car_make_s'], $make->slug ); ?>><?php echo esc_html( $make->name ); ?></option>
					<?php 
                }
                ?>
            </select>
        </div>

        <!-- Model -->
        <div class="cg-field">
            <label for="cg-model"><?php esc_html_e('Model', 'hm-car-listings'); ?></label>
            <select id="cg-model" name="car_model_s">
                <option value=""><?php esc_html_e('All Models', 'hm-car-listings'); ?></option>
				<?php
				$car_models = get_terms( array( 'taxonomy' => 'hmcg_car_model', 'hide_empty' => false, 'order' => 'ASC' ) );
				foreach( $car_models as $model) {
					?>
                	<option value="<?php echo esc_attr( $model->slug ); ?>" <?php selected( $cg_clean_search_params['car_model_s'], $model->slug ); ?>><?php echo esc_html( $model->name ); ?></option>
					<?php 
                }
                ?>
            </select>
        </div>

        <!-- Price -->
        <div class="cg-field cg-price-field">
            <label><?php esc_html_e('Price', 'hm-car-listings'); ?></label>

            <div class="cg-range-fields">
                <input
                    type="number"
                    name="min_price_s"
                    placeholder="Min price"
                    min="0"
					value="<?php echo esc_attr( $min_price ); ?>"
                >

                <span>–</span>

                <input
                    type="number"
                    name="max_price_s"
                    placeholder="Max price"
                    min="0"
					value="<?php echo esc_attr( $max_price ); ?>"
                >
            </div>
        </div>

        <!-- Year -->
        <div class="cg-field cg-year-field">
            <label><?php esc_html_e('Year', 'hm-car-listings'); ?></label>

            <div class="cg-range-fields">
                <input
                    type="number"
                    name="min_year_s"
                    placeholder="From"
                    min="1900"
					step="1"
					value="<?php echo esc_attr( $min_year ); ?>"
                >

                <span>–</span>

                <input
                    type="number"
                    name="max_year_s"
                    placeholder="To"
                    min="1900"
					step="1"
					value="<?php echo esc_attr( $max_year ); ?>"
                >
            </div>
        </div>

        <!-- Fuel -->
        <div class="cg-field">
            <label for="cg-fuel"><?php esc_html_e('Fuel Type', 'hm-car-listings'); ?></label>
            <select id="cg-fuel" name="car_fuel_s">
                <option value=""><?php esc_html_e('All Fuel Types', 'hm-car-listings'); ?></option>
				<?php
				$car_fuels = get_terms( array( 'taxonomy' => 'hmcg_car_fuel', 'hide_empty' => false, 'order' => 'ASC' ) );
				foreach( $car_fuels as $fuel) {
					?>
                	<option value="<?php echo esc_attr( $fuel->slug ); ?>" <?php selected( $cg_clean_search_params['car_fuel_s'], $fuel->slug ); ?>><?php echo esc_html( $fuel->name ); ?></option>
					<?php 
                }
                ?>
            </select>
        </div>

        <!-- Body Type -->
        <div class="cg-field">
            <label for="cg-body-type"><?php esc_html_e('Body Type', 'hm-car-listings'); ?></label>
            <select id="cg-body-type" name="car_body_type_s">
                <option value=""><?php esc_html_e('All Body Types', 'hm-car-listings'); ?></option>
                <?php
				$body_type_s = get_terms( array( 'taxonomy' => 'hmcg_body_type', 'hide_empty' => false, 'order' => 'ASC' ) );
				foreach( $body_type_s as $body) {
					?>
                	<option value="<?php echo esc_attr( $body->slug ); ?>" <?php selected( $cg_clean_search_params['car_body_type_s'], $body->slug ); ?>><?php echo esc_html( $body->name ); ?></option>
					<?php 
                }
                ?>
            </select>
        </div>

        <!-- Transmission -->
        <div class="cg-field">
            <label for="cg-transmission"><?php esc_html_e('Transmission', 'hm-car-listings'); ?></label>
            <select id="cg-transmission" name="transmission_s">
                <option value=""><?php esc_html_e('All Transmissions', 'hm-car-listings'); ?></option>
                <option value="<?php echo esc_attr( 'automatic' ); ?>" <?php selected( $cg_clean_search_params['transmission_s'], 'automatic' ); ?>><?php esc_html_e('Automatic', 'hm-car-listings'); ?></option>
                <option value="<?php echo esc_attr( 'manual' ); ?>" <?php selected( $cg_clean_search_params['transmission_s'], 'manual' ); ?>><?php esc_html_e('Manual', 'hm-car-listings'); ?></option>
            </select>
        </div>

        <!-- Condition -->
        <div class="cg-field">
            <label for="cg-condition"><?php esc_html_e('Condition', 'hm-car-listings'); ?></label>
            <select id="cg-condition" name="condition_s">
                <option value=""><?php esc_html_e('All Conditions', 'hm-car-listings'); ?></option>
                <option value="<?php echo esc_attr( 'new' ); ?>" <?php selected( $cg_clean_search_params['condition_s'], 'new' ); ?>><?php esc_html_e('New', 'hm-car-listings'); ?></option>
                <option value="<?php echo esc_attr( 'used' ); ?>" <?php selected( $cg_clean_search_params['condition_s'], 'used' ); ?>><?php esc_html_e('Used', 'hm-car-listings'); ?></option>
                <option value="<?php echo esc_attr( 'pre-owned' ); ?>" <?php selected( $cg_clean_search_params['condition_s'], 'pre-owned' ); ?>><?php esc_html_e('Certified Pre-Owned', 'hm-car-listings'); ?></option>
                <option value="<?php echo esc_attr( 'reconditioned' ); ?>" <?php selected( $cg_clean_search_params['condition_s'], 'reconditioned' ); ?>><?php esc_html_e('Reconditioned', 'hm-car-listings'); ?></option>
            </select>
        </div>

        <!-- Button -->
        <div class="cg-search-action">
            <button type="submit" class="cg-search-button">
                <?php esc_html_e('Search Cars', 'hm-car-listings'); ?>
            </button>

			<a href="<?php echo esc_url( get_permalink() ); ?>" class="cg-reset-button"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>

    </form>

</div>