<?php
$sessionuserId = $this->session->userdata('contact_id');
?>
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
<!--            <a href="<?php echo base_url('enquirieslist'); ?>"><img src="<?php echo base_url('assets/layouts/layout/img/logo-white.png'); ?>" alt="logo" class="logo-default" /> </a>-->
            <a href="<?php echo base_url('driver/userbookinglist'); ?>"><span class="inner-slogan">HAM<span>CRM</span></span></a>
            <!--<h3>HAM</h3>-->

            <div class="menu-toggler sidebar-toggler hide">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>

        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu ">
            <ul class="nav navbar-nav pull-right"> 
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                <li class="dropdown dropdown-user ">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

  <!--<img alt="" class="img-circle" src="<?php echo base_url(); ?>assets/uploads/userprofile/<?php echo $this->session->userdata('userprofile'); ?>" />-->
                        <img alt="" class="img-circle" src="<?php echo base_url(); ?>assets/uploads/userprofile/<?php echo $userprofile[0]['userprofile']; ?>" />

<!--                        <img alt="" class="img-circle" src="<?php echo base_url(); ?>assets/uploads/userprofile/logo.jpg" />-->
                        <div class="username username-hide-on-mobile"> <?php echo $this->session->userdata('contact_fname'); ?> </div>

                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="#" class="new-people" data-toggle="modal" data-target="#new-people"> <i class="fa fa-unlock-alt" aria-hidden="true"></i>Change Password </a>
                        <!--<a href="<?php echo base_url('driver/userbookinglist/changeUserPassword/') . $this->session->userdata('contact_email'); ?>">-->

                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="#" class="profilepic" data-toggle="modal" data-target="#profile-pic"><i class="fa fa-picture-o" aria-hidden="true"></i>Change Profile Pic </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="<?php echo base_url('logout'); ?>">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN --                
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->

        <!-- END RESPONSIVE MENU TOGGLER -->

        <div class="hor-menu">
            <ul class="nav navbar-nav">
                <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                <li class="classic-menu-dropdown" aria-haspopup="true">
                    <a href="<?php echo base_url("driver/userbookinglist"); ?>">
                        <i class="fa fa-newspaper-o"></i> Bookings
                        <span class="selected"> </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<div class="ajaxLoader">
    <!--<img src="<?php echo base_url("assets/layouts/layout/img/Blocks.gif"); ?>">-->
</div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <div id="new-people" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <?php echo form_open('#', array('id' => 'change-pwd', 'method' => 'post')); ?>
                <!--            <form action="#" id="people_new_form">-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Change Password</h4>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>Fill all required fields.</span>
                    </div>
                    <div class="alert alert-success display-hide"><button class="close" data-close="alert"></button> Your form validation is successful! </div>
                </div>
                <div class="modal-body">
                    <?php if (function_exists('validation_errors') && validation_errors() != '') { ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <strong>Error!</strong><?php echo validation_errors(); ?>
                                <br /><?php echo $error; ?>
                            </div>
                        </div>
                        <div calss="clearfix"></div>
                    <?php } ?>

                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="form-group form-md-line-input" id="contact-password">
                                    <input type="password" class="form-control password"  name="contact_password_old" placeholder="Enter your old password">
                                    <label class="formLbl" for="form_control_1">Old Password<span class="required">*</span>
                                    </label>
                                    <span class="error"></span>
                                </div>
                                <div class="form-group form-md-line-input" id="contact-password">
                                    <input type="password" class="form-control password"  name="contact_password" placeholder="Enter your new password">
                                    <label class="formLbl" for="form_control_1">New Password<span class="required">*</span>
                                    </label>
                                    <span class="error"></span>
                                </div>

                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save</button>
                    </div>
                    <!--</form>-->

                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div id="profile-pic" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <?php echo form_open_multipart('#', array('id' => 'change-profile', 'method' => 'post')); ?>
                <!--            <form action="#" id="people_new_form">-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Change Profile Pic</h4>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>Fill all required fields.</span>
                    </div>
                    <div class="alert alert-success display-hide"><button class="close" data-close="alert"></button> Your form validation is successful! </div>
                </div>
                <div class="modal-body">
                    <?php if (function_exists('validation_errors') && validation_errors() != '') { ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <strong>Error!</strong><?php echo validation_errors(); ?>
                                <br /><?php echo $error; ?>
                            </div>
                        </div>
                        <div calss="clearfix"></div>
                    <?php } ?>

                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="fileinput fileinput-new container" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail col-md-6 col-sm-12" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail col-md-6 col-sm-12" style="max-width: 200px; max-height: 150px;"> </div>
                                    <div class="col-md-6 col-sm-12">
                                        <span class="btn default btn-file" style="margin-top:60px">
                                            <span class="fileinput-new">Select Profile Pic </span>
                                            <span class="fileinput-exists"> Change Profile Pic</span>
                                            <input type="file" name="userprofile"> </span>
                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput" style="margin-top:60px"> Remove </a>
                                    </div>
                                </div>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save</button>
                    </div>
                    <!--</form>-->

                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/custom/js/bootstrap-filestyle.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js'); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        var Userprofile = function () {

            var handleUserprofile = function () {

                var userprofileForm = $('#change-profile');
                var error1 = $('.alert-danger', userprofileForm);
                var success1 = $('.alert-success', userprofileForm);
                userprofileForm.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input


                    submitHandler: function (form) {
                        var formData = jQuery(form).serializeArray();
                        ajaxUserprofile(new FormData(form));
                    }
                });

                $('#change-profile input').keypress(function (e) {
                    if (e.which == 13) {
                        if ($('#change-profile').validate().form()) {
                            var formData = jQuery("#change-profile")[0];
                            ajaxUserprofile(new FormData(formData));
//                    var formData = jQuery("#userlogin-form").serializeArray();
//                    ajaxUserprofile(formData);
                        }
                        return false;
                    }
                });
            }

            return {
                //main function to initiate the module
                init: function () {
                    handleUserprofile();
                }
            };
        }();

        jQuery(document).ready(function () {
            Userprofile.init();
        });



        function ajaxUserprofile(formData) {
            jQuery.ajax({
                type: 'POST',
                processData: false,
                contentType: false,
                url: BASE_URL + 'driver/userbookinglist/changeUserProfile/',
                data: formData,
                success: function (response) {
                    var res = JSON.parse(response);
                    // var profile = res.userprofile;
                    // console.log(profile);
                    if (res.error) {
                        toastr.error(res.error);
                    } else {
                        //  jQuery(".driveruser").html('<img alt="" class="img-circle" src="../assets/uploads/userprofile/' + profile + '" />');

                        toastr.success('Profile Pic has been changed.');
                        setTimeout(function () {
                            jQuery("#profile-pic").modal("hide");
                        }, 2000);
                        // window.location = BASE_URL + "driver/userbookinglist";

                    }
                }
            })
        }
        jQuery(document).ready(function () {
            // jQuery("#change-pwd").trigger("submit");
            jQuery("#change-pwd").submit(function () {

                jQuery.ajax({
                    type: 'POST',
                    url: BASE_URL + 'driver/userbookinglist/changeUserPassword/',
                    data: jQuery('#change-pwd').serialize(),
                    success: function (response) {
                        var res = JSON.parse(response);
                        // console.log(res);
                        if (res.error) {
                            toastr.error(res.error);
                        } else {
                            toastr.success('Password has been changed.');
                            jQuery("#change-pwd").trigger('reset');
                            setTimeout(function () {
                                jQuery("#new-people").modal("hide");
                            }, 2000);

                        }
                    }
                })
                return false;
            });
        });
    </script>    