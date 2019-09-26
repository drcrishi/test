<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$flashsuccessID = "falsemsg";
$flashsuccess = "";
if ($this->session->flashdata('flashSuccess')) {
    $flashsuccess = $this->session->flashdata('flashSuccess');
    $flashsuccessID = "truemsg";
}
//$sessionId = $this->session->userdata('admin_id');
?>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
       <?php $this->load->view("template/userleftmenu"); ?>
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
                    <!--<div class="page-bar col-md-2 col-xs-12 col-sm-2 people-left listtit-table" style="margin-left: 0; margin-top: 0px;">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                            </li>
                            <li>
                                <i class="fa fa-circle" style="margin: 5px 5px !important;"></i>
                                <span>Booking List</span>
                            </li>
                        </ul>
                    </div>-->
                    <div class="col-md-2 col-xs-12 col-sm-2 people-left listtit-table porttit-select">
                        <div class="enquiry-select">
                            <i class="fa fa-newspaper-o"></i>
                            <!-- <lable class="form-control" style="font-size:16px;font-weight:bold;margin-top:10px;">Current Bookings</lable> -->
                            <select class="form-control selectbooking" id="driverView_booking">
                                <option value="all">All Bookings</option>
                                <option value="1" selected>Current Bookings</option>
                                <option value="3">Completed Bookings</option>
                            </select>
                        </div>
                        <div class="peop-btn-right">
                            <div class="people-toggle">
                                <span></span>
                            </div>
<!--                            <div class="filter-toggle">
                                <button type="button" class="btn dark btn-outline sbold uppercase filter-btn">Filter</button>
                            </div>-->
                        </div>
                    </div>        


                    <div class="col-md-10 col-xs-12 col-sm-10 pad-right0 people-right">                           
                        <ul class="nav navbar-nav people-nav">
                           <li>
                                <div class="chat-form" style="margin-top:0 !important;">
                                    <div class="input-cont">
                                        <input class="form-control" placeholder="Search Client..." type="text" id="userfullname" name="userfullname"> </div>
                                    <div class="btn-cont">
                                        <span class="arrow"> </span>
                                        <button class="btn blue icn-only userbookingsearch"><i class="fa fa-search icon-white"></i></button>
                                    </div>
                                </div>
                            </li>
<!--                            <li>
                                <a href="javascript:void(0)" class="search-toggle" ><i class="fa fa-search"></i> Search</a>
                            </li>-->
                        </ul>
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
                                                <label class="control-label xs-remove">First Name</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" id="first_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label xs-remove">Last Name</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-inline" id="last_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label xs-remove">Service Date</label>
                                                <div class="form-group">												
                                                    <input class="form-control form-control-inline date-picker" id="en_servicedate" name="en_servicedate" size="16" type="text" value="" />
                                                    <input type="text" class="mobdate" data-field="date" readonly name="mobdate" placeholder="Service Date">
                                                    <div id="dtBox"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <label class="control-label">Job Type :</label>
                                                <div class="form-group">
                                                    <select class="form-control" id="movetype_name" name="en_movetype">
                                                        <option value=""></option>
                                                        <option value="1">Home</option>
                                                        <option value="2">Office</option>
                                                        <option value="4">Packing/Unpacking</option>
                                                        <option value="6">Storage</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-xs-12 ">
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
<!--                                            <div class="col-sm-3 col-xs-12">
                                                <label class="control-label xs-remove">&nbsp;</label>
                                                <div class="form-group">												
                                                    <input class="form-control form-control-inline date-picker" placeholder="Quote Received" id="en_date" name="en_date" size="16" type="text" value="" />
                                                    <input type="text" class="quotedate" data-field="date" readonly name="mobdate" placeholder="Quote Received">
                                                    <div id="quoteBox"></div>
                                                </div>
                                            </div>-->
                                            
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
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="userbookinglist">
                                            <thead>
                                                <tr>
                                                    <th class="select_all_booking"><input type="checkbox" id="select_all_booking"></th>
                                                    <th>Service Date</th>
                                                    <th>Status</th>
                                                    <th>Service Time</th>
                                                    <th>Client</th>
                                                    <th>State</th>
                                                    <th>Moving From</th>											
                                                    <th>Moving To</th>
                                                    <th>Job Type</th>
                                                    <th>Jobsheet</th>
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

