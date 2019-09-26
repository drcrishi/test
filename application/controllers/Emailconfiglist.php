<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Emailconfiglist extends CI_Controller {

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
        if (!isLogin()){
            if ($this->input->is_ajax_request()){
                echo json_encode(array("expired" => "1"));exit;
            }
            redirect(base_url());
        }
        $this->data = array();
        $this->data['title'] = "";
        $this->data['description'] = "";
        $this->data['user'] = $this->session->userdata('userData');
        $this->data['notification'] = webNotification();
    }

    public function index() {
        
        $this->data['title'] = "CRM User Dashboard";
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
        $this->load->view('emailconf_list.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function ajaxData() {
//        echo "<pre>";
//          print_r($_POST);
//        die;

        if (isset($_POST)) {
            $this->load->model('EmailConf_model');
            $this->EmailConf_model->getAjaxData();
        }
    }
    public function masterEmailconfajaxData() {
//        echo "<pre>";
//          print_r($_POST);
//        die;

        if (isset($_POST)) {
            $this->load->model('EmailConf_model');
            $this->EmailConf_model->getAjaxDataMasterEmailConf();
        }
    }

}
