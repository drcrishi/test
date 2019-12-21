<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="ajaxLoader">
    
</div>
    <div class="page-wrapper">
        <div class="page-content-wrapper">
            <div class="page-content" style="margin-left: 0;">
                <div class="row peoles-nav-border people-wrapper">
                    <div class="col-md-2 col-xs-12 col-sm-2 people-left">
                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Email Template</h4>
                        <div class="people-toggle">
                            <span></span>
                        </div>
                    </div>
                    <div class="col-md-10 col-xs-12 col-sm-10 people-right">
                        <ul class="nav navbar-nav people-nav">
                            <li>
                                <a href="#" class="edit-close"><i class="fa fa-close"></i> Close </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light portlet-fit portlet-form">
                            <div class="portlet-body">
                                <?php
                                $moveTypeArray = array("1" => "Hire A Mover Quote", "2" => "Hire A Mover Quote", "3" => "Hire A Mover Quote", "4" => "Hire A Packer Quote", "5" => "Hire A Packer Quote", "6" => "Hire A Storage Quote","7" => "Luxe Packer Quote","8" => "Luxe Packer Quote");
                                ?>
                                <h3><?php echo $moveTypeArray[$enquiry_data[0]['en_movetype']]; ?> - <?php echo date('d/m/y', strtotime($enquiry_data[0]['en_servicedate'])); ?> <?php echo $enquiry_data[0]['en_servicetime']; ?></h3>

                                <?php
                                echo form_open('#', 'method="post" class="form-horizontal email_template" id="email_template" novalidate="novalidate"');
                                ?>
                                <div class="form-body">
                                     <input type="hidden" name="movetype" value="<?php echo $enquiry_data[0]['en_movetype']; ?>">
                                     <input type="hidden" name="enquiryId" value="<?php echo $enquiry_data[0]['enquiry_id']; ?>">
                                     <input type="hidden" name="edit_sms" id="edit_sms" value="sendSms">

                                    <div class="form-group">
                                        <label class="control-label col-md-1">Phone<span class="required" aria-required="true">*</span></label>
                                        <div class="col-md-3">
                                            <input type="text" name="phonenumber" id="phonenumber" value="" data-required="1" class="form-control" /> 
                                        </div>
                                    </div>
                                    <div class="form-group last">
                                        <label class="control-label col-md-1"></label>
                                        <div class="col-md-7">
                                            <div name="summernote" id="summernote_1"> </div>
                                            <textarea  class="editor2 hide" name="editor2"><?php echo $form_data[0]['email_editor']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green editSend">Send</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var templateID = "<?php echo $templateID; ?>";
    </script>
    <div class="quick-nav-overlay"></div>