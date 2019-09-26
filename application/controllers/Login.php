<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

        $this->data = array();
        $this->data['title'] = "CRM Login";
        $this->data['description'] = "";
    }

    public function index() {
        if (isLogin())
            redirect(base_url('dashboard'));
        $data['js'] = array(
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            'global/plugins/select2/js/select2.full.min.js',
            'pages/scripts/login.js',
            'pages/scripts/toaster/toaster.js'
        );
        $data['jsFooter'] = array(
            'global/plugins/ladda/spin.min.js',
            'global/plugins/ladda/ladda.min.js',
            'pages/scripts/ui-buttons.min.js'
        );
        $data['jsTPFooter'] = array(
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js'
        );
        $data['css'] = array(
            'pages/css/login.min.css',
            'global/plugins/select2/css/select2.min.css',
            'global/plugins/select2/css/select2-bootstrap.min.css',
            'global/plugins/ladda/ladda-themeless.min.css'
        );
        $data['cssTP'] = array(
            '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
        );

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('login_view.php');
        $this->load->view("template/footer", $this->data);
    }

    public function ajaxLogin() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("error" => validation_errors()));
        } else {
            $this->load->model("login_model");
            $data = array(
                'username' => $this->input->post("username", true),
                'password' => md5($this->input->post("password", true))
            );

            $adminId = $this->login_model->chkLogin($data);
            
             $contactdata = $this->login_model->chkContactLogin($data);
            $contactEmail = $contactdata[0]['contact_email'];
            
            if ($adminId > 0) {
                $adminData = $this->login_model->getAdminData($adminId);
//                echo "<pre>";
//                print_r($adminData);
//                die;
                $this->session->set_userdata('admin_id', $adminId);
                $this->session->set_userdata('admin_firstname', $adminData[0]['admin_firstname']);
                $this->session->set_userdata('admin_lastname', $adminData[0]['admin_lastname']);
                $this->session->set_userdata('userprofile', $adminData[0]['userprofile']);
                echo json_encode(array("success" => 1));
            }else if($contactdata > 0){
                 $adminData1 = $this->login_model->getContactAdminData($contactEmail);
//                echo "<pre>";
//                print_r($adminData1);
//                die;
                $this->session->set_userdata('contact_id', $adminData1[0]['contact_id']);
                $this->session->set_userdata('contact_fname', $adminData1[0]['contact_fname']);
                $this->session->set_userdata('contact_lname', $adminData1[0]['contact_lname']);
                $this->session->set_userdata('contact_email', $adminData1[0]['contact_email']);
                $this->session->set_userdata('contact_reltype', $adminData1[0]['contact_reltype']);
                $this->session->set_userdata('contact_state', $adminData1[0]['contact_state']);
                echo json_encode(array("success" => 2));
            } else {
                echo json_encode(array("error" => "<p>Username or Password is incorrect. </p>"));
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function ajaxForgotPwd() {
        // echo "hiiii";
        //echo $_POST["username"];
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->load->model("login_model");
        $adminemail = $this->input->post("username", true);
        $password = $this->input->post("password", true);
        if ($adminemail != "") {
            $findemail = $this->login_model->ForgotPassword($adminemail);

            if ($findemail !== FALSE) {
                $this->load->helper('string');
                $new_password = random_string('alnum', 8);
                $data['password'] = md5($new_password);
                $data['email'] = array(
                    'useremail' => $findemail,
                    'password' => $new_password,
                );

                $tempbody = $this->load->view('forgotpassword/forgotpasswordtemplete.php', $data, true);
                $emaildata[] = array(
                    'email_from' => 'info@hireamover.com.au',
                    'email_to' => $findemail[0]['username'],
                    'email_bcc' => '',
                    'email_cc' => '',
                    'email_subject' => 'Forgot Password For CRM',
                    'email_editor' => $tempbody,
                );
                $adminId = $findemail[0]['admin_id'];
            
                $sendEmail = sendEmail($emaildata, 'forgotpassword');
                if ($this->login_model->newPasswordUpdate($data['password'], $adminId) !== FALSE) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => "<p>Your password is not changed!</p>"));
                }
            } else {
                echo json_encode(array("error" => "<p>No user can be found for this email address!</p>"));
            }
        } else {
            echo json_encode(array("error" => "<p>Email should not be blank.</p>"));
        }
    }

}
