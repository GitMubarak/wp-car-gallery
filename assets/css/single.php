<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<style type="text/css">
  .cg-single-body-container {
    background: <?php esc_html_e( $cg_single_container_bg_color ); ?>;
  }
  .circulr-details-top .cg-job-title {
    color: <?php esc_html_e( $cg_single_title_font_color ); ?>;
    font-size: <?php esc_html_e( $cg_single_title_font_size ); ?>px;
  }
  .cg-single-left .label,
  .cg-single-left .text {
    color: <?php esc_html_e( $cg_single_info_font_color ); ?>;
  }
  .circulr-details-bottom-email .cg-primary-button {
    background: <?php esc_html_e( $cg_single_apply_btn_bg_color ); ?>;
    border: 1px solid <?php esc_html_e( $cg_single_apply_btn_bg_color ); ?>;
  }
  .circulr-details-bottom-email .cg-primary-button:hover {
    color: <?php esc_html_e( $cg_single_apply_btn_bg_color ); ?>!important;
    background: #FFFFFF!important;
  }
</style>