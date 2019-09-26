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
                            <span>Booking</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->

                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row peoles-nav-border people-wrapper">
                    <div class="col-md-1 col-xs-12 col-sm-2 people-left">
                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Booking</h4>
                        <div class="people-toggle">
                            <span></span>
                        </div>
                    </div>                    

                    <div class="col-md-11 col-xs-12 col-sm-10 pad-right0 people-right">                           
                        <ul class="nav navbar-nav people-nav">
                            <li>
                                <a href="<?php base_url("enquiries/new"); ?>" ><i class="fa fa-plus-circle"></i> New </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Email a Link </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Run Report </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Excel Templates </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Export to Excel </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Import Data </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Chart Pane </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Import Data </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class = "row form-horizontal inquiry-form">
                    <?php
                    echo form_open('booking/index', array('id' => 'booking-form', 'method' => 'post'));
                    //    foreach ($enquiry as $row) {
                    ?>

                    <div class="col-md-12">                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">General bookings</span>
                                        </div>                            
                                    </div>
                                </div>
                                <div class="porlet-section">
                                    <div class="form-group">
                                        <label class="col-md-5 control-label" for="form_control_1">Booking status</label>
                                        <div class="col-md-7">
                                            <select class="form-control" id="bookingstatus" name="booking_status">
                                                <option value="1" selected>Current</option>
                                                <option value="2">Other(refer notes)</option>
                                                <option value="3">Completed</option>
                                            </select></div>
                                    </div>
                                    <div class="form-group" id="moveType">
                                        <label class="col-md-5 control-label" for="form_control_1">Move type</label>
                                        <div class="col-md-7">
                                            <select class="form-control" id="enquirymovetype" name="en_movetype">
                                                <option value="">Select</option>
                                                <?php
                                                foreach ($move_type as $mt) {
                                                    ?>

                                                    <option value="<?php echo $mt['movetype_id']; ?>"><?php echo $mt['movetype_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select></div>
                                    </div>
<!--                                    <div class="form-group">
                                        <label class="col-md-5 control-label" for="form_control_1">Home/Office</label>
                                        <span class="error"></span>
                                        <div class="col-md-7">
                                            <select class="form-control" id="homeoffice" name="en_home_office">
                                                <option value="">Select</option>
                                                <option value="1" data-item="Home">Home</option>
                                                <option value="2" data-item="Office">Office</option>
                                            </select>
                                        </div>
                                    </div>-->
                                    <div class="form-group">
                                        <label class="col-md-5 control-label">Service date</label>
                                        <div class="col-md-7">
                                            <input class="form-control form-control-inline date-picker" id="servicedate" name="en_servicedate" size="16" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Service time</label>
                                        <div class="col-md-7">
                                            <input type="text" id="servicetime" name="en_servicetime" class="form-control"/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Client</label>
                                        <div class="col-md-7">
                                            <input type="text" id="customerId" name="contact_data" class="form-control" />
                                            <input type="hidden" id="clientdata" name="customer_id" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Phone</label>
                                        <span class="error"></span>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control phone" name="en_phone"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Email</label>
                                        <span class="error"></span>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control email" name="en_email"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Removalist</label>
                                        <span class="error"></span>
                                        <div class="col-md-7">
                                            <input id="removalist" name="contact_data" class="form-control" >
                                            <input type="hidden" id="removalist_data" name="contact_id" class="form-control" value="">                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-5">Notes</label>
                                        <span class="error"></span>
                                        <div class="col-md-7">
                                            <textarea class="form-control" name="en_note"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label activiti-label col-md-12">Activities <span>Notes</span></label>
                                        <span class="error"></span>
                                        <div class="col-md-12">
                                            <textarea class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Actions</span>
                                        </div>                            
                                    </div>
                                </div>
                                <div class="porlet-section">
                                    <div class="m-heading-1 border-green m-bordered">
                                        <h3><span>Supplier Job Sheet</span> 
                                            <a href="#"  class="btn blue-madison">Send Email</a>
                                            <a href="#" class="btn blue-madison">Edit Email</a></h3>
                                        <h3><span>Customer Booking Confirmation</span> <a href="#"  class="btn blue-madison">Send Email</a>
                                            <a href="#" class="btn blue-madison">Edit Email</a></h3>
                                        <h3><span>Send Feedback</span> <a href="#"  class="btn blue-madison">Send Email</a>
                                            <a href="#" class="btn blue-madison">Edit Email</a></h3>
                                        <h3><span>Send Reminder</span> <a href="#"  class="btn blue-madison">Send Email</a>
                                            <a href="#" class="btn blue-madison">Edit Email</a></h3>
                                    </div>
                                </div>
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Moving From</span>
                                        </div>                            
                                    </div>
                                </div>  
                                <div class="porlet-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Street</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control " name="en_movingfrom_street" ></div>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Postcode</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="movingfrompostcode" name="en_movingfrom_postcode"></div>
                                            </div> 
                                        </div>
                                    </div>                            
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Suburb</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input id="movingfromsuburb" name="en_movingfrom_suburb" class="form-control suburb" >
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">State<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control " id="movingfromstate" name="en_movingfrom_state"></div>
                                            </div> 
                                        </div>
                                    </div>                            
                                </div>
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Moving To</span>
                                        </div>                            
                                    </div>
                                </div>
                                <div class="porlet-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Street</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control " name="en_movingto_street"></div>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Postcode</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="movingtopostcode" name="en_movingto_postcode" ></div>
                                            </div> 
                                        </div>
                                    </div>                            
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Suburb</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control suburb" id="movingtosuburb" name="en_movingto_suburb" >
<!--                                                    <input type="text" class="form-control " id="movingtosuburb" name="en_movingto_suburb">-->
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">State<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control " id="movingtostate" name="en_movingto_state" ></div>
                                            </div> 
                                        </div>
                                    </div>                            
                                </div>
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Additional Pickup</span>
                                        </div>                            
                                    </div>
                                </div> 
                                <div class="porlet-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Street</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="en_addpickup_street"></div>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Postcode</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="addpickuppostcode" name="en_addpickup_postcode"></div>
                                            </div> 
                                        </div>
                                    </div>                            
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Suburb</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control suburb" id="addpickupsuburb" name="en_addpickup_suburb">
<!--                                                    <input type="text" class="form-control " name="en_addpickup_suburb">-->
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">State</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="addpickupstate" name="en_addpickup_state"></div>
                                            </div> 
                                        </div>
                                    </div>                            
                                </div>
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Additional Delivery </span>
                                        </div>                            
                                    </div>
                                </div> 
                                <div class="porlet-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Street</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control " name="en_adddelivery_street"></div>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Postcode</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="adddeliverypostcode" name="en_adddelivery_postcode"></div>
                                            </div> 
                                        </div>
                                    </div>                            
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">Suburb</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control suburb" id="adddeliverysuburb" name="en_adddelivery_suburb">
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-4">State</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" id="adddeliverystate" name="en_adddelivery_state"></div>
                                            </div> 
                                        </div>
                                    </div>                            
                                </div>
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Client Feedback</span>
                                        </div>                            
                                    </div>
                                </div>
                                <div class="porlet-section">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Client feedback</label>
                                        <span class="error"></span>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="client_feedback"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Referral Details</span>
                                        </div>                            
                                    </div>
                                </div>
                                <div class="porlet-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Referral Source</label>
                                                <span class="error"></span>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control " name="en_referral_source"></div>
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-5">Promotional code</label>
                                                <span class="error"></span>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" id="adddeliverypostcode" name="en_promotional_code" ></div>
                                            </div> 
                                        </div>
                                    </div>   
                                </div>                               
                            </div>
                            <div class="col-md-3">
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Pricing Information</span>
                                        </div>                            
                                    </div>
                                </div>
                                <div class="porlet-section">
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Deposit Amount</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon-sm">
                                                <i class="fa fa-usd"></i>
                                                <input type="text" class="form-control input-sm" id="depositamt" name="en_deposit_amt" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">No. of movers</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="movers" name="en_no_of_movers" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">No. of trucks</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="trucks" name="en_no_of_trucks">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Travel Fee (Sell)</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon-sm">
                                                <i class="fa fa-usd"></i>
                                                <input type="text" class="form-control input-sm" id="travelfee" name="en_travelfee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Client Hourly Rate (Sell)</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon-sm">
                                                <i class="fa fa-usd"></i>
                                                <input type="text" class="form-control input-sm" id="clienthourlyrate" name="en_client_hourly_rate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Additional Charges (Sell)</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon-sm">
                                                <i class="fa fa-usd"></i>
                                                <input type="text" class="form-control input-sm" name="en_additional_charges">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Additional charge item</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control phone" name="en_additional_item">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Total Sell Price</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon-sm">
                                                <i class="fa fa-usd"></i>
                                                <input type="text" class="form-control input-sm" name="en_total_sellprice">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Total Cost Price</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon-sm">
                                                <i class="fa fa-usd"></i>
                                                <input type="text" class="form-control input-sm" name="en_total_costprice">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Hire a Mover Margin</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control " name="en_hireamover_margin">
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Payment Information</span>
                                        </div>                            
                                    </div>
                                </div>
                                <div class="porlet-section">
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Deposit Received</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <label class="mt-checkbox deposit-checkbox mt-checkbox-outline">
                                                <input type="checkbox" name="en_deposit_received">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Deposit Paid by</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <select class="form-control" name="en_deposit_paidby">
                                                <option value="">Select</option>
                                                <option value="1">Bank transfer</option>
                                                <option value="2">Credit card</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">eway reference no.</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control " name="en_eway_refno">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">EFT Received </label>
                                        <div class="col-md-6">
                                            <input class="form-control form-control-inline date-picker" id="eftreceivedon" name="en_eft_receivedon" size="16" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Final payment received by</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <select class="form-control" name="final_payment_receivedby">
                                                <option value="">Select</option>
                                                <option value="1">EFT</option>
                                                <option value="2">Credit card</option>
                                                <option value="3">Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Final payment eway reference no</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control " name="final_payment_eway_refno">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Final payment EFT payment </label>
                                        <div class="col-md-6">
                                            <input class="form-control form-control-inline date-picker" id="finaleftpayment" name="final_payment_eft_payment" size="16" type="text" value="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Head office paid</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control " name="head_office_paid">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">Removalist paid</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control " name="removalist_paid">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-6">EWAY TOKEN</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control " name="en_eway_token">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">                                
                                <div class="col-xs-12 text-center">
                                    <button type="submit" class="btn green">Submit</button>

                                </div>                                
                            </div>
                        </div>
                    </div>
                    <?php
                    //   }
                    echo form_close();
                    ?>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
    </div>
    <!-- Modal -->



    <div class="quick-nav-overlay"></div>
    <script>
        jQuery(document).ready(function () {
            var wd = jQuery(window).width();
            if (wd < 768) {
                jQuery('.portlet-title').click(function () {
                    jQuery(this).toggleClass('open');
                    jQuery(this).closest('.portlet').next('.porlet-section').slideToggle();
                });
            }
        });
    </script>
