<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white" ng-app="peoples">

    <div class="page-wrapper"  ng-controller="peoplesCtrl">
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
                            <span>Peoples</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->

                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row peoles-nav-border">
                    <div class="col-md-1 col-xs-12 col-sm-2">
                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Peoples</h4>
                    </div>
                    <div class="col-md-11 col-xs-12 col-sm-10">
                        <ul class="nav navbar-nav people-nav">
                            <li>
                                <a href="#" class="new-people" data-toggle="modal" data-target="#new-people"><i class="fa fa-plus-circle"></i> New </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-edit"></i> Edit </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h3 >Your People</h3>
                        <div class="people-list" ng-init="alpha = ['#', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K']">
                            <div  class="alphabats" ng-repeat="a in alpha">
                                <span>{{a}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        HI
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
</div>
<!-- Modal -->

<div id="new-people" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="#" id="people_new_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> New People</h4>
                </div>
                <div class="modal-body">
                    <!-- BEGIN VALIDATION STATES-->
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-body">
                            <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control name" name="name"  placeholder="Enter your name">
                                    <label for="form_control_1">Name
                                        <span class="required">*</span>
                                    </label>
                                    <span class="error"></span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control txtemail email"  name="email" placeholder="Enter your email">
                                    <label class="formLbl" for="form_control_1">Email
                                        <span class="required">*</span>
                                    </label>
                                </div>
                                <div class="add-more-div-section">
                                </div>
                                <div class="add-more-div">
                                    <span class="add-more" data-id="txtemail"><i title="Add one more" class="fa fa-plus-circle"></i></span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control txtnumber"  name="number" placeholder="Enter number">
                                    <label class="formLbl" for="form_control_1">Phone</label>
                                </div>
                                <div class="add-more-div-section">
                                </div>
                                <div class="add-more-div">
                                    <span class="add-more" data-id="txtnumber"><i title="Add one more" class="fa fa-plus-circle"></i></span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" name="name" placeholder="Enter organization name">
                                    <label for="form_control_1">Organization</label>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" name="owner">
                                        <option value="">Select</option>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                                    <label for="form_control_1">Owner</label>
                                </div>                        
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" name="visibility">
                                        <option value="0">Entire Company</option>
                                        <option value="1">Owner & Followers</option>
                                    </select>
                                    <label for="form_control_1">Visibility</label>
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
            </form>
        </div>

    </div>
</div>

<div class="quick-nav-overlay"></div>
