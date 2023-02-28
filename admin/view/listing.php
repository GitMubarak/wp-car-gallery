<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="wph-wrap-all" class="wrap cg-listing-settings-page">

    <div class="settings-banner">
        <h2><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;<?php _e('Listing Page Settings', JOBWP_TXT_DOMAIN); ?></h2>
    </div>

    <?php 
        if ( $cgListingMessage ) {
            $this->cg_display_notification('success', 'Your information updated successfully.');
        }
    ?>

    <div class="cg-wrap">

        <nav class="nav-tab-wrapper">
            <a href="?post_type=jobs&page=cg-listing-settings&tab=settings" class="nav-tab cg-tab <?php if ( $cgTab !== 'styles' ) { ?> cg-tab-active<?php } ?>">
                <i class="fa fa-cog" aria-hidden="true">&nbsp;</i><?php _e('Content', JOBWP_TXT_DOMAIN); ?>
            </a>
            <a href="?post_type=jobs&page=cg-listing-settings&tab=styles" class="nav-tab cg-tab <?php if ( $cgTab === 'styles' ) { ?> cg-tab-active<?php } ?>">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>&nbsp;<?php _e('Styles', JOBWP_TXT_DOMAIN); ?>
            </a>
        </nav>

        <div class="cg_personal_wrap cg_personal_help" style="width: 76%; float: left;">
            
            <div class="tab-content">
                <?php 
                switch ( $cgTab ) {
                    case 'styles':
                        include_once JOBWP_PATH . 'admin/view/partial/listing-style.php';
                        break;
                    default:
                        include_once JOBWP_PATH . 'admin/view/partial/listing-content.php';
                        break;
                } 
                ?>
            </div>
        
        </div>

        <?php include_once('partial/admin-sidebar.php'); ?>
    
    </div>

</div>