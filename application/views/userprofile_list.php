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
                <div class="page-bar">
<!--                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>User Profile List</span>
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
                            <span>User Profile List</span>
                        </li>
                    </ul>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-4 w-100">
                        <h4 class="peoples-page-title res-float-left"><i class="fa fa-users" style="display: unset"></i>&nbsp;User Profile List</h4>
                        <div class="peop-btn-right">
                            <div class="people-toggle">
                                <span></span>
                            </div>
                        </div>
                    </div>                    

                    <div class="col-md-2 col-xs-12 col-sm-8 pad-right0 people-right">                           
                        <ul class="nav navbar-nav people-nav">
                            <li>
                                <a href="<?php echo base_url("userprofile/newUserprofile"); ?>" ><i class="fa fa-plus-circle"></i> New </a>
                            </li>
<!--                            <li>
                                <a href="#" class="edit-people" id="deleteprofilelist"><i class="fa fa-trash-o"></i> Delete </a>
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
<!--                                <div class="filter-toggle">
                                    <button type="button" class="btn dark btn-outline sbold uppercase filter-btn">Filter</button>
                                </div>-->
                                <div class="table-scroll">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase"> User Profile</span>
                                        </div>                                              
                                    </div>
<!--                                    <div class="filter-wrapper">
                                        <span class="filter-close">&#x2716;</span>
                                        <div class="alphabet">Search : 
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
                                    <div class="filter-overlay"></div>

                                    <div class="portlet-body userprofile-table">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="userprofile">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="select_all_profile" name="select_all_profile"></th>
                                                    <th>Admin First Name</th>
                                                    <th>Admin Last Name</th>
                                                    <th>Username</th>
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
     jQuery(document).ready(function(){
    
     jQuery('#userprofile').bind('touchend', function (event) {
            
            var pas = event.target.parentElement.innerHTML;            
            var go_url = jQuery(pas).find('.userlink').attr('href');
                        
            var now = new Date().getTime();
            var lastTouch = jQuery(this).data('lastTouch') || now + 1
            var delta = now - lastTouch;
            if (delta < 500 && delta > 0) {                            
                jQuery('#userprofile tbody tr.select').find('.checkbox_val').prop('checked', false);    
                jQuery('#userprofile tbody tr.select').removeClass('select');
                jQuery('#userprofile tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).parent().addClass('select lasttr');
                document.location.href = go_url;           
            } else {                
                
            }
            jQuery(this).data('lastTouch', now);
        });
    
    var wd = $(window).width();
        if (wd > 768) {
            jQuery("html body").on("click", "#userprofile tbody tr td a", function (e) {
                e.preventDefault();
            });
        }
    
    
    
    jQuery("html body").on("click", "#userprofile tbody tr", function(e){
        
        var evt = e || window.event
            if (jQuery(this).hasClass('select')) {
                jQuery(this).find('.checkbox_val').prop('checked', false);
                jQuery(this).removeClass('select');
                jQuery(this).removeClass('lasttr');
                jQuery(this).removeClass('select');
                var itm = 0;
                jQuery('#userprofile tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        // jQuery('.dataTables_info').find('span.select-itm').text('');
                        var len = jQuery('#userprofile').find('tr.select').length;
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
                   // jQuery('#userprofile tbody tr.select').find('.checkbox_val').prop('checked', false);
                    //jQuery('#userprofile tbody tr.select').removeClass('select');
                }

                jQuery(this).addClass('select');
                jQuery('#userprofile tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).addClass('lasttr');
                var itm = 0;
                jQuery('#userprofile tbody tr').each(function () {
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
        
        if(jQuery(this).hasClass('select')){
            jQuery(this).find('.checkbox_val').prop('checked',true);
        } else {
            jQuery(this).find('.checkbox_val').prop('checked',false);
        }
    });


    jQuery("html body").on("dblclick", "#userprofile tbody tr", function(e){
         var go_to_url = $(this).find("td a").attr('href');  
         document.location.href = go_to_url;
    });
    
    var count = 0;
    jQuery(document).on('keydown', function (e) {
        // You may replace `c` with whatever key you want

        if ((e.metaKey || e.ctrlKey) && e.keyCode == 40) {
                if (jQuery('#userprofile tbody tr:last').hasClass('select')) {
                    jQuery('#userprofile tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#userprofile tbody tr:last').addClass('lasttr');
                } else {
                    jQuery('#userprofile tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#userprofile tbody tr.select:last').next('tr').addClass('select lasttr');
                    jQuery('#userprofile tbody tr.select:last').find('.checkbox_val').prop('checked', 'true');
                                                            
                    var trh = 0;
                    jQuery('#userprofile tbody tr').each(function (i) {
                        var thh = jQuery(this).innerHeight();
                        trh = trh + thh;
                        if(jQuery(this).hasClass('lasttr')){
                            trh = trh - 200;                            
                    jQuery('.dataTables_scrollBody').animate({
                                scrollTop: trh
                            }, 00);
                        }
                    });
                    var trht = jQuery('#userprofile tbody tr.select').innerHeight();
                    count += trht;
                    var itm = 0;
                    jQuery('#userprofile tbody tr').each(function () {
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
                var trht = jQuery('#userprofile tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#userprofile tbody tr.lasttr').removeClass('lasttr');
                jQuery('#userprofile tbody tr.select:first').prev('tr').addClass('select lasttr');
                jQuery('#userprofile tbody tr.lasttr').find('.checkbox_val').prop('checked', 'true');
                
                var trh = 0;
                jQuery('#userprofile tbody tr').each(function (i) {
                    var thh = jQuery(this).innerHeight();
                    trh = trh + thh;                   
                    if(jQuery(this).hasClass('lasttr')){
                        trh = trh - 200;                        
                jQuery('.dataTables_scrollBody').animate({
                            scrollTop: trh
                        }, 00);
                    }
                });
                var itm = 0;
                jQuery('#userprofile tbody tr').each(function () {
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
            else if ((e.shiftKey) && e.keyCode == 40) {            
               var trht = jQuery('#userprofile tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#userprofile tbody tr.select:last').find('.checkbox_val').prop('checked', false);
                jQuery('#userprofile tbody tr.select:last').removeClass('select lasttr');                
                jQuery('#userprofile tbody tr.select.lasttr').removeClass('lasttr');                
                jQuery('#userprofile tbody tr.select:last').addClass('lasttr');    
                
                var trh = 0;
                jQuery('#userprofile tbody tr').each(function (i) {
                    var thh = jQuery(this).innerHeight();
                    trh = trh + thh;                    
                    if(jQuery(this).hasClass('lasttr')){
                        trh = trh - 200;                        
                jQuery('.dataTables_scrollBody').animate({
                            scrollTop: trh
                        }, 00);
                    }
                });
                var itm = 0;
                jQuery('#userprofile tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            itm -= 1;
                            jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    }   else {
                        jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                    }
                });

            }  else if ((e.shiftKey) && e.keyCode == 38) {        
                    jQuery('#userprofile tbody tr.select:first').find('.checkbox_val').prop('checked', false);
                    jQuery('#userprofile tbody tr.select.lasttr').removeClass('lasttr');                    
                    jQuery('#userprofile tbody tr.select:first').removeClass('select');                    
                    jQuery('#userprofile tbody tr.select:first').addClass('lasttr');                       
                    
                    var trht = jQuery('#userprofile tbody tr.select').innerHeight();
                    count -= trht;
                    var trh = 0;
                    jQuery('#userprofile tbody tr').each(function (i) {
                        var thh = jQuery(this).innerHeight();
                        trh = trh + thh;                   
                        if(jQuery(this).hasClass('lasttr')){
                            trh = trh - 200;                            
                    jQuery('.dataTables_scrollBody').animate({
                                scrollTop: trh
                            }, 00);
                        }
                    });
                    
                    var itm = 0;
                    jQuery('#userprofile tbody tr').each(function () {
                        if (jQuery(this).hasClass('select')) {                            
                            itm += 1;
                            if (jQuery('.dataTables_info').find('span').hasClass('select-itm')) {
                                jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                            } else {                                
                                jQuery('.dataTables_info').append('<span class="select-itm">' + itm + '  selected</span>');
                           }
                        }  else {
                            jQuery('.dataTables_info').find('span.select-itm').text(itm + ' selected');
                        }
                    });
            }
    });
    
    });
    
</script>
