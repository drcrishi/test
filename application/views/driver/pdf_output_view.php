<?php

if ($enquiry[0]['en_movetype'] == 1) {

    $movetype = "Home";

} else if ($enquiry[0]['en_movetype'] == 2) {

    $movetype = "Office";

} else if ($enquiry[0]['en_movetype'] == 4) {

    $movetype = "Packing";

} else if ($enquiry[0]['en_movetype'] == 5) {

    $movetype = "Unpacking";

} else {

    $movetype = "";

}

if ($enquiry[0]['en_deposit_received'] == 1) {

    $payment = "Paid";

} else {

    $payment = "Unpaid";

}

if ($enquiry[0]['en_movingfrom_street'] != "") {

    $movingfromstreet = $enquiry[0]['en_movingfrom_street'] . ", ";

}

if ($enquiry[0]['en_movingto_street'] != "") {

    $movingtostreet = $enquiry[0]['en_movingto_street'] . ", ";

}

$pickupadd = $movingfromstreet . $enquiry[0]['en_movingfrom_suburb'] . ", " . $enquiry[0]['en_movingfrom_state'] . ", " . $enquiry[0]['en_movingfrom_postcode'];

$dropoffadd = $movingtostreet . $enquiry[0]['en_movingto_suburb'] . ", " . $enquiry[0]['en_movingto_state'] . ", " . $enquiry[0]['en_movingto_postcode'];

if (isset($clientname['contact_phno'])) {

    $clientphone = " - " . $clientname['contact_phno'];

}

if (isset($contactfname)) {

    $movers = $contactfname[0]['contact_fname'] . " " . $contactfname[0]['contact_lname'];

}

if (isset($packersdata)) {

    foreach ($packersdata as $packer) {

        $movers = $packer['contact_fname'] . " " . $packer['contact_lname'];

    }

}

?>

