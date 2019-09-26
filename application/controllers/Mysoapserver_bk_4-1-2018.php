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

        list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));

//        if ($_SERVER['PHP_AUTH_USER'] != "hireabox" || $_SERVER['PHP_AUTH_PW'] != "a9uLYZVLRoMFewewwHxHQD4eCsQdxknM") {
//            header('WWW-Authenticate: Basic realm="My Auth"');
//            header('HTTP/1.0 401 Unauthorized');
//            return new soap_fault('-1', '', 'Error !', '');
//            exit;
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
                'type' => 'xsd:string'),
            'ladies_booked' => array(
                'name' => 'ladies_booked',
                'type' => 'xsd:string'),
            'initial_sellprice' => array(
                'name' => 'initial_sellprice',
                'type' => 'xsd:string'),
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
            'promotionalcode' => array(
                'name' => 'promotionalcode',
                'type' => 'xsd:string'),
            'no_of_movers' => array(
                'name' => 'no_of_movers',
                'type' => 'xsd:string'),
            'travelfee' => array(
                'name' => 'travelfee',
                'type' => 'xsd:string'),
            'client_hourly_rate' => array(
                'name' => 'client_hourly_rate',
                'type' => 'xsd:string'),
            'client_info' => array(
                'name' => 'client_info',
                'type' => 'xsd:string'
            ),
            'additional_pickup'=>array(
                'name'=>'additional_pickup',
                'type'=>'xsd:string'
                ),
                 'additional_delivery'=>array(
                'name'=>'additional_delivery',
                'type'=>'xsd:string'
                ),
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
                'en_referral_source' => trim($moverDataArray['referral_source']),
                'en_promotional_code' => trim($moverDataArray['promotionalcode']),
                'en_no_of_movers' => trim($moverDataArray['no_of_movers']),
                'en_no_of_trucks' => 1,
                'en_travelfee' => trim($moverDataArray['travelfee']),
                'en_client_hourly_rate' => trim($moverDataArray['client_hourly_rate']),
                'en_deposit_amt' => 50,
                'en_initial_hours_booked' => $moverDataArray['initial_hours_booked'],
                'en_ladies_booked' => $moverDataArray['ladies_booked'],
                'en_initial_sellprice' => $moverDataArray['initial_sellprice'],
                'created_from' => $moverDataArray['client_info'],
                'additional_pickup'=>$moverDataArray['additional_pickup'],
                'additional_delivery'=>$moverDataArray['additional_delivery']
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

        $enquiryFieldsArray = array(
            'movetype' => array(
                'name' => 'movetype',
                'type' => 'xsd:string'
            ),
            'home_office' => array(
                'name' => 'home_office',
                'type' => 'xsd:string'
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
            'fName' => array(
                'name' => 'fName',
                'type' => 'xsd:string'),
            'lName' => array(
                'name' => 'lName',
                'type' => 'xsd:string'),
            'mobile' => array(
                'name' => 'mobile',
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
            'from_address' => array(
                'name' => 'from_address',
                'type' => 'xsd:string'),
            'from_state' => array(
                'name' => 'from_state',
                'type' => 'xsd:string'),
            'from_suburb' => array(
                'name' => 'from_suburb',
                'type' => 'xsd:string'),
            'from_postcode' => array(
                'name' => 'from_postcode',
                'type' => 'xsd:string'),
            'to_address' => array(
                'name' => 'to_address',
                'type' => 'xsd:string'),
            'to_suburb' => array(
                'name' => 'to_suburb',
                'type' => 'xsd:string'),
            'to_postcode' => array(
                'name' => 'to_postcode',
                'type' => 'xsd:string'),
            'to_state' => array(
                'name' => 'to_state',
                'type' => 'xsd:string'),
            'addpickup_street' => array(
                'name' => 'addpickup_stree',
                'type' => 'xsd:string'),
            'addpickup_postcode' => array(
                'name' => 'addpickup_postcode',
                'type' => 'xsd:string'),
            'addpickup_suburb' => array(
                'name' => 'addpickup_suburb',
                'type' => 'xsd:string'),
            'addpickup_state' => array(
                'name' => 'addpickup_state',
                'type' => 'xsd:string'),
            'adddelivery_street' => array(
                'name' => 'adddelivery_street',
                'type' => 'xsd:string'),
            'adddelivery_postcode' => array(
                'name' => 'adddelivery_postcode',
                'type' => 'xsd:string'),
            'adddelivery_suburb' => array(
                'name' => 'adddelivery_suburb',
                'type' => 'xsd:string'),
            'adddelivery_state' => array(
                'name' => 'adddelivery_state',
                'type' => 'xsd:string'),
            'confirmation' => array(
                'name' => 'confirmation',
                'type' => 'xsd:string'),
            'deposit_amt' => array(
                'name' => 'deposit_amt',
                'type' => 'xsd:string'),
            'initial_hours_booked' => array(
                'name' => 'initial_hours_booked',
                'type' => 'xsd:string'),
            'ladies_booked' => array(
                'name' => 'ladies_booked',
                'type' => 'xsd:string'),
            'initial_sellprice' => array(
                'name' => 'initial_sellprice',
                'type' => 'xsd:string'),
            'no_of_movers' => array(
                'name' => 'no_of_movers',
                'type' => 'xsd:string'),
            'no_of_trucks' => array(
                'name' => 'no_of_trucks',
                'type' => 'xsd:string'),
            'travelfee' => array(
                'name' => 'travelfee',
                'type' => 'xsd:string'),
            'travelfee_cost' => array(
                'name' => 'travelfee_cost',
                'type' => 'xsd:string'),
            'client_hourly_rate' => array(
                'name' => 'client_hourly_rate',
                'type' => 'xsd:string'),
            'additional_charges' => array(
                'name' => 'additional_charges',
                'type' => 'xsd:string'),
            'additional_item' => array(
                'name' => 'additional_item',
                'type' => 'xsd:string'),
            'additional_charges_cost' => array(
                'name' => 'additional_charges_cost',
                'type' => 'xsd:string'),
            'total_sellprice' => array(
                'name' => 'total_sellprice',
                'type' => 'xsd:string'),
            'total_costprice' => array(
                'name' => 'total_costprice',
                'type' => 'xsd:string'),
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
            'hireamover_margin' => array(
                'name' => 'hireamover_margin',
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
            'month_payment_received' => array(
                'name' => 'month_payment_received',
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
            'en_packing_company_paid' => array(
                'name' => 'en_packing_company_paid',
                'type' => 'xsd:string'),
            'en_eway_token' => array(
                'name' => 'en_eway_token',
                'type' => 'xsd:string'),
            'client_feedback' => array(
                'name' => 'client_feedback',
                'type' => 'xsd:string'),
            'en_referral_source' => array(
                'name' => 'en_referral_source',
                'type' => 'xsd:string'),
            'en_promotional_code' => array(
                'name' => 'en_promotional_code',
                'type' => 'xsd:string'),
            'en_date' => array(
                'name' => 'en_date',
                'type' => 'xsd:string'),
            'is_deleted' => array(
                'name' => 'is_deleted',
                'type' => 'xsd:string'),
            'is_qualified' => array(
                'name' => 'is_qualified',
                'type' => 'xsd:string'),
            'qualified_date' => array(
                'name' => 'qualified_date',
                'type' => 'xsd:string'),
            'created_from' => array(
                'name' => 'created_from',
                'type' => 'xsd:string'),
            'created_by' => array(
                'name' => 'created_by',
                'type' => 'xsd:string'),
            'note' => array(
                'name' => 'note',
                'type' => 'xsd:string'),
            'uuid' => array(
                'name' => 'uuid',
                'type' => 'xsd:string'),
        );
        $this->nusoap_server->wsdl->addComplexType(
                'getMoverDataArrayStruct', 'complexType', 'struct', 'sequence', '', $enquiryFieldsArray
        );

        $this->nusoap_server->register(
                "getMoverEnquiry", array("enquiryUID" => "xsd:string"), array("return" => "tns:getMoverDataArrayStruct"), "urn:MySoapServer", "setMoverData", "rpc", "encoded", ""
        );

        function getMoverEnquiry($enquiryUID) {
            $CI = &get_instance();
            $CI->load->model("enquiry_model");
            $enquiryData = $CI->enquiry_model->getEnquiryDataByUUID($enquiryUID);
            $returnArray = array(
                "movetype" => $enquiryData[0]['en_movetype'],
                "home_office" => $enquiryData[0]['en_home_office'],
                "servicedate" => $enquiryData[0]['en_servicedate'],
                "servicetime" => $enquiryData[0]['en_servicetime'],
                "deliverydate" => $enquiryData[0]['en_deliverydate'],
                "deliverytime" => $enquiryData[0]['en_deliverytime'],
                "storagedate" => $enquiryData[0]['en_storagedate'],
                "fName" => $enquiryData[0]['en_fname'],
                "lName" => $enquiryData[0]['en_lname'],
                "mobile" => $enquiryData[0]['en_phone'],
                "email" => $enquiryData[0]['en_email'],
                "storage_provider" => $enquiryData[0]['en_storage_provider'],
                "storage_address" => $enquiryData[0]['en_storage_address'],
                "storage_phno" => $enquiryData[0]['en_storage_phno'],
                "from_address" => $enquiryData[0]['en_movingfrom_street'],
                "from_suburb" => $enquiryData[0]['en_movingfrom_suburb'],
                "from_postcode" => $enquiryData[0]['en_movingfrom_postcode'],
                "from_state" => $enquiryData[0]['en_movingfrom_state'],
                "to_address" => $enquiryData[0]['en_movingto_street'],
                "to_suburb" => $enquiryData[0]['en_movingto_suburb'],
                "to_postcode" => $enquiryData[0]['en_movingto_postcode'],
                "to_state" => $enquiryData[0]['en_movingto_state'],
                "addpickup_street" => $enquiryData[0]['en_addpickup_street'],
                "addpickup_postcode" => $enquiryData[0]['en_addpickup_postcode'],
                "addpickup_suburb" => $enquiryData[0]['en_addpickup_suburb'],
                "addpickup_state" => $enquiryData[0]['en_addpickup_state'],
                "adddelivery_street" => $enquiryData[0]['en_adddelivery_street'],
                "adddelivery_postcode" => $enquiryData[0]['en_adddelivery_postcode'],
                "adddelivery_suburb" => $enquiryData[0]['en_adddelivery_suburb'],
                "adddelivery_state" => $enquiryData[0]['en_adddelivery_state'],
                "confirmation" => $enquiryData[0]['en_confirmation'],
                "deposit_amt" => $enquiryData[0]['en_deposit_amt'],
                "initial_hours_booked" => $enquiryData[0]['en_initial_hours_booked'],
                "ladies_booked" => $enquiryData[0]['en_ladies_booked'],
                "initial_sellprice" => $enquiryData[0]['en_initial_sellprice'],
                "no_of_movers" => $enquiryData[0]['en_no_of_movers'],
                "no_of_trucks" => $enquiryData[0]['en_no_of_trucks'],
                "travelfee" => $enquiryData[0]['en_travelfee'],
                "travelfee_cost" => $enquiryData[0]['en_travelfee_cost'],
                "client_hourly_rate" => $enquiryData[0]['en_client_hourly_rate'],
                "additional_charges" => $enquiryData[0]['en_additional_charges'],
                "additional_item" => $enquiryData[0]['en_additional_item'],
                "additional_charges_cost" => $enquiryData[0]['en_additional_charges_cost'],
                "total_sellprice" => $enquiryData[0]['en_total_sellprice'],
                "total_costprice" => $enquiryData[0]['en_total_costprice'],
                "cubic_meters_booked" => $enquiryData[0]['en_cubic_meters_booked'],
                "noof_modules_required" => $enquiryData[0]['en_noof_modules_required'],
                "cubic_meters_bystorage" => $enquiryData[0]['en_cubic_meters_bystorage'],
                "quotedsell_price" => $enquiryData[0]['en_quotedsell_price'],
                "quotedcost_price" => $enquiryData[0]['en_quotedcost_price'],
                "hireamover_margin" => $enquiryData[0]['en_hireamover_margin'],
                "amountDueNow" => $enquiryData[0]['en_amountDueNow'],
                "deposit_received" => $enquiryData[0]['en_deposit_received'],
                "deposit_paidby" => $enquiryData[0]['en_deposit_paidby'],
                "month_payment_received" => $enquiryData[0]['en_month_payment_received'],
                "paymentmethod" => $enquiryData[0]['en_paymentmethod'],
                "anniversarydate" => $enquiryData[0]['en_anniversarydate'],
                "ewayrecurring_payment" => $enquiryData[0]['en_ewayrecurring_payment'],
                "futurepayment_log" => $enquiryData[0]['en_futurepayment_log'],
                "eway_refno" => $enquiryData[0]['en_eway_refno'],
                "eft_receivedon" => $enquiryData[0]['en_eft_receivedon'],
                "final_payment_receivedby" => $enquiryData[0]['final_payment_receivedby'],
                "final_payment_eway_refno" => $enquiryData[0]['final_payment_eway_refno'],
                "final_payment_eft_payment" => $enquiryData[0]['final_payment_eft_payment'],
                "head_office_paid" => $enquiryData[0]['head_office_paid'],
                "removalist_paid" => $enquiryData[0]['removalist_paid'],
                "en_packing_company_paid" => $enquiryData[0]['en_packing_company_paid'],
                "en_eway_token" => $enquiryData[0]['en_eway_token'],
                "client_feedback" => $enquiryData[0]['client_feedback'],
                "en_referral_source" => $enquiryData[0]['en_referral_source'],
                "en_promotional_code" => $enquiryData[0]['en_promotional_code'],
                "en_date" => $enquiryData[0]['en_date'],
                "is_deleted" => $enquiryData[0]['is_deleted'],
                "is_qualified" => $enquiryData[0]['is_qualified'],
                "qualified_date" => $enquiryData[0]['qualified_date'],
                "created_from" => $enquiryData[0]['created_from'],
                "created_by" => $enquiryData[0]['created_by'],
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
            'from_state' => array(
                'name' => 'from_state',
                'type' => 'xsd:string'),
            'to_state' => array(
                'name' => 'to_state',
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
            'booking' => array(
                'name' => 'booking',
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
                    'en_movingfrom_state' => $updateMoverDataArray['from_state'],
                    'en_movingto_state' => $updateMoverDataArray['to_state'],
                    'en_movingto_street' => $updateMoverDataArray['to_address'],
                    'en_deposit_amt' => $updateMoverDataArray['deposit_amt'],
                    'en_deposit_received' => $updateMoverDataArray['deposit_received'],
                    'en_deposit_paidby' => $updateMoverDataArray['deposit_paidby'],
                    'en_eway_refno' => $updateMoverDataArray['eway_refno'],
                    'en_eft_receivedon' => $updateMoverDataArray['eft_receivedon'],
                    'en_eway_token' => $updateMoverDataArray['eway_token'],
                    'is_qualified'=>$updateMoverDataArray['booking'] 
                );
                return $CI->enquiry_model->editEnquiryById($id, $data);
            }
        }

        $this->nusoap_server->wsdl->addComplexType(
                'udpateMoverEnquiryArray', 'complexType', 'struct', 'sequence', '', $enquiryFieldsArray
        );

        $this->nusoap_server->register(
                "udpateMoverEnquiry1", array("updateData" => "tns:udpateMoverEnquiryArray"), array("uuid" => "xsd:string"), "urn:MySoapServer", "udpateMoverEnquiry1", "rpc", "encoded", ""
        );

        function udpateMoverEnquiry1($updateMoverDataArray) {
            if ($updateMoverDataArray['uuid'] != "") {
                $CI = &get_instance();
                $CI->load->model("enquiry_model");
                $id = $CI->enquiry_model->getEnquiryIDFromUUID($updateMoverDataArray['uuid']);
                $data = array(
                    'final_payment_eway_refno' => $updateMoverDataArray['final_payment_eway_refno'],
                    'head_office_paid' => $updateMoverDataArray['head_office_paid'],
                    'removalist_paid' => $updateMoverDataArray['removalist_paid'],
                    'final_payment_receivedby' => $updateMoverDataArray['final_payment_receivedby'],
                );
                return $CI->enquiry_model->editEnquiryById($id, $data);
            }
        }

        /**
         * Mover Data Logic END
         */
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

            $array = $CI->contact_model->getRemovalistByUUID($uuid);
            return json_encode($array);
        }

        function getPackerstByUUID($uuid) {
            $CI = & get_instance();
            $CI->load->model("contact_model");

            $array = $CI->contact_model->getPackerstByUUID($uuid);
            return json_encode($array);
        }

        function getClientByUUID($uuid) {
            $CI = & get_instance();
            $CI->load->model("contact_model");

            $array = $CI->contact_model->getClientByUUID($uuid);
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
