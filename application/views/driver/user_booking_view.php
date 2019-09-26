<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo "<pre>";
//print_r($clientname['contact_fname']." ".$clientname['contact_lname']);
//die;
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php // require "../../template/userleftmenu.php"; ?>
        <?php $this->load->view("template/userleftmenu"); ?>

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
                            <a href="<?php echo base_url("driver/userbookinglist"); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>View Booking</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->

                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row peoles-nav-border people-wrapper">
                    <div class="col-md-4 col-xs-12 col-sm-2 people-left">
                        <?php if (!empty($clientname)) {
                            ?> 
                            <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Booking - <?php echo ucwords(strtolower($clientname['contact_fname'] . " " . $clientname['contact_lname'])); ?></h4>
                        <?php } else { ?>
                            <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Booking </h4>
                        <?php } ?>
                        <div class="peop-btn-right">
                            <div class="people-toggle">
                                <span></span>
                            </div>
                        </div>
                    </div>                    

                    <!--                    <div class="mititle-btn">
                                            <button type="submit" class="btn green form-submit btn-desk" id="sub">Save</button>
                                            <a href="#" data-id="<?php echo $enquiry[0]['en_unique_id']; ?>" class="disQualify view-mid-btn">Deactivate </a>
                                        </div>-->

                    <!--                    <div class="col-md-8 col-xs-12 col-sm-10 pad-right0 people-right">                           
                                            <ul class="nav navbar-nav people-nav">                            
                    <?php if ($enquiry[0]['booking_status'] == "1") {
                        ?>
                                                                        <li>
                                                                            <a href="#" data-id="<?php echo $enquiry[0]['en_unique_id']; ?>"><i class="fa fa-ban"></i> Deactivate </a>
                                                                        </li>
                    <?php } else {
                        ?>
                                                                        <li></li>
                    <?php } ?>
                                                <li>
                                                    <a href="#" id="duplicateBookingform" data-id="<?php echo $enquiry[0]['en_unique_id']; ?>" class="edit-people"><i class="fa fa-clipboard" aria-hidden="true"></i> Duplicate </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-id="<?php echo $enquiry[0]['en_unique_id']; ?>" class="deletebooking"><i class="fa fa-trash-o"></i> Delete </a>
                                                </li>
                                            </ul>
                                        </div>-->
                </div>
                <div class = "row form-horizontal inquiry-form" id="homeOffice">
                    <?php
                    echo form_open_multipart('booking/viewBooking', array('id' => 'booking-form', 'method' => 'post'));
//                    foreach ($enquiry as $row) {
                    ?>
                    <input type="hidden" name="enquiry_id" class="form-control" value="<?php echo $enquiry[0]['enquiry_id']; ?>" />
                    <div class="col-md-12">                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="portlet">
                                    <div class="portlet-title hide-desk">
                                        <div class="caption">                                
                                            <span class="caption-subject font-dark sbold uppercase">General bookings</span>
                                        </div>                            
                                    </div>

                                    <div class="porlet-section">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" for="form_control_1">Booking status<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="bookingstatus" name="booking_status" disabled>
                                                    <!--                                                <option value="">Select</option>-->
                                                    <option value="1" <?php
                                                    if ($enquiry[0]['booking_status'] == 1) {
                                                        echo "selected";
                                                    }
                                                    ?>>Current</option>
                                                    <option value="2" <?php
                                                    if ($enquiry[0]['booking_status'] == 2) {
                                                        echo "selected";
                                                    }
                                                    ?>>Other(refer notes)</option>
                                                    <option value="3" <?php
                                                    if ($enquiry[0]['booking_status'] == 3) {
                                                        echo "selected";
                                                    }
                                                    ?>>Completed</option>

                                                </select></div>
                                        </div>
                                        <div class="form-group" id="moveType">
                                            <label class="col-md-4 control-label" for="form_control_1">Move type<span class="required">*</span></label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="enquirymovetype" name="en_movetype" disabled>
                                                    <!--                                                <option value="">Select</option>-->
                                                    <?php
                                                    foreach ($move_type as $mt) {
                                                        ?>

                                                        <option value="<?php echo $mt['movetype_id']; ?>"
                                                        <?php
                                                        if ($mt['movetype_id'] == $enquiry[0]['en_movetype']) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $mt['movetype_name']; ?></option>
                                                            <?php } ?>
                                                </select></div>
                                        </div>

                                        <div class="form-group" id="storagedate">
                                            <label class="col-md-4 control-label">Date moving into storage</label>
                                            <div class="col-md-8">
                                                <?php
                                                if ($enquiry[0]['en_storagedate'] == NULL) {
                                                    $storagedate = "";
                                                } else {
                                                    $storagedate = date("d-m-Y", strtotime($enquiry[0]['en_storagedate']));
                                                }
                                                ?>
                                                <input class="form-control form-control-inline date-picker date-hide" id="movingstoragedate" name="en_storagedate" size="16" type="text" value="<?php echo $storagedate; ?>" readonly/>
                                                <input type="text" class="movingstoragedate" data-field="date" readonly name="en_storagedate1" value="<?php echo $storagedate; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="serviceDate">
                                            <label class="col-md-4 control-label">Service date<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <?php
                                                if ($enquiry[0]['en_servicedate'] == NULL) {
                                                    $servicedate = "";
                                                } else {
                                                    $servicedate = date("d-m-Y", strtotime($enquiry[0]['en_servicedate']));
                                                }
                                                ?>
                                                <input class="form-control form-control-inline date-picker date-hide" id="" name="en_servicedate" size="16" type="text" value="<?php echo $servicedate; ?>" readonly/>
                                                <input type="text" class="servicedate" data-field="date" readonly name="en_servicedate1" value="<?php echo $servicedate; ?>">

                                            </div>
                                        </div>
                                        <div class="form-group" id="serviceTime">
                                            <label class="control-label col-md-4">Service time<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <input type="text" id="service" name="en_servicetime" class="form-control servicetime" value="<?php echo $enquiry[0]['en_servicetime']; ?>" readonly/></div>
                                        </div>
                                        <div class="form-group" id="deliveryDate">
                                            <label class="col-md-4 control-label">Delivery date</label>
                                            <div class="col-md-8">
                                                <?php
                                                if ($enquiry[0]['en_deliverydate'] == NULL) {
                                                    $deliverydate = "";
                                                } else {
                                                    $deliverydate = date("d-m-Y", strtotime($enquiry[0]['en_deliverydate']));
                                                }
                                                ?>
                                                <input class="form-control form-control-inline date-picker date-hide" id="deliverydate" name="en_deliverydate" size="16" type="text" value="<?php echo $deliverydate; ?>" readonly/>
                                                <input type="text" class="deliverydate" data-field="date" readonly name="en_deliverydate1" value="<?php echo $deliverydate; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="deliveryTime">
                                            <label class="control-label col-md-4">Delivery time</label>
                                            <div class="col-md-8">
                                                <input type="text" id="servicetime1" name="en_deliverytime" class="form-control" value="<?php echo $enquiry[0]['en_deliverytime']; ?>" readonly/></div>
                                        </div>
                                        <div class="form-group" id="client">
                                            <label class="control-label col-md-4">Client
