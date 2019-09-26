<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$flashsuccessID = "falsemsg";
$flashsuccess = "";
if ($this->session->flashdata('flashSuccess')) {
    $flashsuccess = $this->session->flashdata('flashSuccess');
    $flashsuccessID = "truemsg";
}
$sessionId = $this->session->userdata('admin_id');
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
                <div class="page-bar">
                    <!--                    <ul class="page-breadcrumb">
                                            <li>
                                                <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                                                <i class="fa fa-circle"></i>
                                            </li>
                                            <li>
                                                <span>Booking List</span>
                                            </li>
                                        </ul>-->
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->

                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row peoles-nav-border people-wrapper">
                    <div class="page-bar col-md-2 col-xs-12 col-sm-2 people-left listtit-table" style="margin-left: 0; margin-top: 0px;">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                            </li>
                            <li>
                                <i class="fa fa-circle" style="margin: 5px 5px !important;"></i>
                                <span>Booking List</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-xs-12 col-sm-2 people-left listtit-table porttit-select">
                        <div class="enquiry-select">
                            <i class="fa fa-newspaper-o"></i>
<!--                            <select class="form-control selectbooking" id="view_booking">
                                <option value="all">All Bookings</option>
                                <option value="1" selected>Current Bookings</option>
                                <option value="3">Completed Bookings</option>
                            </select>-->
                            <?php
                            $url = base_url("bookinglist?en_monthstart=" . date('Y-m-01', strtotime(date('Y-m-d'))) . "& en_monthend=" . date('Y-m-d', strtotime(date('Y-m-d'))));
                            //echo $url;
                            if (strstr($_SERVER['REQUEST_URI'], "en_monthstart=")) {
                                ?>
                                <select class="form-control selectbooking" id="view_booking">
                                    <option value="all" selected>All Bookings</option>
                                    <option value="1" >Current Bookings</option>
                                    <option value="3">Completed Bookings</option>
                                </select> 
                            <?php } else {
                                ?> <select class="form-control selectbooking" id="view_booking">
                                    <option value="all">All Bookings</option>
                                    <option value="1" selected>Current Bookings</option>
                                    <option value="3">Completed Bookings</option>
                                </select>
<?php } ?>
                        </div>
                        <div class="peop-btn-right">

                            <div class="people-toggle">
                                <span></span>
                            </div>
                            <div class="filter-toggle">
                                <button type="button" class="btn dark btn-outline sbold uppercase filter-btn">Filter</button>
                            </div>
                        </div>
                        <span class="people-calendar mob-calendar"><i class="fa fa-calendar"></i>
                            <!--<div id="dtBox2"></div>
                                <input type="text" class="filterdate" data-field="date" readonly name="filterdate" placeholder="Service Date">-->
                            <input class="form-control form-control-inline filterdate" id="en_servicedate2" name="en_servicedate" size="16" value="" type="text">

                        </span>
                    </div>        


                    <div class="col-md-10 col-xs-12 col-sm-10 pad-right0 people-right">                           
                        <ul class="nav navbar-nav people-nav">
                            <li class="">
                                <div class="chat-form">
                                    <div class="input-cont">
                                        <input class="form-control" placeholder="Search Client..." type="text" id="fullname" name="fullname"> </div>
                                    <div class="btn-cont">
                                        <span class="arrow"> </span>
                                        <button class="btn blue icn-only bookingsearch"><i class="fa fa-search icon-white"></i></button>
                                        <!--                                        <a href="#" class="btn blue icn-only bookingsearch">
                                                                                    <i class="fa fa-check icon-white"></i>
                                                                                </a>-->
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="javascript:void(0)" class="search-toggle" ><i class="fa fa-search"></i> Search</a>
                            </li>
                            <li class="hidedesk">
                                <a href="<?php echo base_url("booking/newBooking"); ?>" ><i class="fa fa-plus-circle"></i> New </a>
                            </li>
                            <?php
                                if($this->session->admin_id == '1' || $this->session->admin_id == '2'){
                            ?>
                            <li>
                                <a href="#" class="edit-people" id="deleteBookinglist"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                            <?php
                                }
                            ?>
                            <li>
                                <a href="#" id="duplicateBookingform" class="edit-people"><i class="fa fa-clipboard" aria-hidden="true"></i> Duplicate </a>
                            </li>
                            <!--<li id="dis">
                                <a href="#" id="disqualifiedBooking" class="edit-people"><i class="fa fa-ban" aria-hidden="true"></i> Deactivate </a>
                            </li>-->
                            <!--                                                        <li>
                                                                                        <a href="<?php echo base_url("bookinglist/bookingExport"); ?>"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export To Excel </a>
                                                                                    </li>-->
                            <!--<li>
                                <a href="#" class="new-people" data-toggle="modal" data-target="#new-people"><i class="fa fa-database" aria-hidden="true"></i>Import Data </a>
                            </li>-->
                            <?php if ($sessionId == 1) {
                                ?>
                                <!--                                <li>
                                                                    <a href="<?php echo base_url("revenueReport/index"); ?>" id="revenueReport"><i class="fa fa-file-word-o" aria-hidden="true"></i> HAM - Revenue Report </a>
                                                                </li>-->
                            <?php } else {
                                ?> 
                                <!--                                <li></li>-->
<?php } ?>

                        </ul>
                    </div>
                    <span class="people-calendar desk-calendar"><i class="fa fa-calendar"></i>
                        <!--<div id="dtBox2"></div>
                            <input type="text" class="filterdate" data-field="date" readonly name="filterdate" placeholder="Service Date">-->
                        <input class="form-control form-control-inline filterdate" id="en_servicedate1" name="en_servicedate" size="16" value="" type="text">

                    </span>
                </div>

                <div id="new-people" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        Modal content
                        <div class="modal-content">
