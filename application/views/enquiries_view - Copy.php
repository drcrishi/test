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
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Enquiry</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->

                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row peoles-nav-border">
                    <div class="col-md-1 col-xs-12 col-sm-2">
                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Enquiry</h4>
                    </div>
                    <div class="col-md-11 col-xs-12 col-sm-10">
                        <ul class="nav navbar-nav people-nav">
                            <li>
                                <a href="#" class="new-people" data-toggle="modal" data-target="#new-people"><i class="fa fa-plus-circle"></i> New </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group form-md-line-input">
                                <label class="col-md-6 control-label" for="form_control_1">Move type<span class="required">*</span></label>
                                <div class="col-md-6">
                                    <select class="form-control" name="en_movetype">
                                        <option value="">Select</option>
                                        <option value="1">Removealist</option>
                                        <option value="2">Packer</option>
                                        <option value="3">Client</option>
                                    </select></div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-6 control-label" for="form_control_1">Home/Office<span class="required">*</span></label>
                                <span class="error"></span>
                                <div class="col-md-6">
                                    <select class="form-control" name="en_home_office">
                                        <option value="">Select</option>
                                        <option value="1">Home</option>
                                        <option value="2">Office</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="col-md-6 control-label">Service date<span class="required">* </span></label>
                                <div class="col-md-6">
                                    <input class="form-control form-control-inline date-picker" id="servicedate" name="en_servicedate" size="16" type="text" value="" />
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-6">Service time</label>
                                <div class="col-md-6">
                                    <input type="text" name="en_servicetime" class="form-control" /></div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-6">Name<span class="required">*</span></label>
                                <span class="error"></span>
                                <div class="col-md-6">
                                    <input type="text" class="form-control name" name="en_name"></div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-6">Phone</label>
                                <span class="error"></span>
                                <div class="col-md-6">
                                    <input type="text" class="form-control phone" name="en_phone"></div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-6">Email</label>
                                <span class="error"></span>
                                <div class="col-md-6">
                                    <input type="text" class="form-control email" name="en_email"></div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-6">Removalist</label>
                                <span class="error"></span>
                                <div class="col-md-6">
                                    <select class="form-control select2me" id="removalist" name="contact_id"></select></div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-6">Notes</label>
                                <span class="error"></span>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="en_note"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">MOVING FROM
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Street<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control name" name="en_name"></div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">Postcode<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control name" name="en_name"></div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>

                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
        </div>
        <!-- Modal -->

        <!--<div id="new-people" class="modal fade" role="dialog">
            <div class="modal-dialog">
                 Modal content
                <div class="modal-content">
        <?php echo form_open('enquiries/add_contact', array('id' => 'enquiry-form', 'method' => 'post')); ?>
                                <form action="#" id="people_new_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-plus-circle"></i> New Enquiry</h4>
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span>Fill all required fields.</span>
                        </div>
                        <div class="alert alert-success display-hide"><button class="close" data-close="alert"></button> Your form validation is successful! </div>
                    </div>
                    <div class="modal-body">
                         BEGIN VALIDATION STATES
                        <div class="portlet light portlet-fit portlet-form bordered">
                            <div class="portlet-body">
                                 BEGIN FORM
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                            <select class="form-control" name="en_movetype">
                                                <option value="">Select</option>
                                                <option value="1">Removealist</option>
                                                <option value="2">Packer</option>
                                                <option value="3">Client</option>
                                            </select>
                                            <label for="form_control_1">Move type<span class="required">*</span></label>
                                        </div>
                                    <div class="form-group form-md-line-input">
                                        <select class="form-control" name="en_home_office">
                                                <option value="">Select</option>
                                                <option value="1">Home</option>
                                                <option value="2">Office</option>
                                            </select>
                                        <label for="form_control_1">Home/Office
                                            <span class="required">*</span>
                                        </label>
                                        <span class="error"></span>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="text" name="en_servicedate" id="en_servicedate" placeholder="DD-MM-YYYY"  class="form-control">
                                        <label for="form_control_1">Service date
                                            <span class="required">*</span>
                                        </label>
                                        <span class="error"></span>
                                    </div>
                                   
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control txtemail email"  name="contact_email" placeholder="Enter your email">
                                        <label class="formLbl" for="form_control_1">Email
                                            <span class="required">*</span>
                                        </label>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control txtnumber phno"  name="contact_phno" placeholder="Enter phone number">
                                        <label class="formLbl" for="form_control_1">Phone</label>
                                    </div>
                                </div>
        
                                 END FORM
                            </div>
                        </div>
                         END VALIDATION STATES
        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn green">Save</button>
                    </div>
                    </form>
        <?php echo form_close(); ?>
                </div>
        
            </div>
        </div>-->

        <div class="quick-nav-overlay"></div>
