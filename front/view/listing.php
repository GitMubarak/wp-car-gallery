<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$cgGeneralSettings = $this->cg_get_general_settings();
//print_r( $cgGeneralSettings );
foreach ( $cgGeneralSettings as $option_name => $option_value ) {
    if ( isset( $cgGeneralSettings[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}

$cgListingContent = $this->cg_get_listing_content_settings();
//print_r( $cgListingContent );
foreach ( $cgListingContent as $option_name => $option_value ) {
    if ( isset( $cgListingContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}

$cgListingStyles = $this->cg_get_listing_styles_settings();
foreach ( $cgListingStyles as $option_name => $option_value ) {
    if ( isset( $cgListingStyles[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}


$cg_list_layout = isset( $cgAttr['layout'] ) ? $cgAttr['layout'] : $cg_list_layout;

// Main Query Arguments
$cgQueryArrParams = array(
    'post_type'   => 'jobs',
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

// Load Styling
include JOBWP_PATH . 'assets/css/listing.php';
// Load Search Panel
include JOBWP_PATH . 'front/view/search.php';

$cgQueryArr = apply_filters( 'cg_front_main_query_array', $cgQueryArrParams );

$cgJobs = new WP_Query( $cgQueryArr );
?>
<div class="cg-listing-body-container <?php esc_attr_e( $cg_list_layout ) ?>">
    <?php
    if ( $cgJobs->have_posts() ) {

        while ( $cgJobs->have_posts() ) {

            $cgJobs->the_post();

            $cg_experience       = get_post_meta( $post->ID, 'cg_experience', true );
            $cg_deadline         = get_post_meta( $post->ID, 'cg_deadline', true );
            $jobs_location          = wp_get_post_terms( $post->ID, 'jobs_location', array('fields' => 'all') );
            $jobs_nature            = wp_get_post_terms( $post->ID, 'jobs_nature', array('fields' => 'all') );
            $cgDateDiff          = date_diff( date_create( date('Y-m-d') ), date_create( $cg_deadline ) );
            $cgDateDiffNumber    = $cgDateDiff->format("%R%a");

            if ( $cgDateDiffNumber > -1 ) {
                $cgDeadline = date( 'd M, Y', strtotime( $cg_deadline ) );
            } else {
                $cgDeadline = __( 'Closed', JOBWP_TXT_DOMAIN );
            }
            ?>
            <div class="cg-item">
                <h3 class="cg-job-title"><a href="<?php the_permalink(); ?>" class="cg-job-title-a"><?php the_title(); ?></a></h3>
                <?php
                if ( ! $cg_list_display_overview ) {
                    ?>
                    <p class="cg-overview-excerpt">
                        <?php echo wp_trim_words( get_the_content(), esc_html( $cg_list_overview_length ), '...' ); ?>
                    </p>
                    <?php
                }
                ?>
                <div class="cg-bottom">
                    <?php
                    if ( ! $cg_list_display_experience ) {
                        ?>
                        <div class="cg-list-bottom-item pull-left">
                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                            <strong class="primary-color"><?php esc_html_e( $cg_list_exp_lbl_txt ); ?>:</strong>
                            <span class="ng-binding">
                                <?php esc_html_e( $cg_experience ); ?> <?php _e('Years', JOBWP_TXT_DOMAIN); ?>
                            </span>
                        </div>
                        <?php
                    }

                    if ( ! $cg_list_display_deadline ) {
                        ?>
                        <div class="cg-list-bottom-item pull-right">
                            <i class="fa fa-calendar-days" aria-hidden="true"></i>
                            <strong class="primary-color"><?php esc_html_e( $cg_list_deadline_lbl_txt ); ?>:</strong>
                            <span class="ng-binding">
                                <?php esc_html_e( $cgDeadline ); ?>
                            </span>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="cg-bottom clear">
                    <?php
                    if ( ! $cg_list_display_location ) {
                        ?>
                        <div class="cg-list-bottom-item pull-left">
                            <i class="fa-solid fa-location-dot"></i>
                            <strong class="primary-color"><?php esc_html_e( $cg_list_loc_lbl_txt ); ?>:</strong>
                            <span>
                            <?php
                            if ( ! empty( $jobs_location ) ) {
                                $jobs_location_arr = array();
                                foreach( $jobs_location as $location ) {
                                    $jobs_location_arr[] = $location->name . '';
                                }
                                echo implode( ', ', $jobs_location_arr );   
                            }
                            ?>
                            </span>
                        </div>
                        <?php
                    }

                    if ( ! $cg_list_display_jtype ) {
                        ?>
                        <div class="cg-list-bottom-item pull-right">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <strong class="primary-color"><?php esc_html_e( $cg_list_job_type_lbl_txt ); ?>:</strong>
                            <span>
                            <?php
                            if ( ! empty( $jobs_nature ) ) {
                                $jobs_nature_arr = array();
                                foreach( $jobs_nature as $type ) {
                                    $jobs_nature_arr[] = $type->name . '';
                                }
                                echo implode( ', ', $jobs_nature_arr );   
                            }
                            ?>
                            </span>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }   
    else {
        ?>
        <p class="cg-no-jobs-found"><?php _e('No Jobs found', JOBWP_TXT_DOMAIN); ?></p>
        <?php
    }
      
    // Reset Post Data
    wp_reset_postdata();
    ?>
</div>