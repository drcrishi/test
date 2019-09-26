<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userbookinglist extends CI_Controller {

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
        $contact_ID = $this->session->userdata('contact_id');
        $contact_Email = $this->session->userdata('contact_email');
//        if (!isLogin()) {
//            if ($this->input->is_ajax_request()) {
//                echo json_encode(array("expired" => "1"));
//                exit;
//            }
//            redirect(base_url());
//        }
        if (!isLoginUser()) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(array("expired" => "1"));
                exit;
            }
            show_404();
        }


        $this->data = array();
        $this->data['title'] = "Current Bookings";
        $this->data['description'] = "";
        $this->data['user'] = $this->session->userdata('userData');
        // $this->data['notification'] = webNotification();
    }

    public function index() {
        $this->data['title'] = "Current Bookings";
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js',
            'global/scripts/datatable.js',
            'global/plugins/datatables/datatables.min.js',
            'global/scripts/app.min.js',
            'layouts/layout/scripts/layout.min.js',
            'layouts/global/scripts/quick-sidebar.min.js',
            'custom/js/custom.js'
        );
        $data['jsTPFooter'] = array(
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js'
        );
        $data['jsFooter'] = array(
            'custom/js/form-rpuserbooking.js'
        );
        $data['css'] = array(
            'global/plugins/select2/css/select2.min.css',
            'global/plugins/select2/css/select2-bootstrap.min.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css',
            'global/plugins/datatables/datatables.min.css',
            'custom/css/custom.css'
        );


        $data['cssTP'] = array(
            '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
        );
        $this->load->model("enquiry_model");
        $data['move_type'] = $this->enquiry_model->getMoveType();
        $this->load->model("contact_model");
        $data['statedata'] = $this->contact_model->getSuburb();
        $this->load->view("template/header", $this->data);
        $this->data['userLeftMenu'] = $this->load->view("template/userleftmenu", $data, true);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('driver/user_booking_list.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function viewUserBooking($en_unique_id) {
        if ($en_unique_id == "") {
            show_404();
        }

        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            // 'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js'
        );
        $data['jsFooter'] = array(
            'custom/js/edit-booking.js'
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

        $sessionId = $this->session->userdata('contact_id');
        $sessionEmail = $this->session->userdata('contact_email');

        $this->load->model("driver/userbooking_model");
        $data['enquiry'] = $this->userbooking_model->getEnquiryDataByUUID($en_unique_id, $sessionEmail);

        $this->load->model("enquiry_model");
        $data['enquiry1'] = $this->enquiry_model->getEnquiryDataByUUID($en_unique_id);
        $data['move_type'] = $this->enquiry_model->getMoveType();

        $data['suburb'] = $this->enquiry_model->getSuburb($q);
        $data['contactfname'] = $this->enquiry_model->getRemovalistName($en_unique_id);
        $data['packername'] = $this->enquiry_model->getPackerName($en_unique_id);

        $data['activitylog'] = $this->enquiry_model->getEmailLogById($data['enquiry'][0]['enquiry_id']);

        $this->load->model("booking_model");
        $data['contactname'] = $this->booking_model->getContactName($en_unique_id);
        $data['booking'] = $this->booking_model->getEnquiryDataByUUID($en_unique_id);
        $data['clientname'] = $this->booking_model->getClientByUUID($en_unique_id);
        $data['notes'] = $this->booking_model->getNotesById($data['booking'][0]['enquiry_id']);

        $this->load->model("contact_model");
        $data['packersdata'] = $this->contact_model->getPackerstByUUID($en_unique_id);
        $data['statedata'] = $this->contact_model->getSuburb();
        $data['clientname'] = $this->contact_model->getClientByUUID($en_unique_id);
        if (!empty($data['clientname'])) {
            $this->data['title'] = "Booking - " . $data['clientname']['contact_fname'] . " " . $data['clientname']['contact_lname'];
        }
//         echo "<pre>";
//          print_r($data['clientname']);
//          die; 
        if ($data['enquiry'] !== FALSE) {
            $this->load->view("template/header", $this->data);
            $this->load->view("template/css", $data);
            $this->load->view("template/js", $data);
            $this->data['userLeftMenu'] = $this->load->view("template/userleftmenu", $data, true);
            $this->load->view("driver/user_booking_view.php", $data);
            $this->load->view("template/footer", $this->data);
        } else {
            show_404();
        }
    }

    public function viewJobsheet($en_unique_id) {
        if ($en_unique_id == "") {
            show_404();
        }
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            // 'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js'
        );
        $data['jsFooter'] = array(
            'custom/js/edit-booking.js'
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

        $sessionId = $this->session->userdata('contact_id');
        $sessionEmail = $this->session->userdata('contact_email');

        $this->load->model("driver/userbooking_model");
        $data['enquiry'] = $this->userbooking_model->getEnquiryDataByUUID($en_unique_id, $sessionEmail);

        $this->load->model("enquiry_model");
        $data['enquiry1'] = $this->enquiry_model->getEnquiryDataByUUID($en_unique_id);
        $data['move_type'] = $this->enquiry_model->getMoveType();

        $data['suburb'] = $this->enquiry_model->getSuburb($q);
        $data['contactfname'] = $this->enquiry_model->getRemovalistName($en_unique_id);
        $data['packername'] = $this->enquiry_model->getPackerName($en_unique_id);

//        $data['activitylog'] = $this->enquiry_model->getEmailLogById($data['enquiry'][0]['enquiry_id']);

        $this->load->model("booking_model");
        $data['contactname'] = $this->booking_model->getContactName($en_unique_id);
        $data['booking'] = $this->booking_model->getEnquiryDataByUUID($en_unique_id);
        $data['clientname'] = $this->booking_model->getClientByUUID($en_unique_id);
        $data['notes'] = $this->booking_model->getNotesById($data['booking'][0]['enquiry_id']);

        $this->load->model("contact_model");
        $data['packersdata'] = $this->contact_model->getPackerstByUUID($en_unique_id);
        $data['statedata'] = $this->contact_model->getSuburb();
        $data['clientname'] = $this->contact_model->getClientByUUID($en_unique_id);
        if (!empty($data['clientname'])) {
            $this->data['title'] = "Booking - " . $data['clientname']['contact_fname'] . " " . $data['clientname']['contact_lname'];
        }
//         echo "<pre>";
//          print_r($data['packersdata']);
//          die; 
        if ($data['enquiry'] !== FALSE) {
            $this->load->view("template/css", $data);
            $this->load->view("template/js", $data);
            $this->load->view("driver/jobsheet_pdf.php", $this->data);
        } else {
            show_404();
        }
    }

    /*  Jobsheet PDF @DRCZ........... */

    public function save_download($en_unique_id) {
        if ($en_unique_id == "") {
            show_404();
        }
        //load mPDF library
        $this->load->library('m_pdf');
        //load mPDF library
        //now pass the data//
        //now pass the data //

        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            // 'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js'
        );
        $data['jsFooter'] = array(
            'custom/js/edit-booking.js'
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

        $sessionId = $this->session->userdata('contact_id');
        $sessionEmail = $this->session->userdata('contact_email');

        $this->load->model("driver/userbooking_model");
        $data['enquiry'] = $this->userbooking_model->getEnquiryDataByUUID($en_unique_id, $sessionEmail);

        $this->load->model("enquiry_model");
        $data['enquiry1'] = $this->enquiry_model->getEnquiryDataByUUID($en_unique_id);
        $data['move_type'] = $this->enquiry_model->getMoveType();

        $data['suburb'] = $this->enquiry_model->getSuburb($q);
        $data['contactfname'] = $this->enquiry_model->getRemovalistName($en_unique_id);
        $data['packername'] = $this->enquiry_model->getPackerName($en_unique_id);

//        $data['activitylog'] = $this->enquiry_model->getEmailLogById($data['enquiry'][0]['enquiry_id']);

        $this->load->model("booking_model");
        $data['contactname'] = $this->booking_model->getContactName($en_unique_id);
        $data['booking'] = $this->booking_model->getEnquiryDataByUUID($en_unique_id);
        $data['clientname'] = $this->booking_model->getClientByUUID($en_unique_id);
        $data['notes'] = $this->booking_model->getNotesById($data['booking'][0]['enquiry_id']);

        $this->load->model("contact_model");
        $data['packersdata'] = $this->contact_model->getPackerstByUUID($en_unique_id);
        $data['statedata'] = $this->contact_model->getSuburb();
        $data['clientname'] = $this->contact_model->getClientByUUID($en_unique_id);

        $this->data['title'] = "MY PDF TITLE 1.";
        $this->data['description'] = "";
        $this->data['description'] = $this->official_copies;
        if ($data['enquiry'] !== FALSE) {
            $html = $this->load->view('driver/pdf_output_view', $data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
            //this the the PDF filename that user will get to download
            // $pdfFilePath = "mypdfName-" . time() . "-download.pdf";
            $filename = rand() . ".pdf";

            $pdf = $this->m_pdf->load();
            // $stylesheet = file_get_contents('mpdfstyleA4.css');
            // $pdf->WriteHTML("table{border-collapse: collapse;}table tr td{border: 1px solid #999; padding: 3px 5px; font-size: 12px; color: #666;}", 1);
            $pdf->WriteHTML("body { margin: 00px 0px; }body {font-family: 'Geneva', sans-serif;line-height: 20px;color: #555;} .mainheading{font-size:20px !important;text-transform: uppercase;margin-top:0px;padding:0px;margin-bottom:10px;font-weight:bold;}.page{width: 700px;margin: auto;}body, table, th, td, p, li, strong{font-size: 13px;}table{margin-bottom: 10px;border: solid 1px #555;border-collapse: collapse;}td{padding: 2px 5px;border: solid 1px #555;}p{line-height: 150%;margin-bottom: 15px;}.sign{font-size: 12px;}@font-face {font-family: Calibri;	}@font-face {font-family: Lato-Regular;	}p.MsoNormal, li.MsoNormal, div.MsoNormal {margin: 0cm;margin-bottom: 01pt;font-size: 12px;font-family: Calibri, sans-serif;}", 1);
            $pdf->WriteHTML($html, 2);
            $pdf->Output('./jobsheetpdf/' . $filename, "I");
            // $pdf->Output($pdfFilePath, "D");
        } else {
            show_404();
        }
    }

    public function ajaxData() {

        $this->load->model('driver/userbooking_model');
        if (isset($_POST)) {
            $this->userbooking_model->getUserAjaxData();
        }
    }
   public function changeUserPassword() {

        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class=""><ul><li>', '</li></ul></div>');

            $this->form_validation->set_rules('contact_password_old', 'Old Password', 'trim|required');
            $this->form_validation->set_rules('contact_password', 'New Password', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("error" => validation_errors()));
            } else {

                $sessionEmail = $this->session->userdata('contact_email');
                $this->load->model('driver/userbooking_model');
                $sessionPWD = $this->userbooking_model->getadminRPPwd($sessionEmail);

                $sessionPwd = $sessionPWD[0]['contact_password'];
                $this->input->post();

                $userPwd = $this->input->post('contact_password');
                $userPwdOld = $this->input->post('contact_password_old');

                if ($this->userbooking_model->changePwd($sessionEmail, $sessionPwd, $userPwd, $userPwdOld) != FALSE) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => "<p>Enter correct old password.</p>"));
                }
            }
        }
    }

//    public function changeUserPassword() {
//        $sessionEmail = $this->session->userdata('contact_email');
//        $this->load->model('driver/userbooking_model');
//        $sessionPWD = $this->userbooking_model->getadminRPPwd($sessionEmail);
//
//        $sessionPwd = $sessionPWD[0]['contact_password'];
//        $this->input->post();
//
//        $userPwd = $this->input->post('contact_password');
//        $userPwdOld = $this->input->post('contact_password_old');
//
//        if ($this->userbooking_model->changePwd($sessionEmail, $sessionPwd, $userPwd, $userPwdOld) != FALSE) {
//            echo json_encode(array("success" => 1));
//        } else {
//            echo json_encode(array("error" => "<p>Enter correct old password.</p>"));
//        }
//    }

}
