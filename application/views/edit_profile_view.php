<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo "<pre>";
//print_r($userprofile);
//die;
$sessionId = $this->session->userdata('admin_id');
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
                            <span>Users</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <div class="row peoles-nav-border people-wrapper">
                    <div class="col-md-4 col-xs-12 col-sm-2 people-left">
                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;User Profile</h4>
                        <div class="peop-btn-right">
                        <div class="people-toggle">
                            <span></span>
                        </div>
                        </div>
                    </div>                    

                    <div class="col-md-8 col-xs-12 col-sm-10 pad-right0 people-right">                           
                        <ul class="nav navbar-nav people-nav">
                            <!--                            <li>
                                                            <button type="submit" class="btn green form-submit btn-desk">Save</button>
                                                        </li>-->
                            <li>
                                <a href="<?php echo base_url("userprofile/newUserprofile"); ?>" ><i class="fa fa-plus-circle"></i> New </a>
                            </li>
                            <?php if($sessionId != $userprofile[0]['admin_id']){ ?>
                            <li>
                                <a href="#" data-id="<?php echo $userprofile[0]['admin_id']; ?>" class="deleteuserprofile"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                            <?php }else{ ?>
                            <li></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="profile">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <!--                            <div class="portlet-title tabbable-line">
                                                            <div class="caption caption-md">
                                                                <i class="icon-globe theme-font hide"></i>
                                                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                            </div>
                                                        </div>-->
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="userform">
                                        <?php
                                        echo form_open_multipart('userprofile/viewUserprofile', array('id' => 'userlogin-form', 'method' => 'post'));
                                        foreach ($userprofile as $row) {
                                            ?>
                                            <input type="hidden" name="admin_id" class="form-control" value="<?php echo $row['admin_id']; ?>" />
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label">First Name</label>
                                                        <input name="admin_firstname" class="form-control" type="text" value="<?php echo $row['admin_firstname']; ?>"> </div>
                                                </div>                                                
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Last Name</label>
                                                        <input name="admin_lastname" class="form-control" type="text" value="<?php echo $row['admin_lastname']; ?>"> </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input name="username" class="form-control" type="text" value="<?php echo $row['username']; ?>"> </div>
                                                </div> 
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Change Password?</label>
                                                        <label class="mt-checkbox deposit-checkbox mt-checkbox-outline">
                                                            <input id="chkpassword" type="checkbox" name="changepassword" value="1">
                                                            <span></span>
                                                        </label>
                                                        
                                                        <input name="password" id="user-password" class="form-control" type="password" value="<?php echo $row['password']; ?>" readonly="readonly"> </div>
                                                </div> 

<!--                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Password</label>
                                                        <input name="password" class="form-control" type="password" value="<?php //echo $row['password'];   ?>"> </div>
                                                </div>-->
                                            </div>
                                            <!--                                        <div class="row">
                                                                                        <div class="col-sm-6 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <span class="btn green fileinput-button">
                                                                                                    <i class="fa fa-plus"></i>
                                                                                                    <span> Add files... </span>
                                                                                                    <input type="file" name="userprofile">                                                                         
                                                                                                </span>                                            
                                                                                                <span class="activity-file"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>-->
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-12 showon-area" style="display: block;">
                                                    <div class="form-group">                                                                                                            
                                                        <input type="file" class="filestyle" id="note-attachfile" name="userprofile" data-buttonBefore="true" data-placeholder="No file" data-text="<b>+</b> Profile Pic">                                                                            
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
                                                            <input name="company_address" class="form-control" type="text" value="<?php echo $bankdata[0]['company_address']; ?>"> </div>
                                                    </div>                                                
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Bank Detail</label>
                                                            <input name="bank_detail" class="form-control" type="text" value="<?php echo $bankdata[0]['bank_detail']; ?>"> </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label">GST</label>
                                                            <input name="gst" class="form-control" type="text" value="<?php echo $bankdata[0]['gst']; ?>"> </div>
                                                    </div>                                                
                                                    <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label">Company Business Number</label>
                                                            <input name="company_no" class="form-control" type="text" value="<?php echo $bankdata[0]['company_no']; ?>"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                            
                                            <div class="row">                                                
                                                <div class="col-sm-12 col-xs-12 text-center">
                                                    <div class="margiv-top-10">
                                                        <button type="submit" class="btn green form-submit">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        echo form_close();
                                        ?>
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
            //            jQuery('.fileinput-button input').change(function (e) {
            //                var aval = jQuery('.fileinput-button input').val();
            //                jQuery('.activity-file').text(aval.replace(/C:\\fakepath\\/i, ''));
            //            });

            jQuery(":file").filestyle({buttonBefore: true});
        var pval = jQuery('#user-password').val();
        jQuery('#chkpassword').change(function () {            
            if (this.checked) {
                jQuery("#user-password").removeClass('fhide');
                jQuery('#user-password').attr('value', '');
                 jQuery('#user-password').attr("readonly", false); 
            } else {
                jQuery("#user-password").addClass('fhide');
                jQuery('#user-password').attr('value',pval);
                 jQuery('#user-password').attr("readonly", true); 
            }
        });
        jQuery("#user-password").addClass('fhide');
        });
    </script>
