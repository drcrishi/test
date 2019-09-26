<?php
//    echo "<pre>";
//    print_r($bookingPDF);
//    die;
$company_add = explode(", ", $bankdata[0]['company_address']);
$bank_add = explode(", ", $bankdata[0]['bank_detail']);
$total_sellprice = $bookingPDF[0]['en_total_sellprice'];
$taxrate = $bankdata[0]['gst'];
$basePrice = number_format(($total_sellprice * $taxrate) / (100 + $taxrate), 2);
if ($bookingPDF[0]['clientCompanyname'] != "") {
//    $clienCompanyname = " from " . $bookingPDF[0]['clientCompanyname'];
    $clienCompanyname = $bookingPDF[0]['clientCompanyname'];
}
if($bookingPDF[0]['en_movingfrom_street'] != ""){
  $fromadd =  $bookingPDF[0]['en_movingfrom_street']." ".$bookingPDF[0]['en_movingfrom_suburb']; 
}else{
   $fromadd = $bookingPDF[0]['en_movingfrom_suburb'];
}
if($bookingPDF[0]['en_movingto_street'] != ""){
    $toadd =  $bookingPDF[0]['en_movingto_street']." ".$bookingPDF[0]['en_movingto_suburb']; 
}else{
    $toadd = $bookingPDF[0]['en_movingto_suburb']; 
}
?>

