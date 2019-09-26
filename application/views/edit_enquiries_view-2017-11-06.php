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
<!--                            <li>
                                <a href="<?php base_url("enquiries/new"); ?>" ><i class="fa fa-plus-circle"></i> New </a>
                            </li>-->
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
                <div class = "row form-horizontal inquiry-form" id="homeOffice">
                    <?php
                    echo form_open_multipart('enquiries/viewEnquiries', array('id' => 'enquiry-form', 'method' => 'post', "name" => "enquiry-form"));

                    foreach ($enquiry as $row) {
                        ?>
                        <input type="hidden" name="enquiry_id" class="form-control" value="<?php echo $row['enquiry_id']; ?>" />
                        <div class="col-md-12">                        
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="portlet">
                                        <div class="portlet-title" data-id="porlet-contact">
                                            <div class="caption">                                
                                                <span class="caption-subject font-dark sbold uppercase">Contact Details</span>
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="porlet-section" id="porlet-contact">

                                        <div class="form-group" id="moveType">
                                            <label class="col-md-5 control-label" for="form_control_1">Move type</label>
                                            <div class="col-md-7">
                                                <select class="form-control" id="enquirymovetype" name="en_movetype">
                                                    <!--                                                    <option value="">Select</option>-->
                                                    <?php foreach ($move_type as $mt) {
                                                        ?>
                                                        <option value="<?php echo $mt['movetype_id']; ?>"
                                                        <?php
                                                        if ($mt['movetype_id'] == $row['en_movetype']) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $mt['movetype_name']; ?></option>
                                                            <?php } ?>
                                                </select></div>
                                        </div>

                                        <div class="form-group" id="storagedate">
                                            <label class="col-md-5 control-label">Date moving into storage</label>
                                            <div class="col-md-7">
                                                <?php
                                                if ($row['en_storagedate'] == NULL) {
                                                    $storagedate = "";
                                                } else {
                                                    $storagedate = date("d-m-Y", strtotime($row['en_storagedate']));
                                                }
                                                ?>
                                                <input class="form-control form-control-inline date-picker" id="movingstoragedate" name="en_storagedate" size="16" type="text" value="<?php echo $storagedate; ?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="form-group" id="serviceDate">
                                            <label class="col-md-5 control-label">Service date</label>
                                            <div class="col-md-7">
                                                <?php
                                                if ($row['en_servicedate'] == NULL) {
                                                    $servicedate = "";
                                                } else {
                                                    $servicedate = date("d-m-Y", strtotime($row['en_servicedate']));
                                                }
                                                ?>
                                                <input class="form-control form-control-inline date-picker" id="servicedate" name="en_servicedate" size="16" type="text" value="<?php echo $servicedate; ?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="form-group" id="serviceTime">
                                            <label class="control-label col-md-5">Service time</label>
                                            <div class="col-md-7">
                                                <input type="text" name="en_servicetime" class="form-control" value="<?php echo $row['en_servicetime']; ?>" /></div>
                                        </div>
                                        <div class="form-group" id="deliveryDate">
                                            <label class="col-md-5 control-label">Delivery date</label>
                                            <div class="col-md-7">
                                                <?php
                                                if ($row['en_deliverydate'] == NULL) {
                                                    $deliverydate = "";
                                                } else {
                                                    $deliverydate = date("d-m-Y", strtotime($row['en_deliverydate']));
                                                }
                                                ?>
                                                <input class="form-control form-control-inline date-picker" id="deliverydate" name="en_deliverydate" size="16" type="text" value="<?php echo $deliverydate; ?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="form-group" id="deliveryTime">
                                            <label class="control-label col-md-5">Delivery time</label>
                                            <div class="col-md-7">
                                                <input type="text" id="servicetime" name="en_deliverytime" class="form-control" value="<?php echo $row['en_deliverytime']; ?>" /></div>
                                        </div>
                                        <div class="form-group group-relative" id="name">
                                            <label class="control-label col-md-5">Name<span class="required">*</span></label>
                                            <span class="error"></span>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control name input-popup" id="enname" name="en_name" value="<?php echo $row['en_fname'] . " " . $row['en_lname']; ?>" readonly></div>
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
                                        <div class="form-group" id="phone">
                                            <label class="control-label col-md-5">Phone</label>
                                            <span class="error"></span>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control phone" name="en_phone" value="<?php echo $row['en_phone']; ?>"></div>
                                        </div>
                                        <div class="form-group" id="email">
                                            <label class="control-label col-md-5">Email</label>
                                            <span class="error"></span>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control email" name="en_email" value="<?php echo $row['en_email']; ?>"></div>
                                        </div>
                                        <div id="storageProvider">
                                            <div class="form-group" id="storageProvider">
                                                <label class="control-label col-md-5">Storage provider</label>
                                                <span class="error"></span>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="en_storage_provider" value="<?php echo $row['en_storage_provider']; ?>"></div>
                                            </div>
                                            <div class="form-group" id="storageAddress">
                                                <label class="control-label col-md-5">Storage address</label>
                                                <span class="error"></span>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="en_storage_address" value="<?php echo $row['en_storage_address']; ?>"></div>
                                            </div>
                                            <div class="form-group" id="storagePhoneNumber">
                                                <label class="control-label col-md-5">Storage phone number</label>
                                                <span class="error"></span>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name="en_storage_phno" value="<?php echo $row['en_storage_phno']; ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="removealist">
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
<!--                                                <input id="removalist" name="contact_data" class="form-control" >
                                                <input type="hidden" id="removalist_data" name="contact_id" class="form-control" value="">-->
                                                    
                                                    <input id="removalist"  class="form-control" value="<?php echo $name; ?>">
                                                    <input type="hidden" name="contact_id" value="<?php echo $row['contact_id']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="packers">
                                            <label class="control-label col-md-5">Packers</label>
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
<!--                                                <input id="packersdata" name="packers_data" class="form-control" >
                                                <input type="hidden" id="packer_data" name="contact_id" class="form-control" value="">-->
                                                    <input id="packersdata" name="packers_data" class="form-control" value="<?php echo $name; ?>">
                                                <input type="hidden" id="packer_data" name="contact_id" class="form-control" value="<?php echo $row['contact_id']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="packerSelection">
                                            <label class="control-label col-md-5">Packer Selection</label>
                                            <span class="error"></span>
                                            <div class="col-md-7">
                                                <textarea class="form-control" name="en_packer_selection"><?php echo $row['en_packer_selection']; ?></textarea>
    <!--                                            <input type="text" class="form-control" name="en_note">-->
                                            </div>
                                        </div>
                                        <div class="form-group" id="notes">
                                            <label class="control-label col-md-5">Job Sheet Notes</label>
                                            <span class="error"></span>
                                            <div class="col-md-7">
                                                <textarea class="form-control" name="en_note"><?php echo $row['en_note']; ?></textarea>
    <!--                                            <input type="text" class="form-control" name="en_note">-->
                                            </div>
                                        </div>
                                        <div class="form-group">
    <!--                                        <label class="control-label activiti-label col-md-12">Activities <span>Notes</span></label>-->
                                            <span class="error"></span>
                                            <div class="col-md-12">

                                                <div class="portlet-body activity-tab">
                                                    <ul class="nav nav-pills">
                                                        <li>
                                                            <a href="#tab_2_1" data-toggle="tab">Activities</a>
                                                        </li>
                                                        <li class="active">
                                                            <a href="#tab_2_2" data-toggle="tab">Internal Notes</a>
                                                        </li>                                                    
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade" id="tab_2_1">
                                                            <div class="portlet-body">
                                                                <ul class="nav nav-pills">
                                                                    <li class="dropdown" class="active">
                                                                        <a href="javascript:;" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"> All
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                                                                            <li class="active">
                                                                                <a href="#tab1_2_1" tabindex="-1" data-toggle="tab">All</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#tab2_2_1">In Progress</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#tab2_2_2">Overdue</a>
                                                                            </li>                                                                        
                                                                        </ul>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#tab1_2_2" data-toggle="tab">Add Ph...</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#tab1_2_3" data-toggle="tab">Add Task </a>
                                                                    </li>  
                                                                    <li class="dropdown" class="active">
                                                                        <a href="javascript:;" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"> 
                                                                            <i class="fa fa-ellipsis-v"></i>&nbsp;<i class="fa fa-angle-down"></i> 
                                                                        </a>
                                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">                                                                        
                                                                            <li>
                                                                                <a href="#tab2_2_1">Email</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="#tab2_2_2">Appointment</a>
                                                                            </li>                                                                        

                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane fade active in" id="tab1_2_1">

                                                                        <div class="mt-actions">
                                                                            <div class="mt-action">
                                                                                <div class="mt-action-img">
                                                                                    <img src="../assets/pages/media/users/avatar10.jpg"> </div>
                                                                                <div class="mt-action-body">
                                                                                    <div class="mt-action-row">
                                                                                        <div class="mt-action-info ">
                                                                                            <?php
                                                                                            foreach ($activitylog as $al) {
                                                                                                $adminname = $al['username'];
                                                                                                $sub = $al['email_log_subject'];
                                                                                            }
                                                                                            ?>
                                                                                            <div class="mt-action-details ">
                                                                                                <span class="mt-action-author"><?php echo $adminname; ?></span>
                                                                                                <p class="mt-action-desc"><?php echo $sub; ?>
    <!--                                                                                                    <span class="mt-action-time">9:30-13:00</span>-->
                                                                                                </p>
    <!--                                                                                                <p class="mt-action-day">Today</p>-->
                                                                                            </div>
                                                                                        </div>                                                                                    
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="tab1_2_2">                                                                    
                                                                        <div class="activity-form">
                                                                            <div class="col-xs-12">
                                                                                <div class="form-group">
                                                                                    <textarea class="form-control"></textarea>                                                                    
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4">Due</label>
                                                                                        <span class="error"></span>
                                                                                        <div class="col-md-8">
                                                                                            <input type="text" class="form-control" name="en_addpickup_street"></div>
                                                                                    </div> 
                                                                                </div>                                            
                                                                                <div class="col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4">Call With<span class="required" aria-required="true">*</span></label>
                                                                                        <span class="error"></span>
                                                                                        <div class="col-md-8">
                                                                                            <input type="text" class="form-control" name="en_addpickup_street"></div>
                                                                                    </div> 
                                                                                </div>                                            
                                                                                <div class="col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4">Direction</label>
                                                                                        <span class="error"></span>
                                                                                        <div class="col-md-8">
                                                                                            <input type="text" class="form-control" name="en_addpickup_street"></div>
                                                                                    </div> 
                                                                                </div>                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane fade" id="tab1_2_3">
                                                                        <div class="activity-form">                                                                        
                                                                            <div class="row">
                                                                                <div class="col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4">Subject<span class="required" aria-required="true">*</span></label>
                                                                                        <span class="error"></span>
                                                                                        <div class="col-md-8">
                                                                                            <input type="text" class="form-control" name="en_addpickup_street"></div>
                                                                                    </div> 
                                                                                </div>                                            
                                                                                <div class="col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4">Description</label>
                                                                                        <span class="error"></span>
                                                                                        <div class="col-md-8">
                                                                                            <textarea class="form-control"></textarea>
                                                                                        </div>
                                                                                    </div> 
                                                                                </div>                                            
                                                                                <div class="col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4">Due</label>
                                                                                        <span class="error"></span>
                                                                                        <div class="col-md-8">
                                                                                            <input type="text" class="form-control" name="en_addpickup_street"></div>
                                                                                    </div> 
                                                                                </div>                                            
                                                                                <div class="col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4">Priority</label>
                                                                                        <span class="error"></span>
                                                                                        <div class="col-md-8">
                                                                                            <input type="text" class="form-control" name="en_addpickup_street"></div>
                                                                                    </div> 
                                                                                </div>                                            
                                                                                <div class="col-xs-12">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-4">Owner<span class="required" aria-required="true">*</span></label>
                                                                                        <span class="error"></span>
                                                                                        <div class="col-md-8">
                                                                                            <input type="text" class="form-control" name="en_addpickup_street"></div>
                                                                                    </div> 
                                                                                </div>                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                               
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade active in" id="tab_2_2"> 

                                                            <div class="activity-area">
                                                                <input type="hidden" name="created_by" value="<?php echo $adminuser[0]['username']; ?>" id="adminUser">
                                                                <div class="col-xs-12 showon-area">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="note-title" name="notes_title" placeholder="Title" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 clickon-show">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control" name="notes_description" id="note-area" placeholder="Enter a note"></textarea>
                                                                    </div>
                                                                </div>                                                        
                                                                <div class="col-xs-12 showon-area">
                                                                    <div class="form-group">                                                                                                            
                                                                        <input type="file" class="filestyle" id="note-attachfile" name="notes_attachedfile" data-buttonBefore="true" data-placeholder="No file" data-text="<b>+</b> Add files">
                                                                        <span class="activity-file"></span>
                                                                        <button type="button" class="btn btn-info pull-right fileupload" id="notesubmit">Done</button>

                                                                    </div>                                                                
                                                                </div>
                                                                <div class="activity-notes">                                                                     
                                                                    <?php
//                                                                        echo "<pre>";
//                                                                        print_r($notes);
//                                                                        die;
                                                                    $yy = 0;
                                                                    $zz = 0;
                                                                    $nn = 0;
                                                                    $dd = 0;
                                                                    $tt = 0;
                                                                    $rr = 0;
                                                                    foreach ($notes as $nt) {
                                                                        // echo $nt['notes_id'];
                                                                        $notesid = explode("##", $nt['nid']);
                                                                        $notestitle = explode("##", $nt['nt']);
                                                                        $notesd = explode("##", $nt['nd']);
                                                                        $notesda = explode("##", $nt['ndate']);
                                                                        $nattach = explode("##", $nt['nattach']);

                                                                        $adminuser = $nt['username'];
                                                                        $notesdate = $nt['notes_date'];
                                                                        $notesattach = $nt['notes_attachedfile'];
//                                                                        foreach ($notestitle as $notest) {
////                                                                            echo "<pre>";
////                                                                           print_r($notest);
//
//                                                                            $notesti = $notest;
                                                                        ?> 

                                                                        <div class="activity-item">
                                                                            <span class="close-notes" data-id="<?php echo $notesid[$dd++]; ?>">&#10006;</span>
                                                                            <h6><?php echo $notestitle[$tt++]; ?></h6>

                                                                            <p><?php echo $notesd[$yy++]; ?></p>
                                                                            <?php
                                                                            if ($nattach[$nn++] == "") {
                                                                                
                                                                            } else {
                                                                                ?> 
                                                                                       
                                                                                <p><a href="<?php echo base_url() . 'enquiries/downloadNotes/' . $notesid[$rr++]; ?> "> Attachment </a></p>
                                                                            <?php } ?>

                                                                            <p>
                                                                                <a href="#"><?php echo $adminuser; ?></a>
                                                                                <?php
                                                                                $date = $notesda[$zz++];
                                                                                echo date('d-m-Y h:i:s A', strtotime($date));
                                                                                //  echo date("d-m-Y H:m:s A", strtotime($notesda[$zz++])); 
                                                                                ?>
                                                                            </p></div>
                                                                        <?php
                                                                        // }
                                                                    }
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
                                <div class="col-md-6">
                                    <div class="portlet">
                                        <div class="portlet-title" data-id="porlet-actions">
                                            <div class="caption">                                
                                                <span class="caption-subject font-dark sbold uppercase">Actions</span>
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="porlet-section" id="porlet-actions">
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
                                    <div id="movingFrom">
                                            <div class="portlet">
                                                <div  id="movingFromlbl">
                                                    <div class="portlet-title">
                                                        <div class="caption">                                
                                                            <span class="caption-subject font-dark sbold uppercase">Moving From</span>
                                                        </div>                            
                                                    </div>
                                                </div>  
                                            </div>  
                                            <div class="portlet">
                                                <div id="packerUnpackerlbl">
                                                    <div class="portlet-title" data-id="porlet-address">
                                                        <div class="caption">                                
                                                            <span class="caption-subject font-dark sbold uppercase">Address</span>
                                                        </div>                            
                                                    </div>
                                                </div>  
                                            </div>  
                                            <div class="porlet-section" id="porlet-address">
                                                <div id="movingFromtxt">
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
                                                                    <?php
                                                                    if ($row['en_movingfrom_postcode'] == 0) {
                                                                        $mfpostcode = "";
                                                                    } else {
                                                                        $mfpostcode = $row['en_movingfrom_postcode'];
                                                                    }
                                                                    ?>
                                                                    <input type="text" class="form-control" id="movingfrompostcode" name="en_movingfrom_postcode" value="<?php echo $mfpostcode; ?>"></div>
                                                            </div> 
                                                        </div>
                                                    </div>                            
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group ui-widget">
                                                                <label class="control-label col-md-4">Suburb</label>
                                                                <span class="error"></span>
                                                                <div class="col-md-8">
                                                                    <input id="movingfromsuburb" name="en_movingfrom_suburb" class="form-control suburb" value="<?php echo $row['en_movingfrom_suburb']; ?>">
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-4">State<span class="required">*</span></label>
                                                                <span class="error"></span>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control " id="movingfromstate" name="en_movingfrom_state" value="<?php echo $row['en_movingfrom_state']; ?>"></div>
                                                            </div> 
                                                        </div>
                                                    </div>                            
                                                </div>
                                            </div>
                                            <div class="portlet" id="movingTolbl">
                                                <div class="portlet-title" data-id="movingTotxt">
                                                    <div class="caption">                                
                                                        <span class="caption-subject font-dark sbold uppercase">Moving To</span>
                                                    </div>                            
                                                </div>
                                            </div>
                                            <div class="porlet-section" id="movingTotxt">
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
                                                                <?php
                                                                if ($row['en_movingto_postcode'] == 0) {
                                                                    $ftpostcode = "";
                                                                } else {
                                                                    $ftpostcode = $row['en_movingto_postcode'];
                                                                }
                                                                ?>
                                                                <input type="text" class="form-control" id="movingtopostcode" name="en_movingto_postcode" value="<?php echo $ftpostcode; ?>"></div>
                                                        </div> 
                                                    </div>
                                                </div>                            
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Suburb</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
            <!--                                                    <select class="form-control select2me" id="movingtosuburb" name="en_movingto_suburb"></select>-->
                                                                <input type="text" class="form-control suburb" id="movingtosuburb" name="en_movingto_suburb" value="<?php echo $row['en_movingto_suburb']; ?>">
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">State<span class="required">*</span></label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control " id="movingtostate" name="en_movingto_state" value="<?php echo $row['en_movingto_state']; ?>"></div>
                                                        </div> 
                                                    </div>
                                                </div>                            
                                            </div>
                                            <div class="portlet" id="additionalPickuplbl">
                                                <div class="portlet-title" data-id="additionalPickuptxt">
                                                    <div class="caption">                                
                                                        <span class="caption-subject font-dark sbold uppercase">Additional Pickup</span>
                                                    </div>                            
                                                </div>
                                            </div> 
                                            <div class="porlet-section" id="additionalPickuptxt">
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
                                                                <?php
                                                                if ($row['en_addpickup_postcode'] == 0) {
                                                                    $appostcode = "";
                                                                } else {
                                                                    $appostcode = $row['en_addpickup_postcode'];
                                                                }
                                                                ?>
                                                                <input type="text" class="form-control" id="addpickuppostcode" name="en_addpickup_postcode" value="<?php echo $appostcode; ?>"></div>
                                                        </div> 
                                                    </div>
                                                </div>                            
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Suburb</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
            <!--                                                    <select class="form-control select2me" id="addpickupsuburb" name="en_addpickup_suburb"></select>-->
                                                                <input type="text" class="form-control suburb" id="addpickupsuburb" name="en_addpickup_suburb" value="<?php echo $row['en_addpickup_suburb']; ?>">
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
                                            <div class="portlet" id="additionalDeliverylbl">
                                                <div class="portlet-title" data-id="additionalDeliverytxt">
                                                    <div class="caption">                                
                                                        <span class="caption-subject font-dark sbold uppercase">Additional Delivery </span>
                                                    </div>                            
                                                </div>
                                            </div> 
                                            <div class="porlet-section" id="additionalDeliverytxt">
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
                                                                <?php
                                                                if ($row['en_adddelivery_postcode'] == 0) {
                                                                    $adpostcode = "";
                                                                } else {
                                                                    $adpostcode = $row['en_adddelivery_postcode'];
                                                                }
                                                                ?>
                                                                <input type="text" class="form-control" id="adddeliverypostcode" name="en_adddelivery_postcode" value="<?php echo $adpostcode; ?>"></div>
                                                        </div> 
                                                    </div>
                                                </div>                            
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-4">Suburb</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-8">
            <!--                                                    <select class="form-control select2me" id="adddeliverysuburb" name="en_adddelivery_suburb"></select>-->
                                                                <input type="text" class="form-control suburb" id="adddeliverysuburb" name="en_adddelivery_suburb" value="<?php echo $row['en_adddelivery_suburb']; ?>">
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
                                            <div id="referralDetails">
                                                <div class="portlet">
                                                    <div class="portlet-title" data-id="portlet-referral">
                                                        <div class="caption">                                
                                                            <span class="caption-subject font-dark sbold uppercase">Referral Details</span>
                                                        </div>                            
                                                    </div>
                                                </div>
                                                <div class="porlet-section" id="portlet-referral">
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
                                                                    <input type="text" class="form-control" name="en_promotional_code" ></div>
                                                            </div> 
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="portlet">
                                        <div class="portlet-title" data-id="portlet-pricing">
                                            <div class="caption">                                
                                                <span class="caption-subject font-dark sbold uppercase">Pricing Information</span>
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="porlet-section" id="portlet-pricing">
                                        <div id="storagePrice">
                                            <div class="form-group" id="cubicMetersBooked">
                                                <label class="control-label col-md-6">Cubic meters booked</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="en_cubic_meters_booked" value="<?php echo $row['en_cubic_meters_booked']; ?>">
                                                </div>
                                            </div>  
                                            <div class="form-group" id="noOfModules">
                                                <label class="control-label col-md-6">No of modules required</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="en_noof_modules_required" value="<?php echo $row['en_noof_modules_required']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" id="cubicMetersByStorage">
                                                <label class="control-label col-md-6">Cubic meters confirmed by storage company?</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="en_cubic_meters_bystorage" value="<?php echo $row['en_cubic_meters_bystorage']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" id="quotedSellPrice">
                                                <label class="control-label col-md-6">Quoted sell price (inc.GST)</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control" name="en_quotedsell_price" value="<?php echo $row['en_quotedsell_price']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="quotedCostPrice">
                                                <label class="control-label col-md-6">Quoted cost price (inc.GST)</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control " name="en_quotedcost_price" value="<?php echo $row['en_quotedcost_price']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="hireaMoverMargin">
                                                <label class="control-label col-md-6">Hire a Mover Margin</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control " name="en_hireamover_margin" value="<?php echo $row['en_hireamover_margin']; ?>">
                                                    </div></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="porlet-section" id="packingPriceInfo">
                                        <div id="packingPrice">
                                            <div class="form-group" id="depositeAmt">
                                                <label class="control-label col-md-6">Deposit Amount</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control " id="depositamt" name="en_deposit_amt" value="<?php echo $row['en_deposit_amt']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="noOfMovers">
                                                <label class="control-label col-md-6">No. of movers</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="movers" name="en_no_of_movers" value="<?php echo $row['en_no_of_movers']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" id="noOfTrucks">
                                                <label class="control-label col-md-6">No. of trucks</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="trucks" name="en_no_of_trucks" value="<?php echo $row['en_no_of_trucks']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" id="travelFeeSell">
                                                <label class="control-label col-md-6">Travel Fee (Sell)</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control " id="travelfee" name="en_travelfee" value="<?php echo $row['en_travelfee']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="travelFeeCost">
                                                <label class="control-label col-md-6">Travel Fee (Cost)</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control " id="travelfeecost" name="en_travelfee_cost" value="<?php echo $row['en_travelfee_cost']; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="clientHourlyRate">
                                                <label class="control-label col-md-6">Client Hourly Rate (Sale)</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control " id="clienthourlyrate" name="en_client_hourly_rate" value="<?php echo $row['en_client_hourly_rate']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="additionalCharges">
                                                <label class="control-label col-md-6">Additional Charges (Sell)</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control " name="en_additional_charges" value="<?php echo $row['en_additional_charges']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="additionalItem">
                                                <label class="control-label col-md-6">Additional Item</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control phone" name="en_additional_item" value="<?php echo $row['en_additional_item']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" id="additionalCharges">
                                                <label class="control-label col-md-6">Additional Charges (Cost)</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control " name="en_additional_charges_cost" value="<?php echo $row['en_additional_charges_cost']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="packingUnpackingPrice">
                                            <div class="form-group" id="initialHoursbooked">
                                                <label class="control-label col-md-6">Initial hours booked</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="en_initial_hours_booked" value="<?php echo $row['en_initial_hours_booked']; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group" id="ladiesBooked">
                                                <label class="control-label col-md-6">Number of ladies booked</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="en_ladies_booked" value="<?php echo $row['en_ladies_booked']; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group" id="initialSellPrice">
                                                <label class="control-label col-md-6">Initial Sell Price</label>
                                                <span class="error"></span>
                                                <div class="col-md-6">
                                                    <div class="input-icon input-icon">
                                                        <i class="fa fa-usd"></i>
                                                        <input type="text" class="form-control" name="en_initial_sellprice" value="<?php echo $row['en_initial_sellprice']; ?>">
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
                                                    <input type="text" id="sellprice" class="form-control " name="en_total_sellprice" value="<?php echo $row['en_total_sellprice']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="totalCostPrice">
                                            <label class="control-label col-md-6">Total Cost Price</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <div class="input-icon input-icon">
                                                    <i class="fa fa-usd"></i>
                                                    <input type="text" id="costprice" class="form-control" name="en_total_costprice" value="<?php echo $row['en_total_costprice']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="hireaMoverMargin">
                                            <label class="control-label col-md-6">Hire a Mover Margin</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <div class="input-icon input-icon">
                                                    <i class="fa fa-usd"></i>
                                                    <input type="text" id="hamMargin" class="form-control " name="en_hireamover_margin" value="<?php echo $row['en_hireamover_margin']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="amountDueNow">
                                            <label class="control-label col-md-6"> Amount Due Now</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_amountDueNow" value="<?php echo $row['en_amountDueNow']; ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="portlet">
                                        <div class="portlet-title" data-id="depositReceived">
                                            <div class="caption">                                
                                                <span class="caption-subject font-dark sbold uppercase">Payment Information</span>
                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="porlet-section" id="depositReceived">
                                        <div class="form-group" id="depositReceive">
                                            <label class="control-label col-md-6">Deposit Received</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <label class="mt-checkbox deposit-checkbox mt-checkbox-outline">
                                                    <?php
                                                    if ($row['en_deposit_received'] == '1') {
                                                        $chk = 'checked';
                                                    }
                                                    ?>
                                                    <input type="checkbox" name="en_deposit_received" value="1"<?php echo $chk; ?>>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group" id="depositPaidby">
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
                                        </div>
                                        <div class="form-group" id="monthPayment">
                                            <label class="control-label col-md-6">First month's payment received?</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <label class="mt-checkbox deposit-checkbox mt-checkbox-outline">
                                                    <?php
                                                    if ($row['en_month_payment_received'] == '1') {
                                                        $chk1 = 'checked';
                                                    }
                                                    ?>
                                                    <input type="checkbox" name="en_month_payment_received" value="1"<?php echo $chk1; ?>>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group" id="payment_methods">
                                            <label class="control-label col-md-6">Payment method</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <select class="form-control" name="en_paymentmethod">
                                                    <option value="">Select</option>
                                                    <option value="1" <?php
                                                    if ($row['en_paymentmethod'] == 1) {
                                                        echo "selected";
                                                    }
                                                    ?>>EFT</option>
                                                    <option value="2" <?php
                                                    if ($row['en_paymentmethod'] == 2) {
                                                        echo "selected";
                                                    }
                                                    ?>>Cash</option>
                                                    <option value="3" <?php
                                                    if ($row['en_paymentmethod'] == 3) {
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
                                                <input type="text" class="form-control " name="en_eway_refno" value="<?php echo $row['en_eway_refno']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="EFTReceivedon">
                                            <label class="control-label col-md-6">EFT Received on</label>
                                            <div class="col-md-6">
                                                <?php
                                                if ($row['en_eft_receivedon'] == NULL) {
                                                    $efton = "";
                                                } else {
                                                    $efton = date("d-m-Y", strtotime($row['en_eft_receivedon']));
                                                }
                                                ?>
                                                <input class="form-control form-control-inline date-picker" id="eftreceivedon" name="en_eft_receivedon" size="16" type="text" value="<?php echo $efton; ?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="form-group" id="packingCompanyPaid">
                                            <label class="control-label col-md-6">Packing company paid</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_packing_company_paid" value="<?php echo $row['en_packing_company_paid']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="anniversarydate">
                                            <label class="control-label col-md-6">Anniversary date for future payments</label>
                                            <div class="col-md-6">
                                                <?php
                                                if ($row['en_anniversarydate'] == NULL) {
                                                    $anniversarydate = "";
                                                } else {
                                                    $anniversarydate = date("d-m-Y", strtotime($row['en_anniversarydate']));
                                                }
                                                ?>
                                                <input class="form-control form-control-inline date-picker" id="anniversaryDate" name="en_anniversarydate" size="16" type="text" value="<?php echo $anniversarydate; ?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="form-group" id="ewayrecurringPayment">
                                            <label class="control-label col-md-6">Eway recurring payment setup?</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_ewayrecurring_payment" value="<?php echo $row['en_ewayrecurring_payment']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="futurePaymentLog">
                                            <label class="control-label col-md-6">Future payment log</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_futurepayment_log" value="<?php echo $row['en_futurepayment_log']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group" id="EWAYTOKEN">
                                            <label class="control-label col-md-6">EWAY TOKEN</label>
                                            <span class="error"></span>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control " name="en_eway_token" value="<?php echo $row['en_eway_token']; ?>">
                                            </div>
                                        </div>
                                    </div>
                    
                                </div>
                                <div class="form-actions">                                
                                    <div class="col-xs-12 text-center">
                                        <button type="submit" class="btn green">Update</button>
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
    <script src="<?php echo base_url('assets/custom/js/bootstrap-filestyle.min.js'); ?>" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            var wd = jQuery(window).width();
            if (wd < 768) {
                jQuery('.portlet-title').click(function () {
                    jQuery(this).toggleClass('open');
                    var pid = $(this).data('id');
                    console.log(pid);
                    jQuery('#'+pid).slideToggle();
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
                    jQuery('.showon-area').slideUp();
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
                    jQuery('.activity-notes').prepend('<div class="activity-item"><span class="close-notes">&#10006;</span><h6>' + titleval + '</h6><p>' + areaval + '</p><p><a href="">' + attach + '</p><p><a href="#">' + created + '</a>' + outStr + '</p></div>')
//                    jQuery('#note-title').val('');
//                    jQuery('#note-area').val('');
                    // jQuery('#note-attachfile').val('');
                    jQuery('.showon-area').slideUp();
                } else {
                    return false;
                    //jQuery('.showon-area').slideUp();
                }
                $("#enquiry-form").trigger("submit");
            });
//            jQuery('body').on('click', '.close-notes', function () {
//                jQuery(this).closest('.activity-item').remove();
//            });

            jQuery(":file").filestyle({buttonBefore: true});

        });
    </script>
