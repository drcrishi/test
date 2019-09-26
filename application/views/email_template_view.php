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
                <div class="row peoles-nav-border">
                    <div class="col-md-2 col-xs-12 col-sm-2">
                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Email Template</h4>
                    </div>
<!--                    <div class="col-md-10 col-xs-12 col-sm-10">
                        <ul class="nav navbar-nav people-nav">
                            <li>
                                <a href="#" class="new-people" data-toggle="modal" data-target="#new-people"><i class="fa fa-plus-circle"></i> New </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                        </ul>
                    </div>-->
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
                                                <input type="text" name="temp_name" data-required="1" class="form-control" /> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-1">Move Type</label>
                                            <div class="col-md-3">
                                                <select class="form-control" name="move_type">
                                                    <?php
                                                    foreach ($move_type as $mt) {
                                                        ?>
                                                        <option value="<?php echo $mt['movetype_id']; ?>"><?php echo $mt['movetype_name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label class="control-label col-md-1">Temp. Type</label>
                                            <div class="col-md-3">
                                                <select class="form-control" name="temp_type">
                                                    <?php
                                                    foreach ($template_master as $tm) {
                                                        ?>
                                                        <option value="<?php echo $tm['template_master_id']; ?>"><?php echo $tm['template_master_name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-1">From<span class="required" aria-required="true">*</span></label>
                                            <div class="col-md-3">
                                                <input type="text" name="from" data-required="1" class="form-control" /> 
                                            </div>
                                            <label class="control-label col-md-1">To</label>
                                            <div class="col-md-3">
                                                <input type="text" name="to" class="form-control" /> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-1">Cc</label>
                                            <div class="col-md-3">
                                                <input type="text" name="cc"  class="form-control" /> 
                                            </div>
                                            <label class="control-label col-md-1">Bcc</label>
                                            <div class="col-md-3">
                                                <input type="text" name="bcc"  class="form-control" /> 
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-1">Subject<span class="required" aria-required="true">*</span></label>
                                            <div class="col-md-7">
                                                <input type="text" name="subject" data-required="1" class="form-control" /> </div>
                                        </div>
                                        <div class="form-group last">
                                            <label class="control-label col-md-1"></label>
                                            <div class="col-md-7">
                                                <!--<textarea class="ckeditor form-control" name="editor2" rows="6" data-error-container="#editor2_error"></textarea>-->
                                                <div name="summernote" id="summernote_1"> </div>
                                                <textarea class="editor2 hide" name="editor2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Submit</button>
                                                <button type="button" class="btn default">Cancel</button>
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
