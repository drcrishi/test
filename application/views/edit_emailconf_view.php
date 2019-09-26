<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo "<pre>";
//print_r($userprofile);
//die;
$sessionId = $this->session->userdata('admin_id');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include "template/leftmenu.php"; ?>
        <!-- END HEADER -->

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper wbcolor"> 
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="margin-left: 0;">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url("Emailconfiglist/index"); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Edit Email</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <div class="row peoles-nav-border people-wrapper">
                    <div class="col-md-4 col-xs-12 col-sm-2 people-left">
                        <h4 class="peoples-page-title"><i class="fa fa-cogs"></i>&nbsp;Edit Email Configuration</h4>
                        <div class="peop-btn-right">
                        <div class="people-toggle">
                            <span></span>
                        </div>
                        </div>
                    </div>                    

                    <div class="col-md-8 col-xs-12 col-sm-10 pad-right0 people-right">                           
                      
                    </div>
                </div>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="profile">
                    <div class="col-md-12">
                        <div class="portlet light ">
                                                       
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="userform">
                                        <?php
                                        echo form_open_multipart('EmailConf/viewEmailConf', array('id' => 'emailconf-form', 'method' => 'post'));
                                        foreach ($emailconfdata as $row) {
                                            ?>
                                            <input type="hidden" name="emailconf_id" class="form-control" value="<?php echo $row['emailconf_id']; ?>" />
                                               <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Protocol<span class="required">*</span></label>
                                                    <select class="form-control" name="protocol">
                                                    <!--                                                <option value="">Select</option>-->
                                                    <option value="smtp" <?php
                                                    if ($row['protocol'] == 'smtp') {
                                                        echo "selected";
                                                    }
                                                    ?>>smtp</option>
                                                    </select>
                                                    <!--<input name="protocol" class="form-control" type="text" value="<?php echo $row['protocol'];?>"> -->
                                                    </div>
                                            </div>                                                
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">SMTP Port<span class="required">*</span></label>
                                                    <input name="smtp_port" class="form-control" type="text" value="<?php echo $row['smtp_port'];?>"> </div>
                                            </div>
                                        </div>
<!--                                        <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">SMTP User<span class="required">*</span></label>
                                                    <input name="smtp_user" class="form-control" type="text" value="<?php echo $row['smtp_user'];?>"> </div>
                                            </div>                                                        
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">SMTP Password<span class="required">*</span></label>
                                                    <input name="smtp_pass" class="form-control" type="password" value="<?php echo $row['smtp_pass'];?>"> </div>
                                            </div>
                                        </div>-->
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">SMTP Host<span class="required">*</span></label>
                                                    <input name="smtp_host" class="form-control" type="text" value="<?php echo $row['smtp_host'];?>"> </div>
                                            </div>                                                        
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Job type<span class="required">*</span></label>
                                                       <select class="form-control" name="jobtype">
                                                    <!--                                                <option value="">Select</option>-->
                                                    <option value="1" <?php
                                                    if ($row['jobtype'] == 1) {
                                                        echo "selected";
                                                    }
                                                    ?>>Move</option>
                                                    <option value="2" <?php
                                                    if ($row['jobtype'] == 2) {
                                                        echo "selected";
                                                    }
                                                    ?>>Pack</option>
                                                    <option value="3" <?php
                                                    if ($row['jobtype'] == 3) {
                                                        echo "selected";
                                                    }
                                                    ?>>Luxepack</option>

                                                </select>
                                                    <!--<input name="jobtype" class="form-control" type="text" value="<?php echo $row['jobtype'];?>"> </div>-->
                                            </div>
                                        </div>
                                              <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Email type<span class="required">*</span></label>
                                                       <select class="form-control" name="emailtype">
                                                    <!--                                                <option value="">Select</option>-->
                                                    <option value="QuoteR" <?php
                                                    if ($row['emailtype'] == "QuoteR") {
                                                        echo "selected";
                                                    }
                                                    ?>>QuoteR</option>
                                                    <option value="QuoteLP" <?php
                                                    if ($row['emailtype'] == "QuoteLP") {
                                                        echo "selected";
                                                    }
                                                    ?>>QuoteLP</option>
                                                    <option value="QuoteR" <?php
                                                    if ($row['emailtype'] == "QuoteR") {
                                                        echo "selected";
                                                    }
                                                    ?>>QuoteR</option>
                                                    <option value="QuoteP" <?php
                                                    if ($row['emailtype'] == "QuoteP") {
                                                        echo "selected";
                                                    }
                                                    ?>>QuoteP</option>
                                                    <option value="FollowupR" <?php
                                                    if ($row['emailtype'] == "FollowupR") {
                                                        echo "selected";
                                                    }
                                                    ?>>FollowupR</option>
                                                    <option value="FollowupP" <?php
                                                    if ($row['emailtype'] == "FollowupP") {
                                                        echo "selected";
                                                    }
                                                    ?>>FollowupP</option>
                                                    <option value="JobSheetR" <?php
                                                    if ($row['emailtype'] == "JobSheetR") {
                                                        echo "selected";
                                                    }
                                                    ?>>JobSheetR</option>
                                                    <option value="JobSheetP" <?php
                                                    if ($row['emailtype'] == "JobSheetP") {
                                                        echo "selected";
                                                    }
                                                    ?>>JobSheetP</option>
                                                    <option value="JobSheetLP" <?php
                                                    if ($row['emailtype'] == "JobSheetLP") {
                                                        echo "selected";
                                                    }
                                                    ?>>JobSheetLP</option>
                                                    <option value="BookingConfirmationR" <?php
                                                    if ($row['emailtype'] == "BookingConfirmationR") {
                                                        echo "selected";
                                                    }
                                                    ?>>BookingConfirmationR</option>
                                                    <option value="BookingConfirmationP" <?php
                                                    if ($row['emailtype'] == "BookingConfirmationP") {
                                                        echo "selected";
                                                    }
                                                    ?>>BookingConfirmationP</option>
                                                    <option value="SendFeedbackR" <?php
                                                    if ($row['emailtype'] == "SendFeedbackR") {
                                                        echo "selected";
                                                    }
                                                    ?>>SendFeedbackR</option>
                                                    <option value="SendFeedbackP" <?php
                                                    if ($row['emailtype'] == "SendFeedbackP") {
                                                        echo "selected";
                                                    }
                                                    ?>>SendFeedbackP</option>
                                                    <option value="SendReminderR" <?php
                                                    if ($row['emailtype'] == "SendReminderR") {
                                                        echo "selected";
                                                    }
                                                    ?>>SendReminderR</option>
                                                    <option value="SendReminderP" <?php
                                                    if ($row['emailtype'] == "SendReminderP") {
                                                        echo "selected";
                                                    }
                                                    ?>>SendReminderP</option>
                                                    <option value="InvoiceR" <?php
                                                    if ($row['emailtype'] == "InvoiceR") {
                                                        echo "selected";
                                                    }
                                                    ?>>InvoiceR</option>
                                                    <option value="InvoiceP" <?php
                                                    if ($row['emailtype'] == "InvoiceP") {
                                                        echo "selected";
                                                    }
                                                    ?>>InvoiceP</option>
                                                    <option value="forgotpassword" <?php
                                                    if ($row['emailtype'] == "forgotpassword") {
                                                        echo "selected";
                                                    }
                                                    ?>>forgotpassword</option>

                                                </select>
                                                    <!--<input name="jobtype" class="form-control" type="text"> </div>-->
                                            </div>
                                        </div>
                                            <div class="row">                                                
                                                <div class="col-sm-12 col-xs-12 text-center">
                                                    <div class="margiv-top-10">
                                                        <button type="submit" class="btn green form-submit">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        echo form_close();
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

    <div class="quick-nav-overlay"></div>
    <script src="<?php echo base_url('assets/custom/js/bootstrap-filestyle.min.js'); ?>" type="text/javascript"></script>
  
