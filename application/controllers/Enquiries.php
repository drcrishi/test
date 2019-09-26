<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiries extends CI_Controller {

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
        if (!isLogin())
            echo json_encode(array("expired" => "1"));
        if (!isLogin()) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(array("expired" => "1"));
                exit;
            }
            redirect(base_url());
        }
        $this->data = array();
        $this->data['title'] = "CRM Enquiry";
        $this->data['description'] = "";
        $this->data['notification'] = webNotification();
        // $this->data['user'] = $this->session->userdata('userData');
    }

    public function newEnquiry() {
        $this->data['title'] = "CRM Enquiry";
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            //'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js',
        );
        $data['jsTPFooter'] = array(
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://momentjs.com/downloads/moment.js',
            'https://momentjs.com/downloads/moment-with-locales.js'
        );
        $data['jsFooter'] = array(
            'pages/scripts/form-enquiries.js',
            'custom/js/bootstrap-select.min'
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
        $data['move_type'] = $this->enquiry_model->getMoveType();
        $this->load->model("contact_model");
        $data['statedata'] = $this->contact_model->getSuburb();
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('enquiries_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function getcontactid($enqstate) {
        $this->load->model('enquiry_model');
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->enquiry_model->getContactName($q, $enqstate);
        }
    }

    public function getpackerid($enqstate) {
        $this->load->model('enquiry_model');
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->enquiry_model->getPackerName($q, $enqstate);
        }
    }

    public function getsuburbdata() {
        $this->load->model('enquiry_model');
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            echo $this->enquiry_model->getSuburb($q);
        }
    }

    public function add_enquiries() {

        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class=""><ul><li>', '</li></ul></div>');

            $this->form_validation->set_rules('en_movetype', 'Relationship type', 'trim|required');
            $this->form_validation->set_rules('en_home_office', 'Home Office', 'trim');
            // $this->form_validation->set_rules('en_servicetime', 'Srevice time', 'trim|required');
            $this->form_validation->set_rules('en_deliverytime', 'Delivery time', 'trim');
            $this->form_validation->set_rules('en_fname', 'First Name', 'trim|max_length[30]');
            $this->form_validation->set_rules('en_lname', 'Last Name', 'trim|max_length[30]');
            $this->form_validation->set_rules('en_phone', 'Phone', 'trim|max_length[15]');
            $this->form_validation->set_rules('en_email', 'Email', 'trim|required|callback_enquiryemail_check');
            $this->form_validation->set_rules('en_note', 'Note', 'trim');
            $this->form_validation->set_rules('en_movingfrom_street', 'Street', 'trim');
            $this->form_validation->set_rules('en_movingto_street', 'Street', 'trim');
            $this->form_validation->set_rules('en_addpickup_street', 'Street', 'trim');
            $this->form_validation->set_rules('en_adddelivery_street', 'Street', 'trim');
            $this->form_validation->set_rules('en_deposit_amt', 'Deposit amount', 'trim|numeric');
            $this->form_validation->set_rules('en_no_of_movers', 'No of movers', 'trim|numeric');
            $this->form_validation->set_rules('en_no_of_trucks', 'No of trucks', 'trim|numeric');
            $this->form_validation->set_rules('en_travelfee', 'Travelfee', 'trim|numeric');
            $this->form_validation->set_rules('en_travelfee_cost', 'Travelfee cost', 'trim|numeric');
            $this->form_validation->set_rules('en_client_hourly_rate', 'Hourly rate', 'trim|numeric');
            $this->form_validation->set_rules('en_additional_charges', 'Additional charges', 'trim|numeric');
            $this->form_validation->set_rules('en_additional_item', 'Additional items', 'trim');
            $this->form_validation->set_rules('en_additional_charges_cost', 'Additional charges cost', 'trim|numeric');
            $this->form_validation->set_rules('en_total_sellprice', 'Sell price', 'trim|numeric');
            $this->form_validation->set_rules('en_total_costprice', 'Cost price', 'trim|numeric');
            $this->form_validation->set_rules('en_hireamover_margin', 'Hireamover margin', 'trim|numeric');
            $this->form_validation->set_rules('en_amountDueNow', 'Amount due now', 'trim|numeric');
            $this->form_validation->set_rules('en_deposit_paidby', 'Deposit paidby', 'trim');
            $this->form_validation->set_rules('en_eway_refno', 'Eway refno', 'trim|numeric');
            $this->form_validation->set_rules('en_eway_token', 'Eway token', 'trim');
            $this->form_validation->set_rules('en_referral_source', 'Referral source', 'trim');
            $this->form_validation->set_rules('en_promotional_code', 'Promotional code', 'trim|max_length[25]');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("error" => validation_errors()));
            } else {

                $this->load->model("enquiry_model");
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
                
                $data = array(
                    'en_movetype' => $this->input->post("en_movetype", true),
                    'en_home_office' => $this->input->post("en_home_office", true),
                    'en_servicedate' => date('Y-m-d', strtotime($this->input->post("en_servicedate", true))),
                    'en_servicetime' => $this->input->post("serviceFullTime", true),
                    'en_deliverydate' => date('Y-m-d', strtotime($this->input->post("en_deliverydate", true))),
                    'en_deliverytime' => $this->input->post("en_deliverytime", true),
                    'en_storagedate' => date('Y-m-d', strtotime($this->input->post("en_storagedate", true))),
                    'en_fname' => ucwords($this->input->post("en_fname", true)),
                    'en_lname' => ucwords($this->input->post("en_lname", true)),
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
                    'en_deposit_amt' => $this->input->post("en_deposit_amt", true),
                    'en_no_of_movers' => $this->input->post("en_no_of_movers", true),
                    'en_no_of_trucks' => $this->input->post("en_no_of_trucks", true),
                    'en_initial_hours_booked' => $this->input->post("en_initial_hours_booked", true),
                    'en_ladies_booked' => $this->input->post("en_ladies_booked", true),
                    'en_initial_sellprice' => $this->input->post("en_initial_sellprice", true),
                    'en_travelfee' => $this->input->post("en_travelfee", true),
                    'en_travelfee_cost' => $this->input->post("en_travelfee_cost", true),
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
                    'en_packing_company_paid' => $this->input->post("en_packing_company_paid", true),
                    'en_eway_token' => $this->input->post("en_eway_token", true),
                    'en_referral_source' => $this->input->post("en_referral_source", true),
                    'en_promotional_code' => $this->input->post("en_promotional_code", true),
                    'created_by' => $this->session->userdata('admin_id'),
                    /* 'additional_pickup' => json_encode($additionalpickup1),
                      'additional_delivery' => json_encode($additionaldelivery1), */
                    'additional_pickup' => $additionalpickup,
                    'additional_delivery' => $additionaldelivery,
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



                $this->upload->do_upload('notes_attachedfile');

//        echo "<pre>";
//        print_r($this->upload->data());
//        die;
                $notesdata = array(
                    'notes_description' => $this->input->post("notes_description", true),
                    'notes_attachedfile' => $this->upload->data("file_name"),
                );

                $uniqueId = $this->enquiry_model->addEnquirydata($data);
                $enqId = $this->enquiry_model->getEnquiryIDFromUUID($uniqueId);


                /* if ($uniqueId !== FALSE) {
                  if ($this->enquiry_model->addNotes($notesdata, $enqId)) {
                  echo json_encode(array("success" => 1, 'uniqueid' => $uniqueId));
                  }
                  } else {
                  echo json_encode(array("error" => "<p>Data are not inserted.</p>"));
                  } */
                if ($uniqueId !== FALSE) {
                    // echo "zzzz";
                    if ($notesdata['notes_description'] != "") {
                        $this->enquiry_model->addNotes($notesdata, $enqId);
                    }
                    echo json_encode(array("success" => 1, 'uniqueid' => $uniqueId));
                } else {
                    // echo "gggg";
                    echo json_encode(array("error" => "<p>Data are not inserted.</p>"));
                }
            }
        }
    }

    public function enquiryemail_check($en_email) {
        if ($en_email != "") {
            if (!filter_var($en_email, FILTER_VALIDATE_EMAIL)) {
                $this->form_validation->set_message('enquiryemail_check', 'Email address is not valid');
                return false;
            } else {
                return true;
            }
        }
    }

    public function viewEnquiries($en_unique_id, $duplicate="") {

        if ($en_unique_id == "") {
            show_404();
        }
        // $this->data['title'] = "CRM Enquiry";
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            //'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js',
        );
        $data['jsFooter'] = array(
            'custom/js/edit-enquiries.js',
                // 'apps/scripts/timeago.min.js'
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

        $this->data['title'] = "Enquiry - " . $data['enquiry'][0]['en_fname'] . " " . $data['enquiry'][0]['en_lname'];

        $data['move_type'] = $this->enquiry_model->getMoveType();
        $data['suburb'] = $this->enquiry_model->getSuburb($q);
        $data['contactfname'] = $this->enquiry_model->getRemovalistName($en_unique_id);
        $data['packername'] = $this->enquiry_model->getPackerName($en_unique_id);
        $data['notes'] = $this->enquiry_model->getNotesById($data['enquiry'][0]['enquiry_id']);
        $data['packerNameList']=$this->enquiry_model->getpackerNameListWithValues($data['enquiry'][0]['enquiry_id']);
        $data['adminuser'] = $this->enquiry_model->getAdminuserById($data['enquiry'][0]['enquiry_id']);
        $data['activitylog'] = $this->enquiry_model->getEmailLogById($data['enquiry'][0]['enquiry_id']);
        $data['enquirylog'] = $this->enquiry_model->getEnquiryLog($data['enquiry'][0]['enquiry_id']);

        $this->load->model("contact_model");
        $data['packersdata'] = $this->contact_model->getPackerstByUUID($en_unique_id);
        $data['clientdata'] = $this->contact_model->getClientByUUID($en_unique_id);
        $data['statedata'] = $this->contact_model->getSuburb();

        if ($duplicate!="") {
            ?>
            <script type="text/javascript">var isDuplicate = true;</script>
            <?php

            $data['isDuplicate'] = true;
        } else {
            $data['isDuplicate'] = false;
            ?>
            <script type="text/javascript">var isDuplicate = false;</script>
            <?php

        }
        //$data['packersdata'] = $this->enquiry_model->getPackersData($en_unique_id); 
        /* echo "<pre>";
          print_r($data['packersdata']);
          die; */
        //$data['editenquiry'] = $this->enquiry_model->editEnquiry($en_unique_id);


        if ($data['enquiry'] !== FALSE) {
            $this->load->view("template/header", $this->data);
            $this->load->view("template/css", $data);
            $this->load->view("template/js", $data);
            $this->load->view("edit_enquiries_view", $data);
            $this->load->view("template/footer", $this->data);
        } else {
            show_404();
        }
    }

    public function EmailActivitiesLogAjax() {
        $en_unique_id = $this->input->post("id", true);
        $this->load->model("enquiry_model");
        $data['activitylog'] = $this->enquiry_model->getEmailLogById($en_unique_id);
        $this->load->view("edit_enquiry_ajax_view.php", $data);
    }

    public function editEnquiryData() {
        $this->load->model("enquiry_model");
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
        $data = array(
            'en_movetype' => $this->input->post("en_movetype", true),
            'en_home_office' => $this->input->post("en_home_office", true),
            'en_servicedate' => date('Y-m-d', strtotime($this->input->post("en_servicedate", true))),
            'en_servicetime' => $this->input->post("serviceFullTime", true),
            'en_deliverydate' => date('Y-m-d', strtotime($this->input->post("en_deliverydate", true))),
            'en_deliverytime' => $this->input->post("en_deliverytime", true),
            'en_storagedate' => date('Y-m-d', strtotime($this->input->post("en_storagedate", true))),
            'en_fname' => ucwords($this->input->post("en_fname", true)),
            'en_lname' => ucwords($this->input->post("en_lname", true)),
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
            'en_deposit_amt' => $this->input->post("en_deposit_amt", true),
            'en_no_of_movers' => $this->input->post("en_no_of_movers", true),
            'en_no_of_trucks' => $this->input->post("en_no_of_trucks", true),
            'en_initial_hours_booked' => $this->input->post("en_initial_hours_booked", true),
            'en_ladies_booked' => $this->input->post("en_ladies_booked", true),
            'en_initial_sellprice' => $this->input->post("en_initial_sellprice", true),
            'en_travelfee' => $this->input->post("en_travelfee", true),
            'en_travelfee_cost' => $this->input->post("en_travelfee_cost", true),
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
            'en_packing_company_paid' => $this->input->post("en_packing_company_paid", true),
            'en_eway_token' => $this->input->post("en_eway_token", true),
            'en_referral_source' => $this->input->post("en_referral_source", true),
            'en_promotional_code' => $this->input->post("en_promotional_code", true),
            /* 'additional_pickup' => json_encode($additionalpickup1),
              'additional_delivery' => json_encode($additionaldelivery1), */
            'additional_pickup' => $additionalpickup,
            'additional_delivery' => $additionaldelivery,
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

        $filedata = $this->upload->do_upload('notes_attachedfile');

//        echo "<pre>";
//        print_r($this->upload->data());
//        die;
        $notesdata = array(
            'notes_description' => $this->input->post("notes_description", true),
            'notes_attachedfile' => $this->upload->data("file_name"),
        );

        //enquiry update log start...........................@DRCZ
        $enqdata = $this->enquiry_model->getEnquiryDataByUUID($enquiryUUIDId);

        if($enqdata[0]['additional_pickup'] == ''){
            $enqdata[0]['additional_pickup'] = $data['additional_pickup'];
        }
        if($enqdata[0]['additional_delivery'] == ''){
            $enqdata[0]['additional_delivery'] = $data['additional_delivery'];
        }

        $data['en_note'] = trim($data['en_note']);
        $enqdata[0]['en_note'] = trim($enqdata[0]['en_note']);

        $first=explode("\n",$data['en_note']);
        $second = explode("\n",$enqdata[0]['en_note']);
        $trimmed_array1=array_map('trim',$first);
        $trimmed_array2=array_map('trim',$second);

        $diffNotesArr = array_diff_assoc($trimmed_array1, $trimmed_array2);
        $diffrenceNotesArr = array_filter($diffNotesArr);

        if(count($diffrenceNotesArr) == 0){
            $data['en_note']= $enqdata[0]['en_note'];
        }

        $diffarray1 = array_diff_assoc($data, $enqdata[0]);
        $diffarray = array_filter($diffarray1);
//        echo "<pre>";
//        print_r($diffarray);
//        die;

        if ($data['en_movetype'] == "1" || $data['en_movetype'] == "2") {
            $diffData = array(
                'en_movetype' => "Enquiry Movetype",
                'en_home_office' => "Home Office",
                'en_servicedate' => "Service Date",
                'en_servicetime' => "Service Time",
                'en_deliverydate' => "Delivery Date",
                'en_deliverytime' => "Delivery Time",
                'en_storagedate' => "Storage Date",
                'en_fname' => "First name",
                'en_lname' => "Last name",
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
                'en_eway_token' => "Eway token",
                'en_referral_source' => "Referral source",
                'en_promotional_code' => "Promotional code",
                'additional_pickup' => "Additional Pickup",
                'additional_delivery' => "Additional Delivery"
            );
        } else if ($data['en_movetype'] == "4" || $data['en_movetype'] == "7") {
            $diffData = array(
                'en_movetype' => "Enquiry Movetype",
                'en_home_office' => "Home Office",
                'en_servicedate' => "Service Date",
                'en_servicetime' => "Service Time",
                'en_deliverydate' => "Delivery Date",
                'en_deliverytime' => "Delivery Time",
                'en_storagedate' => "Storage Date",
                'en_fname' => "First name",
                'en_lname' => "Last name",
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
                // 'en_no_of_movers' => "No of Movers",
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
                'en_eway_token' => "Eway token",
                'en_referral_source' => "Referral source",
                'en_promotional_code' => "Promotional code",
            );
        } else if ($data['en_movetype'] == "5" || $data['en_movetype'] == "8") {
            $diffData = array(
                'en_movetype' => "Enquiry Movetype",
                'en_home_office' => "Home Office",
                'en_servicedate' => "Service Date",
                'en_servicetime' => "Service Time",
                'en_deliverydate' => "Delivery Date",
                'en_deliverytime' => "Delivery Time",
                'en_storagedate' => "Storage Date",
                'en_fname' => "First name",
                'en_lname' => "Last name",
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
                // 'en_no_of_movers' => "No of Movers",
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
                'en_eway_token' => "Eway token",
                'en_referral_source' => "Referral source",
                'en_promotional_code' => "Promotional code",
            );
        } else if ($data['en_movetype'] == "6") {
            $diffData = array(
                'en_movetype' => "Enquiry Movetype",
                'en_home_office' => "Home Office",
                'en_servicedate' => "Service Date",
                'en_servicetime' => "Service Time",
                'en_deliverydate' => "Delivery Date",
                'en_deliverytime' => "Delivery Time",
                'en_storagedate' => "Storage Date",
                'en_fname' => "First name",
                'en_lname' => "Last name",
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
                'en_eway_token' => "Eway token",
                'en_referral_source' => "Referral source",
                'en_promotional_code' => "Promotional code",
            );
        }

        $diffKey = implode(",", array_intersect_key($diffData, $diffarray));

        $enquiryLogData = array(
            'enquiry_id' => $enquiryId,
            'enquiry_session_id' => $this->session->userdata('admin_id'),
            'enquiry_status' => $diffKey,
        );
//    echo "<pre>";
//    print_r($enquiryLogData);
//    die;
//enquiry update log end...........................@DRCZ

        if ($notesdata['notes_description'] != "" && $notesdata['notes_description'] != "") {

            if ($this->enquiry_model->addNotes($notesdata, $enquiryId) !== FALSE) {
                if ($this->enquiry_model->editEnquiryById($enquiryId, $data)) {
                    if ($diffKey != "") {
                        $this->enquiry_model->AddEnquiryUpdateLog($enquiryLogData);
                    }
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => "<p>Data are not updated.</p>"));
                }
            }
        } else {
            if ($this->enquiry_model->editEnquiryById($enquiryId, $data)) {
                if ($diffKey != "") {
                    $this->enquiry_model->AddEnquiryUpdateLog($enquiryLogData);
                }
                echo json_encode(array("success" => 1));
            } else {
                echo json_encode(array("error" => "<p>Data are not updated.</p>"));
            }
        }
    }

    public function index() {
        $this->data['title'] = "CRM Enquiry";
        $data['jsFooter'] = array(
            'pages/scripts/enquiries-view.js',
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
        $this->load->view("enquiries_list.php", $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function ajaxEnquiryDatalist() {
        $results = $this->enquiry_model->getEnquiryData();
        echo json_encode($results);
    }

    public function editQuoteMail($EnquiryId, $templateID = "1") {
        $data['jsFooter'] = array(
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/bootstrap-summernote/summernote.min.js',
            'custom/js/edit-email_template.js'
        );
        $data['css'] = array(
            'global/plugins/bootstrap-summernote/summernote.css',
        );
//echo $EnquiryId;
//die;
        $data['enquiry_data'] = $this->enquiry_model->getEnquiryDataByEnquiryID($EnquiryId);
        $this->load->model("email_template_model");
        $data['form_data'] = $this->email_template_model->getEmailTemplate($data['enquiry_data'][0]['en_movetype'], $templateID);
        if ($data['form_data'] === FALSE) {
            show_404();
        }
        if ($data['enquiry_data'][0]['en_additional_charges'] != "0.00" && $data['enquiry_data'][0]['en_additional_charges'] != NULL) {
            $addcharge = '. There is also a charge of $' . (int) $data['enquiry_data'][0]['en_additional_charges'] . ' for the ' . $data['enquiry_data'][0]['en_additional_item'] . '.';
        } else {
            $addcharge = '';
        }
        // echo $data['enquiry_data'][0]['en_servicetime'];
        if ($data['enquiry_data'][0]['en_servicetime'] == "" || $data['enquiry_data'][0]['en_servicetime'] == "No preference") {
            echo "Enter the service time and save data";
            die;
            // show_404();
        }
        if ($data['enquiry_data'][0]["en_no_of_trucks"] == 1) {
            $truck = $data['enquiry_data'][0]["en_no_of_trucks"] . " truck";
        } else {
            $truck = $data['enquiry_data'][0]["en_no_of_trucks"] . " trucks";
        }

        $servicet = strrpos($data['enquiry_data'][0]['en_servicetime'], "-");
        //  if ($data['enquiry_data'][0]['en_movetype'] == 1 || $data['enquiry_data'][0]['en_movetype'] == 2) {
        if ($servicet > 0) {
            $data['form_data'][0]['email_editor'] = str_replace("{{datetimepre}}", "between ", $data['form_data'][0]['email_editor']);
           $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", $data['enquiry_data'][0]['en_servicetime'] . " on " . date('l', strtotime($data['enquiry_data'][0]['en_servicedate'])). ' ' . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
            // $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", $data['enquiry_data'][0]['en_servicetime'] , $data['form_data'][0]['email_editor']);
        } else {
            $data['form_data'][0]['email_editor'] = str_replace("{{datetimepre}}", "at ", $data['form_data'][0]['email_editor']);
            // $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", $data['enquiry_data'][0]['en_servicetime'] , $data['form_data'][0]['email_editor']);
            $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", $data['enquiry_data'][0]['en_servicetime'] . " on " . date('l', strtotime($data['enquiry_data'][0]['en_servicedate'])). ' ' . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
        }
//                } else {
//                    $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", $data['enquiry_data'][0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
//                }


        $data['templateID'] = $templateID;
        $data['form_data'][0]['EnquiryId'] = $EnquiryId;
//        echo "<pre>";
//        print_r($data);
//        die;
        $data['form_data'][0]['email_to'] = $data['enquiry_data'][0]['en_email'];
        $data['form_data'][0]['email_editor'] = str_replace("{{amt}}", $data['enquiry_data'][0]["en_deposit_amt"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{uuid}}", $data['enquiry_data'][0]["en_unique_id"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{noofmover}}", $data['enquiry_data'][0]["en_no_of_movers"], $data['form_data'][0]['email_editor']);
        // $data['form_data'][0]['email_editor'] = str_replace("{{nooftruck}}", $data['enquiry_data'][0]["en_no_of_trucks"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{nooftruck}}", $truck, $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $data['enquiry_data'][0]["en_client_hourly_rate"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $data['enquiry_data'][0]["en_initial_sellprice"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{noofladiesbooked}}", $data['enquiry_data'][0]["en_ladies_booked"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $data['enquiry_data'][0]["en_initial_hours_booked"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{additionalcharges}}", $addcharge, $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{additionalchargeitem}}", $data['enquiry_data'][0]['en_additional_item'], $data['form_data'][0]['email_editor']);
        // $data['form_data'][0]['email_editor'] = str_replace("{{datetime}}", "Between " . $data['enquiry_data'][0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{tavelfee}}", (int) $data['enquiry_data'][0]["en_travelfee"], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_subject']);
        $data['form_data'][0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($data['enquiry_data'][0]['en_servicedate'])) . ' ' . $data['enquiry_data'][0]['en_servicetime'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{clientfirstname}}", $data['enquiry_data'][0]['en_fname'], $data['form_data'][0]['email_editor']);
        $data['form_data'][0]['email_editor'] = str_replace("{{emailTo}}", $data['enquiry_data'][0]['en_email'], $data['form_data'][0]['email_editor']);
        if ($data['enquiry_data'][0]['en_additional_charges'] != 0.00 && $data['enquiry_data'][0]['en_additional_charges'] != NULL) {
            $data['form_data'][0]['email_editor'] = str_replace("{{additionalchargeforpacker}}", "and " . $data['enquiry_data'][0]["en_additional_item"], $data['form_data'][0]['email_editor']);
        } else {
            $data['form_data'][0]['email_editor'] = str_replace("{{additionalchargeforpacker}}", "", $data['form_data'][0]['email_editor']);
        }

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view("editmail", $data);
        $this->load->view("template/footer", $this->data);
    }

    /**
     * Booking data insertion............... 
     */
    function bookingData($en_unique_id) {
        $this->load->model("enquiry_model");

        if ($this->enquiry_model->updateQualifydata($en_unique_id)) {
            $this->load->model("contact_model");
            $data = $this->enquiry_model->getCustomerQualifedData($en_unique_id);
            $cont = array(
                'contact_fname' => $data[0]['en_fname'],
                'contact_lname' => $data[0]['en_lname'],
                'contact_phno' => $data[0]['en_phone'],
                'contact_email' => $data[0]['en_email'],
                'contact_reltype' => 3,
                'contact_state' => $data[0]['en_movingfrom_state'],
            );

            $contactemail = $cont['contact_email'];
            $contId = $this->contact_model->addContactdata($cont);
            $contactuuid = $this->contact_model->getContactIDFromUUID($contId);

            /* Check contact Email Id before add new contact entry............ */
//            $contemail = $this->enquiry_model->checkContactEmail($contactemail);
//            if ($contemail !== FALSE) {
//                $contactuuid = $contemail[0]['contact_id'];
//            } else {
//                $contId = $this->contact_model->addContactdata($cont);
//                $contactuuid = $this->contact_model->getContactIDFromUUID($contId);
//            }
            /* Check contact Email Id before add new contact entry............ */

            $enqId = $this->enquiry_model->getEnquiryIDFromUUID($en_unique_id);
            $this->enquiry_model->getCustomerId($contactuuid, $enqId);
            echo json_encode(array("success" => 1));
        } else {
            echo json_encode(array("error" => "<p> Not Quilified</p>"));
        }
    }

    public function getEnquirydataforDuplicate($en_unique_ids) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        if (isset($en_unique_ids)) {
            $enunique = $this->enquiry_model->getDuplicateEnqueryData($en_unique_ids);
            if ($enunique !== FALSE) {
                echo json_encode(array("success" => 1, "id" => $enunique));
            } else {
                echo json_encode(array("error" => 1));
            }
        }
    }

    public function deleteEnquiry($en_unique_id) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->enquiry_model->disableEnquiry($en_unique_id);
        echo json_encode(array("success" => 1));
    }

    public function disQualifyBooking($en_unique_id) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->enquiry_model->disqualifyBooking($en_unique_id);
        echo json_encode(array("success" => 1));
    }

    public function deleteNotes($notes_id) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->enquiry_model->disableNotes($notes_id);
        echo json_encode(array("success" => 1));
    }

    public function downloadNotes($notes_id) {
        if (!empty($notes_id)) {
            $this->load->helper('download');

            $fileInfo = $this->enquiry_model->getNotesFile($notes_id);
//            echo "<pre>";
//            print_r($fileInfo);
//            die;
//            echo $fileInfo[0]['notes_attachedfile'];
//            die;
            $data = file_get_contents(base_url("assets/uploads/notes/" . $fileInfo[0]['notes_attachedfile'])); // Read the file's contents
            $name = $fileInfo[0]['notes_attachedfile'];
            force_download($name, $data);
//            $file = 'assets/uploads/notesfile/' . $fileInfo[0]['notes_attachedfile'];
//            force_download($file, NULL);
        }
    }

    function fetchNotes($enquiryID) {
//        echo $enquiryID;
//        die;
        $this->load->model("enquiry_model");
        $data['notes'] = $this->enquiry_model->getNotesById($enquiryID);
//        print_r( $data['notes']);
//        die;
        echo $this->load->view('enquiries_notes_view.php', $data, true);
    }

    /* Deposit payment notification @DRCZ */

    function getPaymentNotification() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $paymentNot = $this->enquiry_model->getPaymentNotify();
        date_default_timezone_set("Australia/Sydney");
        foreach ($paymentNot as $re) {
            $id = "'" . $re['en_unique_id'] . "'";

            if ($re['movetype_name'] == "Home" || $re['movetype_name'] == "Office") {
                $amt = $re['en_deposit_amt'];
            } else if ($re['movetype_name'] == "Packing" || $re['movetype_name'] == "Unpacking") {
                $amt = $re['en_initial_sellprice'];
            }
            $linkType = "enquiries/viewEnquiries/";
            if ($re['is_qualified'] == 1) {
                $linkType = "booking/viewBooking/";
            }
            $noti .= '<li class="dis-grid">
                    <a class="close-btn-desi" href="#"  onclick="myFunctionclose(' . $id . ')">
                        <span class="label label-sm label-icon">Dismiss</span>
                        </a>
                        <a class="point-border-none" href="' . base_url() . $linkType . $re['en_unique_id'] . '">
                            <span class="details depositnames">
                               ' . $re['fullname'] . '</br> <span>' . $re['movetype_name'] . ' - $' . $amt . '</span></span><span class="time">' . $this->get_time_ago(strtotime($re['depositreceiveddate'])) . '</span>'
                    . '</a></li>';
        }

        $storageNot = $this->enquiry_model->getStorageNotification();
        foreach ($storageNot as $row) {
            $linkType = "booking/viewBooking/";
             $id = "'" . $row['en_unique_id'] . "'";
            $noti .= '<li class="dis-grid">
                    <a class="close-btn-desi" href="#"  onclick="myFunctionclose(' . $id . ')">
                        <span class="label label-sm label-icon">Dismiss</span>
                    </a>
                    <a class="point-border-none" href="' . base_url() . $linkType . $row['en_unique_id'] . '">
                            <span class="details depositnames">
                               ' . $row['en_fname'] . ' '. $row['en_lname'] . '</br> <span> Storage Payment Due </span></span>'
                    . '</a></li>';
        }

        echo json_encode(array("success" => $noti,'storage'=> $storageNotif));
    }

    function countDepositNotification() {
        $bookingNotification=$this->enquiry_model->getBookingCompletedRecords();
        $storageNotification = $this->enquiry_model->getStorageNotificationCount();
        $not = $this->enquiry_model->cntDepositNotify();
        $enquiryArr=array();
        if(count($not)>0){
            foreach ($not as $enquiry) {
                $enquiryArr[]=$enquiry['enquiry_id'];
            }
        }
        $total= count($not) + $storageNotification[0]['count'];
        echo json_encode(array("success" => $total,"enquiryArr" => $enquiryArr,'bookingArr'=> $bookingNotification));
    }

    function changeDepositStatus($enqid) {
        $ip=$this->getUserIpAddr();
        $this->enquiry_model->updateDepositStatus($enqid,$ip);
        $this->enquiry_model->updateStorageNotifyDate($enqid);
        // redirect('enquirieslist', 'auto');
        echo json_encode(array("success" => 1));
    }

    function getUserIpAddr(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /* Deposit payment notification @DRCZ */
    /* Timeago function @DRCZ */

    function get_time_ago($time) {
        date_default_timezone_set("Australia/Sydney");
        $time_difference = time() - $time;
        if ($time_difference < 1) {
            return 'less than 1 second ago';
        }
        $condition = array(12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($condition as $secs => $str) {
            $d = $time_difference / $secs;

            if ($d >= 1) {
                $t = round($d);
                return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }

    /* Timeago function @DRCZ */

    public function getPaymentDetails(){
        $result=$this->enquiry_model->getPaymentDetails();
        echo json_encode($result);
    }

    public function searchEmail(){
        $searchResult = $this->enquiry_model->searchEmail();
        echo json_encode($searchResult);
    }
}
