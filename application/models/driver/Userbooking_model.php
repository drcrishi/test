<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userbooking_model extends CI_Model {

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

    function getUserAjaxData() {
        /* IF Query comes from DataTables do the following */
        if (!empty($_POST)) {

            /* Useful $_POST Variables coming from the plugin */
            $draw = $_POST["draw"]; //counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
            $orderByColumnIndex = $_POST['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)

            $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Get name of the sorting column from its index			
            if ($orderBy == 'checkbox_val') {
                $orderBy = 'enquiry_id';
            }
            $orderType = $_POST['order'][0]['dir']; // ASC or DESC
            $start = $_POST["start"]; //Paging first record indicator.
//            $start = 0;
            $length = $_POST['length']; //Number of records that the table can display in the current draw
            /* END of POST variables */
//echo $orderType;
//die;
            $bookingStatus= $_POST['driverView_booking'];
            $bookingWhere='';
            if($bookingStatus == 'all'){
                $bookingWhere = ' ( e.booking_status = 1 or e.booking_status = 2 or e.booking_status = 3 ) ';
            }
            else if($bookingStatus == '1'){
                $bookingWhere = ' ( e.booking_status = 1 or e.booking_status = 2 ) ';   
            }
            else if($bookingStatus == '3'){
                $bookingWhere = ' ( e.booking_status = 3 ) ';   
            }
            $where = "e.is_deleted = 0 and e.is_qualified = 1 and " . $bookingWhere . " and c.contact_email ='" . $this->session->userdata('contact_email') . "'";
            if (!empty($_POST['first_name'])) {
                $where .= " AND ( c2.contact_fname like '" . addslashes(trim($_POST['first_name'])) . "%' )";
            }
            if (!empty($_POST['last_name'])) {
                $where .= " AND ( c2.contact_lname like '" . addslashes(trim($_POST['last_name'])) . "%' )";
            }
//            if (!empty($_POST['clientname'])) {
//                $where .= " AND ( clientname like '" . trim($_POST['clientname']) . "%' )";
//            }

            if (!empty($_POST['removalistfilter'])) {
                $where .= " AND ( c.contact_fname like '" . addslashes(trim($_POST['removalistfilter'])) . "%' )";
            }
//            if (!empty($_POST['removalist_booking'])) {
//                $where .= " AND ( CONCAT(c.contact_fname, ' ', c.contact_lname) like '" . $_POST['removalist_booking'] . "%' )";
//            }
            if (!empty($_POST['en_movingfrom_state'])) {
                $where .= " AND ( e.en_movingfrom_state like '" . trim($_POST['en_movingfrom_state']) . "%' )";
            }
//            if (!empty($_POST['movetype_name'])) {
//                $where .= " AND ( m.movetype_name like '" . $_POST['movetype_name'] . "%' )";
//            }
            if (!empty($_POST['en_date'])) {
                $where .= " AND ( e.en_date like '" . $_POST['en_date'] . "%' )";
            }
            if (!empty($_POST['en_servicedate'])) {
                $where .= " AND ( e.en_servicedate like '" . $_POST['en_servicedate'] . "%' )";
            }

//            echo mysql_real_escape_string($_POST['fullname']);
//            die;

            if (!empty($_POST['userfullname'])) {
                $where .= " AND (( CONCAT(c2.contact_fname , ' ', c2.contact_lname) like '%" . addslashes(trim($_POST['userfullname'])) . "%' )
                OR ( c2.contact_fname like '%" . addslashes(trim($_POST['userfullname'])) . "%' )
                OR ( c2.contact_lname like '%" . addslashes(trim($_POST['userfullname'])) . "%' ))";
            }

            // Alphabetic Search
            if (!empty($_POST['alphabet']) && $_POST['alphabet'] != 'all') {
                $where .= " AND ( e.en_fname like '" . $_POST['alphabet'] . "%' )";
            }

            // For Dropdown filter ( View Inquerys)			
            if ($_POST['view_booking'] != "") {
                if ($_POST['view_booking'] != 'all') {
                    if ($_POST['view_booking'] == '1') {
                        $where .= " AND (( e.booking_status = '" . $_POST['view_booking'] . "' )";
                       // $where .= " OR ( e.booking_status = '2'))";
                    } else {
                        $where .= " AND ( e.booking_status = '" . $_POST['view_booking'] . "' )";
                    }
                }
            }
            if ($_POST['movetype_name'] != "") {
                if ($_POST['movetype_name'] == '4') {
                    $where .= " AND (( e.en_movetype = '" . trim($_POST['movetype_name']) . "' )";
                    $where .= " OR ( e.en_movetype = '5'))";
                } else {
                    $where .= " AND ( e.en_movetype = '" . trim($_POST['movetype_name']) . "' )";
                }
            }

            //Count Query
            //  $sql = "SELECT *,(IF(find_in_set('JobSheet',group_concat(template_master_name)) > 0, 'Yes', 'No')) AS JobSheet,(IF(find_in_set('BookingConfirmation',group_concat(template_master_name)) > 0, 'Yes', 'No')) AS BookingConfirmation,IF(e.en_deposit_received = 1,'Yes','No') is_deposited,concat(c.contact_fname,' ',c.contact_lname) as contact_fullname FROM enquiry AS e INNER JOIN move_type AS m ON e.en_movetype = m.movetype_id LEFT JOIN contact c ON c.contact_id = e.contact_id LEFT JOIN contact AS c2 ON c2.contact_id = e.customer_id LEFT JOIN email_log AS email ON e.enquiry_id = email.enquiry_id left JOIN email_master emI ON email.email_master_id =emI.email_master_id LEFT JOIN template_master tm ON tm.template_master_id=emI.template_master_id where " . $where . " group by e.enquiry_id";

            $sql = "SELECT e.enquiry_id, e.en_unique_id, e.en_servicedate,e.en_movetype as mtype ,e.en_movingfrom_suburb, e.en_movingto_suburb, e.booking_status,e.en_servicetime,e.en_movingfrom_state,e.en_movingto_state, movetype_name,"
                    . " CONCAT(c2.contact_fname , ' ', c2.contact_lname) AS clientname FROM enquiry AS e "
                    . "INNER JOIN move_type AS m ON e.en_movetype = m.movetype_id"
                    . " LEFT JOIN contact c ON find_in_set(c.contact_id,e.contact_id)"
                    . "INNER JOIN admin_rp AS adrp ON adrp.contact_email = c.contact_email"
                    . " LEFT JOIN contact AS c2 ON c2.contact_id = e.customer_id"
                    . " where " . $where . " group by e.enquiry_id";
            //  echo $sql; die;
            $query = $this->db->query($sql);
            $recordsTotal = $query->num_rows();

            // Loop Query

            $sql = "SELECT e.enquiry_id, e.en_unique_id, e.en_servicedate,e.en_movetype as mtype ,e.en_movingfrom_suburb, e.en_movingto_suburb, e.booking_status,e.en_servicetime,e.en_movingfrom_state,e.en_movingto_state, movetype_name,"
                    . " CONCAT(c2.contact_fname , ' ', c2.contact_lname) AS clientname FROM enquiry AS e "
                    . "INNER JOIN move_type AS m ON e.en_movetype = m.movetype_id"
                    . " LEFT JOIN contact c ON find_in_set(c.contact_id,e.contact_id)"
                    . "INNER JOIN admin_rp AS adrp ON adrp.contact_email = c.contact_email"
                    . " LEFT JOIN contact AS c2 ON c2.contact_id = e.customer_id"
                    . " where " . $where . " group by e.enquiry_id ORDER BY $orderBy $orderType limit $start,$length";
            // echo $sql;die;
            $query = $this->db->query($sql);
            $query = $query->result_array();

            $data = array();

            foreach ($query as $row) {

//                if ($row['movetype_name'] == "Home") {
//                    $row['movetype_name'] = "Home Removal";
//                }
//                if ($row['movetype_name'] == "Office") {
//                    $row['movetype_name'] = "Office Removal";
//                }

                if ($row['en_movetype'] == 6) {
                    if ($row['en_storagedate'] == NULL) {
                        $row['en_servicedate'] = "";
                    } else {
                      //  $row['en_servicedate'] = '<a href="' . base_url('/driver/userbookinglist/viewUserBooking/' . $row['en_unique_id']) . '">' . date('d/m/Y', strtotime($row['en_storagedate'])) . '</a>';
                        $row['en_servicedate'] = '<a href="javascript: void(0);">' . date('d/m/Y', strtotime($row['en_storagedate'])) . '</a>';
                    }
                } else {
                    if ($row['en_servicedate'] == NULL) {
                        $row['en_servicedate'] = "";
                    } else {
                      //  $row['en_servicedate'] = '<a href="' . base_url('/driver/userbookinglist/viewUserBooking/' . $row['en_unique_id']) . '">' . date('d/m/Y', strtotime($row['en_servicedate'])) . '</a>';
                        $row['en_servicedate'] = '<a href="javascript: void(0);">' . date('d/m/Y', strtotime($row['en_servicedate'])) . '</a>';
                    }
                }
//                if ($row['is_qualified'] == 1) {
//                    $row['en_fname'] = $row['clientname'];
//                }
                if ($row['mtype'] == 5) {
                    $row['contact_fullname'] = $row['contact_fullname'];
                   // $row['en_movingfrom_state'] = $row['en_movingto_state'];
                } 
//                else {
//                    $row['en_movingfrom_state'] = $row['en_movingfrom_state'];
//                }
                if ($row['mtype'] == '1' || $row['mtype'] == '2') {
                    $row['en_movingfrom_state'] = $row['en_movingfrom_state'];
                } else if ($row['mtype'] == '4') {
                    $row['en_movingfrom_state'] = $row['en_movingfrom_state'];
                } else if ($row['mtype'] == '5') {
                    $row['en_movingfrom_state'] = $row['en_movingto_state'];
                }
                
                if ($row['mtype'] == '1' || $row['mtype'] == '2') {
                    $row['en_movingfrom_suburb'] = $row['en_movingfrom_suburb'];
                    $row['en_movingto_suburb'] = $row['en_movingto_suburb'];
                } else if ($row['mtype'] == '4') {
                    $row['en_movingfrom_suburb'] = $row['en_movingfrom_suburb'];
                    $row['en_movingto_suburb'] = "";
                } else if ($row['mtype'] == '5') {
                    $row['en_movingto_suburb'] = $row['en_movingto_suburb'];
                    $row['en_movingfrom_suburb'] = "";
                }

                if ($row['booking_status'] == 1) {
                    $row['booking_status'] = "Current";
                } 
               else if ($row['booking_status'] == 2) {
                   $row['booking_status'] = "Other";
               } else if ($row['booking_status'] == 3) {
                   $row['booking_status'] = "Completed";
               }

                $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['en_unique_id'] . '">';
                if ($row['mtype'] == 1) {
                    $row['jobsheet'] = ' <a href="javascript: void(0);" class="btn blue-madison viewjobsheetuser" data-id="' . $row['en_unique_id'] . '">VIEW PDF</a>&nbsp;' . '<a href="javascript: void(0);" class="btn blue-madison printjobsheet" data-id="' . $row['en_unique_id'] . '">ONLINE JOB SHEET</a>&nbsp;' . '<a href="javascript: void(0);" class="btn blue-madison wavierform" style="vertical-align:top !important;" data-id="' . $row['en_unique_id'] . '">WAIVER FORM </a>&nbsp;' . '<a href="javascript: void(0);" class="btn blue-madison jobsheet" style="vertical-align:top !important;" data-id="' . $row['enquiry_id'] . '">EMAIL JOBSHEET </a>';
                } else if ($row['mtype'] == 2) {
                    $row['jobsheet'] = ' <a href="javascript: void(0);" class="btn blue-madison viewjobsheetuser" data-id="' . $row['en_unique_id'] . '">VIEW PDF</a>&nbsp;' . '<a href="javascript: void(0);" class="btn blue-madison printjobsheet" data-id="' . $row['en_unique_id'] . '">ONLINE JOB SHEET</a>&nbsp;' .'<a href="javascript: void(0);" class="btn blue-madison wavierform" style="vertical-align:top !important;" data-id="' . $row['en_unique_id'] . '">WAIVER FORM </a>&nbsp;' . '<a href="javascript: void(0);" class="btn blue-madison jobsheet" style="vertical-align:top !important;" data-id="' . $row['enquiry_id'] . '">EMAIL JOBSHEET </a>';
                } else if ($row['mtype'] == 4) {
                    $row['jobsheet'] = ' <a href="javascript: void(0);" class="btn blue-madison viewjobsheetuser" data-id="' . $row['en_unique_id'] . '">VIEW PDF</a>';
                } else if ($row['mtype'] == 5) {
                    $row['jobsheet'] = ' <a href="javascript: void(0);" class="btn blue-madison viewjobsheetuser" data-id="' . $row['en_unique_id'] . '">VIEW PDF</a>';
                } else {
                    $row['jobsheet'] = '';
                }
//                $row['qualified_date'] = '<a href="' . base_url('/booking/viewBooking/' . $row['en_unique_id']) . '">' . date('d/m/Y h:s A', strtotime($row['qualified_date'])) . '</a>';
                //  $row['edit'] = '<a href="' . base_url('/booking/viewBooking/' . $row['en_unique_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deletebooking" data-id="' . $row['en_unique_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
                $data[] = $row;
            }
            $recordsFiltered = $recordsTotal;

            if ($draw == 1) {
                $orderBy = "en_unique_id";
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

    function jobsheetPDF($param) {
        $this->load->model('booking_model');
        $data['enquiry_data'] = $this->booking_model->getBookingDataByBookingID($EnquiryId);
    }

    function getEnquiryDataByUUID($en_unique_id, $sessionEmail) {

        $sql = "SELECT *,c.contact_email,"
                . " CONCAT(c2.contact_fname , ' ', c2.contact_lname) AS clientname FROM enquiry AS e "
                . "INNER JOIN move_type AS m ON e.en_movetype = m.movetype_id"
                . " LEFT JOIN contact c ON find_in_set(c.contact_id,e.contact_id)"
                . " LEFT JOIN contact AS c2 ON c2.contact_id = e.customer_id"
                // . " where  c.contact_email ='" . $sessionEmail . "' and e.en_unique_id='" . $en_unique_id . "' and e.is_qualified = 1 and e.is_deleted = 0 and e.booking_status != 3 group by e.enquiry_id";
                . " where  c.contact_email ='" . $sessionEmail . "' and e.en_unique_id='" . $en_unique_id . "' and e.is_qualified = 1 and e.is_deleted = 0 group by e.enquiry_id";
        $query = $this->db->query($sql);
//              echo $this->db->last_query();
//         die;
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    public function changePwd($sessionEmail, $sessionPwd, $userPwd, $userPwdOld) {

        if ($sessionPwd == md5($userPwdOld)) {

            $pwddata = array(
                'contact_password' => md5($userPwd)
            );
            $this->db->where('contact_email', $sessionEmail);
            $this->db->update('admin_rp', $pwddata);
            return true;
        } else {
            return false;
        }
    }
    
     public function changeProfilePic($sessionEmail, $userprofile) {
        if ($userprofile != "") {
            $profiledata = array(
                'userprofile' => $userprofile,
            );
            $this->db->where('contact_email', $sessionEmail);
            $this->db->update('admin_rp', $profiledata);
            return true;
        } else {
            return false;
        }
    }

    public function getadminRPPwd($sessionEmail) {
        $this->db->select('*')->from('admin_rp')
                ->where('contact_email', $sessionEmail);
        $query = $this->db->get();
//         echo $this->db->last_query();
//         die;
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

}
