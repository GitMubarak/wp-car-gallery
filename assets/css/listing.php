<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<style type="text/css">
  /* Job Listing */
  .cg-item .cg-job-title a.cg-job-title-a {
    color: <?php esc_html_e( $cg_listing_title_font_color ); ?>;
    font-size: <?php esc_html_e( $cg_listing_title_font_size ); ?>px;
  }
  /* Job overview */
  .cg-item p.cg-overview-excerpt {
    color: <?php esc_html_e( $cg_listing_overview_font_color ); ?>;
    font-size: <?php esc_html_e( $cg_listing_overview_font_size ); ?>px;
  }
</style>