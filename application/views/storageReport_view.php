<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <?php include "template/leftmenu.php"; ?>
        <div class="page-content-wrapper">
            <div class="page-content" style="margin-left: 0;">
                <div class="row peoles-nav-border people-wrapper">
                    <div class="page-bar col-md-2 col-xs-12 col-sm-2 people-left listtit-table" style="margin-left: 0; margin-top: 0px;">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                            </li>
                            <li>
                                <i class="fa fa-circle" style="margin: 5px 5px !important;"></i>
                                <span>HS Storage Report</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-2 w-100">
                        <h4 class="peoples-page-title"><i class="fa fa-file-word-o" style="display: unset"></i>&nbsp;HS Storage Report</h4>
                    </div>                    
                </div>
                <div class="row form-horizontal">
                    <?php echo form_open('storageReport/viewRevenueReport', array('id' => 'revenue-report', 'method' => 'post'));
                    ?>
                    <div class="col-md-12">
                        <div class="portlet light bordered table-div revenue-report">
                            <div class="table-wrapper">
                                <div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-md-4 col-sm-5 col-xs-12 control-label">State</label>
                                                    <div class="col-md-8 col-xs-12 col-sm-7 form-group">
                                                        <select class="form-control" id="state" name="state">
                                                            <option value=""></option>
                                                            <?php
                                                            foreach ($statedata as $st) {
                                                                ?> <option value="<?php echo $st['State']; ?>"><?php echo $st['State']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>                                                                                                                                 
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-md-4 col-sm-5 col-xs-12 control-label">Booking Status</label>
                                                    <div class="col-md-8 col-xs-12 col-sm-7 form-group">
                                                        <div class="input-group">
                                                            <select class="form-control" id="bookingstatus" name="bookingstatus">
                                                                <option value="" selected>All</option>
                                                                <option selected="" value="12">Current/Others</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row ">
                                                <div class="col-md-4 col-sm-5 col-xs-12" style="margin-bottom : 10px;">   
                                                    <div class="form-empty" style="min-height:0"></div>
                                                    <input type="submit" class="btn green filter-submit" value="View Report" id="viewRevenueReport">                                        
                                                </div>
                                            </div>
                                            
                                        </div>    
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="reports"></div>
                                        </div>
                                    </div>
                                    <div class="filter-overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="serviceBox"></div>
<div class="quick-nav-overlay"></div>
<script src="<?php echo base_url('assets/custom/js/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
<!-- <script src="<?php //echo base_url('assets/custom/js/DateTimePicker.min.js'); ?>" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        var wd = $(window).width();
        if (wd < 768) {
            jQuery('select').selectpicker();
            jQuery("#serviceBox").DateTimePicker({
                dateFormat: "dd-MM-yyyy",
            });
            jQuery('html, body').on('change', '.servicedateFrom', function () {
                var td = jQuery(this).val();
                jQuery('#servicedateFrom').val(td);
            });

            jQuery('html, body').on('change', '.servicedateTo', function () {
                var td = jQuery(this).val();
                jQuery('#servicedateTo').val(td);
            });
        }
    });
</script> -->