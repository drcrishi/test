<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmailConf_model extends CI_Model {

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

    public function AddEmailConfData($data) {
        $this->db->set('change_date', 'now()', FALSE);
        $count = $this->db->insert('email_config', $data);
        $lastID = $this->db->insert_id();
        if ($lastID > 0) {
            $this->db->select("*");
            $fetchUUID = $this->db->get_where("email_config", array("emailconf_id" => $lastID));
            $rowFetchUUID = $fetchUUID->result_array();
            return $rowFetchUUID[0]['emailconf_id'];
        } else {
            return false;
        }
        
    }
    public function AddEmailConfMaster($data) {
       
        return $this->db->insert('email_config_master', $data);
    }

    public function UpdateEmailConfdataList($emaildata, $job) {
        
        $this->db->where('jobtype',$job);
        return $this->db->update('email_config',$emaildata);
//         echo $this->db->last_query();
//        die;
    }
    
    function getEmailConfDataByID($emailconf_id) {
        $this->db->select("*");
        $this->db->where('emailconf_id', $emailconf_id);
        $this->db->from("email_config");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }
    function getEmailMasterJobtype($job,$userdata) {
         $this->db->select('*')->from('email_config')
                ->join('email_config_master', 'email_config.jobtype = email_config_master.jobtype')
                ->where('email_config.emailconf_id', $userdata);
        $query = $this->db->get();
         
         if ($query->num_rows() > 0) {
            $row = $query->result_array();
            $adddata = array(
                 'smtp_user' => $row[0]['smtp_user'],
                 'smtp_pass' => $row[0]['smtp_pass'],
            );
            $this->db->where('emailconf_id', $userdata);
            return $this->db->update('email_config', $adddata);
        } else {
            return false;
        }
    }
    function getEmailConfMasterDataByID($emailconfmaster_id) {
        $this->db->select("*");
        $this->db->where('email_config_master_id', $emailconfmaster_id);
        $this->db->from("email_config_master");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    function editEmailconfById($emailconfid, $data) {

        $this->db->where('emailconf_id', $emailconfid);
        return $this->db->update('email_config', $data);
        // echo $this->db->last_query();
    }
    function editMasterEmailconfById($emailconfmasterid, $data) {

        $this->db->where('email_config_master_id', $emailconfmasterid);
        return $this->db->update('email_config_master', $data);
        // echo $this->db->last_query();
    }

    public function getAjaxData() {
        /* IF Query comes from DataTables do the following */
        if (!empty($_POST)) {

            define("email_config", "email_config");
            /* Useful $_POST Variables coming from the plugin */
            $draw = $_POST["draw"]; //counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables

            $orderByColumnIndex = $_POST['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)

            $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Get name of the sorting column from its index			
            /* if($orderBy == 'edit_link')
              {
              $orderBy = 'contact_id';
              } */
            if ($orderBy == 'checkbox_val') {
                $orderBy = 'emailconf_id';
            }
            $orderType = $_POST['order'][0]['dir']; // ASC or DESC
            $start = $_POST["start"]; //Paging first record indicator.
            $length = $_POST['length']; //Number of records that the table can display in the current draw
            /* END of POST variables */
// echo $length;
// die;
            // $sql = "SELECT * FROM " . email_config ." where is_deleted = '0'";
            // $query = $this->db->query($sql);
            

                $sql = sprintf("SELECT * FROM " . email_config . " where is_deleted = '0' ORDER BY %s %s limit %d , %d ", $orderBy, $orderType, $start, $length);
                $query = $this->db->query($sql);
                $recordsTotal = $query->num_rows();
                $query = $query->result_array();

                $data = array();
                foreach ($query as $row) {
                    
                    if($row['jobtype'] == 1){
                        $row['jobtype'] = 'Move';
                    }
                   else if($row['jobtype'] == 2){
                        $row['jobtype'] = 'Pack';
                    }
                    else if($row['jobtype'] == 3){
                        $row['jobtype'] = 'Luxepack';
                    }
                    
                    $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['emailconf_id'] . '">';
                    $row['smtp_user'] = '<a class="userlink" href="' . base_url('/EmailConf/viewEmailConf/' . $row['emailconf_id']) . '">' . $row['smtp_user'] . '</a>';
                  //  $row['edit'] = '<a href="' . base_url('/userprofile/viewUserprofile/' . $row['admin_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deleteuserprofile" data-id="' . $row['admin_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
                    $data[] = $row;
//                    print_r($data);
//                    die;
                }
                $recordsFiltered = $recordsTotal;
            

            /* Response to client before JSON encoding */
            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsFiltered,
                "data" => $data
            );

            echo json_encode($response);
        } else {
            echo "NO POST Query from DataTable";
        }
    }
    public function getAjaxDataMasterEmailConf() {
        if (!empty($_POST)) {
            define("email_config_master", "email_config_master");
            $draw = $_POST["draw"];
            $orderByColumnIndex = $_POST['order'][0]['column'];
            $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];
            if ($orderBy == 'checkbox_val') {
                $orderBy = 'email_config_master_id';
            }
            $orderType = $_POST['order'][0]['dir']; // ASC or DESC
            $start = $_POST["start"]; //Paging first record indicator.
            $length = $_POST['length']; //Number of records that the table can display in the current draw
            // $sql = "SELECT * FROM " . email_config_master . " where is_deleted = '0'";
            // $query = $this->db->query($sql);
            

            $sql = sprintf("SELECT * FROM " . email_config_master . " where is_deleted = '0' ORDER BY %s %s limit %d , %d ", $orderBy, $orderType, $start, $length);
            $query = $this->db->query($sql);
            $recordsTotal = $query->num_rows();
            $query = $query->result_array();
            
            $data = array();
            foreach ($query as $row) {
                if($row['jobtype'] == 1){
                    $row['jobtype'] = 'Move';
                }
                else if($row['jobtype'] == 2){
                    $row['jobtype'] = 'Pack';
                }
                else if($row['jobtype'] == 3){
                    $row['jobtype'] = 'Luxepack';
                }
                $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['emailconf_id'] . '">';
                $row['smtp_user'] = '<a class="userlink" href="' . base_url('/EmailConf/viewEmailConfMaster/' . $row['email_config_master_id']) . '">' . $row['smtp_user'] . '</a>';
                //  $row['edit'] = '<a href="' . base_url('/userprofile/viewUserprofile/' . $row['admin_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deleteuserprofile" data-id="' . $row['admin_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
                $data[] = $row;
            }
            $recordsFiltered = $recordsTotal;
            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsFiltered,
                "data" => $data
            );

            echo json_encode($response);
        } else {
            echo "NO POST Query from DataTable";
        }
    }

    function getEmailDataConfig() {
        $this->db->select("*");
        $this->db->from("email_config");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }
}
