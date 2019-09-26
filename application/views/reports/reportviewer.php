<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
if ($_POST['enmovetype'] == 1 || $_POST['enmovetype'] == 2 || $_POST['enmovetype'] == 3) {
    ?><div style="text-align: center;"><img style="display: block; margin: 0 auto; margin-bottom: 10px;" src="<?php echo base_url('assets/custom/img/logo/logo-hire-a-mover.jpg'); ?>"></div><?php
} elseif ($_POST['enmovetype'] == 4 || $_POST['enmovetype'] == 5) {
    ?><div style="text-align: center;"><img style="display: block; margin: 0 auto; margin-bottom: 10px;" src="<?php echo base_url('assets/custom/img/logo/logo-hire-a-packer.png'); ?>"></div><?php
    }
    ?>
<table width="100%" border="1" id="reportTable" style="border-collapse: collapse;border-bottom: 1px solid;"> 
    <tr>
        <th>State</th>
        <th>Service</th>
        <th>Removalist</th>
        <th>Client</th>
        <th>Move Date</th>
        <th align="right">Total Cost</th>
        <th align="right">Total Revenue</th>
        <th align="right">Margin</th>
    </tr>
    <?php

//    echo "<pre>";
//    print_r($revenueReport);
//    echo "</pre>";
//    die;
    function daysCount($dayName) {
        $servicedatefrom = implode('/', array_reverse(explode('-', $_POST['servicedatefrom'])));
        $servicedateto = implode('/', array_reverse(explode('-', $_POST['servicedateto'])));
//        $date_from = $servicedatefrom . '00:00:00';
        $date_from = $servicedatefrom;
        $daysCnt = 0;
        $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
// Specify the end date. This date can be any English textual format  
        $date_to = $servicedateto;
//        $date_to = $servicedateto . '23:59:59';
        $date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
// Loop from the start date to end date and output all dates inbetween  
        for ($i = $date_from; $i <= $date_to; $i += 86400) {

            $dd = date("l", $i);

            if ($dd == $dayName) {
//                 echo date("Y-m-d", $i).'  ';
                $daysCnt++;
            }
        }
        return $daysCnt;
    }

    $daysArray = array('Monday' => '', 'Tuesday' => '', 'Wednesday' => '', 'Thursday' => '', 'Friday' => '', 'Saturday' => '', 'Sunday' => '');
    $state = "";
    $services = "";
    $removal_id = "";
    $client_id = "";
    $total_cost = 0;
    $final_cost = 0;
    $total_revenue = 0;
    $final_revenue = 0;
    $total_margin = 0;
    $final_margin = 0;
    $IsNEW = false;
    $IsNEWRemoval = false;
    $cntReventRecords = count($revenueReport);
    $incCNT = 0;
    $zeroBookingMinusCnt=0;
    /*echo "<pre>";
    print_r($revenueReport);
    echo "</pre>";*/
    $servicesType = array("", "Removal", "Removal", "", "Packing/Unpacking", "Packing/Unpacking", "Storage");
    foreach ($revenueReport as $revenueReportKey => $revenueReportValue) {
        $dayServiceDate = date('l', strtotime($revenueReportValue['en_servicedate']));
        if (isset($daysArray[$dayServiceDate]['totalJobs'])) {
            if(($revenueReportValue['en_total_costprice']=="0.00" || $revenueReportValue['en_total_costprice']==NULL || $revenueReportValue['en_total_sellprice']==NULL || $revenueReportValue['en_total_sellprice']=="0.00") && $revenueReportValue['booking_status']!=3){
                $zeroBookingMinusCnt++;
            }else{
                $daysArray[$dayServiceDate]['totalJobs'] ++;
            }
            $tP = $daysArray[$dayServiceDate]['totalProfit'];
            $tP += $revenueReportValue['margin'];
            $daysArray[$dayServiceDate]['totalProfit'] = $tP;
        } else {
            if(($revenueReportValue['en_total_costprice']=="0.00"  || $revenueReportValue['en_total_costprice']==NULL || $revenueReportValue['en_total_sellprice']==NULL || $revenueReportValue['en_total_sellprice']=="0.00") && $revenueReportValue['booking_status']!=3){
                $zeroBookingMinusCnt++;
                $daysArray[$dayServiceDate] = array('totalJobs' => 0, 'totalProfit' => 0);
            }else{
                $daysArray[$dayServiceDate] = array('totalJobs' => 1, 'totalProfit' => 0);
            }
            
            $tP = $daysArray[$dayServiceDate]['totalProfit'];
            $tP += $revenueReportValue['margin'];
            $daysArray[$dayServiceDate]['totalProfit'] = $tP;
        }
        $incCNT++;
        $serviceType = $servicesType[$revenueReportValue['en_movetype']];
        if ($removal_id != $revenueReportValue['packer']) {
            if ($incCNT > 1) {
                ?>
                <tr>
                    <td class="no-border"></td>
                    <td class="no-border"></td>
                    <td></td>
                    <td></td>
                    <td align="right"><strong>Sub-Total</strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_cost_re, 2); ?></strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_revenue_re, 2); ?></strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_margin_re, 2); ?></strong></td>
                </tr>
                <tr>
                    <td class="no-border"></td>
                    <td class="no-border"></td>
                    <td></td>
                    <td></td>
                    <td align="right"><strong style="color:green;">Job count</strong></td>
                    <td align="right"><strong style="color:green;"><?php echo $total_jobs; ?></strong></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                $total_cost_re = 0;
                $total_revenue_re = 0;
                $total_margin_re = 0;
                $total_jobs = 0;
            }
        }
        if ($state != $revenueReportValue['movingfrom_state']) {
            $IsNEW = true;
            if ($total_cost > 0) {
                // $final_state_job += $total_state_jobs;
                $final_margin += $total_margin;
                $final_revenue += $total_revenue;
                $final_cost += $total_cost;
                ?>
                <tr>
                    <td class="no-border top-border"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right"><strong>Sub-Total</strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_cost, 2); ?></strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_revenue, 2); ?></strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_margin, 2); ?></strong></td>
                </tr>
                <tr>
                    <td class="no-border top-border"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right"><strong style="color:red;">Total jobs</strong></td>
                    <td align="right"><strong style="color:red;"><?php echo $total_state_jobs; ?></strong></td>
                    <td align="right"><strong></strong></td>
                    <td align="right"><strong></strong></td>
                </tr>
                <?php
                $IsNEW = false;
                $total_cost = 0;
                $total_revenue = 0;
                $total_margin = 0;
                $total_state_jobs = 0;
            }
        }

        if ($services != $serviceType) {
            $IsNEW = true;
            if ($total_cost > 0) {
                $final_margin += $total_margin;
                $final_revenue += $total_revenue;
                $final_cost += $total_cost;
                ?>
                <tr>
                    <td class="no-border top-border"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right"><strong>Sub-Total</strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_cost, 2); ?></strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_revenue, 2); ?></strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_margin, 2); ?></strong></td>
                </tr>

                <?php
                $IsNEW = false;
                $total_cost = 0;
                $total_revenue = 0;
                $total_margin = 0;
                $total_state_jobs = 0;
            }
        }
        ?>
        <tr>
            <?php
            if ($state == "" || $state != $revenueReportValue['movingfrom_state']) {
                $services = "";
                $state = $revenueReportValue['movingfrom_state'];
                $removal_id = "";
                $client_id = "";
                $total_cost = 0;
                $total_revenue = 0;
                $total_margin = 0;
                ?>
                <td><?php echo $revenueReportValue['movingfrom_state']; ?></td>
                <?php
            } else {
//                $IsNEW = false;
                ?>
                <td class="no-border"></td>
                <?php
            }


            if ($services == "" || $services != $serviceType) {
                $services = $serviceType;
                ?>
                <td><?php echo $serviceType; ?></td>
                <?php
            } else {
                ?>
                <td class="no-border"></td>
                <?php
            }

            $total_cost += $revenueReportValue['en_total_costprice'];
            $total_revenue += $revenueReportValue['en_total_sellprice'];
            $total_margin += $revenueReportValue['margin'];
            if(($revenueReportValue['en_total_costprice']=="0.00" || $revenueReportValue['en_total_costprice']==NULL || $revenueReportValue['en_total_sellprice']==NULL || $revenueReportValue['en_total_sellprice']=="0.00") && $revenueReportValue['booking_status']!=3){
            }else{
            $total_state_jobs += count($revenueReportValue['movingfrom_state']);
            }
            ?>
            <?php
            if ($removal_id == "" || $removal_id != $revenueReportValue['packer']) {
                $removal_id = $revenueReportValue['packer'];
                $client_id = "";
                ?>
                <td><?php echo $revenueReportValue['rp']; //if($revenueReportValue['en_movetype'] != 5 && $revenueReportValue['en_movetype'] != 4 ) {                  ?></td>
                <?php
            } else {
                ?>
                <td class="no-border"></td>
                <?php
            }
            ?>
            <?php
            if ($client_id == "" || $client_id != $revenueReportValue['client_id']) {
                $client_id = $revenueReportValue['client_id'];
                ?>
                <!--<td><?php echo $revenueReportValue['client']; ?></td>-->
                <?php
            } else {
                ?>
                <!--<td class="no-border"></td>-->
                <?php
            }
            ?>
            <td><?php echo $revenueReportValue['client']; ?></td>    
            <td><?php echo date('d/m/Y', strtotime($revenueReportValue['en_servicedate'])); ?></td>
            <td align="right">$<?php echo number_format($revenueReportValue['en_total_costprice'], 2); ?></td>
            <td align="right">$<?php echo number_format($revenueReportValue['en_total_sellprice'], 2); ?></td>
            <td align="right">$<?php echo number_format($revenueReportValue['margin'], 2); ?></td>
            <?php
            $total_cost_re += $revenueReportValue['en_total_costprice'];
            $total_revenue_re += $revenueReportValue['en_total_sellprice'];
            $total_margin_re += $revenueReportValue['margin'];
            if(($revenueReportValue['en_total_costprice']=="0.00" || $revenueReportValue['en_total_costprice']==NULL || $revenueReportValue['en_total_sellprice']==NULL  || $revenueReportValue['en_total_sellprice']=="0.00") && $revenueReportValue['booking_status']!=3){
            }else{
                $total_jobs += count($revenueReportValue['client']);
            }
            ?>
        </tr>
        <?php
        if ($cntReventRecords == $incCNT) {
            ?>
            <tr>
                <td class="no-border"></td>
                <td class="no-border"></td>
                <td></td>
                <td></td>
                <td align="right"><strong>Sub-Total</strong></td>
                <td align="right"><strong>$<?php echo number_format($total_cost_re, 2); ?></strong></td>
                <td align="right"><strong>$<?php echo number_format($total_revenue_re, 2); ?></strong></td>
                <td align="right"><strong>$<?php echo number_format($total_margin_re, 2); ?></strong></td>
            </tr>
            <tr>
                <td class="no-border"></td>
                <td class="no-border"></td>
                <td></td>
                <td></td>
                <td align="right"><strong style="color:green;">Job count</strong></td>
                <td align="right"><strong style="color:green;"><?php echo $total_jobs; ?></strong></td>
                <td></td>
                <td></td>
            </tr>
            <?php
            if ($total_cost > 0) {
                $final_margin += $total_margin;
                $final_revenue += $total_revenue;
                $final_cost += $total_cost;
                ?>
                <tr>
                    <td class="no-border top-border"></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td class=""></td>
                    <td align="right"><strong>Sub-Total</strong></td>
                    <td  align="right"><strong>$<?php echo number_format($total_cost, 2); ?></strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_revenue, 2); ?></strong></td>
                    <td align="right"><strong>$<?php echo number_format($total_margin, 2); ?></strong></td>
                </tr>
                <tr>
                    <td class="no-border top-border"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right"><strong style="color:red;">Total jobs</strong></td>
                    <td align="right"><strong style="color:red;"><?php echo $total_state_jobs; ?></strong></td>
                    <td align="right"><strong></strong></td>
                    <td align="right"><strong></strong></td>
                </tr>
                <?php
            }
        }
    }
    ?>
    <tr>
        <td colspan="5" align="right"><strong>Grand-Total</strong></td>
        <td align="right"><strong>$<?php echo number_format($final_cost, 2); ?></strong></td>
        <td align="right"><strong>$<?php echo number_format($final_revenue, 2); ?></strong></td>
        <td align="right"><strong>$<?php echo number_format($final_margin, 2); ?></strong></td>            
    </tr>
    <tr>
        <td colspan="5" align="right"><strong>Total Bookings</strong></td>
        <td align="right"><strong><?php $cntReventRecords=$cntReventRecords-$zeroBookingMinusCnt; echo $cntReventRecords; ?></strong></td>
        <td align="right"><strong>Average Profit</strong></td>
        <td align="right"><strong>$<?php
                $profit = ($final_margin / $cntReventRecords);
                echo number_format($profit, 2);
                ?></strong></td>            
    </tr>
    <tr>
        <th>Day</th>
        <th>Total Days</th>
        <th>Total Jobs</th>
        <th>Average Jobs</th>
        <th>Total Profit</th>
        <th>Average Profit</th>
        <th>Jobs in percentage</th>
        <th>Weighted Average</th>
    </tr>
    <?php
    $totalAvarJobs = 0;
