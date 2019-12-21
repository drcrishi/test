<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$flashsuccessID = "";
$flasherrorID = "";
$flashsuccess = "";
$flasherror = "";
if ($this->session->flashdata('flashSuccess')) {
    $flashsuccess = $this->session->flashdata('flashSuccess');
    $flashsuccessID = "truemsg";
}
if ($this->session->flashdata('flashError')) {
    $flasherror = $this->session->flashdata('flashError');
    $flasherrorID = "falsemsg";
}
?>
<style>
    #ui-id-1.ui-widget.ui-widget-content {z-index: 999999;}
    #ui-id-2.ui-widget.ui-widget-content {z-index: 999999;}
</style>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <?php include "template/leftmenu.php"; ?>
        <div class="page-content-wrapper">
            <div class="page-content" style="margin-left: 0px;">
                <div class="row peoles-nav-border people-wrapper">
                    <div class="page-bar col-md-2 col-xs-12 col-sm-2 people-left listtit-table" style="margin-left: 0; margin-top: 0px;">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                        </li>
                        <li>
                            <i class="fa fa-circle" style="margin: 5px 5px !important;"></i>
                            <span>Contact List</span>
                        </li>
                    </ul>
                    </div>
                    <div class="col-md-5 col-xs-12 col-sm-2 w-100">
                        <h4 class="peoples-page-title res-float-left"><i class="fa fa-users" style="display: unset"></i>&nbsp;Contact List</h4>
                        <div class="peop-btn-right">
                            <div class="people-toggle">
                                <span></span>
                            </div>
                            <div class="filter-toggle">
                                <button type="button" class="btn dark btn-outline sbold uppercase filter-btn">Filter</button>
                            </div>
                        </div>
                    </div>                    

                    <div class="col-md-5 col-xs-12 col-sm-10 pad-right0 people-right">                           
                        <ul class="nav navbar-nav people-nav">
                            <li>
                                <a href="javascript:void(0)" class="search-toggle" ><i class="fa fa-search"></i> Search</a>
                            </li>
                            <li>
                                <a href="#" class="new-people" data-toggle="modal" data-target="#new-people"><i class="fa fa-plus-circle"></i> New </a>
                            </li>
                            <?php
                                if($this->session->admin_id == '1' || $this->session->admin_id == '2'){
                            ?>
                            <li>
                                <a href="#" class="edit-people" id="deleteContactlist"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                            <?php
                                }
                            ?>
                            <li>
                                <a href="<?php echo base_url("contacts/contactExport"); ?>"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to Excel</a>
                            </li>
                            <li>
                                <a href="#" class="new-people" data-toggle="modal" data-target="#contact-import"><i class="fa fa-database" aria-hidden="true"></i>Import Data </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="contact-import" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        Modal content
                        <div class="modal-content">
                            <?php echo $error; ?> <!-- Error Message will show up here -->
                            <?php echo form_open_multipart('contacts/import_contacts'); ?>
                            <form action="#" id="people_new_form">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Upload Data File</h4>
                                    <?php //if ($this->session->flashdata('flashSuccess')): ?>
                                    <p class='flashMsg hide  flashSuccess' id="<?php echo $flashsuccessID; ?>"> <?php echo $flashsuccess; ?> </p>
                                    <p class='flashMsg hide  flashError' id="<?php echo $flasherrorID; ?>"> <?php echo $flasherror; ?> </p>
                                    <?php //endif ?>
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        <span>Fill all required fields.</span>
                                    </div>
                                    <div class="alert alert-success display-hide"><button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                </div>
                                <div class="modal-body">
                                    <div class="portlet light portlet-fit portlet-form bordered">
                                        <div class="portlet-body">
                                            <div class="form-body">
                                                <label for="form_control_1">Data File Name: </label>
                                                <input required type="file" name="contactfile" id="contactfile" size="20" accept=".xls,.xlsx"  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn green">Upload</button>
                                </div>
                            </form>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered table-div">
                            <div class="table-wrapper">                                
                                <div class="table-scroll">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase"> Your Contacts</span>
                                        </div>                                              
                                    </div>
                                    <div class="filter-wrapper">
                                        <span class="filter-close">&#x2716;</span>
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Contact Type :</label>
                                                    <select class="form-control" name="contact_reltype" id="contact_reltype">
                                                        <option value=""></option>
                                                        <option value="1">Removalist</option>
                                                        <option value="2">Packer</option>
                                                        <option value="3">Client</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">State:</label>
                                                    <select class="form-control" name="contact_state" id="contact_state">
                                                        <option value=""></option>
                                                        <?php
                                                        foreach ($statedata as $st) {
                                                            ?> <option value="<?php echo $st['State']; ?>"><?php echo $st['State']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label xs-remove">&nbsp;</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" placeholder="Contact First Name" id="contact_fname">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label xs-remove">&nbsp;</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" placeholder="Contact Last Name" id="contact_lname">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" placeholder="Contact Email" id="contact_email">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" placeholder="Company Name" id="company_name">
                                                </div>                                                                                                                                 
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" placeholder="Phone" id="phone">
                                                </div> 
                                            </div>

                                            <div class="col-sm-3 col-xs-12">  
                                                <div class="form-group">
                                                    <input type="submit" class="btn green filter-submit" value="Apply" id="apply">
                                                    <input type="submit" class="btn green filter-reset" value="Reset" id="reset">
                                                </div>                                            
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="filter-overlay"></div>

                                    <div class="portlet-body contactlist-table">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="contactlist">
                                            <thead>
                                                <tr>
                                                    <th class="select_all_contact"><input type="checkbox" id="select_all_contact"></th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>											
                                                    <th>State</th>											
                                                    <th>Phone</th>
                                                </tr>
                                            </thead>																	
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="new-people" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <?php echo form_open('contacts/add_contact', array('id' => 'contact-form', 'method' => 'post','autofill' => 'off')); ?>
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
                            <div class="form-group form-md-line-input">
                                <select class="form-control contact-rel" name="contact_reltype">
                                    <option value="">Select</option>
                                    <option value="1">Removalist</option>
                                    <option value="2">Packer</option>
                                    <option value="3">Client</option>
                                </select>
                                <label for="form_control_1">Relationship type<span class="required">*</span></label>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control fname" name="contact_fname" autocomplete="cc-blank" placeholder="Enter your first name">
                                <label for="form_control_1">First Name
                                    <span class="required">*</span>
                                </label>
                                <span class="error"></span>
                            </div>
                            <div class="form-group form-md-line-input hide">
                                <input type="text" class="form-control fname" name="contact_middlename" autocomplete="cc-blank" placeholder="Enter your middle name">
                                <label for="form_control_1">Middle Name
                                </label>
                                <span class="error"></span>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control lname" name="contact_lname" autocomplete="cc-blank" placeholder="Enter your last name">
                                <label for="form_control_1">Last Name
                                    <span class="required">*</span>
                                </label>
                                <span class="error"></span>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="email" class="hide"  name="contact_email" autocomplete="cc-blank" autocorrect="false"  autofill="false" placeholder="Enter your email" >
                                <input type="text" class="form-control txtemail email"  name="contact_email" autocomplete="cc-blank" autocorrect="false"  autofill="false" placeholder="Enter your email" >
                                <label class="formLbl" for="form_control_1">Email
                                    <span class="required">*</span>
                                </label>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="email" class="hide"  name="contact_email2" autocomplete="cc-blank" autocorrect="false"  autofill="false" placeholder="Enter your second email" >
                                <input type="text" class="form-control txtemail email"  name="contact_email2" autocomplete="cc-blank" autocorrect="false"  autofill="false" placeholder="Enter your second email" >
                                <label class="formLbl" for="form_control_1">Email 2</label>
                            </div>
                             <div class="form-group form-md-line-input" id="contact-password">
                                <input type="password" class="form-control password" autocomplete="cc-blank" name="contact_password" placeholder="Enter your password">
                                <label class="formLbl" for="form_control_1">Password
                                    <span class="required"></span>
                                </label>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control"  name="company_name" autocomplete="cc-blank" placeholder="Enter company name">
                                <label class="formLbl" for="form_control_1">Company Name
                                </label>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control txtnumber phno" autocomplete="cc-blank" name="contact_phno" placeholder="Enter phone number">
                                <label class="formLbl" for="form_control_1">Phone</label>
                            </div>

<!--                                <input class="form-control state"  id="contactstate" name="contact_state" placeholder="Enter your state">
                                <label class="formLbl" for="form_control_1">State
                                    <span class="required">*</span>
                                </label>-->

                            <div class="form-group form-md-line-input">
                                <select class="form-control" name="contact_state">
                                    <option value=""></option>
                                    <?php
                                    foreach ($statedata as $st) {
                                        ?> <option value="<?php echo $st['State']; ?>"><?php echo $st['State']; ?></option>
                                    <?php } ?>
                                </select>
                                <label class="formLbl" for="form_control_1">State
                                    <span class="required">*</span>
                                </label>
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
</div>
<div id="edit-contact" class="modal fade edit-contact" role="dialog">
    <div class="modal-dialog">        
        <div class="modal-content">
            <?php echo form_open('contacts/updateContactData', array('id' => 'editcontact-form', 'method' => 'post')); ?>
            <!--                        <form  id="contact-form" method="post">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Edit Contact</h4>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>Fill all required fields.</span>
                </div>
                <div class="alert alert-success display-hide"><button class="close" data-close="alert"></button> Your form validation is successful! </div>
            </div>
            <div class="modal-body">
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-body">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="submit" class="btn green updateContact">Save</button>
            </div>
            <!--</form>-->
            <?php echo form_close(); ?>
        </div>

    </div>
</div>
<script src="<?php echo base_url('assets/custom/js/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom/js/DateTimePicker.min.js'); ?>" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        jQuery('.search-toggle').click(function () {
            jQuery('.filter-wrapper').slideToggle();
        });
            
            jQuery('#contactlist').bind('touchend', function (event) {
            
            var pas = event.target.parentElement.innerHTML;            
            
            //var aaa = jQuery(pas).find('.contactfullname').data('id');
            
            //jQuery(pas).find('a.btn-success').trigger('click');
            var now = new Date().getTime();
            var lastTouch = jQuery(this).data('lastTouch') || now + 1;
            var delta = now - lastTouch;
            if (delta < 500 && delta > 0) {                            
                jQuery('#contactlist tbody tr.select').find('.checkbox_val').prop('checked', false);    
                jQuery('#contactlist tbody tr.select').removeClass('select');
                jQuery('#contactlist tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).parent().addClass('select lasttr');                
                jQuery(pas).find('.contactfullname').remove();
                var mid = jQuery(pas).find('.btn-success').data('id');                
                jQuery('a').each(function(){
                    var aid = jQuery(this).data('id');
                    if(aid == mid){                        
                        jQuery(this).trigger('click');
                    }
                });
                
            } else {                
                
            }
            jQuery(this).data('lastTouch', now);
        });
          
        jQuery("html body").on("click", "#contactlist tbody tr", function (e) {
            var evt = e || window.event
            if (jQuery(this).hasClass('select')) {
                jQuery(this).find('.checkbox_val').prop('checked', false);
                jQuery(this).removeClass('select');
                jQuery(this).removeClass('lasttr');
                jQuery(this).removeClass('select');
                var itm = 0;
                jQuery('#contactlist tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        // jQuery('.dataTables_info').find('span.select-itm').text('');
                        var len = jQuery('#contactlist').find('tr.select').length;
                        if(len  > 0 ){
                            jQuery('.dataTables_info').find('span.select-itm').text(len + ' selected');
                        }else{
                            jQuery('.dataTables_info').find('span.select-itm').text('');
                        }
                    }
                });
            } else {
                if (evt.ctrlKey) {

                } else {
                    //jQuery('#contactlist tbody tr.select').find('.checkbox_val').prop('checked', false);
                    //jQuery('#contactlist tbody tr.select').removeClass('select');
                }

                jQuery(this).addClass('select');
                jQuery('#contactlist tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).addClass('lasttr');
                var itm = 0;
                jQuery('#contactlist tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    }
                });
            }


            if (jQuery(this).hasClass('select')) {
                jQuery(this).find('.checkbox_val').prop('checked', true);
            } else {
                jQuery(this).find('.checkbox_val').prop('checked', false);
            }
        });



        jQuery("html body").on("dblclick", "#contactlist tbody tr", function (e) {
            jQuery(this).find('td a.btn.btn-success').trigger('click');
            jQuery('#contactlist tbody tr.select').find('.checkbox_val').prop('checked', false);            
            jQuery('#contactlist tbody tr.lasttr').removeClass('lasttr');
            jQuery('#contactlist tbody tr.select').removeClass('select');
            jQuery(this).find('.checkbox_val').prop('checked', true);
            jQuery(this).addClass('select lasttr');
        });

        var wd = $(window).width();
        if (wd < 768) {
            jQuery("html body").on("click", "#contactlist tbody tr .contactfullname", function (e) {
                jQuery(this).closest('tr').find('td a.btn.btn-success').trigger('click');
            });
        }

        if (wd < 768) {
            jQuery('select').selectpicker();
        }

        var count = 0;
        jQuery(document).on('keydown', function (e) {
            // You may replace `c` with whatever key you want

            if ((e.metaKey || e.ctrlKey) && e.keyCode == 40) {
                if (jQuery('#contactlist tbody tr:last').hasClass('select')) {
                    jQuery('#contactlist tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#contactlist tbody tr:last').addClass('lasttr');
                } else {
                    jQuery('#contactlist tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#contactlist tbody tr.select:last').next('tr').addClass('select lasttr');
                    jQuery('#contactlist tbody tr.select:last').find('.checkbox_val').prop('checked', 'true');
                    
                    var trh = 0;
                    jQuery('#contactlist tbody tr').each(function (i) {
                        var thh = jQuery(this).innerHeight();
                        trh = trh + thh;
                        if(jQuery(this).hasClass('lasttr')){
                            trh = trh - 200;                            
                    jQuery('.dataTables_scrollBody').animate({
                                scrollTop: trh
                            }, 00);
                        }
                    });
                    var trht = jQuery('#contactlist tbody tr.select').innerHeight();
                    count += trht;
                    var itm = 0;
                    jQuery('#contactlist tbody tr').each(function () {
                        if (jQuery(this).hasClass('select')) {
                            itm += 1;
                            if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                                jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                            } else {
                                jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                            }
                        }
                    });
                }

            } else if ((e.metaKey || e.ctrlKey) && e.keyCode == 38) {
                var trht = jQuery('#contactlist tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#contactlist tbody tr.lasttr').removeClass('lasttr');
                jQuery('#contactlist tbody tr.select:first').prev('tr').addClass('select lasttr');
                jQuery('#contactlist tbody tr.lasttr').find('.checkbox_val').prop('checked', 'true');
                                                
                var trh = 0;
                jQuery('#contactlist tbody tr').each(function (i) {
                    var thh = jQuery(this).innerHeight();
                    trh = trh + thh;                   
                    if(jQuery(this).hasClass('lasttr')){
                        trh = trh - 200;                        
                jQuery('.dataTables_scrollBody').animate({
                            scrollTop: trh
                        }, 00);
                    }
                });
                var itm = 0;
                jQuery('#contactlist tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    }
                });

            }
             else if ((e.shiftKey) && e.keyCode == 40) {            
               var trht = jQuery('#contactlist tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#contactlist tbody tr.select:last').find('.checkbox_val').prop('checked', false);
                jQuery('#contactlist tbody tr.select:last').removeClass('select lasttr');                
                jQuery('#contactlist tbody tr.select.lasttr').removeClass('lasttr');                
                jQuery('#contactlist tbody tr.select:last').addClass('lasttr');                                            
                
                var trh = 0;
                jQuery('#contactlist tbody tr').each(function (i) {
                    var thh = jQuery(this).innerHeight();
                    trh = trh + thh;                    
                    if(jQuery(this).hasClass('lasttr')){
                        trh = trh - 200;                        
                jQuery('.dataTables_scrollBody').animate({
                            scrollTop: trh
                        }, 00);
                    }
                });
                var itm = 0;
                jQuery('#contactlist tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            itm -= 1;
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    }   else {
                        jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                    }
                });

            }  else if ((e.shiftKey) && e.keyCode == 38) {                        
                    jQuery('#contactlist tbody tr.select:first').find('.checkbox_val').prop('checked', false);
                    jQuery('#contactlist tbody tr.select.lasttr').removeClass('lasttr');                    
                    jQuery('#contactlist tbody tr.select:first').removeClass('select');                    
                    jQuery('#contactlist tbody tr.select:first').addClass('lasttr');                       
                    var trht = jQuery('#contactlist tbody tr.select').innerHeight();
                    count -= trht;
                    var trh = 0;
                    jQuery('#contactlist tbody tr').each(function (i) {
                        var thh = jQuery(this).innerHeight();
                        trh = trh + thh;                   
                        if(jQuery(this).hasClass('lasttr')){
                            trh = trh - 200;                            
                    jQuery('.dataTables_scrollBody').animate({
                                scrollTop: trh
                            }, 00);
                        }
                    });
                    
                    var itm = 0;
                    jQuery('#contactlist tbody tr').each(function () {
                        if (jQuery(this).hasClass('select')) {                            
                            itm += 1;
                            if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                                jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                            } else {                                
                                jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                           }
                        }  else {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        }
                    });
            }
        });

    });
</script>
