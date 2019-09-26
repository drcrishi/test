<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <script type="text/javascript">
        var chartData = [['Month', 'Enquiry', 'Booking']];
<?php
foreach ($getEnquiryChartDataByMonth as $getEnquiryChartData) {
    if("January-18"==$getEnquiryChartData['enqStrMonth'] . '-' . $getEnquiryChartData['enqYear']){
        $getEnquiryChartData['bookingCnt']=171;
    }
    ?>
            chartData.push(['<?php echo $getEnquiryChartData['enqStrMonth'] . '-' . $getEnquiryChartData['enqYear']; ?>', <?php echo $getEnquiryChartData['enquiryCnt']; ?>, <?php echo $getEnquiryChartData['bookingCnt']; ?>]);
    <?php
}
?>

    </script>
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include "template/leftmenu.php"; ?>
        <!-- END HEADER -->

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content res-col-des" style="margin-left: 0">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <!--<ul class="page-breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Dashboard</span>
                        </li>
                    </ul>-->
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h1 class="page-title"> 
                    <small></small>
                </h1>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <!-- BEGIN DASHBOARD STATS 1-->
                <div class="row">
                    <div class="col-lg-full col-md-2 col-sm-2 col-xs-6">
                        <!--<a class="dashboard-stat dashboard-stat-v2 red">-->
                        <a class="dashboard-stat dashboard-stat-v2 red" href="<?php echo base_url("bookinglist?en_bookingdate=".date('Y-m-d',strtotime(date('Y-m-d'))));?>">
                            <div class="visual">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span class="" data-value="<?php echo $todayNewBooking; ?>"><?php echo $todayNewBooking; ?></span></div>
                                <div class="desc"> Today's Bookings </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-full col-md-2 col-sm-2 col-xs-6">
                        <!--<a class="dashboard-stat dashboard-stat-v2 red">-->
                        <a class="dashboard-stat dashboard-stat-v2 red" href="<?php echo base_url("bookinglist?en_bookingdate=".date('Y-m-d',strtotime(date('Y-m-d')."-1 day")));?>">
                            <div class="visual">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span class="" data-value="<?php echo $yesterDayNewBooking; ?>"><?php echo $yesterDayNewBooking; ?></span>
                                </div>
                                <div class="desc"> Yesterday's Bookings </div>
                            </div>
                        </a>
                    </div>
                     <div class="col-lg-full col-md-2 col-sm-2 col-xs-6">
                        <!--<a class="dashboard-stat dashboard-stat-v2 red">-->
                        <a class="dashboard-stat dashboard-stat-v2 red" href="<?php echo base_url("bookinglist?en_monthstart=".date('Y-m-01',strtotime(date('Y-m-d')))."& en_monthend=".date('Y-m-d',strtotime(date('Y-m-d'))));?>">
                            <div class="visual">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span class="" data-value="<?php echo $thismonthBookings; ?>"><?php echo $thismonthBookings; ?></span></div>
                                <div class="desc"> This Month's Bookings </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-full col-md-2 col-sm-2 col-xs-6">
                        <a class="dashboard-stat dashboard-stat-v2 green" href="<?php echo base_url("bookinglist?en_servicedate=".date('Y-m-d',strtotime(date('Y-m-d')."+1 day")));?>">
                            <div class="visual">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span class="" data-value="<?php echo $tomorrowNewBooking; ?>"><?php echo $tomorrowNewBooking; ?></span></div>
                                <div class="desc"> What's on Tomorrow </div>
                            </div>
                        </a>
                    </div>
                   
                    <div class="col-lg-full col-md-2 col-sm-2 col-xs-6">
                        <!--<a class="dashboard-stat dashboard-stat-v2 blue">-->
                        <a class="dashboard-stat dashboard-stat-v2 blue" href="<?php echo base_url("enquirieslist?en_quotedate=".date('Y-m-d',strtotime(date('Y-m-d'))));?>">
                            <div class="visual">
                                <i class="fa fa-pencil-square-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span class="" data-value="<?php echo $todayNewEnquiry; ?>"><?php echo $todayNewEnquiry; ?></span></div>
                                <div class="desc"> Today's Enquiries </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-full col-md-2 col-sm-2 col-xs-6">
                        <!--<a class="dashboard-stat dashboard-stat-v2 blue">-->
                        <a class="dashboard-stat dashboard-stat-v2 blue" href="<?php echo base_url("enquirieslist?en_quotedate=".date('Y-m-d',strtotime(date('Y-m-d')."-1 day")));?>">
                            <div class="visual">
                                <i class="fa fa-pencil-square-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <span class="" data-value="<?php echo $yesterDayNewEnquiry; ?>"><?php echo $yesterDayNewEnquiry; ?></span>
                                </div>
                                <div class="desc"> Yesterday's Enquiries </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-full col-md-2 col-sm-2 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 purple">
                            <div class="visual">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <?php 
                                    $AvgBooking = $thismonthBookings/date('d');
                                $avgb = number_format($AvgBooking, 2); 
                                     echo $avgb; ?></div>
                                <div class="desc"> Monthly Average </div>
                                
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-full col-md-2 col-sm-2 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-v2 purple">
                            <div class="visual">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <?php $AvgBooking = $thismonthBookings/date('d');
                                $avgb =  number_format($AvgBooking, 2);
                                $mull = $avgb*date('t');
                                $mul = (round($mull,0));
                                echo $mul;?>
                                    </div>
                                <div class="desc"> Monthly Estimate </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <!-- END DASHBOARD STATS 1-->
                <div class="row">
                    <div class="col-lg-12 col-xs-12 col-sm-12">
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-share font-red-sunglo hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Monthly Summary</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
                            </div>
                        </div>
                        <!-- END PORTLET-->
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