//    print_r($daysArray);
    foreach ($daysArray as $dayKey => $dayVal) {
        if (!isset($dayVal['totalJobs'])) {
            continue;
        }
        $daysCnt = daysCount($dayKey);
        $totalAvarJobs += $dayVal['totalJobs'] / $daysCnt;
    }

    foreach ($daysArray as $dayKey => $dayVal) {
        if (!isset($dayVal['totalJobs'])) {
            continue;
        }
        ?>
        <tr>
            <th><?php echo $dayKey; ?></th>
            <td align="right"><?php echo $daysCnt = daysCount($dayKey); ?></td>
            <td align="right"><?php echo $dayVal['totalJobs']; ?></td>
            <td align="right"><?php $avgJ = $dayVal['totalJobs'] / $daysCnt;echo number_format($avgJ, 2); ?></td>
            <td align="right">$<?php echo number_format($dayVal['totalProfit'], 2); ?></td>
            <td align="right">$<?php echo number_format($dayVal['totalProfit'] / $dayVal['totalJobs'], 2); ?></td>
            <td align="right"><?php echo number_format(($dayVal['totalJobs'] * 100) / ($cntReventRecords), 2); ?>%</td>
            <td align="right"><?php echo number_format(($avgJ / $totalAvarJobs) * 100, 2); ?>%</td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
//echo "<pre>";
//print_r($daysArray);
//echo "</pre>";
?>
<br>


<script>
    jQuery(document).ready(function () {
        $("#exportPDFviewer").click(function () {
            $('#pdforxls').val('pdf');
        });
        $("#exportXLSviewer").click(function () {
            $('#pdforxls').val('xls');
        });

        //$("#exportPDFviewer").trigger("click").attr("target", "_blank");
    });
</script>
<style type="text/css">
    #reportTable th{
        background: #ECECEC;
        padding: 6px;
        text-align: center;
    }
    #reportTable td{
        border-bottom: none;
        padding: 5px;
    }
    .no-border{
        border-top: none;
        border-right: 1px solid;
    }
    .revenue-logo{display: block; margin: 0 auto; margin-bottom: 10px;}
    /*    .top-border{
            border-top:1px solid;
        }*/
</style>