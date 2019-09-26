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
                                        echo form_open_multipart('EmailConf/viewEmailConfMaster', array('id' => 'emailconfmaster-form', 'method' => 'post'));
                                        foreach ($emailconfdata as $row) {
                                            ?>
                                            <input type="hidden" name="email_config_master_id" class="form-control" value="<?php echo $row['email_config_master_id']; ?>" />
                                              
                                        <div class="row">
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
                                                    <label class="control-label">SMTP User<span class="required">*</span></label>
                                                    <input name="smtp_user" class="form-control" type="text" value="<?php echo $row['smtp_user'];?>"> </div>
                                            </div>                                                        
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">SMTP Password<span class="required">*</span></label>
                                                    <input name="smtp_pass" class="form-control" type="password" value="<?php echo $row['smtp_pass'];?>"> </div>
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

    <div class="quick-nav-overlay"></div>
    <script src="<?php echo base_url('assets/custom/js/bootstrap-filestyle.min.js'); ?>" type="text/javascript"></script>
  
