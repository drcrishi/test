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
    </tr>
    <?php
//    echo "<pre>";
//    print_r($revenueReport);
//    die;
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
    $servicesType = array("","Removal", "Removal", "", "Packing/Unpacking", "Packing/Unpacking", "Storage");
    foreach ($revenueReport as $revenueReportKey => $revenueReportValue) {
        $incCNT++;
        $serviceType = $servicesType[$revenueReportValue['en_movetype']];
        
        if ($state != $revenueReportValue['movingfrom_state']) {
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
                 $total_revenue=0;
                $total_margin=0;
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
                $total_revenue=0;
                $total_margin=0;
            }
        }
        ?>
        <tr>
            <?php
            if ($state == "" || $state != $revenueReportValue['movingfrom_state']) {
                $services="";
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
                $services=$serviceType;
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
            ?>
            <?php
            if ($removal_id == "" || $removal_id != $revenueReportValue['removalist_id']) {
                $removal_id = $revenueReportValue['removalist_id'];
                $client_id = "";
                ?>
                <td><?php  echo $revenueReportValue['removalist']; //if($revenueReportValue['en_movetype'] != 5 && $revenueReportValue['en_movetype'] != 4 ) { ?></td>
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
        </tr>
        <?php
        if ($cntReventRecords == $incCNT) {
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
</table>
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