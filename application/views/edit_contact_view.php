<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!--    <div class="page-wrapper">
         BEGIN HEADER 
        <?php include "template/leftmenu.php"; ?>
         END HEADER 

         BEGIN CONTENT 
        <div class="page-content-wrapper">
             BEGIN CONTENT BODY 
            <div class="page-content" style="margin-left: 0px;">
                 BEGIN PAGE HEADER
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Contact List</span>
                        </li>
                    </ul>
                </div>
                 END PAGE BAR 
                 BEGIN PAGE TITLE

                 END PAGE TITLE
                 END PAGE HEADER
                <div class="row peoles-nav-border people-wrapper">
                    <div class="col-md-1 col-xs-12 col-sm-2 people-left">
                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Contacts</h4>
                        <div class="people-toggle">
                            <span></span>
                        </div>
                    </div>                    

                    <div class="col-md-11 col-xs-12 col-sm-10 pad-right0 people-right">                           
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
                <div class="">
                    <div class="col-md-12">
                         BEGIN EXAMPLE TABLE PORTLET
                        <div class="portlet light bordered table-div">
                            <div class="table-wrapper">
                                <div class="table-scroll">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase"> Your Contacts</span>
                                        </div>                                  
                                    </div>
                                    <div class="alphabet">Search: 
                                        <span class="clear active alphasearch open" id="all">All</span>
                                        <span>
                                            <span class="alphasearch" id="A">A</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="B">B</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="C">C</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="D">D</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="E">E</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="F">F</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="G">G</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="H">H</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="I">I</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="J">J</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="K">K</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="L">L</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="M">M</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="N">N</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="O">O</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="P">P</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="Q">Q</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="R">R</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="S">S</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="T">T</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="U">U</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="V">V</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="W">W</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="X">X</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="Y">Y</span>
                                        </span>
                                        <span>
                                            <span class="alphasearch" id="Z">Z</span>
                                        </span>
                                    </div>

                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="contactlist">
                                            <thead>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <th>Email</th>											
                                                    <th>Company Name</th>											
                                                    <th>Phone</th>											
                                                </tr>
                                            </thead>																	
                                        </table>
                                    </div>
                                </div>
                                 END EXAMPLE TABLE PORTLET
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             END CONTENT BODY 
        </div>
         END CONTENT 

    </div>-->
    <!-- END CONTAINER -->
</div>
<!-- Modal -->

<div id="edit-contact" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <?php echo form_open('contacts/viewContact', array('id' => 'contact-form', 'method' => 'post')); ?>
            <!--            <form action="#" id="people_new_form">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> New Contact</h4>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>Fill all required fields.</span>
                </div>
                <div class="alert alert-success display-hide"><button class="close" data-close="alert"></button> Your form validation is successful! </div>
            </div>
            <div class="modal-body">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <div class="form-body">
                           <input type="hidden" name="contact_id" class="form-control" value="<?php echo $contact['contact_id']; ?>" />
                            <div class="form-group form-md-line-input">
                                <select class="form-control" name="contact_reltype">
                                    <option value="">Select</option>
                                    <option value="1">Removealist</option>
                                    <option value="2">Packer</option>
                                    <option value="3">Client</option>
                                </select>
                                <label for="form_control_1">Relationship type<span class="required">*</span></label>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control fname" name="contact_fname"  placeholder="Enter your first name">
                                <label for="form_control_1">First Name
                                    <span class="required">*</span>
                                </label>
                                <span class="error"></span>
                            </div>
                           <div class="form-group form-md-line-input">
                                <input type="text" class="form-control fname" name="contact_middlename"  placeholder="Enter your middle name">
                                <label for="form_control_1">Middle Name
                                </label>
                                <span class="error"></span>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control lname" name="contact_lname"  placeholder="Enter your last name">
                                <label for="form_control_1">Last Name
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
                                <input type="text" class="form-control"  name="company_name" placeholder="Enter company name">
                                <label class="formLbl" for="form_control_1">Company Name
                                    <span class="required"></span>
                                </label>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control txtnumber phno"  name="contact_phno" placeholder="Enter phone number">
                                <label class="formLbl" for="form_control_1">Phone</label>
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
            <?php echo form_close(); ?>
        </div>

    </div>
</div>
<div class="quick-nav-overlay"></div>