<?php if ($enquiry[0]['en_movetype'] == 1 || $enquiry[0]['en_movetype'] == 2) {

    ?>



    <body style="font-family: Geneva, sans-serif;line-height: 20px; padding:0; margin:0;">

        <div class="page">



            <h2 class="mainheading">

                LOCAL JOB SHEET - <?php echo $movetype; ?></h2>



            <table width="100%">

                <tr>

                    <td 

                        width="35%">Customer Name:

                    </td>

                    <td width="70%"><?php echo $clientname['contact_fname'] . " " . $clientname['contact_lname'] . $clientphone; ?>

                    </td>

                </tr>

                <tr>

                    <td 

                        >Movers Names:

                    </td>

                    <td > <?php //echo $movers;   ?> </td>

                </tr>

                <tr>

                    <td >

                        Pick Up Date:

                    </td>

                    <td><?php echo date('d/m/Y', strtotime($enquiry[0]['en_servicedate'])) . " " . $enquiry[0]['en_servicetime']; ?>



                    </td>

                </tr>

                <tr>

                    <td >

                        Movers Required:

                    </td>

                    <td ><?php echo $enquiry[0]['en_no_of_movers'] . " Movers / " . $enquiry[0]['en_no_of_trucks'] . " truck"; ?>



                    </td>

                </tr>

                <tr>

                    <td >

                        Pick Up Address:

                    </td>

                    <td ><?php echo $pickupadd; ?>

                    </td>

                </tr>

                <tr>

                    <td >

                        Drop Off Address:

                    </td>

                    <td ><?php echo $dropoffadd; ?>

                    </td>

                </tr>

                <tr>

                    <td >

                        Start Time:

                    </td>

                    <td ></td>

                </tr>

                <tr>

                    <td >

                        Finish Time:

                    </td>

                    <td ></td>

                </tr>

                <tr>

                    <td >

                        Total Hours:

                    </td>

                    <td ></td>

                </tr>

                <tr>

                    <td >

                        Hourly Rate:

                    </td>

                    <td ><?php echo "$" . $enquiry[0]['en_client_hourly_rate']; ?>

                    </td>

                </tr>

                <tr>

                    <td>

                        Travelling Fee:

                    </td>

                    <td><?php echo "$" . $enquiry[0]['en_travelfee']; ?>

                    </td>

                </tr>

                <tr>

                    <td>

                        Total Amount:

                    </td>

                    <td ></td>

                </tr>

                <tr>

                    <td >

                        Deposit Already Paid:

                    </td>

                    <td ><?php echo "$" . $enquiry[0]['en_deposit_amt']; ?>

                        (By Credit Card)

                    </td>

                </tr>

                <tr>

                    <td >

                        Amount Due Now:

                    </td>

                    <td ></td>

                </tr>

                <tr>

                    <td >

                        Notes: 

                    </td>

                    <td ><?php echo $enquiry[0]['en_note']; ?></td>

                </tr>

                <tr>

                    <td 

                        valign="top">Payment:<br/> (Tick appropriate box - If

                        credit card, write details in space provided.

                    </td>

                    <td >

                        <table width="325" border="0">

                            <tr>

                                <td 

                                    valign="top">[&nbsp;&nbsp;]

                                </td>

                                <td 

                                    valign="top">1. Charge the following Visa or

                                    MasterCard:<br/>Name on card:<br/>Expiry

                                    date<br/>Card Number:<br/>3-digit security

                                    code:

                                </td>

                            </tr>

                            <tr>

                                <td 

                                    valign="top">[&nbsp;&nbsp;]

                                </td>

                                <td 

                                    valign="top">2. Charge the same credit card

                                    used for the deposit

                                </td>

                            </tr>

                            <tr>

                                <td 

                                    valign="top">[&nbsp;&nbsp;]

                                </td>

                                <td 

                                    valign="top">3. Pay with cash

                                </td>

                            </tr>

                            <tr>

                                <td 

                                    valign="top">[&nbsp;&nbsp;]

                                </td>

                                <td 

                                    valign="top">4. Head Office will arrange payment

                                </td>

                            </tr>

                        </table>

                    </td>

                </tr>

            </table>

            <p class="sign">I hereby agree with the charges listed above. I authorise Hire A Mover to charge my credit card for the Amount Due as listed above; Please check all of your property + common area before the end of the job and report to our office immediately if you find any loss or damage.</p>

            <br/>

            <table border="0" align="center" style="max-width: 400px;width: 400px !important;">

                <tr>

                    <td 

                        width="150">

                        .............................................

                    </td>

                    <td 

                        width="100">&nbsp;</td>

                    <td 

                        width="150">

                        .............................................

                    </td>

                </tr>

                <tr>

                    <td 

                        align="center">(Customer Signature)

                    </td>

                    <td 

                        width="100">&nbsp;</td>

                    <td 

                        align="center">(Date)

                    </td>

                </tr>

            </table>



            <p align="center">Thank you for choosing Hire A Mover, we hope we

                can be of assistance next time.<br/>Hire A Mover Pty Ltd, 22-24

                Junction Street, Forest Lodge NSW 2037<br/>Ph. 1300 358 700 <a

                    href="http://www.hireamover.com.au">www.hireamover.com.au</a>

                <br /><br /><img src="<?php echo base_url('assets/pages/img/logo-big.png'); ?>" alt="" height="85" align="center"/>

            </p>

        </div>

        <script type="text/javascript">

            window.print();

        </script>

    </body>

<?php } else { ?> 



    <body style="font-family: Geneva, sans-serif;line-height: 20px; padding:0; margin:0;">

        <div class="page">

            <?php if ($enquiry[0]['en_movetype'] == 4) {

                ?><h2 class="mainheading">Packing JOB SHEET</h2>



            <?php } else if ($enquiry[0]['en_movetype'] == 5) {

                ?><h2 class="mainheading">Unpacking JOB SHEET</h2>



            <?php } ?>

            <!--<h2 style="text-transform: uppercase;margin-top:0px;padding:0px;margin-bottom:10px;font-size:20px;font-weight:900;">Packing JOB SHEET</h2>-->

            <table>

                <tbody>

                    <tr>

                        <td width="40%">Customer Name: </td>

                        <td width="60%"><?php echo $clientname['contact_fname'] . " " . $clientname['contact_lname']; ?></td>

                    </tr>
                    <?php if ($enquiry[0]['en_movetype'] == 4) { ?>
                        <tr>
                            <td> Packing Address: </td>
                            <td><?php echo $pickupadd; ?></td>
                        </tr>
                    <?php } ?>
                    <?php if ($enquiry[0]['en_movetype'] == 5) { ?>
                        <tr>
                            <td> Unpacking Address: </td>
                            <td><?php echo $dropoffadd; ?></td>
                        </tr>
                    <?php } ?>
                    <tr>

                        <td>Phone Number: </td>

                        <td><?php echo $clientname['contact_phno']; ?> </td>

                    </tr>
                    <tr>
                        <td> Notes: </td>
                        <td><?php echo $enquiry[0]['en_note']; ?></td>
                    </tr>
                    <tr>

                        <td width="40%" valign="top">Staff: </td>

                        <td width="60%"><?php

                            if (isset($packersdata)) {

                                foreach ($packersdata as $packer) {

                                   echo  $movers = $packer['contact_fname'] . " " . $packer['contact_lname']."<br/>";

                                }

                                

                            }



                            // echo $movers;

                            ?> </td>

                    </tr>

                    <tr>

                        <td> Date: </td>

                        <td> <?php echo date('d/m/Y', strtotime($enquiry[0]['en_servicedate'])); ?> </td>

                    </tr>

                    <tr>

                        <td> Time Booked: </td>

                        <td><?php echo $enquiry[0]['en_servicetime']; ?> </td>

                    </tr>

                    <?php if ($enquiry[0]['en_movetype'] == 4) { ?>

                        <tr>

                            <td> Service Requested: </td>

                            <td> Packing </td>

                        </tr>

                        <tr>

                            <td> Packing Address: </td>

                            <td><?php echo $pickupadd; ?></td>

                        </tr>

                    <?php } ?>

                    <?php if ($enquiry[0]['en_movetype'] == 5) { ?>

                        <tr>

                            <td> Service Requested: </td>

                            <td> Unpacking </td>

                        </tr>

                        <tr>

                            <td> Unpacking Address: </td>

                            <td><?php echo $dropoffadd; ?></td>

                        </tr>

                    <?php } ?>

                    <tr>

                        <td> Payment Status: </td>

                        <td> <?php echo $payment; ?> </td>

                    </tr>

                    <tr>

                        <td>Additional time requested<br><i>(billed in 15 minute increments $15 <br>per 15 mins per packer)</i></td>

                        <!--td> Additional hours requested<br><i>($50 per hour per     packer)</i></td--> 

                        <td></td>

                    </tr>
                    <?php
                    if ($enquiry[0]['en_movetype'] == 4){
                    ?>
                        <tr>
                            <td>Items Purchased
                                <br>
                                1 bundle of wrapping paper $18
                                <br>
                                Medium book carton $3.30
                                <br>
                                Large tea chest box $4.25
                                <br>
                                Tape roll $3.85
                            </td>
                            <!--td> Additional hours requested<br><i>($50 per hour per packer)</i></td-->
                            <td></td>
                        </tr>
                    <?php    
                    }
                    ?>
                    <tr>

                        <td> Additional Amount Due: </td>
                        <td>&nbsp;&nbsp;<br>&nbsp;&nbsp;<br></td>
                    </tr>
                    <tr>

                        <td valign="top">Payment:<br> (Tick appropriate box - If credit card, write details in space provided. </td>

                        <td>

                            <table width="325" border="0">

                                <tbody>

                                    <tr>

                                        <td valign="top">[&nbsp;&nbsp;] </td>

                                        <td valign="top">1. Charge the following Visa or MasterCard:<br>Name on card:<br>Expiry date<br>Card Number:<br>3-digit security code: </td>

                                    </tr>

                                    <tr>

                                        <td valign="top">[&nbsp;&nbsp;] </td>

                                        <td valign="top">2. Charge the same credit card used for the deposit </td>

                                    </tr>

                                    <!-- <tr>

                                        <td valign="top">[&nbsp;&nbsp;] </td>

                                        <td valign="top">3. Pay with cash </td>

                                    </tr> -->

                                </tbody>

                            </table>

                        </td>

                    </tr>

                    <tr>

                        <td> Customer Feedback: </td>

                        <td> <br><br><br><br></td>

                    </tr>

                </tbody>

            </table>

            <ul>

                <li>I hereby authorize Hire A Packer to charge my credit card for the Amount Due as listed above;<br></li>

                <li>This form is not to be used as a tax invoice.<br></li>

            </ul>

            <p>&nbsp;<br /></p>

            <table width="400" border="0" align="center">

                <tbody>

                    <tr>

                        <td width="150"> ............................................. </td>

                        <td width="100">&nbsp;</td>

                        <td width="150"> ............................................. </td>

                    </tr>

                    <tr>

                        <td align="center">(Customer Signature)</td>

                        <td width="100">&nbsp;</td>

                        <td align="center">(Date)</td>

                    </tr>

                </tbody>

            </table>

            <p>&nbsp;</p>

            <p align="center">Thank you for choosing Hire A Packer, we hope we can be of assistance next time.<br>Hire A Packer Pty Ltd, 1/34 James Craig Road, Rozelle NSW 2039<br>Ph. 1300 366 522 <a    href="http://www.hireapacker.com.au">www.hireapacker.com.au</a></p>

            <!-- <p align="center"><img src="https://crm.hireamover.com.au/assets/pages/img/HireAPacker-Logo.png" height="85" align="center" /></p> -->

            <!-- <p align="center"><img src="<?php echo base_url('assets/pages/img/logo-big.png'); ?>" height="85" align="center" /></p> -->

            <p align="center"><img src="https://hireapacker.com.au/wp-content/uploads/2018/12/HireAPacker-Logo-287x54.png" width="150" align="center" /></p>

        </div>

    <?php } ?>

