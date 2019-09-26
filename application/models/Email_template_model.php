<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email_template_model extends CI_Model {

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

    /**
     * @author Darshak Shah <darshak.shah@drcinfotech.com>
     * @uses Get Email Type
     * @return type
     */
    function getEmailType() {
        $re_emailType = $this->db->get("template_master");
        return $re_emailType->result_array();
    }

    /**
     * @author Darshak Shah <darshak.shah@drcinfotech.com>
     * @uses set Email Template Description
     * @param type $data
     */
    function setEmailMaster($data) {
        $this->db->set("created_date", "NOW()", false);
        $this->db->insert("email_master", $data);
        return $this->db->insert_id();
    }

    function setUpdateEmailMaster($data, $id) {
        $this->db->update("email_master", $data, array("email_master_id" => $id));
        return true;
    }

    function getEmailTemplate($moveTypeID, $templateTypeID) {
        $query = $this->db->get_where("email_master", array("en_movetype" => $moveTypeID, "template_master_id" => $templateTypeID, "is_disabled" => 0, "is_deleted" => 0));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getEmailTemplateByID($email_master_id) {
        $query = $this->db->get_where("email_master", array("email_master_id" => $email_master_id));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /* Get Ajax Data */

    public function getAjaxData() {
        /* IF Query comes from DataTables do the following */
        if (!empty($_POST)) {
            /* echo "<pre>";
              print_r($_POST); */
            define("email_master", "email_master");
            /* Useful $_POST Variables coming from the plugin */
            $draw = $_POST["draw"]; //counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
            $orderByColumnIndex = $_POST['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)

            $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Get name of the sorting column from its index			
            /* if($orderBy == 'edit_link')
              {
              $orderBy = 'email_master_id';
              } */
            $orderType = $_POST['order'][0]['dir']; // ASC or DESC
            $start = $_POST["start"]; //Paging first record indicator.
            $length = $_POST['length']; //Number of records that the table can display in the current draw
            /* END of POST variables */

            $sql = "SELECT * FROM " . email_master . " as e INNER JOIN " . move_type . " as m ON e.en_movetype=m.movetype_id where m.is_disabled=0";
            $query = $this->db->query($sql);
            $recordsTotal = $query->num_rows();

            /* SEARCH CASE : Using Alphabest Wise */

            /* */
            /* SEARCH CASE : Filtered data */
            if (!empty($_POST['search']['value'])) {

                /* WHERE Clause for searching */
                for ($i = 0; $i < count($_POST['columns']); $i++) {

                    $column = $_POST['columns'][$i]['data']; //we get the name of each column using its index from POST request			
                    $where[] = "$column like '%" . $_POST['search']['value'] . "%'";
                }
                $where = "WHERE " . implode(" OR ", $where); // id like '%searchValue%' or name like '%searchValue%' ....
                $where .= " AND is_deleted=0";
                /* End WHERE */

                $sql = sprintf("SELECT *,DATE_FORMAT(e.created_date, '%%d/%%m/%%Y %%h:%%s %%p') as created_date FROM " . email_master . " as e INNER JOIN " . move_type . " as m ON e.en_movetype=m.movetype_id %s", $where); //Search query without limit clause (No pagination)		
                $query = $this->db->query($sql);
                $recordsFiltered = $query->num_rows(); //count(getData($sql));//Count of search result

                /* SQL Query for search with limit and orderBy clauses */
                $sql = sprintf("SELECT *,DATE_FORMAT(e.created_date, '%%d/%%m/%%Y %%h:%%s %%p') as created_date FROM " . email_master . " as e INNER JOIN " . move_type . " as m ON e.en_movetype=m.movetype_id %s ORDER BY %s %s limit %d , %d ", $where, $orderBy, $orderType, $start, $length);
                $query = $this->db->query($sql);
                $query = $query->result_array();

                $data = array();
                foreach ($query as $row) {
                    $row['en_movetype'] = '<a href="/email_masterdetails/' . $row['email_master_id'] . '">' . $row['movetype_name'] . '</a>';
                    $data[] = $row;
                }
            }
            /* END SEARCH */ else {
                $sql = sprintf("SELECT *,DATE_FORMAT(e.created_date, '%%d/%%m/%%Y %%h:%%s %%p') as created_date FROM " . email_master . " as e INNER JOIN " . move_type . " as m ON e.en_movetype=m.movetype_id where e.is_deleted=0 and m.is_disabled=0 ORDER BY %s %s limit %d , %d ", $orderBy, $orderType, $start, $length);
                $query = $this->db->query($sql);
                $query = $query->result_array();

                $data = array();
                foreach ($query as $row) {
                    $row['en_movetype'] = '<a class="emaillink" href="' . base_url('emailtemplate/edit/' . $row['email_master_id']) . '">' . $row['movetype_name'] . '</a>';
                    $data[] = $row;
                }
                $recordsFiltered = $recordsTotal;
            }

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

    /* */

    function disableEmailTemplate($templateID) {
        $this->db->update("email_master", array("is_deleted" => 1), array("email_master_id" => $templateID));
        return true;
    }

    function getEmailTypeByID($templateID) {
        $query = $this->db->get_where("template_master", array("template_master_id" => $templateID));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function getEmailIDByName($templateName) {
        $query = $this->db->get_where("template_master", array("template_master_name" => $templateName));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function addEmailLog($emailData, $id) {
        $enquiryId = $id;
        $emailmastId = $emailData[0]['email_master_id'];
        $emailFrom = $emailData[0]['email_from'];
        $emailTo = serialize($emailData[0]['email_to']); //$emailData[0]['email_to'];        
        $emailCc = $emailData[0]['email_cc'];
        $emailBcc = $emailData[0]['email_bcc'];
        $emailsubject = $emailData[0]['email_subject'];
        $emaileditor = $emailData[0]['email_editor'];
        $sentBy=$this->session->userdata('admin_id');
        if($sentBy == ''){
            $sentBy = $this->session->userdata('contact_id');
        }
        // $sentBy='';
        // if(isset($this->session->userdata('admin_id'))){
        //     $sentBy=$this->session->userdata('admin_id');
        // }
        // else{
        //     $sentBy=$this->session->userdata('contact_id');
        // }
        // $emailSentby = $result[0]['created_by'];
//        print_r($emailData);
//        die;
        $data = array(
            'email_master_id' => $emailmastId,
            'enquiry_id' => $enquiryId,
            'email_log_from' => $emailFrom,
            'email_log_to' => $emailTo,
            'email_log_cc' => $emailCc,
            'email_log_bcc' => $emailBcc,
            'email_log_subject' => $emailsubject,
            'email_log_editor' => $emaileditor,
            // 'email_sent_by' => $this->session->userdata('admin_id'),
            'email_sent_by' => $sentBy,
        );
//       print_r($data);
//       die;
        $this->db->set('email_log_date', 'now()', FALSE);
        return $this->db->insert('email_log', $data);
    }

      function addAutoEmailLog($emailData, $id) {
//        echo "<pre>";
//        print_r($emailData);
       
        $enquiryId = $id;
        $emailFrom = $emailData[0]['email_from'];
        $emailTo = $emailData[0]['email_to']; //$emailData[0]['email_to'];        
        $emailCc = $emailData[0]['email_cc'];
        $emailBcc = $emailData[0]['email_bcc'];
        $emailsubject = $emailData[0]['email_subject'];
        $emaileditor = $emailData[0]['email_editor'];
        // $emailSentby = $result[0]['created_by'];
//        print_r($emailData);
//        die;
        $data = array(
            'enquiry_id' => $enquiryId,
            'auto_email_log_from' => $emailFrom,
            'auto_email_log_to' => $emailTo,
            'auto_email_log_cc' => $emailCc,
            'auto_email_log_bcc' => $emailBcc,
            'auto_email_log_subject' => $emailsubject,
            'auto_email_log_editor' => $emaileditor,
            'auto_email_sent_by' => 1,
            
        );
        $this->db->set('auto_email_log_date', 'now()', FALSE);
        return $this->db->insert('auto_email_reminder', $data);
    }
}
