<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {

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

    public function addContactdata($data) {

        $this->db->set('contact_unique_id', 'UUID()', FALSE);
        $this->db->set('contact_date', 'now()', FALSE);
        $count = $this->db->insert('contact', $data);
        // echo $this->db->last_query();
        // die;
        $lastID = $this->db->insert_id();

        if ($lastID > 0) {
            $this->db->select("contact_unique_id");
            $fetchUUID = $this->db->get_where("contact", array("contact_id" => $lastID));
            $rowFetchUUID = $fetchUUID->result_array();
            return $rowFetchUUID[0]['contact_unique_id'];
        } else {
            return false;
        }
    }

    // Get contact_id when new contact create
    public function newContactId($data) {

        $this->db->set('contact_unique_id', 'UUID()', FALSE);
        $this->db->set('contact_date', 'now()', FALSE);
        $count = $this->db->insert('contact', $data);
        // echo $this->db->last_query();
        // die;
        $lastID = $this->db->insert_id();

        if ($lastID > 0) {
            $this->db->select("contact_id");
            $fetchUUID = $this->db->get_where("contact", array("contact_id" => $lastID));
            $rowFetchUUID = $fetchUUID->result_array();
            //return $fetchUUID;
            return $rowFetchUUID[0]['contact_id'];
        } else {
            return false;
        }
    }

    function generateUUID() {
        return $this->db->set('contact_unique_id', 'UUID()', FALSE);
    }

    function getContactIDFromUUID($contId) {
        $this->db->select("contact_id");
        $reID = $this->db->get_where("contact", array("contact_unique_id" => $contId));
        $rowID = $reID->result_array();
        // echo $this->db->last_query();
        return $rowID[0]['contact_id'];
    }

    function editContactById($contactId, $data) {
        $this->db->where('contact_id', $contactId);
        return $this->db->update('contact', $data);
        // echo $this->db->last_query();
    }

    public function getSuburb() {

        // $this->db->distinct();
        // $this->db->select('State');
        // $this->db->where('Enabled', 1);
        // $this->db->order_by('State');
        // $query = $this->db->get('suburb');
        // return $query->result_array();

        // $sql='SELECT DISTINCT `State` FROM `suburb` WHERE `Enabled` = 1 ORDER BY FIELD (state,"NSW") DESC';
        $sql='SELECT DISTINCT `State` FROM `suburb` WHERE `Enabled` = 1 ORDER BY state = "NSW" DESC, state DESC';
        return $this->db->query($sql)->result_array();
    }

    function getContactData($editCid) {

        $this->db->select("*");
        $this->db->where('contact_unique_id', $editCid);
        $this->db->from("contact");
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    function updateContactById($contactId, $data) {
        $this->db->where('contact_id', $contactId);
        return $this->db->update('contact', $data);
        //echo $this->db->last_query();
    }

    function disableContact($id) {

        $this->db->update("contact", array("is_deleted" => 1), array("contact_unique_id" => $id));
        return true;
    }

    /**
     * Multiple delete contacts............
     */
    function getAjaxDeleteFromContactList($ids) {
        if($this->session->admin_id == '1' || $this->session->admin_id == '2'){
            if (count($ids) > 0) {
                $this->db->where_in("contact_unique_id", $ids);
                $num_rows = $this->db->count_all_results('contact');

                if ($num_rows == count($ids)) {
                    $this->db->where_in("contact_unique_id", $ids);
                    $this->db->update("contact", array('is_deleted ' => 1));
                    return true;
                } else {
                    return false;
                }
            }
        }
        else{
            return false;
        }
    }

    /* Get Ajax Data */

    function getAjaxData() {
        /* IF Query comes from DataTables do the following */
        if (!empty($_POST)) {

            /* Useful $_POST Variables coming from the plugin */
            $draw = $_POST["draw"]; //counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
            $orderByColumnIndex = $_POST['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)

            $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Get name of the sorting column from its index			
            if ($orderBy == 'checkbox_val') {
                // $orderBy = 'contact_id';
                $orderBy = 'contactfullname';
            }
            $orderType = $_POST['order'][0]['dir']; // ASC or DESC
            $start = $_POST["start"]; //Paging first record indicator.
//            $start = 0;
            $length = $_POST['length']; //Number of records that the table can display in the current draw
            /* END of POST variables */
//echo $start;
//die;
            $where = "is_deleted = 0";

            if (!empty($_POST['contact_fname'])) {
                $where .= " AND ( contact_fname like '" . trim($_POST['contact_fname']) . "%' )";
            }
            if (!empty($_POST['contact_lname'])) {
                $where .= " AND ( contact_lname like '" . trim($_POST['contact_lname']) . "%' )";
            }
            if (!empty($_POST['contact_email'])) {
                $where .= " AND ( contact_email like '" . trim($_POST['contact_email']) . "%' )";
            }
            if (!empty($_POST['company_name'])) {
                $where .= " AND ( company_name like '" . trim($_POST['company_name']) . "%' )";
            }
            if (!empty($_POST['contact_phno'])) {
                $where .= " AND ( contact_phno like '" . trim($_POST['contact_phno']) . "%' )";
            }

            // Alphabetic Search
            if (!empty($_POST['alphabet']) && $_POST['alphabet'] != 'all') {
                $where .= " AND (contact_fname like '" . $_POST['alphabet'] . "%' )";
            }

            // For Dropdown filter ( View Inquerys)			
            if ($_POST['contact_reltype'] != "") {
                if ($_POST['contact_reltype'] != '') {
                    $where .= " AND ( contact_reltype = '" . $_POST['contact_reltype'] . "' )";
                }
            }
            if ($_POST['contact_state'] != "") {
                if ($_POST['contact_state'] != '') {
                    $where .= " AND ( contact_state = '" . trim($_POST['contact_state']) . "' )";
                }
            }
            //Count Query
            $sql = "SELECT *, CONCAT(contact_fname,' ',contact_lname) AS contactfullname FROM contact where " . $where;
            // echo $sql;die;
            $query = $this->db->query($sql);
            $recordsTotal = $query->num_rows();



            // Loop Query
            //$sql = "SELECT *,CONCAT_WS(' ', contact_fname,contact_lname) as contact_fname FROM contact where $where ORDER BY $orderBy $orderType limit $start,$length";
            $sql = "SELECT *, contact_state,CONCAT(contact_fname,' ',contact_lname) AS contactfullname  FROM contact where $where ORDER BY $orderBy $orderType limit $start,$length";

//            echo $sql;die;
            $query = $this->db->query($sql);
            $query = $query->result_array();

            $data = array();

            foreach ($query as $row) {
                if ($row['contact_reltype'] == 1) {
                    $row['contact_reltype'] = "Removalist";
                } else if ($row['contact_reltype'] == 2) {
                    $row['contact_reltype'] = "Packer";
                } else if ($row['contact_reltype'] == 3) {
                    $row['contact_reltype'] = "Client";
                }

                $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['contact_unique_id'] . '">';
                $row['contactfullname'] = '<span class="contactfullname">' . $row['contactfullname'] . '</span> <a style="display:none;" class="btn btn-success btn-xs ng-scope ng-isolate-scope editcontact" data-id="' . $row['contact_unique_id'] . '" title="Edit" data-toggle="modal" data-target="#edit-contact"><i class="fa fa-edit"></i></a>';
//               
//              $row['edit'] = '<a class="btn btn-success btn-xs ng-scope ng-isolate-scope editcontact" data-id="' . $row['contact_unique_id'] . '" title="Edit" data-toggle="modal" data-target="#edit-contact"><i class="fa fa-edit"></i></a>&nbsp;'
//                        . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deletecontact" data-id="' . $row['contact_unique_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
                $data[] = $row;
            }
            $recordsFiltered = $recordsTotal;
            //             echo "<pre>";
//            print_r($row);
//            die;
            if ($draw == 1) {
                $orderBy = "contact_id";
                $orderType = "desc";
            }
            //echo $sql;die;

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

    public function export_contactdata() {

        $this->db->select('*')->from('contact')
                ->where('is_deleted', 0)
                ->order_by('contact_id', 'DESC');
        $query = $this->db->get();

//        $this->db->order_by("enquiry_id", "DESC");
//        $query = $this->db->get("enquiry");
        //  echo $this->db->last_query();
        return $query->result();
    }

    public function Add_ImportedContactData($data_contact) {
        // echo "hii";
        $contactUniqueId = $data_contact['contact_unique_id'];
        $contactfname = $data_contact['contact_fname'];
        $contactmname = $data_contact['contact_middlename'];
        $contactlname = $data_contact['contact_lname'];
        $contactemail = $data_contact['contact_email'];
        $companyname = $data_contact['company_name'];
        $phone = $data_contact['contact_phno'];
        $state = $data_contact['contact_state'];
        $status = $data_contact['is_deleted'];

        if ($status == "Active") {
            $statustype = 0;
        } else if ($status == "Inactive") {
            $statustype = 1;
        }

        if ($data_contact['contact_reltype'] == "Removalist") {
            $movetype = 1;
        } else if ($data_contact['contact_reltype'] == "Packer") {
            $movetype = 2;
        } else if ($data_contact['contact_reltype'] == "Client") {
            $movetype = 3;
        }

        $this->db->select('*')->from('contact')
                ->where('contact_unique_id', $contactUniqueId)
                ->order_by('contact_id', 'DESC');
        $query = $this->db->get();

//        echo "<pre>";
//        echo $query->num_rows();
////        print_r();
//       // echo $this->db->last_query();
//        die;

        $data = array(
            'contact_unique_id' => $contactUniqueId,
            'contact_fname' => $contactfname,
            'contact_middlename' => $contactmname,
            'contact_lname' => $contactlname,
            'contact_email' => $contactemail,
            'company_name' => $companyname,
            'contact_phno' => $phone,
            'contact_reltype' => $movetype,
            'contact_state' => $state,
            'is_deleted' => $statustype,
        );
        //  echo $query->num_rows();
        // print_r($data);
        // die;
        if ($query->num_rows() > 0) {
            // die('if');
            $this->db->where('contact_unique_id', $contactUniqueId);


            return $this->db->update('contact', $data);
        } else {
            //  die('else');
            return $this->db->insert('contact', $data);
        }
    }

    /**
     * Get Removalist By UUID
     * @param type $uuid
     * @return type
     * @author Darshak Shah
     */
    function getRemovalistByUUID($uuid) {
        $this->db->select("c.contact_fname,c.contact_middlename,c.contact_lname,c.contact_phno,c.company_name,c.contact_email,e.en_note");
        $this->db->from("enquiry e");
        $this->db->join("contact c", "e.contact_id = c.contact_id");
        $this->db->where("contact_reltype", "1");
        $this->db->where_in("en_movetype", array(1, 2, 3));
        $this->db->where("en_unique_id", $uuid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return NULL;
        }
    }

    /**
     * Get packers By UUID
     * @param type $uuid
     * @return type
     * @author Darshak Shah
     */
    function getPackerstByUUID($uuid) {
        $query = $this->db->query('SELECT 
        c.contact_id, c.contact_fname,c.contact_middlename,c.contact_lname,c.contact_phno,c.company_name,c.contact_email,e.en_note
      FROM
          contact c,
          enquiry e
      WHERE
          FIND_IN_SET(c.contact_id, e.contact_id)
        AND en_unique_id = "' . $uuid . '"
        AND (en_movetype = 4 OR en_movetype = 5 OR en_movetype = 7 OR en_movetype = 8) AND  contact_reltype = 2 order by c.contact_fname');

        // echo $this->db->last_query(); die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return NULL;
        }
    }

    /**
     * Get Client By UUID
     * @param type $uuid
     * @return type
     * @author Darshak Shah
     */
    function getClientByUUID($uuid) {
        $this->db->select("c.contact_id,c.contact_fname,c.contact_middlename,c.contact_lname,c.contact_phno,c.company_name,c.contact_email,c.contact_unique_id");
        $this->db->from("enquiry e");
        $this->db->join("contact c", "e.customer_id = c.contact_id");
        $this->db->where("contact_reltype", "3");
        $this->db->where("en_unique_id", $uuid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return NULL;
        }
    }

    /* Drivers login start........@DRCZ */

    public function getAdminEmail($adminEmail) {
        $this->db->select("username");
        $this->db->where('username', $adminEmail);
        $this->db->from("admin");
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function addAdminRPdata($adminrpdata) {
        $adminrpEmail = $adminrpdata['contact_email'];
        $this->db->select("*");
        $this->db->where('contact_email', $adminrpEmail);
        $this->db->from("admin_rp");
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return $this->db->insert('admin_rp', $adminrpdata);
//        echo $this->db->last_query();
//        die;
        }
    }

    function updateAdminRPByEmail($contactEmail, $adminrpdata) {
        $adminrpEmail = $adminrpdata['contact_email'];
        $this->db->select("*");
        $this->db->where('contact_email', $adminrpEmail);
        $this->db->from("admin_rp");
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $this->db->where('contact_email', $contactEmail);
            return $this->db->update('admin_rp', $adminrpdata);
        } else {
            return $this->db->insert('admin_rp', $adminrpdata);
//        echo $this->db->last_query();
//        die;
        }
    }

    /* Drivers login end........@DRCZ */
}
