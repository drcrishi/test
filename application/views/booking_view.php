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
                <div class="row peoles-nav-border people-wrapper">
                    <div class="col-md-1 col-xs-12 col-sm-2 people-left">
                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Booking</h4>
                    </div>   
                    <div class="mititle-btn mid-center"><button type="submit" class="btn green form-submit btn-desk">Save</button></div>
                </div>
                <div class = "row form-horizontal inquiry-form" id="homeOffice">
                    <?php
                    echo form_open_multipart('booking/index', array('id' => 'booking-form', 'method' => 'post'));
                    //    foreach ($enquiry as $row) {
                    ?>
                    <div class="col-md-12">                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="portlet place-inform">
                                    <div class="portlet-title hide-desk">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">General bookings</span>
                                        </div>                            
                                    </div>

                                    <div class="porlet-section">
                                        <?php if (function_exists('validation_errors') && validation_errors() != '') { ?>
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">
                                                    <strong>Error!</strong><?php echo validation_errors(); ?>
                                                    <br /><?php echo $error; ?>
                                                </div>
                                            </div>
                                            <div calss="clearfix"></div>
                                        <?php } ?>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="form_control_1">Booking status<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="bookingstatus" name="booking_status">
                                                    <option value="1" selected>Current</option>
                                                    <option value="2">Other(refer notes)</option>
                                                    <option value="3">Completed</option>
                                                </select></div>
                                        </div>
                                        <div class="form-group" id="moveType">
                                            <label class="col-md-4 control-label" for="form_control_1">Move type<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="enquirymovetype" name="en_movetype">
                                                    <!--                                                <option value="">Select</option>-->
                                                    <?php
                                                    foreach ($move_type as $mt) {
                                                        if ($mt['movetype_id'] == 1) {
                                                            ?><option value="<?php echo $mt['movetype_id']; ?>" selected><?php echo $mt['movetype_name']; ?></option>
                                                            <?php
                                                        } else {
                                                            ?>

                                                            <option value="<?php echo $mt['movetype_id']; ?>"><?php echo $mt['movetype_name']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="storagedate">
                                            <label class="col-md-4 control-label">Date moving into storage</label>
                                            <div class="col-md-8">
                                                <input class="form-control form-control-inline date-picker date-hide" id="movingstoragedate" name="en_storagedate" size="16" type="text" value="" readonly/>
                                                <input type="text" class="movingstoragedate" data-field="date" readonly name="en_storagedate1">
                                            </div>
                                        </div>
                                        <div class="form-group" id="serviceDate">
                                            <label class="col-md-4 control-label">Service date
                                            </label>
                                            <div class="col-md-8">
                                                <input class="form-control form-control-inline date-picker date-hide" id="servicedate" name="en_servicedate" size="16" type="text" value="" readonly/>
                                                <input type="text" class="servicedate" data-field="date" readonly name="en_servicedate1">                                                
                                            </div>
                                        </div>
                                        <input type="hidden" id="serviceFullTime" name="serviceFullTime" class="form-control" /> <!-- 8am, 9am-1pm, 10:30am-2:30pm -->
                                    <div id="hosServiceTimeContainer">
                                        <div class="form-group" id="serviceTime">
                                            <label class="control-label col-md-4">Service time<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <input type="text" id="servicet" name="en_servicetime" class="form-control" /></div>
                                        </div>
                                    </div>

                                        <div id="packerServiceTimeContainer">
                                            <div class="form-group" id="serviceStartTimeDiv">
                                                <label class="control-label col-md-4">Service Start Time<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <?php
                                                    $timeArr =array('6am','7am','8am','9am','10am','11am','12pm','1pm','2pm','3pm','4pm','5pm','6pm','7pm','8pm','9pm');
                                                    $minuteArr = array('00','15','30','45');
                                                    ?>
                                                    <div class="row" id="serviceStartRow">
                                                        <div class="col-md-6 pt-7">
                                                            <select class="form-control" name="serviceTimeStartHour" id="serviceTimeStartHour">
                                                                <!-- <option value="">Hour</option> -->
                                                                <?php 
                                                                foreach ($timeArr as $timeRow) {
                                                                    ?>
                                                                    <option value="<?php echo $timeRow ?>"><?php echo $timeRow ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 pt-7">
                                                            <select class="form-control" name="serviceTimeStartMinute" id="serviceTimeStartMinute">
                                                                <?php 
                                                                foreach ($minuteArr as $minuteRow) {
                                                                    ?>
                                                                    <option value="<?php echo $minuteRow ?>"><?php echo $minuteRow ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="serviceEndTimeDiv">
                                                <label class="control-label col-md-4">Service End Time<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <div class="row" id="serviceEndRow">
                                                        <div class="col-md-6 pt-7">
                                                            <select class="form-control" name="serviceTimeEndHour" id="serviceTimeEndHour">
                                                                <!-- <option value="">Hour</option> -->
                                                                <?php 
                                                                foreach ($timeArr as $timeRow) {
                                                                    ?>
                                                                    <option value="<?php echo $timeRow ?>"><?php echo $timeRow ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 pt-7">
                                                            <select class="form-control" name="serviceTimeEndMinute" id="serviceTimeEndMinute">
                                                                <?php 
                                                                foreach ($minuteArr as $minuteRow) {
                                                                    ?>
                                                                    <option value="<?php echo $minuteRow ?>"><?php echo $minuteRow ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="deliveryDate">
                                            <label class="col-md-4 control-label">Delivery date</label>
                                            <div class="col-md-8">
                                                <input class="form-control form-control-inline date-picker date-hide" id="deliverydate" name="en_deliverydate" size="16" type="text" value="" readonly/>
                                                <input type="text" class="deliverydate" data-field="date" readonly name="en_deliverydate1">
                                            </div>
                                        </div>
                                        <div class="form-group" id="deliveryTime">
                                            <label class="control-label col-md-4">Delivery time</label>
                                            <div class="col-md-8">
                                                <input type="text" id="servicetime1" name="en_deliverytime" class="form-control" /></div>
                                        </div>
                                        <div class="form-group" id="client">
                                            <label class="control-label col-md-4">Client
<!--                                                <span class="required">*</span>-->
                                            </label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <input type="text" id="customerId" name="contact_data" class="form-control client" />
                                                <input type="hidden" id="clientdata" name="customer_id" class="form-control" value="">
                                                <a href="#" class="new-people newclient" data-toggle="modal" data-target="#new-people" data-id="3"><i class="fa fa-plus-circle"></i> New </a>
                                            </div>
                                        </div>
                                        <div class="form-group" id="phone">
                                            <label class="control-label col-md-4">Phone<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <input type="text" id="bookingPhone" class="form-control phone" name="en_phone"></div>
                                        </div>
                                        
                                        <div id="storageProvider">
                                            <!-- <div class="form-group" id="storagePhoneNumber">
                                                <label class="control-label col-md-4">Storage phone number</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="en_storage_phno"></div>
                                            </div> -->
                                            <div class="form-group" id="storagePaymentreminderDateDiv">
                                                <label class="control-label col-md-4">Storage Payment Reminder Date</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input class="form-control form-control-inline date-picker date-hide" data-date-format="dd-mm-yyyy" id="storageReminderDate" size="16" type="text" name="storageReminderDate" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="email">
                                            <label class="control-label col-md-2" style="padding: 5px 0 0 16px;">Email<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-10">
                                                <input type="text" id="bookingEmail" class="form-control email" style="padding: 0px 6px;font-size: 13px;" name="en_email"></div>
                                        </div>
                                        <div class="form-group" id="removealist1" style="margin-top:45px;">
                                            <label class="control-label col-md-4">Removalist
<!--                                                <span class="required">*</span>-->
                                            </label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <input id="removalist" name="removalist_name" class="form-control remname" >
                                                <input type="hidden" id="removalist_data" name="contact_id" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group" id="removalistSelection">
                                            <label class="control-label col-md-4">Removalist Selection</label>
                                            <span class="error"></span>
                                            <div class="col-md-8 ">
                                                <ul class="removalistselection" style="padding:15px;">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group" id="packers">
                                            <label class="control-label col-md-4">Packers</label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <input id="packersdata" name="packers_data" class="form-control packername" >
                                                <input type="hidden" id="packer_data" name="contact_id" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group hide">
                                            <label class="control-label col-md-4">Packer Selection</label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <textarea class="form-control" name="en_packer_selection"></textarea>
    <!--                                            <input type="text" class="form-control" name="en_note">-->
                                            </div>
                                        </div>
                                        <div class="form-group" id="packerSelection">
                                            <label class="control-label col-md-4">Packer Selection</label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <ul class="packer-listed">
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="portlet xs-internal-notes">
                                            <div class="portlet-title">
                                                <div class="caption">                                
                                                    <span class="caption-subject font-dark sbold uppercase">Internal Notes</span>
                                                </div>                            
                                            </div>

                                        <div class="porlet-section">
                                        <div class="form-group">
         <!--                                        <label class="control-label activiti-label col-md-12">Activities <span>Notes</span></label>-->
                                            <span class="error"></span>
                                            <div class="col-md-12">

                                                <div class="activity-tab">
                                                    <div class="actwrap-item">                                                        
                                                        <div class="actwrap-content">
                                                            <div class="activity-area">
                                                                <div class="col-xs-12 clickon-show">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control notestitle" name="notes_description" id="note-area" placeholder="Enter a note"></textarea>
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
                            </div>
                            <div class="col-md-6">
                                <div id="movingFrom">
                                    <div class="portlet">
                                        <div class="portlet-title" id="movingFromlbl">
                                            <div class="caption">                                
                                                <span class="caption-subject font-dark sbold uppercase">Moving From</span>
                                            </div>                            
                                        </div>

                                        <div class="portlet-title" id="packerUnpackerlbl">
                                            <div class="caption">                                
                                                <span class="caption-subject font-dark sbold uppercase">Address</span>
                                            </div>                            
                                        </div>                                    
                                        <div class="porlet-section" id="movingFromtxt">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Street</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control " name="en_movingfrom_street"></div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Postcode</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="movingfrompostcode" name="en_movingfrom_postcode" ></div>
                                                    </div> 
                                                </div>
                                            </div>                            
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group ui-widget">
                                                        <label class="control-label col-md-4">Suburb</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input id="movingfromsuburb" name="en_movingfrom_suburb" class="form-control suburb" >
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">State<span class="required">*</span></label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <select class="form-control movingfromstate" id="movingfromstate" name="en_movingfrom_state">
                                                                <?php
                                                                foreach ($statedata as $st) {
                                                                    ?> <option value="<?php echo $st['State']; ?>"><?php echo $st['State']; ?></option>
                                                                <?php } ?>
                                                            </select>
<!--                                                        <input type="text" class="form-control " id="movingfromstate" name="en_movingfrom_state" >-->
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="portlet">
                                        <div class="portlet-title"  id="storage-provider-address">
                                            <div class="caption">                                
                                                <span class="caption-subject font-dark sbold uppercase">Storage Provider Information</span>
                                            </div>                            
                                        </div>

                                        <div class="porlet-section" id="storage-provider-info">
                                            <div class="row" id="storageDiv">
                                                <div class="col-md-7">
                                                    <div class="form-group" id="storageProviderText">
                                                        <label class="control-label col-md-4">Storage Provider</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <!-- <input type="text" class="form-control" name="en_storage_provider"> -->
                                                            <select name="en_storage_provider" id="en_storage_provider" class="form-control">
                                                                <?php
                                                                    $providerArr=array('','Storage Plus','Super Easy Storage','Holloways Storage','Brilliance Removals');
                                                                    foreach ($providerArr as $providerRow) {
                                                                        ?>
                                                                            <option value="<?php echo $providerRow ?>"><?php echo $providerRow ?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Street</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control " name="en_storage_provider_street">
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Postcode</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="en_storage_provider_postcode" name="en_storage_provider_postcode" ></div>
                                                    </div> 
                                                </div>
                                            </div>                            
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group ui-widget">
                                                        <label class="control-label col-md-4">Suburb</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input id="en_storage_provider_suburb" name="en_storage_provider_suburb" class="form-control suburb" >
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">State</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <select class="form-control en_storage_provider_state" id="en_storage_provider_state" name="en_storage_provider_state">
                                                                <?php
                                                                foreach ($statedata as $st) {
                                                                    ?> <option value="<?php echo $st['State']; ?>"><?php echo $st['State']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>                            
                                        </div>


                                        <div class="porlet-section">              
                                            <div class="row" id="storageAgreementDiv">
                                                <div class="col-md-7">
                                                    <div class="form-group" >
                                                        <label class="control-label col-md-4">Storage agreement received
                                                            <span class="required" aria-required="true">*</span>
                                                        </label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <select name="storageAgreementRecieved" id="storageAgreementRecieved" class="form-control">
                                                                <option value="1">Yes</option>
                                                                <option selected="selected" value="2">No</option>
                                                            </select>
                                                        </div>
                                                    </div>      
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group" >
                                                        <label class="control-label col-md-4">Photo ID Received
                                                            <span class="required" aria-required="true">*</span>
                                                        </label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <select name="photoIdReceived" id="photoIdReceived" class="form-control">
                                                                <option value="1">Yes</option>
                                                                <option selected="selected" value="2">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="portlet-title"  id="movingTolbl">
                                            <div class="caption">                                
                                                <span class="caption-subject font-dark sbold uppercase">Moving To</span>
                                            </div>                            
                                        </div>
                                        <div class="portlet-title" id="packerlbl1">
                                                <div class="caption">                                
                                                    <span class="caption-subject font-dark sbold uppercase">Address</span>
                                                </div>                            
                                        </div>
                                        <div class="porlet-section" id="movingTotxt">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Street</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control " name="en_movingto_street"></div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Postcode</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="movingtopostcode" name="en_movingto_postcode" ></div>
                                                    </div> 
                                                </div>
                                            </div>                            
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Suburb</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
        <!--                                                    <select class="form-control select2me" id="movingtosuburb" name="en_movingto_suburb"></select>-->
                                                            <input type="text" class="form-control suburb" id="movingtosuburb" name="en_movingto_suburb">
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">State<span class="required">*</span></label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <select class="form-control" id="movingtostate" name="en_movingto_state">
                                                                <?php
                                                                foreach ($statedata as $st) {
                                                                    ?> <option value="<?php echo $st['State']; ?>"><?php echo $st['State']; ?></option>
                                                                <?php } ?>
                                                            </select>
<!--                                                        <input type="text" class="form-control " id="movingtostate" name="en_movingto_state" >-->
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="portlet">
                                        <div class="portlet-title" id="additionalPickuplbl">
                                            <div class="caption add_field_button">                                
                                                <span class="caption-subject font-dark sbold uppercase"><span class="help-block"><i class="fa fa-plus"></i></span> Additional Pickup</span>
                                            </div>                            
                                        </div>

                                        <div class="porlet-section additional-wrapper" id="additionalPickuptxt">
                                            <div class="additionalPickuptxt" style="display: none;">
                                                <div class="row postcodepickup">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Street</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="en_addpickup_street[]"></div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Postcode</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control addpickuppostcode" name="en_addpickup_postcode[]" ></div>
                                                        </div> 
                                                    </div>
                                                </div>                            
                                                <div class="row suburbpickup">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Suburb</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
            <!--                                                    <select class="form-control select2me" id="addpickupsuburb" name="en_addpickup_suburb"></select>-->
                                                                <input type="text" class="form-control addpickupsuburb" name="en_addpickup_suburb[]">
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">State</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8 pickup-select">
                                                                <select class="form-control addpickupstate" name="en_addpickup_state[]">
                                                                    <?php
                                                                    foreach ($statedata as $st) {
                                                                        ?> <option value="<?php echo $st['State']; ?>"><?php echo $st['State']; ?></option>
                                                                    <?php } ?>
                                                                </select>
    <!--                                                            <input type="text" class="form-control" id="addpickupstate" name="en_addpickup_state" >-->
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>   
                                                <a class="remove_field" title="Remove"><i class="fa fa-trash"></i></a>                                            
                                                <span class="mob-add-pick"><i class="fa fa-plus"></i>Add Pickup</span>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="portlet" >
                                        <div class="portlet-title" id="additionalDeliverylbl">
                                            <div class="caption add_field_button_delivery">                                
                                                <span class="caption-subject font-dark sbold uppercase"><span class="help-block"><i class="fa fa-plus"></i></span> Additional Delivery </span>
                                            </div>                            
                                        </div>

                                        <div class="porlet-section additional-wrapperdelivery" id="additionalDeliverytxt">
                                            <div class="additionalDeliverytxt" style="display: none;">
                                                <div class="row postcodedelivery">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Street</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control " name="en_adddelivery_street[]"></div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Postcode</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control adddeliverypostcode" name="en_adddelivery_postcode[]" ></div>
                                                        </div> 
                                                    </div>
                                                </div>                            
                                                <div class="row suburbdelivery">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Suburb</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
            <!--                                                    <select class="form-control select2me" id="adddeliverysuburb" name="en_adddelivery_suburb"></select>-->
                                                                <input type="text" class="form-control suburb adddeliverysuburb" name="en_adddelivery_suburb[]">
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">State</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
                                                                <select class="form-control adddeliverystate" name="en_adddelivery_state[]">
                                                                    <?php
                                                                    foreach ($statedata as $st) {
                                                                        ?> <option value="<?php echo $st['State']; ?>"><?php echo $st['State']; ?></option>
                                                                    <?php } ?>
                                                                </select>
    <!--                                                            <input type="text" class="form-control" id="adddeliverystate" name="en_adddelivery_state" >-->
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div> 
                                                <a class="remove_field" title="Remove"><i class="fa fa-trash"></i></a>
                                                <span class="mob-add-del"><i class="fa fa-plus"></i>Add Delivery</span>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <div class="portlet" id="jobsheet-div">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase small">Job Sheet Notes</span>
                                        </div>                            
                                    </div>

                                    <div class="porlet-section">
                                        <div class="form-group" id="notes">
                                            <!--                                            <label class="control-label col-md-3">Job Sheet Notes</label>
                                                                                        <span class="error"></span>-->
                                            <div class="col-md-12">
                                                <textarea class="form-control control-area job-area" name="en_note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="portlet move-inform">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Pricing Information</span>
                                        </div>                            
                                    </div>

                                    <div class="porlet-section">
                                        <div id="storagePrice">
                                            <div class="form-group" id="cubicMetersBooked">
                                                <label class="control-label col-md-6">Modules Taken</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="en_cubic_meters_booked">
                                                </div>
                                            </div>  
                                            <div class="form-group" id="noOfModules">
                                                <label class="control-label col-md-6">No of modules required</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="en_noof_modules_required">
                                                </div>
                                            </div>
                                            <div class="form-group" id="cubicMetersByStorage">
                                                <label class="control-label col-md-6">Cubic meters confirmed by storage company?</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="en_cubic_meters_bystorage">
                                                </div>
                                            </div>
                                            <div class="form-group" id="quotedSellPrice">
                                                <label class="control-label col-md-6">Total Sell Price</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control" name="en_quotedsell_price">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="quotedCostPrice">
                                                <label class="control-label col-md-6">Total Cost Price</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control" name="en_quotedcost_price">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="hireaMoverMargin">
                                                <label class="control-label col-md-6">Hire a Mover Margin</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control " name="en_hireamover_margin">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="porlet-section" id="packingPriceInfo">
                                        <div id="packingPrice">
                                            <div class="form-group" id="depositeAmt">
                                                <label class="control-label col-md-6">Deposit Amount<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control" id="depositamt" name="en_deposit_amt">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="noOfMovers">
                                                <label class="control-label col-md-6">No. of movers<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <select class="form-control select-mover" name="en_no_of_movers1">
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                    <input type="text" class="form-control text-mover" id="movers" name="en_no_of_movers">
                                                </div>
                                            </div>
                                            <div class="form-group" id="noOfTrucks">
                                                <label class="control-label col-md-6">No. of trucks<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <select name="en_no_of_trucks1" id="trucks-select" class="form-control select-trucks">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                    <input type="text" class="form-control text-trucks" id="trucks" name="en_no_of_trucks" style="display: none;" value="1">
                                                </div>
                                            </div>
                                            <div class="form-group" id="clientHourlyRate">
                                                <label class="control-label col-md-6">Client Hourly Rate<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control " id="clienthourlyrate" name="en_client_hourly_rate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="travelFeeSell">
                                                <label class="control-label col-md-6">Callout Fee<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control" id="travelfee" name="en_travelfee">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="travelFeeCost">
                                                <label class="control-label col-md-6">Travel Fee</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control" id="travelfeecost" name="en_travelfee_cost">
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="form-group" id="additionalCharges">
                                                <label class="control-label col-md-6">Additional Charges</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control" name="en_additional_charges" id="additionalChargesinput">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="additionalItem">
                                                <label class="control-label col-md-6">Additional Item</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control phone" name="en_additional_item">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="packingUnpackingPrice">
                                            <div class="form-group" id="initialHoursbooked">
                                                <label class="control-label col-md-6">Initial hours booked<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" id="hoursbooked" class="form-control" name="en_initial_hours_booked">
                                                    <input type="hidden" name="packing-interval-time" id="packing-interval-time">
                                                </div>
                                            </div>

                                            <div class="form-group" id="ladiesBooked">
                                                <label class="control-label col-md-6">No. Of ladies booked<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" id="bookedladies" class="form-control" name="en_ladies_booked">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="caption add_field_button_packers">                                
                                                    <span class="caption-subject font-dark sbold uppercase"><span class="help-block"><i class="fa fa-plus"></i></span> Additional Charges</span>
                                                </div>
                                                <div class="additional-charges-packer-section">
                                            <div class="form-group" id="additionalCharges">
                                                <label class="control-label col-md-6">Additional Charges </label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" disabled="disabled" class="form-control additional-charges-packer" name="en_additional_charges" id="additionalChargesinput">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="additionalItem">
                                                <label class="control-label col-md-6">Additional Item</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" disabled="disabled" class="form-control phone additional-charges-item-packer" name="en_additional_item">
                                                </div>
                                            </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="initialSellPrice">
                                                <label class="control-label col-md-6">Initial Sell Price<span class="required">*</span></label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" id="sellprice" class="form-control" name="en_initial_sellprice">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="totalSellPrice">
                                            <label class="control-label col-md-6">Total Sell Price</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <div class="input-icon input-icon">
                                                    <i class="fa fa-usd"></i>
                                                    <input type="text" id="totalsellprice" class="form-control" name="en_total_sellprice">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="totalCostPrice">
                                            <label class="control-label col-md-6">Total Cost Price</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <div class="input-icon input-icon">
                                                    <i class="fa fa-usd"></i>
                                                    <input type="text" id="costprice" class="form-control" name="en_total_costprice">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="hireaMoverMargin">
                                            <label class="control-label col-md-6">Hire a Mover Margin</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <div class="input-icon input-icon">
                                                    <i class="fa fa-usd"></i>
                                                    <input type="text" id="hamMargin" class="form-control" name="en_hireamover_margin">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="amountDueNow">
                                            <label class="control-label col-md-6"> Amount Due Now</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_amountDueNow">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Payment Information</span>
                                        </div>                            
                                    </div>


                                    <div class="porlet-section" id="depositReceived">
                                        <div class="form-group" id="depositReceive">
                                            <label class="control-label col-md-6">Deposit Received</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <label class="mt-checkbox deposit-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" name="en_deposit_received" value="1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group" id="depositPaidby">
                                            <label class="control-label col-md-6">Deposit Paid by</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <select class="form-control" name="en_deposit_paidby">
                                                    <option value=""></option>
                                                    <option value="2">Credit card</option>
                                                    <option value="1">Bank transfer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="monthPayment">
                                            <label class="control-label col-md-6">First month's payment received?</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <label class="mt-checkbox deposit-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" name="en_month_payment_received" value="1">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group" id="payment_methods">
                                            <label class="control-label col-md-6">Payment method</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <select class="form-control" name="en_paymentmethod">
                                                    <option value=""></option>
                                                    <option value="1">EFT</option>
                                                    <option value="2">Cash</option>
                                                    <option value="3">Eway</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="ewayRefNo">
                                            <label class="control-label col-md-6">eway reference no.</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_eway_refno">
                                            </div>
                                        </div>
                                        <div class="form-group" id="EFTReceivedon">
                                            <label class="control-label col-md-6">EFT Received on</label>
                                            <div class="col-md-6">
                                                <input class="form-control form-control-inline date-picker date-hide" id="eftreceivedon" name="en_eft_receivedon" size="16" type="text" value="" readonly/>
                                                <input type="text" class="eftreceivedon" data-field="date" readonly name="en_eft_receivedon1">
                                                <div id="eftrBox"></div>
                                            </div>
                                        </div>

                                        <div class="form-group" id="anniversarydate">
                                            <label class="control-label col-md-6">Anniversary date for future payments</label>
                                            <div class="col-md-6">
                                                <input class="form-control form-control-inline date-picker date-hide" id="anniversaryDate" name="en_anniversarydate" size="16" type="text" value="" readonly/>
                                                <input type="text" class="anniversaryDate" data-field="date" readonly name="en_anniversarydate1">
                                            </div>
                                        </div>
                                        <div class="form-group" id="ewayrecurringPayment">
                                            <label class="control-label col-md-6">Eway recurring payment setup?</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_ewayrecurring_payment">
                                            </div>
                                        </div>
                                        <div class="form-group" id="futurePaymentLog">
                                            <label class="control-label col-md-6">Future payment log</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_futurepayment_log">
                                            </div>
                                        </div>
                                        <div class="form-group" id="finalPaymentReceivedBy">
                                            <label class="control-label col-md-6">Final payment by</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <select class="form-control" name="final_payment_receivedby">
                                                    <option value=""></option>
                                                    <option value="1">EFT</option>
                                                    <option value="2">Credit card</option>
                                                    <option value="3">Cash</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="fewayRefno">
                                            <label class="control-label col-md-6">Final payment eway reference no</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="final_payment_eway_refno">
                                            </div>
                                        </div>
                                        <div class="form-group" id="feftPayment">
                                            <label class="control-label col-md-6">Final payment EFT payment </label>
                                            <div class="col-md-6">
                                                <input class="form-control form-control-inline date-picker date-hide" id="finaleftpayment" name="final_payment_eft_payment" size="16" type="text" value="" readonly/>
                                                <input type="text" class="finaleftpayment" data-field="date" readonly name="final_payment_eft_payment1">
                                                <div id="finaleftBox"></div>
                                            </div>
                                        </div>
                                       <div class="form-group" id="headofficepaid">
                                            <label class="control-label col-md-6">Head office paid</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="head_office_paid">
                                            </div>
                                        </div>
                                        <div class="form-group" id="removealistpaid">
                                            <label class="control-label col-md-6">Removalist paid</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="removalist_paid">
                                            </div>
                                        </div>
                                        <div class="form-group" id="EWAYTOKEN">
                                            <label class="control-label col-md-6">EWAY TOKEN</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_eway_token">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- packer hours start-->

                                <div class="portlet hours-completed" style="display: none" >
                                    <div class="portlet-title ">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Hours Completed - Billable</span>
                                        </div>                            
                                    </div>
                                    <div class="porlet-section" id="packer_hours">

                                    </div>
                                </div>

                                <div class="portlet hours-completed" style="display: none" >
                                    <div class="portlet-title ">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">Hours Completed - Non-billable</span>
                                        </div>                            
                                    </div>
                                    <div class="porlet-section" id="packer_hours_non_billable">

                                    </div>
                                </div>

                                <!-- packer hours end --> 
                            </div>
                            <div class="form-actions">                                
                                <div class="col-xs-12 text-center">
                                    <button type="submit" class="btn green form-submit btn-mobile">Save</button>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
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
                <?php echo form_open('contacts/add_contact', array('id' => 'contact-form', 'method' => 'post')); ?>
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
                                <div class="form-group form-md-line-input">
                                    <select class="form-control reltypeforclient" name="contact_reltype">
                                        <option value="">Select</option>
                                        <option value="1">Removalist</option>
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
                                <div class="form-group form-md-line-input" id="mname">
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
                                <div class="form-group form-md-line-input" id="company">
                                    <input type="text" class="form-control"  name="company_name" placeholder="Enter company name">
                                    <label class="formLbl" for="form_control_1">Company Name
                                    </label>
                                </div>
                                <div class="form-group form-md-line-input" id="phoneno">
                                    <input type="text" class="form-control txtnumber phno"  name="contact_phno" placeholder="Enter phone number">
                                    <label class="formLbl" for="form_control_1">Phone</label>
                                </div>
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

    <div id="serviceBox"></div>
    <div class="quick-nav-overlay"></div>
    <script src="<?php echo base_url('assets/custom/js/bootstrap-filestyle.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/custom/js/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/custom/js/DateTimePicker.min.js'); ?>" type="text/javascript"></script>

    <script>
        jQuery(document).ready(function () {
            var wd = jQuery(window).width();
            if (wd < 768) {
                jQuery('body').on('click', '.portlet-title', function () {
                    if (jQuery(this).hasClass('open')) {
                        jQuery(this).removeClass('open');
                        jQuery(this).closest('.portlet').find('.porlet-section:not(.fhide)').slideUp();
                    } else {
                        jQuery(this).addClass('open');
                        jQuery(this).closest('.portlet').find('.porlet-section:not(.fhide)').slideDown();
                    }
                });
            }

            if (wd < 768) {
                jQuery('select').selectpicker();
                jQuery('#trucks-select').selectpicker('destroy');
                jQuery("#serviceBox").DateTimePicker({
                    dateFormat: "dd-MM-yyyy",
                });
                jQuery('html, body').on('change', '.servicedate', function () {
                    var td = jQuery(this).val();
                    jQuery('#servicedate').val(td);
                });

//               jQuery("#eftrBox").DateTimePicker({
//                    dateFormat: "yyyy-MM-dd",
//               });
                jQuery('html, body').on('change', '.eftreceivedon', function () {
                    var td = jQuery(this).val();
                    jQuery('#eftreceivedon').val(td);
                });

//               jQuery("#finaleftBox").DateTimePicker({
//                    dateFormat: "yyyy-MM-dd",
//               });
                jQuery('html, body').on('change', '.finaleftpayment', function () {
                    var td = jQuery(this).val();
                    jQuery('#finaleftpayment').val(td);
                });

                jQuery('html, body').on('change', '.movingstoragedate', function () {
                    var td = jQuery(this).val();
                    jQuery('#movingstoragedate').val(td);
                });

                jQuery('html, body').on('change', '.deliverydate', function () {
                    var td = jQuery(this).val();
                    jQuery('#deliverydate').val(td);
                });

                jQuery('html, body').on('change', '.anniversaryDate', function () {
                    var td = jQuery(this).val();
                    jQuery('#anniversaryDate').val(td);
                });
                
                var mclon = jQuery('.move-inform').clone();
                jQuery('.move-inform').remove();
                jQuery('.place-inform').after(mclon);

            }

            jQuery('.fileinput-button input').change(function (e) {
                var aval = jQuery('.fileinput-button input').val();
                jQuery('.activity-file').text(aval.replace(/C:\\fakepath\\/i, ''));
            });

            jQuery('.form-submit.btn-desk').click(function () {
                jQuery("#booking-form").trigger("submit");
            });
            jQuery(":file").filestyle({buttonBefore: true});


            if (wd > 767) {
                //Additional pickup and delivery ...............................
                var bbb = jQuery('.additionalPickuptxt:first').html();
                jQuery('body').on('click', '.add_field_button', function () {
                    jQuery('.additional-wrapper').append('<div class="additionalPickuptxt">' + bbb + '</div>');
                    jQuery('.additional-wrapper .additionalPickuptxt:last').find('input').val('');
                });

                var ddd = jQuery('.additionalDeliverytxt:first').html();
                jQuery('body').on('click', '.add_field_button_delivery', function () {
                    jQuery('.additional-wrapperdelivery').append('<div class="additionalDeliverytxt">' + ddd + '</div>');
                    jQuery('.additional-wrapperdelivery .additionalDeliverytxt:last').find('input').val('');
                });
                jQuery('.additionalPickuptxt').remove();
                jQuery('.additionalDeliverytxt').remove();

            } else {
                //Additional pickup and delivery ...............................
                var bbb = jQuery('.additionalPickuptxt:first').html();
                jQuery('body').on('click', '.mob-add-pick', function () {
                    jQuery('.additional-wrapper').append('<div class="additionalPickuptxt">' + bbb + '</div>');
                    jQuery('.additional-wrapper .additionalPickuptxt:last').find('input').val('');
                });

                var ddd = jQuery('.additionalDeliverytxt:first').html();
                jQuery('body').on('click', '.mob-add-del', function () {
                    jQuery('.additional-wrapperdelivery').append('<div class="additionalDeliverytxt">' + ddd + '</div>');
                    jQuery('.additional-wrapperdelivery .additionalDeliverytxt:last').find('input').val('');
                });
            }

            jQuery('body').on('click', '.remove_field', function () {
                if (wd > 767) {
                    jQuery(this).closest('.additionalPickuptxt').remove();
                    jQuery(this).closest('.additionalDeliverytxt').remove();
                } else {
                    var clnt = jQuery(this).closest('.additional-wrapper').find('.additionalPickuptxt').length;
                    if (clnt < 2) {
                        jQuery(this).closest('.additional-wrapper').append('<span class="mob-add-pick ext-mob-pick"><i class="fa fa-plus"></i>Add Pickup</span>');
                        jQuery(this).closest('.additionalPickuptxt').remove();
                    } else {
                        jQuery(this).closest('.additionalPickuptxt').remove();
                    }


                    var plnt = jQuery(this).closest('.additional-wrapperdelivery').find('.additionalDeliverytxt').length;
                    if (plnt < 2) {
                        jQuery(this).closest('.additional-wrapperdelivery').append('<span class="mob-add-del ext-mob-pick"><i class="fa fa-plus"></i>Add Delivery</span>');
                        jQuery(this).closest('.additionalDeliverytxt').remove();
                    } else {
                        jQuery(this).closest('.additionalDeliverytxt').remove();
                    }

                }

            });

            jQuery('body').on('click', '.ext-mob-pick', function () {
                jQuery(this).remove();
            });

            jQuery('body').on('click', '.remove_field', function () {
                jQuery(this).closest('.additionalPickuptxt').remove();
            });

            jQuery('body').on('click', '.remove_field', function () {
                jQuery(this).closest('.additionalDeliverytxt').remove();
            });
//Additional pickup and delivery ...............................


            var melv = jQuery('select.select-mover').val();
            jQuery('#movers').val(melv);

            jQuery('body').on('change', 'select.select-mover', function () {
                var selv = jQuery(this).val();
                if (selv == '2' || selv == '3' || selv == '4' || selv == '5' || selv == '6') {
                    if (selv == '3') {
                        // jQuery('#travelfee').val('80.00');
                        // jQuery('#clienthourlyrate').val('160.00');
                        jQuery('#movers').val(selv);
                    } else {
                        // jQuery('#travelfee').val('60.00');
                        // jQuery('#clienthourlyrate').val('120.00');
                        jQuery('#movers').val(selv);
                    }
                } else {
                    jQuery(this).addClass('select-hide');
                    jQuery('.text-mover').val('').show().focus();
                    jQuery('#travelfee').val('');
                    jQuery('#clienthourlyrate').val('');
                }
            });

            jQuery('body').on('blur', '.text-mover', function () {
                var texv = jQuery(this).val();
                if (texv == '2' || texv == '3' || texv == '4' || texv == '5' || texv == '6') {
                    jQuery('.text-mover').hide();
                    jQuery('select.select-mover').removeClass('select-hide').val(texv);
                    if (texv == '3') {
                        // jQuery('#travelfee').val('80.00');
                        // jQuery('#clienthourlyrate').val('160.00');
                    } else {
                        // jQuery('#travelfee').val('60.00');
                        // jQuery('#clienthourlyrate').val('120.00');
                    }
                }
            });

            // 25-04-19 number of trucks start

            jQuery('body').on('change', 'select.select-trucks', function () {
                var selv = jQuery(this).val();
                if (selv == '1' || selv == '2' || selv == '3') {
                    jQuery('#trucks').val(selv);
                } else {
                    jQuery(this).css('display','none');
                    jQuery('#trucks').val('').show().focus();
                    jQuery('#travelfee').val('');
                    jQuery('#clienthourlyrate').val('');
                }
            });

            jQuery('body').on('blur', '#trucks', function () {
                var texv = jQuery(this).val();
                if (texv == '1' || texv == '2' || texv == '3') {
                    jQuery('#trucks').css('display','none');
                    jQuery(".select-trucks").val(texv).change();
                    // jQuery('select.select-trucks option[value='+ texv+']').attr('selected','selected');
                    jQuery('select.select-trucks').css('display','block');
                }
            });

            // 25-04-19 number of trucks end

            jQuery('select.movingfromstate').on('change', function () {
                jQuery('#removalist').val('');
            });

            jQuery('.newclient').click(function () {
                changeFlag = false;
                focusFlag = false;
                var id = jQuery(this).data('id');
                // alert(id);

                jQuery('select.reltypeforclient option').each(function (index, value) {
                    var selval = jQuery(this).val();
                    if (id == selval) {
                        jQuery(this).attr({"selected": true});
                        if (id == 1) {
                            jQuery("#company").addClass('fhide');
                            jQuery("#mname").addClass('fhide');
                            jQuery("#phoneno").addClass('fhide');
                        } else if (id == 2) {
                            jQuery("#company").addClass('fhide');
                            jQuery("#mname").addClass('fhide');
                            jQuery("#phoneno").addClass('fhide');
                        } else if (id == 3) {
                            jQuery("#mname").addClass('fhide');
                             jQuery("#company").removeClass('fhide');
                        jQuery("#phoneno").removeClass('fhide');
                        }
                    }
                })
            })
        });
    </script>
