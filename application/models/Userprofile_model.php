<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Userprofile_model extends CI_Model {

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

    public function userProfileData($data) {
//
//        print_r($data);
//        die;
//        $data=array('userTest_name'=>'d','userTest_tel'=>'b');
        return $this->db->insert('admin', $data);
    }

    function getUserprofileDataByID($admin_id) {
        $this->db->select("*");
        $this->db->where('admin_id', $admin_id);
        $this->db->from("admin");
        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    function editUserProfileById($adminid, $data) {
//        echo "<pre>";
//        print_r($data);
//        die;
        $this->db->where('admin_id', $adminid);
        return $this->db->update('admin', $data);
        // echo $this->db->last_query();
    }

    function disableUserprofile($admin_id) {

        $this->db->update("admin", array("is_deleted" => 1), array("admin_id" => $admin_id));
        return true;
    }

    function getUserprofileData() {
        $length = $_POST['length'];
        $start = $_POST['start'];
        $draw = $_POST['Draw'];
        $resultCount = $this->db->query("Select * From admin ");
        $results['recordsTotal'] = count($resultCount->result_array());
        $results['recordsFiltered'] = count($resultCount->result_array());
        $results['draw'] = 1;
        $results['data'] = "";

        if ($resultCount > 0) {
            $query = $this->db->query("Select * From admin");

            $json_array = array();
            $i = $start + 1;
            $y = 0;
            foreach ($query->result_array() as $result_value) {

                $results['data'][$y]['admin_firstname'] = $result_value['admin_firstname'];
                $results['data'][$y]['admin_lastname'] = $result_value['admin_lastname'];
                $results['data'][$y]['username'] = $result_value['username'];
                $y++;
            }
        }
        //  $results['data']=$json_array;

        return json_encode($results);
    }

    //Multiple delete......................
    function getAjaxDeleteFromUserList($ids) {

        if (count($ids) > 0) {
            $this->db->where_in("admin_id", $ids);
            $num_rows = $this->db->count_all_results('admin');

            if ($num_rows == count($ids)) {
                $this->db->where_in("admin_id", $ids);
                $this->db->update("admin", array('is_deleted ' => 1));
                return true;
            } else {
                return false;
            }
        }
    }
    
//    function getAjaxData() {
//        /* IF Query comes from DataTables do the following */
//        if (!empty($_POST)) {
////             echo "<pre>";
////              print_r($_POST); 
//
//            define("admin", "admin");
//            /* Useful $_POST Variables coming from the plugin */
//            $draw = $_POST["draw"]; //counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
//            $orderByColumnIndex = $_POST['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
//
//            $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Get name of the sorting column from its index			
//            if ($orderBy == 'checkbox_val') {
//                $orderBy = 'admin_id';
//            }
//            $orderType = $_POST['order'][0]['dir']; // ASC or DESC
//            $start = $_POST["start"]; //Paging first record indicator.
//            $length = $_POST['length']; //Number of records that the table can display in the current draw
//            /* END of POST variables */
//
//
//
//            if (!empty($_POST['alphabet']) && $_POST['alphabet'] != 'all') {
//                /* WHERE Clause for searching */
//                for ($i = 0; $i < count($_POST['columns']); $i++) {
//
//                    if ($_POST['columns'][$i]['data'] != "checkbox_val" && $_POST['columns'][$i]['data'] != "edit") {
//                        $column = $_POST['columns'][$i]['data']; //we get the name of each column using its index from POST request			
//                        $wherecount[] = "$column like '%" . $_POST['search']['value'] . "%'";
//                    }
//                }
//                $wherecount = "AND ( " . implode(" OR ", $wherecount) . " )"; // id like '%searchValue%' or name like '%searchValue%' ....
//                $wherecount .= " AND ( admin_firstname like '" . $_POST['alphabet'] . "%' )";
//                /* End WHERE */
//            }
//
//
//            if ($wherecount != "") {
//                $sql = "SELECT * FROM " . admin . "  where is_deleted = 0  " . $wherecount;
//            } else {
//                $sql = "SELECT * FROM " . admin . "  where is_deleted = 0 ";
//            }
//
//            //  echo $sql;die;
//            $query = $this->db->query($sql);
//            $recordsTotal = $query->num_rows();
//           //echo $this->db->last_query();
//
//            /* SEARCH CASE : Using Alphabest Wise */
//
//            /* */
//            /* SEARCH CASE : Filtered data */
////            print_r($_POST['search']['value']);
////            die;
//            if (!empty($_POST['search']['value'])) {
//
//                if (!empty($_POST['alphabet']) && $_POST['alphabet'] != 'all') {
//
//                    /* WHERE Clause for searching */
//                    for ($i = 0; $i < count($_POST['columns']); $i++) {
//
//                        if ($_POST['columns'][$i]['data'] != "checkbox_val" && $_POST['columns'][$i]['data'] != "edit") {
//                            $column = $_POST['columns'][$i]['data']; //we get the name of each column using its index from POST request			
//                            $where[] = "$column like '%" . $_POST['search']['value'] . "%'";
//                        }
//                    }
//                    $where = "WHERE ( " . implode(" OR ", $where) . " )"; // id like '%searchValue%' or name like '%searchValue%' ....
//                    $where .= " AND ( admin_firstname like '" . $_POST['alphabet'] . "%' )";
//
//
//                    /* WHERE Clause for searching */
//                    for ($i = 0; $i < count($_POST['columns']); $i++) {
//
//                        if ($_POST['columns'][$i]['data'] != "checkbox_val" && $_POST['columns'][$i]['data'] != "edit") {
//
//                            $column = $_POST['columns'][$i]['data']; //we get the name of each column using its index from POST request			
//                            $where[] = "$column like '%" . $_POST['search']['value'] . "%'";
//                        }
//                    }
//                    $where = "WHERE" . implode(" OR ", $where); // id like '%searchValue%' or name like '%searchValue%' ....
//                    // For Dropdown filter ( View Inquerys)
//                    // echo $where;
//                    $sql = sprintf("SELECT *,admin_firstname FROM " . admin . " %s where is_deleted = 0", $where); //Search query without limit clause (No pagination)		
//                    $query = $this->db->query($sql);
//                    $recordsFiltered = $query->num_rows(); //count(getData($sql));//Count of search result
//
//                    /* SQL Query for search with limit and orderBy clauses */
//                    $sql = sprintf("SELECT *,admin_firstname FROM " . admin . " %s where is_deleted = 0 ORDER BY %s %s limit %d , %d ", $where, $orderBy, $orderType, $start, $length);
//                    $query = $this->db->query($sql);
//                    $query = $query->result_array();
////echo $this->db->last_query();
////die;
//                    $data = array();
//                    foreach ($query as $row) {
//                        $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['admin_id'] . '">';
//                        $row['admin_firstname'] = '<a href="' . base_url('/userprofile/view/' . $row['admin_id']) . '">' . $row['admin_firstname'] . '</a>';
//                        $row['edit'] = '<a href="' . base_url('/userprofile/viewUserprofile/' . $row['admin_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deleteuserprofile" data-id="' . $row['admin_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
//                        $data[] = $row;
//                    }
//                } else if (!empty($_POST['alphabet']) && $_POST['alphabet'] != 'all') {
//                    //$where='';  
//
//                    $where[] = "admin_firstname like '" . $_POST['alphabet'] . "%'";
//                    $where = "WHERE " . implode(" OR ", $where); // id like '%searchValue%' or name like '%searchValue%' ....
//                    //$sql = sprintf("SELECT *,CONCAT_WS('', 'en_fname', 'en_lname', NULL) = 'en_fname' FROM %s %s", enquiry , $where);//Search query without limit clause (No pagination)		
//                    $sql = sprintf("SELECT *,admin_firstname FROM " . admin . " %s where is_deleted = 0", $where); //Search query without limit clause (No pagination)		
//                    $query = $this->db->query($sql);
//                    $recordsFiltered = $query->num_rows(); //count(getData($sql));//Count of search result
//
//                    /* SQL Query for search with limit and orderBy clauses */
//                    $sql = sprintf("SELECT *,admin_firstname FROM " . admin . " %s where is_deleted = 0 ORDER BY %s %s limit %d , %d ", $where, $orderBy, $orderType, $start, $length);
//                    $query = $this->db->query($sql);
//                    $query = $query->result_array();
//
//                    $data = array();
//                    foreach ($query as $row) {
//                        $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['admin_id'] . '">';
//                        $row['admin_firstname'] = '<a href="' . base_url('/userprofile/view/' . $row['admin_id']) . '">' . $row['admin_firstname'] . '</a>';
//                        $row['edit'] = '<a href="' . base_url('/userprofile/viewUserprofile/' . $row['admin_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deleteuserprofile" data-id="' . $row['admin_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
//                        $data[] = $row;
//                    }
//                }
//                /* END SEARCH */ else {
//
//                    if ($draw == 1) {
//                        $orderBy = "admin_id";
//                        $orderType = "desc";
//                    }
//
//                    $sql = sprintf("SELECT *,admin_firstname FROM " . admin . " %s where is_deleted = 0 ORDER BY %s %s limit %d , %d ", $where, $orderBy, $orderType, $start, $length);
//                    $query = $this->db->query($sql);
//                    $query = $query->result_array();
//
//                    $data = array();
//                    foreach ($query as $row) {
//                        $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['admin_id'] . '">';
//                        $row['admin_firstname'] = '<a href="' . base_url('/userprofile/view/' . $row['admin_id']) . '">' . $row['admin_firstname'] . '</a>';
//                        $row['edit'] = '<a href="' . base_url('/userprofile/viewUserprofile/' . $row['admin_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deleteuserprofile" data-id="' . $row['admin_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
//                        $data[] = $row;
//                    }
//                    $recordsFiltered = $recordsTotal;
//                }
//                /* echo "<pre>";
//                  print_r($_POST);
//                  echo $sql;
//                  die; */
//                /* Response to client before JSON encoding */
//                $response = array(
//                    "draw" => intval($draw),
//                    "recordsTotal" => $recordsTotal,
//                    "recordsFiltered" => $recordsFiltered,
//                    "data" => $data
//                );
//
//                echo json_encode($response);
//            } else {
//                echo "NO POST Query from DataTable";
//            }
//        }
//    }


    public function getAjaxData() {
        /* IF Query comes from DataTables do the following */
        if (!empty($_POST)) {
            /* echo "<pre>";
              print_r($_POST); */
            define("admin", "admin");
            /* Useful $_POST Variables coming from the plugin */
            $draw = $_POST["draw"]; //counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables

            $orderByColumnIndex = $_POST['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)
//            echo $orderByColumnIndex;
//            die;
            $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Get name of the sorting column from its index			
            /* if($orderBy == 'edit_link')
              {
              $orderBy = 'contact_id';
              } */
            if ($orderBy == 'checkbox_val') {
                $orderBy = 'admin_id';
            }
            $orderType = $_POST['order'][0]['dir']; // ASC or DESC
            $start = $_POST["start"]; //Paging first record indicator.
            $length = $_POST['length']; //Number of records that the table can display in the current draw
            /* END of POST variables */
// echo $length;
// die;
            $sql = "SELECT * FROM " . admin . " where is_deleted = 0";
            $query = $this->db->query($sql);
            $recordsTotal = $query->num_rows();

            /* SEARCH CASE : Using Alphabest Wise */

            /* */
            /* SEARCH CASE : Filtered data */
            if (!empty($_POST['search']['value'])) {



                if (!empty($_POST['alphabet']) && $_POST['alphabet'] != 'all') {

                    /* WHERE Clause for searching */
                    for ($i = 0; $i < count($_POST['columns']); $i++) {

                        /* if($_POST['columns'][$i]['data'] !="edit_link")
                          { */
                        $column = $_POST['columns'][$i]['data']; //we get the name of each column using its index from POST request			
                        $where[] = "$column like '%" . $_POST['search']['value'] . "%'";
                        /* } */
                    }
                    $where = "WHERE ( " . implode(" OR ", $where) . " )"; // id like '%searchValue%' or name like '%searchValue%' ....
                    /* End WHERE */
                    $where .= " AND ( admin_firstname like '" . $_POST['alphabet'] . "%' )";
                    /* End WHERE */
                } else {
                    /* WHERE Clause for searching */
                    for ($i = 0; $i < count($_POST['columns']); $i++) {

                        /* if($_POST['columns'][$i]['data'] !="edit_link")
                          { */
                        $column = $_POST['columns'][$i]['data']; //we get the name of each column using its index from POST request			
                        $where[] = "$column like '%" . $_POST['search']['value'] . "%'";
                        /* } */
                    }
                    $where = "WHERE " . implode(" OR ", $where); // id like '%searchValue%' or name like '%searchValue%' ....
                    /* End WHERE */
                }


                //echo $where;die;
                $sql = sprintf("SELECT *,admin_firstname FROM " . admin . " %s where is_deleted = 0", $where); //Search query without limit clause (No pagination)		
                $query = $this->db->query($sql);
                $recordsFiltered = $query->num_rows(); //count(getData($sql));//Count of search result

                /* SQL Query for search with limit and orderBy clauses */
                $sql = sprintf("SELECT *,admin_firstname FROM " . admin . " %s where is_deleted = 0 ORDER BY %s %s limit %d , %d ", $where, $orderBy, $orderType, $start, $length);
                $query = $this->db->query($sql);
                $query = $query->result_array();

                $data = array();
                foreach ($query as $row) {
                    $row['admin_firstname'] = '<a href="/contactdetails/' . $row['admin_id'] . '">' . $row['admin_firstname'] . '</a>';
                    $data[] = $row;
                }
            } else if (!empty($_POST['alphabet']) && $_POST['alphabet'] != 'all') {
                $where[] = "admin_firstname like '" . $_POST['alphabet'] . "%'";
                $where = "WHERE " . implode(" OR ", $where); // id like '%searchValue%' or name like '%searchValue%' ....
                //$sql = sprintf("SELECT *,CONCAT_WS('', 'contact_fname', 'en_lname', NULL) = 'contact_fname' FROM %s %s", enquiry , $where);//Search query without limit clause (No pagination)		
                $sql = sprintf("SELECT *,admin_firstname FROM " . admin . " %s", $where); //Search query without limit clause (No pagination)		
                $query = $this->db->query($sql);
                $recordsFiltered = $query->num_rows(); //count(getData($sql));//Count of search result

                /* SQL Query for search with limit and orderBy clauses */
                $sql = sprintf("SELECT *,admin_firstname FROM " . admin . " %s ORDER BY %s %s limit %d , %d ", $where, $orderBy, $orderType, $start, $length);
                $query = $this->db->query($sql);
                $query = $query->result_array();

                $data = array();
                foreach ($query as $row) {
                    $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['admin_id'] . '">';
                    $row['admin_firstname'] = '<a class="userlink" href="' . base_url('/userprofile/viewUserprofile/' . $row['admin_id']) . '">' . $row['admin_firstname'] . '</a>';
                  //  $row['edit'] = '<a href="' . base_url('/userprofile/viewUserprofile/' . $row['admin_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deleteuserprofile" data-id="' . $row['admin_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
                    $data[] = $row;
                }
            }
            /* END SEARCH */ else {
                $sql = sprintf("SELECT *,admin_firstname FROM " . admin . " where is_deleted = 0 ORDER BY %s %s limit %d , %d ", $orderBy, $orderType, $start, $length);
                $query = $this->db->query($sql);
                $query = $query->result_array();

                $data = array();
                foreach ($query as $row) {
                    $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['admin_id'] . '">';
                    $row['admin_firstname'] = '<a class="userlink" href="' . base_url('/userprofile/viewUserprofile/' . $row['admin_id']) . '">' . $row['admin_firstname'] . '</a>';
                  //  $row['edit'] = '<a href="' . base_url('/userprofile/viewUserprofile/' . $row['admin_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deleteuserprofile" data-id="' . $row['admin_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
                    $data[] = $row;
//                    print_r($data);
//                    die;
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
    
    /*ADD Bank Detal setting for PDF...........@DRCZ*/
    public function bankDetailData($data) {
        return $this->db->insert('bankdetail_setting', $data);
    }
    public function updateBankDetailData($data) {
        $this->db->where('bankdetail_setting_id', 1);
        return $this->db->update('bankdetail_setting', $data);
    }
   public function getBankDataByID() { 
        $this->db->select("*");
        $this->db->where('bankdetail_setting_id', 1);
        $this->db->from("bankdetail_setting");
        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }
    /*ADD Bank Detal setting for PDF...........@DRCZ*/

}
