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
                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Enquiry</h4>
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
                                <a href="#" data-id="<?php echo $enquiry[0]['en_unique_id']; ?>" class="deleteenquiry"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                            <li>
                                <a href="#" data-id="<?php echo $enquiry[0]['en_unique_id']; ?>" class="isqualified"><i class="fa fa-phone"></i> Qualify </a>
                            </li>

                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-th"></i> View </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row form-horizontal inquiry-form">
                    <?php
                    echo form_open('enquiries/viewEnquiries', array('id' => 'enquiry-form', 'method' => 'post'));

                    foreach ($enquiry as $row) {
                        ?>
                        <input type="hidden" name="enquiry_id" class="form-control" value="<?php echo $row['enquiry_id']; ?>" />
                        <div class="col-md-12">                        
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="portlet">
                                        <div class="portlet-title">
                                            <div class="caption">                                
                                                <span class="caption-subject font-dark sbold uppercase">Contact Details</span>
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="porlet-section">
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="form_control_1">Move type</label>
                                            <div class="col-md-7">
                                                <select class="form-control" name="en_movetype">
                                                    <option value="">Select</option>
                                                    <?php foreach ($move_type as $mt) {
                                                        ?>

                                                        <option value="<?php echo $row['en_movetype']; ?>"
                                                        <?php
                                                        if ($mt['movetype_id'] == $row['en_movetype']) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $mt['movetype_name']; ?></option>
                                                            <?php } ?>
                                                </select></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-5 control-label">Service date</label>
                                            <div class="col-md-7">
                                                <input class="form-control form-control-inline date-picker" id="servicedate" name="en_servicedate" size="16" type="text" value="<?php echo date("d-m-Y", strtotime($row['en_servicedate'])); ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-5">Service time</label>
                                            <div class="col-md-7">
                                                <input type="text" name="en_servicetime" class="form-control" value="<?php echo $row['en_servicetime']; ?>" /></div>
                                        </div>
                                        <div class="form-group group-relative">
                                            <label class="control-label col-md-5">Name<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control name input-popup" id="enname" name="en_name" value="<?php echo $row['en_fname'] . " " . $row['en_lname']; ?>"></div>
                                            <div class="input-modal">
                                                <span class="input-close"><i class="fa fa-close"></i></span>
                                                <div class="form-group">
                                                    <label class="col-md-12">First Name<span class="required">*</span></label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control name input-popup" id="enfname" name="en_fname" value="<?php echo $row['en_fname']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-12">Last Name<span class="required">*</span></label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control name input-popup" id="enlname" name="en_lname" value="<?php echo $row['en_lname']; ?>">
                                                    </div>
                                                </div><div class="form-group">
                                                    <div class="col-md-12">
                                                        <button type="button" id="namedone" class="btn default">Done</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-5">Phone</label>
                                            <span class="error"></span>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control phone" name="en_phone" value="<?php echo $row['en_phone']; ?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-5">Email</label>
                                            <span class="error"></span>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control email" name="en_email" value="<?php echo $row['en_email']; ?>"></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-5">Removalist</label>
                                            <span class="error"></span>
                                            <div class="col-md-7">
                                                <?php
//                                                print_r($contactfname);
//                                                die;
                                                $contactdecode = json_decode($contactfname, true);
                                                foreach ($contactdecode as $cfname) {
                                                    $name = $cfname;
                                                }
                                                ?>
                                                <input type="hidden" name="contact_id" value="<?php echo $row['contact_id']; ?>">
                                                <input id="removalist"  class="form-control" value="<?php echo $name; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-5">Notes</label>
                                            <span class="error"></span>
                                            <div class="col-md-7">
                                                <textarea class="form-control" name="en_note"><?php echo $row['en_note']; ?></textarea>
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
                                            <h3><span>Send Quote</span> 
                                                <a href="#"  data-id="<?php echo $row['enquiry_id']; ?>"  class="btn blue-madison send-quote-mail">Send Email</a>
                                                <a href="#" data-id="<?php echo $row['enquiry_id']; ?>"  class="btn blue-madison edit-quote-mail">Edit Email</a>
                                            </h3>                                                                
                                            <h3><span>Follow Up Quote</span> 
                                                <a href="#"  data-id="<?php echo $row['enquiry_id']; ?>"  class="btn blue-madison send-follow-quote-mail">Send Email</a>
                                                <a href="#" data-id="<?php echo $row['enquiry_id']; ?>" class="btn blue-madison edit-follow-quote-mail">Edit Email</a>
                                            </h3>                                                                
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
                                                        <input type="text" class="form-control " name="en_movingfrom_street" value="<?php echo $row['en_movingfrom_street']; ?>"></div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Postcode</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="movingfrompostcode" name="en_movingfrom_postcode" value="<?php echo $row['en_movingfrom_postcode']; ?>"></div>
                                                </div> 
                                            </div>
                                        </div>                            
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Suburb</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input id="movingfromsuburb" name="en_movingfrom_suburb" class="form-control suburb" value="<?php echo $row['en_movingfrom_suburb']; ?>">
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">State</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control " id="movingfromstate" name="en_movingfrom_state" value="<?php echo $row['en_movingfrom_state']; ?>"></div>
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
                                                        <input type="text" class="form-control " name="en_movingto_street" value="<?php echo $row['en_movingto_street']; ?>"></div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Postcode</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="movingtopostcode" name="en_movingto_postcode" value="<?php echo $row['en_movingto_postcode']; ?>"></div>
                                                </div> 
                                            </div>
                                        </div>                            
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Suburb</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control suburb" id="movingtosuburb" name="en_movingto_suburb" value="<?php echo $row['en_movingto_suburb']; ?>">
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">State</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control " id="movingtostate" name="en_movingto_state" value="<?php echo $row['en_movingto_state']; ?>"></div>
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
                                                        <input type="text" class="form-control" name="en_addpickup_street" value="<?php echo $row["en_addpickup_street"]; ?>"></div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Postcode</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="addpickuppostcode" name="en_addpickup_postcode" value="<?php echo $row["en_addpickup_postcode"]; ?>"></div>
                                                </div> 
                                            </div>
                                        </div>                            
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Suburb</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control suburb" id="addpickupsuburb" name="en_addpickup_suburb" value="<?php echo $row['en_addpickup_suburb']; ?>">
        <!--                                                    <input type="text" class="form-control " name="en_addpickup_suburb">-->
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">State</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="addpickupstate" name="en_addpickup_state" value="<?php echo $row["en_addpickup_state"]; ?>"></div>
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
                                                        <input type="text" class="form-control " name="en_adddelivery_street" value="<?php echo $row['en_adddelivery_street']; ?>"></div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Postcode</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="adddeliverypostcode" name="en_adddelivery_postcode" value="<?php echo $row['en_adddelivery_postcode']; ?>"></div>
                                                </div> 
                                            </div>
                                        </div>                            
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">Suburb</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control suburb" id="adddeliverysuburb" name="en_adddelivery_suburb" value="<?php echo $row['en_adddelivery_suburb']; ?>">
        <!--                                                    <input type="text" class="form-control " name="en_adddelivery_suburb">-->
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">State</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="adddeliverystate" name="en_adddelivery_state" value="<?php echo $row['en_adddelivery_state']; ?>"></div>
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
                                                    <input type="text" class="form-control input-sm" name="en_deposit_amt" value="<?php echo $row['en_deposit_amt']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">No. of movers</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_no_of_movers" value="<?php echo $row['en_no_of_movers']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">No. of trucks</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_no_of_trucks" value="<?php echo $row['en_no_of_trucks']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Travel Fee (Sell)</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <div class="input-icon input-icon-sm">
                                                    <i class="fa fa-usd"></i>
                                                    <input type="text" class="form-control input-sm" name="en_travelfee" value="<?php echo $row['en_travelfee']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Client Hourly Rate (Sale)</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <div class="input-icon input-icon-sm">
                                                    <i class="fa fa-usd"></i>
                                                    <input type="text" class="form-control input-sm" name="en_client_hourly_rate" value="<?php echo $row['en_client_hourly_rate']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Additional Charges (Sale)</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <div class="input-icon input-icon-sm">
                                                    <i class="fa fa-usd"></i>
                                                    <input type="text" class="form-control input-sm" name="en_additional_charges" value="<?php echo $row['en_additional_charges']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Additional Item</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control phone" name="en_additional_item" value="<?php echo $row['en_additional_item']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Total Sell Price</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <div class="input-icon input-icon-sm">
                                                    <i class="fa fa-usd"></i>
                                                    <input type="text" class="form-control input-sm" name="en_total_sellprice" value="<?php echo $row['en_total_sellprice']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Total Cost Price</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <div class="input-icon input-icon-sm">
                                                    <i class="fa fa-usd"></i>
                                                    <input type="text" class="form-control input-sm" name="en_total_costprice" value="<?php echo $row['en_total_costprice']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Hire a Mover Margin</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_hireamover_margin" value="<?php echo $row['en_hireamover_margin']; ?>">
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
                                                    <?php
                                                    if ($row['en_deposit_received'] == 1) {
                                                        $chk = "checked";
                                                    }
                                                    ?>
                                                    <input type="checkbox" name="en_deposit_received" value="1"<?php echo $chk; ?>>
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
                                                    <option value="1" <?php
                                                    if ($row['en_deposit_paidby'] == 1) {
                                                        echo "selected";
                                                    }
                                                    ?>>Bank transfer</option>
                                                    <option value="2" <?php
                                                    if ($row['en_deposit_paidby'] == 2) {
                                                        echo "selected";
                                                    }
                                                    ?>>Credit card</option>
                                                </select>
                                            </div>
                                            <!--                                        <div class="col-md-6">
                                                                                        <input type="text" class="form-control " name="en_deposit_paidby">
                                                                                    </div>-->
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">eway reference no.</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_eway_refno" value="<?php echo $row['en_eway_refno']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">EFT Received on</label>
                                            <div class="col-md-6">
                                                <input class="form-control form-control-inline date-picker" id="eftreceivedon" name="en_eft_receivedon" size="16" type="text" value="<?php echo date("d-m-Y", strtotime($row['en_eft_receivedon'])); ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-6">EWAY TOKEN</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_eway_token" value="<?php echo $row['en_eway_token']; ?>">
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
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Referral Source</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control phone" name="en_referral_source" value="<?php echo $row['en_referral_source']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="porlet-section">
                                        <div class="form-group">
                                            <label class="control-label col-md-6">Promotional code</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control phone" name="en_promotional_code" value="<?php echo $row['en_promotional_code']; ?>">
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
                    }
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
