<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--[if lt IE 9]>
<script src="<?php echo base_url('assets/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/excanvas.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/ie8.fix.min.js'); ?>"></script>
<![endif]-->

<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo base_url('assets/global/plugins/jquery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/js.cookie.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/jquery.blockui.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>" type="text/javascript"></script>


<!-- END CORE PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo base_url('assets/global/scripts/app.min.js'); ?>" type="text/javascript"></script>

<!-- END THEME GLOBAL SCRIPTS -->


<!-- DYNAMIC JS -->
<?php
if (isset($js)) {
    foreach ($js as $j) {
        ?>
        <script src="<?php echo base_url("assets/" . $j); ?>" type="text/javascript"></script>
        <?php
    }
}
?>
<script type="text/javascript">var BASE_URL = '<?php echo base_url(); ?>'</script>


</head>