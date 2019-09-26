<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Toast Notification JS -->
<script src="<?php echo base_url('assets/pages/scripts/toaster/toastr.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom/js/notification.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('assets/pages/scripts/toaster/toaster.js'); ?>" type="text/javascript"></script>

<!-- Time Ago JS for Notification -->
<script src="<?php echo base_url('assets/apps/scripts/time-ago/timeago.min.js'); ?>" type="text/javascript"></script>
<!--<script src="<?php echo base_url('assets/apps/scripts/time-ago/time-ago-custom.js'); ?>" type="text/javascript"></script>-->



<?php
if (isset($jsTPFooter)) {
    foreach ($jsTPFooter as $jTP) {
        ?>
        <script src="<?php echo $jTP; ?>" type="text/javascript"></script>
        <?php
    }
}
if (isset($jsFooter)) {
    foreach ($jsFooter as $j) {
        ?>
        <script src="<?php echo base_url("assets/" . $j); ?>" type="text/javascript"></script>
        <?php
    }
}

?>
<div class="copyright"> <?php echo date('Y'); ?> &copy; HAM CRM </div>
<script>
    jQuery(document).ready(function(){
        jQuery('.menu-toggler').click(function(){
            jQuery('.page-header-inner .hor-menu').slideToggle();
        });
        jQuery('.group-relative').each(function(){
            var tht = jQuery(this).find('.input-modal').height();
            var tmt = tht / 2;
            jQuery(this).find('.input-modal').css('top',-tmt);
        });
        jQuery('.input-close').click(function(){
            //jQuery(this).closest('.input-modal').hide();
        });
        jQuery('.input-popup').click(function(){
            jQuery(this).closest('.group-relative').find('.input-modal').show();
        });
        jQuery('.people-toggle').click(function(){
            jQuery(this).closest('.people-wrapper').find('.people-nav').slideToggle();
        });   
        
         /* Sticky footer. */
        var bh = jQuery('body').height();
        var dh = jQuery(document).height();
        var ch = dh - 131;
        if (bh < dh) {
            jQuery('.page-content').css('min-height', ch);
            //$('.copyright').addClass('fixed-footer');
        }
         
    });
</script>
</body>
</html>