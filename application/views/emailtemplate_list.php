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
                <div class="page-bar">
<!--                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Email template</span>
                        </li>
                    </ul>-->
                </div>
                <div class="row peoles-nav-border people-wrapper">
                     <div class="page-bar col-md-2 col-xs-12 col-sm-2 people-left listtit-table" style="margin-left: 0; margin-top: 0px;">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                        </li>
                        <li>
                            <i class="fa fa-circle" style="margin: 5px 5px !important;"></i>
                            <span>Email templates</span>
                        </li>
                    </ul>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-2 w-100">
                        <h4 class="peoples-page-title res-float-left"><i class="fa fa-users" style="display: unset"></i>&nbsp;Email Templates</h4>
                        <div class="peop-btn-right">
                            <div class="people-toggle">
                                <span></span>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-2 col-xs-12 col-sm-10 pad-right0 people-right">                           
                        <ul class="nav navbar-nav people-nav">
                            <li>
                                <a href="<?php echo base_url('emailtemplate/new'); ?>"><i class="fa fa-plus-circle"></i> New </a>
                            </li>
<!--                            <li>
                                <a href="#" class="saveData"><i class="fa fa-save"></i> Save </a>
                            </li>
                            <li>
                                <a href="#"  class="deleteData" data-id="<?php echo $form_data[0]['email_master_id'] ?>"><i class="fa fa-trash-o"></i> Delete </a>
                            </li>-->
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered table-div">
                            <div class="table-wrapper">
                                <div class="table-scroll email-table">
                                    <div class="portlet-title">
                                        <div class="caption font-dark">
                                            <i class="icon-settings font-dark"></i>
                                            <span class="caption-subject bold uppercase"> Your Emails</span>
                                        </div>                                  
                                    </div>

                                    <div class="portlet-body contactlist-table">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="emailtemplatelist">
                                            <thead>
                                                <tr>
                                                    <th>Move Type</th>                                                    
                                                    <th>Template Name</th>											
                                                    <th>Email Subject</th>											                                             									
<!--                                                    <th>Disabled</th>											-->
                                                    <th>Date</th>											
                                                </tr>
                                            </thead>																	
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->

    </div>
    <!-- END CONTAINER -->
    <div class="quick-nav-overlay"></div>
    
    <script>
        jQuery(document).ready(function(){
            
        
        jQuery('#emailtemplatelist').bind('touchend', function (event) {
            
            var pas = event.target.parentElement.innerHTML;            
            var go_url = jQuery(pas).find('.emaillink').attr('href');
                        
            var now = new Date().getTime();
            var lastTouch = jQuery(this).data('lastTouch') || now + 1
            var delta = now - lastTouch;
            if (delta < 500 && delta > 0) {                            
                jQuery('#emailtemplatelist tbody tr.select').find('.checkbox_val').prop('checked', false);    
                jQuery('#emailtemplatelist tbody tr.select').removeClass('select');
                jQuery('#emailtemplatelist tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).parent().addClass('select lasttr');
                document.location.href = go_url;           
            } else {                
                
            }
            jQuery(this).data('lastTouch', now);
        });
        
            
        var wd = $(window).width();
        if (wd > 768) {
            jQuery("html body").on("click", "#emailtemplatelist tbody tr td a", function (e) {
                e.preventDefault();
            });
        }
            
            
            jQuery("html body").on("click", "#emailtemplatelist tbody tr", function(e){
                var evt = e || window.event
            if(jQuery(this).hasClass('select')){               
               jQuery(this).removeClass('select'); 
               jQuery(this).removeClass('lasttr');
               jQuery(this).removeClass('select'); 
               var itm = 0;
                jQuery('#emailtemplatelist tbody tr').each(function(){
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
                if (evt.ctrlKey) {
                    
                } else {                    
                    //jQuery('#emailtemplatelist tbody tr.select').removeClass('select');               
                }
               
               jQuery(this).addClass('select');  
               jQuery('#emailtemplatelist tbody tr.lasttr').removeClass('lasttr');
               jQuery(this).addClass('lasttr');
               var itm = 0;
                jQuery('#contactlist tbody tr').each(function(){
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

            jQuery("html body").on("dblclick", "#emailtemplatelist tbody tr", function(e){
                 var go_to_url = $(this).find("td a").attr('href');  
                 document.location.href = go_to_url;
            });
            
            var count = 50;
            jQuery(document).on('keydown', function (e) {
                // You may replace `c` with whatever key you want
                
                if ((e.metaKey || e.ctrlKey) && e.keyCode == 40) {
                if(jQuery('#emailtemplatelist tbody tr:last').hasClass('select')){    
                    jQuery('#emailtemplatelist tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#emailtemplatelist tbody tr:last').addClass('lasttr');
                } else {
                    jQuery('#emailtemplatelist tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#emailtemplatelist tbody tr.select:last').next('tr').addClass('select lasttr');
                    jQuery('#emailtemplatelist tbody tr.select:last').find('.checkbox_val').prop('checked', 'true');
                    
                    var trh = 0;
                    jQuery('#emailtemplatelist tbody tr').each(function (i) {
                        var thh = jQuery(this).innerHeight();
                        trh = trh + thh;
                        if(jQuery(this).hasClass('lasttr')){
                            trh = trh - 200;                            
                    jQuery('.dataTables_scrollBody').animate({
                                scrollTop: trh
                            }, 00);
                        }
                    });
                    var trht = jQuery('#emailtemplatelist tbody tr.select').innerHeight();
                    count += trht;
                   var itm = 0;
                   jQuery('#emailtemplatelist tbody tr').each(function(){
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

            } else if((e.metaKey || e.ctrlKey) && e.keyCode == 38) {
                var trht = jQuery('#emailtemplatelist tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#emailtemplatelist tbody tr.lasttr').removeClass('lasttr');
                jQuery('#emailtemplatelist tbody tr.select:first').prev('tr').addClass('select lasttr');
                                               
                var trh = 0;
                jQuery('#emailtemplatelist tbody tr').each(function (i) {
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
                jQuery('#emailtemplatelist tbody tr').each(function(){
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
             else if ((e.shiftKey) && e.keyCode == 40) {            
               var trht = jQuery('#emailtemplatelist tbody tr.select').innerHeight();
                count -= trht;
                
                jQuery('#emailtemplatelist tbody tr.select:last').removeClass('select lasttr');                
                jQuery('#emailtemplatelist tbody tr.select.lasttr').removeClass('lasttr');                
                jQuery('#emailtemplatelist tbody tr.select:last').addClass('lasttr');    
                
                var trh = 0;
                jQuery('#emailtemplatelist tbody tr').each(function (i) {
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
                jQuery('#emailtemplatelist tbody tr').each(function () {
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
                    jQuery('#emailtemplatelist tbody tr.select.lasttr').removeClass('lasttr');                    
                    jQuery('#emailtemplatelist tbody tr.select:first').removeClass('select');                    
                    jQuery('#emailtemplatelist tbody tr.select:first').addClass('lasttr');      
                                
                    var trht = jQuery('#emailtemplatelist tbody tr.select').innerHeight();
                    count -= trht;
                    var trh = 0;
                    jQuery('#emailtemplatelist tbody tr').each(function (i) {
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
                    jQuery('#emailtemplatelist tbody tr').each(function () {
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
    