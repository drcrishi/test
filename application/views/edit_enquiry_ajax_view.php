<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
foreach ($activitylog as $al) {
    $adminname = $al['username'];
    $sub = $al['email_log_subject'];
    $email_log_editor = $al['email_log_editor'];
    $email_log_time = date('d/m/Y h:i:s A', strtotime($al['email_log_date']));
    ?>
<div class="mt-action">
    <div class="mt-action-img">
        <i class="fa fa-envelope fa-2x" aria-hidden="true"></i> </div>
    <div class="mt-action-body">
        <div class="mt-action-row">
            <div class="mt-action-info ">
                <div class="mt-action-details ">
                    <span class="mt-action-author"><?php echo $adminname; ?></span>
                    <p class="mt-action-desc"><?php echo $sub; ?><p><?php echo $email_log_time; ?></p></p>                    
                    <div class="mt-action-desc action-main-div"><?php echo $email_log_editor; ?></div>                    
                </div> 
            </div>                                                                                    
        </div>
    </div>
</div>
    <?php
}
?>     