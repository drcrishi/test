<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userprofile extends CI_Controller {

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
        $this->data['notification'] = webNotification();
        // $this->data['user'] = $this->session->userdata('userData');
    }

    public function index() {
        $data['jsFooter'] = array(
            'custom/js/userprofile-view.js',
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
        $this->load->view("userprofile_list.php", $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function newUserprofile() {
        $this->data['title'] = "CRM User Profile";
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
            'custom/js/form-userprofile.js'
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
        $this->load->view('profile_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function add_user() {

        $config['upload_path'] = 'assets/uploads/userprofile/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|jpeg';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class=""><ul><li>', '</li></ul></div>');

            $this->form_validation->set_rules('admin_firstname', 'First name', 'trim|required');
            $this->form_validation->set_rules('admin_lastname', 'Last name', 'trim|required|max_length[15]');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_useremail_check');
            $this->form_validation->set_rules('password', 'Email', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("error" => validation_errors()));
            } else {

                $this->input->method();
                $this->load->model("Userprofile_model");
                $filedata = $this->upload->do_upload('userprofile');

//                echo "<pre>";
//                print_r($this->upload->data());
//                die;
                $data = array(
                    'admin_firstname' => $this->input->post("admin_firstname", true),
                    'admin_lastname' => $this->input->post("admin_lastname", true),
                    'username' => $this->input->post("username", true),
                    'password' => md5($this->input->post("password", true)),
                    'userprofile' => $this->upload->data("file_name"),
                );
                
                $bankDetailsdata = array(
                    'company_address' => $this->input->post("company_address"),
                    'bank_detail' => $this->input->post("bank_detail"),
                    'gst' => $this->input->post("gst"),
                    'company_no' => $this->input->post("company_no"),
                );
                
                $userdata = $this->Userprofile_model->userProfileData($data);
                $bankData = $this->Userprofile_model->bankDetailData($bankDetailsdata);

                if ($userdata !== FALSE) {
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

    public function ajaxUserprofileDatalist() {
        $this->load->model("userprofile_model");
        $results = $this->userprofile_model->getUserprofileData();

        echo json_encode($results);
    }

    public function viewUserprofile($admin_id) {
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            //'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js',
        );
        $data['jsFooter'] = array(
            'custom/js/edit-userprofile.js',
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
        $this->load->model("userprofile_model");
        $data['userprofile'] = $this->userprofile_model->getUserprofileDataByID($admin_id);
        $data['bankdata'] = $this->userprofile_model->getBankDataByID();

        if ($data['userprofile'] !== FALSE) {

            $this->load->view("template/header", $this->data);
            $this->load->view("template/css", $data);
            $this->load->view("template/js", $data);
            $this->load->view("edit_profile_view", $data);
            $this->load->view("template/footer", $this->data);
        } else {
            show_404();
        }
    }

    public function editUserprofileData() {
        $adminid = $this->input->post("admin_id");

        $config['upload_path'] = 'assets/uploads/userprofile/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|jpeg';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $this->load->model("userprofile_model");
        $filedata = $this->upload->do_upload('userprofile');
$adminId = $this->input->post('admin_id');
//                echo "<pre>";
//                print_r($this->upload->data());
//                die;
        if ($this->input->post("changepassword") == "" && $this->input->post("password") != "") {
            $pass = $this->input->post("password", true);
        } else {
            $pass = md5($this->input->post("password", true));
        }


        $data = array(
            'admin_firstname' => $this->input->post("admin_firstname", true),
            'admin_lastname' => $this->input->post("admin_lastname", true),
            'username' => $this->input->post("username", true),
            'password' => $pass,
            'userprofile' => $this->upload->data("file_name"),
        );
//                echo "<pre>";
//                print_r($data);
//                die;
        $bankDetailsdata = array(
            'company_address' => $this->input->post("company_address"),
            'bank_detail' => $this->input->post("bank_detail"),
            'gst' => $this->input->post("gst"),
            'company_no' => $this->input->post("company_no"),
        );
        
        $this->load->model("userprofile_model");
        if ($this->userprofile_model->editUserProfileById($adminid, $data) !== FALSE) {
             $this->userprofile_model->updateBankDetailData($bankDetailsdata);
            echo json_encode(array("success" => 1,"userprofile" =>$this->upload->data("file_name")));
        } else {
            echo json_encode(array("error" => "<p>Data are not updated.</p>"));
        }
    }

    public function deleteUserprofile($admin_id) {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->load->model("userprofile_model");
        $this->userprofile_model->disableUserprofile($admin_id);
        echo json_encode(array("success" => 1));
    }

}
