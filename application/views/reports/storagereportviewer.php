<?php

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
        <th align="right">Months In Storage</th>
        <th align="right">Total Profit</th>
    </tr>
    <?php

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
    
    $subMonthsInStorage = 0;
    $subTotalProfit = 0;
    $finalMonthTotal=0;
    $finalProfitTotal = 0;

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
                $finalMonthTotal += $subMonthsInStorage;
                $finalProfitTotal += $subTotalProfit;
                // echo $revenueReportValue['en_servicedate'];die;
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
                    <td align="right"><strong><?php echo $subMonthsInStorage; ?></strong></td>
                    <td align="right"><strong>$<?php echo number_format($subTotalProfit, 2); ?></strong></td>
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
                $subMonthsInStorage = 0;
                $subTotalProfit = 0;
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

            $tmc= '';
            if($revenueReportValue['booking_status'] == '3'){
                $tmc = getTotalMonths($revenueReportValue['en_servicedate'],$revenueReportValue['storage_completed_date']);
            }
            else{
                $tmc = getTotalMonths($revenueReportValue['en_servicedate'],'');
            }

            $total_cost += $revenueReportValue['en_total_costprice'];
            $total_revenue += $revenueReportValue['en_total_sellprice'];
            $total_margin += $revenueReportValue['margin'];
            $totalMonthsCount = $tmc;
            $subMonthsInStorage += $totalMonthsCount;
            $subTotalProfit +=  ($totalMonthsCount * $revenueReportValue['margin']);
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
            $tmc1= '';
            if($revenueReportValue['booking_status'] == '3'){
                $tmc1 = getTotalMonths($revenueReportValue['en_servicedate'],$revenueReportValue['storage_completed_date']);
            }
            else{
                $tmc1 = getTotalMonths($revenueReportValue['en_servicedate'],'');
            }
            ?>
            <td><?php echo $revenueReportValue['client']; ?></td>    
            <td><?php echo date('d/m/Y', strtotime($revenueReportValue['en_servicedate'])); ?></td>
            <td align="right">$<?php echo number_format($revenueReportValue['en_total_costprice'], 2); ?></td>
            <td align="right">$<?php echo number_format($revenueReportValue['en_total_sellprice'], 2); ?></td>
            <td align="right">$<?php echo number_format($revenueReportValue['margin'], 2); ?></td>
            <td align="right"><?php echo $sTotalMonths =  $tmc1; ?></td>
            <td align="right">$<?php echo number_format($sTotalMonths * $revenueReportValue['margin'], 2); ?></td>
            
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
            <!-- <tr>
                <td class="no-border"></td>
                <td class="no-border"></td>
                <td></td>
                <td></td>
                <td align="right"><strong>Sub-Total</strong></td>
                <td align="right"><strong>$<?php echo number_format($total_cost_re, 2); ?></strong></td>
                <td align="right"><strong>$<?php echo number_format($total_revenue_re, 2); ?></strong></td>
                <td align="right"><strong>$<?php echo number_format($total_margin_re, 2); ?></strong></td>
            </tr> -->
            <!-- <tr>
                <td class="no-border"></td>
                <td class="no-border"></td>
                <td></td>
                <td></td>
                <td align="right"><strong style="color:green;">Job count</strong></td>
                <td align="right"><strong style="color:green;"><?php echo $total_jobs; ?></strong></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr> -->
            <?php
            if ($total_cost > 0) {
                $final_margin += $total_margin;
                $final_revenue += $total_revenue;
                $final_cost += $total_cost;

                $finalMonthTotal += $subMonthsInStorage;
                $finalProfitTotal += $subTotalProfit;

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
                    <td align="right"><strong><?php echo $subMonthsInStorage; ?></strong></td>
                    <td align="right"><strong>$<?php echo number_format($subTotalProfit, 2); ?></strong></td>
                    
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
                    <td></td>
                    <td></td>
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
        <td align="right"><strong><?php echo $finalMonthTotal; ?></strong></td>
        <td align="right"><strong>$<?php echo number_format($finalProfitTotal, 2); ?></strong></td>   
                
    </tr>
    <tr>
        <td colspan="5" align="right"><strong>Total Bookings</strong></td>
        <td align="right"><strong><?php $cntReventRecords=$cntReventRecords-$zeroBookingMinusCnt; echo $cntReventRecords; ?></strong></td>
        <td align="right"><strong>Average Monthly Profit</strong></td>
        <td align="right"><strong>$<?php
                $profit = ($final_margin / $cntReventRecords);
                echo number_format($profit, 2);
                ?></strong></td>      
        <td align="right"><strong><?php echo number_format($finalMonthTotal/$cntReventRecords, 2); ?></strong></td>      
        <td align="right"><strong>$<?php echo number_format($finalProfitTotal/$cntReventRecords, 2); ?></strong></td>      
    </tr>

</table>

<?php 

    function getTotalMonths($sDate1, $sdate2=''){
        $date1 = $sDate1;
        $date2 = $sdate2 = '' ? date('Y-m-d') : $sdate2 ;
        $d1=new DateTime($date2); 
        $d2=new DateTime($date1);                                  
        $Months = $d2->diff($d1); 
        return (($Months->y) * 12) + ($Months->m) + 1;
    }

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
    .revenue-logo{
        display: block; 
        margin: 0 auto; 
        margin-bottom: 10px;
    }
</style>