<body style="font-family: Geneva, sans-serif;">

    <div id="page-wrap">
        <div style="width: 100%">
            <div id="identity" style="float:left; width: 63%;">
                <p style="margin-bottom:8px; font-size: 14px"><?php echo $company_add[0]; ?></p>
                <p style="margin:0; font-size: 14px"><?php echo $company_add[1]; ?></p>
                <p style="margin:0; font-size: 14px"><?php echo $company_add[2]; ?></p>
            </div>

            <div class="invoice-date" style="float:right; width: 28%;">
                <h2 style="text-align:center; font-size: 24px; margin-bottom:3px;">Tax Invoice</h2>
                <table style="width:100%;">
                    <tr>
                        <td style="text-align:center; font-size: 13px">Date</td>
                        <td style="text-align:center; font-size: 13px">Tax Invoice #</td>
                    </tr>
                    <tr>
                        <td style="text-align:center; font-size: 12px"><?php echo date("d/m/Y", strtotime($bookingPDF[0]['en_servicedate'])); ?></td>
                        <td style="text-align:center; font-size: 12px"><?php echo $bookingPDF[0]['enquiry_id']; ?></td>
                    </tr>
                </table>
            </div>
        </div>	
        <div style="clear:both;"></div>

        <div id="customer">
             <table align="right" width="370" style="float:left; display: inline-block; position: fixed; margin-left:0;">
                <tr>
                    <td style="border:0;">
                        <?php if ($bookingPDF[0]['en_deposit_received'] == 1) {
                            ?> 
                        <img src="<?php echo base_url('assets/custom/img/paid.png'); ?>" alt="Invoice status" style="width:120px; right:0; float: right;">
                        <?php } else {
                            ?>   
                        <img src="<?php echo base_url('assets/custom/img/unpaid.png'); ?>" alt="Invoice status" style="width:120px; right:0; float: right;">
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <table width="350">
                <tr>
                    <td style="font-size: 12px">Tax Invoice To</td>
                </tr>
                <tr>
                    <td style="height:100px; vertical-align:top;font-size: 12px"><p><?php echo $bookingPDF[0]['clientFname'] . " " . $bookingPDF[0]['clientLname'] ; ?></p><p><?php echo $clienCompanyname; ?></p></td>
                </tr>
            </table>
        </div>

        <div style="clear:both;"></div>
        <table style="float:right; margin-top:40px; width:330px;" align="right">
            <tr>
                <td style="text-align:center; font-size: 13px">P.O. No.</td>
                <td style="text-align:center; font-size: 13px">Terms</td>
                <td style="text-align:center; font-size: 13px">Project</td>
            </tr>
            <tr>
                <td style="text-align:center; font-size: 12px; border-bottom: 0;">&nbsp;</td>
                <td style="text-align:center; font-size: 12px; border-bottom: 0;">&nbsp;</td>
                <td style="text-align:center; font-size: 12px; border-bottom: 0;">&nbsp;</td>
            </tr>
        </table>

        <table id="items" style="margin-top:0px; padding-top: 0; width:100%;">
            <tr>
                <td style="text-align:center; font-size:13px;">Description</td>
                <td style="text-align:center; font-size:13px;">Qty</td>
                <td style="text-align:center; font-size:13px;">Rate</td>
                <td style="text-align:center; font-size:13px;">Tax</td>
                <td style="text-align:center; font-size:13px;">TAX AMT</td>
                <td style="text-align:center; font-size:13px;">Amount</td>
            </tr>
            <tr>
                <td style="font-size:12px; height:250px; vertical-align: top;">
                    <?php
                    if ($bookingPDF[0]['en_movetype'] == 1 || $bookingPDF[0]['en_movetype'] == 2) {
                        $moveType = "Removal";
                        $address = $fromadd." to ".$toadd;
                    } else if($bookingPDF[0]['en_movetype'] == 4) {
                        $moveType = "Packing";
                        $address = $fromadd;
                    }else if($bookingPDF[0]['en_movetype'] == 5){
                        $moveType = "Unpacking";
                        $address = $toadd;
                    }
                    ?> <?php echo $moveType; ?> services <?php echo date("jS F Y", strtotime($bookingPDF[0]['en_servicedate'])).". ".$address; ?></td>
                <td style="font-size:12px; height:250px; vertical-align: top; width: 70px;">1</td>
                <td style="text-align:right; font-size:12px; height:250px; vertical-align: top; width: 70px;"><?php echo $total_sellprice; ?></td>
                <td style="font-size:12px; height:250px; vertical-align: top; width: 70px;">GST</td>
                <td style="text-align:right; font-size:12px; height:250px; vertical-align: top; width: 70px;"><?php echo $basePrice; ?></td>
                <td style="text-align:right; font-size:12px; height:250px; vertical-align: top; width: 70px;"><?php echo $total_sellprice; ?></td>
            </tr>
            <tr>
                <td rowspan="4" colspan="2">
                    <h4 style="font-size:13px;">Tax Summary</h4>
                    <p style="font-size:12px;">GST <?php echo $basePrice; ?>;</p>
                    <table style="margin-top: 8px;">
                        <tr>
                            <td style="width:300px; border:1px solid #000;padding:7px; text-align:center; ">
                                <p style="font-size:12px;">BANK ACCOUNT DETAILS FOR</p>
                                <p style="font-size:12px;">EFT PAYMENT</p>
                                <p style="font-size:12px;"><?php echo $bank_add[0]; ?></p>
                                <p style="font-size:12px;"><?php echo $bank_add[1]; ?></p>
                                <p style="font-size:12px;"><?php echo $bank_add[2]; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="4">
                    <table style="width:100%" border="0">
                        <tr>
                            <td style="border:0; font-size:14px;"><strong>Subtotal</strong></td>
                            <td style="border:0; text-align:right; font-size:14px;">
                                <?php
                                $total = $total_sellprice - $basePrice;
                                ?>$<?php echo $total; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table style="width:100%" border="0">
                        <tr>
                            <td style="border:0; font-size:14px;"><strong>Tax</strong></td>
                            <td style="border:0; text-align:right; font-size:14px;">$<?php echo $basePrice; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table style="width:100%" border="0">
                        <tr>
                            <td style="border:0; font-size:18px;"><strong>Total</strong></td>
                            <td style="border:0; text-align:right; font-size:16px;">$<?php echo $total_sellprice; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table style="width:100%" border="0">
                        <tr>
                            <td style="border:0; font-size:14px;"><strong>Payments/Credits</strong></td>
                            <td style="border:0; text-align:right; font-size:14px;">-$<?php 
                            if($bookingPDF[0]['en_deposit_received'] == 1){$payment = $total_sellprice;}else{$payment = "0.00";}
                            echo $payment; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td colspan="4">
                    <table style="width:100%" border="0">
                        <tr>
                            <td style="border:0; font-size:14px;"><strong>Balance Due</strong></td>
                            <td style="border:0; text-align:right; font-size:14px;">$<?php 
                            if($bookingPDF[0]['en_deposit_received'] == 1){$balancedue = $total_sellprice - $total_sellprice;}else{$balancedue = $total_sellprice;}
                            echo $balancedue; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table width="400" style="margin-top:50px;">
            <tr>
                <td style="text-align:center; font-size: 12px">Company Business Number</td>
                <td style="text-align:center; font-size: 12px"><?php echo $bankdata[0]['company_no']; ?></td>
            </tr>
        </table>
    </div>
<!--    <script type="text/javascript">
        window.print();
    </script>-->
</body>
<style type="text/css">
    /*
         CSS-Tricks Example
         by Chris Coyier
         http://css-tricks.com
    */

    body{font-family: "Geneva", sans-serif;}
    * { margin: 0; padding: 0; }
    #page-wrap { width: 800px; margin: 0 auto; }

    /*    textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }*/
    table { border-collapse: collapse; }
    table td, table th { border: 1px solid black; padding: 5px; }


</style>
</html>

