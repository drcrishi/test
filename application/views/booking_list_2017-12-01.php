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
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Booking List</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->

                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row peoles-nav-border people-wrapper">
                    <div class="col-md-2 col-xs-12 col-sm-2 people-left listtit-table">
                        <div class="enquiry-select">
                            <i class="fa fa-newspaper-o"></i>
                            <select class="form-control selectbooking" id="view_booking">
                                <option value="all">All</option>
                                <option value="1" selected>Current Bookings</option>
                                <option value="3">Inactive Bookings</option>
                            </select>
                        </div>
<!--                        <h4 class="peoples-page-title"><i class="fa fa-users" style="display: unset"></i>&nbsp;Booking List</h4>
<div class="people-toggle">
<span></span>
</div>-->
                    </div>                    

                    <div class="col-md-10 col-xs-12 col-sm-10 pad-right0 people-right">                           
                        <ul class="nav navbar-nav people-nav">
                            <li>
                                <a href="javascript:void(0)" class="search-toggle" ><i class="fa fa-search"></i> Search</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("booking/newBooking"); ?>" ><i class="fa fa-plus-circle"></i> New </a>
                            </li>
                            <li>
                                <a href="#" class="edit-people" id="deleteBookinglist"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>
                            <li>
                                <a href="#" id="duplicateBookingform" class="edit-people"><i class="fa fa-clipboard" aria-hidden="true"></i> Duplicate </a>
                            </li>
                            <li id="dis">
                                <a href="#" id="disqualifiedBooking" class="edit-people"><i class="fa fa-ban" aria-hidden="true"></i> Deactivate </a>
                            </li>
                            <!--                            <li>
                                                            <a href="<?php echo base_url("bookinglist/bookingExport"); ?>"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export To Excel </a>
                                                        </li>
                                                        <li>
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
                                    <?php //if ($this->session->flashdata('flashSuccess')):  ?>
                                    <p class='flashMsg hide  flashSuccess' id="<?php echo $flashsuccessID; ?>"> <?php echo $flashsuccess; ?> </p>
                                    <?php //endif  ?>
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
                                <div class="filter-toggle">
                                    <button type="button" class="btn dark btn-outline sbold uppercase filter-btn">Filter</button>
                                </div>
                                <div class="table-scroll booking-table">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase">Your Bookings</span>
                                        </div>  
                                        <div class="col-sm-6 col-xs-8 enquiry-drop">                                    

                                        </div>

                                    </div>
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
                                                <div class="form-group">
                                                    <label class="control-label">State:</label>
                                                    <select class="form-control" id="state">
                                                        <option value=""></option>
                                                        <?php
                                                        foreach ($statedata as $st) {
                                                            ?> <option value="<?php echo $st['State']; ?>"><?php echo $st['State']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label xs-remove">&nbsp;</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" placeholder="First Name" id="first_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label xs-remove">&nbsp;</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" placeholder="Last Name" id="last_name">
                                                </div>
                                            </div>
                                            <!--                                            <div class="col-sm-3 col-xs-12">
                                                                                            <div class="form-group">
                                                                                                <input type="text" class="form-control form-control-inline" placeholder="State" id="state">
                                                                                            </div>
                                                                                        </div>-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <label class="control-label">Move Type :</label>
                                                <div class="form-group">
                                                    <select class="form-control" id="movetype_name" name="en_movetype">
                                                        <option value=""></option>
                                                        <?php foreach ($move_type as $mt) { ?>
                                                            <option value="<?php echo $mt['movetype_id']; ?>"><?php echo $mt['movetype_name']; ?></option>
                                                        <?php }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label xs-remove">&nbsp;</label>
                                                <div class="form-group">												
                                                    <input class="form-control form-control-inline date-picker" placeholder="Quote Received" id="en_date" name="en_date" size="16" type="text" value="" />
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label xs-remove">&nbsp;</label>
                                                <div class="form-group">												
                                                    <input class="form-control form-control-inline date-picker" placeholder="Service Date" id="en_servicedate" name="en_servicedate" size="16" type="text" value="" />
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
                                                    <th>Service Date</th>
                                                    <th>Service Time</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
<!--                                                    <th>Phone</th>-->
                                                    <th>State</th>											
                                                    <th>Move Type</th>
                                                    <!--<th>Is Deposited?</th>-->
                                                    <th>Removalist/Packers</th>
                                                    <th>Booking Status</th>
                                                    <!--<th>Action</th>-->
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
<script>
    jQuery(document).ready(function () {
        jQuery('.search-toggle').click(function () {
            jQuery('.filter-wrapper').slideToggle();
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

        jQuery("html body").on("click", "#bookinglist tbody tr", function (e) {
            if(jQuery(this).hasClass('select')){
               jQuery('#bookinglist tbody tr.select').find('.checkbox_val').prop('checked', false); 
               jQuery('#bookinglist tbody tr.select').removeClass('select');               
               jQuery(this).removeClass('select'); 
               var itm = 0;
                jQuery('#bookinglist tbody tr').each(function(){
                    if(jQuery(this).hasClass('select')){
                       itm += 1;                                                                  
                       if(jQuery('.dataTables_info').find('span').hasClass('select-itm')){                                                   
                           jQuery('.dataTables_info').find('span.select-itm').text(itm+ ' selected');
                       } else {                                                 
                           jQuery('.dataTables_info').append('<span class="select-itm">'+itm+'  selected</span>');
                       }
                    } else {
                        jQuery('.dataTables_info').find('span.select-itm').text('');
                    }
                });
            } else {   
                if (window.event.ctrlKey) {
                    
                } else {
                    jQuery('#bookinglist tbody tr.select').find('.checkbox_val').prop('checked', false);
                    jQuery('#bookinglist tbody tr.select').removeClass('select');               
                }
               
               jQuery(this).addClass('select');  
               var itm = 0;
                jQuery('#bookinglist tbody tr').each(function(){
                    if(jQuery(this).hasClass('select')){
                       itm += 1;                                                                  
                       if(jQuery('.dataTables_info').find('span').hasClass('select-itm')){                                                   
                           jQuery('.dataTables_info').find('span.select-itm').text(itm+ ' selected');
                       } else {                                                 
                           jQuery('.dataTables_info').append('<span class="select-itm">'+itm+'  selected</span>');
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

        var count = 0;
        jQuery(document).on('keydown', function (e) {
            // You may replace `c` with whatever key you want

            if ((e.metaKey || e.ctrlKey) && e.keyCode == 40) {
                jQuery('#bookinglist tbody tr.select:last').next('tr').addClass('select');
                jQuery('#bookinglist tbody tr.select:last').find('.checkbox_val').prop('checked', 'true');
                jQuery('.dataTables_scrollBody').animate({
                    scrollTop: count
                }, 200)
                var trht = jQuery('#bookinglist tbody tr.select').innerHeight();
                count += trht;
               var itm = 0;
               jQuery('#bookinglist tbody tr').each(function(){
                   if(jQuery(this).hasClass('select')){
                      itm += 1;                                                                  
                      if(jQuery('.dataTables_info').find('span').hasClass('select-itm')){                                                   
                          jQuery('.dataTables_info').find('span.select-itm').text(itm+ ' selected');
                      } else {                                                 
                          jQuery('.dataTables_info').append('<span class="select-itm">'+itm+'  selected</span>');
                      }
                   }
               });

            } else if((e.metaKey || e.ctrlKey) && e.keyCode == 38) {
                var trht = jQuery('#bookinglist tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#bookinglist tbody tr.select:first').prev('tr').addClass('select');
                jQuery('#bookinglist tbody tr.select:first').find('.checkbox_val').prop('checked', 'true');
                jQuery('.dataTables_scrollBody').animate({
                    scrollTop: count
                }, 200)
                var itm = 0;
                jQuery('#bookinglist tbody tr').each(function(){
                    if(jQuery(this).hasClass('select')){
                       itm += 1;                                                                  
                       if(jQuery('.dataTables_info').find('span').hasClass('select-itm')){                                                   
                           jQuery('.dataTables_info').find('span.select-itm').text(itm+ ' selected');
                       } else {                                                 
                           jQuery('.dataTables_info').append('<span class="select-itm">'+itm+'  selected</span>');
                       }
                    }
                }); 
                
            }
        });



    });





</script>