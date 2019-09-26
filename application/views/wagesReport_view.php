<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    .download-div{
        display: none;
    }
    @media only screen and (max-width: 767px) {
    .table-wrapper .col-lg-4 .form-group{margin-right: 0; margin-left: 0;}
    .table-wrapper .col-lg-4 .form-group .control-label{padding: 0;}
    .table-wrapper .col-lg-4 .form-group .form-group{padding: 0;}
}
</style>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include "template/leftmenu.php"; ?>
        <!-- END HEADER -->

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="margin-left: 0;">
                <div class="page-bar">
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->

                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row peoles-nav-border people-wrapper">
                    <div class="page-bar col-md-2 col-xs-12 col-sm-2 people-left listtit-table" style="margin-left: 0; margin-top: 0px;">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                            </li>
                            <li>
                                <i class="fa fa-circle" style="margin: 5px 5px !important;"></i>
                                <span>HAP Wages Report</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-2 w-100">
                        <h4 class="peoples-page-title"><i class="fa fa-file-word-o" style="display: unset"></i>&nbsp;HAP Wages Report</h4>
                    </div>                    
                </div>

                <!-- BEGIN PAGE HEADER-->
                <div class="row form-horizontal">
                    <form name="wages-report-form" id="wages-report-form">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered table-div wages-report">

                                <div class="table-wrapper">
                                    <div>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="col-md-4 col-sm-5 col-xs-12 control-label">From</label>
                                                        <div class="col-md-8 col-xs-12 col-sm-7 form-group">
                                                            <div class="input-group date form_datetime revenue-date">
                                                                <input class="form-control form-control-inline date-picker date-hide" data-date-format="dd-mm-yyyy" id="servicedateFrom" size="16" type="text" name="servicedatefrom" value="<?php echo date('01-m-Y');?>" readonly/>
                                                                <!-- <input type="text" class="servicedateFrom" data-field="date" readonly name="servicedateFrom1">                                                 -->
                                                                <span class="input-group-btn">
                                                                    <button class="btn default date-set" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="col-md-4 col-sm-5 col-xs-12 control-label">To</label>
                                                        <div class="col-md-8 col-xs-12 col-sm-7 form-group">
                                                            <div class="input-group date form_datetime revenue-date">
                                                                <input class="form-control form-control-inline date-picker date-hide" data-date-format="dd-mm-yyyy" id="servicedateTo" size="16" type="text" name="servicedateto" value="<?php echo date('d-m-Y');?>" readonly/>
                                                                <!-- <input type="text" class="servicedateTo" data-field="date" readonly name="servicedateTo1">   -->
                                                                <span class="input-group-btn">
                                                                    <button class="btn default" type="button">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-center">
                                                    <input type="button" class="btn green filter-submit" value="View Report" id="viewWagesReport">                                        
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
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                        <div class="row download-div">
                            <div class="col-md-6 col-sm-6 col-xs-12"> 
                                <input type="button" class="btn red" value="Export PDF" id="exportPDFviewer">
                                <input type="button" class="btn green filter-submit" value="Export XLS" id="exportXLSviewer">  
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
</div>
<div id="serviceBox"></div>
<div class="quick-nav-overlay"></div>
<script src="<?php echo base_url('assets/custom/js/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom/js/DateTimePicker.min.js'); ?>" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {

     var wd = $(window).width();
     if (wd < 768) {
         jQuery('select').selectpicker();
         jQuery("#serviceBox").DateTimePicker({
          dateFormat: "dd-MM-yyyy",
      });
         jQuery('html, body').on('change', '.servicedateFrom', function(){
             var td = jQuery(this).val();
             jQuery('#servicedateFrom').val(td);
         });

         jQuery('html, body').on('change', '.servicedateTo', function(){
             var td = jQuery(this).val();
             jQuery('#servicedateTo').val(td);
         });
     }

 });
</script>