<!--                                                <span class="required">*</span>-->
                                            </label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <?php
                                                $contactdecode1 = json_decode($contactname, true);
                                                foreach ($contactdecode1 as $cname) {
                                                    $name1 = $cname;
                                                }
                                                ?>
                                                <input type="text" id="customerId" name="contact_data" class="form-control " value="<?php echo $name1; ?>" readonly/>
                                                <input type="hidden" id="clientdata" name="customer_id" class="form-control client" value="<?php echo $enquiry[0]['customer_id']; ?>" readonly>
    <!--                                            <input type="text" id="customerId"  class="form-control" value="<?php echo $name1; ?>" />
                                                <input type="hidden" name="customer_id" value="<?php echo $enquiry[0]['customer_id']; ?>">-->

                                            </div>
                                        </div>
                                        <div class="form-group" id="phone">
                                            <label class="control-label col-md-4">Phone<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <input type="text" id="bookingPhone" class="form-control phone" name="en_phone" value="<?php echo $enquiry[0]['en_phone']; ?>" readonly></div>
                                        </div>
                                        <div class="form-group" id="email">
                                            <label class="control-label col-md-4">Email<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <input type="text" id="bookingEmail" class="form-control email" name="en_email" value="<?php echo $enquiry[0]['en_email']; ?>" readonly></div>
                                        </div>
                                        <div id="storageProvider">
                                            <div class="form-group" id="storageProvider">
                                                <label class="control-label col-md-4">Storage provider</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="en_storage_provider" value="<?php echo $enquiry[0]['en_storage_provider']; ?>" readonly></div>
                                            </div>
                                            <div class="form-group" id="storageAddress">
                                                <label class="control-label col-md-4">Storage address</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="en_storage_address" value="<?php echo $enquiry[0]['en_storage_address']; ?>" readonly></div>
                                            </div>
                                            <div class="form-group" id="storagePhoneNumber">
                                                <label class="control-label col-md-4">Storage phone number</label>
                                                <span class="error"></span>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" name="en_storage_phno" value="<?php echo $enquiry[0]['en_storage_phno']; ?>" readonly></div>
                                            </div>
                                        </div>
                                        <div class="form-group hide" id="removealist1">
                                            <label class="control-label col-md-4">Removalist
