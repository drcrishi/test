<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtemplate extends CI_Controller {

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
        $this->data['title'] = "";
        $this->data['description'] = "";
        $this->data['notification'] = webNotification();
        $this->load->model("email_template_model");
        $this->load->model("enquiry_model");
        // $this->data['user'] = $this->session->userdata('userData');
    }

    public function index() {
        $this->data['title'] = "CRM Email Template List";
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
            'pages/scripts/form-enquiries.js'
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

        $sessionId = $this->session->userdata('admin_id');
        if ($sessionId != 1) {
            show_404();
        }

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('emailtemplate_list.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function createtemplate() {
        $this->data['title'] = "Email Template Master";
        $data['js'] = array(
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            'pages/scripts/toaster/toaster.js',
        );
        $data['jsFooter'] = array(
            'global/plugins/bootstrap-summernote/summernote.min.js',
            'custom/js/form-email_template.js'
        );
        $data['css'] = array(
            'global/plugins/bootstrap-summernote/summernote.css',
        );

        $sessionId = $this->session->userdata('admin_id');
        if ($sessionId != 1) {
            show_404();
        }

        $data['template_master'] = $this->email_template_model->getEmailType();
        $data['move_type'] = $this->enquiry_model->getMoveType();

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('email_template_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function edittemplate($id) {
        $this->data['title'] = "Email Template Master";
        $data['js'] = array(
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            'pages/scripts/toaster/toaster.js',
        );
        $data['jsFooter'] = array(
            'global/plugins/bootstrap-summernote/summernote.min.js',
            'custom/js/form-edit_email_template.js'
        );
        $data['css'] = array(
            'global/plugins/bootstrap-summernote/summernote.css',
        );

        $sessionId = $this->session->userdata('admin_id');
        if ($sessionId != 1) {
            show_404();
        }

        $data['template_master'] = $this->email_template_model->getEmailType();
        $data['move_type'] = $this->enquiry_model->getMoveType();
        $data['form_data'] = $this->email_template_model->getEmailTemplateByID($id);

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('email_edit_template_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    /**
     * @author Darshak Shah <darshak.shah@drcinfotech.com>
     */
    function setemailtemplate() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('temp_name', 'Template name', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('from', 'From', 'trim|callback_contactemail_check');
        $this->form_validation->set_rules('to', 'To', 'trim|callback_contactemail_check');
        $this->form_validation->set_rules('cc', 'Cc', 'trim|callback_contactemail_check');
        $this->form_validation->set_rules('bcc', 'Bcc', 'trim|callback_contactemail_check');


        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("error" => validation_errors()));
        } else {
            $dataInsert = array(
                'en_movetype' => $this->input->post('move_type', true),
                'template_master_id' => $this->input->post('temp_type', true),
                'email_master_template_name' => $this->input->post('temp_name', true),
                'email_from' => $this->input->post('from', true),
                'email_to' => $this->input->post('to', true),
                'email_cc' => $this->input->post('cc', true),
                'email_bcc' => $this->input->post('bcc', true),
                'email_subject' => $this->input->post('subject', true),
                'email_editor' => $this->input->post('editor2'),
            );
            $this->email_template_model->setEmailMaster($dataInsert);
            echo json_encode(array("success" => '1'));
        }
    }

    /**
     * @author Darshak Shah <darshak.shah@drcinfotech.com>
     */
    function seteditemailtemplate() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('temp_name', 'Template name', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('from', 'From', 'trim|callback_contactemail_check');
        $this->form_validation->set_rules('to', 'To', 'trim|callback_contactemail_check');
        $this->form_validation->set_rules('cc', 'Cc', 'trim|callback_contactemail_check');
        $this->form_validation->set_rules('bcc', 'Bcc', 'trim|callback_contactemail_check');


        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("error" => validation_errors()));
        } else {
            $dataUpdate = array(
                'en_movetype' => $this->input->post('move_type', true),
                'template_master_id' => $this->input->post('temp_type', true),
                'email_master_template_name' => $this->input->post('temp_name', true),
                'email_from' => $this->input->post('from', true),
                'email_to' => $this->input->post('to', true),
                'email_cc' => $this->input->post('cc', true),
                'email_bcc' => $this->input->post('bcc', true),
                'email_subject' => $this->input->post('subject', true),
                'email_editor' => $this->input->post('editor2'),
            );
            $templateID = $this->input->post('templateID');
            $this->email_template_model->setUpdateEmailMaster($dataUpdate, $templateID);
            echo json_encode(array("success" => '1'));
        }
    }

    /**
     * @author Darshak Shah <darshak.shah@drcinfotech.com>
     */
    public function contactemail_check($contact_email) {
        if (!empty($contact_email) && !filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
            $this->form_validation->set_message('contactemail_check', 'Email address is not valid');
            return false;
        } else {
            return true;
        }
    }

    public function ajaxData() {
        $this->load->model('email_template_model');
        if (isset($_POST)) {
            $this->email_template_model->getAjaxData();
        }
    }

    public function deletetemplate($templateID) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->email_template_model->disableEmailTemplate($templateID);
        echo json_encode(array("success" => 1));
    }

    function getEmailLog($emailLogID, $enquiryId) {
        $emailLogData = $this->enquiry_model->getEmailLogByLogId($enquiryId, $emailLogID);
        if ($emailLogData === false) {
            show_404();
        }
        foreach ($emailLogData as $al) {
            echo $al['email_log_editor'];
        }
    }

}
