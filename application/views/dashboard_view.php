<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.portlet-title .table>thead>tr>th{border-bottom:none;}
.portlet-title .table {margin-bottom:0px;}
.portlet-title .table tr.caption th {font-size: 18px !important;}
@media only screen and (max-width: 992px){
	.portlet-title .table tr.caption th.be{display:none;}
}
</style>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <script type="text/javascript">
       	// var chartData = [['Month', 'Enquiry', 'Booking']];
      	//  var chartData = [['Month', 'Enquiry', 'Removal bookings','Packing/Unpacking bookings']];
      	// var chartData = [['Month', 'Total', 'Removal bookings','Packing/Unpacking bookings','Storage']];
        var chartData = [['Month', 'Removal bookings','Packing/Unpacking bookings','Storage']];
        
<?php

foreach ($getChartForFiveMonth as $getEnquiryChartData) {
    if($getEnquiryChartData['bookingcnt'] == NULL){
        $getEnquiryChartData['bookingcnt'] = 0;
    }
    if($getEnquiryChartData['packcnt'] == NULL){
        $getEnquiryChartData['packcnt'] = 0;
    }
    if($getEnquiryChartData['storageCnt'] == NULL){
        $getEnquiryChartData['storageCnt'] = 0;
    }
    // if($getEnquiryChartData['totalbooking'] == NULL){
    //     $getEnquiryChartData['totalbooking'] = 0;
    // }
    if("January-18"==$getEnquiryChartData['enqStrmonth'] . '-' . $getEnquiryChartData['enqYear']){
        $getEnquiryChartData['bookingcnt'] = 138;
        $getEnquiryChartData['totalbooking']=171;
    }
    ?>
            chartData.push(['<?php echo $getEnquiryChartData['enqStrmonth'] . '-' . $getEnquiryChartData['enqYear']; ?>', <?php echo $getEnquiryChartData['bookingcnt']; ?>, <?php echo $getEnquiryChartData['packcnt']; ?>, <?php echo $getEnquiryChartData['storageCnt']; ?>]);
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
                                    <!-- <span class="caption-subject font-dark bold uppercase dashboardtotalcolor">Bookings - <span>Total</span>/<span>Moves</span>/<span>Packs</span></span> -->
                                    <span class="caption-subject font-dark bold uppercase dashboardtotalcolor">Bookings - <span>Moves</span>/<span>Packs</span>/<span style="color:#f4b400">Storage</span></span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="columnchart_material" style="width: 100%;"></div>
                            </div>
                        </div>
                        <!-- END PORTLET-->
                        
                        <div class="portlet box blue enqbookdashboard">
                            <div class="portlet-title">
								<table class="table">
									<thead>
										<tr class="caption">
								<!--<th scope="col">#</th>-->
											<th width="25%" scope="col"> <i class="fa fa-cogs"></i>  Bookings/Enquiries</th>
											<th class="be" scope="col">Bookings</th>
											<th class="be" scope="col">Enquiries</th>
											<th class="be" scope="col">Bookings</th>
											<th class="be" scope="col">Enquiries</th>
											<th class="be" scope="col">Bookings</th>
											<th class="be" scope="col">Enquiries</th>
										</tr>
									<thead>
								</table>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                    <!--<th scope="col">#</th>-->
                                                <th scope="col">Month</th>
                                                <th align="center" colspan="3" style="text-align:center;" scope="col">Total</th>
                                                <th align="center" colspan="3" style="text-align:center;" scope="col">Moves</th>
                                                <th align="center" colspan="3" style="text-align:center;" scope="col">Packs</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $i = 0;
                                                foreach ($getEnquiryChartDataByMonth as $getEnquiryChartData) {
                                                    if ($getEnquiryChartData['bookingcnt'] == NULL) {
                                                        $getEnquiryChartData['bookingcnt'] = 0;
                                                    }
                                                    if ($getEnquiryChartData['packcnt'] == NULL) {
                                                        $getEnquiryChartData['packcnt'] = 0;
                                                    }
                                                    if ($getEnquiryChartData['totalbooking'] == NULL) {
                                                        $getEnquiryChartData['totalbooking'] = 0;
                                                    }
                                                    if("January-18"==$getEnquiryChartData['enqStrmonth'] . '-' . $getEnquiryChartData['enqYear']){
                                                        $getEnquiryChartData['bookingcnt']=138;
                                                        $getEnquiryChartData['totalbooking']=171;
                                                    }
                                                    $i++;
                                                    ?>
                                                    <td><?php echo $getEnquiryChartData['enqStrmonth'] . '-' . $getEnquiryChartData['enqYear']; ?></td>
													
													<td><?php echo $getEnquiryChartData['totalbooking']; ?></td>
													<td><?php echo $getEnquiryChartData['enquiryCnt']; ?></td>
                                                    <td><?php echo number_format(($getEnquiryChartData['totalbooking']/$getEnquiryChartData['enquiryCnt'])*100,0).'%'; ?></td>
													
													<td><?php echo $getEnquiryChartData['bookingcnt']; ?></td>
													<td><?php echo $getEnquiryChartData['reenq']; ?></td>
                                                    <td><?php echo number_format(($getEnquiryChartData['bookingcnt']/$getEnquiryChartData['reenq'])*100,0).'%'; ?></td>
													
													<td><?php echo $getEnquiryChartData['packcnt']; ?></td>
													<td><?php echo $getEnquiryChartData['packenq']; ?></td>
													<td><?php echo number_format(($getEnquiryChartData['packcnt']/$getEnquiryChartData['packenq'])*100,0).'%'; ?></td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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
</div>


<div class="quick-nav-overlay"></div>
