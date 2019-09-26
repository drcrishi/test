<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
                    <!--                    <ul class="page-breadcrumb">
                                            <li>
                                                <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                                                <i class="fa fa-circle"></i>
                                            </li>
                                            <li>
                                                <span>HAM Revenue Report</span>
                                            </li>
                                        </ul>-->
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
                                <span>HAM Revenue Report</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-2 w-100">
                        <h4 class="peoples-page-title"><i class="fa fa-file-word-o" style="display: unset"></i>&nbsp;HAM Revenue Report</h4>
                        <!--                        <div class="peop-btn-right">
                                                    <div class="people-toggle">
                                                        <span></span>
                                                    </div>
                                                </div>-->
                    </div>                    
                </div>

                <!-- BEGIN PAGE HEADER-->
                <div class="row form-horizontal">
                    <?php echo form_open('revenueReport/viewRevenueReport', array('id' => 'revenue-report', 'method' => 'post'));
                    ?>
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered table-div revenue-report">

                            <div class="table-wrapper">
                                <!--                                <div class="filter-toggle">
                                                                    <button type="button" class="btn dark btn-outline sbold uppercase filter-btn">Filter</button>
                                                                </div>-->
                                <div>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-md-4 col-sm-5 col-xs-12 control-label">From</label>
                                                    <div class="col-md-8 col-xs-12 col-sm-7 form-group">
                                                        <div class="input-group date form_datetime revenue-date">
                                                            <input class="form-control form-control-inline date-picker date-hide" data-date-format="dd-mm-yyyy" id="servicedateFrom" size="16" type="text" name="servicedatefrom" value="<?php echo date('01-m-Y'); ?>" readonly/>
                                                            <input type="text" class="servicedateFrom" data-field="date" readonly name="servicedateFrom1">                                                
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
                                                            <input class="form-control form-control-inline date-picker date-hide" data-date-format="dd-mm-yyyy" id="servicedateTo" size="16" type="text" name="servicedateto" value="<?php echo date('d-m-Y'); ?>" readonly/>
                                                            <input type="text" class="servicedateTo" data-field="date" readonly name="servicedateTo1">  
                                                            <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                        </div>
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
                                                                <option selected="" value="3">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="row">
                                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-md-4 col-sm-5 col-xs-12 control-label">Job type</label>
                                                    <div class="col-md-8 col-xs-12 col-sm-7 form-group">
                                                        <select class="form-control" id="enquirymovetype" name="enmovetype">
                                                            <option value="All" selected>All</option>
                                                            <option value="12">Home/Office</option>
                                                            <option value="45">Pack/Unpack</option>
                                                            <option value="6">Storage</option>

                                                        </select>
<!--                                                        <select class="form-control" id="enquirymovetype" name="enmovetype">
                                                            <option value="All" selected>All</option>
                                                        <?php
                                                        foreach ($move_type as $mt) {
                                                            if ($mt['movetype_id'] == 0) {
                                                                ?><option value="<?php echo $mt['movetype_id']; ?>" selected><?php echo $mt['movetype_name']; ?></option>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                            <option value="<?php echo $mt['movetype_id']; ?>"><?php echo $mt['movetype_name']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select>-->
                                                    </div>                                                                                                                                 
                                                </div>
                                            </div>
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
                                                            <!--<input type="text" name="state" id="state" class="form-control">-->
                                                    </div>                                                                                                                                 
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="col-md-4 col-sm-5 col-xs-12 control-label">Removalist</label>
                                                    <div class="col-md-8 col-xs-12 col-sm-7 form-group">
                                                        <input type="text" name="removalist" id="removalist" class="form-control">
                                                    </div>                                                                                                                                 
                                                </div>
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-12">   
                                        <div class="form-empty"></div>
                                        <input type="submit" class="btn green filter-submit" value="View Report" id="viewRevenueReport">                                        
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
                    </div>
                    <?php echo form_close(); ?>
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
</script>