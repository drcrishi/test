<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white ">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include "template/leftmenu.php"; ?>
        <!-- END HEADER -->

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper full-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content" style="margin-left: 0;">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?php echo base_url("dashboard"); ?>">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Home/Office Price Rules</span>
                        </li>
                    </ul>
                </div>
                <div id="default-values-div">
                    <a class="toggleAnchor collapsed" id="anchorDefault" data-toggle="collapse" href="#collapseDefault" role="button" aria-expanded="false" aria-controls="collapseDefault">
                        <div class="people-wrapper">
                            <div class="mid-center">
                                <h3 class="rule-title">Home/Office - Default Rules <button class="toToggle" id="default-collapse-button" type="button" data-toggle="" data-target="#" data-tocollapse="default-accordion">
                                    <i class="fa fa-arrow-circle-up toggleArrow" style="font-size:24px;float: right;"></i>
                                </button></h3>

                            </div>
                        </div>
                    </a>
                    <div id="collapseDefault" class="collapse">
                        <div class="row pricelist-headings hide-mob">
                            <div class="col-md-1 custom-col col-md-offset-1">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Move type</label>
                            </div>
                            <div class="col-md-3">
                                <div class="col-md-6 custom-col">
                                    <label class="col-md-12 control-label pricelist-form" for="form_control_1">Day From</label>
                                </div>
                                <div class="col-md-6 custom-col">
                                    <label class="col-md-12 control-label pricelist-form" for="form_control_1">Day To</label>
                                </div>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">No. of trucks</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">No. of movers</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Travel Fee</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Client Hour Rate</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Status</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Actions</label>
                            </div>
                        </div>
                        <div class="parent-pricelist-div" id="default-price-rules-container">
                            <?php
                            if (count($pricelistdata) > 0) {
                                $listCounter = 0;
                                foreach ($pricelistdata as $row) {
                                    if ($row['rule_type'] == 1) {
                                        $listCounter++;
                                        ?>
                                        <div class="row pricelist-values" id="default-pricelist-row-<?php echo $listCounter ?>">
                                            <div class="col-md-1 custom-col col-md-offset-1">
                                                <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Move type</label>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <input class="hidden-val" type="hidden" name="pricelistId" id="pricelistId" value="<?php echo $row['pricelist_id'] ?>">
                                                        <input type="hidden" name="ruleType" id="ruleType" value="<?php echo $row['rule_type'] ?>">
                                                        <input type="submit" class="submit-button" style="display:none">
                                                        <select class="form-control" id="movetype" name="movetype">
                                                            <?php
                                                            $movetype = array(
                                                                '1' => 'Home',
                                                                '2' => 'Office'
                                                            );
                                                            foreach ($movetype as $key => $value) {
                                                                ?>
                                                                <option <?php echo $key == $row['movetype'] ? "selected" : ''; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        </select>
                                                        <span class="error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-md-6 custom-col">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Day From</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-12">
                                                                <select class="form-control" id="dayFrom" name="dayFrom">
                                                                    <?php
                                                                    $daysArr = array(
                                                                        '0' => 'Sunday',
                                                                        '1' => 'Monday',
                                                                        '2' => 'Tuesday',
                                                                        '3' => 'Wednesday',
                                                                        '4' => 'Thursday',
                                                                        '5' => 'Friday',
                                                                        '6' => 'Saturday'
                                                                    );
                                                                    foreach ($daysArr as $key => $value) {
                                                                        ?>
                                                                        <option <?php echo $key == $row['day_from'] ? "selected" : ''; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 custom-col">
                                                        <div class="form-group">
                                                             <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Day To</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-12">
                                                                <select class="form-control" id="dayTo" name="dayTo">
                                                                    <?php
                                                                    foreach ($daysArr as $key => $value) {
                                                                        ?><option <?php echo $key == $row['day_to'] ? "selected" : ''; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">No. of trucks</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <select class="form-control" id="noOfTrucks" name="noOfTrucks">
                                                            <?php
                                                            $trucksArr = array('1', '2', '3');
                                                            foreach ($trucksArr as $truckRow) {
                                                                ?>
                                                                <option <?php echo $truckRow == $row['no_of_trucks'] ? "selected" : ''; ?> value="<?php echo $truckRow ?>"><?php echo $truckRow ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">No. of movers</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <select class="form-control" id="noOfMovers" name="noOfMovers">
                                                            <?php
                                                            $moversArr = array('2', '3', '4', '5', '6');
                                                            foreach ($moversArr as $moveRow) {
                                                                ?>
                                                                <option <?php echo $moveRow == $row['no_of_movers'] ? "selected" : ''; ?> value="<?php echo $moveRow ?>"><?php echo $moveRow ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Travel Fee</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="travelFee" id="travelFee" value="<?php echo $row['travel_fee'] ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Client Hour Rate</label>
                                                <div class="form-group">
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="clientHourRate" id="clientHourRate" value="<?php echo $row['client_hour_rate'] ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 col-auto control-label pricelist-form hide-desk" for="form_control_1">Status</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12 col-auto text-center">
                                                        <label class="switch">
                                                            <input class="status-class" type="checkbox" value="<?php echo $row['status']; ?>" <?php echo $row['status'] == '1' ? "checked" : ''; ?> name="priceListStatus" id="priceListStatus">
                                                            <span class="slider round"></span>
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col text-center">
                                                 <label class="col-md-12 control-label col-auto pricelist-form hide-desk" for="form_control_1">Actions</label>
                                                <div class="form-group col-auto action-button">
                                                    
                                                    <div class="col-md-4 custom-col">
                                                        <a class="update-pricelist" title="Update" data-pricelist-id="<?php echo $row['pricelist_id'] ?>">
                                                            <i class="fa fa-save fa-lg"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4 custom-col">
                                                        <a class="delete-pricelist" title="Delete" data-pricelist-id="<?php echo $row['pricelist_id'] ?>">
                                                            <i class="fa fa-trash fa-lg"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4 custom-col">
                                                        <a class="copy-pricelist" title="Copy" data-type="default" data-pricelist-id="<?php echo $row['pricelist_id'] ?>">
                                                            <i class="fa fa-copy fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        } 
                        if($listCounter == 0) {
                            echo "<div class='row default-no-records-found nrf'>No records found.</div>";
                        }
                        ?>
                        </div>
                        <div class="row add-price-row text-center">
                            <button type="button" class="add-new-pricelist" onclick="clonePricelistDiv('default')">Add New</button>
                        </div>
                    </div>
                </div>

                <div id="custom-values-div">
                    <a class="toggleAnchor collapsed" id="anchorCustom" data-toggle="collapse" href="#collapseCustom" role="button" aria-expanded="false" aria-controls="collapseCustom">
                        <div class="people-wrapper">
                            <div class="mid-center">
                                <h3 class="rule-title">Home/Office - Custom Rules <button class="toToggle" id="custom-collapse-button" type="button" data-toggle="" data-target="#" data-tocollapse="custom-accordion"><i class="fa fa-arrow-circle-up toggleArrow" style="font-size:24px;float: right;"></i></button></h3>
                            </div>
                        </div>
                    </a>
                    <div id="collapseCustom" class="collapse">
                        <div class="row pricelist-headings hide-mob no-margin">
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Move type</label>
                            </div>
                            <div class="col-md-2 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">States</label>
                            </div>
                            <div class="col-md-3">
                                <div class="col-md-6 custom-col">
                                    <label class="col-md-12 control-label pricelist-form" for="form_control_1">Day From</label>
                                </div>
                                <div class="col-md-6 custom-col">
                                    <label class="col-md-12 control-label pricelist-form" for="form_control_1">Day To</label>
                                </div>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">No. of trucks</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">No. of movers</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Travel Fee</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Client Hour Rate</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Status</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Actions</label>
                            </div>
                        </div>
                        <div class="parent-pricelist-div" id="custom-price-rules-container">
                            <?php
                            if (count($pricelistdata) > 0) {
                                $listCounter = 0;
                                foreach ($pricelistdata as $row) {
                                    if ($row['rule_type'] == 2) {
                                        $listCounter++;
                                        ?>
                                        <div class="row no-margin pricelist-values" id="custom-pricelist-row-<?php echo $listCounter ?>">
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Move type</label>
                                                    <div class="col-md-12">
                                                        <input class="hidden-val" type="hidden" name="pricelistId" id="pricelistId" value="<?php echo $row['pricelist_id'] ?>">
                                                        <input type="hidden" name="ruleType" id="ruleType" value="<?php echo $row['rule_type'] ?>">
                                                        <input type="submit" class="submit-button" style="display:none">
                                                        <select class="form-control" id="movetype" name="movetype">
                                                            <?php
                                                            $movetype = array(
                                                                '1' => 'Home',
                                                                '2' => 'Office'
                                                            );
                                                            foreach ($movetype as $key => $value) {
                                                                ?>
                                                                <option <?php echo $key == $row['movetype'] ? "selected" : ''; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                        </select>
                                                        <span class="error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">States</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <select class="form-control selectStates select2-js" data-live-search="true" id="states-<?php echo $listCounter; ?>" name="states[]" multiple >
                                                        <?php
                                                            if (isset($row['states'])) {
                                                                $decodedState = explode(',', $row['states']);
                                                            }
                                                            $statesArr = array('All', 'NSW', 'VIC', 'QLD', 'WA', 'SA');

                                                            $allStatesArr = array('NSW', 'VIC', 'QLD', 'WA','SA');

                                                            if (count($decodedState) == '5') {
                                                                ?>
                                                                <option data-tokens="All" selected value='All'>All</option>
                                                                <?php
                                                                foreach ($allStatesArr as $stateRow) {
                                                                    ?>
                                                                    <option data-tokens="<?php echo $stateRow ?>" value='<?php echo $stateRow ?>'><?php echo $stateRow ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            foreach ($statesArr as $stateRow) {
                                                                ?>
                                                                    <option <?php
                                                                            if ((in_array($stateRow, $decodedState)) && $stateFlag != '1') {
                                                                                echo 'selected';
                                                                            } else {
                                                                                echo '';
                                                                            }
                                                                            ?> value="<?php echo $stateRow ?>"><?php echo $stateRow ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row">
                                                    <div class="col-md-6 custom-col">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Day From</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-12">
                                                                <select class="form-control" id="dayFrom" name="dayFrom">
                                                                    <?php
                                                                    $daysArr = array(
                                                                        '0' => 'Sunday',
                                                                        '1' => 'Monday',
                                                                        '2' => 'Tuesday',
                                                                        '3' => 'Wednesday',
                                                                        '4' => 'Thursday',
                                                                        '5' => 'Friday',
                                                                        '6' => 'Saturday'
                                                                    );
                                                                    foreach ($daysArr as $key => $value) {
                                                                        ?>
                                                                        <option <?php echo $key == $row['day_from'] ? "selected" : ''; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 custom-col">
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Day To</label>
                                                            <span class="error"></span>
                                                            <div class="col-md-12">
                                                                <select class="form-control" id="dayTo" name="dayTo">
                                                                    <?php
                                                                    foreach ($daysArr as $key => $value) {
                                                                        ?><option <?php echo $key == $row['day_to'] ? "selected" : ''; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">No. of trucks</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <select class="form-control" id="noOfTrucks" name="noOfTrucks">
                                                            <?php
                                                            $trucksArr = array('1', '2', '3');
                                                            foreach ($trucksArr as $truckRow) {
                                                                ?>
                                                                <option <?php echo $truckRow == $row['no_of_trucks'] ? "selected" : ''; ?> value="<?php echo $truckRow ?>"><?php echo $truckRow ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">No. of movers</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <select class="form-control" id="noOfMovers" name="noOfMovers">
                                                            <?php
                                                            $moversArr = array('2', '3', '4', '5', '6');
                                                            foreach ($moversArr as $moveRow) {
                                                                ?>
                                                                <option <?php echo $moveRow == $row['no_of_movers'] ? "selected" : ''; ?> value="<?php echo $moveRow ?>"><?php echo $moveRow ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Travel Fee</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="travelFee" id="travelFee" value="<?php echo $row['travel_fee'] ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Client Hour Rate</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="clientHourRate" id="clientHourRate" value="<?php echo $row['client_hour_rate'] ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 col-auto control-label pricelist-form hide-desk" for="form_control_1">Status</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12 col-auto text-center">
                                                        <label class="switch">
                                                            <input class="status-class" type="checkbox" value="<?php echo $row['status']; ?>" <?php echo $row['status'] == '1' ? "checked" : ''; ?> name="priceListStatus" id="priceListStatus">
                                                            <span class="slider round"></span>
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-1 custom-col text-center">
                                                
                                                    <label class="col-md-12 col-auto control-label pricelist-form hide-desk" for="form_control_1">Actions</label>
                                                    <div class="form-group col-auto action-button">
                                                    
                                                    <div class="col-md-4 custom-col">
                                                        <a class="update-pricelist" title="Update" data-pricelist-id="<?php echo $row['pricelist_id'] ?>">
                                                            <i class="fa fa-save fa-lg"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4 custom-col">
                                                        <a class="delete-pricelist" title="Delete" data-pricelist-id="<?php echo $row['pricelist_id'] ?>">
                                                            <i class="fa fa-trash fa-lg"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4 custom-col">
                                                        <a class="copy-pricelist" title="Copy" data-type="custom" data-pricelist-id="<?php echo $row['pricelist_id'] ?>">
                                                            <i class="fa fa-copy fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    <?php
                                }
                            }
                        } 
                        if($listCounter == 0) {
                            echo "<div class='row custom-no-records-found nrf'>No records found.</div>";
                        }
                        ?>
                        </div>
                        <div class="row add-price-row text-center">
                            <button type="button" class="add-new-pricelist" onclick="clonePricelistDiv('custom')">Add New</button>
                        </div>
                    </div>
                </div>

                <div id="holiday-values-div">
                    <a class="toggleAnchor collapsed" id="anchorHoliday" data-toggle="collapse" href="#collapseHoliday" role="button" aria-expanded="false" aria-controls="collapseHoliday">
                        <div class="people-wrapper">
                            <div class="mid-center">
                                <h3 class="rule-title">Home/Office - Holiday Rules <button id="holiday-collapse-button" class="toToggle" type="button" data-toggle="" data-target="#" data-tocollapse="holiday-accordion"><i class="fa fa-arrow-circle-up toggleArrow" style="font-size:24px;float: right;"></i></button></h3>
                            </div>
                        </div>
                    </a>
                    <div id="collapseHoliday" class="collapse">
                        <div class="row no-margin pricelist-headings hide-mob">
                            <div class="col-md-1 custom-col col-md-offset-1">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Move type</label>
                            </div>

                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">States</label>
                            </div>
                            <div class="col-md-2 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Date</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">No. of trucks</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">No. of movers</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Travel Fee</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Client Hour Rate</label>
                            </div>
                            <div class="col-md-1 custom-col">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Status</label>
                            </div>

                            <div class="col-md-1">
                                <label class="col-md-12 control-label pricelist-form" for="form_control_1">Actions</label>
                            </div>
                        </div>
                        <div class="parent-pricelist-div" id="holiday-price-rules-container">
                            <?php
                            if (count($pricelistdata) > 0) {
                                $listCounter = 0;
                                foreach ($pricelistdata as $row) {
                                    if ($row['rule_type'] == 3) {
                                        $listCounter++;
                                        ?>
                                        <div class="row no-margin pricelist-values" id="holiday-pricelist-row-<?php echo $listCounter ?>">
                                            <div class="col-md-1 custom-col col-md-offset-1">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Move type</label>
                                                    <div class="col-md-12">
                                                        <input class="hidden-val" type="hidden" name="pricelistId" id="pricelistId" value="<?php echo $row['pricelist_id'] ?>">
                                                        <input type="hidden" name="ruleType" id="ruleType" value="<?php echo $row['rule_type'] ?>">
                                                        <input type="submit" class="submit-button" style="display:none">
                                                        <select class="form-control" id="movetype" name="movetype">
                                                            <?php
                                                            $movetype = array(
                                                                '1' => 'Home',
                                                                '2' => 'Office'
                                                            );
                                                            foreach ($movetype as $key => $value) {
                                                                ?>
                                                                <option <?php echo $key == $row['movetype'] ? "selected" : ''; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        </select>
                                                        <span class="error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">States</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <select class="form-control selectStates select2-js" data-live-search="true" id="states" name="states[]" multiple >
                                                        <!-- <select class="form-control selectpicker selectStates" data-live-search="true" id="states" name="states[]" multiple > -->
                                                            <?php
                                                            if (isset($row['states'])) {
                                                                $decodedState = explode(',', $row['states']);
                                                            }
                                                            $statesArr = array('All', 'NSW', 'VIC', 'QLD', 'WA', 'SA');

                                                            $allStatesArr = array('NSW', 'VIC', 'QLD', 'WA','SA');

                                                            if (count($decodedState) == '5') {
                                                                ?>
                                                                <option data-tokens="All" selected value='All'>All</option>
                                                                <?php
                                                                foreach ($allStatesArr as $stateRow) {
                                                                    ?>
                                                                    <option data-tokens="<?php echo $stateRow ?>" value='<?php echo $stateRow ?>'><?php echo $stateRow ?></option>
                                                                <?php
                                                            }
                                                        } else {
                                                            foreach ($statesArr as $stateRow) {
                                                                ?>
                                                                    <option <?php
                                                                            if ((in_array($stateRow, $decodedState)) && $stateFlag != '1') {
                                                                                echo 'selected';
                                                                            } else {
                                                                                echo '';
                                                                            }
                                                                            ?> value="<?php echo $stateRow ?>"><?php echo $stateRow ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 custom-col">
                                                <div class="form-group" id="serviceDate">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Date</label>
                                                    <?php $decodedDate = explode(',', $row['dates']); ?>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <input class="form-control date-picker multiPicker" value="<?php echo implode(",", $decodedDate); ?>" id="datefrom<?php echo $listCounter; ?>" name="datefrom" type="text" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">No. of trucks</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <select class="form-control" id="noOfTrucks" name="noOfTrucks">
                                                            <?php
                                                            $trucksArr = array('1', '2', '3');
                                                            foreach ($trucksArr as $truckRow) {
                                                                ?>
                                                                <option <?php echo $truckRow == $row['no_of_trucks'] ? "selected" : ''; ?> value="<?php echo $truckRow ?>"><?php echo $truckRow ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">No. of movers</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <select class="form-control" id="noOfMovers" name="noOfMovers">
                                                            <?php
                                                            $moversArr = array('2', '3', '4', '5', '6');
                                                            foreach ($moversArr as $moveRow) {
                                                                ?>
                                                                <option <?php echo $moveRow == $row['no_of_movers'] ? "selected" : ''; ?> value="<?php echo $moveRow ?>"><?php echo $moveRow ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Travel Fee</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="travelFee" id="travelFee" value="<?php echo $row['travel_fee'] ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Client Hour Rate</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="clientHourRate" id="clientHourRate" value="<?php echo $row['client_hour_rate'] ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 custom-col">
                                                <div class="form-group">
                                                    <label class="col-md-12 col-auto control-label pricelist-form hide-desk" for="form_control_1">Status</label>
                                                    <span class="error"></span>
                                                    <div class="col-md-12 col-auto text-center">
                                                        <label class="switch">
                                                            <input class="status-class" type="checkbox" value="<?php echo $row['status']; ?>" <?php echo $row['status'] == '1' ? "checked" : ''; ?> name="priceListStatus" id="priceListStatus">
                                                            <span class="slider round"></span>
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-1 custom-col text-center">
                                                <label class="col-md-12 col-auto control-label pricelist-form hide-desk" for="form_control_1">Actions</label>
                                                <div class="form-group col-auto action-button">
                                                    
                                                    <div class="col-md-4 custom-col">
                                                        <a class="update-pricelist" title="Update" data-pricelist-id="<?php echo $row['pricelist_id'] ?>">
                                                            <i class="fa fa-save fa-lg"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4 custom-col">
                                                        <a class="delete-pricelist" title="Delete" data-pricelist-id="<?php echo $row['pricelist_id'] ?>">
                                                            <i class="fa fa-trash fa-lg"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4 custom-col">
                                                        <a class="copy-pricelist" title="Copy" data-type="holiday" data-pricelist-id="<?php echo $row['pricelist_id'] ?>">
                                                            <i class="fa fa-copy fa-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                }
                            }
                        } 
                        if($listCounter == 0) {
                            echo "<div class='row holiday-no-records-found nrf'>No records found.</div>";
                        }
                        ?>
                        </div>
                        <div class="row add-price-row text-center">
                            <button type="button" class="add-new-pricelist" onclick="clonePricelistDiv('holiday')">Add New</button>
                        </div>
                    </div>
                </div>

                <!-- div used to add new start-->
                <div style="display:none">
                    <div id="duplicate-row">
                        <div class="row no-margin pricelist-values">
                            <div class="col-md-1 custom-col col-md-offset-1">
                                <div class="form-group">
                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Move type</label>
                                    <span class="error"></span>
                                    <div class="col-md-12">
                                        <input class="hidden-val" type="hidden" name="pricelistId" id="pricelistId">
                                        <input type="hidden" name="ruleType" id="ruleType" value="">
                                        <input type="submit" class="submit-button" style="display:none">
                                        <select class="form-control" id="movetype" name="movetype">
                                            <?php
                                            $movetype = array(
                                                '1' => 'Home',
                                                '2' => 'Office'
                                            );
                                            foreach ($movetype as $key => $value) {
                                                ?>
                                                <option value="<?php echo $key ?>"><?php echo $value ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 custom-col states-show">
                                <div class="form-group">
                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">States</label>
                                    <span class="error"></span>
                                    <div class="col-md-12">
                                        <select class="form-control selectStates select2-js" data-live-search="true" id="states" name="states[]" multiple>
                                        <!-- <select class="form-control selectpicker selectStates" data-live-search="true" id="states" name="states[]" multiple> -->
                                            <?php
                                            $statesArr = array('All', 'NSW', 'VIC', 'QLD', 'WA', 'SA');
                                            foreach ($statesArr as $stateRow) {
                                                ?>
                                                <option <?php echo $stateRow == 'All' ? 'selected' : ''; ?> value="<?php echo $stateRow ?>"><?php echo $stateRow ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 default-and-custom-show">
                                <div class="row">
                                    <div class="col-md-6 custom-col">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Day From</label>
                                            <span class="error"></span>
                                            <div class="col-md-12">
                                                <select class="form-control" id="dayFrom" name="dayFrom">
                                                    <?php
                                                    $daysArr = array(
                                                        '0' => 'Sunday',
                                                        '1' => 'Monday',
                                                        '2' => 'Tuesday',
                                                        '3' => 'Wednesday',
                                                        '4' => 'Thursday',
                                                        '5' => 'Friday',
                                                        '6' => 'Saturday'
                                                    );
                                                    foreach ($daysArr as $key => $value) {
                                                        ?>
                                                        <option <?php echo $key == $row['day_from'] ? "selected" : ''; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 custom-col">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Day To</label>
                                            <span class="error"></span>
                                            <div class="col-md-12">
                                                <select class="form-control" id="dayTo" name="dayTo">
                                                    <?php
                                                    foreach ($daysArr as $key => $value) {
                                                        ?><option <?php echo $key == $row['day_to'] ? "selected" : ''; ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 default-day-from-to hide">
                                <div class="row">
                                    <div class="col-md-6 custom-col">
                                        <div class="form-group">
                                            <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Day From</label>
                                            <span class="error"></span>
                                            <div class="col-md-12">
                                                <label class="form-control text-center readonly-background">Sunday</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 custom-col">
                                        <div class="form-group">
                                             <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Day To</label>
                                            <span class="error"></span>
                                            <div class="col-md-12">
                                                <label class="form-control text-center readonly-background">Saturday</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 custom-col holiday-show packer-hide">
                                <div class="form-group" id="serviceDate">
                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Date</label>
                                    <span class="error"></span>
                                    <div class="col-md-12">
                                        <input class="form-control date-picker multiPicker" value="" id="datefrom" name="datefrom" type="text" readonly >
                                        <!-- <input class="form-control date-picker multiPicker" id="datefrom" name="datefrom"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 custom-col packer-hide">
                                <div class="form-group">
                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">No. of trucks</label>
                                    <span class="error"></span>
                                    <div class="col-md-12">
                                        <select class="form-control" id="noOfTrucks" name="noOfTrucks">
                                            <?php
                                            $trucksArr = array('1', '2', '3');
                                            foreach ($trucksArr as $truckRow) {
                                                ?>
                                                <option <?php echo $truckRow == $row['no_of_trucks'] ? "selected" : ''; ?> value="<?php echo $truckRow ?>"><?php echo $truckRow ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 custom-col packer-hide">
                                <div class="form-group">
                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">No. of movers</label>
                                    <span class="error"></span>
                                    <div class="col-md-12">
                                        <select class="form-control" id="noOfMovers" name="noOfMovers">
                                            <?php
                                            $moversArr = array('2', '3', '4', '5', '6');
                                            foreach ($moversArr as $moveRow) {
                                                ?>
                                                <option <?php echo $moveRow == $row['no_of_movers'] ? "selected" : ''; ?> value="<?php echo $moveRow ?>"><?php echo $moveRow ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 custom-col packer-hide">
                                <div class="form-group">
                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Travel Fee</label>
                                    <span class="error"></span>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="travelFee" id="travelFee" value="<?php echo $row['travel_fee'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 custom-col packer-hide">
                                <div class="form-group">
                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Client Hour Rate</label>
                                    <span class="error"></span>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="clientHourRate" id="clientHourRate" value="<?php echo $row['client_hour_rate'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 custom-col packer-show">
                                <div class="form-group">
                                    <label class="col-md-12 control-label pricelist-form hide-desk" for="form_control_1">Packing Rate</label>
                                    <span class="error"></span>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="perPersonPackingRate" id="perPersonPackingRate" value="<?php echo $row['per_person_packing_rate'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 custom-col">
                                <div class="form-group">
                                    <label class="col-md-12 control-label col-auto pricelist-form hide-desk" for="form_control_1">Status</label>
                                    <span class="error"></span>
                                    <div class="col-md-12 text-center col-auto">
                                        <label class="switch">
                                            <input class="status-class" type="checkbox" value="1" checked name="priceListStatus" id="priceListStatus">
                                            <span class="slider round"></span>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 text-center text-center">
                                <div class="form-group action-button">
                                    <label class="col-md-12 control-label col-auto pricelist-form hide-desk" for="form_control_1">Actions</label>
                                    <div class="form-group col-auto action-button">
                                        
                                        <div class="col-md-4 custom-col">
                                            <a class="update-pricelist" title="Add">
                                                <i class="fa fa-check fa-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-4 custom-col">
                                            <a class="delete-pricelist" title="Delete">
                                                <i class="fa fa-trash fa-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-4 custom-col">
                                            <a class="copy-pricelist" title="Copy" >
                                                <i class="fa fa-copy fa-lg hide"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- duplicate state -->
                <div id='duplicate-state' style="display: none">
                    <select class="form-control selectStates " data-live-search="true" id="states" name="states[]" multiple>
                    <?php
                        $statesArr = array('All', 'NSW', 'VIC', 'QLD', 'WA', 'SA');
                        foreach ($statesArr as $stateRow) {
                            ?>
                            <option <?php echo $stateRow == 'All' ? 'selected' : ''; ?> value="<?php echo $stateRow ?>"><?php echo $stateRow ?></option>
                    <?php
                        }
                    ?>
                    </select>
                </div>

            </div>
        </div>
    </div>
</body>