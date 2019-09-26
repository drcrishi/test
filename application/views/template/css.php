<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('assets/global/css/components.min.css'); ?>" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url('assets/global/css/plugins.min.css'); ?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('assets/layouts/layout/css/themes/darkblue.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/layouts/layout/css/layout.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/layouts/layout/css/custom.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/custom/css/DateTimePicker.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/custom/css/bootstrap-select.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/custom/css/custom.css'); ?>" rel="stylesheet" type="text/css" />

<!-- Toast Notification CSS -->
<link href="<?php echo base_url('assets/pages/css/toaster/toastr.min.css'); ?>" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" href="https://crm.hireamover.com.au/favicon.ico" />
<!-- DYNAMIC CSS -->
<?php
if (isset($css)) {
    foreach ($css as $cs) {
        ?>
        <link href="<?php echo base_url("assets/" . $cs); ?>" rel="stylesheet" type="text/css" />
        <?php
    }
}
if (isset($cssTP)) {
    foreach ($cssTP as $cTP) {
        ?>
        <link href="<?php echo $cTP; ?>" rel="stylesheet" type="text/css" />
        <?php
    }
}
?>