<?php echo form_open_multipart('bookinglist/import_booking', array('id' => '', 'method' => 'post')); ?>
                            <form action="#" id="people_new_form">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Upload Data File</h4>
                                    <?php //if ($this->session->flashdata('flashSuccess')):   ?>
                                    <p class='flashMsg hide  flashSuccess' id="<?php echo $flashsuccessID; ?>"> <?php echo $flashsuccess; ?> </p>
<?php //endif   ?>
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        <span>Fill all required fields.</span>
                                    </div>
                                    <div class="alert alert-success display-hide"><button class="close" data-close="alert"></button> Your form validation is successful! </div>
                                </div>
                                <div class="modal-body">
                                    <div class="portlet light portlet-fit portlet-form bordered">
                                        <div class="portlet-body">
                                            <div class="form-body">
                                                <label for="form_control_1">Data File Name: </label>
                                                <input type="file" name="bookingfile" id="bookingfile" size="20" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn green">Save</button>
                                </div>
                            </form>
<?php echo form_close(); ?>
                        </div>
                    </div>
                </div>

                <!-- BEGIN PAGE HEADER-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered table-div">
                            <div class="table-wrapper">                                
                                <div class="table-scroll booking-table">
                                    <!--                                    <div class="portlet-title">
                                                                            <div class="caption font-dark">
                                                                                <i class="icon-settings font-dark"></i>
                                                                                <span class="caption-subject bold uppercase">Your Bookings</span>
                                                                            </div>  
                                                                            <div class="col-sm-6 col-xs-8 enquiry-drop">                                    
                                                                            </div>
                                                                        </div>-->
                                    <div class="filter-wrapper">
                                        <span class="filter-close">&#x2716;</span>                                         
                                        <!--                                        <div class="alphabet-wrapper">
                                                                                    <span class="alpha-span">Search : </span>
                                                                                    <div class="alphabet">
                                                                                        <span>
                                                                                            <span class="clear active alphasearch open" id="all">all</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="A">A</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="B">B</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="C">C</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="D">D</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="E">E</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="F">F</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="G">G</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="H">H</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="I">I</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="J">J</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="K">K</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="L">L</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="M">M</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="N">N</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="O">O</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="P">P</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="Q">Q</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="R">R</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="S">S</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="T">T</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="U">U</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="V">V</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="W">W</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="X">X</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="Y">Y</span>
                                                                                        </span>
                                                                                        <span>
                                                                                            <span class="alphasearch" id="Z">Z</span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>-->

                                        <div class="row">

                                            <!--                                            <div class="col-sm-3 col-xs-12 filter-view">
                                                                                            <div class="form-group">
                                                                                                <label class="control-label">View Bookings :</label>
                                                                                                <div class="enquiry-select">
                                                                                                    <select class="form-control selectbooking" id="view_booking">
                                                                                                        <option value="all">All</option>
                                                                                                        <option value="1" selected>Current Bookings</option>
                                                                                                        <option value="3">Inactive Bookings</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> -->

                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label">First Name</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" id="first_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label">Last Name</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" id="last_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label">Email</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" id="email">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label">Service Date</label>
                                                <div class="form-group">												
                                                    <input class="form-control form-control-inline date-picker" id="en_servicedate" name="en_servicedate" size="16" type="text" value="<?php
                                                           if (isset($_GET['en_servicedate'])) {
                                                               echo $_GET['en_servicedate'];
                                                           }
                                                           ?>" />
                                                    <input type="text" class="mobdate" data-field="date" readonly name="mobdate" placeholder="Service Date">
                                                    <div id="dtBox"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 hide">
                                                <label class="control-label xs-remove">Quote Received</label>
                                                <div class="form-group">												
                                                    <input class="form-control form-control-inline date-picker" id="en_date" name="en_date" size="16" type="text" value="<?php
                                                           if (isset($_GET['en_bookingdate'])) {
                                                               echo $_GET['en_bookingdate'];
                                                           }
                                                           ?>" />
                                                    <input class="form-control form-control-inline date-picker" id="en_monthstart" name="en_date" size="16" type="hidden" value="<?php
                                                    if (isset($_GET['en_monthstart'])) {
                                                        echo $_GET['en_monthstart'];
                                                    }
                                                    ?>" />
                                                    <input class="form-control form-control-inline date-picker" id="en_monthend" name="en_date" size="16" type="hidden" value="<?php
                                                    if (isset($_GET['en_monthend'])) {
                                                        echo $_GET['en_monthend'];
                                                    }
                                                    ?>" />
                                                    <input type="text" class="quotedate" data-field="date" readonly name="mobdate" placeholder="Quote Received">
                                                    <div id="quoteBox"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <label class="control-label">Job Type :</label>
                                                <div class="form-group">
                                                    <select class="form-control" id="movetype_name" name="en_movetype">
                                                        <option value=""></option>
                                                        <option value="1">Home/Office</option>
                                                        <!--<option value="2">Office</option>-->
                                                        <option value="4">Packing/Unpacking</option>
                                                        <option value="6">Storage</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">State:</label>
                                                    <select class="form-control" id="movingfromstate">
                                                        <option value=""></option>
