<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        if (!isLogin()) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(array("expired" => "1"));
                exit;
            }
            redirect(base_url());
        }
        $this->data = array();
        $this->data['title'] = "CRM Booking";
        $this->data['description'] = "";
        $this->data['notification'] = webNotification();

        // $this->data['user'] = $this->session->userdata('userData');

        if (@$_SERVER['REMOTE_ADDR'] == "192.168.15.173" || @$_SERVER['HTTP_X_FORWARDED_FOR'] == "192.168.15.173"){
            define("DRC_TESTING", TRUE);   
        } else {
            define("DRC_TESTING", FALSE);
        }


    }

    public function newBooking() {
        $this->data['title'] = "CRM Booking";
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            // 'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js'
        );
        $data['jsFooter'] = array(
            'custom/js/form-booking.js'
        );
        $data['jsTPFooter'] = array(
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js'
        );
        $data['css'] = array(
            'global/plugins/select2/css/select2.min.css',
            'global/plugins/select2/css/select2-bootstrap.min.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css'
        );
        $data['cssTP'] = array(
            '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
        );
        $this->load->model("enquiry_model");
        $data['enquiry'] = $this->enquiry_model->getEnquiryDataByUUID($en_unique_id);
        $data['move_type'] = $this->enquiry_model->getMoveType();