//        jQuery("html body").on("click", "#userbookinglist tbody tr", function (e) {
//            var evt = e || window.event
//            if (jQuery(this).hasClass('select')) {
//                jQuery(this).find('.checkbox_val').prop('checked', false);
//                jQuery(this).removeClass('select');
//                jQuery(this).removeClass('lasttr');
//                jQuery(this).removeClass('select');
//                var itm = 0;
//                jQuery('#userbookinglist tbody tr').each(function () {
//                    if (jQuery(this).hasClass('select')) {
//                        itm += 1;
//                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
//                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
//                        } else {
//                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
//                        }
//                    } else {
//                        jQuery('.dataTables_info').find('span.select-itm').text('');
//                    }
//                });
//            } else {
//                if (evt.ctrlKey) {
//
//                } else {
//                    //jQuery('#userbookinglist tbody tr.select').find('.checkbox_val').prop('checked', false);
//                    //jQuery('#userbookinglist tbody tr.select').removeClass('select');
//                }
//
//                jQuery(this).addClass('select');
//                jQuery('#userbookinglist tbody tr.lasttr').removeClass('lasttr');
//                jQuery(this).addClass('lasttr');
//                var itm = 0;
//                jQuery('#userbookinglist tbody tr').each(function () {
//                    if (jQuery(this).hasClass('select')) {
//                        itm += 1;
//                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
//                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
//                        } else {
//                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
//                        }
//                    }
//                });
//            }
//
//            if (jQuery(this).hasClass('select')) {
//                jQuery(this).find('.checkbox_val').prop('checked', true);
//            } else {
//                jQuery(this).find('.checkbox_val').prop('checked', false);
//            }
//        });
//
//
//
//        jQuery("html body").on("dblclick", "#userbookinglist tbody tr", function (e) {
//            var go_to_url = $(this).find("td a").attr('href');
//            document.location.href = go_to_url;
//        });


        var wd = $(window).width();
        if (wd < 992) {
            setTimeout(function () {
//                var aaa = $('.dataTables_scrollHeadInner').innerWidth();
//                alert(aaa);
                // $('.table-scroll').css('min-width', aaa);
            }, 1000);

        }
        if (wd > 767) {
            jQuery("html body").on("click", "#userbookinglist tbody tr td a", function (e) {
                e.preventDefault();
            });
        }

        if (wd < 768) {
            jQuery('select').selectpicker();
            jQuery('#state').selectpicker();
            jQuery("#dtBox").DateTimePicker({
                dateFormat: "yyyy-MM-dd",
            });
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
                if (jQuery('#userbookinglist tbody tr:last').hasClass('select')) {
                    jQuery('#userbookinglist tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#userbookinglist tbody tr:last').addClass('lasttr');
                } else {
                    jQuery('#userbookinglist tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#userbookinglist tbody tr.select:last').next('tr').addClass('select lasttr');
                    jQuery('#userbookinglist tbody tr.select:last').find('.checkbox_val').prop('checked', 'true');
                    jQuery('.dataTables_scrollBody').animate({
                        scrollTop: count
                    }, 200)
                    var trht = jQuery('#userbookinglist tbody tr.select').innerHeight();
                    count += trht;
                    var itm = 0;
                    jQuery('#userbookinglist tbody tr').each(function () {
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
                var trht = jQuery('#userbookinglist tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#userbookinglist tbody tr.lasttr').prev('tr').addClass('select lasttr');
                jQuery('#userbookinglist tbody tr.lasttr').find('.checkbox_val').prop('checked', 'true');
                jQuery('#userbookinglist tbody tr.lasttr').next('tr.lasttr').removeClass('lasttr');
                jQuery('.dataTables_scrollBody').animate({
                    scrollTop: count
                }, 200)
                var itm = 0;
                jQuery('#userbookinglist tbody tr').each(function () {
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
                var trht = jQuery('#userbookinglistt tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#userbookinglist tbody tr.lasttr').prev('tr').addClass('lasttr');
                jQuery('#userbookinglist tbody tr.select:last').find('.checkbox_val').prop('checked', false);
                jQuery('#userbookinglist tbody tr.select:last').removeClass('select lasttr');
                jQuery('.dataTables_scrollBody').animate({
                    scrollTop: count
                }, 200)
                var itm = 0;
                jQuery('#userbookinglist tbody tr').each(function () {
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
                jQuery('#userbookinglist tbody tr.lasttr').removeClass('lasttr');
                jQuery('#userbookinglist tbody tr.select:first').find('.checkbox_val').prop('checked', false);
                jQuery('#userbookinglist tbody tr.select:first').removeClass('select lasttr');
                var trht = jQuery('#userbookinglist tbody tr.select').innerHeight();
                count -= trht;
                jQuery('.dataTables_scrollBody').animate({
                    scrollTop: count
                }, 200);

                var itm = 0;
                jQuery('#userbookinglist tbody tr').each(function () {
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
    });

</script>