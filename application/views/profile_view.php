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
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Dashboard</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h1 class="page-title"> User Profile 
                </h1>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="profile">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="userform">
                                        <?php echo form_open_multipart('userprofile/add_profile', array('id' => 'userlogin-form', 'method' => 'post'));
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
                                                    <label class="control-label">First Name</label>
                                                    <input name="admin_firstname" class="form-control" type="text"> </div>
                                            </div>                                                
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input name="admin_lastname" class="form-control" type="text"> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input name="username" class="form-control" type="text"> </div>
                                            </div>                                                        
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input name="password" class="form-control" type="password"> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">                                                                                                            
                                                    <input type="file" class="filestyle" id="note-attachfile" name="notes_attachedfile" data-buttonBefore="true" data-placeholder="No file" data-text="<b>+</b> Add files">                                                                            
                                                    <span class="activity-file"></span>                                               
                                                </div> 
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="icon-cog theme-font"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase" style="font-size:15px;">Bank Details Settings</span>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="tab-content">
                                                <div class="row">
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Company Address</label>
                                                            <input name="company_address" class="form-control" type="text"> </div>
                                                    </div>                                                
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Bank Detail</label>
                                                            <input name="bank_detail" class="form-control" type="text"> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label">GST</label>
                                                            <input name="gst" class="form-control" type="text"> </div>
                                                    </div>                                                
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Company Business Number</label>
                                                            <input name="company_no" class="form-control" type="text"> </div>
                                                    </div>
                                                </div>
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
