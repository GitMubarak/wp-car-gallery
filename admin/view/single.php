<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cgTab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : null;

$cgSingleMessage = false;

// Content
if ( isset( $_POST['updateSingleContent'] ) ) {

    if ( ! isset( $_POST['cg_single_content_settings_nonce_field'] ) 
        || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cg_single_content_settings_nonce_field'] ) ), 'cg_single_content_settings_nonce_action' ) ) {
        
        wp_die( esc_html__( 'Sorry, your nonce did not verify.', 'hm-car-listings' ) );
    } 
    
    $cgListingMessage = $this->cg_set_single_content_settings( $_POST );
}

// Style
if ( isset( $_POST['updateSingleStyles'] ) ) {

    if ( ! isset( $_POST['cg_single_style_settings_nonce_field'] ) 
        || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cg_single_style_settings_nonce_field'] ) ), 'cg_single_style_settings_nonce_action' ) ) {
        
        wp_die( esc_html__( 'Sorry, your nonce did not verify.', 'hm-car-listings' ) );
    } 
    
    $cgListingMessage = $this->cg_set_single_styles_settings( $_POST );
}
?>
<div id="wph-wrap-all" class="wrap cg-single-settings-page">

    <div class="settings-banner">
        <h2><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;<?php esc_html_e('Detail Page Settings', 'hm-car-listings'); ?></h2>
    </div>

    <?php 
    if ( $cgSingleMessage ) {
        $this->cg_display_notification('success', 'Your information updated successfully.');
    }
    ?>

    <div class="cg-wrap">

        <nav class="nav-tab-wrapper">
            <a href="?post_type=car&page=cg-single-settings&tab=content" class="nav-tab cg-tab <?php if ( $cgTab !== 'styles' ) { ?>cg-tab-active<?php } ?>">
                <i class="fa fa-cog" aria-hidden="true">&nbsp;</i><?php esc_html_e('Content', 'hm-car-listings'); ?>
            </a>
            <a href="?post_type=car&page=cg-single-settings&tab=styles" class="nav-tab cg-tab <?php if ( $cgTab === 'styles' ) { ?>cg-tab-active<?php } ?>">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>&nbsp;<?php esc_html_e('Styles', 'hm-car-listings'); ?>
            </a>
        </nav>

        <div class="cg_personal_wrap cg_personal_help" style="width: 76%; float: left;">
            
            <div class="tab-content">
                <?php 
                switch ( $cgTab ) {
                    case 'styles':
                        include_once CG_PATH . 'admin/view/partial/single-style.php';
                        break;
                    default:
                        include_once CG_PATH . 'admin/view/partial/single-content.php';
                        break;
                } 
                ?>
            </div>
        
        </div>

        <?php include_once('partial/admin-sidebar.php'); ?>

    </div>
</div>