//        echo "<pre>";
//        print_r($data);
//        die;
        $data['suburb'] = $this->enquiry_model->getSuburb($q);
        $data['contactfname'] = $this->enquiry_model->getRemovalistName($en_unique_id);

        $this->load->model("contact_model");
        $data['statedata'] = $this->contact_model->getSuburb();

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view("booking_view.php", $data);
        $this->load->view("template/footer", $this->data);
    }

    public function index() {
        
        $this->data['title'] = "CRM Booking";
        $data['jsFooter'] = array(
            'custom/js/booking-view.js',
            'global/scripts/datatable.js',
            'global/plugins/datatables/datatables.min.js',
            'global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js',
        );
        $data['css'] = array(
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css'
        );
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view("booking_list.php", $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function ajaxBookingDatalist() {
        $results = $this->booking_model->getBookingData();
        echo json_encode($results);
    }

    public function getcontactid($enqstate) {
        $this->load->model('booking_model');
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->booking_model->getContactIdByName($q, $enqstate);
        }
    }

    /* Removalist filter on bookinglist.....@DRCZ */

    public function getRemovalistBookingFilter() {
        $this->load->model('booking_model');
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->booking_model->getRemovalistNameForFilter($q);
        }
    }

    /* Removalist filter on bookinglist.....@DRCZ */

    public function viewBooking($en_unique_id) {
        if ($en_unique_id == "") {
            show_404();
        }
        // $this->data['title'] = "CRM Booking";
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            // 'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js'
        );
        $data['jsFooter'] = array(
            'custom/js/edit-booking.js',
            'custom/js/form-contact.js'
        );
        $data['jsTPFooter'] = array(
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js'
        );
        $data['css'] = array(
            'global/plugins/select2/css/select2.min.css',
            'global/plugins/select2/css/select2-bootstrap.min.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css'
        );
        $data['cssTP'] = array(
            '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
        );
        $this->load->model("enquiry_model");
        $data['enquiry'] = $this->enquiry_model->getEnquiryDataByUUID($en_unique_id);
        $data['move_type'] = $this->enquiry_model->getMoveType();

        $data['suburb'] = $this->enquiry_model->getSuburb($q);
        $data['contactfname'] = $this->enquiry_model->getRemovalistName($en_unique_id);

        $data['activitylog'] = $this->enquiry_model->getEmailLogById($data['enquiry'][0]['enquiry_id']);
        $data['enquirylog'] = $this->enquiry_model->getEnquiryLog($data['enquiry'][0]['enquiry_id']);

        /* echo "<pre>";
          print_r($data);
          die; */
        $this->load->model("booking_model");
        $data['contactname'] = $this->booking_model->getContactName($en_unique_id);
        $data['booking'] = $this->booking_model->getEnquiryDataByUUID($en_unique_id);
        $data['clientname'] = $this->booking_model->getClientByUUID($en_unique_id);
        $data['notes'] = $this->booking_model->getNotesById($data['booking'][0]['enquiry_id']);
        $data['packerNameList']=$this->booking_model->getpackerNameListWithValues($data['booking'][0]['enquiry_id']);

        $this->load->model("contact_model");
        $data['packersdata'] = $this->contact_model->getPackerstByUUID($en_unique_id);
        $data['statedata'] = $this->contact_model->getSuburb();
        $data['clientname'] = $this->contact_model->getClientByUUID($en_unique_id);
        if (!empty($data['clientname'])) {
            $this->data['title'] = "Booking - " . $data['clientname']['contact_fname'] . " " . $data['clientname']['contact_lname'];
        }
        // prd($data);
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view("edit_booking_view.php", $data);
        $this->load->view("template/footer", $this->data);
    }

    public function EmailActivitiesLogAjax() {
        $en_unique_id = $this->input->post("id", true);
        $this->load->model("enquiry_model");
        $data['activitylog'] = $this->enquiry_model->getEmailLogById($en_unique_id);
        $this->load->view("edit_booking_ajax_view.php", $data);
    }

    public function viewBookingData($en_unique_id) {
        $data['booking'] = $this->booking_model->getEnquiryDataByUUID($en_unique_id);

        $this->load->view("edit_booking_view", $data);
    }

    public function addbooking() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class=""><ul><li>', '</li></ul></div>');
            $this->form_validation->set_rules('booking_status', 'Booking status', 'trim');
            $this->form_validation->set_rules('en_movetype', 'Relationship type', 'trim|required');
            $this->form_validation->set_rules('en_home_office', 'Home Office', 'trim');
            $this->form_validation->set_rules('en_phone', 'Phone', 'trim|required|max_length[15]');
            $this->form_validation->set_rules('en_email', 'Email', 'trim|required|callback_bookingemail_check');
            $this->form_validation->set_rules('en_note', 'Note', 'trim');
            $this->form_validation->set_rules('en_movingfrom_street', 'Street', 'trim');
            $this->form_validation->set_rules('en_movingto_street', 'Street', 'trim');
            $this->form_validation->set_rules('en_addpickup_street', 'Street', 'trim');
            $this->form_validation->set_rules('en_adddelivery_street', 'Street', 'trim');
            $this->form_validation->set_rules('en_deposit_amt', 'Deposit amount', 'trim|numeric');
            $this->form_validation->set_rules('en_no_of_movers', 'No of movers', 'trim|numeric');
            $this->form_validation->set_rules('en_no_of_trucks', 'No of trucks', 'trim|numeric');
            $this->form_validation->set_rules('en_travelfee', 'Travelfee', 'trim|numeric');
            $this->form_validation->set_rules('en_client_hourly_rate', 'Hourly rate', 'trim|numeric');
            $this->form_validation->set_rules('en_additional_charges', 'Additional charges', 'trim|numeric');
            $this->form_validation->set_rules('en_additional_item', 'Additional items', 'trim');
            $this->form_validation->set_rules('en_total_sellprice', 'Sell price', 'trim|numeric');
            $this->form_validation->set_rules('en_total_costprice', 'Cost price', 'trim|numeric');
            $this->form_validation->set_rules('en_hireamover_margin', 'Hireamover margin', 'trim|numeric');
            $this->form_validation->set_rules('en_deposit_paidby', 'Deposit paidby', 'trim');
            $this->form_validation->set_rules('en_eway_refno', 'Eway refno', 'trim|numeric');
            $this->form_validation->set_rules('en_eway_token', 'Eway token', 'trim');
            $this->form_validation->set_rules('en_referral_source', 'Referral source', 'trim');
            $this->form_validation->set_rules('en_promotional_code', 'Promotional code', 'trim|max_length[25]');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("error" => validation_errors()));
            } else {
                $this->load->model("booking_model");
                $config['upload_path'] = 'assets/uploads/notes/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);
                $this->input->method();

                $additionalpickup1 = array(
                    'en_addpickup_street' => $this->input->post("en_addpickup_street", true),
                    'en_addpickup_postcode' => $this->input->post("en_addpickup_postcode", true),
                    'en_addpickup_suburb' => $this->input->post("en_addpickup_suburb", true),
                    'en_addpickup_state' => $this->input->post("en_addpickup_state", true),
                );
                $additionaldelivery1 = array(
                    'en_adddelivery_street' => $this->input->post("en_adddelivery_street", true),
                    'en_adddelivery_postcode' => $this->input->post("en_adddelivery_postcode", true),
                    'en_adddelivery_suburb' => $this->input->post("en_adddelivery_suburb", true),
                    'en_adddelivery_state' => $this->input->post("en_adddelivery_state", true),
                );
                /* if ($additionalpickup1['en_addpickup_suburb'][0] != "") {
                  $additionalpickup = json_encode($additionalpickup1);
                  }
                  if ($additionaldelivery1['en_adddelivery_suburb'][0] != "") {
                  $additionaldelivery = json_encode($additionaldelivery1);
                  } */
                foreach ($additionalpickup1['en_addpickup_suburb'] as $pickupKey => $pickupValue) {
                    if (trim($pickupValue) == "") {
                        unset($additionalpickup1['en_addpickup_suburb'][$pickupKey]);
                        unset($additionalpickup1['en_addpickup_postcode'][$pickupKey]);
                        unset($additionalpickup1['en_addpickup_street'][$pickupKey]);
                        unset($additionalpickup1['en_addpickup_state'][$pickupKey]);
                    }
                }
                $additionalpickup = json_encode($additionalpickup1);

                foreach ($additionaldelivery1['en_adddelivery_suburb'] as $deliveryKey => $deliveryValue) {
                    if (trim($deliveryValue) == "") {
                        unset($additionaldelivery1['en_adddelivery_suburb'][$deliveryKey]);
                        unset($additionaldelivery1['en_adddelivery_postcode'][$deliveryKey]);
                        unset($additionaldelivery1['en_adddelivery_street'][$deliveryKey]);
                        unset($additionaldelivery1['en_adddelivery_state'][$deliveryKey]);
                    }
                }
                $additionaldelivery = json_encode($additionaldelivery1);

                $storageReminderDate='';
                if($this->input->post("en_movetype") == 6){
                    $storageReminderDate = $this->input->post('storageReminderDate',true);   
                    if($storageReminderDate == ''){
                        $storageReminderDate = date('Y-m-d', strtotime($this->input->post("en_storagedate", true).'+1 month -1 day'));
                    }
                    else{
                        $storageReminderDate = date('Y-m-d', strtotime($this->input->post('storageReminderDate',true)));
                    }

                    if(strtotime($storageReminderDate) > strtotime(date('Y-m-d'))){
                        $storageNotifyDate=$storageReminderDate;
                    }
                    else{
                        $storageNotifyDate=date('Y-m-d', strtotime($this->input->post("storageReminderDate", true).'+1 month'));
                    }

                }
                else{
                    $storageNotifyDate='0000-00-00';
                }
                $data = array(
                    'booking_status' => $this->input->post("booking_status", true),
                    'en_movetype' => $this->input->post("en_movetype", true),
                    'en_home_office' => $this->input->post("en_home_office", true),
                    'en_servicedate' => date('Y-m-d', strtotime($this->input->post("en_servicedate", true))),
                    'en_servicetime' => $this->input->post("serviceFullTime", true),
                    'en_deliverydate' => date('Y-m-d', strtotime($this->input->post("en_deliverydate", true))),
                    'en_deliverytime' => $this->input->post("en_deliverytime", true),
                    'en_storagedate' => date('Y-m-d', strtotime($this->input->post("en_storagedate", true))),
                    'customer_id' => $this->input->post("customer_id", true),
                    'en_phone' => $this->input->post("en_phone", true),
                    'en_email' => $this->input->post("en_email", true),
                    'en_storage_provider' => $this->input->post("en_storage_provider", true),
                    'en_storage_address' => $this->input->post("en_storage_address", true),
                    'en_storage_phno' => $this->input->post("en_storage_phno", true),
                    'contact_id' => $this->input->post("contact_id", true),
                    'en_packer_selection' => $this->input->post("en_packer_selection", true),
                    'en_note' => $this->input->post("en_note", true),
                    'en_movingfrom_street' => $this->input->post("en_movingfrom_street", true),
                    'en_movingfrom_postcode' => $this->input->post("en_movingfrom_postcode", true),
                    'en_movingfrom_suburb' => $this->input->post("en_movingfrom_suburb", true),
                    'en_movingfrom_state' => $this->input->post("en_movingfrom_state", true),
                    'en_movingto_street' => $this->input->post("en_movingto_street", true),
                    'en_movingto_postcode' => $this->input->post("en_movingto_postcode", true),
                    'en_movingto_suburb' => $this->input->post("en_movingto_suburb", true),
                    'en_movingto_state' => $this->input->post("en_movingto_state", true),
//                    'en_addpickup_street' => $this->input->post("en_addpickup_street", true),
//                    'en_addpickup_postcode' => $this->input->post("en_addpickup_postcode", true),
//                    'en_addpickup_suburb' => $this->input->post("en_addpickup_suburb", true),
//                    'en_addpickup_state' => $this->input->post("en_addpickup_state", true),
//                    'en_adddelivery_street' => $this->input->post("en_adddelivery_street", true),
//                    'en_adddelivery_postcode' => $this->input->post("en_adddelivery_postcode", true),
//                    'en_adddelivery_suburb' => $this->input->post("en_adddelivery_suburb", true),
//                    'en_adddelivery_state' => $this->input->post("en_adddelivery_state", true),
                    'client_feedback' => $this->input->post("client_feedback", true),
                    'en_referral_source' => $this->input->post("en_referral_source", true),
                    'en_promotional_code' => $this->input->post("en_promotional_code", true),
                    'en_deposit_amt' => $this->input->post("en_deposit_amt", true),
                    'en_no_of_movers' => $this->input->post("en_no_of_movers", true),
                    'en_no_of_trucks' => $this->input->post("en_no_of_trucks", true),
                    'en_initial_hours_booked' => $this->input->post("en_initial_hours_booked", true),
                    'en_ladies_booked' => $this->input->post("en_ladies_booked", true),
                    'en_initial_sellprice' => $this->input->post("en_initial_sellprice", true),
                    'en_travelfee' => $this->input->post("en_travelfee", true),
                    'en_client_hourly_rate' => $this->input->post("en_client_hourly_rate", true),
                    'en_additional_charges' => $this->input->post("en_additional_charges", true),
                    'en_additional_item' => $this->input->post("en_additional_item", true),
                    'en_additional_charges_cost' => $this->input->post("en_additional_charges_cost", true),
                    'en_total_sellprice' => $this->input->post("en_total_sellprice", true),
                    'en_total_costprice' => $this->input->post("en_total_costprice", true),
                    'en_cubic_meters_booked' => $this->input->post("en_cubic_meters_booked", true),
                    'en_noof_modules_required' => $this->input->post("en_noof_modules_required", true),
                    'en_cubic_meters_bystorage' => $this->input->post("en_cubic_meters_bystorage", true),
                    'en_quotedsell_price' => $this->input->post("en_quotedsell_price", true),
                    'en_quotedcost_price' => $this->input->post("en_quotedcost_price", true),
                    'en_hireamover_margin' => $this->input->post("en_hireamover_margin", true),
                    'en_amountDueNow' => $this->input->post("en_amountDueNow", true),
                    'en_deposit_received' => $this->input->post("en_deposit_received", true),
                    'en_deposit_paidby' => $this->input->post("en_deposit_paidby", true),
                    'en_month_payment_received' => $this->input->post("en_month_payment_received", true),
                    'en_paymentmethod' => $this->input->post("en_paymentmethod", true),
                    'en_anniversarydate' => date('Y-m-d', strtotime($this->input->post("en_anniversarydate", true))),
                    'en_ewayrecurring_payment' => $this->input->post("en_ewayrecurring_payment", true),
                    'en_futurepayment_log' => $this->input->post("en_futurepayment_log", true),
                    'en_eway_refno' => $this->input->post("en_eway_refno", true),
                    'en_eft_receivedon' => date('Y-m-d', strtotime($this->input->post("en_eft_receivedon", true))),
                    'final_payment_receivedby' => $this->input->post("final_payment_receivedby", true),
                    'final_payment_eway_refno' => $this->input->post("final_payment_eway_refno", true),
                    'final_payment_eft_payment' => date('Y-m-d', strtotime($this->input->post("final_payment_eft_payment", true))),
                    'head_office_paid' => $this->input->post("head_office_paid", true),
                    'en_packing_company_paid' => $this->input->post("en_packing_company_paid", true),
                    'removalist_paid' => $this->input->post("removalist_paid", true),
                    'en_eway_token' => $this->input->post("en_eway_token", true),
                    'created_by' => $this->session->userdata('admin_id'),
                    /* 'additional_pickup' => json_encode($additionalpickup1),
                      'additional_delivery' => json_encode($additionaldelivery1), */
                    'additional_pickup' => $additionalpickup,
                    'additional_delivery' => $additionaldelivery,
                    'is_cost_price_updated'=>'1',
                    'booking_created_by'=>$this->session->admin_id,
                    'storage_agreement_recieved' => $this->input->post('storageAgreementRecieved', true),
                    'en_storage_provider_street'=> $this->input->post('en_storage_provider_street',true),
                    'en_storage_provider_postcode'=>$this->input->post('en_storage_provider_postcode',true),
                    'en_storage_provider_suburb'=>$this->input->post('en_storage_provider_suburb',true),
                    'en_storage_provider_state'=>$this->input->post('en_storage_provider_state',true),
                    'en_storage_reminder_date'=>$storageReminderDate,
                    'en_storage_notify_date'=>$storageNotifyDate,
                    'photo_id_received'=>$this->input->post('photoIdReceived',true),
                );
                if ($this->input->post("en_servicedate", true) == "")
                    unset($data['en_servicedate']);
                if ($this->input->post("en_deliverydate", true) == "")
                    unset($data['en_deliverydate']);
                if ($this->input->post("en_storagedate", true) == "")
                    unset($data['en_storagedate']);
                if ($this->input->post("en_anniversarydate", true) == "")
                    unset($data['en_anniversarydate']);
                if ($this->input->post("en_eft_receivedon", true) == "")
                    unset($data['en_eft_receivedon']);
                if ($this->input->post("final_payment_eft_payment", true) == "")
                    unset($data['final_payment_eft_payment']);

                $this->upload->do_upload('notes_attachedfile');

//        echo "<pre>";
//        print_r($this->upload->data());
//        die;
                $notesdata = array(
                    'notes_description' => $this->input->post("notes_description", true),
                    'notes_attachedfile' => $this->upload->data("file_name"),
                    'is_from' => 1
                );


                $uniqueId = $this->booking_model->addBookingdata($data);
                /* Add firstname and lastname when add booking data directly...........@DRCZ */
                $this->load->model("contact_model");
                $contactdata = $this->contact_model->getClientByUUID($uniqueId);

                $contactList = array(
                    'en_fname' => $contactdata['contact_fname'],
                    'en_lname' => $contactdata['contact_lname'],
                );

                $this->load->model("booking_model");
                $this->booking_model->updateEnquiryName($contactList, $uniqueId);

                $this->load->model("enquiry_model");
                $enqId = $this->enquiry_model->getEnquiryIDFromUUID($uniqueId);
                /* if ($uniqueId !== FALSE) {
                  if ($this->booking_model->addNotes($notesdata, $enqId)) {
                  echo json_encode(array("success" => 1, 'uniqueid' => $uniqueId));
                  }
                  } else {
                  echo json_encode(array("error" => "<p>Data are not inserted.</p>"));
                  } */
                if ($uniqueId !== FALSE) {
                    if ($notesdata['notes_description'] != "") {
                        $this->booking_model->addNotes($notesdata, $enqId);
                    }
                    echo json_encode(array("success" => 1, 'uniqueid' => $uniqueId));
                } else {
                    echo json_encode(array("error" => "<p>Data are not inserted.</p>"));
                }
            }
        }
    }

    public function bookingemail_check($en_email) {
        if ($en_email != "") {
            if (!filter_var($en_email, FILTER_VALIDATE_EMAIL)) {
                $this->form_validation->set_message('bookingemail_check', 'Email address is not valid');
                return false;
            } else {
                return true;
            }
        }
    }

    public function editBookingData() {
        //  echo "hiiii";

        /* echo "<pre";
          print_r($_POST);
          die; */
        $this->load->model("booking_model");
        $enquiryId = $this->input->post("enquiry_id");
        $enquiryUUIDId = $this->input->post("en_unique_id");

        $config['upload_path'] = 'assets/uploads/notes/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $additionalpickup1 = array(
            'en_addpickup_street' => $this->input->post("en_addpickup_street", true),
            'en_addpickup_postcode' => $this->input->post("en_addpickup_postcode", true),
            'en_addpickup_suburb' => $this->input->post("en_addpickup_suburb", true),
            'en_addpickup_state' => $this->input->post("en_addpickup_state", true),
        );
        $additionaldelivery1 = array(
            'en_adddelivery_street' => $this->input->post("en_adddelivery_street", true),
            'en_adddelivery_postcode' => $this->input->post("en_adddelivery_postcode", true),
            'en_adddelivery_suburb' => $this->input->post("en_adddelivery_suburb", true),
            'en_adddelivery_state' => $this->input->post("en_adddelivery_state", true),
        );
        /* if ($additionalpickup1['en_addpickup_suburb'][0] != "") {
          $additionalpickup = json_encode($additionalpickup1);
          }
          if ($additionaldelivery1['en_adddelivery_suburb'][0] != "") {
          $additionaldelivery = json_encode($additionaldelivery1);
          } */
        foreach ($additionalpickup1['en_addpickup_suburb'] as $pickupKey => $pickupValue) {
            if (trim($pickupValue) == "") {
                unset($additionalpickup1['en_addpickup_suburb'][$pickupKey]);
                unset($additionalpickup1['en_addpickup_postcode'][$pickupKey]);
                unset($additionalpickup1['en_addpickup_street'][$pickupKey]);
                unset($additionalpickup1['en_addpickup_state'][$pickupKey]);
            }
        }
        $additionalpickup = json_encode($additionalpickup1);

        foreach ($additionaldelivery1['en_adddelivery_suburb'] as $deliveryKey => $deliveryValue) {
            if (trim($deliveryValue) == "") {
                unset($additionaldelivery1['en_adddelivery_suburb'][$deliveryKey]);
                unset($additionaldelivery1['en_adddelivery_postcode'][$deliveryKey]);
                unset($additionaldelivery1['en_adddelivery_street'][$deliveryKey]);
                unset($additionaldelivery1['en_adddelivery_state'][$deliveryKey]);
            }
        }
        $additionaldelivery = json_encode($additionaldelivery1);

        $storageReminderDate='';
        $storageNotifyDate='';
        if($this->input->post("en_movetype") == 6){
            $storageReminderDate = $this->input->post('storageReminderDate',true);   
            if($storageReminderDate == ''){
                $storageReminderDate = date('Y-m-d', strtotime($this->input->post("en_storagedate", true).'+1 month -1 day'));
            }
            else{
                $storageReminderDate = date('Y-m-d', strtotime($this->input->post('storageReminderDate',true)));
            }

            $currentNotifyDate = getStorageNotifyDate($enquiryId);
            if($currentNotifyDate['en_storage_notify_date'] == '0000-00-00'){
                $tempStorageDate = $this->input->post('en_storagedate');
                $tempDate= date('d',strtotime($tempStorageDate));
                $currentMonth=date('m');
                $currentYear=date('Y');
                $fullDate= $currentYear.'-'.$currentMonth.'-'.$tempDate;
                $storageNotifyDate=date('Y-m-d',strtotime($fullDate.'+1 month'));
            }
            else if(strtotime($currentNotifyDate['en_storage_notify_date']) < strtotime(date('Y-m-d'))){
                $tempStorageDate = $currentNotifyDate['en_storage_notify_date'];
                $tempDate= date('d',strtotime($tempStorageDate));
                $currentMonth=date('m');
                $currentYear=date('Y');
                $fullDate= $currentYear.'-'.$currentMonth.'-'.$tempDate;
                $storageNotifyDate=date('Y-m-d',strtotime($fullDate.'+1 month'));
            }
            else{
                $storageNotifyDate=$currentNotifyDate['en_storage_notify_date'];
            }
        }

        $data = array(
            'booking_status' => $this->input->post("booking_status", true),
            'en_movetype' => $this->input->post("en_movetype", true),
            'en_home_office' => $this->input->post("en_home_office", true),
            'en_servicedate' => date('Y-m-d', strtotime($this->input->post("en_servicedate", true))),
            'en_servicetime' => $this->input->post("serviceFullTime", true),
            'en_deliverydate' => date('Y-m-d', strtotime($this->input->post("en_deliverydate", true))),
            'en_deliverytime' => $this->input->post("en_deliverytime", true),
            'en_storagedate' => date('Y-m-d', strtotime($this->input->post("en_storagedate", true))),
            'customer_id' => $this->input->post("customer_id", true),
            'en_phone' => $this->input->post("en_phone", true),
            'en_email' => $this->input->post("en_email", true),
            'en_storage_provider' => $this->input->post("en_storage_provider", true),
            'en_storage_address' => $this->input->post("en_storage_address", true),
            'en_storage_phno' => $this->input->post("en_storage_phno", true),
            'contact_id' => $this->input->post("contact_id", true),
            'en_packer_selection' => $this->input->post("en_packer_selection", true),
            'en_note' => $this->input->post("en_note", true),
            'en_movingfrom_street' => $this->input->post("en_movingfrom_street", true),
            'en_movingfrom_postcode' => $this->input->post("en_movingfrom_postcode", true),
            'en_movingfrom_suburb' => $this->input->post("en_movingfrom_suburb", true),
            'en_movingfrom_state' => $this->input->post("en_movingfrom_state", true),
            'en_movingto_street' => $this->input->post("en_movingto_street", true),
            'en_movingto_postcode' => $this->input->post("en_movingto_postcode", true),
            'en_movingto_suburb' => $this->input->post("en_movingto_suburb", true),
            'en_movingto_state' => $this->input->post("en_movingto_state", true),
//            'en_addpickup_street' => $this->input->post("en_addpickup_street", true),
//            'en_addpickup_postcode' => $this->input->post("en_addpickup_postcode", true),
//            'en_addpickup_suburb' => $this->input->post("en_addpickup_suburb", true),
//            'en_addpickup_state' => $this->input->post("en_addpickup_state", true),
//            'en_adddelivery_street' => $this->input->post("en_adddelivery_street", true),
//            'en_adddelivery_postcode' => $this->input->post("en_adddelivery_postcode", true),
//            'en_adddelivery_suburb' => $this->input->post("en_adddelivery_suburb", true),
//            'en_adddelivery_state' => $this->input->post("en_adddelivery_state", true),
            'client_feedback' => $this->input->post("client_feedback", true),
            'en_referral_source' => $this->input->post("en_referral_source", true),
            'en_promotional_code' => $this->input->post("en_promotional_code", true),
            'en_deposit_amt' => $this->input->post("en_deposit_amt", true),
            'en_no_of_movers' => $this->input->post("en_no_of_movers", true),
            'en_no_of_trucks' => $this->input->post("en_no_of_trucks", true),
            'en_initial_hours_booked' => $this->input->post("en_initial_hours_booked", true),
            'en_ladies_booked' => $this->input->post("en_ladies_booked", true),
            'en_initial_sellprice' => $this->input->post("en_initial_sellprice", true),
            'en_travelfee' => $this->input->post("en_travelfee", true),
            'en_client_hourly_rate' => $this->input->post("en_client_hourly_rate", true),
            'en_additional_charges' => $this->input->post("en_additional_charges", true),
            'en_additional_item' => $this->input->post("en_additional_item", true),
            'en_additional_charges_cost' => $this->input->post("en_additional_charges_cost", true),
            'en_total_sellprice' => $this->input->post("en_total_sellprice", true),
            'en_total_costprice' => $this->input->post("en_total_costprice", true),
            'en_cubic_meters_booked' => $this->input->post("en_cubic_meters_booked", true),
            'en_noof_modules_required' => $this->input->post("en_noof_modules_required", true),
            'en_cubic_meters_bystorage' => $this->input->post("en_cubic_meters_bystorage", true),
            'en_quotedsell_price' => $this->input->post("en_quotedsell_price", true),
            'en_quotedcost_price' => $this->input->post("en_quotedcost_price", true),
            'en_hireamover_margin' => $this->input->post("en_hireamover_margin", true),
            'en_amountDueNow' => $this->input->post("en_amountDueNow", true),
            'en_deposit_received' => $this->input->post("en_deposit_received", true),
            'en_deposit_paidby' => $this->input->post("en_deposit_paidby", true),
            'en_month_payment_received' => $this->input->post("en_month_payment_received", true),
            'en_paymentmethod' => $this->input->post("en_paymentmethod", true),
            'en_anniversarydate' => date('Y-m-d', strtotime($this->input->post("en_anniversarydate", true))),
            'en_ewayrecurring_payment' => $this->input->post("en_ewayrecurring_payment", true),
            'en_futurepayment_log' => $this->input->post("en_futurepayment_log", true),
            'en_eway_refno' => $this->input->post("en_eway_refno", true),
            'en_eft_receivedon' => date('Y-m-d', strtotime($this->input->post("en_eft_receivedon", true))),
            'final_payment_receivedby' => $this->input->post("final_payment_receivedby", true),
            'final_payment_eway_refno' => $this->input->post("final_payment_eway_refno", true),
            'final_payment_eft_payment' => date('Y-m-d', strtotime($this->input->post("final_payment_eft_payment", true))),
            'head_office_paid' => $this->input->post("head_office_paid", true),
            'en_packing_company_paid' => $this->input->post("en_packing_company_paid", true),
            'removalist_paid' => $this->input->post("removalist_paid", true),
            'en_eway_token' => $this->input->post("en_eway_token", true),
            'created_by' => $this->session->userdata('admin_id'),
            /* 'additional_pickup' => json_encode($additionalpickup1),
              'additional_delivery' => json_encode($additionaldelivery1), */
            'additional_pickup' => $additionalpickup,
            'additional_delivery' => $additionaldelivery,
            'is_cost_price_updated'=>'1',
            'storage_agreement_recieved' => $this->input->post('storageAgreementRecieved', true),
            'en_storage_provider_street'=> $this->input->post('en_storage_provider_street',true),
            'en_storage_provider_postcode'=>$this->input->post('en_storage_provider_postcode',true),
            'en_storage_provider_suburb'=>$this->input->post('en_storage_provider_suburb',true),
            'en_storage_provider_state'=>$this->input->post('en_storage_provider_state',true),
            'en_storage_reminder_date'=>$storageReminderDate,
            'en_storage_notify_date'=>$storageNotifyDate,
            'photo_id_received'=>$this->input->post('photoIdReceived',true),
        );
        if ($this->input->post("en_servicedate", true) == "")
            $data['en_servicedate'] = NULL;
        if ($this->input->post("en_deliverydate", true) == "")
            $data['en_deliverydate'] = NULL;
        if ($this->input->post("en_storagedate", true) == "")
            $data['en_storagedate'] = NULL;
        if ($this->input->post("en_anniversarydate", true) == "")
            $data['en_anniversarydate'] = NULL;
        if ($this->input->post("en_eft_receivedon", true) == "")
            $data['en_eft_receivedon'] = NULL;
        if ($this->input->post("final_payment_eft_payment", true) == "")
            $data['final_payment_eft_payment'] = NULL;

        $filedata = $this->upload->do_upload('notes_attachedfile');
        if (!$this->upload->do_upload('notes_attachedfile'))
            $this->upload->display_errors();

        $notesdata = array(
            //'enquiry_id' => $this->input->post("enquiry_id"),
            // 'notes_title' => $this->input->post("notes_title", true),
            'notes_description' => $this->input->post("notes_description", true),
            'notes_attachedfile' => $this->upload->data("file_name"),
            'is_from' => 1
        );

        //enquiry update log start...........................@DRCZ
        $this->load->model("enquiry_model");
        $enqdata = $this->enquiry_model->getEnquiryDataByUUID($enquiryUUIDId);

