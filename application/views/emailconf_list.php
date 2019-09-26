<?php ?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
<?php include "template/leftmenu.php"; ?>
        <!-- END HEADER -->

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="margin-left: 0;">
                <div class="page-bar"></div>
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
                                <span>Email Configurations</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-4 w-100">
                        <h4 class="peoples-page-title res-float-left"><i class="fa fa-cogs" style="display: unset"></i>&nbsp;Email Configurations</h4>
                        <div class="peop-btn-right">
                            <div class="people-toggle">
                                <span></span>
                            </div>
                        </div>
                    </div>                    
                </div>
                <!-- BEGIN PAGE HEADER-->
                <!-- START EMAIL MASTER @DRCZ -->
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <h3>Email Configuration Master Table</h3>
                    </div>
                    <div class="col-sm-6 col-xs-12 text-right" style="margin-top: 20px;">
                        <a href="<?php echo base_url("EmailConf/newEmailconfmaster"); ?>" class="btn btn-outline dark"><i class="fa fa-plus-circle"></i> Email Master </a>
                    </div>
                </div>
              
                
                
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered table-div">
                            <div class="table-wrapper">
                                <div class="table-scroll">
                                    <div class="filter-overlay"></div>
                                    <div class="portlet-body emailconfmaster-table">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="emailconfmaster">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="select_all_emailconfmaster" name="select_all_emailconfmaster"></th>
                                                    <th>Host</th>
                                                    <th>Job type</th>
                                                </tr>
                                            </thead>																	
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END EMAIL MASTER @DRCZ -->
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                          <h3 style="margin-top: 0;">Email Template List</h3>
                    </div>
                    <div class="col-sm-6 col-xs-12 text-right">
                        <a href="<?php echo base_url("EmailConf/newEmailConf"); ?>" class="btn btn-outline dark"><i class="fa fa-plus-circle"></i> Email template </a>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered table-div">
                            <div class="table-wrapper">
                                <!--                                <div class="filter-toggle">
                                                                    <button type="button" class="btn dark btn-outline sbold uppercase filter-btn">Filter</button>
                                                                </div>-->
                                <div class="table-scroll">

                                    <div class="filter-overlay"></div>


                                    <div class="portlet-body emailconf-table">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="emailconf">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" id="select_all_emailconf" name="select_all_emailconf"></th>
                                                    <th>SMTP user</th>
                                                    <th>Host</th>
                                                    <th>Job type</th>
                                                    <th>Email type</th>
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

        jQuery('#emailconf').bind('touchend', function (event) {

            var pas = event.target.parentElement.innerHTML;
            var go_url = jQuery(pas).find('.userlink').attr('href');

            var now = new Date().getTime();
            var lastTouch = jQuery(this).data('lastTouch') || now + 1
            var delta = now - lastTouch;
            if (delta < 500 && delta > 0) {
                jQuery('#emailconf tbody tr.select').find('.checkbox_val').prop('checked', false);
                jQuery('#emailconf tbody tr.select').removeClass('select');
                jQuery('#emailconf tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).parent().addClass('select lasttr');
                document.location.href = go_url;
            } else {

            }
            jQuery(this).data('lastTouch', now);
        });

        var wd = $(window).width();
        if (wd > 768) {
            jQuery("html body").on("click", "#emailconf tbody tr td a", function (e) {
                e.preventDefault();
            });
        }



        jQuery("html body").on("click", "#emailconf tbody tr", function (e) {

            var evt = e || window.event
            if (jQuery(this).hasClass('select')) {
                jQuery(this).find('.checkbox_val').prop('checked', false);
                jQuery(this).removeClass('select');
                jQuery(this).removeClass('lasttr');
                jQuery(this).removeClass('select');
                var itm = 0;
                jQuery('#emailconf tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('#emailconf_info').find('span').hasClass('select-itm')) {
                            jQuery('#emailconf_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('#emailconf_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        // jQuery('#emailconf_info').find('span.select-itm').text('');
                        var len = jQuery('#emailconf').find('tr.select').length;
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
                    // jQuery('#emailconf tbody tr.select').find('.checkbox_val').prop('checked', false);
                    //jQuery('#emailconf tbody tr.select').removeClass('select');
                }

                jQuery(this).addClass('select');
                jQuery('#emailconf tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).addClass('lasttr');
                var itm = 0;
                jQuery('#emailconf tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('#emailconf_info').find('span').hasClass('select-itm')) {
                            jQuery('#emailconf_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('#emailconf_info').append('<span class="select-itm">' + itm + '  selected</span>');
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


        jQuery("html body").on("dblclick", "#emailconf tbody tr", function (e) {
            var go_to_url = $(this).find("td a").attr('href');
            document.location.href = go_to_url;
        });

        var count = 0;
        jQuery(document).on('keydown', function (e) {
            // You may replace `c` with whatever key you want

            if ((e.metaKey || e.ctrlKey) && e.keyCode == 40) {
                if (jQuery('#emailconf tbody tr:last').hasClass('select')) {
                    jQuery('#emailconf tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#emailconf tbody tr:last').addClass('lasttr');
                } else {
                    jQuery('#emailconf tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#emailconf tbody tr.select:last').next('tr').addClass('select lasttr');
                    jQuery('#emailconf tbody tr.select:last').find('.checkbox_val').prop('checked', 'true');

                    var trh = 0;
                    jQuery('#emailconf tbody tr').each(function (i) {
                        var thh = jQuery(this).innerHeight();
                        trh = trh + thh;
                        if (jQuery(this).hasClass('lasttr')) {
                            trh = trh - 200;
                            jQuery('.dataTables_scrollBody').animate({
                                scrollTop: trh
                            }, 00);
                        }
                    });
                    var trht = jQuery('#emailconf tbody tr.select').innerHeight();
                    count += trht;
                    var itm = 0;
                    jQuery('#emailconf tbody tr').each(function () {
                        if (jQuery(this).hasClass('select')) {
                            itm += 1;
                            if (jQuery('#emailconf_info').find('span').hasClass('select-itm')) {
                                jQuery('#emailconf_info').find('span.select-itm').text(itm + ' selected');
                            } else {
                                jQuery('#emailconf_info').append('<span class="select-itm">' + itm + '  selected</span>');
                            }
                        }
                    });
                }

            } else if ((e.metaKey || e.ctrlKey) && e.keyCode == 38) {
                var trht = jQuery('#emailconf tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#emailconf tbody tr.lasttr').removeClass('lasttr');
                jQuery('#emailconf tbody tr.select:first').prev('tr').addClass('select lasttr');
                jQuery('#emailconf tbody tr.lasttr').find('.checkbox_val').prop('checked', 'true');

                var trh = 0;
                jQuery('#emailconf tbody tr').each(function (i) {
                    var thh = jQuery(this).innerHeight();
                    trh = trh + thh;
                    if (jQuery(this).hasClass('lasttr')) {
                        trh = trh - 200;
                        jQuery('.dataTables_scrollBody').animate({
                            scrollTop: trh
                        }, 00);
                    }
                });
                var itm = 0;
                jQuery('#emailconf tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('#emailconf_info').find('span').hasClass('select-itm')) {
                            jQuery('#emailconf_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('#emailconf_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    }
                });

            } else if ((e.shiftKey) && e.keyCode == 40) {
                var trht = jQuery('#emailconf tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#emailconf tbody tr.select:last').find('.checkbox_val').prop('checked', false);
                jQuery('#emailconf tbody tr.select:last').removeClass('select lasttr');
                jQuery('#emailconf tbody tr.select.lasttr').removeClass('lasttr');
                jQuery('#emailconf tbody tr.select:last').addClass('lasttr');

                var trh = 0;
                jQuery('#emailconf tbody tr').each(function (i) {
                    var thh = jQuery(this).innerHeight();
                    trh = trh + thh;
                    if (jQuery(this).hasClass('lasttr')) {
                        trh = trh - 200;
                        jQuery('.dataTables_scrollBody').animate({
                            scrollTop: trh
                        }, 00);
                    }
                });
                var itm = 0;
                jQuery('#emailconf tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('#emailconf_info').find('span').hasClass('select-itm')) {
                            jQuery('#emailconf_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            itm -= 1;
                            jQuery('#emailconf_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        jQuery('#emailconf_info').find('span.select-itm').text(itm + ' selected');
                    }
                });

            } else if ((e.shiftKey) && e.keyCode == 38) {
                jQuery('#emailconf tbody tr.select:first').find('.checkbox_val').prop('checked', false);
                jQuery('#emailconf tbody tr.select.lasttr').removeClass('lasttr');
                jQuery('#emailconf tbody tr.select:first').removeClass('select');
                jQuery('#emailconf tbody tr.select:first').addClass('lasttr');

                var trht = jQuery('#emailconf tbody tr.select').innerHeight();
                count -= trht;
                var trh = 0;
                jQuery('#emailconf tbody tr').each(function (i) {
                    var thh = jQuery(this).innerHeight();
                    trh = trh + thh;
                    if (jQuery(this).hasClass('lasttr')) {
                        trh = trh - 200;
                        jQuery('.dataTables_scrollBody').animate({
                            scrollTop: trh
                        }, 00);
                    }
                });

                var itm = 0;
                jQuery('#emailconf tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('#emailconf_info').find('span').hasClass('select-itm')) {
                            jQuery('#emailconf_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('#emailconf_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        jQuery('#emailconf_info').find('span.select-itm').text(itm + ' selected');
                    }
                });
            }
        });

    });
    jQuery(document).ready(function () {

        jQuery('#emailconfmaster').bind('touchend', function (event) {

            var pas = event.target.parentElement.innerHTML;
            var go_url = jQuery(pas).find('.userlink').attr('href');

            var now = new Date().getTime();
            var lastTouch = jQuery(this).data('lastTouch') || now + 1
            var delta = now - lastTouch;
            if (delta < 500 && delta > 0) {
                jQuery('#emailconfmaster tbody tr.select').find('.checkbox_val').prop('checked', false);
                jQuery('#emailconfmaster tbody tr.select').removeClass('select');
                jQuery('#emailconfmaster tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).parent().addClass('select lasttr');
                document.location.href = go_url;
            } else {

            }
            jQuery(this).data('lastTouch', now);
        });

        var wd = $(window).width();
        if (wd > 768) {
            jQuery("html body").on("click", "#emailconfmaster tbody tr td a", function (e) {
                e.preventDefault();
            });
        }



        jQuery("html body").on("click", "#emailconfmaster tbody tr", function (e) {

            var evt = e || window.event
            if (jQuery(this).hasClass('select')) {
                jQuery(this).find('.checkbox_val').prop('checked', false);
                jQuery(this).removeClass('select');
                jQuery(this).removeClass('lasttr');
                jQuery(this).removeClass('select');
                var itm = 0;
                jQuery('#emailconfmaster tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('#emailconfmaster_info').find('span').hasClass('select-itm')) {
                            jQuery('#emailconfmaster_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('#emailconfmaster_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        // jQuery('#emailconfmaster_info').find('span.select-itm').text('');
                        var len = jQuery('#emailconfmaster').find('tr.select').length;
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
                }

                jQuery(this).addClass('select');
                jQuery('#emailconfmaster tbody tr.lasttr').removeClass('lasttr');
                jQuery(this).addClass('lasttr');
                var itm = 0;
                jQuery('#emailconfmaster tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('#emailconfmaster_info').find('span').hasClass('select-itm')) {
                            jQuery('#emailconfmaster_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('#emailconfmaster_info').append('<span class="select-itm">' + itm + '  selected</span>');
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


        jQuery("html body").on("dblclick", "#emailconfmaster tbody tr", function (e) {
            var go_to_url = $(this).find("td a").attr('href');
            document.location.href = go_to_url;
        });

        var count = 0;
        jQuery(document).on('keydown', function (e) {
            // You may replace `c` with whatever key you want

            if ((e.metaKey || e.ctrlKey) && e.keyCode == 40) {
                if (jQuery('#emailconfmaster tbody tr:last').hasClass('select')) {
                    jQuery('#emailconfmaster tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#emailconfmaster tbody tr:last').addClass('lasttr');
                } else {
                    jQuery('#emailconfmaster tbody tr.lasttr').removeClass('lasttr');
                    jQuery('#emailconfmaster tbody tr.select:last').next('tr').addClass('select lasttr');
                    jQuery('#emailconfmaster tbody tr.select:last').find('.checkbox_val').prop('checked', 'true');

                    var trh = 0;
                    jQuery('#emailconfmaster tbody tr').each(function (i) {
                        var thh = jQuery(this).innerHeight();
                        trh = trh + thh;
                        if (jQuery(this).hasClass('lasttr')) {
                            trh = trh - 200;
                            jQuery('.dataTables_scrollBody').animate({
                                scrollTop: trh
                            }, 00);
                        }
                    });
                    var trht = jQuery('#emailconfmaster tbody tr.select').innerHeight();
                    count += trht;
                    var itm = 0;
                    jQuery('#emailconfmaster tbody tr').each(function () {
                        if (jQuery(this).hasClass('select')) {
                            itm += 1;
                            if (jQuery('#emailconfmaster_info').find('span').hasClass('select-itm')) {
                                jQuery('#emailconfmaster_info').find('span.select-itm').text(itm + ' selected');
                            } else {
                                jQuery('#emailconfmaster_info').append('<span class="select-itm">' + itm + '  selected</span>');
                            }
                        }
                    });
                }

            } else if ((e.metaKey || e.ctrlKey) && e.keyCode == 38) {
                var trht = jQuery('#emailconfmaster tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#emailconfmaster tbody tr.lasttr').removeClass('lasttr');
                jQuery('#emailconfmaster tbody tr.select:first').prev('tr').addClass('select lasttr');
                jQuery('#emailconfmaster tbody tr.lasttr').find('.checkbox_val').prop('checked', 'true');

                var trh = 0;
                jQuery('#emailconfmaster tbody tr').each(function (i) {
                    var thh = jQuery(this).innerHeight();
                    trh = trh + thh;
                    if (jQuery(this).hasClass('lasttr')) {
                        trh = trh - 200;
                        jQuery('.dataTables_scrollBody').animate({
                            scrollTop: trh
                        }, 00);
                    }
                });
                var itm = 0;
                jQuery('#emailconfmaster tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('#emailconfmaster_info').find('span').hasClass('select-itm')) {
                            jQuery('#emailconfmaster_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('#emailconfmaster_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    }
                });

            } else if ((e.shiftKey) && e.keyCode == 40) {
                var trht = jQuery('#emailconfmaster tbody tr.select').innerHeight();
                count -= trht;
                jQuery('#emailconfmaster tbody tr.select:last').find('.checkbox_val').prop('checked', false);
                jQuery('#emailconfmaster tbody tr.select:last').removeClass('select lasttr');
                jQuery('#emailconfmaster tbody tr.select.lasttr').removeClass('lasttr');
                jQuery('#emailconfmaster tbody tr.select:last').addClass('lasttr');

                var trh = 0;
                jQuery('#emailconfmaster tbody tr').each(function (i) {
                    var thh = jQuery(this).innerHeight();
                    trh = trh + thh;
                    if (jQuery(this).hasClass('lasttr')) {
                        trh = trh - 200;
                        jQuery('.dataTables_scrollBody').animate({
                            scrollTop: trh
                        }, 00);
                    }
                });
                var itm = 0;
                jQuery('#emailconfmaster tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('#emailconfmaster_info').find('span').hasClass('select-itm')) {
                            jQuery('#emailconfmaster_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            itm -= 1;
                            jQuery('#emailconfmaster_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        jQuery('#emailconfmaster_info').find('span.select-itm').text(itm + ' selected');
                    }
                });

            } else if ((e.shiftKey) && e.keyCode == 38) {
                jQuery('#emailconfmaster tbody tr.select:first').find('.checkbox_val').prop('checked', false);
                jQuery('#emailconfmaster tbody tr.select.lasttr').removeClass('lasttr');
                jQuery('#emailconfmaster tbody tr.select:first').removeClass('select');
                jQuery('#emailconfmaster tbody tr.select:first').addClass('lasttr');

                var trht = jQuery('#emailconfmaster tbody tr.select').innerHeight();
                count -= trht;
                var trh = 0;
                jQuery('#emailconfmaster tbody tr').each(function (i) {
                    var thh = jQuery(this).innerHeight();
                    trh = trh + thh;
                    if (jQuery(this).hasClass('lasttr')) {
                        trh = trh - 200;
                        jQuery('.dataTables_scrollBody').animate({
                            scrollTop: trh
                        }, 00);
                    }
                });

                var itm = 0;
                jQuery('#emailconfmaster tbody tr').each(function () {
                    if (jQuery(this).hasClass('select')) {
                        itm += 1;
                        if (jQuery('#emailconfmaster_info').find('span').hasClass('select-itm')) {
                            jQuery('#emailconfmaster_info').find('span.select-itm').text(itm + ' selected');
                        } else {
                            jQuery('#emailconfmaster_info').append('<span class="select-itm">' + itm + '  selected</span>');
                        }
                    } else {
                        jQuery('#emailconfmaster_info').find('span.select-itm').text(itm + ' selected');
                    }
                });
            }
        });

    });

</script>
