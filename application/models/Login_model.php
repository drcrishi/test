<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

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
        $this->load->database();
    }

    public function chkLogin($data) {
        $this->db->select('admin_id');
        $query = $this->db->get_where("admin", $data);
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result[0]['admin_id'];
        }
        return 0;
    }

    public function getAdminData($adminID) {
        $query = $this->db->get_where("admin", array("admin_id" => $adminID));
        return $query->result_array();
    }

    public function ForgotPassword($adminemail) {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('username', $adminemail);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function newPasswordUpdate($new_password, $adminId) {
        $this->db->set('password', $new_password);
        $this->db->where('admin_id', $adminId);
        return $this->db->update('admin');
    }
/*Diver login start..............@DRCZ*/
     public function chkContactLogin($data) {
        $contactdata = array(
            'contact_email' => $data['username'],
            'contact_password' => $data['password'],
            'is_deleted' => 0,
        );

        $this->db->select('*');
        $query = $this->db->get_where("admin_rp", $contactdata);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }
      public function getContactAdminData($contactEmail) {
        $this->db->select('*')->from('contact')
                ->join('admin_rp', 'contact.contact_email=admin_rp.contact_email')
                ->where('contact.is_deleted', 0)
                ->where('contact.contact_reltype != ', 3)
                ->where('contact.contact_email', $contactEmail);
        $query = $this->db->get();
      //  echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

}