//        echo "db"."<pre>";   
       // pr($data);prd($enqdata);

        $diffarray1 = array_diff_assoc($data, $enqdata[0]);
        $diffarray = array_filter($diffarray1);
       // echo "diff"."<pre>";
       // print_r($diffarray);
       // die;
        if ($data['en_movetype'] == "1" || $data['en_movetype'] == "2") {
            $diffData = array(
                'booking_status' => "Booking status",
                'en_movetype' => "Enquiry movetype",
                'en_home_office' => "home/office",
                'en_servicedate' => "Service Date",
                'en_servicetime' => "Service Time",
                'en_deliverydate' => "Delivery Date",
                'en_deliverytime' => "Delivery Time",
                'en_storagedate' => "Storage Date",
                'customer_id' => "Client name",
                'en_phone' => "Phone no",
                'en_email' => "Email",
                'en_storage_provider' => "Storage Provider",
                'en_storage_address' => "Storage Address",
                'en_storage_phno' => "Storage Phone",
                'contact_id' => "removalist/packers",
                'en_packer_selection' => "Packer selection",
                'en_note' => "Jobsheet notes",
                'en_movingfrom_street' => "moving from street",
                'en_movingfrom_postcode' => "moving from postcode",
                'en_movingfrom_suburb' => "moving from suburb",
                'en_movingfrom_state' => "moving from state",
                'en_movingto_street' => "moving to street",
                'en_movingto_postcode' => "moving to postcode",
                'en_movingto_suburb' => "moving to suburb",
                'en_movingto_state' => "moving to state",
                'en_deposit_amt' => "Deposit amount",
                'en_no_of_movers' => "No of Movers",
                'en_no_of_trucks' => "No of Trucks",
                'en_initial_hours_booked' => "Initial hours booked",
                'en_ladies_booked' => "No of ladies booked",
                'en_initial_sellprice' => "Initial sell price",
                'en_travelfee' => "Travel fee",
                'en_travelfee_cost' => "Travel fee cost",
                'en_client_hourly_rate' => "Client hourly rate",
                'en_additional_charges' => "Additional charges",
                'en_additional_item' => "Additional item",
                'en_additional_charges_cost' => "Additional charges cost",
                'en_total_sellprice' => "Total sell price",
                'en_total_costprice' => "Total cost price",
                'en_cubic_meters_booked' => "Cubic meters booked",
                'en_noof_modules_required' => "No of module required",
                'en_cubic_meters_bystorage' => "Cubic meters by storage",
                'en_quotedsell_price' => "Quote sell price",
                'en_quotedcost_price' => "Quote cost price",
                'en_hireamover_margin' => "Hireamover margin",
                'en_amountDueNow' => "Amount due now",
                'en_deposit_received' => "Deposit received",
                'en_deposit_paidby' => "Deposit paidby",
                'en_month_payment_received' => "First month's payment received",
                'en_paymentmethod' => "Payment method",
                'en_anniversarydate' => "Anniversary date",
                'en_ewayrecurring_payment' => "Eway recurring payment",
                'en_futurepayment_log' => "Future payment log",
                'en_eway_refno' => "Eway reference no",
                'en_eft_receivedon' => "Eft received on",
                'en_packing_company_paid' => "Packing company paid",
                'final_payment_receivedby' => "Final payment received by",
                'final_payment_eway_refno' => "Final payment eway ref no",
                'final_payment_eft_payment' => "Final eft payment",
                'head_office_paid' => "Head office paid",
                'removalist_paid' => "Removalist paid",
                'en_eway_token' => "Eway token",
                'en_referral_source' => "Referral source",
                'en_promotional_code' => "Promotional code",
                'additional_pickup' => "Additional Pickup",
                'additional_delivery' => "Additional Delivery",
                'client_feedback' => "Client feedback"
            );
        } else if ($data['en_movetype'] == "4" || $data['en_movetype'] == "7") {
            $diffData = array(
                'booking_status' => "Booking status",
                'en_movetype' => "Enquiry movetype",
                'en_home_office' => "home/office",
                'en_servicedate' => "Service Date",
                'en_servicetime' => "Service Time",
                'en_deliverydate' => "Delivery Date",
                'en_deliverytime' => "Delivery Time",
                'en_storagedate' => "Storage Date",
                'customer_id' => "Client name",
                'en_phone' => "Phone no",
                'en_email' => "Email",
                'en_storage_provider' => "Storage Provider",
                'en_storage_address' => "Storage Address",
                'en_storage_phno' => "Storage Phone",
                'contact_id' => "removalist/packers",
                'en_packer_selection' => "Packer selection",
                'en_note' => "Jobsheet notes",
                'en_movingfrom_street' => "moving from street",
                'en_movingfrom_postcode' => "moving from postcode",
                'en_movingfrom_suburb' => "moving from suburb",
                'en_movingfrom_state' => "moving from state",
                'en_deposit_amt' => "Deposit amount",
                'en_no_of_movers' => "No of Movers",
                'en_no_of_trucks' => "No of Trucks",
                'en_initial_hours_booked' => "Initial hours booked",
                'en_ladies_booked' => "No of ladies booked",
                'en_initial_sellprice' => "Initial sell price",
                'en_travelfee' => "Travel fee",
                'en_travelfee_cost' => "Travel fee cost",
                'en_client_hourly_rate' => "Client hourly rate",
                'en_additional_charges' => "Additional charges",
                'en_additional_item' => "Additional item",
                'en_additional_charges_cost' => "Additional charges cost",
                'en_total_sellprice' => "Total sell price",
                'en_total_costprice' => "Total cost price",
                'en_cubic_meters_booked' => "Cubic meters booked",
                'en_noof_modules_required' => "No of module required",
                'en_cubic_meters_bystorage' => "Cubic meters by storage",
                'en_quotedsell_price' => "Quote sell price",
                'en_quotedcost_price' => "Quote cost price",
                'en_hireamover_margin' => "Hireamover margin",
                'en_amountDueNow' => "Amount due now",
                'en_deposit_received' => "Deposit received",
                'en_deposit_paidby' => "Deposit paidby",
                'en_month_payment_received' => "First month's payment received",
                'en_paymentmethod' => "Payment method",
                'en_anniversarydate' => "Anniversary date",
                'en_ewayrecurring_payment' => "Eway recurring payment",
                'en_futurepayment_log' => "Future payment log",
                'en_eway_refno' => "Eway reference no",
                'en_eft_receivedon' => "Eft received on",
                'en_packing_company_paid' => "Packing company paid",
                'final_payment_receivedby' => "Final payment received by",
                'final_payment_eway_refno' => "Final payment eway ref no",
                'final_payment_eft_payment' => "Final eft payment",
                'head_office_paid' => "Head office paid",
                'removalist_paid' => "Removalist paid",
                'en_eway_token' => "Eway token",
                'en_referral_source' => "Referral source",
                'en_promotional_code' => "Promotional code",
                'client_feedback' => "Client feedback"
            );
        } else if ($data['en_movetype'] == "5" || $data['en_movetype'] == "8") {
            $diffData = array(
                'booking_status' => "Booking status",
                'en_movetype' => "Enquiry movetype",
                'en_home_office' => "home/office",
                'en_servicedate' => "Service Date",
                'en_servicetime' => "Service Time",
                'en_deliverydate' => "Delivery Date",
                'en_deliverytime' => "Delivery Time",
                'en_storagedate' => "Storage Date",
                'customer_id' => "Client name",
                'en_phone' => "Phone no",
                'en_email' => "Email",
                'en_storage_provider' => "Storage Provider",
                'en_storage_address' => "Storage Address",
                'en_storage_phno' => "Storage Phone",
                'contact_id' => "removalist/packers",
                'en_packer_selection' => "Packer selection",
                'en_note' => "Jobsheet notes",
                'en_movingto_street' => "moving to street",
                'en_movingto_postcode' => "moving to postcode",
                'en_movingto_suburb' => "moving to suburb",
                'en_movingto_state' => "moving to state",
                'en_deposit_amt' => "Deposit amount",
                'en_no_of_movers' => "No of Movers",
                'en_no_of_trucks' => "No of Trucks",
                'en_initial_hours_booked' => "Initial hours booked",
                'en_ladies_booked' => "No of ladies booked",
                'en_initial_sellprice' => "Initial sell price",
                'en_travelfee' => "Travel fee",
                'en_travelfee_cost' => "Travel fee cost",
                'en_client_hourly_rate' => "Client hourly rate",
                'en_additional_charges' => "Additional charges",
                'en_additional_item' => "Additional item",
                'en_additional_charges_cost' => "Additional charges cost",
                'en_total_sellprice' => "Total sell price",
                'en_total_costprice' => "Total cost price",
                'en_cubic_meters_booked' => "Cubic meters booked",
                'en_noof_modules_required' => "No of module required",
                'en_cubic_meters_bystorage' => "Cubic meters by storage",
                'en_quotedsell_price' => "Quote sell price",
                'en_quotedcost_price' => "Quote cost price",
                'en_hireamover_margin' => "Hireamover margin",
                'en_amountDueNow' => "Amount due now",
                'en_deposit_received' => "Deposit received",
                'en_deposit_paidby' => "Deposit paidby",
                'en_month_payment_received' => "First month's payment received",
                'en_paymentmethod' => "Payment method",
                'en_anniversarydate' => "Anniversary date",
                'en_ewayrecurring_payment' => "Eway recurring payment",
                'en_futurepayment_log' => "Future payment log",
                'en_eway_refno' => "Eway reference no",
                'en_eft_receivedon' => "Eft received on",
                'en_packing_company_paid' => "Packing company paid",
                'final_payment_receivedby' => "Final payment received by",
                'final_payment_eway_refno' => "Final payment eway ref no",
                'final_payment_eft_payment' => "Final eft payment",
                'head_office_paid' => "Head office paid",
                'removalist_paid' => "Removalist paid",
                'en_eway_token' => "Eway token",
                'en_referral_source' => "Referral source",
                'en_promotional_code' => "Promotional code",
                'client_feedback' => "Client feedback"
            );
        } else if ($data['en_movetype'] == "6") {
            $diffData = array(
                'booking_status' => "Booking status",
                'en_movetype' => "Enquiry movetype",
                'en_home_office' => "home/office",
                'en_servicedate' => "Service Date",
                'en_servicetime' => "Service Time",
                'en_deliverydate' => "Delivery Date",
                'en_deliverytime' => "Delivery Time",
                'en_storagedate' => "Storage Date",
                'customer_id' => "Client name",
                'en_phone' => "Phone no",
                'en_email' => "Email",
                'en_storage_provider' => "Storage Provider",
                'en_storage_address' => "Storage Address",
                'en_storage_phno' => "Storage Phone",
                'contact_id' => "removalist/packers",
                'en_packer_selection' => "Packer selection",
                'en_note' => "Jobsheet notes",
                'en_movingfrom_street' => "moving from street",
                'en_movingfrom_postcode' => "moving from postcode",
                'en_movingfrom_suburb' => "moving from suburb",
                'en_movingfrom_state' => "moving from state",
                'en_movingto_street' => "moving to street",
                'en_movingto_postcode' => "moving to postcode",
                'en_movingto_suburb' => "moving to suburb",
                'en_movingto_state' => "moving to state",
                'en_deposit_amt' => "Deposit amount",
                'en_no_of_movers' => "No of Movers",
                'en_no_of_trucks' => "No of Trucks",
                'en_initial_hours_booked' => "Initial hours booked",
                'en_ladies_booked' => "No of ladies booked",
                'en_initial_sellprice' => "Initial sell price",
                'en_travelfee' => "Travel fee",
                'en_travelfee_cost' => "Travel fee cost",
                'en_client_hourly_rate' => "Client hourly rate",
                'en_additional_charges' => "Additional charges",
                'en_additional_item' => "Additional item",
                'en_additional_charges_cost' => "Additional charges cost",
                'en_total_sellprice' => "Total sell price",
                'en_total_costprice' => "Total cost price",
                'en_cubic_meters_booked' => "Modules taken",
                'en_noof_modules_required' => "No of module required",
                'en_cubic_meters_bystorage' => "Cubic meters by storage",
                'en_quotedsell_price' => "Total Sell Price",
                'en_quotedcost_price' => "Total Cost Price",
                'en_hireamover_margin' => "Hireamover margin",
                'en_amountDueNow' => "Amount due now",
                'en_deposit_received' => "Deposit received",
                'en_deposit_paidby' => "Deposit paidby",
                'en_month_payment_received' => "First month's payment received",
                'en_paymentmethod' => "Payment method",
                'en_anniversarydate' => "Anniversary date",
                'en_ewayrecurring_payment' => "Eway recurring payment",
                'en_futurepayment_log' => "Future payment log",
                'en_eway_refno' => "Eway reference no",
                'en_eft_receivedon' => "Eft received on",
                'en_packing_company_paid' => "Packing company paid",
                'final_payment_receivedby' => "Final payment received by",
                'final_payment_eway_refno' => "Final payment eway ref no",
                'final_payment_eft_payment' => "Final eft payment",
                'head_office_paid' => "Head office paid",
                'removalist_paid' => "Removalist paid",
                'en_eway_token' => "Eway token",
                'en_referral_source' => "Referral source",
                'en_promotional_code' => "Promotional code",
                'client_feedback' => "Client feedback",
                'en_storage_provider' => "Storage Provider",
                'en_storage_provider_street' => 'Storage Provider Street',
                'en_storage_provider_postcode' => 'Storage Provider Postcode',
                'en_storage_provider_suburb' =>'Storage Provider Suburb',
                'en_storage_provider_state' => 'Storage Provider State',
                'storage_agreement_recieved' =>'Storage Agreement Recieved',
                'en_storage_reminder_date'=>'Storage Payment Reminder Date',
                'photo_id_received'=> 'Photo ID Received',
            );
        }

        $diffKey = implode(",", array_intersect_key($diffData, $diffarray));
        $enquiryLogData = array(
            'enquiry_id' => $enquiryId,
            'enquiry_session_id' => $this->session->userdata('admin_id'),
            'enquiry_status' => $diffKey,
            'is_from' => 1,
        );
