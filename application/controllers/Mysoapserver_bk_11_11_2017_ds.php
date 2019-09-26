<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mysoapserver extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->model(''); //load your models here


        $this->load->library("Nusoap_lib"); //load the library here
        $this->nusoap_server = new soap_server();
        $this->nusoap_server->configureWSDL('CRM Soap API', "urn:MySoapServer");


//        if ($_SERVER['PHP_AUTH_USER'] != "hireabox" || $_SERVER['PHP_AUTH_PW'] != "a9uLYZVLRoMFewewwHxHQD4eCsQdxknM") {
//            header('WWW-Authenticate: Basic realm="My Realm"');
//            header('HTTP/1.0 401 Unauthorized');
//            echo 'Text to send if user hits Cancel button';
//            return new soap_fault('-1', 'Server', 'Parameters missing for echoTest().', 'Please refer documentation.');
//            exit;
//        } else {
//            echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
//            echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
//        }




        $this->nusoap_server->wsdl->addComplexType(
                'userInfo', 'complexType', 'struct', 'sequence', '', array(
            'id' => array(
                'name' => 'id',
                'type' => 'xsd:string'
            ),
            'username' => array(
                'name' => 'username',
                'type' => 'xsd:string'
            ),
            'email' => array(
                'name' => 'email',
                'type' => 'xsd:string')
                )
        );
        $this->nusoap_server->wsdl->addComplexType(
                'setEnqiryDataArrayStruct', 'complexType', 'struct', 'sequence', '', array(
            'contact_reltype' => array(
                'name' => 'contact_reltype',
                'type' => 'xsd:string'
            ),
            'contact_fname' => array(
                'name' => 'contact_fname',
                'type' => 'xsd:string'
            ),
            'contact_lname' => array(
                'name' => 'contact_lname',
                'type' => 'xsd:string')
            ,
            'contact_email' => array(
                'name' => 'contact_email',
                'type' => 'xsd:string')
            ,
            'contact_phno' => array(
                'name' => 'contact_phno',
                'type' => 'xsd:string')
                )
        );


