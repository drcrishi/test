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
                            <a href="<?php echo base_url("emailtemplate"); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Email template</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->

                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row peoles-nav-border people-wrapper">
                    <div class="col-md-3 col-xs-12 col-sm-4 people-left">
                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Email Template</h4>
                        <div class="peop-btn-right">
                            <div class="people-toggle">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-xs-12 col-sm-8 pad-right0 people-right">                           
                        <ul class="nav navbar-nav people-nav">
<!--                            <li>
                                <a href="<?php echo base_url('emailtemplate/new'); ?>"><i class="fa fa-plus-circle"></i> New </a>
                            </li>-->
                            <li>
                                <a href="#" class="saveData"><i class="fa fa-save"></i> Save </a>
                            </li>
                            <li>
                                <a href="#"  class="deleteData" data-id="<?php echo $form_data[0]['email_master_id'] ?>"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light portlet-fit portlet-form">
                            <div class="portlet-body">
                                <!-- BEGIN FORM-->
                                <!--<form action="#" method="post" id="email_template" class="form-horizontal email_template" >-->
                                <?php
                                echo form_open('#', 'method="post" class="form-horizontal email_template" id="email_template" novalidate="novalidate"');
                                ?>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-1">Temp. Name</label>
                                        <div class="col-md-7">
                                            <input type="text" value="<?php echo $form_data[0]['email_master_template_name']; ?>" name="temp_name" data-required="1" class="form-control" /> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1">Move Type</label>
                                        <div class="col-md-3">
                                            <select class="form-control" name="move_type">
                                                <?php
                                                foreach ($move_type as $mt) {
                                                    $selected = "";
                                                    if ($form_data[0]['en_movetype'] == $mt['movetype_id']) {
                                                        $selected = 'selected';
                                                    }
                                                    ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $mt['movetype_id']; ?>"><?php echo $mt['movetype_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1">Temp. Type</label>
                                        <div class="col-md-3">
                                            <select class="form-control" name="temp_type">
                                                <?php
                                                foreach ($template_master as $tm) {
                                                    $selected = "";
                                                    if ($form_data[0]['template_master_id'] == $tm['template_master_id']) {
                                                        $selected = 'selected';
                                                    }
                                                    ?>
                                                    <option <?php echo $selected; ?> value="<?php echo $tm['template_master_id']; ?>"><?php echo $tm['template_master_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1">From<span class="required" aria-required="true">*</span></label>
                                        <div class="col-md-3">
                                            <input type="text" value="<?php echo $form_data[0]['email_from']; ?>" name="from" data-required="1" class="form-control" /> 
                                        </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1">To</label>
                                        <div class="col-md-3">
                                            <input value="<?php echo $form_data[0]['email_to']; ?>" type="text" name="to"  class="form-control" /> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1">Cc</label>
                                        <div class="col-md-3">
                                            <input type="text" value="<?php echo $form_data[0]['email_cc']; ?>" name="cc"  class="form-control" /> 
                                        </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1">Bcc</label>
                                        <div class="col-md-3">
                                            <input type="text" value="<?php echo $form_data[0]['email_bcc']; ?>" name="bcc"  class="form-control" /> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-1">Subject<span class="required" aria-required="true">*</span></label>
                                        <div class="col-md-7">
                                            <input value="<?php echo $form_data[0]['email_subject']; ?>" type="text" name="subject" data-required="1" class="form-control" /> 
                                        </div>
                                        <input  value="<?php echo $form_data[0]['email_master_id']; ?>" type="hidden" name="templateID"  /> 
<!--                                        <input  value="<?php echo $form_data[0]['EnquiryId']; ?>" type="hidden" name="EnquiryId"  />-->
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1">Variables:</label>
                                        <div class="col-md-7 variablePointer">
                                            <span title="Client Firstname  e.g. Brett"><strong>{{clientfirstname}}</strong></span>
                                            <span title="Client Firstname  e.g. Brett"><strong>{{clientname}}</strong></span>
                                            <span title="Admin Full Name  e.g. Brett Epstein"><strong>{{sendername}}</strong></span>
                                            <span title="No of Mover e.g. 2"><strong>{{noofmover}}</strong></span>
                                            <span title="Subject Datatime  e.g. 27/09/2017 1-3pm"><strong>{{subjectdatetime}}</strong></span>
                                            <span title="Body Datatime  e.g. 1-3pm on 27/09/2017"><strong>{{datetime}}</strong></span>
                                            <span title="No of Truck e.g. 1"><strong>{{nooftruck}}</strong></span>
                                            <span title="Hourly Rate e.g. $120.00"><strong>{{hourlyrate}}</strong></span>
                                            <span title="Travel Fee e.g. $80.00"><strong>{{tavelfee}}</strong></span>
                                            <span title="Amount e.g. $50.00"><strong>{{amt}}</strong></span>
                                            <span title="Unique ID"><strong>{{uuid}}</strong></span>
                                            <span title="Initial sell price"><strong>{{initialsellprice}}</strong></span>
                                            <span title="No of ladies booked"><strong>{{noofladiesbooked}}</strong></span>
                                            <span title="Initial hours booked"><strong>{{initialhoursbooked}}</strong></span>
                                            <span title="Moving from state"><strong>{{movingfromstate}}</strong></span>
                                            <span title="Moving from street"><strong>{{movingfromstreet}}</strong></span>
                                            <span title="Moving from postcode"><strong>{{movingfrompostcode}}</strong></span>
                                            <span title="Moving from suburb"><strong>{{movingfromsuburb}}</strong></span>
                                            <span title="Moving to state"><strong>{{movingtostate}}</strong></span>
                                            <span title="Moving to street"><strong>{{movingtostreet}}</strong></span>
                                            <span title="Moving to postcode"><strong>{{movingtopostcode}}</strong></span>
                                            <span title="Moving to suburb"><strong>{{movingtosuburb}}</strong></span>
                                            <span title="Additional charges"><strong>{{additionalcharges}}</strong></span>
                                            <span title="Additional charge items"><strong>{{additionalchargeitem}}</strong></span>
                                            <span title="Client full name"><strong>{{clientfullname}}</strong></span>
                                            <span title="Date"><strong>{{date}}</strong></span>
                                            <span title="Status"><strong>{{status}}</strong></span>
                                            <span title="Packers"><strong>{{packers}}</strong></span>
                                            <span title="Additional Pickup"><strong>{{additionalpickup}}</strong></span>
                                            <span title="Additional Delivery"><strong>{{additionaldelivery}}</strong></span>
                                            <span title="From Add"><strong>{{fromadd}}</strong></span>
                                            <span title="To Add"><strong>{{toadd}}</strong></span>
                                            <span title="Pre label of datetime"><strong>{{datetimepre}}</strong></span>
                                            <span title="Jobsheet notes"><strong>{{jobsheetnotes}}</strong></span>
                                            <span title="Additional Charge for Packer"><strong>{{additionalchargeforpacker}}</strong></span>
                                        </div>
                                    </div>
                                    <div class="form-group last">
                                        <label class="control-label col-md-1">Editor</label>
                                        <div class="col-md-7">
                                            <!--<textarea class="ckeditor form-control" name="editor2" rows="6" data-error-container="#editor2_error"></textarea>-->
                                            <div name="summernote" id="summernote_1"> </div>
                                            <textarea class="editor2 hide" name="editor2"><?php echo $form_data[0]['email_editor']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green saveEdit hide">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
    </div>

    <div class="quick-nav-overlay"></div>

<script src="<?php echo base_url('assets/custom/js/bootstrap-select.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/custom/js/DateTimePicker.min.js'); ?>" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        var wd = $(window).width();        
        
        if (wd < 768) {
            jQuery('select').selectpicker();
        }
    });
</script>