//    echo "<pre>";
//    print_r($enquiryLogData);
//    die;
//enquiry update log end...........................@DRCZ

        $client_companyName = array(
            'company_name' => $this->input->post("company_name"),
        );
        $clientID = $this->input->post("customer_id", true);

        if ($notesdata['notes_description'] != "" && $notesdata['notes_description'] != "") {
            if ($this->booking_model->addNotes($notesdata, $enquiryId) !== FALSE) {
                if ($this->booking_model->editBookingById($enquiryId, $data)) {
                    if ($diffKey != "") {
                        $this->enquiry_model->AddEnquiryUpdateLog($enquiryLogData);
                    }
                    if ($this->input->post("company_name") != "") {
                        $this->booking_model->editCompanyNameById($clientID, $client_companyName);
                    }
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => "<p>Data are not updated.</p>"));
                }
            }
        } else {
            if ($this->booking_model->editBookingById($enquiryId, $data)) {
                if ($diffKey != "") {
                    $this->enquiry_model->AddEnquiryUpdateLog($enquiryLogData);
                }
                if ($this->input->post("company_name") != "") {
                    $this->booking_model->editCompanyNameById($clientID, $client_companyName);
                }
                echo json_encode(array("success" => 1));
            } else {
                echo json_encode(array("error" => "<p>Data are not updated.</p>"));
            }
        }
    }

    public function getCustomerid() {
        $this->load->model('booking_model');
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->booking_model->getCustomerName($q);
        }
    }

    public function getBookingdataforDuplicate($bk_unique_ids) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->load->model('booking_model');
        if (isset($bk_unique_ids)) {
            $bookid = $this->booking_model->getDuplicateBookingData($bk_unique_ids);
            if ($bookid !== FALSE) {
                echo json_encode(array("success" => 1, "id" => $bookid));
            } else {
                echo json_encode(array("error" => 1));
            }
        }
    }

    public function deleteBooking($id) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->load->model("booking_model");
        $this->booking_model->disableBooking($id);
        echo json_encode(array("success" => 1));
    }

    public function deleteNotes($notes_id) {
//        echo $notes_id;
//        die;
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->load->model("booking_model");
        $this->booking_model->disableNotes($notes_id);
        echo json_encode(array("success" => 1));
    }

    public function getpackerid($enqstate) {
        $this->load->model('booking_model');
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->booking_model->getPackerName($q, $enqstate);
        }
    }

    function fetchNotes($enquiryID) {
//        echo $enquiryID;
//        die;
        $this->load->model("booking_model");
        $data['notes'] = $this->booking_model->getNotesById($enquiryID);
//        print_r( $data['notes']);
//        die;
        echo $this->load->view('enquiries_notes_view.php', $data, true);
    }

    public function editJobsheetMail($EnquiryId, $templateID = "4") {

        $data['jsFooter'] = array(
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/bootstrap-summernote/summernote.min.js',
            'custom/js/edit-email_template.js'
        );
        $data['css'] = array(
            'global/plugins/bootstrap-summernote/summernote.css',
        );



        $this->load->model('booking_model');
        $data['enquiry_data'] = $this->booking_model->getBookingDataByBookingID($EnquiryId);

        $this->load->model("email_template_model");
        $data['form_data'] = $this->email_template_model->getEmailTemplate($data['enquiry_data'][0]['en_movetype'], $templateID);
//        echo "<pre>";
//        print_r($data['enquiry_data']);
//        die;
        if ($data['form_data'] === FALSE) {
            show_404();
        }
        if ($data['form_data'] !== FALSE) {
            $encodeData = "";
            unset($data['form_data'][0]['email_to']);

            if ($data['enquiry_data'][0]["en_movingfrom_street"] != "") {
                $fromadd = $data['enquiry_data'][0]["en_movingfrom_street"] . ", " . $data['enquiry_data'][0]['en_movingfrom_suburb'] . ',' . $data['enquiry_data'][0]['en_movingfrom_state'] . ', ' . $data['enquiry_data'][0]['en_movingfrom_postcode'];
            } else {
                $fromadd = $data['enquiry_data'][0]['en_movingfrom_suburb'] . ',' . $data['enquiry_data'][0]['en_movingfrom_state'] . ', ' . $data['enquiry_data'][0]['en_movingfrom_postcode'];
            }
            if ($data['enquiry_data'][0]["en_movingto_street"] != "") {
                $toadd = $data['enquiry_data'][0]["en_movingto_street"] . ", " . $data['enquiry_data'][0]['en_movingto_suburb'] . ',' . $data['enquiry_data'][0]['en_movingto_state'] . ', ' . $data['enquiry_data'][0]['en_movingto_postcode'];
            } else {
                $toadd = $data['enquiry_data'][0]['en_movingto_suburb'] . ',' . $data['enquiry_data'][0]['en_movingto_state'] . ', ' . $data['enquiry_data'][0]['en_movingto_postcode'];
            }

            $pickupdata = json_decode($data['enquiry_data'][0]['additional_pickup'], true);

            $deliverydata = json_decode($data['enquiry_data'][0]['additional_delivery'], true);
            /**
            * Additional Items in Email
            */
            $data['enquiry_data'][0]['en_additional_charges'] = trim($data['enquiry_data'][0]['en_additional_charges']);
            $data['enquiry_data'][0]['en_additional_item'] = trim($data['enquiry_data'][0]['en_additional_item']);
            if ($data['enquiry_data'][0]['en_additional_charges'] != "" && $data['enquiry_data'][0]['en_additional_charges'] != NULL && $data['enquiry_data'][0]['en_additional_charges'] != "NULL" && $data['enquiry_data'][0]['en_additional_item'] != "" && $data['enquiry_data'][0]['en_additional_item'] != NULL && $data['enquiry_data'][0]['en_additional_item'] != "NULL") {
                $data['form_data'][0]['email_editor'] = str_replace("{{additional-items}}", "Additional item :</span> <span> " . $data['enquiry_data'][0]['en_additional_item'], $data['form_data'][0]['email_editor']);
            } else {
                $data['form_data'][0]['email_editor'] = str_replace("{{additional-items}}", "", $data['form_data'][0]['email_editor']);
            }
            
            /*  if ($pickupdata['en_addpickup_postcode'] != "") { */
            if (count($pickupdata['en_addpickup_postcode']) > 0) {
                $count = count($pickupdata['en_addpickup_postcode']);
                if ($count > 0) {
                    for ($dd = 0; $dd < $count; $dd++) {
                        $pickuppostcode = $pickupdata['en_addpickup_postcode'][$dd];
                        $pickupsuburb = $pickupdata['en_addpickup_suburb'][$dd];
                        $pickupstate = $pickupdata['en_addpickup_state'][$dd];
                        $pickupstreet = $pickupdata['en_addpickup_street'][$dd];

                        if ($pickupstreet != "") {
                            $Pickup .= "Additional Pickup: " . $pickupstreet . ", " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode . "<br/>";
                            // $Pickup .= '</br>' . $pickupstreet . ", " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode;
                        } else {
                            $Pickup .= "Additional Pickup: " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode . "<br/>";
                            // $Pickup .= '</br>' . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode;
                        }
                    }
                    // $Pickup = '<p style="font-family: Calibri, Geneva, Helvetica, sans-serif; font-size: 14px; color: rgb(68, 84, 106); line-height: 1.4;"><span title="Moving to state">' . "Additional Pickup: " . $Pickup . '</span></p>';
                    //$Pickup = "Additional Pickup: " . $Pickup;
                    $data['form_data'][0]['email_editor'] = str_replace("{{additionalpickup}}", $Pickup, $data['form_data'][0]['email_editor']);
                }
            } else {
                $data['form_data'][0]['email_editor'] = str_replace("{{additionalpickup}}", "", $data['form_data'][0]['email_editor']);
            }
// Delivery data display in booking........................   

            /* if ($deliverydata['en_adddelivery_postcode'] != "") { */
            if (count($deliverydata['en_adddelivery_postcode']) > 0) {
                $count1 = count($deliverydata['en_adddelivery_postcode']);
                if ($count1 > 0) {
                    for ($zz = 0; $zz < $count1; $zz++) {
                        $deliverypostcode = $deliverydata['en_adddelivery_postcode'][$zz];
                        $deliverysuburb = $deliverydata['en_adddelivery_suburb'][$zz];
                        $deliverystate = $deliverydata['en_adddelivery_state'][$zz];
                        $deliverystreet = $deliverydata['en_adddelivery_street'][$zz];

                        if ($deliverystreet != "") {
                            $Delivery .= "Additional Delivery: " . $deliverystreet . ", " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode . "<br/>";
                            // $Delivery .= '</br>' . $deliverystreet . ", " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode;
                        } else {
                            $Delivery .= "Additional Delivery: " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode . "<br/>";
                            // $Delivery .= '</br>' . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode;
                        }
                    }
                    // $Delivery = '<p style="font-family: Calibri, Geneva, Helvetica, sans-serif; font-size: 14px; color: rgb(68, 84, 106); line-height: 1.4;"><span title="Moving to state">' . "Additional Delivery: " . $Delivery . '</span></p>';
                    // $Delivery = "Additional Delivery: " . $Delivery;
                    $data['form_data'][0]['email_editor'] = str_replace("{{additionaldelivery}}", $Delivery, $data['form_data'][0]['email_editor']);
                }
            } else {
                $data['form_data'][0]['email_editor'] = str_replace("{{additionaldelivery}}", "", $data['form_data'][0]['email_editor']);
            }

            if ($data['enquiry_data'][0]['en_movetype'] != 4 && $data['enquiry_data'][0]['en_movetype'] != 5) {
                $movingFromFullAddress = $data['enquiry_data'][0]['en_movingfrom_street'] . ',' . $data['enquiry_data'][0]['en_movingfrom_suburb'] . ',' . $data['enquiry_data'][0]['en_movingfrom_state'] . ',' . $data['enquiry_data'][0]['en_movingfrom_postcode'];
                $movingToFullAddress = $data['enquiry_data'][0]['en_movingto_street'] . ',' . $data['enquiry_data'][0]['en_movingto_suburb'] . ',' . $data['enquiry_data'][0]['en_movingto_state'] . ',' . $data['enquiry_data'][0]['en_movingto_postcode'];
                $data['form_data'][0]['email_to'] = $data['enquiry_data'][0]['removalistEmail'];
                if ($data['enquiry_data'][0]['en_no_of_trucks'] > 1) {
                    $truck = "trucks";
                } else {
                    $truck = "truck";
                }
                $pdfArrayData = array(
                    'template' => 'removalist_local_job_sheet',
                    'UUID' => $data['enquiry_data'][0]['en_unique_id'],
                    'ClientName' => $data['enquiry_data'][0]['clientFname'] . ' ' . $data['enquiry_data'][0]['clientLname'],
                    'phonenumber' => $data['enquiry_data'][0]['en_phone'],
                    'bookeddate' => date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])),
                    'bookedtime' => $data['enquiry_data'][0]['en_servicetime'],
                    'bookedmovers' => $data['enquiry_data'][0]['en_no_of_movers'],
                    'bookedtrucks' => $data['enquiry_data'][0]['en_no_of_trucks'],
                    'bookedtrucksword' => $truck,
                    'movefrom' => $movingFromFullAddress,
                    'moveto' => $movingToFullAddress,
                    'hourlyrate' => $data['enquiry_data'][0]['en_client_hourly_rate'],
                    'travelfee' => $data['enquiry_data'][0]['en_travelfee'],
                    'additionalChargeItem' => 'null',
                    'additionalItemsSell' => 'null',
                    'depositamount' => $data['enquiry_data'][0]['en_deposit_amt'],
                    'JobNotes' => $data['enquiry_data'][0]['en_note'],
                );
                if ($data['enquiry_data'][0]['en_addpickup_state'] != "") {
                    $pdfArrayData['additionalPickupStreet'] = $data['enquiry_data'][0]['en_addpickup_street'];
                    $pdfArrayData['additionalPickupSuburb'] = $data['enquiry_data'][0]['en_addpickup_suburb'];
                }
                if ($data['enquiry_data'][0]['en_adddelivery_state'] != "") {
                    $pdfArrayData['additionalDeliverySuburb'] = $data['enquiry_data'][0]['en_adddelivery_suburb'];
                    $pdfArrayData['additionalDeliveryStreet'] = $data['enquiry_data'][0]['en_adddelivery_street'];
                }
            } else {

                if ($data['enquiry_data'][0]['en_movetype'] == 4) {
                    $movingFullAddress = $data['enquiry_data'][0]['en_movingfrom_street'] . ',' . $data['enquiry_data'][0]['en_movingfrom_suburb'] . ',' . $data['enquiry_data'][0]['en_movingfrom_state'] . ',' . $data['enquiry_data'][0]['en_movingfrom_postcode'];
                } else if ($data['enquiry_data'][0]['en_movetype'] == 5) {
                    $movingFullAddress = $data['enquiry_data'][0]['en_movingto_street'] . ',' . $data['enquiry_data'][0]['en_movingto_suburb'] . ',' . $data['enquiry_data'][0]['en_movingto_state'] . ',' . $data['enquiry_data'][0]['en_movingto_postcode'];
                }
                $moveType = array(4 => 'Packing', 5 => 'Unpacking');
                $packerPaidStatus = $data['enquiry_data'][0]['en_deposit_received'] == 1 ? "Paid" : "Unpaid";
                $this->load->model('contact_model');
                $getPackersEmail = $this->contact_model->getPackerstByUUID($data['enquiry_data'][0]['en_unique_id']);

                if ($getPackersEmail != NULL) {
                    foreach ($getPackersEmail as $em) {
                        $data['form_data'][0]['email_to'] = $em['contact_email'];
                    }
                } else {
                    return false;
                }
                $pdfArrayData = array(
                    'template' => 'packer_job_sheet',
                    'ClientName' => $data['enquiry_data'][0]['clientFname'] . ' ' . $data['enquiry_data'][0]['clientLname'],
                    'eUID' => $data['enquiry_data'][0]['en_unique_id'],
                    'phonenumber' => $data['enquiry_data'][0]['en_phone'],
                    'bookeddate' => date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])),
                    'packerTimeBooked' => $data['enquiry_data'][0]['en_servicetime'],
                    'movefrom' => $movingFullAddress,
                    'moveto' => "null",
                    'moveType' => $moveType[$data['enquiry_data'][0]['en_movetype']],
                    'packerPaidStatus' => $packerPaidStatus,
                );
            }

            $encodeData = base64_encode(json_encode($pdfArrayData));

            $data['templateID'] = $templateID;
            $data['form_data'][0]['EnquiryId'] = $EnquiryId;
            $data['form_data'][0]['clientFname'] = $data['enquiry_data'][0]['clientFname'];
            //$data['form_data'][0]['email_to'] = $data['enquiry_data'][0]['en_email'];
            $data['form_data'][0]['email_editor'] = str_replace("{{amt}}", $data['enquiry_data'][0]["en_deposit_amt"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{uuid}}", $data['enquiry_data'][0]["en_unique_id"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{noofmover}}", $data['enquiry_data'][0]["en_no_of_movers"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{nooftruck}}", $data['enquiry_data'][0]["en_no_of_trucks"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{jobsheetnotes}}", $data['enquiry_data'][0]["en_note"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $data['enquiry_data'][0]["en_client_hourly_rate"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $data['enquiry_data'][0]["en_initial_sellprice"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{noofladiesbooked}}", $data['enquiry_data'][0]["en_ladies_booked"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $data['enquiry_data'][0]["en_initial_hours_booked"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", "Between " . $data['enquiry_data'][0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{tavelfee}}", (int) $data['enquiry_data'][0]["en_travelfee"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_subject']);
            $data['form_data'][0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['en_fname'], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{emailTo}}", $data['enquiry_data'][0]['en_email'], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_subject'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['clientFname'], $data['form_data'][0]['email_subject']);
            $data['form_data'][0]['email_editor'] = str_replace("{{clientfullname}}", $data['enquiry_data'][0]['clientFname'] . ' ' . $data['enquiry_data'][0]['clientLname'], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{date}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{encodedata}}", $encodeData, $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{fromadd}}", $fromadd, $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{toadd}}", $toadd, $data['form_data'][0]['email_editor']);


            $this->load->view("template/header", $this->data);
            $this->load->view("template/css", $data);
            $this->load->view("template/js", $data);
            $this->load->view("editmail", $data);
            $this->load->view("template/footer", $this->data);
        }
    }

    public function editReminderJobsheetMail($EnquiryId, $templateID = "4") {

        $data['jsFooter'] = array(
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/bootstrap-summernote/summernote.min.js',
            'custom/js/edit-email_template.js'
        );
        $data['css'] = array(
            'global/plugins/bootstrap-summernote/summernote.css',
        );



        $this->load->model('booking_model');
        $data['enquiry_data'] = $this->booking_model->getBookingDataByBookingID($EnquiryId);

        $this->load->model("email_template_model");
        $data['form_data'] = $this->email_template_model->getEmailTemplate($data['enquiry_data'][0]['en_movetype'], $templateID);
//        echo "<pre>";
//        print_r($data['enquiry_data']);
//        die;
        if ($data['form_data'] === FALSE) {
            show_404();
        }
        if ($data['form_data'] !== FALSE) {
            $encodeData = "";
            unset($data['form_data'][0]['email_to']);
            if ($data['enquiry_data'][0]['en_movetype'] != 4 && $data['enquiry_data'][0]['en_movetype'] != 5) {
                $movingFromFullAddress = $data['enquiry_data'][0]['en_movingfrom_street'] . ',' . $data['enquiry_data'][0]['en_movingfrom_postcode'] . ',' . $data['enquiry_data'][0]['en_movingfrom_suburb'] . ',' . $data['enquiry_data'][0]['en_movingfrom_state'];
                $movingToFullAddress = $data['enquiry_data'][0]['en_movingto_street'] . ',' . $data['enquiry_data'][0]['en_movingto_postcode'] . ',' . $data['enquiry_data'][0]['en_movingto_suburb'] . ',' . $data['enquiry_data'][0]['en_movingto_state'];
                $data['form_data'][0]['email_to'] = $data['enquiry_data'][0]['removalistEmail'];
                $pdfArrayData = array(
                    'template' => 'removalist_local_job_sheet',
                    'ClientName' => $data['enquiry_data'][0]['clientFname'] . ' ' . $data['enquiry_data'][0]['clientLname'],
                    'phonenumber' => $data['enquiry_data'][0]['clientContactNo'],
                    'bookeddate' => date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])),
                    'bookedtime' => $data['enquiry_data'][0]['en_servicetime'],
                    'bookedmovers' => $data['enquiry_data'][0]['en_no_of_movers'],
                    'bookedtrucks' => $data['enquiry_data'][0]['en_no_of_trucks'],
                    'bookedtrucksword' => 'truck',
                    'movefrom' => $movingFromFullAddress,
                    'moveto' => $movingToFullAddress,
                    'hourlyrate' => $data['enquiry_data'][0]['en_client_hourly_rate'],
                    'travelfee' => $data['enquiry_data'][0]['en_travelfee'],
                    'additionalChargeItem' => 'null',
                    'additionalItemsSell' => 'null',
                    'depositamount' => $data['enquiry_data'][0]['en_deposit_amt'],
                    'JobNotes' => $data['enquiry_data'][0]['en_note'],
                );
                if ($data['enquiry_data'][0]['en_addpickup_state'] != "") {
                    $pdfArrayData['additionalPickupStreet'] = $data['enquiry_data'][0]['en_addpickup_street'];
                    $pdfArrayData['additionalPickupSuburb'] = $data['enquiry_data'][0]['en_addpickup_suburb'];
                }
                if ($data['enquiry_data'][0]['en_adddelivery_state'] != "") {
                    $pdfArrayData['additionalDeliverySuburb'] = $data['enquiry_data'][0]['en_adddelivery_suburb'];
                    $pdfArrayData['additionalDeliveryStreet'] = $data['enquiry_data'][0]['en_adddelivery_street'];
                }
            } else {

                if ($data['enquiry_data'][0]['en_movetype'] == 4) {
                    $movingFullAddress = $data['enquiry_data'][0]['en_movingfrom_street'] . ',' . $data['enquiry_data'][0]['en_movingfrom_postcode'] . ',' . $data['enquiry_data'][0]['en_movingfrom_suburb'] . ',' . $data['enquiry_data'][0]['en_movingfrom_state'];
                } else if ($data['enquiry_data'][0]['en_movetype'] == 5) {
                    $movingFullAddress = $data['enquiry_data'][0]['en_movingto_street'] . ',' . $data['enquiry_data'][0]['en_movingto_postcode'] . ',' . $data['enquiry_data'][0]['en_movingto_suburb'] . ',' . $data['enquiry_data'][0]['en_movingto_state'];
                }
                $moveType = array(4 => 'Packing', 5 => 'Unpacking');
                $packerPaidStatus = $data['enquiry_data'][0]['en_deposit_received'] == 1 ? "Paid" : "Unpaid";
                $this->load->model('contact_model');
                $getPackersEmail = $this->contact_model->getPackerstByUUID($data['enquiry_data'][0]['en_unique_id']);

                if ($getPackersEmail != NULL) {
                    foreach ($getPackersEmail as $em) {
                        $data['form_data'][0]['email_to'] = $em['contact_email'];
                    }
                } else {
                    return false;
                }
                $pdfArrayData = array(
                    'template' => 'packer_job_sheet',
                    'ClientName' => $data['enquiry_data'][0]['clientFname'] . ' ' . $data['enquiry_data'][0]['clientLname'],
                    'eUID' => $data['enquiry_data'][0]['en_unique_id'],
                    'phonenumber' => $data['enquiry_data'][0]['clientContactNo'],
                    'bookeddate' => date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])),
                    'packerTimeBooked' => $data['enquiry_data'][0]['en_servicetime'],
                    'movefrom' => $movingFullAddress,
                    'moveto' => "null",
                    'moveType' => $moveType[$data['enquiry_data'][0]['en_movetype']],
                    'packerPaidStatus' => $packerPaidStatus,
                );
            }

            $encodeData = base64_encode(json_encode($pdfArrayData));

            $data['templateID'] = $templateID;
            $data['form_data'][0]['EnquiryId'] = $EnquiryId;
            $data['form_data'][0]['clientFname'] = $data['enquiry_data'][0]['clientFname'];
            //$data['form_data'][0]['email_to'] = $data['enquiry_data'][0]['en_email'];
            $data['form_data'][0]['email_editor'] = str_replace("{{amt}}", $data['enquiry_data'][0]["en_deposit_amt"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{uuid}}", $data['enquiry_data'][0]["en_unique_id"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{noofmover}}", $data['enquiry_data'][0]["en_no_of_movers"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{nooftruck}}", $data['enquiry_data'][0]["en_no_of_trucks"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $data['enquiry_data'][0]["en_client_hourly_rate"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $data['enquiry_data'][0]["en_initial_sellprice"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{noofladiesbooked}}", $data['enquiry_data'][0]["en_ladies_booked"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $data['enquiry_data'][0]["en_initial_hours_booked"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", "Between " . $data['enquiry_data'][0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{tavelfee}}", (int) $data['enquiry_data'][0]["en_travelfee"], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_subject']);
            $data['form_data'][0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['en_fname'], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{emailTo}}", $data['enquiry_data'][0]['en_email'], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_subject'] = "REMINDER: " . str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['clientFname'], $data['form_data'][0]['email_subject']);
            $data['form_data'][0]['email_editor'] = str_replace("{{clientfullname}}", $data['enquiry_data'][0]['clientFname'] . ' ' . $data['enquiry_data'][0]['clientLname'], $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{date}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{encodedata}}", $encodeData, $data['form_data'][0]['email_editor']);


            $this->load->view("template/header", $this->data);
            $this->load->view("template/css", $data);
            $this->load->view("template/js", $data);
            $this->load->view("editmail", $data);
            $this->load->view("template/footer", $this->data);
        }
    }

    public function editBookingConfirmationMail($EnquiryId, $templateID = "5") {

        $data['jsFooter'] = array(
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/bootstrap-summernote/summernote.min.js',
            'custom/js/edit-email_template.js'
        );
        $data['css'] = array(
            'global/plugins/bootstrap-summernote/summernote.css',
        );

        $this->load->model('enquiry_model');
        $data['enUUId'] = $this->enquiry_model->getEnquiryUUIDFromID($EnquiryId);
        $this->load->model('contact_model');
        $data['packers_data'] = $this->contact_model->getPackerstByUUID($data['enUUId']);
//        echo "<pre>";
//        print_r($data);
//        die;
        foreach ($data['packers_data'] as $packer) {


            if ($packer['contact_fname'] == "") {
                $packers = "null";
            } else {
                $pack[] = $packer['contact_fname'];
                $packers = implode(", ", $pack);
            }
        }

        $this->load->model('booking_model');
        $data['enquiry_data'] = $this->booking_model->getBookingDataByBookingID($EnquiryId);

        $packingstatus = $data['enquiry_data'][0]['en_deposit_received'];
        if ($packingstatus == 0) {
            $packingstatus = "Unpaid";
        } else {
            $packingstatus = "Paid";
        }


        $this->load->model("email_template_model");
        $data['form_data'] = $this->email_template_model->getEmailTemplate($data['enquiry_data'][0]['en_movetype'], $templateID);
        if ($data['form_data'] === FALSE) {
            show_404();
        }
        if ($data['enquiry_data'][0]['en_movingfrom_street'] != "") {
            $fromstreet = $data['enquiry_data'][0]['en_movingfrom_street'] . ", ";
        } else {
            $fromstreet = "";
        }
        if ($data['enquiry_data'][0]['en_movingto_street'] != "") {
            $tostreet = $data['enquiry_data'][0]['en_movingto_street'] . ", ";
        } else {
            $tostreet = "";
        }
        if ($data['enquiry_data'][0]['en_additional_charges'] != "0.00" && $data['enquiry_data'][0]['en_additional_charges'] != NULL) {
            $addcharge = '</br> There is also a charge of $' . $data['enquiry_data'][0]['en_additional_charges'] . ' for ' . $data['enquiry_data'][0]['en_additional_item'] . '.';
        } else {
            $addcharge = '';
        }
        $pickupdata = json_decode($data['enquiry_data'][0]['additional_pickup'], true);

        $deliverydata = json_decode($data['enquiry_data'][0]['additional_delivery'], true);

        if ($pickupdata['en_addpickup_postcode'] != "") {
            $count = count($pickupdata['en_addpickup_postcode']);
            if ($count > 0) {
                for ($dd = 0; $dd < $count; $dd++) {
                    $pickuppostcode = $pickupdata['en_addpickup_postcode'][$dd];
                    $pickupsuburb = $pickupdata['en_addpickup_suburb'][$dd];
                    $pickupstate = $pickupdata['en_addpickup_state'][$dd];
                    $pickupstreet = $pickupdata['en_addpickup_street'][$dd];

                    if ($pickupstreet != "") {
                        $Pickup .= "Additional Pickup: " . $pickupstreet . ", " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode . "<br/>";
                        // $Pickup .= '</br>' . $pickupstreet . ", " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode;
                    } else {
                        $Pickup .= "Additional Pickup: " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode . "<br/>";
                        // $Pickup .= '</br>' . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode;
                    }
                }
                // $Pickup = '<p style="font-family: Calibri, Geneva, Helvetica, sans-serif; font-size: 14px; color: rgb(68, 84, 106); line-height: 1.4;"><span title="Moving to state"><strong>' . "Additional Pickup: " . $Pickup . '</strong></span></p>';
                //$Pickup = "Additional Pickup: " . $Pickup;
                $data['form_data'][0]['email_editor'] = str_replace("{{additionalpickup}}", $Pickup, $data['form_data'][0]['email_editor']);
            }
        } else {
            $data['form_data'][0]['email_editor'] = str_replace("{{additionalpickup}}", "", $data['form_data'][0]['email_editor']);
        }
// Delivery data display in booking........................   

        if ($deliverydata['en_adddelivery_postcode'] != "") {
            $count1 = count($deliverydata['en_adddelivery_postcode']);
            if ($count1 > 0) {
                for ($zz = 0; $zz < $count1; $zz++) {
                    $deliverypostcode = $deliverydata['en_adddelivery_postcode'][$zz];
                    $deliverysuburb = $deliverydata['en_adddelivery_suburb'][$zz];
                    $deliverystate = $deliverydata['en_adddelivery_state'][$zz];
                    $deliverystreet = $deliverydata['en_adddelivery_street'][$zz];

                    if ($deliverystreet != "") {
                        $Delivery .= "Additional Delivery: " . $deliverystreet . ", " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode . "<br/>";
                        // $Delivery .= '</br>' . $deliverystreet . ", " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode;
                    } else {
                        $Delivery .= "Additional Delivery: " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode . "<br/>";
                        // $Delivery .= '</br>' . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode;
                    }
                }
                // $Delivery = '<p style="font-family: Calibri, Geneva, Helvetica, sans-serif; font-size: 14px; color: rgb(68, 84, 106); line-height: 1.4;"><span title="Moving to state"><strong>' . "Additional Delivery: " . $Delivery . '</strong></span></p>';
                // $Delivery = "Additional Delivery: " . $Delivery;
                $data['form_data'][0]['email_editor'] = str_replace("{{additionaldelivery}}", $Delivery, $data['form_data'][0]['email_editor']);
            }
        } else {
            $data['form_data'][0]['email_editor'] = str_replace("{{additionaldelivery}}", "", $data['form_data'][0]['email_editor']);
        }


        $data['templateID'] = $templateID;
        $data['form_data'][0]['EnquiryId'] = $EnquiryId;
        $data['form_data'][0]['email_to'] = $data['enquiry_data'][0]['en_email'];
        $data['form_data'][0]['email_editor'] = str_replace("{{amt}}", $data['enquiry_data'][0]["en_deposit_amt"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{uuid}}", $data['enquiry_data'][0]["en_unique_id"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{noofmover}}", $data['enquiry_data'][0]["en_no_of_movers"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{nooftruck}}", $data['enquiry_data'][0]["en_no_of_trucks"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $data['enquiry_data'][0]["en_client_hourly_rate"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $data['enquiry_data'][0]["en_initial_sellprice"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{noofladiesbooked}}", $data['enquiry_data'][0]["en_ladies_booked"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $data['enquiry_data'][0]["en_initial_hours_booked"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", $data['enquiry_data'][0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{tavelfee}}", number_format($data['enquiry_data'][0]["en_travelfee"], 2), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_subject']);
        $data['form_data'][0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['en_fname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromstate}}", $data['enquiry_data'][0]['en_movingfrom_state'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromstreet}}", $fromstreet, $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfrompostcode}}", $data['enquiry_data'][0]['en_movingfrom_postcode'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromsuburb}}", $data['enquiry_data'][0]['en_movingfrom_suburb'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtostate}}", $data['enquiry_data'][0]['en_movingto_state'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtostreet}}", $tostreet, $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtopostcode}}", $data['enquiry_data'][0]['en_movingto_postcode'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtosuburb}}", $data['enquiry_data'][0]['en_movingto_suburb'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{additionalcharges}}", $addcharge, $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{additionalchargeitem}}", $data['enquiry_data'][0]['en_additional_item'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{emailTo}}", $data['enquiry_data'][0]['en_email'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{packers}}", $packers, $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{status}}", $packingstatus, $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientname}}", $data['enquiry_data'][0]['clientFname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_subject'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['clientFname'], $data['form_data'][0]['email_subject']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientfullname}}", $data['enquiry_data'][0]['clientFname'] . ' ' . $data['enquiry_data'][0]['clientLname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{date}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view("editmail", $data);
        $this->load->view("template/footer", $this->data);
    }

    public function editSendFeedbackMail($EnquiryId, $templateID = "6") {

        $data['jsFooter'] = array(
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/bootstrap-summernote/summernote.min.js',
            'custom/js/edit-email_template.js'
        );
        $data['css'] = array(
            'global/plugins/bootstrap-summernote/summernote.css',
        );

        $this->load->model('booking_model');
        $data['enquiry_data'] = $this->booking_model->getBookingDataByBookingID($EnquiryId);

        $this->load->model("email_template_model");
        $data['form_data'] = $this->email_template_model->getEmailTemplate($data['enquiry_data'][0]['en_movetype'], $templateID);
        if ($data['form_data'] === FALSE) {
            show_404();
        }

        $data['templateID'] = $templateID;
        $data['form_data'][0]['EnquiryId'] = $EnquiryId;
        $data['form_data'][0]['email_to'] = $data['enquiry_data'][0]['en_email'];
        $data['form_data'][0]['email_editor'] = str_replace("{{amt}}", $data['enquiry_data'][0]["en_deposit_amt"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{uuid}}", $data['enquiry_data'][0]["en_unique_id"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{noofmover}}", $data['enquiry_data'][0]["en_no_of_movers"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{nooftruck}}", $data['enquiry_data'][0]["en_no_of_trucks"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $data['enquiry_data'][0]["en_client_hourly_rate"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $data['enquiry_data'][0]["en_initial_sellprice"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{noofladiesbooked}}", $data['enquiry_data'][0]["en_ladies_booked"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $data['enquiry_data'][0]["en_initial_hours_booked"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", "Between " . $data['enquiry_data'][0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{tavelfee}}", (int) $data['enquiry_data'][0]["en_travelfee"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_subject']);
        $data['form_data'][0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['en_fname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromstate}}", $data['enquiry_data'][0]['en_movingfrom_state'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromstreet}}", $data['enquiry_data'][0]['en_movingfrom_street'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfrompostcode}}", $data['enquiry_data'][0]['en_movingfrom_postcode'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromsuburb}}", $data['enquiry_data'][0]['en_movingfrom_suburb'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtostate}}", $data['enquiry_data'][0]['en_movingto_state'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtostreet}}", $data['enquiry_data'][0]['en_movingto_street'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtopostcode}}", $data['enquiry_data'][0]['en_movingto_postcode'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtosuburb}}", $data['enquiry_data'][0]['en_movingto_suburb'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{additionalcharges}}", $data['enquiry_data'][0]['en_additional_charges'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{additionalchargeitem}}", $data['enquiry_data'][0]['en_additional_item'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientname}}", $data['enquiry_data'][0]['clientFname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{emailTo}}", $data['enquiry_data'][0]['en_email'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_subject'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['clientFname'], $data['form_data'][0]['email_subject']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientfullname}}", $data['enquiry_data'][0]['clientFname'] . ' ' . $data['enquiry_data'][0]['clientLname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{date}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view("editmail", $data);
        $this->load->view("template/footer", $this->data);
    }

    /* No Answer Feedback edit..............@DRCZ 17-5-2018 */

    public function editNoAnswerFeedback($EnquiryId, $templateID = "9") {

        $data['jsFooter'] = array(
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/bootstrap-summernote/summernote.min.js',
            'custom/js/edit-email_template.js'
        );
        $data['css'] = array(
            'global/plugins/bootstrap-summernote/summernote.css',
        );

        $this->load->model('booking_model');
        $data['enquiry_data'] = $this->booking_model->getBookingDataByBookingID($EnquiryId);

        $this->load->model("email_template_model");
        $data['form_data'] = $this->email_template_model->getEmailTemplate($data['enquiry_data'][0]['en_movetype'], $templateID);
        if ($data['form_data'] === FALSE) {
            show_404();
        }

        $data['templateID'] = $templateID;
        $data['form_data'][0]['EnquiryId'] = $EnquiryId;
        $data['form_data'][0]['email_to'] = $data['enquiry_data'][0]['en_email'];
        $data['form_data'][0]['email_editor'] = str_replace("{{amt}}", $data['enquiry_data'][0]["en_deposit_amt"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{uuid}}", $data['enquiry_data'][0]["en_unique_id"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{noofmover}}", $data['enquiry_data'][0]["en_no_of_movers"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{nooftruck}}", $data['enquiry_data'][0]["en_no_of_trucks"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{hourlyrate}}", $data['enquiry_data'][0]["en_client_hourly_rate"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{initialsellprice}}", $data['enquiry_data'][0]["en_initial_sellprice"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{noofladiesbooked}}", $data['enquiry_data'][0]["en_ladies_booked"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $data['enquiry_data'][0]["en_initial_hours_booked"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", "Between " . $data['enquiry_data'][0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{tavelfee}}", (int) $data['enquiry_data'][0]["en_travelfee"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_subject']);
        $data['form_data'][0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['en_fname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromstate}}", $data['enquiry_data'][0]['en_movingfrom_state'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromstreet}}", $data['enquiry_data'][0]['en_movingfrom_street'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfrompostcode}}", $data['enquiry_data'][0]['en_movingfrom_postcode'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromsuburb}}", $data['enquiry_data'][0]['en_movingfrom_suburb'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtostate}}", $data['enquiry_data'][0]['en_movingto_state'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtostreet}}", $data['enquiry_data'][0]['en_movingto_street'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtopostcode}}", $data['enquiry_data'][0]['en_movingto_postcode'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtosuburb}}", $data['enquiry_data'][0]['en_movingto_suburb'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{additionalcharges}}", $data['enquiry_data'][0]['en_additional_charges'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{additionalchargeitem}}", $data['enquiry_data'][0]['en_additional_item'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientname}}", $data['enquiry_data'][0]['clientFname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{emailTo}}", $data['enquiry_data'][0]['en_email'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_subject'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['clientFname'], $data['form_data'][0]['email_subject']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientfullname}}", $data['enquiry_data'][0]['clientFname'] . ' ' . $data['enquiry_data'][0]['clientLname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{date}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view("editmail", $data);
        $this->load->view("template/footer", $this->data);
    }

    /* No Answer Feedback edit..............@DRCZ 17-5-2018 */

    public function editSendReminderMail($EnquiryId, $templateID = "7") {

        $data['jsFooter'] = array(
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/bootstrap-summernote/summernote.min.js',
            'custom/js/edit-email_template.js'
        );
        $data['css'] = array(
            'global/plugins/bootstrap-summernote/summernote.css',
        );

        $this->load->model('booking_model');
        $data['enquiry_data'] = $this->booking_model->getBookingDataByBookingID($EnquiryId);

        $this->load->model("email_template_model");
        $data['form_data'] = $this->email_template_model->getEmailTemplate($data['enquiry_data'][0]['en_movetype'], $templateID);
        if ($data['form_data'] === FALSE) {
            show_404();
        }

        $servicet = strrpos($data['enquiry_data'][0]['en_servicetime'], "-");
        if ($servicet > 0) {
            $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", "Your move is estimated to start between " . $data['enquiry_data'][0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ". The guys will give you a call if they are running late.", $data['form_data'][0]['email_editor']);
        } else {
            $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", "Your move is booked in for " . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_editor']);
        }

        $data['templateID'] = $templateID;
        $data['form_data'][0]['EnquiryId'] = $EnquiryId;
        $data['form_data'][0]['email_to'] = $data['enquiry_data'][0]['en_email'];
        $data['form_data'][0]['email_editor'] = str_replace("{{amt}}", $data['enquiry_data'][0]["en_deposit_amt"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{uuid}}", $data['enquiry_data'][0]["en_unique_id"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{noofmover}}", $data['enquiry_data'][0]["en_no_of_movers"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{nooftruck}}", $data['enquiry_data'][0]["en_no_of_trucks"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $data['enquiry_data'][0]["en_client_hourly_rate"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $data['enquiry_data'][0]["en_initial_sellprice"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{noofladiesbooked}}", $data['enquiry_data'][0]["en_ladies_booked"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $data['enquiry_data'][0]["en_initial_hours_booked"], $data['form_data'][0]['email_editor']);
        // $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", "Between " . $data['enquiry_data'][0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{tavelfee}}", (int) $data['enquiry_data'][0]["en_travelfee"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_subject']);
        $data['form_data'][0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['en_fname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromstate}}", $data['enquiry_data'][0]['en_movingfrom_state'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromstreet}}", $data['enquiry_data'][0]['en_movingfrom_street'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfrompostcode}}", $data['enquiry_data'][0]['en_movingfrom_postcode'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingfromsuburb}}", $data['enquiry_data'][0]['en_movingfrom_suburb'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtostate}}", $data['enquiry_data'][0]['en_movingto_state'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtostreet}}", $data['enquiry_data'][0]['en_movingto_street'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtopostcode}}", $data['enquiry_data'][0]['en_movingto_postcode'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{movingtosuburb}}", $data['enquiry_data'][0]['en_movingto_suburb'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{additionalcharges}}", $data['enquiry_data'][0]['en_additional_charges'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{additionalchargeitem}}", $data['enquiry_data'][0]['en_additional_item'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{emailTo}}", $data['enquiry_data'][0]['en_email'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientname}}", $data['enquiry_data'][0]['clientFname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_subject'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['clientFname'], $data['form_data'][0]['email_subject']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientfullname}}", $data['enquiry_data'][0]['clientFname'] . ' ' . $data['enquiry_data'][0]['clientLname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{date}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view("editmail", $data);
        $this->load->view("template/footer", $this->data);
    }

    /* Booking Invoice PDF */

    function sendBookingInvoice($enqId) {

        $this->load->model('booking_model');
        $this->load->model('userprofile_model');
        $this->input->method();
        $bookingData = $this->booking_model->getBookingDataByBookingID($enqId);
        $data['bankdata'] = $this->userprofile_model->getBankDataByID();
        $data['bookingPDF'] = $bookingData;

        $BookingpdfData = $this->load->view('reports/bookingPDFInvoice.php', $data, true);


        $filename = "Invoice" . $enqId . ".pdf";

        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //  $pdf->SetHTMLHeader('<h2>Revenue Report</h2>');
        // $pdf->SetHTMLFooter('<hr/>Report Generated');
        $pdf->AddPage('', // L - landscape, P - portrait 
                '', '', '', '', 10, // margin_left
                10, // margin right
                15, // margin top
                15, // margin bottom
                0, // margin header
                0); // margin footer
        //generate the PDF!
        $pdf->WriteHTML($BookingpdfData);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)

        ob_end_clean();
        $pdf->Output('./pdf/invoice/' . $filename, "I");
        ?>
        <script>
            window.open('<?php echo base_url() . 'pdf/invoice/' . $filename; ?>', '_blank');
        </script>
        <?php
    }

    /* Booking Invoice PDF */

    /**
     * Get Jobsheet log
     */
    public function getJobLog() {
        if ($this->input->is_ajax_request()) {
            $bookingID = $this->input->post("bookingID");
            $Url = "https://www.hireamover.com.au/jobsheet/getjobsheet.php";
            // OK cool - then let's create a new cURL resource handle
            $ch = curl_init();
            // Now set some options (most are optional)
            // Set URL to download
            curl_setopt($ch, CURLOPT_URL, $Url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('bookingID' => $bookingID)));
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $output = curl_exec($ch);

            $errpr = curl_error($ch);
            curl_close($ch);
            echo $output;
//            var_dump($errpr);
        } else {
            echo json_encode(array("expired" => "1"));
            exit;
        }
    }

    // public function test(){
    //     $this->load->model('Booking_model');
    //     $res= $this->Booking_model->getpackerNameListWithValues('50813');
    //     echo "<pre>";
    //     print_r($res);die;
    // }

    //  18-07-19 start
    // public function script(){

    //     $packerArr = array();
    //     $singlePackerDetail=array();
    //     $res=$this->db->select('contact_id as packer_id,enquiry_id as packer_enquiry_id,en_initial_hours_booked as packer_total_hours')
    //     ->where('(en_movetype = 4 or en_movetype = 5)')
    //     ->where('contact_id!= ""')
    //     ->where('is_deleted','0')
    //     // ->limit(50, 0)
    //     ->order_by('packer_enquiry_id','desc')
    //     ->get('enquiry')->result_array();
    //     foreach ($res as $row) {
    //         $eachPacker=explode(',',$row['packer_id']);
    //         array_pop($eachPacker);
    //         $counter=0;
    //         foreach ($eachPacker as $packer) {
    //             $singlePackerDetail[$counter]['packer_id']=$packer;
    //             $singlePackerDetail[$counter]['packer_enquiry_id']=$row['packer_enquiry_id'];
    //             $singlePackerDetail[$counter]['packer_total_hours']=$row['packer_total_hours'];

    //             if(!$this->checkExists($singlePackerDetail[$counter]) && $this->checkIsPacker($singlePackerDetail[$counter]['packer_id'])){
    //                 array_push($packerArr, $singlePackerDetail[$counter]);
    //             }
    //             $counter++;
    //         }
    //     }
    //     pr($packerArr);
    //     $this->db->insert_batch('packer_hours',$packerArr);
    // }

    // public function checkExists($record){
    //     array_pop($record);
    //     $res=$this->db->select('packer_hour_id')
    //     ->where($record)
    //     ->get('packer_hours')->result_array();
    //     if(empty($res)){
    //         return false;
    //     }
    //     else{
    //         return true;
    //     }
    // }

    // public function checkIsPacker($id){
    //     $res=$this->db->where('contact_reltype','2')
    //     ->where('contact_id',$id)
    //     ->get('contact')->result_array();
    //     if(!empty($res)){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }

    //  18-07-19 end

    public function add_packer_hours(){
        $this->load->model('booking_model','model');
        $this->model->add_packer_hours();
        echo json_encode(array('code'=>'packers addedd'));
    }

    public function remove_packer_hours(){
        $this->load->model('booking_model');
        $this->booking_model->remove_packer_hours();
        echo json_encode(array('msg'=>'success'));
    }


}