//        $this->nusoap_server->register(
//                "echoTest", array("tmp" => "xsd:string"), array("return" => "xsd:string"), "urn:MySoapServer", "urn:MySoapServer#echoTest", "rpc", "encoded", "Echo test"
//        );
//        $this->nusoap_server->register(
//                "insert2", array("userTest" => "tns:enqiryData"), array("returnss" => "tns:userInfo"), "urn:MySoapServer", "urn:MySoapServer#chkConnection", "rpc", "encoded", "Echo test"
//        );
//        $this->nusoap_server->register(
//                "insert", array("userTest_name" => "xsd:string", "userTest_tel" => "xsd:string", "amt" => "xsd:integer"), array("returnss" => "tns:userInfo"), "urn:MySoapServer", "urn:MySoapServer#chkConnection", "rpc", "encoded", "Echo test"
//        );
        $this->nusoap_server->register(
                "setContactEnquiry", array("contactData" => "tns:setEnqiryDataArrayStruct"), array("uuid" => "xsd:string"), "urn:MySoapServer", "setContactData", "rpc", "encoded", ""
        );


        /**
         * Mover Data Logic
         */
        $this->nusoap_server->wsdl->addComplexType(
                'setMoverDataArrayStruct', 'complexType', 'struct', 'sequence', '', array(
            'movetype' => array(
                'name' => 'movetype',
                'type' => 'xsd:integer'
            ),
            'home_office' => array(
                'name' => 'home_office',
                'type' => 'xsd:integer'
            ),
            'servicedate' => array(
                'name' => 'servicedate',
                'type' => 'xsd:string')
            ,
            'servicetime' => array(
                'name' => 'servicetime',
                'type' => 'xsd:string')
            ,
            'deliverydate' => array(
                'name' => 'deliverydate',
                'type' => 'xsd:string')
            ,
            'deliverytime' => array(
                'name' => 'deliverytime',
                'type' => 'xsd:string')
            ,
            'storagedate' => array(
                'name' => 'storagedate',
                'type' => 'xsd:string')
            ,
            'fname' => array(
                'name' => 'fname',
                'type' => 'xsd:string'),
            'lname' => array(
                'name' => 'lname',
                'type' => 'xsd:string'),
            'phone' => array(
                'name' => 'phone',
                'type' => 'xsd:string'),
            'email' => array(
                'name' => 'email',
                'type' => 'xsd:string'),
            'storage_provider' => array(
                'name' => 'storage_provider',
                'type' => 'xsd:string'),
            'storage_address' => array(
                'name' => 'storage_address',
                'type' => 'xsd:string'),
            'storage_phno' => array(
                'name' => 'storage_phno',
                'type' => 'xsd:string'),
            'movingfrom' => array(
                'name' => 'movingfrom',
                'type' => 'xsd:string'),
            'movingto' => array(
                'name' => 'movingto',
                'type' => 'xsd:string'),
            'addtionalpickup' => array(
                'name' => 'addtionalpickup',
                'type' => 'xsd:string'),
            'addtionaldelivery' => array(
                'name' => 'addtionaldelivery',
                'type' => 'xsd:string'),
            'referral' => array(
                'name' => 'referral',
                'type' => 'xsd:string'),
            'notes' => array(
                'name' => 'notes',
                'type' => 'xsd:string'),
            'bedrooms' => array(
                'name' => 'bedrooms',
                'type' => 'xsd:integer'),
            'initial_hours_booked' => array(
                'name' => 'initial_hours_booked',
                'type' => 'xsd:integer'),
            'ladies_booked' => array(
                'name' => 'ladies_booked',
                'type' => 'xsd:integer'),
            'initial_sellprice' => array(
                'name' => 'initial_sellprice',
                'type' => 'xsd:decimal'),
            'travelfee_cost' => array(
                'name' => 'travelfee_cost',
                'type' => 'xsd:decimal'),
            'additional_charges' => array(
                'name' => 'additional_charges',
                'type' => 'xsd:decimal'),
            'additional_item' => array(
                'name' => 'additional_item',
                'type' => 'xsd:string'),
            'additional_charges_cost' => array(
                'name' => 'additional_charges_cost',
                'type' => 'xsd:decimal'),
            'total_sellprice' => array(
                'name' => 'total_sellprice',
                'type' => 'xsd:decimal'),
            'total_costprice' => array(
                'name' => 'total_costprice',
                'type' => 'xsd:decimal'),
            'cubic_meters_booked' => array(
                'name' => 'cubic_meters_booked',
                'type' => 'xsd:string'),
            'noof_modules_required' => array(
                'name' => 'noof_modules_required',
                'type' => 'xsd:string'),
            'cubic_meters_bystorage' => array(
                'name' => 'cubic_meters_bystorage',
                'type' => 'xsd:string'),
            'quotedsell_price' => array(
                'name' => 'quotedsell_price',
                'type' => 'xsd:string'),
            'quotedcost_price' => array(
                'name' => 'quotedcost_price',
                'type' => 'xsd:string'),
            'amountDueNow' => array(
                'name' => 'amountDueNow',
                'type' => 'xsd:string'),
            'deposit_received' => array(
                'name' => 'deposit_received',
                'type' => 'xsd:string'),
            'deposit_paidby' => array(
                'name' => 'deposit_paidby',
                'type' => 'xsd:string'),
            'first_payment_received' => array(
                'name' => 'first_month_payment_received',
                'type' => 'xsd:string'),
            'paymentmethod' => array(
                'name' => 'paymentmethod',
                'type' => 'xsd:string'),
            'anniversarydate' => array(
                'name' => 'anniversarydate',
                'type' => 'xsd:string'),
            'ewayrecurring_payment' => array(
                'name' => 'ewayrecurring_payment',
                'type' => 'xsd:string'),
            'futurepayment_log' => array(
                'name' => 'futurepayment_log',
                'type' => 'xsd:string'),
            'eway_refno' => array(
                'name' => 'eway_refno',
                'type' => 'xsd:string'),
            'eft_receivedon' => array(
                'name' => 'eft_receivedon',
                'type' => 'xsd:string'),
            'final_payment_receivedby' => array(
                'name' => 'final_payment_receivedby',
                'type' => 'xsd:string'),
            'final_payment_eway_refno' => array(
                'name' => 'final_payment_eway_refno',
                'type' => 'xsd:string'),
            'final_payment_eft_payment' => array(
                'name' => 'final_payment_eft_payment',
                'type' => 'xsd:string'),
            'head_office_paid' => array(
                'name' => 'head_office_paid',
                'type' => 'xsd:string'),
            'removalist_paid' => array(
                'name' => 'removalist_paid',
                'type' => 'xsd:string'),
            'packing_company_paid' => array(
                'name' => 'packing_company_paid',
                'type' => 'xsd:string'),
            'eway_token' => array(
                'name' => 'eway_token',
                'type' => 'xsd:string'),
            'client_feedback' => array(
                'name' => 'client_feedback',
                'type' => 'xsd:string'),
            'referral_source' => array(
                'name' => 'referral_source',
                'type' => 'xsd:string'),
                )
        );

        $this->nusoap_server->register(
                "setMoverEnquiry", array("moverDataArray" => "tns:setMoverDataArrayStruct"), array("uuid" => "xsd:string"), "urn:MySoapServer", "setMoverData", "rpc", "encoded", ""
        );

        /**
         * @uses setMoverEnquiry Set the mover enquiry data comes via web services.
         * @author Darshak Shah<darshak.shah@drcinfotech.com>
         * @return type
         */
        function setMoverEnquiry($moverDataArray) {
//            $fp = fopen("log.txt", "a+");
//            fwrite($fp, serialize($moverDataArray));
//            fclose($fp);
            list($movingFromSuburb, $movingFromPostCode, $movingFromState) = explode(",", $moverDataArray['movingfrom']);
            list($movingToSuburb, $movingToPostCode, $movingToState) = explode(",", $moverDataArray['movingto']);
            list($addtionalpickupSuburb, $addtionalpickupPostCode, $addtionalpickupState) = explode(",", $moverDataArray['addtionalpickup']);
            list($addtionaldeliverySuburb, $addtionaldeliveryPostCode, $addtionaldeliveryState) = explode(",", $moverDataArray['addtionaldelivery']);
            $bedrooms = $moverDataArray['bedrooms'];
            $noOfMovers = ((int) $bedrooms) > 2 ? '3' : '2';
            $travelFee = ((int) $bedrooms) > 2 ? '80.00' : '60.00';
            $clientHourlyRate = ((int) $bedrooms) > 2 ? '160.00' : '120.00';
            $data = array(
                'en_movetype' => $moverDataArray['movetype'],
                'en_home_office' => $moverDataArray['home_office'],
                'en_servicedate' => date('Y-m-d', $moverDataArray["servicedate"]),
                'en_servicetime' => trim($moverDataArray['servicetime']),
                'en_fname' => trim($moverDataArray['fname']),
                'en_lname' => trim($moverDataArray['lname']),
                'en_phone' => trim($moverDataArray['phone']),
                'en_email' => trim($moverDataArray['email']),
                'en_note' => trim($moverDataArray['notes']),
                'en_movingfrom_postcode' => trim($movingFromPostCode),
                'en_movingfrom_suburb' => trim($movingFromSuburb),
                'en_movingfrom_state' => trim($movingFromState),
                'en_movingto_postcode' => trim($movingToPostCode),
                'en_movingto_suburb' => trim($movingToSuburb),
                'en_movingto_state' => trim($movingToState),
                'en_addpickup_postcode' => trim($addtionalpickupPostCode),
                'en_addpickup_suburb' => trim($addtionalpickupSuburb),
                'en_addpickup_state' => trim($addtionalpickupState),
                'en_adddelivery_postcode' => trim($addtionaldeliveryPostCode),
                'en_adddelivery_suburb' => trim($addtionaldeliverySuburb),
                'en_adddelivery_state' => trim($addtionaldeliveryState),
                'en_referral_source' => trim($moverDataArray['referral']),
                'en_no_of_movers' => $noOfMovers,
                'en_no_of_trucks' => 1,
                'en_travelfee' => $travelFee,
                'en_client_hourly_rate' => $clientHourlyRate,
                'en_deposit_amt' => 50,
            );
            $CI = & get_instance();
            $CI->load->model("enquiry_model");
            $CI->load->model("notify_model");
            $uuid = $CI->enquiry_model->addEnquirydata($data);
            $notify = array(
                'notification_type' => 1,
                'uuid' => $uuid
            );
            $CI->notify_model->setNotification($notify);
            return $uuid;
        }

        $this->nusoap_server->wsdl->addComplexType(
                'getMoverDataArrayStruct', 'complexType', 'struct', 'sequence', '', array(
            'firstName' => array(
                'name' => 'firstName',
                'type' => 'xsd:string'),
            'mobile' => array(
                'name' => 'mobile',
                'type' => 'xsd:string'),
            'email' => array(
                'name' => 'email',
                'type' => 'xsd:string'),
            'from_address' => array(
                'name' => 'from_address',
                'type' => 'xsd:string'),
            'from_suburb' => array(
                'name' => 'from_suburb',
                'type' => 'xsd:string'),
            'from_postcode' => array(
                'name' => 'from_postcode',
                'type' => 'xsd:integer'),
            'to_address' => array(
                'name' => 'to_address',
                'type' => 'xsd:string'),
            'to_suburb' => array(
                'name' => 'to_suburb',
                'type' => 'xsd:string'),
            'to_postcode' => array(
                'name' => 'to_postcode',
                'type' => 'xsd:integer'),
            'deposit_amt' => array(
                'name' => 'deposit_amt',
                'type' => 'xsd:string'),
            'note' => array(
                'name' => 'note',
                'type' => 'xsd:string'),
                )
        );

        $this->nusoap_server->register(
                "getMoverEnquiry", array("enquiryUID" => "xsd:string"), array("return" => "tns:getMoverDataArrayStruct"), "urn:MySoapServer", "setMoverData", "rpc", "encoded", ""
        );

        function getMoverEnquiry($enquiryUID) {
            $CI = &get_instance();
            $CI->load->model("enquiry_model");
            $enquiryData = $CI->enquiry_model->getEnquiryDataByUUID($enquiryUID);
            $returnArray = array(
                "firstName" => $enquiryData[0]['en_fname'] . " " . $enquiryData[0]['en_lname'],
                "mobile" => $enquiryData[0]['en_phone'],
                "email" => $enquiryData[0]['en_email'],
                "from_address" => $enquiryData[0]['en_movingfrom_street'],
                "from_suburb" => $enquiryData[0]['en_movingfrom_suburb'],
                "from_postcode" => $enquiryData[0]['en_movingfrom_postcode'],
                "to_address" => $enquiryData[0]['en_movingto_street'],
                "to_suburb" => $enquiryData[0]['en_movingto_suburb'],
                "to_postcode" => $enquiryData[0]['en_movingto_postcode'],
                "deposit_amt" => $enquiryData[0]['en_deposit_amt'],
                "note" => $enquiryData[0]['en_note'],
            );
            return $returnArray;
        }

        $this->nusoap_server->wsdl->addComplexType(
                'updateMoverDataArrayStruct', 'complexType', 'struct', 'sequence', '', array(
            'name' => array(
                'name' => 'name',
                'type' => 'xsd:string'),
            'mobile' => array(
                'name' => 'mobile',
                'type' => 'xsd:string'),
            'email' => array(
                'name' => 'email',
                'type' => 'xsd:string'),
            'from_address' => array(
                'name' => 'from_address',
                'type' => 'xsd:string'),
            'to_address' => array(
                'name' => 'to_address',
                'type' => 'xsd:string'),
            'deposit_amt' => array(
                'name' => 'deposit_amt',
                'type' => 'xsd:string'),
            'eway_token' => array(
                'name' => 'eway_token',
                'type' => 'xsd:string'),
            'eway_refno' => array(
                'name' => 'eway_refno',
                'type' => 'xsd:string'),
            'deposit_paidby' => array(
                'name' => 'deposit_paidby',
                'type' => 'xsd:string'),
            'deposit_received' => array(
                'name' => 'deposit_received',
                'type' => 'xsd:string'),
            'eft_receivedon' => array(
                'name' => 'eft_receivedon',
                'type' => 'xsd:string'),
            'notes' => array(
                'name' => 'notes',
                'type' => 'xsd:string'),
            'uuid' => array(
                'name' => 'uuid',
                'type' => 'xsd:string'),
                )
        );



        $this->nusoap_server->register(
                "udpateMoverEnquiry", array("updateMoverDataArray" => "tns:updateMoverDataArrayStruct"), array("uuid" => "xsd:string"), "urn:MySoapServer", "setMoverData", "rpc", "encoded", ""
        );

        function udpateMoverEnquiry($updateMoverDataArray) {
//            return $updateMoverDataArray['uuid'];
            if ($updateMoverDataArray['uuid'] != "") {
                $CI = &get_instance();
                $CI->load->model("enquiry_model");
                $id = $CI->enquiry_model->getEnquiryIDFromUUID($updateMoverDataArray['uuid']);
                $nameArray = explode(" ", $updateMoverDataArray['name']);
                $lastName = $nameArray[count($nameArray) - 1];
                $firstName = "";
                for ($yy = 0; $yy < count($nameArray) - 1; $yy++) {
                    $firstName .= " " . $nameArray[$yy];
                }

                $data = array(
                    'en_fname' => $firstName,
                    'en_lname' => $lastName,
                    'en_phone' => $updateMoverDataArray['mobile'],
                    'en_email' => $updateMoverDataArray['email'],
                    'en_note' => $updateMoverDataArray['notes'],
                    'en_movingfrom_street' => $updateMoverDataArray['from_address'],
                    'en_movingto_street' => $updateMoverDataArray['to_address'],
                    'en_deposit_amt' => $updateMoverDataArray['deposit_amt'],
                    'en_deposit_received' => $updateMoverDataArray['deposit_received'],
                    'en_deposit_paidby' => $updateMoverDataArray['deposit_paidby'],
                    'en_eway_refno' => $updateMoverDataArray['eway_refno'],
                    'en_eft_receivedon' => $updateMoverDataArray['eft_receivedon'],
                    'en_eway_token' => $updateMoverDataArray['eway_token']
                );
                return $CI->enquiry_model->editEnquiryById($id, $data);
            }
        }

        /**
         * Mover Data Logic END
         */
         $this->nusoap_server->register(
                "getRemovalistByUUID", array("enquiryUID" => "xsd:string"), array("return" => "xsd:string"), "urn:MySoapServer", "getRemovalistByUUID", "rpc", "encoded", ""
        );
         $this->nusoap_server->register(
                "getPackerstByUUID", array("enquiryUID" => "xsd:string"), array("return" => "xsd:string"), "urn:MySoapServer", "getPackerstByUUID", "rpc", "encoded", ""
        );
         $this->nusoap_server->register(
                "getClientByUUID", array("enquiryUID" => "xsd:string"), array("return" => "xsd:string"), "urn:MySoapServer", "getClientByUUID", "rpc", "encoded", ""
        );

        function getRemovalistByUUID($uuid) {
            $CI = & get_instance();
            $CI->load->model("contact_model");
            
            $array=$CI->contact_model->getRemovalistByUUID($uuid);
            return json_encode($array);
        }
        function getPackerstByUUID($uuid) {
            $CI = & get_instance();
            $CI->load->model("contact_model");
            
            $array=$CI->contact_model->getPackerstByUUID($uuid);
            return json_encode($array);
        }
        function getClientByUUID($uuid) {
            $CI = & get_instance();
            $CI->load->model("contact_model");
            
            $array=$CI->contact_model->getClientByUUID($uuid);
            return json_encode($array);
        }

        /**
         * To test whether SOAP server/client is working properly
         * Just echos the input parameter
         * @param string $tmp anything as input parameter
         * @return string returns the input parameter
         */
        function echoTest($tmp) {
            if (!$tmp) {
                return new soap_fault('-1', 'Server', 'Parameters missing for echoTest().', 'Please refer documentation.');
            } else {
                return "from MySoapServer() : $tmp";
            }
        }

        function insert($data, $data1, $data2) {
            $data = array("userTest_name" => $data, "userTest_tel" => $data1, "amt" => $data2);
            $CI = & get_instance();
            $CI->load->model("usertest_model");
            return array("id" => $CI->usertest_model->setData($data), "username" => "d", "email" => "ddad");
//            return array(
//                'id' => 1,
//                'username' => 'testuser',
//                'email' => 'testuser@example.com'
//            );
        }

        function insert2($userTest) {
            $data = $userTest;
//            $data = array("userTest_name" => $data, "userTest_tel" => $data1, "amt" => $data2);
            $CI = & get_instance();
            $CI->load->model("usertest_model");
            return array("id" => $CI->usertest_model->setData($data), "username" => "d", "email" => "ddad");
//            return array(
//                'id' => 1,
//                'username' => 'testuser',
//                'email' => 'testuser@example.com'
//            );
        }

        function setContactEnquiry($contactDataArray) {
            $CI = & get_instance();
            log_message("error", "dddd");
            $CI->load->model("contact_model");
            return $hmm = $CI->contact_model->addContactdata($contactDataArray);
        }

    }

    function index() {
        $this->nusoap_server->service(file_get_contents("php://input")); //shows the standard info about service
    }

}
