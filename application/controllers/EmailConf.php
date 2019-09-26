<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmailConf extends CI_Controller {

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
        // $this->data['user'] = $this->session->userdata('userData');
    }

    public function index() {
//        $this->config->load('email');
//        var_dump((array) $this->config);
//        die;
        $data['jsFooter'] = array(
            'custom/js/emailconf-view.js',
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
        $this->load->view("emailconf_list.php", $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function newEmailConf() {
        $this->data['title'] = "Email Configurations";
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js',
            'global/scripts/datatable.js',
            'global/plugins/datatables/datatables.min.js',
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
            'global/scripts/app.min.js',
            'layouts/layout/scripts/layout.min.js',
            'layouts/global/scripts/quick-sidebar.min.js',
                // 'custom/js/custom.js'
        );
        $data['jsTPFooter'] = array(
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js'
        );
        $data['jsFooter'] = array(
            'custom/js/form-emailconf.js'
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

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('emailconf_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }
    public function newEmailconfmaster() {
        $this->data['title'] = "Email Configurations";
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js',
            'global/scripts/datatable.js',
            'global/plugins/datatables/datatables.min.js',
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
            'global/scripts/app.min.js',
            'layouts/layout/scripts/layout.min.js',
            'layouts/global/scripts/quick-sidebar.min.js',
                // 'custom/js/custom.js'
        );
        $data['jsTPFooter'] = array(
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js'
        );
        $data['jsFooter'] = array(
            'custom/js/form-emailconf.js'
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

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('emailconfmaster_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function add_emaildata() {



        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class=""><ul><li>', '</li></ul></div>');

            $this->form_validation->set_rules('protocol', 'Protocol', 'trim|required');
            $this->form_validation->set_rules('smtp_port', 'Port', 'trim|required|max_length[15]');
//            $this->form_validation->set_rules('smtp_user', 'Username', 'trim|required');
//            $this->form_validation->set_rules('smtp_pass', 'Password', 'trim|required');
            $this->form_validation->set_rules('smtp_host', 'Host', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("error" => validation_errors()));
            } else {

                $this->input->method();
                $this->load->model("EmailConf_model");

                $data = array(
                    'protocol' => $this->input->post("protocol", true),
                    'smtp_port' => $this->input->post("smtp_port", true),
//                    'smtp_user' => $this->input->post("smtp_user", true),
//                    'smtp_pass' => $this->input->post("smtp_pass", true),
                    'smtp_host' => $this->input->post("smtp_host", true),
                    'jobtype' => $this->input->post("jobtype", true),
                    'emailtype' => $this->input->post("emailtype", true),
                );

                $userdata = $this->EmailConf_model->AddEmailConfData($data);
//                echo "<pre>";
//                print_r($userdata);
//                die;
                $job = $this->input->post("jobtype", true);
                if ($userdata !== FALSE) {
                    $rejob = $this->EmailConf_model->getEmailMasterJobtype($job,$userdata);
//                    echo "<pre>";
//                    print_r($rejob);
//                    die;
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => "<p>Data are not inserted.</p>"));
                }
            }
        }
    }
    public function add_emailmaster() {



        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class=""><ul><li>', '</li></ul></div>');
            $this->form_validation->set_rules('smtp_user', 'Username', 'trim|required');
            $this->form_validation->set_rules('smtp_pass', 'Password', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("error" => validation_errors()));
            } else {

                $this->input->method();
                $this->load->model("EmailConf_model");

                $data = array(
                    
                    'smtp_user' => $this->input->post("smtp_user", true),
                    'smtp_pass' => $this->input->post("smtp_pass", true),
                    'jobtype' => $this->input->post("jobtype", true),
                );
                $emaildata = array(
                    
                    'smtp_user' => $this->input->post("smtp_user", true),
                    'smtp_pass' => $this->input->post("smtp_pass", true),
                );
               
                $userdata = $this->EmailConf_model->AddEmailConfMaster($data);
                $job = $this->input->post("jobtype", true);
                if ($userdata !== FALSE) {
                  $this->EmailConf_model->UpdateEmailConfdataList($emaildata,$job);
                    //  echo "Insert data successfully";
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => "<p>Data are not inserted.</p>"));
                }
            }
        }
    }

    public function useremail_check($username) {
        if ($username != "") {
            if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $this->form_validation->set_message('useremail_check', 'Email address is not valid');
                return false;
            } else {
                return true;
            }
        }
    }

    public function viewEmailConf($emailconf_id) {

        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            //'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js',
        );
        $data['jsFooter'] = array(
            'custom/js/edit-emailconf.js',
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
        $this->load->model("EmailConf_model");
        $data['emailconfdata'] = $this->EmailConf_model->getEmailConfDataByID($emailconf_id);


        if ($data['emailconfdata'] !== FALSE) {

            $this->load->view("template/header", $this->data);
            $this->load->view("template/css", $data);
            $this->load->view("template/js", $data);
            $this->load->view("edit_emailconf_view", $data);
            $this->load->view("template/footer", $this->data);
        } else {
            show_404();
        }
    }
    public function viewEmailConfMaster($emailconfmaster_id) {
        
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            //'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js',
        );
        $data['jsFooter'] = array(
            'custom/js/edit-emailconf.js',
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
        $this->load->model("EmailConf_model");
        $data['emailconfdata'] = $this->EmailConf_model->getEmailConfMasterDataByID($emailconfmaster_id);
       // $this->load->view("edit_emailconfmaster_view", $data);

        if ($data['emailconfdata'] !== FALSE) {

            $this->load->view("template/header", $this->data);
            $this->load->view("template/css", $data);
            $this->load->view("template/js", $data);
            $this->load->view("edit_emailconfmaster_view", $data);
            $this->load->view("template/footer", $this->data);
        } else {
            show_404();
        }
    }

    public function editEmailconfData() {
        $emailconfid = $this->input->post("emailconf_id");

        $data = array(
            'protocol' => $this->input->post("protocol", true),
            'smtp_port' => $this->input->post("smtp_port", true),
//            'smtp_user' => $this->input->post("smtp_user", true),
//            'smtp_pass' => $this->input->post("smtp_pass", true),
            'smtp_host' => $this->input->post("smtp_host", true),
            'jobtype' => $this->input->post("jobtype", true),
            'emailtype' => $this->input->post("emailtype", true),
        );


        $this->load->model("EmailConf_model");
        if ($this->EmailConf_model->editEmailconfById($emailconfid, $data) !== FALSE) {
            echo json_encode(array("success" => 1));
        } else {
            echo json_encode(array("error" => "<p>Data are not updated.</p>"));
        }
    }
    public function editMasterEmailconfData() {
        $emailconfid = $this->input->post("email_config_master_id");

        $data = array(
            'smtp_user' => $this->input->post("smtp_user", true),
            'smtp_pass' => $this->input->post("smtp_pass", true),
            'jobtype' => $this->input->post("jobtype", true),
        );
        $emaildata = array(
            'smtp_user' => $this->input->post("smtp_user", true),
            'smtp_pass' => $this->input->post("smtp_pass", true),
        );
        $job = $this->input->post("jobtype", true);

        $this->load->model("EmailConf_model");
        if ($this->EmailConf_model->editMasterEmailconfById($emailconfid, $data) !== FALSE) {
            $this->EmailConf_model->UpdateEmailConfdataList($emaildata,$job);
            echo json_encode(array("success" => 1));
        } else {
            echo json_encode(array("error" => "<p>Data are not updated.</p>"));
        }
    }

}