<!--                                                <span class="required">*</span>-->
                                            </label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <input id="removalist" name="removalist_name" class="form-control remname" value="" readonly>
                                                <input type="hidden" id="removalist_data" name="contact_id" class="form-control removalistname" value="<?php echo $enquiry[0]['contact_id']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group" id="removalistSelection">
                                            <label class="control-label col-md-4">Removalist</label>
                                            <span class="error"></span>
                                            <div class="col-md-8 ">
                                                <ul class="removalistselection" style="padding:15px;">
                                                    <?php
                                                    if ($enquiry[0]['en_movetype'] == 1 || $enquiry[0]['en_movetype'] == 2) {
                                                        foreach ($contactfname as $re) {
                                                            $contactid = $re['contact_id'];
                                                            $contactfname = $re['contact_fname'] . " " . $re['contact_lname'];
                                                            $contact_state = $re['contact_state'];
                                                            ?>
                                                            <li class="removalist<?php echo $contactid; ?>" data-id="<?php echo $contactid; ?>"><?php echo $contactfname; ?></li>    
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
<!--                                        <div class="form-group" id="packers">
                                            <label class="control-label col-md-4">Packers
                                            </label>
                                            <span class="error"></span>
                                            <div class="col-md-8">

                                                <input id="packersdata" name="packers_data" class="form-control packername" value="" readonly>
                                                <input type="hidden" id="packer_data" name="contact_id" class="form-control" value="<?php echo $enquiry[0]['contact_id']; ?>" readonly>
                                            </div>
                                        </div>-->
                                        <!--                                    <div class="form-group" id="packerSelection">
                                                                                <label class="control-label col-md-5">Packer Selection</label>
                                                                                <span class="error"></span>
                                                                                <div class="col-md-7">
                                                                                    <textarea class="form-control" name="en_packer_selection"><?php echo $enquiry[0]['en_packer_selection']; ?></textarea>
                                                                                </div>
                                                                            </div>-->
                                        <div class="form-group" id="packerSelection">
                                            <label class="control-label col-md-4">Packer</label>
                                            <span class="error"></span>
                                            <div class="col-md-8">
                                                <ul class="packer-listed">
                                                    <?php
                                                    if ($enquiry[0]['en_movetype'] == 4 || $enquiry[0]['en_movetype'] == 5) {
                                                        foreach ($packersdata as $al) {
                                                            $contact_id = $al['contact_id'];
                                                            $contact_fname = $al['contact_fname'] . " " . $al['contact_lname'];
                                                            $contact_state = $al['contact_state'];
                                                            //$email_log_editor = $al['email_log_editor'];
                                                            ?>
                                                            <li class="packer<?php echo $contact_id; ?>" data-id="<?php echo $contact_id; ?>"><?php echo $contact_fname; ?></li>    
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </ul>

<!--                                                    <textarea class="form-control" name="en_packer_selection"><?php echo $row['en_packer_selection']; ?></textarea>-->
<!--                                            <input type="text" class="form-control" name="en_note">-->
                                            </div>
                                        </div>
                                        

                                        <!--                                        <div class="form-group">
                                                                                    <label class="control-label activiti-label col-md-12">Activities <span>Notes</span></label>
                                                                                    <span class="error"></span>
                                                                                    <div class="col-md-12">
                                        
                                                                                        <div class="activity-tab">
                                                                                            <div class="actwrap-item">
                                                                                                <div class="actwrap-title">
                                                                                                    <span>Internal Notes</span>
                                                                                                </div>
                                                                                                <div class="actwrap-content">
                                        
                                                                                                    <div class="activity-area">
                                                                                                        <input type="hidden" name="created_by" value="<?php echo $enquiry[0]['username']; ?>" id="createdby">                                                                
                                                                                                        <div class="col-xs-12 clickon-show">
                                                                                                            <div class="form-group">
                                                                                                                <textarea class="form-control" name="notes_description" placeholder="Enter a note" id="note-area" readonly></textarea>
                                                                                                            </div>
                                                                                                        </div>                                                        
                                                                                                        <div class="col-xs-12 showon-area">
                                                                                                            <div class="form-group">                                                                                                            
                                                                                                                <input type="file" class="filestyle" id="note-attachfile" name="notes_attachedfile" accept="gif,jpg,png,jpeg" data-buttonBefore="true" data-placeholder="No file" data-text="<b>+</b> Add files">
                                                                                                                <span class="activity-file"></span>
                                                                                                                <button type="button" class="btn btn-info pull-right fileupload" id="notesubmit">Done</button>
                                                                                                            </div> 
                                                                                                        </div>
                                        
                                                                                                        <div class="activity-notes">                                                                     
                                        <?php
//                                                                        echo "<pre>";
//                                                                        print_r($notes);
//                                                                        die;

                                        foreach ($notes as $nt) {
                                            // echo $nt['notes_id'];
                                            $notesid = explode("##", $nt['nid']);
                                            krsort($notesid);
                                            $notestitle = explode("##", $nt['nt']);
                                            $notesd = explode("##", $nt['nd']);
                                            $notesda = explode("##", $nt['ndate']);
                                            $nattach = explode("##", $nt['nattach']);

                                            $adminuser = $nt['admin_firstname'];
                                            $notesdate = $nt['notes_date'];
                                            $notesattach = $nt['notes_attachedfile'];
                                            foreach ($notesid as $notesidkey => $notesidValue) {
                                                $notesID = $notesidValue;
                                                if (isset($notestitle[$notesidkey])) {
                                                    $notesTitle = $notestitle[$notesidkey];
                                                }
                                                if (isset($notesd[$notesidkey])) {
                                                    $notesDesc = $notesd[$notesidkey];
                                                }
                                                if (isset($notesda[$notesidkey])) {
                                                    $notesDate = $notesda[$notesidkey];
                                                }
                                                if (isset($nattach[$notesidkey])) {
                                                    $notesAttach = $nattach[$notesidkey];
                                                }
//                                                
                                                ?> 
                                                                                                                                    <div class="activity-item">
                                                                                                                                        <span class="close-notes" data-id="<?php echo $notesID; ?>">&#10006;</span>
                                                                                                                                                <h6><?php //echo $notesTitle;                            ?></h6>
                                                        
                                                                                                                                        <p><?php echo $notesDesc; ?></p>
                                                <?php
                                                if ($notesAttach == "") {
                                                    
                                                } else {
                                                    ?> 
                                                                
                                                                                                                                                    <p><a href="<?php echo base_url() . 'enquiries/downloadNotes/' . $notesID; ?> "> Attachment </a></p>
                                                <?php } ?>
                                                        
                                                                                                                                        <p>
                                                                                                                                            <a href="#"><?php echo $adminuser; ?></a>
                                                <?php
                                                $date = $notesDate;
                                                echo date('d-m-Y h:i:s A', strtotime($date));
                                                //  echo date("d-m-Y H:m:s A", strtotime($notesda[$zz++])); 
                                                ?>
                                                                                                                                        </p></div>
                                                <?php
                                            }
                                        }
                                        ?>
                                                                                                        </div>
                                                                                                    </div>  
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="actwrap-item">
                                                                                                <div class="actwrap-title">
                                                                                                    <span>Activities</span>
                                                                                                </div>
                                                                                                <div class="actwrap-content">
                                                                                                    <div class="mt-actions">
                                        
                                        <?php if (!empty($activitylog)) { ?>                                                                               
                                            <?php
                                            foreach ($activitylog as $al) {
                                                $adminname = $al['admin_firstname'];
                                                $sub = $al['email_log_subject'];
                                                $tempmasterId = $al['email_master_id'];
                                                $emailto = unserialize($al['email_log_to']);
                                                $email_log_editor = $al['email_log_editor'];
                                                $email_log_time = date('d/m/Y h:i:s A', strtotime($al['email_log_date']));
                                                if ($tempmasterId == "16" || $tempmasterId == "17" || $tempmasterId == "13" || $tempmasterId == "14") {

                                                    if (is_array($emailto)) {
                                                        $newemail1 = $emailto;
                                                        $newemail2 = "";
                                                        foreach ($newemail1 as $newemailto) {
                                                            $newemail2 .= $newemailto . ", ";
                                                            $newemail = substr($newemail2, 0, -2);
                                                        }
                                                    }
                                                } else {
                                                    $newemail = $emailto;
                                                }
                                                ?>
                                                                                                                                <div class="mt-action">
                                                                                                                                    <div class="mt-action-img">
                                                                                                                                        <i class="fa fa-envelope fa-2x" aria-hidden="true"></i> </div>
                                                                                                                                    <div class="mt-action-body">
                                                                                                                                        <div class="mt-action-row">
                                                                                                                                            <div class="mt-action-info ">
                                                                                                                                                <div class="mt-action-details ">
                                                                                                                                                    <span class="mt-action-author"><?php echo $adminname; ?></span>
                                                                                                                                                    <p class="mt-action-desc"><?php echo $sub; ?></p>
                                                                                                                                                    To: <?php echo $newemail; ?>
                                                <?php echo $email_log_time; ?>
                                                                                                                                                    <div class="mt-action-desc action-main-div"><?php echo $email_log_editor; ?></div>
                                                                                                                                                </div> 
                                                                                                                                            </div>                                                                                    
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                <?php
                                            }
                                            ?>      
                                        <?php } else { ?>
                                                                                                                    No records found..
                                        <?php } ?>  
                                        
                                        
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                        
                                                                                        </div>
                                        
                                        
                                                                                    </div>
                                                                                </div>-->
                                    </div>
                                </div>
<!--                                <div class="portlet">
                                            <div class="portlet-title">
                                                <div class="caption">                                
                                                    <span class="caption-subject font-dark sbold uppercase">Jobsheet</span>
                                                </div>                            
                                            </div>
                                            <div class="porlet-section">
                                                <span class="mail-btn"> 
                                                    <a href="#" class="btn blue-madison viewjobsheetuser" data-id="<?php echo $enquiry[0]['en_unique_id']; ?>">View</a>
                                                    <a href="#" class="btn blue-madison printjobsheet" data-id="<?php echo $enquiry[0]['en_unique_id']; ?>">Print</a>
                                                </span>
                                            </div>

                                        </div>-->
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
                                                            <input type="text" class="form-control " name="en_movingfrom_street" value="<?php echo $enquiry[0]['en_movingfrom_street']; ?>" readonly></div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Postcode</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <?php
                                                            if ($enquiry[0]['en_movingfrom_postcode'] == 0) {
                                                                $mfpostcode = "";
                                                            } else {
                                                                $mfpostcode = $enquiry[0]['en_movingfrom_postcode'];
                                                            }
                                                            ?>
                                                            <input type="text" class="form-control" id="movingfrompostcode" name="en_movingfrom_postcode" value="<?php echo $mfpostcode; ?>" readonly></div>
                                                    </div> 
                                                </div>
                                            </div>                            
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group ui-widget">
                                                        <label class="control-label col-md-4">Suburb</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input id="movingfromsuburb" name="en_movingfrom_suburb" class="form-control suburb" value="<?php echo $enquiry[0]['en_movingfrom_suburb']; ?>" readonly>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">State<span class="required">*</span></label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <select class="form-control movingfromstate" id="movingfromstate" name="en_movingfrom_state" disabled>
                                                                <?php
                                                                foreach ($statedata as $st) {
                                                                    ?> <option value="<?php echo $st['State']; ?>"
                                                                    <?php
                                                                    if ($st['State'] == $enquiry[0]['en_movingfrom_state']) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>><?php echo $st['State']; ?></option>
                                                                        <?php } ?>
                                                            </select>
<!--                                                            <input type="text" class="form-control " id="movingfromstate" name="en_movingfrom_state" value="<?php echo $enquiry[0]['en_movingfrom_state']; ?>">-->
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>                            
                                        </div>
                                    </div>  
                                    <div class="portlet" >
                                        <div class="portlet-title" id="movingTolbl">
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
                                                            <input type="text" class="form-control " name="en_movingto_street" value="<?php echo $enquiry[0]['en_movingto_street']; ?>" readonly></div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Postcode</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <?php
                                                            if ($enquiry[0]['en_movingto_postcode'] == 0) {
                                                                $ftpostcode = "";
                                                            } else {
                                                                $ftpostcode = $enquiry[0]['en_movingto_postcode'];
                                                            }
                                                            ?>
                                                            <input type="text" class="form-control" id="movingtopostcode" name="en_movingto_postcode" value="<?php echo $ftpostcode; ?>" readonly></div>
                                                    </div> 
                                                </div>
                                            </div>                            
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Suburb</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control suburb" id="movingtosuburb" name="en_movingto_suburb" value="<?php echo $enquiry[0]['en_movingto_suburb']; ?>" readonly>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">State<span class="required">*</span></label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <select class="form-control movingtostate" id="movingtostate" name="en_movingto_state" disabled>
                                                                <?php
                                                                foreach ($statedata as $st) {
                                                                    ?> <option value="<?php echo $st['State']; ?>"
                                                                    <?php
                                                                    if ($st['State'] == $enquiry[0]['en_movingto_state']) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>><?php echo $st['State']; ?></option>
                                                                        <?php } ?>
                                                            </select>
<!--                                                            <input type="text" class="form-control " id="movingtostate" name="en_movingto_state" value="<?php echo $enquiry[0]['en_movingto_state']; ?>">-->
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
                                            <?php
                                            $pickupdata = json_decode($enquiry[0]['additional_pickup'], true);
                                            $count = count($pickupdata['en_addpickup_street']);
                                            if ($count > 0) {
                                                for ($dd = 0; $dd < $count; $dd++) {
                                                    $pickupstreet = $pickupdata['en_addpickup_street'][$dd];
                                                    $pickuppostcode = $pickupdata['en_addpickup_postcode'][$dd];
                                                    $pickupsuburb = $pickupdata['en_addpickup_suburb'][$dd];
                                                    $pickupstate = $pickupdata['en_addpickup_state'][$dd];
                                                    ?>
                                                    <div class="additionalPickuptxt">
                                                        <div class="row postcodepickup">
                                                            <div class="col-md-7">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-4">Street</label>
                                                                    <span class="error"></span>
                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control" name="en_addpickup_street[]" value="<?php echo $pickupstreet; ?>" readonly></div>
                                                                </div> 
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-4">Postcode</label>
                                                                    <span class="error"></span>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                        if ($pickuppostcode == 0) {
                                                                            $appostcode = "";
                                                                        } else {
                                                                            $appostcode = $pickuppostcode;
                                                                        }
                                                                        ?>
                                                                        <input type="text" class="form-control addpickuppostcode" name="en_addpickup_postcode[]" value="<?php echo $appostcode; ?>" readonly></div>
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
                                                                        <input type="text" class="form-control suburb addpickupsuburb" name="en_addpickup_suburb[]" value="<?php echo $pickupsuburb; ?>" readonly>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-4">State</label>
                                                                    <span class="error"></span>
                                                                    <div class="col-md-8">

                                                                        <select class="form-control addpickupstate" name="en_addpickup_state[]" disabled> 
                                                                            <?php
                                                                            foreach ($statedata as $st) {
                                                                                ?> <option value="<?php echo $st['State']; ?>"
                                                                                <?php
                                                                                if ($st['State'] == $pickupstate) {
                                                                                    echo "selected";
                                                                                }
                                                                                ?>><?php echo $st['State']; ?></option>
                                                                                    <?php } ?>
                                                                        </select>
            <!--                                                                <input type="text" class="form-control" id="addpickupstate" name="en_addpickup_state" value="<?php echo $row["en_addpickup_state"]; ?>">-->
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>   
                                                        <a class="remove_field" title="Remove"><i class="fa fa-trash"></i></a>                                            
                                                        <span class="mob-add-pick"><i class="fa fa-plus"></i>Add Pickup</span>
                                                    </div>

                                                <?php }
                                                ?> </div> <?php
                                        } else {
                                            ?> 
                                            <div class="additionalPickuptxt editpickup" style="display: none;">
                                                <div class="row postcodepickup">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Street</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" name="en_addpickup_street[]" readonly></div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Postcode</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control addpickuppostcode" name="en_addpickup_postcode[]" readonly></div>
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
                                                                <input type="text" class="form-control addpickupsuburb" name="en_addpickup_suburb[]" readonly>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">State</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8 pickup-select">
                                                                <select class="form-control addpickupstate" name="en_addpickup_state[]" disabled> 
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
                                    <?php } ?>
                                </div> 

                                <div class="portlet">
                                    <div class="portlet-title" id="additionalDeliverylbl">
                                        <div class="caption add_field_button_delivery">                                
                                            <span class="caption-subject font-dark sbold uppercase"><span class="help-block"><i class="fa fa-plus"></i></span> Additional Delivery </span>
                                        </div>                            
                                    </div>
                                    <div class="porlet-section additional-wrapperdelivery" id="additionalDeliverytxt">
                                        <?php
                                        $deliverydata = json_decode($enquiry[0]['additional_delivery'], true);
                                        $count1 = count($deliverydata['en_adddelivery_street']);
                                        if ($count1 > 0) {
                                            for ($ad = 0; $ad < $count1; $ad++) {
                                                $deliverystreet = $deliverydata['en_adddelivery_street'][$ad];
                                                $deliverypostcode = $deliverydata['en_adddelivery_postcode'][$ad];
                                                $deliverysuburb = $deliverydata['en_adddelivery_suburb'][$ad];
                                                $deliverystate = $deliverydata['en_adddelivery_state'][$ad];
                                                ?>
                                                <div class="additionalDeliverytxt">
                                                    <div class="row postcodedelivery">
                                                        <div class="col-md-7">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Street</label>
                                                                <span class="error"></span>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control " name="en_adddelivery_street[]" value="<?php echo $deliverystreet; ?>" readonly></div>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">Postcode</label>
                                                                <span class="error"></span>
                                                                <div class="col-md-8">
                                                                    <?php
                                                                    if ($deliverypostcode == 0) {
                                                                        $adpostcode = "";
                                                                    } else {
                                                                        $adpostcode = $deliverypostcode;
                                                                    }
                                                                    ?>
                                                                    <input type="text" class="form-control adddeliverypostcode" name="en_adddelivery_postcode[]" value="<?php echo $adpostcode; ?>" readonly></div>
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
                                                                    <input type="text" class="form-control suburb adddeliverysuburb" name="en_adddelivery_suburb[]" value="<?php echo $deliverysuburb; ?>" readonly>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">State</label>
                                                                <span class="error"></span>
                                                                <div class="col-md-8">
                                                                    <select class="form-control adddeliverystate" name="en_adddelivery_state[]" disabled>
                                                                        <?php
                                                                        foreach ($statedata as $st) {
                                                                            ?> <option value="<?php echo $st['State']; ?>"
                                                                            <?php
                                                                            if ($st['State'] == $deliverystate) {
                                                                                echo "selected";
                                                                            }
                                                                            ?>><?php echo $st['State']; ?></option>
                                                                                <?php } ?>
                                                                    </select>
        <!--                                                                <input type="text" class="form-control" id="adddeliverystate" name="en_adddelivery_state" value="<?php echo $row['en_adddelivery_state']; ?>">-->
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>   
                                                    <a class="remove_field" title="Remove"><i class="fa fa-trash"></i></a>
                                                    <span class="mob-add-del"><i class="fa fa-plus"></i>Add Delivery</span>
                                                </div>

                                            <?php }
                                            ?> </div> <?php
                                    } else {
                                        ?>
                                        <div class="additionalDeliverytxt editdelivery" style="display: none;">
                                            <div class="row postcodedelivery">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Street</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control " name="en_adddelivery_street[]" readonly></div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">Postcode</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control adddeliverypostcode" name="en_adddelivery_postcode[]" readonly></div>
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
                                                            <input type="text" class="form-control suburb adddeliverysuburb" name="en_adddelivery_suburb[]" readonly>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4">State</label>
                                                        <span class="error"></span>
                                                        <div class="col-md-8">
                                                            <select class="form-control adddeliverystate" name="en_adddelivery_state[]" disabled>
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
                                <?php } ?>
                            </div> 
                        </div>

                        <div class="portlet">
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
                                        <textarea class="form-control control-area job-area" name="en_note" readonly><?php echo $enquiry[0]['en_note']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--                                <div id="referralDetails">
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
                                                                                <input type="text" class="form-control " name="en_referral_source" value="<?php echo $enquiry[0]['en_referral_source']; ?>"></div>
                                                                        </div> 
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label col-md-5">Promotional code</label>
                                                                            <span class="error"></span>
                                                                            <div class="col-md-7">
                                                                                <input type="text" class="form-control" name="en_promotional_code" value="<?php echo $enquiry[0]['en_promotional_code']; ?>"></div>
                                                                        </div> 
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                        </div>-->

                       
                        <div id="clientFeedback">
                            <div class="portlet">
                                <div class="portlet-title">
                                    <div class="caption">                                
                                        <span class="caption-subject font-dark sbold uppercase">Client Feedback</span>
                                    </div>                            
                                </div>

                                <div class="porlet-section">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="client_feedback" readonly><?php echo $enquiry[0]['client_feedback']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet">
                            <div class="portlet-title">
                                <div class="caption">                                
                                    <span class="caption-subject font-dark sbold uppercase">Created From</span>
                                </div>                            
                            </div>
                            <div class="porlet-section">
                                <div class="form-group">                                                
                                    <span class="error"></span>
                                    <div class="col-md-12">
                                        <?php
                                        $cre = explode("###", $enquiry[0]['created_from']);
                                        ?>
                                        <input type="text" class="form-control" name="created_from" value="<?php echo $cre[0]; ?>"readonly>
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

                            <div class="porlet-section">
                                <div id="storagePrice">
                                    <div class="form-group" id="cubicMetersBooked">
                                        <label class="control-label col-md-6">Cubic meters booked</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="en_cubic_meters_booked" value="<?php echo $enquiry[0]['en_cubic_meters_booked']; ?>" readonly>
                                        </div>
                                    </div>  
                                    <div class="form-group" id="noOfModules">
                                        <label class="control-label col-md-6">No of modules required</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="en_noof_modules_required" value="<?php
                                            if ($enquiry[0]['en_noof_modules_required'] != "0") {
                                                echo $enquiry[0]['en_noof_modules_required'];
                                            }
                                            ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" id="cubicMetersByStorage">
                                        <label class="control-label col-md-6">Cubic meters confirmed by storage company?</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="en_cubic_meters_bystorage" value="<?php echo $enquiry[0]['en_cubic_meters_bystorage']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" id="quotedSellPrice">
                                        <label class="control-label col-md-6">Quoted sell price (inc.GST)</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon">
                                                <i class="fa fa-usd"></i>
                                                <input type="text" class="form-control" name="en_quotedsell_price" value="<?php
                                                if ($enquiry[0]['en_quotedsell_price'] != "0.00") {
                                                    echo $enquiry[0]['en_quotedsell_price'];
                                                }
                                                ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="quotedCostPrice">
                                        <label class="control-label col-md-6">Quoted cost price (inc.GST)</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon">
                                                <i class="fa fa-usd"></i>
                                                <input type="text" class="form-control" name="en_quotedcost_price" value="<?php
                                                if ($enquiry[0]['en_quotedcost_price'] != "0.00") {
                                                    echo $enquiry[0]['en_quotedcost_price'];
                                                }
                                                ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="hireaMoverMargin">
                                        <label class="control-label col-md-6">Hire a Mover Margin</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon">
                                                <i class="fa fa-usd"></i>
                                                <input type="text" class="form-control " name="en_hireamover_margin" value="<?php
                                                if ($enquiry[0]['en_hireamover_margin'] != "0.00") {
                                                    echo $enquiry[0]['en_hireamover_margin'];
                                                }
                                                ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="porlet-section" id="packingPriceInfo">
                                <div id="packingPrice">

                                    <div class="form-group">

                                        <label class="control-label col-md-6">Deposit Amount<span class="required">*</span></label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon">
                                                <i class="fa fa-usd"></i>
                                                <?php
                                                if ($enquiry[0]['en_deposit_amt'] != "0.00") {
                                                    $depAmt = $enquiry[0]['en_deposit_amt'];
                                                } else {
                                                    $depAmt = "";
                                                }
                                                ?>
                                                <input type="text" class="form-control depositamt" id="depositamt" name="en_deposit_amt" value="<?php echo $enquiry[0]['en_deposit_amt']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="noOfMovers">
                                        <label class="control-label col-md-6">No. of movers<span class="required">*</span></label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <select class="form-control select-mover" name="en_no_of_movers1" disabled>
                                                <option value="2" <?php
                                                if ($enquiry[0]['en_no_of_movers'] == 2) {
                                                    echo "selected";
                                                }
                                                ?>>2</option>
                                                <option value="3" 
                                                <?php
                                                if ($enquiry[0]['en_no_of_movers'] == 3) {
                                                    echo "selected";
                                                }
                                                ?>>3</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <input type="text" class="form-control text-mover" id="movers" name="en_no_of_movers" value="<?php echo $enquiry[0]['en_no_of_movers']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" id="noOfTrucks">
                                        <label class="control-label col-md-6">No. of trucks<span class="required">*</span></label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control trucks" id="trucks" name="en_no_of_trucks" value="<?php echo $enquiry[0]['en_no_of_trucks']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" id="travelFeeSell">
                                        <label class="control-label col-md-6">Travel Fee<span class="required">*</span></label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon">
                                                <i class="fa fa-usd"></i>
                                                <?php
                                                if ($enquiry[0]['en_travelfee'] != "0.00") {
                                                    $travelfee = $enquiry[0]['en_travelfee'];
                                                } else {
                                                    $travelfee = "";
                                                }
                                                ?>
                                                <input type="text" class="form-control travelfees" id="travelfee" name="en_travelfee" value="<?php echo $travelfee; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="travelFeeCost">
                                        <label class="control-label col-md-6">Travel Fee</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon">
                                                <i class="fa fa-usd"></i>
                                                <?php
                                                if ($enquiry[0]['en_travelfee_cost'] != "0.00") {
                                                    $travelfeecost = $enquiry[0]['en_travelfee_cost'];
                                                } else {
                                                    $travelfeecost = "";
                                                }
                                                ?>
                                                <input type="text" class="form-control" id="travelfeecost" name="en_travelfee_cost" value="<?php echo $travelfeecost; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="clientHourlyRate">
                                        <label class="control-label col-md-6">Client Hourly Rate<span class="required">*</span></label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon">
                                                <i class="fa fa-usd"></i>
                                                <?php
                                                if ($enquiry[0]['en_client_hourly_rate'] != "0.00") {
                                                    $chrate = $enquiry[0]['en_client_hourly_rate'];
                                                } else {
                                                    $chrate = "";
                                                }
                                                ?>
                                                <input type="text" class="form-control chr" id="clienthourlyrate" name="en_client_hourly_rate" value="<?php echo $chrate; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="additionalCharges">
                                        <label class="control-label col-md-6">Additional Charges</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon">
                                                <i class="fa fa-usd"></i>
                                                <?php
                                                if ($enquiry[0]['en_additional_charges'] == "0.00") {
                                                    $addCharge = "";
                                                } else {
                                                    $addCharge = $enquiry[0]['en_additional_charges'];
                                                }
                                                ?>
                                                <input type="text" id="additionalChargesinput" class="form-control" name="en_additional_charges" value="<?php echo $addCharge; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="additionalItem">
                                        <label class="control-label col-md-6">Additional Item</label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control phone" name="en_additional_item" value="<?php echo $enquiry[0]['en_additional_item']; ?>" readonly>
                                        </div>
                                    </div>
                                    <!--                                        <div class="form-group" id="additionalChargesCost">
                                                                                <label class="control-label col-md-6">Additional Charges</label>
                                                                                <span class="error"></span>
                                                                                <div class="col-md-6">
                                                                                    <div class="input-icon input-icon">
                                                                                        <i class="fa fa-usd"></i>
                                                                                        <input type="text" class="form-control" name="en_additional_charges_cost" value="<?php echo $enquiry[0]['en_additional_charges_cost']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>-->
                                </div>
                                <div id="packingUnpackingPrice">
                                    <div class="form-group" id="initialHoursbooked">
                                        <label class="control-label col-md-6">Initial hours booked<span class="required">*</span></label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <?php
                                            if ($enquiry[0]['en_initial_hours_booked'] != "0.00") {
                                                $inihrbook = $enquiry[0]['en_initial_hours_booked'];
                                            } else {
                                                $inihrbook = "";
                                            }
                                            ?>
                                            <input type="text" id="hoursbooked" class="form-control hoursbook" name="en_initial_hours_booked" value="<?php echo $inihrbook; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group" id="ladiesBooked">
                                        <label class="control-label col-md-6">No. Of ladies booked<span class="required">*</span></label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <?php
                                            if ($enquiry[0]['en_ladies_booked'] != "0") {
                                                $ladies = $enquiry[0]['en_ladies_booked'];
                                            } else {
                                                $ladies = "";
                                            }
                                            ?>
                                            <input type="text" id="bookedladies" class="form-control ladiesbook" name="en_ladies_booked" value="<?php echo $ladies; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group" id="initialSellPrice">
                                        <label class="control-label col-md-6">Initial Sell Price<span class="required">*</span></label>
                                        <span class="error"></span>
                                        <div class="col-md-6">
                                            <div class="input-icon input-icon">
                                                <i class="fa fa-usd"></i>
                                                <?php
                                                if ($enquiry[0]['en_initial_sellprice'] != "0.00") {
                                                    $inisellprice = $enquiry[0]['en_initial_sellprice'];
                                                } else {
                                                    $inisellprice = "";
                                                }
                                                ?>
                                                <input type="text" id="sellprice" class="form-control inisellprice" name="en_initial_sellprice" value="<?php echo $inisellprice; ?>" readonly>
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
                                            <?php
                                            if ($enquiry[0]['en_total_sellprice'] != "0.00") {
                                                $totalsellprice = $enquiry[0]['en_total_sellprice'];
                                            } else {
                                                $totalsellprice = "";
                                            }
                                            ?>
                                            <input type="text" id="totalsellprice" class="form-control" name="en_total_sellprice" value="<?php echo $totalsellprice; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="totalCostPrice">
                                    <label class="control-label col-md-6">Total Cost Price</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <div class="input-icon input-icon">
                                            <i class="fa fa-usd"></i>
                                            <?php
                                            if ($enquiry[0]['en_total_costprice'] != "0.00") {
                                                $totalcostprice = $enquiry[0]['en_total_costprice'];
                                            } else {
                                                $totalcostprice = "";
                                            }
                                            ?>
                                            <input type="text" id="costprice" class="form-control" name="en_total_costprice" value="<?php echo $totalcostprice; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="hireaMoverMargin">
                                    <label class="control-label col-md-6">Hire a Mover Margin</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <div class="input-icon input-icon">
                                            <i class="fa fa-usd"></i>
                                            <?php
                                            if ($enquiry[0]['en_hireamover_margin'] != "0.00") {
                                                $hiremargin = $enquiry[0]['en_hireamover_margin'];
                                            } else {
                                                $hiremargin = "";
                                            }
                                            ?>
                                            <input type="text" id="hamMargin" class="form-control" name="en_hireamover_margin" value="<?php echo $hiremargin; ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="amountDueNow">
                                    <label class="control-label col-md-6"> Amount Due Now</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control " name="en_amountDueNow" value="<?php echo $enquiry[0]['en_amountDueNow']; ?>" readonly>
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
                                            <?php
                                            if ($enquiry[0]['en_deposit_received'] == '1') {
                                                $chk = "checked";
                                            }
                                            ?>
                                            <input type="checkbox" name="en_deposit_received" value="1"<?php echo $chk; ?> disabled>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" id="depositPaidby">
                                    <label class="control-label col-md-6">Deposit Paid by</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <select class="form-control" name="en_deposit_paidby" disabled>
                                            <option value=""></option>
                                            <option value="1" <?php
                                            if ($enquiry[0]['en_deposit_paidby'] == 1) {
                                                echo "selected";
                                            }
                                            ?>>Credit card</option>
                                            <option value="2" <?php
                                            if ($enquiry[0]['en_deposit_paidby'] == 2) {
                                                echo "selected";
                                            }
                                            ?>>Bank transfer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="monthPayment">
                                    <label class="control-label col-md-6">First month's payment received?</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <label class="mt-checkbox deposit-checkbox mt-checkbox-outline">
                                            <?php
                                            if ($enquiry[0]['en_month_payment_received'] == '1') {
                                                $chk1 = "checked";
                                            }
                                            ?>
                                            <input type="checkbox" name="en_month_payment_received" value="1"<?php echo $chk1; ?> readonly>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" id="payment_methods">
                                    <label class="control-label col-md-6">Payment method</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <select class="form-control" name="en_paymentmethod" disabled>
                                            <option value=""></option>
                                            <option value="1" <?php
                                            if ($enquiry[0]['en_paymentmethod'] == 1) {
                                                echo "selected";
                                            }
                                            ?>>EFT</option>
                                            <option value="2" <?php
                                            if ($enquiry[0]['en_paymentmethod'] == 2) {
                                                echo "selected";
                                            }
                                            ?>>Cash</option>
                                            <option value="3" <?php
                                            if ($enquiry[0]['en_paymentmethod'] == 3) {
                                                echo "selected";
                                            }
                                            ?>>Eway</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="ewayRefNo">
                                    <label class="control-label col-md-6">eway reference no.</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control " name="en_eway_refno" value="<?php echo $enquiry[0]['en_eway_refno']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group" id="EFTReceivedon">
                                    <label class="control-label col-md-6">EFT Received on</label>
                                    <div class="col-md-6">
                                        <?php
                                        if ($enquiry[0]['en_eft_receivedon'] == NULL) {
                                            $eftrecon = "";
                                        } else {
                                            $eftrecon = date("d-m-Y", strtotime($enquiry[0]['en_eft_receivedon']));
                                        }
                                        ?>
                                        <input class="form-control form-control-inline date-picker date-hide" id="" name="en_eft_receivedon" size="16" type="text" value="<?php echo $eftrecon; ?>" readonly/>
                                        <input type="text" class="eftreceivedon" data-field="date" readonly name="en_eft_receivedon1" value="<?php echo $eftrecon; ?>">
                                        <div id="eftrBox"></div>                                                
                                    </div>
                                </div>

                                <div class="form-group" id="anniversarydate">
                                    <label class="control-label col-md-6">Anniversary date for future payments</label>
                                    <div class="col-md-6">
                                        <?php
                                        if ($enquiry[0]['en_anniversarydate'] == NULL) {
                                            $annivearsarydate = "";
                                        } else {
                                            $annivearsarydate = date("d-m-Y", strtotime($enquiry[0]['en_anniversarydate']));
                                        }
                                        ?>
                                        <input class="form-control form-control-inline date-picker date-hide" id="" name="en_anniversarydate" size="16" type="text" value="<?php echo $annivearsarydate; ?>" readonly/>
                                        <input type="text" class="anniversaryDate" data-field="date" readonly name="en_anniversarydate1" value="<?php echo $annivearsarydate; ?>">
                                    </div>
                                </div>
                                <div class="form-group" id="ewayrecurringPayment">
                                    <label class="control-label col-md-6">Eway recurring payment setup?</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control " name="en_ewayrecurring_payment" value="<?php echo $enquiry[0]['en_ewayrecurring_payment']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group" id="futurePaymentLog">
                                    <label class="control-label col-md-6">Future payment log</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control " name="en_futurepayment_log" value="<?php echo $enquiry[0]['en_futurepayment_log']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group" id="finalPaymentReceivedBy">
                                    <label class="control-label col-md-6">Final payment received by</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <select class="form-control" name="final_payment_receivedby" disabled>
                                            <option value=""></option>
                                            <option value="1" <?php
                                            if ($enquiry[0]['final_payment_receivedby'] == 1) {
                                                echo "selected";
                                            }
                                            ?>>EFT</option>
                                            <option value="2" <?php
                                            if ($enquiry[0]['final_payment_receivedby'] == 2) {
                                                echo "selected";
                                            }
                                            ?>>Credit card</option>
                                            <option value="3" <?php
                                            if ($enquiry[0]['final_payment_receivedby'] == 3) {
                                                echo "selected";
                                            }
                                            ?>>Cash</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="fewayRefno">
                                    <label class="control-label col-md-6">Final payment eway reference no</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <?php
                                        if ($enquiry[0]['final_payment_eway_refno'] == "0") {
                                            $fpref = "";
                                        } else {
                                            $fpref = $enquiry[0]['final_payment_eway_refno'];
                                        }
                                        ?>
                                        <input type="text" class="form-control " name="final_payment_eway_refno" value="<?php echo $fpref; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group" id="feftPayment">
                                    <label class="control-label col-md-6">Final payment EFT payment </label>
                                    <div class="col-md-6">
                                        <?php
                                        if ($enquiry[0]['final_payment_eft_payment'] == NULL) {
                                            $feftpay = "";
                                        } else {
                                            $feftpay = date("d-m-Y", strtotime($enquiry[0]['final_payment_eft_payment']));
                                        }
                                        ?>
                                        <input class="form-control form-control-inline date-picker date-hide" id="" name="final_payment_eft_payment" size="16" type="text" value="<?php echo $feftpay; ?>" readonly/>
                                        <input type="text" class="finaleftpayment" data-field="date" readonly name="final_payment_eft_payment1" value="<?php echo $feftpay; ?>">
                                        <div id="finaleftBox1"></div>
                                    </div>
                                </div>
                                <div class="form-group" id="headofficepaid">
                                    <label class="control-label col-md-6">Head office paid</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
<!--                                        <select class="form-control" name="head_office_paid">
                                            <option value=""></option>
                                            <option value="1" <?php
                                        if ($enquiry[0]['head_office_paid'] == 1) {
                                            echo "selected";
                                        }
                                        ?>>Yes</option>
                                            <option value="0" <?php
                                        if ($enquiry[0]['head_office_paid'] == 0) {
                                            echo "selected";
                                        }
                                        ?>>No</option>
                                        </select>-->
                                        <input type="text" class="form-control " name="head_office_paid" value="<?php echo $enquiry[0]['head_office_paid']; ?>" readonly>
                                    </div>
                                </div>
                                <!--                                <div class="form-group" id="packingCompanyPaid">
                                                                    <label class="control-label col-md-6">Packing company paid</label>
                                                                    <span class="error"></span>
                                                                    <div class="col-md-6">
                                                                        <select class="form-control" name="en_packing_company_paid">
                                                                            <option value=""></option>
                                                                            <option value="1" <?php
                                if ($enquiry[0]['en_packing_company_paid'] == 1) {
                                    echo "selected";
                                }
                                ?>>Yes</option>
                                                                            <option value="0" <?php
                                if ($enquiry[0]['en_packing_company_paid'] == 0) {
                                    echo "selected";
                                }
                                ?>>No</option>
                                                                        </select>
                                                                            <input type="text" class="form-control " name="en_packing_company_paid" value="<?php //echo $enquiry[0]['en_packing_company_paid'];                                     ?>">
                                                                    </div>
                                                                </div>-->
                                <div class="form-group" id="removealistpaid">
                                    <label class="control-label col-md-6">Removalist paid</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
<!--                                        <select class="form-control" name="removalist_paid">
                                            <option value=""></option>
                                            <option value="1" <?php
                                        if ($enquiry[0]['removalist_paid'] == 1) {
                                            echo "selected";
                                        }
                                        ?>>Yes</option>
                                            <option value="0" <?php
                                        if ($enquiry[0]['removalist_paid'] == 0) {
                                            echo "selected";
                                        }
                                        ?>>No</option>
                                        </select>-->
                                        <input type="text" class="form-control " name="removalist_paid" value="<?php echo $enquiry[0]['removalist_paid']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group" id="EWAYTOKEN">
                                    <label class="control-label col-md-6">EWAY TOKEN</label>
                                    <span class="error"></span>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control " name="en_eway_token" value="<?php echo $enquiry[0]['en_eway_token']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--                    <div class="form-actions">                                
                                            <div class="col-xs-12 text-center">
                                                <button type="submit" class="btn green form-submit btn-mobile" id="sub">Save</button>
                                            </div>                                
                                        </div>-->
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


<div id="serviceBox"></div>


<div class="quick-nav-overlay"></div>
<script src="<?php echo base_url('assets/custom/js/bootstrap-filestyle.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom/js/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom/js/DateTimePicker.min.js'); ?>" type="text/javascript"></script>

<script>
    jQuery(document).ready(function () {

//        jQuery(".printjobsheet").on("click", function () {
//            var id = jQuery(this).data("id");
//            var url = BASE_URL + "driver/userbookinglist/viewJobsheet/" + id;
//            window.open(url, '_blank');
//        });
//        jQuery(".viewjobsheetuser").on("click", function () {
//            var id = jQuery(this).data("id");
//            var url = BASE_URL + "driver/userbookinglist/save_download/" + id;
//            window.open(url);
//        });


        var wd = jQuery(window).width();
        if (wd < 768) {
            jQuery('.portlet-title').click(function () {
                jQuery(this).toggleClass('open');
                jQuery(this).closest('.portlet').find('.porlet-section:not(.fhide)').slideToggle();
            });
        }

        if (wd < 768) {
            jQuery('select').selectpicker();

            jQuery("#serviceBox").DateTimePicker({
                dateFormat: "dd-MM-yyyy",
            });

            jQuery('html, body').on('change', '.servicedate', function () {
                var td = jQuery(this).val();
                jQuery('#servicedate').val(td);
            });
//               
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


        }


        jQuery('.clickon-show').click(function () {
            jQuery('.showon-area').slideDown();
            var inpht = jQuery('.fileinput-button .fileinp-btn').innerHeight();
            var inpwid = jQuery('.fileinput-button .fileinp-btn').innerWidth();
            jQuery('.fileinput-button .file-btn').css({'width': inpwid, 'height': inpht});
        });
        jQuery(document).click(function (e) {
            if (jQuery(e.target).is('.activity-area *')) {
                return;
            } else
            {
                if (jQuery('.activity-area .form-group').hasClass('has-error')) {
                } else {
                    jQuery('.showon-area').slideUp();
                }


            }
        });
        jQuery('.fileinput-button input').change(function (e) {
            var aval = jQuery('.fileinput-button input').val();
            jQuery('.activity-file').text(aval.replace(/C:\\fakepath\\/i, ''));
        });

        jQuery('#notesubmit').click(function () {
            var now = new Date();
            var month = now.getMonth() + 1;
            var date = now.getDate();
            var year = now.getFullYear();
            var notedate = date + '-' + month + '-' + year;
            var am_pm = now.getHours() >= 12 ? "PM" : "AM";
            var hours = now.getHours() > 12 ? now.getHours() - 12 : now.getHours();
            hours = hours < 10 ? "0" + hours : hours;
            var outStr = notedate + ' ' + hours + ':' + now.getMinutes() + ':' + now.getSeconds() + ' ' + am_pm;
            var created = jQuery('#adminUser').val();
            var titleval = jQuery('#note-title').val();
            var areaval = jQuery('#note-area').val();
            var attachnotes = jQuery('#note-attachfile').val();
            var attach = attachnotes.replace(/C:\\fakepath\\/i, '');
            if (titleval != '' || areaval != '') {
                //   jQuery('.activity-notes').prepend('<div class="activity-item"><span class="close-notes">&#10006;</span><h6>' + titleval + '</h6><p>' + areaval + '</p><p><a href="">' + attach + '</p><p><a href="#">' + created + '</a>' + outStr + '</p></div>')
//                    jQuery('#note-title').val('');
//                    jQuery('#note-area').val('');
                // jQuery('#note-attachfile').val('');
                jQuery('.showon-area').slideUp();
            } else {
                return false;
                //jQuery('.showon-area').slideUp();
            }

            $("#booking-form").trigger("submit");
            setTimeout(function () {
                var eEiD = $("input[name='enquiry_id']").val();
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + 'booking/fetchNotes/' + eEiD,
                    success: function (response) {
                        $('.activity-notes').html(response);
                    }
                })
            }, 1000);
            jQuery('.bootstrap-filestyle .form-control ').val('');

        });
        jQuery(":file").filestyle({buttonBefore: true});

        /*jQuery('#test').click(function () {
         jQuery('.admin-notes .mt-actions').append('<div class="mt-action"><div class="mt-action-img"><i class="fa fa-envelope fa-2x" aria-hidden="true"></i></div><div class="mt-action-body"><div class="mt-action-row"><div class="mt-action-info"><div class="mt-action-details"><span class="mt-action-author">admin</span><p class="mt-action-desc">Hire A Mover Quote - 16/11/2017 1-3pm</p></div></div></div></div></div>')
         });*/

        jQuery('html body').on('click', '.mt-action-author', function () {
            jQuery(this).closest('.mt-action-details').find('.action-main-div').slideToggle();
        });


        /*Form Auto Submit Logic*/
        var changeFlag = false;
        var focusFlag = false;
        jQuery("#booking-form").change(function () {
            changeFlag = true;
            focusFlag = false;
        });

        setInterval(function () {

            /*
             * changeFlag for change any element of current form
             * focusFlag for tell us that focus out or in
             */
            if (changeFlag == true && focusFlag == false) {
                // jQuery("#booking-form").trigger("submit");
                changeFlag = false;
            }

        }, 30000);

        jQuery("#booking-form input").focus(function () {
            focusFlag = true;
        });
        jQuery("#booking-form input").focusout(function () {
            focusFlag = false;
        });



        /*Form Auto Submit Logic End*/

        jQuery('.btn.green.form-submit').click(function () {

            jQuery("#booking-form").trigger("submit");
        });

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
            jQuery('.editpickup').remove();
            jQuery('.editdelivery').remove();
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

        var melv = jQuery('#movers').val();
        if (melv == '2' || melv == '3') {
        } else {
            jQuery('.text-mover').show();
            jQuery('select.select-mover').addClass('select-hide');
        }


        jQuery('select.select-mover').on('change', function () {
            var selv = jQuery(this).val();
            if (selv == '2' || selv == '3') {
                if (selv == '3') {
                    jQuery('#travelfee').val('80.00');
                    jQuery('#clienthourlyrate').val('160.00');
                    jQuery('#movers').val(selv);
                } else {
                    jQuery('#travelfee').val('60.00');
                    jQuery('#clienthourlyrate').val('120.00');
                    jQuery('#movers').val(selv);
                }
            } else {
                jQuery(this).addClass('select-hide');
                jQuery('.text-mover').val('').show().focus();
                jQuery('#travelfee').val('');
                jQuery('#clienthourlyrate').val('');
            }
        });

        jQuery('.text-mover').blur(function () {
            var texv = jQuery(this).val();
            if (texv == '2' || texv == '3') {
                jQuery('.text-mover').hide();
                jQuery('select.select-mover').removeClass('select-hide').val(texv);
                if (texv == '3') {
                    jQuery('#travelfee').val('80.00');
                    jQuery('#clienthourlyrate').val('160.00');
                } else {
                    jQuery('#travelfee').val('60.00');
                    jQuery('#clienthourlyrate').val('120.00');
                }
            }
        });

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
