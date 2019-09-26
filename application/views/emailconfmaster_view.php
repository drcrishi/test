<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include "template/leftmenu.php"; ?>
        <!-- END HEADER -->

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper wbcolor">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="margin-left: 0;">
                <!-- BEGIN PAGE HEADER--> 
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url("Emailconfiglist/index"); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Add Email </span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                 <!-- BEGIN PAGE TITLE-->
                <div class="row peoles-nav-border people-wrapper">
                    <div class="col-md-4 col-xs-12 col-sm-2 people-left">
                        <h4 class="peoples-page-title"><i class="fa fa-cogs"></i>&nbsp;Add Email Configuration</h4>
                        <div class="peop-btn-right">
                        <div class="people-toggle">
                            <span></span>
                        </div>
                        </div>
                    </div>                    

                    <div class="col-md-8 col-xs-12 col-sm-10 pad-right0 people-right">                           
                      
                    </div>
                </div>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="profile">
                    <div class="col-md-12">
                        <div class="portlet light">
                                <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="userform">
                                        <?php echo form_open_multipart('EmailConf/add_emailmaster', array('id' => 'emailconfmaster-form', 'method' => 'post'));
                                        ?>
                                        <?php if (function_exists('validation_errors') && validation_errors() != '') { ?>
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">
                                                    <strong>Error!</strong><?php echo validation_errors(); ?>
                                                    <br /><?php echo $error; ?>
                                                </div>
                                            </div>
                                            <div calss="clearfix"></div>
                                        <?php } ?>
                                        
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Job type<span class="required">*</span></label>
                                                       <select class="form-control" name="jobtype">
                                                    <!--                                                <option value="">Select</option>-->
                                                    <option value="1">Move</option>
                                                    <option value="2">Pack</option>
                                                    <option value="3">Luxepack</option>

                                                </select>
                                                    <!--<input name="jobtype" class="form-control" type="text"> </div>-->
                                            </div>
                                        </div>
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">SMTP User<span class="required">*</span></label>
                                                    <input name="smtp_user" class="form-control" type="text"> </div>
                                            </div>                                                        
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">SMTP Password<span class="required">*</span></label>
                                                    <input name="smtp_pass" class="form-control" type="password"> </div>
                                            </div>
                                        </div>
                                        
                                                                                                  
                                            
                                        <div class="row">                                                
                                            <div class="col-sm-12 col-xs-12 text-center">
                                                <div class="margiv-top-10">
                                                    <button type="submit" class="btn green form-submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="quick-nav-overlay"></div>
    <script src="<?php echo base_url('assets/custom/js/bootstrap-filestyle.min.js'); ?>" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery(":file").filestyle({buttonBefore: true});
        });
    </script>
