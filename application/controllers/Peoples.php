<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Peoples extends CI_Controller {

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
            redirect(base_url());
        $this->data = array();
        $this->data['title'] = "";
        $this->data['description'] = "";
        $this->data['user'] = $this->session->userdata('userData');
    }

    public function index() {
        $this->data['title'] = "CRM Peoples";
//        $data['jsFooter'] = array('ang_app/module_App.js','ang_app/peoples_Ctrl.js','custom/js/peoples.js');
        $data['jsFooter'] = array('custom/js/peoples.js');

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('peoples_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function profile() {
        $this->data['title'] = "User Profile";
        $data['css'] = array(
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
            'pages/css/profile-2.min.css',
        );
        $data['jsTPFooter'] = array(
            'http://maps.google.com/maps/api/js?sensor=false'
        );
        $data['jsFooter'] = array(
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
            'global/plugins/gmaps/gmaps.min.js'
        );
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('profile_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

}
