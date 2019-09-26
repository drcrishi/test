<?php
$sessionId = $this->session->userdata('admin_id');
?>
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
<!--            <a href="<?php echo base_url('enquirieslist'); ?>"><img src="<?php echo base_url('assets/layouts/layout/img/logo-white.png'); ?>" alt="logo" class="logo-default" /> </a>-->
            <a href="<?php echo base_url('dashboard'); ?>"><span class="inner-slogan">HAM<span>CRM</span></span><img src="https://crm.hireamover.com.au/assets/img/ham-logo.png" alt="" class="ham-logo"></a>
            <!--<h3>HAM</h3>-->
            </a>
            <div class="menu-toggler sidebar-toggler hide">
                <span></span> 
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>

        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu ">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                <li class="dropdown dropdown-extended dropdown-notification hide" id="header_notification_bar1">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        <span class="badge badge-default"> <?php echo count($notification); ?> </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                <?php
                                foreach ($notification as $noti) {
                                    ?>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="time"><?php echo $noti['time']; ?></span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-danger">
                                                    <i class="fa fa-bolt"></i>
                                                </span> <?php echo $noti['description']; ?> </span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <?php
//                        echo "<pre>";
//                        print_r($userprofile[0]['userprofile']);
//                        die;
                        if (!empty($userprofile[0]['userprofile'])) {
                            ?>                         
                        <img alt="" id="adminprofilepic" class="img-circle" src="<?php echo base_url(); ?>assets/uploads/userprofile/<?php echo $userprofile[0]['userprofile']; ?>" />
                        <? } else {
                            ?>                        
                        <img alt="" id="adminprofilepic" class="img-circle" src="<?php echo base_url(); ?>assets/uploads/userprofile/<?php echo $this->session->userdata('userprofile'); ?>" />
                        <?php }
                        ?>
                        <!--<img alt="" class="img-circle" src="<?php echo base_url(); ?>assets/uploads/userprofile/<?php echo $this->session->userdata('userprofile'); ?>" />-->
                        <div class="username username-hide-on-mobile"> <?php echo $this->session->userdata('admin_firstname'); ?> </div>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?php echo base_url('userprofile/viewUserprofile/') . $this->session->userdata('admin_id'); ?>">
                                <i class="icon-user"></i> My Profile </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="<?php echo base_url('logout'); ?>">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN --                
                <!-- END QUICK SIDEBAR TOGGLER -->
                  <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle d-menu-close" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        <span class="badge badge-default notibadge">0</span>
                    </a>
                    <ul class="dropdown-menu dmenu-close-not">
                        <li class="external">
                            <h3>
                                <span class="bold">All</span> notifications</h3>
                            <!--<a href="page_user_profile_1.html">view all</a>-->
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller deporeceivenotify" style="height: 250px;" data-handle-color="#637283">
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->

        <!-- END RESPONSIVE MENU TOGGLER -->
        <div class="hor-menu">
            <ul class="nav navbar-nav">
                <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                <li class="classic-menu-dropdown" aria-haspopup="true">
                    <a href="<?php echo base_url("dashboard"); ?>">
                        <i class="fa fa-tachometer"></i> Dashboard
                        <span class="selected"> </span>
                    </a>
                </li>
                <li class="classic-menu-dropdown" aria-haspopup="true">
                    <a href="<?php echo base_url("enquirieslist"); ?>">
                        <i class="fa fa-pencil-square-o"></i> Enquiries
                        <span class="selected"> </span>
                    </a>
                </li>
                <li class="classic-menu-dropdown" aria-haspopup="true">
                    <a href="<?php echo base_url("bookinglist"); ?>">
                        <i class="fa fa-newspaper-o"></i> Bookings
                        <span class="selected"> </span>
                    </a>
                </li>
                <li class="classic-menu-dropdown" aria-haspopup="true">
                    <a href="<?php echo base_url("enquiries/new"); ?>">
                        <i class="fa fa-plus-circle"></i> New Enquiry
                        <span class="selected"> </span>
                    </a>
                </li>
                <li class="classic-menu-dropdown" aria-haspopup="true">
                    <a href="<?php echo base_url("booking/newBooking"); ?>">
                        <i class="fa fa-plus-circle"></i> New Booking
                        <span class="selected"> </span>
                    </a>
                </li>
              
                <li class="classic-menu-dropdown" aria-haspopup="true">
                    <a href="#">
                        <i class="fa fa-angle-down"></i> Extra 
                        <span class="selected"> </span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li>
                            <a href="<?php echo base_url("contacts"); ?>">
                                <i class="fa icon-call-end"></i> Contacts
                                <span class="selected"> </span>
                            </a>
                        </li>
                        <?php if ($sessionId == 1) {
                            ?>
                            <li>
                                <a href="<?php echo base_url("emailtemplate"); ?>">
                                    <i class="fa fa-envelope"></i> Email
                                    <span class="selected"> </span>
                                </a>
                            </li>
                        <?php } else {
                            ?> 
                            <li></li>
                        <?php } ?>
                        <?php if ($sessionId == 1) {
                            ?>
                            <li>
                                <a href="<?php echo base_url("userprofilelist"); ?>">
                                    <i class="fa fa-users"></i> Users
                                    <span class="selected"> </span>
                                </a>
                            </li>
                        <?php } else {
                            ?> 
                            <li></li>
                        <?php } ?>
                        <?php if ($sessionId == 1) {
                            ?>
                            <li>
                                <a href="<?php echo base_url("revenueReport/index"); ?>" id="revenueReport">
                                    <i class="fa fa-file-word-o" aria-hidden="true"></i> HAM - Revenue Report 
                                    <span class="selected"> </span>
                                </a>
                            </li>
                        <?php } else {
                            ?> 
                            <li></li>
                        <?php } ?>

                        <?php if ($sessionId == 1) {
                                    ?>
                                    <li>
                                        <a href="<?php echo base_url("wagesReport"); ?>" id="wagesReport">
                                            <i class="fa fa-file-word-o" aria-hidden="true"></i> HAP - Wages Report 
                                            <span class="selected"> </span>
                                        </a>
                                    </li>
                                <?php } 
                                    ?> 

                        <?php if ($sessionId == 1) {
                            ?>
                            <li>
                                <a href="<?php echo base_url("Emailconfiglist/index"); ?>">
                                    <i class="fa fa-cogs" aria-hidden="true"></i> Email Config 
                                    <span class="selected"> </span>
                                </a>
                            </li>
                        <?php } else {
                            ?> 
                            <li></li>
                        <?php } ?>

                        <?php if ($sessionId == 1 || $sessionId == 5) {
                            ?>
                            <li class="sub-menu-parent">
                                <a href="javascript:void(0)">
                                    <i class="fa fa-gavel" aria-hidden="true"></i> Price Rules 
                                    <span class="selected"> </span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li>
                                        <a href="<?php echo base_url("pricelist"); ?>">
                                            <i class="fa fa-gavel" aria-hidden="true"></i> Home/Office 
                                            <span class="selected"> </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url("packer"); ?>">
                                            <i class="fa fa-gavel" aria-hidden="true"></i> Packing/Unpacking 
                                            <span class="selected"> </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url("bedroom"); ?>">
                                            <i class="fa fa-gavel" aria-hidden="true"></i> Bedroom 
                                            <span class="selected"> </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>

                    </ul>
                </li>
                <!--<li class="classic-menu-dropdown" aria-haspopup="true">
                    <a href="<?php echo base_url("dashboard"); ?>">
                        <i class="fa fa-tachometer"></i> Dashboard
                        <span class="selected"> </span>
                    </a>
                </li>-->


            </ul>
        </div>

    </div>
    <!-- END HEADER INNER -->
</div>
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<div class="ajaxLoader">
    <!--<img src="<?php echo base_url("assets/layouts/layout/img/Blocks.gif"); ?>">-->
</div>
<!-- END HEADER & CONTENT DIVIDER -->
<script type="text/javascript">

    function myFunctionclose(id) {
                $.ajax({
                type: 'POST',
                url: BASE_URL + 'enquiries/changeDepositStatus/' + id,
                success: function (response) {
                    var res = JSON.parse(response);
                    //  console.log(res);
                    if (res.error) {
                        toastr.error('Something wrong.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    } else {
                       console.log(res.success);
                    }
                }
        })
        }
        
    jQuery(document).ready(function () {
        $('#header_notification_bar').on('click', function () {
            $.ajax({
                type: 'POST',
                url: BASE_URL + 'enquiries/getPaymentNotification/',
                success: function (response) {
                    var res = JSON.parse(response);
                    //  console.log(res);
                    if (res.error) {
                        toastr.error('Something wrong.');
                    } else if (res.expired) {
                        window.location = BASE_URL;
                    } else {
                        $('.deporeceivenotify').html(res.success);
                        // console.log(res.success);
                    }
                }
            })
        })
       
        


        
    });
    
    
    
    
    var $menu = $('.dmenu-close-not');

        $('.d-menu-close').click(function () {
                $menu.toggle();
        });

        $(document).mouseup(function (e) {
                if (!$menu.is(e.target) // if the target of the click isn't the container...
                && $menu.has(e.target).length === 0) // ... nor a descendant of the container
                {
                        $menu.hide();
                }
        });
</script>
<!-- BEGIN CONTAINER -->
<div class="page-container">