<?php
foreach ($statedata as $st) {
    ?> <option value="<?php echo $st['State']; ?>"><?php echo $st['State']; ?></option>
<?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Removalist</label>
                                                    <input id="removalistfilter" name="removalist_name" class="form-control removalist" >
                                                    <input type="hidden" id="removalist_booking" name="contact_id" class="form-control" value="">
                                                </div>
                                            </div>


                                            <div class="col-sm-3 col-xs-12"> 
                                                <label class="control-label xs-remove">&nbsp;</label>
                                                <div class="form-group">
                                                    <input type="submit" class="btn green filter-submit" value="Apply" id="apply">
                                                    <input type="submit" class="btn green filter-reset" value="Reset" id="reset">
                                                </div>                                            
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="filter-overlay"></div>

                                    <div class="portlet-body contactlist-table">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="bookinglist">
                                            <thead>
                                                <tr>
                                                    <th class="select_all_booking"><input type="checkbox" id="select_all_booking"></th>
                                                    <th>Booking Made</th>
                                                    <th>By</th>
                                                    <th>Service Date</th>
                                                    <th>Team</th>
                                                    <th>Service Time</th>
                                                    <th>Client</th>
                                                    <!--<th>Last Name</th>-->
<!--                                                    <th>Phone</th>-->
                                                    <th>State</th>											
                                                    <th>Job Type</th>
                                                    <!--<th>Is Deposited?</th>-->
                                                    <th>Status</th>
                                                    <th>JS</th>
                                                    <th>BC</th>
                                                </tr>
                                            </thead>																	
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
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
        var wind = jQuery(window).width();
        if (wind < 1200) {
            jQuery('.search-toggle').click(function () {
                jQuery('.filter-wrapper').addClass('filter-show');
                jQuery('body').addClass('body-left');
                jQuery('.filter-overlay').addClass('overlay-show');
            });
        } else {
            jQuery('.search-toggle').click(function () {
                jQuery('.filter-wrapper').slideToggle();
            });
        }


        jQuery('#bookinglist').bind('touchend', function (event) {

            var pas = event.target.parentElement.innerHTML;
            var go_url = jQuery(pas).find('.booklink').attr('href');

            var now = new Date().getTime();
            var lastTouch = jQuery(this).data('lastTouch') || now + 1
            var delta = now - lastTouch;
            if (delta < 500 && delta > 0) {
                jQuery('#bookinglist tbody tr.select').find('.checkbox_val').prop('checked', false);
                jQuery('#bookinglist tbody tr.select').removeClass('select');
                jQuery('#bookinglist tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).parent().addClass('select lasttr');
                document.location.href = go_url;
            } else {

            }
            jQuery(this).data('lastTouch', now);
        });

        $('.selectbooking').change(function () {
            var data = $(this, ":selected").val();
            if (data == "all" || data == "3") {
                $('#dis').addClass('hide');

            } else if (data == "1") {
                $('#dis').removeClass('hide');

            }
        });



//        jQuery('html body').on('click', '#bookinglist tbody tr', function(){        
//            alert('click');
//        });
//                
//        jQuery('html body').on('dblclick', '#bookinglist tbody tr', function(){        
//            alert('dblclick');
//        });

//        var DELAY = 100, clicks = 0, timer = null;
//
//        jQuery(function(){
//
//            jQuery("html body").on("click", "#bookinglist tbody tr", function(e){
//                //jQuery("#bookinglist tbody tr").removeClass('select');
//                jQuery(this).toggleClass('select');
//                var go_to_url = $(this).find("td a").attr('href');  
//                
//                //this will redirect us in same window
//                clicks++;
//                if(clicks === 1) {
//                    timer = setTimeout(function() {
//                
//                        clicks = 0;           
//                    }, DELAY);
//                } else {
//                    clearTimeout(timer);                                        
//                    document.location.href = go_to_url;
//                    clicks = 0;             
//                }
//            })
//            .on("dblclick", function(e){
//                e.preventDefault();
//            });
//
//        });
//        
//        jQuery("html body").on("click", "#bookinglist tbody tr.select", function(e){
//            jQuery(this).addClass('select');
//            var go_to_url = $(this).find("td a").attr('href');  
//            document.location.href = go_to_url;
//        });

//        var device = navigator.userAgent.toLowerCase();
//        var ios = device.match(/(iphone|ipod|ipad)/);



        jQuery("html body").on("click", "#bookinglist tbody tr", function (e) {
            var evt = e || window.event
            if (jQuery(this).hasClass('select')) {
                jQuery(this).find('.checkbox_val').prop('checked', false);
                jQuery(this).removeClass('select');
                jQuery(this).removeClass('lasttr');
                jQuery(this).removeClass('select');
                var itm = 0;
                jQuery('#bookinglist tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        // jQuery('.dataTables_info').find('span.select-itm').text('');
                        var len = jQuery('#bookinglist').find('tr.select').length;
                        if(len  > 0 ){
                            jQuery('.dataTables_info').find('span.select-itm').text(len + ' selected');
                        }else{
                            jQuery('.dataTables_info').find('span.select-itm').text('');
                        }
                    }
                });
            } else {
                if (evt.ctrlKey) {

                } else {
                    //jQuery('#bookinglist tbody tr.select').find('.checkbox_val').prop('checked', false);
                    //jQuery('#bookinglist tbody tr.select').removeClass('select');
                }

                jQuery(this).addClass('select');
                jQuery('#bookinglist tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).addClass('lasttr');
                var itm = 0;
                jQuery('#bookinglist tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    }
                });
            }

            if (jQuery(this).hasClass('select')) {
                jQuery(this).find('.checkbox_val').prop('checked', true);
            } else {
                jQuery(this).find('.checkbox_val').prop('checked', false);
            }
        });



        jQuery("html body").on("dblclick", "#bookinglist tbody tr", function (e) {
            var go_to_url = $(this).find("td a").attr('href');
            document.location.href = go_to_url;
        });


        var wd = $(window).width();
        if (wd < 992) {
            setTimeout(function () {
//                var aaa = $('.dataTables_scrollHeadInner').innerWidth();
//                alert(aaa);
                $('.table-scroll').css('min-width', aaa);
            }, 1000);

        }
        if (wd > 767) {
            jQuery("html body").on("click", "#bookinglist tbody tr td a", function (e) {
                e.preventDefault();
            });
        }

        if (wd < 1200) {
            setTimeout(function () {
                jQuery("#dtBox2").DateTimePicker({
                    dateFormat: "yyyy-MM-dd",
                });
            }, 1500);

        }
        if (wd < 768) {
            jQuery('select').selectpicker();
            jQuery('#state').selectpicker();
            setTimeout(function () {
                jQuery("#dtBox").DateTimePicker({
                    dateFormat: "yyyy-MM-dd",
                });
            }, 1000);

            jQuery("#quoteBox").DateTimePicker({
                dateFormat: "yyyy-MM-dd",
            });
            jQuery('html, body').on('change', '.mobdate', function () {
                var td = jQuery(this).val();
                jQuery('#en_servicedate').val(td);
            });
            jQuery('html, body').on('change', '.quotedate', function () {
                var td = jQuery(this).val();
                jQuery('#en_date').val(td);
            });
        }

        var count = 0;
        jQuery(document).on('keydown', function (e) {
            // You may replace `c` with whatever key you want

            if ((e.metaKey || e.ctrlKey) && e.keyCode == 40) {
                if (jQuery('#bookinglist tbody tr:last').hasClass('select')) {
                    jQuery('#bookinglist tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#bookinglist tbody tr:last').addClass('lasttr');
                } else {
                    jQuery('#bookinglist tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#bookinglist tbody tr.select:last').next('tr').addClass('select lasttr');
                    jQuery('#bookinglist tbody tr.select:last').find('.checkbox_val').prop('checked', 'true');
                    jQuery('.dataTables_scrollBody').animate({
                        scrollTop: count
                    }, 200)
                    var trht = jQuery('#bookinglist tbody tr.select').innerHeight();
                    count += trht;
                    var itm = 0;
                    jQuery('#bookinglist tbody tr').each(function () {
                        if (jQuery(this).hasClass('select')) {
                            itm += 1;
                            if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                                jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                            } else {
                                jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                            }
                        }
                    });
                }

            } else if ((e.metaKey || e.ctrlKey) && e.keyCode == 38) {
                var trht = jQuery('#bookinglist tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#bookinglist tbody tr.lasttr').prev('tr').addClass('select lasttr');
                jQuery('#bookinglist tbody tr.lasttr').find('.checkbox_val').prop('checked', 'true');
                jQuery('#bookinglist tbody tr.lasttr').next('tr.lasttr').removeClass('lasttr');
                jQuery('.dataTables_scrollBody').animate({
                    scrollTop: count
                }, 200)
                var itm = 0;
                jQuery('#bookinglist tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    }
                });

            } else if ((e.shiftKey) && e.keyCode == 40) {
                var trht = jQuery('#bookinglistt tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#bookinglist tbody tr.lasttr').prev('tr').addClass('lasttr');
                jQuery('#bookinglist tbody tr.select:last').find('.checkbox_val').prop('checked', false);
                jQuery('#bookinglist tbody tr.select:last').removeClass('select lasttr');
                jQuery('.dataTables_scrollBody').animate({
                    scrollTop: count
                }, 200)
                var itm = 0;
                jQuery('#bookinglist tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            itm -= 1;
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                    }
                });

            } else if ((e.shiftKey) && e.keyCode == 38) {
                jQuery('#bookinglist tbody tr.lasttr').removeClass('lasttr');
                jQuery('#bookinglist tbody tr.select:first').find('.checkbox_val').prop('checked', false);
                jQuery('#bookinglist tbody tr.select:first').removeClass('select lasttr');
                var trht = jQuery('#bookinglist tbody tr.select').innerHeight();
                count -= trht;
                jQuery('.dataTables_scrollBody').animate({
                    scrollTop: count
                }, 200);

                var itm = 0;
                jQuery('#bookinglist tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                    }
                });
            }
        });






//        if (!(ios)) {
//
//        } else {
//        jQuery("html body").on("click", "#bookinglist tbody tr", function(){
//        
//            //alert('sss');
//            test(jQuery(this));
//        });




//        function test(ele){
//            var tapped=false
//            jQuery(ele).on("touchstart",function(e){
//                if(!tapped){ //if tap is not set, set up single tap
//                  tapped=setTimeout(function(){
//                      tapped=null
//                      
//                      if (jQuery(ele).hasClass('select')) {
//                            jQuery(ele).removeClass('select');
//                            jQuery(ele).find('.checkbox_val').prop('checked', true);
//                        } else {
//                            jQuery('#bookinglist tbody tr.select').removeClass('select');
//                            jQuery(ele).addClass('select');
//                            jQuery(ele).find('.checkbox_val').prop('checked', false);
//                        }
//                  },300);   //wait 300ms then run single click code
//                } else {    //tapped within 300ms of last tap. double tap
//                  clearTimeout(tapped); //stop single tap callback
//                  tapped=null
//                  
//                  var go_to_url = jQuery(ele).find("td a").attr('href');
//                  //alert(go_to_url);
//                  document.location.href = go_to_url;
//                }
//                e.preventDefault()
//            });
//        }


    });





</script>