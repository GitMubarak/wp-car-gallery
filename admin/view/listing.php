<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="wph-wrap-all" class="wrap cg-listing-settings-page">

    <div class="settings-banner">
        <h2><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;<?php _e('Listing Page Settings', 'wp-car-gallery'); ?></h2>
    </div>

    <?php 
        if ( $cgListingMessage ) {
            $this->cg_display_notification('success', 'Your information updated successfully.');
        }
    ?>

    <div class="cg-wrap">

        <nav class="nav-tab-wrapper">
            <a href="?post_type=car&page=cg-listing-settings&tab=content" class="nav-tab cg-tab <?php if ( $cgTab !== 'styles' ) { ?> cg-tab-active<?php } ?>">
                <i class="fa fa-cog" aria-hidden="true">&nbsp;</i><?php _e('Content', 'wp-car-gallery'); ?>
            </a>
            <a href="?post_type=car&page=cg-listing-settings&tab=styles" class="nav-tab cg-tab <?php if ( $cgTab === 'styles' ) { ?> cg-tab-active<?php } ?>">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>&nbsp;<?php _e('Styles', 'wp-car-gallery'); ?>
            </a>
        </nav>

        <div class="cg_personal_wrap cg_personal_help" style="width: 76%; float: left;">
            
            <div class="tab-content">
                <?php 
                switch ( $cgTab ) {
                    case 'styles':
                        include_once CG_PATH . 'admin/view/partial/listing-style.php';
                        break;
                    default:
                        include_once CG_PATH . 'admin/view/partial/listing-content.php';
                        break;
                } 
                ?>
            </div>
        
        </div>

        <?php include_once('partial/admin-sidebar.php'); ?>
    
    </div>

</div>