<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry_model extends CI_Model {

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
     * To getcontactname from contact tbl...................
     * @param type $q
     * @return type 
     */
    public function getContactName($q, $enqstate) {
        $this->db->select('*');
        $this->db->like('contact_fname', $q);
        $this->db->like('contact_state', $enqstate);
        $this->db->where('contact_reltype', 1);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('contact');
        $y = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set['items'][$y]['name'] = htmlentities(stripslashes($row['contact_fname'])) . " " . htmlentities(stripslashes($row['contact_lname']));
                $row_set['items'][$y]['id'] = htmlentities(stripslashes($row['contact_id'])); //build an array
                $y++;
            }
            return json_encode($row_set); //format the array into json data
        } else {
            return json_encode(array("items" => ""));
        }
    }

    public function getPackerName($q, $enqstate = "") {
        $this->db->select('*');
        $this->db->like('contact_fname', $q);
        $this->db->like('contact_state', $enqstate);
        $this->db->where('contact_reltype', 2);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('contact');
        // echo $this->db->last_query();die;
        $y = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set['items'][$y]['name'] = htmlentities(stripslashes($row['contact_fname'])) . " " . htmlentities(stripslashes($row['contact_lname']));
                $row_set['items'][$y]['id'] = htmlentities(stripslashes($row['contact_id'])); //build an array
                $y++;
            }
            return json_encode($row_set); //format the array into json data
        } else {
            return json_encode(array("items" => ""));
        }
    }

    public function getRemovalistName($en_unique_id) {

        $this->db->select('contact.contact_id,contact.contact_fname,contact.contact_lname,contact.contact_state')->from('contact')
                ->join('enquiry', 'enquiry.contact_id = contact.contact_id')
                ->where('contact.contact_reltype', 1)
                ->where('enquiry.en_unique_id', $en_unique_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
            //            foreach ($query->result_array() as $row) {
            //                $contactfname = htmlentities(stripslashes($row['contact_fname'])) . " " . htmlentities(stripslashes($row['contact_state']));
            //                $contactid = htmlentities(stripslashes($row['contact_id']));
            //                $row_set[] = $contactfname;
            //            }
            //            return json_encode($row_set); //format the array into json data
        } else {
            return false;
        }
    }

// public function getPackerName($en_unique_id) {
//
//        $this->db->select('contact.contact_id,contact.contact_fname')->from('contact')
//                ->join('enquiry', 'enquiry.contact_id = contact.contact_id')
//                ->where('enquiry.en_unique_id', $en_unique_id);
//        $query = $this->db->get();
//
//        if ($query->num_rows() > 0) {
//            foreach ($query->result_array() as $row) {
//                $contactfname = htmlentities(stripslashes($row['contact_fname']));
//                $contactid = htmlentities(stripslashes($row['contact_id']));
//                $row_set[] = $contactfname;
//            }
//            return json_encode($row_set); //format the array into json data
//        }
//    }
    /**
     * Get suburb data from suburb tbl................
     */
    public function getSuburb($q) {
        $this->db->select('*');
        $this->db->where('Enabled !=', 0);
        $this->db->group_start();
        $this->db->like('Locality', $q);
        $this->db->or_like('Pcode', $q);
        $this->db->or_like('State', $q);
        $this->db->group_end();
        $this->db->limit(10, 0);
        $query = $this->db->get('suburb');
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $Locality = htmlentities(stripslashes(ucwords(strtolower($row['Locality']))));
                $State = htmlentities(stripslashes($row['State']));
                $Pcode = htmlentities(stripslashes($row['Pcode']));
                $row_set[] = $Locality . " , " . $Pcode . " , " . $State;
            }
            return json_encode($row_set); //format the array into json data
        }
    }

    /**
     * Add enquiry data............................
     * @param type $data
     * @return boolean
     */
    public function addEnquirydata($data) {
        $this->db->set('en_unique_id', 'UUID()', FALSE);
        $this->db->set('en_date', 'now()', FALSE);
        $count = $this->db->insert('enquiry', $data);
        $lastID = $this->db->insert_id();
        if ($lastID > 0) {
            $this->db->select("en_unique_id");
            $fetchUUID = $this->db->get_where("enquiry", array("enquiry_id" => $lastID));
            $rowFetchUUID = $fetchUUID->result_array();
            // packing hours

        $packerNameArr=$this->input->post('packer-name');
        $packerHoursArr=$this->input->post('packer-hours');
        $packerDataFromEnquiry=$this->getPackerIdFromEnquiry($lastID);
        $packerDataFromEnquiry=array_column($packerDataFromEnquiry, 'packer_id');

        //non-billable
        $nonBillablePackerNameArr=$this->input->post('non-billable-packer-name');
        $nonBillablePackerHoursArr=$this->input->post('non-billable-packer-hours');
        $nonBillablePackerDataFromEnquiry=$this->getPackerIdFromEnquiry($lastID);
        $nonBillablePackerDataFromEnquiry=array_column($packerDataFromEnquiry, 'packer_id');

        $nonBillableCombinedArr = array_combine($nonBillablePackerNameArr,$nonBillablePackerHoursArr);

        if(count($packerNameArr) != count($packerDataFromEnquiry)){
            $diff=array_diff($packerDataFromEnquiry,$packerNameArr);
            foreach ($diff as $toBeDeleted) {
                // echo $toBeDeleted;
                $this->db->where('packer_id',$toBeDeleted)
                    ->where('packer_enquiry_id',$lastID)
                    ->delete('packer_hours');
            }
        }
       
        if(count($packerNameArr)>0){
            $combinedArr=array_combine ( $packerNameArr , $packerHoursArr );
            foreach ($combinedArr as $key=> $value) {
                $packerData=array(
                    'packer_id'=>$key,
                    'packer_enquiry_id'=>$lastID,
                    'packer_total_hours'=>$value,
                    'packer_nonbillable_total_hours' => $nonBillableCombinedArr[$key]
                );
                $ifExists=$this->checkPackerEnquiryExists($packerData);
                if(count($ifExists)==0){
                    $this->db->insert('packer_hours',$packerData);   
                }
                else{
                    $this->db->where('packer_hour_id',$ifExists[0]['packer_hour_id'])
                        ->update('packer_hours',$packerData);   
                }
            }
        }

        // packing hours
            return $rowFetchUUID[0]['en_unique_id'];
        } else {
            return false;
        }
    }

    public function checkPackerEnquiryExists($packerData){
        $packData=$packerData;
        unset($packData['packer_total_hours'],$packData['packer_nonbillable_total_hours']);
        return $res=$this->db->select('packer_hour_id,packer_id,packer_enquiry_id,packer_total_hours')
        ->where($packData)
        ->get('packer_hours')->result_array();
    }

    public function getPackerIdFromEnquiry($enquiryId){
        return $res = $this->db->select('packer_id')
            ->where('packer_enquiry_id',$enquiryId)
            ->get('packer_hours')->result_array();
    }

    public function getpackerNameListWithValues($enquiryId){
        return $res=$this->db->select('p.packer_id,p.packer_total_hours,p.packer_nonbillable_total_hours,c.contact_fname,c.contact_lname')
        ->from('packer_hours p')
        ->join('contact c', 'p.packer_id = c.contact_id', 'left')
        ->where('packer_enquiry_id',$enquiryId)
        ->get()->result_array();
    }

    //Add enquiry data web..............

    public function addEnquirydataWeb($data) {
        // $this->db->set('en_unique_id', 'UUID()', FALSE);
        $this->db->set('en_date', 'now()', FALSE);
        $count = $this->db->insert('enquiry', $data);
        $lastID = $this->db->insert_id();
        if ($lastID > 0) {
            $this->db->select("en_unique_id");
            $fetchUUID = $this->db->get_where("enquiry", array("enquiry_id" => $lastID));
            $rowFetchUUID = $fetchUUID->result_array();
            return $rowFetchUUID[0]['en_unique_id'];
        } else {
            return false;
        }
    }

    public function export_enquirydata() {

        $this->db->select('*,move_type.movetype_name')->from('enquiry')
                ->join('move_type', 'enquiry.en_movetype = move_type.movetype_id')
                ->join('admin', 'admin.admin_id = enquiry.created_by')
                ->where('enquiry.is_deleted', 0)
                ->order_by('enquiry.enquiry_id', 'DESC');
        $query = $this->db->get();

//        $this->db->order_by("enquiry_id", "DESC");
//        $query = $this->db->get("enquiry");
        //  echo $this->db->last_query();
        return $query->result();
    }

    public function Add_ImportedEnqData($data_enq) {

        $ms_unique_id = $data_enq['ms_uuid'];

        $this->db->select('ms_uuid,en_unique_id')->from('enquiry')
                ->where('ms_uuid =', $ms_unique_id);
        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        if ($query->num_rows() == 0) {

            $this->db->set('en_unique_id', 'UUID()', FALSE);
            $count = $this->db->insert('enquiry', $data_enq);
            $lastID = $this->db->insert_id();
            if ($lastID > 0) {
                $this->db->select("en_unique_id");
                $fetchUUID = $this->db->get_where("enquiry", array("enquiry_id" => $lastID));
                $rowFetchUUID = $fetchUUID->result_array();
                return $rowFetchUUID[0]['en_unique_id'];
            } else {
                return false;
            }
        } else {

            $this->db->where('ms_uuid', $unique_id);
            return $this->db->update('enquiry', $data_enq);
        }
    }

    /* public function Add_ImportedEnqData($data_enq) {

      $enqUniqueId = $data_enq['en_unique_id'];
      $enqDate = $data_enq['en_date'];
      $serviceDate = $data_enq['en_servicedate'];
      $fname = $data_enq['en_fname'];
      $lname = $data_enq['en_lname'];
      $phone = $data_enq['en_phone'];
      $state = $data_enq['en_movingfrom_state'];
      $movetype = $data_enq['movetype_name'];
      $adminname = $data_enq['admin_firstname'];

      $this->db->select('*,move_type.movetype_name,move_type.movetype_id')->from('enquiry')
      ->join('move_type', 'enquiry.en_movetype = move_type.movetype_id')
      ->join('admin', 'admin.admin_id = enquiry.created_by')
      ->where('enquiry.is_deleted', 0)
      ->where('enquiry.en_unique_id', $enqUniqueId)
      ->order_by('enquiry.enquiry_id', 'DESC');
      $query = $this->db->get();
      //        echo $this->db->last_query();
      //        die;

      if ($movetype == 'Home') {
      $movetypeId = 1;
      } elseif ($movetype == 'Office') {
      $movetypeId = 2;
      } elseif ($movetype == 'Interstate') {
      $movetypeId = 3;
      } elseif ($movetype == 'Packing') {
      $movetypeId = 4;
      } elseif ($movetype == 'Unpacking') {
      $movetypeId = 5;
      } elseif ($movetype == 'Storage') {
      $movetypeId = 6;
      }

      $data = array(
      'en_unique_id' => $enqUniqueId,
      'en_date' => $enqDate,
      'en_servicedate' => $serviceDate,
      'en_fname' => $fname,
      'en_lname' => $lname,
      'en_phone' => $phone,
      'en_movingfrom_state' => $state,
      'en_movetype' => $movetypeId,
      'created_by' => $this->session->userdata('admin_id'),
      );
      //        print_r($data);
      //        die;
      if ($query->num_rows() > 0) {
      $this->db->where('en_unique_id', $enqUniqueId);
      return $this->db->update('enquiry', $data);
      //           echo $this->db->last_query();
      //           die;
      } else {
      return $this->db->insert('enquiry', $data);
      }
      } */

    public function addNotes($notesdata, $enquiryId) {
        $this->db->set("created_by_name", $this->session->userdata('admin_firstname'));
        $this->db->set("created_by", $this->session->userdata('admin_id'));
        $this->db->set('notes_date', 'now()', FALSE);
        $this->db->set('enquiry_id', $enquiryId);
        return $this->db->insert('notes', $notesdata);
    }

    /**
     * @author Darshak Shah <darshak.shah@drcinfotech.com>
     * @param string $uuid uuid for fetching a data from enquiry table
     */
    function getEnquiryIDFromUUID($uuid) {
        $this->db->select("enquiry_id");
        $reID = $this->db->get_where("enquiry", array("en_unique_id" => $uuid));
        $rowID = $reID->result_array();
        return $rowID[0]['enquiry_id'];
    }

    function getEnquiryUUIDFromID($enquiryid) {
        $this->db->select("en_unique_id");
        $reID = $this->db->get_where("enquiry", array("enquiry_id" => $enquiryid));
        $rowID = $reID->result_array();
        return $rowID[0]['en_unique_id'];
    }

    function getEnquiryDataByUUID($en_unique_id) {
        $this->db->select("*");
        $this->db->where('en_unique_id', $en_unique_id);
        $this->db->or_where('ms_uuid', $en_unique_id);
        $this->db->from("enquiry");
        $query = $this->db->get();
        //  echo $this->db->last_query();

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    function getAdminuserById($enquiryId) {
        $this->db->select('enquiry.enquiry_id,admin.admin_id,admin.username')->from('enquiry')
                ->join('admin', 'admin.admin_id=enquiry.created_by')
                ->where('enquiry.enquiry_id', $enquiryId);
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

    function getNotesById($enquiryId) {
        $this->db->select('enquiry.enquiry_id,notes.notes_id,notes.enquiry_id,notes.notes_title,notes.notes_description,notes.notes_attachedfile,notes.notes_date,group_concat(notes_id separator "##") as nid,group_concat(notes_title separator "##") as nt, group_concat(notes_description separator "##") as nd, group_concat(notes_date separator "##") as ndate, group_concat(notes_attachedfile separator "##") as nattach,group_concat(created_by_name separator "##") as uName')->from('enquiry')
                ->join('notes', 'enquiry.enquiry_id = notes.enquiry_id', 'left')
//                ->join('admin', 'enquiry.created_by = admin.admin_id', 'left')
                ->where('enquiry.enquiry_id', $enquiryId)
                ->where('notes.is_deleted', 0)
                ->group_by('enquiry.enquiry_id');

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

    function getNotesFile($notes_id) {
        $this->db->select("*");
        $this->db->where('notes_id', $notes_id);

        $this->db->from("notes");
        $query = $this->db->get();
//echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getEmailLogById($enquiryId) {
        $this->db->select('email_log_id,email_log.email_master_id,email_log.email_log_to,email_log.email_log_subject,email_log.email_log_editor,email_log.email_log_date,email_log.email_log_date,admin.admin_firstname,email_log.email_sent_by ')->from('email_log')
                ->join('admin', 'admin.admin_id = email_log.email_sent_by', 'left')
                ->where('email_log.enquiry_id', $enquiryId)
                ->order_by('email_log.email_log_id', 'desc');

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

    function getEmailLogByLogId($enquiryId, $emailLogID) {
        $this->db->select('email_log_id,email_log.email_master_id,email_log.email_log_to,email_log.email_log_subject,email_log.email_log_editor,email_log.email_log_date,email_log.email_log_date,admin.admin_firstname ')->from('email_log')
                ->join('admin', 'admin.admin_id = email_log.email_sent_by', 'left')
                ->where('email_log.enquiry_id', $enquiryId)
                ->where('email_log.email_log_id', $emailLogID)
                ->order_by('email_log.email_log_id', 'desc');

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

    /**
     * Not usable.....................
     * @param type $enquiryId
     * @return boolean
     * 
     */
    function getPackersData($enquiryId) {
        $this->db->select('email_log.email_log_subject,email_log.email_log_editor,email_log.email_log_date,admin.username ')->from('email_log')
                ->join('admin', 'admin.admin_id = email_log.email_sent_by', 'left')
                ->where('email_log.enquiry_id', $enquiryId)
                ->order_by('email_log.email_log_id', 'desc');


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

    /**
     * Get enquiry data for gridview......@DRCZ
     */
    function getEnquiryData() {
        $length = $_POST['length'];
        $start = $_POST['start'];
        $draw = $_POST['Draw'];
        $resultCount = $this->db->query("Select * From enquiry limit 0,5");
        $results['recordsTotal'] = count($resultCount->result_array());
        $results['recordsFiltered'] = count($resultCount->result_array());
        $results['draw'] = 1;
        $results['data'] = "";

        if ($resultCount > 0) {
            $query = $this->db->query("Select * From enquiry");
            // echo $this->db->last_query();
            $json_array = array();
            $i = $start + 1;
            $y = 0;
            foreach ($query->result_array() as $result_value) {
                $results['data'][$y]['en_movetype'] = $result_value['en_movetype'];
                $results['data'][$y]['en_home_office'] = $result_value['en_home_office'];
                $results['data'][$y]['en_servicedate'] = $result_value['en_servicedate'];
                $results['data'][$y]['en_servicetime'] = $result_value['en_servicetime'];
                $results['data'][$y]['en_fname'] = $result_value['en_fname'];
                $results['data'][$y]['en_lname'] = $result_value['en_lname'];
                $results['data'][$y]['en_phone'] = $result_value['en_phone'];
                $y++;
            }
        }
//        $results['data']=$json_array;
        return json_encode($results);
    }

    /**
     * @author Darshak Shah <darshak.shah@drcinfotech.com>
     * @uses Get Move Type
     * @return type
     */
    function getMoveType() {
        $this->db->select("*")->from("move_type")
                ->where("is_disabled", 0);
        $re_moveType = $this->db->get();
//        echo $this->db->last_query();
//        die;
        return $re_moveType->result_array();
    }

    function getCustomerId($contactuuid, $enqId) {
        $this->db->set('customer_id', $contactuuid);
        $this->db->where('enquiry_id', $enqId);
        return $this->db->update('enquiry');
        //  echo $this->db->last_query();
    }

    /**
     * 
     * @param type $enquiryID
     */
    function getEnquiryDataByEnquiryID($enquiryID) {
        $getMoveTypeID = $this->db->get_where("enquiry", array("enquiry_id" => $enquiryID, "is_qualified" => 0));
        if ($getMoveTypeID->num_rows() > 0) {
            return $getMoveTypeID->result_array();
        } else {
            return false;
        }
    }

    function getEnquiryPartialDataByEnquiryId($enquiryID){
        return $result = $this->db->select('enquiry_id,en_unique_id,en_movetype,en_movingfrom_state,en_servicedate,en_fname,en_lname,en_phone,en_email')
                  ->where(array("enquiry_id" => $enquiryID))
                  ->get('enquiry')->result_array();
    }
    

//From enquirylist.......................
    function getDuplicateEnqueryListData($en_unique_ids) {
        $enq_id = $en_unique_ids[0];
        $this->db->select("*")->from('enquiry')
                ->where('en_unique_id', $enq_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            $data = array(
                'booking_status' => $row[0]['booking_status'],
                'en_movetype' => $row[0]['en_movetype'],
                'en_servicedate' => $row[0]['en_servicedate'],
                'en_servicetime' => $row[0]['en_servicetime'],
                'en_deliverydate' => $row[0]['en_deliverydate'],
                'en_deliverytime' => $row[0]['en_deliverytime'],
                'en_storagedate' => $row[0]['en_storagedate'],
                'en_fname' => $row[0]['en_fname'],
                'en_lname' => $row[0]['en_lname'],
                'en_phone' => $row[0]['en_phone'],
                'en_email' => $row[0]['en_email'],
                //   'contact_id' => $row[0]['contact_id'],// Not copy when duplicate enquiry
                'customer_id' => $row[0]['customer_id'],
                'en_storage_provider' => $row[0]['en_storage_provider'],
                'en_storage_address' => $row[0]['en_storage_address'],
                'en_storage_phno' => $row[0]['en_storage_phno'],
                'en_packer_selection' => $row[0]['en_packer_selection'],
                'en_note' => $row[0]['en_note'],
                'en_movingfrom_street' => $row[0]['en_movingfrom_street'],
                'en_movingfrom_postcode' => $row[0]['en_movingfrom_postcode'],
                'en_movingfrom_suburb' => $row[0]['en_movingfrom_suburb'],
                'en_movingfrom_state' => $row[0]['en_movingfrom_state'],
                'en_movingto_street' => $row[0]['en_movingto_street'],
                'en_movingto_postcode' => $row[0]['en_movingto_postcode'],
                'en_movingto_suburb' => $row[0]['en_movingto_suburb'],
                'en_movingto_state' => $row[0]['en_movingto_state'],
                'en_addpickup_street' => $row[0]['en_addpickup_street'],
                'en_addpickup_postcode' => $row[0]['en_addpickup_postcode'],
                'en_addpickup_suburb' => $row[0]['en_addpickup_suburb'],
                'en_addpickup_state' => $row[0]['en_addpickup_state'],
                'en_adddelivery_street' => $row[0]['en_adddelivery_street'],
                'en_adddelivery_postcode' => $row[0]['en_adddelivery_postcode'],
                'en_adddelivery_suburb' => $row[0]['en_adddelivery_suburb'],
                'en_adddelivery_state' => $row[0]['en_adddelivery_state'],
                'en_confirmation' => $row[0]['en_confirmation'],
                'en_deposit_amt' => $row[0]['en_deposit_amt'],
                'en_initial_hours_booked' => $row[0]['en_initial_hours_booked'],
                'en_ladies_booked' => $row[0]['en_ladies_booked'],
                'en_initial_sellprice' => $row[0]['en_initial_sellprice'],
                'en_no_of_movers' => $row[0]['en_no_of_movers'],
                'en_no_of_trucks' => $row[0]['en_no_of_trucks'],
                'en_travelfee' => $row[0]['en_travelfee'],
                'en_travelfee_cost' => $row[0]['en_travelfee_cost'],
                'en_client_hourly_rate' => $row[0]['en_client_hourly_rate'],
                'en_additional_charges' => $row[0]['en_additional_charges'],
                'en_additional_item' => $row[0]['en_additional_item'],
                'en_additional_charges_cost' => $row[0]['en_additional_charges_cost'],
                'en_total_sellprice' => $row[0]['en_total_sellprice'],
                'en_total_costprice' => $row[0]['en_total_costprice'],
                'en_cubic_meters_booked' => $row[0]['en_cubic_meters_booked'],
                'en_noof_modules_required' => $row[0]['en_noof_modules_required'],
                'en_cubic_meters_bystorage' => $row[0]['en_cubic_meters_bystorage'],
                'en_quotedsell_price' => $row[0]['en_quotedsell_price'],
                'en_quotedcost_price' => $row[0]['en_quotedcost_price'],
                'en_hireamover_margin' => $row[0]['en_hireamover_margin'],
                'en_amountDueNow' => $row[0]['en_amountDueNow'],
                'client_feedback' => $row[0]['client_feedback'],
                'en_referral_source' => $row[0]['en_referral_source'],
                'en_promotional_code' => $row[0]['en_promotional_code'],
                'created_by' => $row[0]['created_by'],
            );

            $this->db->set('en_unique_id', 'UUID()', FALSE);
            $this->db->set('en_date', 'now()', FALSE);
            $this->db->set('qualified_date', 'now()', FALSE);
            $this->db->insert('enquiry', $data);
            $lastID = $this->db->insert_id();

            if ($lastID > 0) {
                $this->db->select("en_unique_id");
                $fetchUUID = $this->db->get_where("enquiry", array("enquiry_id" => $lastID));
                $rowFetchUUID = $fetchUUID->result_array();
                return $rowFetchUUID[0]['en_unique_id'];
                //return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getDuplicateEnqueryData($en_unique_ids) {

        $this->db->select("*")->from('enquiry')
                ->where('en_unique_id', $en_unique_ids);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            $data = array(
                //'booking_status' => $row[0]['booking_status'],
                'en_movetype' => $row[0]['en_movetype'],
                'en_servicedate' => $row[0]['en_servicedate'],
                'en_servicetime' => $row[0]['en_servicetime'],
                'en_deliverydate' => $row[0]['en_deliverydate'],
                'en_deliverytime' => $row[0]['en_deliverytime'],
                'en_storagedate' => $row[0]['en_storagedate'],
                'en_fname' => $row[0]['en_fname'],
                'en_lname' => $row[0]['en_lname'],
                'en_phone' => $row[0]['en_phone'],
                'en_email' => $row[0]['en_email'],
                //   'contact_id' => $row[0]['contact_id'],// Not copy when duplicate enquiry
                'customer_id' => $row[0]['customer_id'],
                'en_storage_provider' => $row[0]['en_storage_provider'],
                'en_storage_address' => $row[0]['en_storage_address'],
                'en_storage_phno' => $row[0]['en_storage_phno'],
                'en_packer_selection' => $row[0]['en_packer_selection'],
                'en_note' => $row[0]['en_note'],
                'en_movingfrom_street' => $row[0]['en_movingfrom_street'],
                'en_movingfrom_postcode' => $row[0]['en_movingfrom_postcode'],
                'en_movingfrom_suburb' => $row[0]['en_movingfrom_suburb'],
                'en_movingfrom_state' => $row[0]['en_movingfrom_state'],
                'en_movingto_street' => $row[0]['en_movingto_street'],
                'en_movingto_postcode' => $row[0]['en_movingto_postcode'],
                'en_movingto_suburb' => $row[0]['en_movingto_suburb'],
                'en_movingto_state' => $row[0]['en_movingto_state'],
                'en_addpickup_street' => $row[0]['en_addpickup_street'],
                'en_addpickup_postcode' => $row[0]['en_addpickup_postcode'],
                'en_addpickup_suburb' => $row[0]['en_addpickup_suburb'],
                'en_addpickup_state' => $row[0]['en_addpickup_state'],
                'en_adddelivery_street' => $row[0]['en_adddelivery_street'],
                'en_adddelivery_postcode' => $row[0]['en_adddelivery_postcode'],
                'en_adddelivery_suburb' => $row[0]['en_adddelivery_suburb'],
                'en_adddelivery_state' => $row[0]['en_adddelivery_state'],
                'en_confirmation' => $row[0]['en_confirmation'],
                'en_deposit_amt' => $row[0]['en_deposit_amt'],
                'en_initial_hours_booked' => $row[0]['en_initial_hours_booked'],
                'en_ladies_booked' => $row[0]['en_ladies_booked'],
                'en_initial_sellprice' => $row[0]['en_initial_sellprice'],
                'en_no_of_movers' => $row[0]['en_no_of_movers'],
                'en_no_of_trucks' => $row[0]['en_no_of_trucks'],
                'en_travelfee' => $row[0]['en_travelfee'],
                'en_travelfee_cost' => $row[0]['en_travelfee_cost'],
                'en_client_hourly_rate' => $row[0]['en_client_hourly_rate'],
                'en_additional_charges' => $row[0]['en_additional_charges'],
                'en_additional_item' => $row[0]['en_additional_item'],
                'en_additional_charges_cost' => $row[0]['en_additional_charges_cost'],
                'en_total_sellprice' => $row[0]['en_total_sellprice'],
                'en_total_costprice' => $row[0]['en_total_costprice'],
                'en_cubic_meters_booked' => $row[0]['en_cubic_meters_booked'],
                'en_noof_modules_required' => $row[0]['en_noof_modules_required'],
                'en_cubic_meters_bystorage' => $row[0]['en_cubic_meters_bystorage'],
                'en_quotedsell_price' => $row[0]['en_quotedsell_price'],
                'en_quotedcost_price' => $row[0]['en_quotedcost_price'],
                'en_hireamover_margin' => $row[0]['en_hireamover_margin'],
                'en_amountDueNow' => $row[0]['en_amountDueNow'],
                'client_feedback' => $row[0]['client_feedback'],
                'en_referral_source' => $row[0]['en_referral_source'],
                'en_promotional_code' => $row[0]['en_promotional_code'],
                'created_by' => $row[0]['created_by'],
            );

            $this->db->set('en_unique_id', 'UUID()', FALSE);
            $this->db->set('en_date', 'now()', FALSE);
            $this->db->set('qualified_date', 'now()', FALSE);
            $this->db->insert('enquiry', $data);
            $lastID = $this->db->insert_id();

            if ($lastID > 0) {
                $this->db->select("en_unique_id");
                $fetchUUID = $this->db->get_where("enquiry", array("enquiry_id" => $lastID));
                $rowFetchUUID = $fetchUUID->result_array();
                return $rowFetchUUID[0]['en_unique_id'];
                //return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Edit enquiry data.........@DRCZ
     */
    function editEnquiryById($enquiryId, $data) {

        $packerNameArr=$this->input->post('packer-name');
        $packerHoursArr=$this->input->post('packer-hours');
        $packerDataFromEnquiry=$this->getPackerIdFromEnquiry($enquiryId);
        $packerDataFromEnquiry=array_column($packerDataFromEnquiry, 'packer_id');

        //non-billable
        $nonBillablePackerNameArr=$this->input->post('non-billable-packer-name');
        $nonBillablePackerHoursArr=$this->input->post('non-billable-packer-hours');
        $nonBillablePackerDataFromEnquiry=$this->getPackerIdFromEnquiry($lastID);
        $nonBillablePackerDataFromEnquiry=array_column($packerDataFromEnquiry, 'packer_id');
        $nonBillableCombinedArr = array_combine($nonBillablePackerNameArr,$nonBillablePackerHoursArr);

        if(count($packerNameArr) != count($packerDataFromEnquiry)){
            $diff=array_diff($packerDataFromEnquiry,$packerNameArr);
            foreach ($diff as $toBeDeleted) {
                // echo $toBeDeleted;
                $this->db->where('packer_id',$toBeDeleted)
                    ->where('packer_enquiry_id',$enquiryId)
                    ->delete('packer_hours');
            }
        }
       
        if(count($packerNameArr)>0){
            $combinedArr=array_combine ( $packerNameArr , $packerHoursArr );
            foreach ($combinedArr as $key=> $value) {
                $packerData=array(
                    'packer_id'=>$key,
                    'packer_enquiry_id'=>$enquiryId,
                    'packer_total_hours'=>$value,
                    'packer_nonbillable_total_hours' => $nonBillableCombinedArr[$key]
                );
                $ifExists=$this->checkPackerEnquiryExists($packerData);
                if(count($ifExists)==0){
                    $this->db->insert('packer_hours',$packerData);   
                }
                else{
                    $this->db->where('packer_hour_id',$ifExists[0]['packer_hour_id'])
                        ->update('packer_hours',$packerData);   
                }
            }
        }      
        else{
            $this->db->where('packer_enquiry_id',$enquiryId)
                ->delete('packer_hours');
        }
        $this->db->where('enquiry_id', $enquiryId);
        return $this->db->update('enquiry', $data);
    }

    /**
     * is Qualify data...............
     */
    function updateQualifydata($en_unique_id) {
        $this->db->set('is_qualified', 1);
        $this->db->set('booking_status', 1);
        $this->db->set('qualified_date', date('Y-m-d H:i:s'));
        $this->db->set('booking_created_by', $this->session->admin_id);
        $this->db->where('en_unique_id', $en_unique_id);
        return $this->db->update('enquiry');
    }

    function getCustomerQualifedData($en_unique_id) {
        $this->db->select("enquiry.en_fname,enquiry.en_lname,enquiry.en_phone,enquiry.en_email,enquiry.en_movingfrom_state,c1.contact_reltype")->from("enquiry")
                ->join("contact as c1", "c1.contact_id = enquiry.contact_id", "left")
                // ->join("contact as c","c.contact_id = enquiry.customer_id", "left")
                ->where('en_unique_id', $en_unique_id)
                ->where("is_qualified", 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function disableEnquiry($en_unique_id) {
        if($this->session->admin_id == '1' || $this->session->admin_id == '2'){
          $this->db->update("enquiry", array("is_deleted" => 1), array("en_unique_id" => $en_unique_id));
          return true;
        }
        else{
          return false;
        }
    }

    function disqualifyBooking($en_unique_id) {
        $this->db->update("enquiry", array("is_qualified" => 0,"booking_status"=> null), array("en_unique_id" => $en_unique_id));
        return true;
    }

    function disableNotes($notes_id) {
        $this->db->update("notes", array("is_deleted" => 1), array("notes_id" => $notes_id));
        return true;
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
                $orderBy = 'enquiry_id';
            }
            $orderType = $_POST['order'][0]['dir']; // ASC or DESC
            $start = $_POST["start"]; //Paging first record indicator.
//            $start = 0;
            $length = $_POST['length']; //Number of records that the table can display in the current draw
            /* END of POST variables */
//echo $orderType;
//die;
            $where = "e.is_deleted = 0";
            if (!empty($_POST['first_name'])) {
                $where .= " AND ( e.en_fname like '" . addslashes(trim($_POST['first_name'])) . "%' )";
            }
            if (!empty($_POST['last_name'])) {
                $where .= " AND ( e.en_lname like '" . addslashes(trim($_POST['last_name'])) . "%' )";
            }
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
            if (!empty($_POST['email'])) {
                $where .= " AND ( e.en_email like '%" . addslashes(trim($_POST['email'])) . "%' )";
            }

//            if (!empty($_POST['fullname'])) {
//                $where .= " AND ( e.en_fname like '" . $_POST['fullname'] . "%' )";
//                $where .= " OR ( e.en_lname like '" . $_POST['fullname'] . "%' )";
//                $where .= " OR ( concat(e.en_fname,' ',e.en_lname) like '" . $_POST['fullname'] . "%' )";
//                
//            }
            // Alphabetic Search
            if (!empty($_POST['alphabet']) && $_POST['alphabet'] != 'all') {
                $where .= " AND ( e.en_fname like '" . $_POST['alphabet'] . "%' )";
            }

            // For Dropdown filter ( View Inquerys)			
//            if ($_POST['view_enquiries'] != "") {
//                if ($_POST['view_enquiries'] != 'all') {
//                    $where .= " AND ( e.is_qualified = '" . $_POST['view_enquiries'] . "' )";
//                }
//            }

            if ($_POST['view_enquiries'] != "") {
                if ($_POST['view_enquiries'] != 'all') {
                    $where .= " AND ( e.is_qualified = '" . $_POST['view_enquiries'] . "' )";
                    if (!empty($_POST['fullname']) && $_POST['view_enquiries'] == 0) {
                        // $where .= " AND ( e.is_qualified = 0 )";
                        $where .= " AND (( e.en_fname like '%" . addslashes(trim($_POST['fullname'])) . "%') 
                        OR ( e.en_lname like '%" . addslashes(trim($_POST['fullname'])) . "%') 
                         OR ( concat(e.en_fname,' ',e.en_lname) like '%" . addslashes(trim($_POST['fullname'])) . "%' ))";
                    } else if (!empty($_POST['fullname']) && $_POST['view_enquiries'] == 1) {
                        // $where .= " AND ( e.is_qualified = 0 )";
                        $where .= " AND (( e.en_fname like '%" . addslashes(trim($_POST['fullname'])) . "%') 
                        OR ( e.en_lname like '%" . addslashes(trim($_POST['fullname'])) . "%')
                        OR ( concat(e.en_fname,' ',e.en_lname) like '%" . addslashes(trim($_POST['fullname'])) . "%' ))";
                    }
                } else {
                    $where .= " AND (( e.en_fname like '%" . addslashes(trim($_POST['fullname'])) . "%') 
                        OR ( e.en_lname like '%" . addslashes(trim($_POST['fullname'])) . "%') 
                        OR ( concat(e.en_fname,' ',e.en_lname) like '%" . addslashes(trim($_POST['fullname'])) . "%' ))";
                }
            }

            if ($_POST['movetype_name'] != "") {
                if ($_POST['movetype_name'] == '4') {
                    $where .= " AND (( e.en_movetype = '" . trim($_POST['movetype_name']) . "' )";
                    $where .= " OR ( e.en_movetype = '5' ))";
                } else if ($_POST['movetype_name'] == '1') {
                    $where .= " AND (( e.en_movetype = '" . trim($_POST['movetype_name']) . "' )";
                    $where .= " OR ( e.en_movetype = '2' ))";
                } else {
                    $where .= " AND ( e.en_movetype = '" . trim($_POST['movetype_name']) . "' )";
                }
            }


            //Count Query
            $sql = "SELECT count(*) as cnt FROM enquiry as e INNER JOIN move_type as m ON e.en_movetype=m.movetype_id LEFT JOIN contact as c ON e.customer_id = c.contact_id  where " . $where;
            // echo $sql;die;
            $query = $this->db->query($sql);
            $reess = $query->result_array();
            $recordsTotal = $reess[0]['cnt'];
            //  $sql = "SELECT *,e.en_movetype as mtype,e.enquiry_id,(IF(find_in_set('Quote',group_concat(template_master_name)) > 0, 'Yes', 'No')) AS quoteSent FROM enquiry as e INNER JOIN move_type as m ON e.en_movetype=m.movetype_id LEFT JOIN contact as c ON e.customer_id = c.contact_id LEFT JOIN email_log as email ON e.enquiry_id=email.enquiry_id left JOIN email_master emI ON email.email_master_id =emI.email_master_id LEFT JOIN template_master tm ON tm.template_master_id=emI.template_master_id where " . $where . " group by e.enquiry_id";
            // echo $sql;die;
            //  $query = $this->db->query($sql);
            //  $recordsTotal = $query->num_rows();
            // Loop Query
            //$sql = "SELECT *,DATE_FORMAT(e.en_date, '%d/%m/%Y %h:%s %p') as en_date,DATE_FORMAT(e.en_servicedate, '%d/%m/%Y') as en_servicedate FROM enquiry as e INNER JOIN move_type as m ON e.en_movetype=m.movetype_id where $where ORDER BY $orderBy $orderType limit $start,$length";
            //$sql = "SELECT e.en_movetype as mtype,en_storagedate,en_unique_id,e.enquiry_id,
            //en_date,en_servicedate,trim(en_fname) as en_fname,trim(en_lname) as en_lname,en_movingfrom_suburb,en_movingto_suburb,en_movingfrom_state,en_movingto_state,movetype_name,contact_fname,contact_lname,(IF(find_in_set('Quote',group_concat(template_master_name)) > 0, 'Yes', 'No')) AS quoteSent FROM enquiry as e INNER JOIN move_type as m ON e.en_movetype=m.movetype_id LEFT JOIN contact as c ON e.customer_id = c.contact_id LEFT JOIN email_log as email ON e.enquiry_id=email.enquiry_id left JOIN email_master emI ON email.email_master_id =emI.email_master_id LEFT JOIN template_master tm ON tm.template_master_id=emI.template_master_id where $where group by e.enquiry_id ORDER BY $orderBy $orderType limit $start,$length";
            $sql = "SELECT e.en_movetype as mtype,e.en_travelfee,en_storagedate,en_unique_id,e.enquiry_id,e.is_qualified,e.en_servicetime,
    en_date,en_servicedate,trim(en_fname) as en_fname,trim(en_lname) as en_lname,en_movingfrom_suburb,en_movingto_suburb,en_movingfrom_state,en_movingto_state,movetype_name,contact_fname,contact_lname,IF(quotesent > 0, 'Yes', 'No') AS quoteSent FROM enquiry as e INNER JOIN move_type as m ON e.en_movetype=m.movetype_id LEFT JOIN contact as c ON e.customer_id = c.contact_id  where $where group by e.enquiry_id ORDER BY $orderBy $orderType limit $start,$length";
            $query = $this->db->query($sql);
            $query = $query->result_array();

            $data = array();

            foreach ($query as $row) {
                if ($row['movetype_name'] == "Home") {
                    $row['movetype_name'] = "Home";
                }
                if ($row['movetype_name'] == "Office") {
                    $row['movetype_name'] = "Office";
                }

                if ($row['en_movetype'] == 6) {
                    if ($row['en_storagedate'] == NULL) {
                        $row['en_servicedate'] = "";
                    } else {
                        $row['en_servicedate'] = date("d/m/y", strtotime($row['en_storagedate']));
                    }
                } else {
                    if ($row['en_servicedate'] == NULL) {
                        $row['en_servicedate'] = "";
                    } else {
                        $row['en_servicedate'] = date("d/m/y", strtotime($row['en_servicedate']));
                    }
                }
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

//                 if ($row['is_qualified'] == 1) {
// //                    $row['en_fname'] = $row['en_fname'];
// //                    $row['en_lname'] = $row['en_lname'];
//                     $row['en_fname'] = $row['contact_fname'];
//                     $row['en_lname'] = $row['contact_lname'];
//                 } else {
                    $row['en_fname'] = $row['en_fname'];
                    $row['en_lname'] = $row['en_lname'];
                // }
                if ($row['quoteSent'] == "Yes") {
                    $row['quoteSent'] = '<i class="fa fa-check fa-2x" style="color:green" aria-hidden="true"></i>';
                } else {
                    $row['quoteSent'] = '<i class="fa fa-times fa-2x" style="color:red" aria-hidden="true"></i>';
                }
                $row['en_date'] = '<a class="editbookingdate" href="' . base_url('/enquiries/viewEnquiries/' . $row['en_unique_id']) . '">' . date('d/m/y H:i', strtotime($row['en_date'])) . '</a>';

                /* if ($row['is_qualified'] == 1) {
                  $row['en_date'] = '<a class="editbookingdate" href="' . base_url('/booking/viewBooking/' . $row['en_unique_id']) . '">' . date('d/m/Y H:i', strtotime($row['en_date'])) . '</a>';
                  // $row['edit'] = '<a href="' . base_url('/booking/viewBooking/' . $row['en_unique_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deleteenquiry" data-id="' . $row['en_unique_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
                  } else {
                  $row['en_date'] = '<a class="editbookingdate" href="' . base_url('/enquiries/viewEnquiries/' . $row['en_unique_id']) . '">' . date('d/m/Y H:i', strtotime($row['en_date'])) . '</a>';
                  // $row['edit'] = '<a href="' . base_url('/enquiries/viewEnquiries/' . $row['en_unique_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deleteenquiry" data-id="' . $row['en_unique_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
                  } */

                $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['en_unique_id'] . '">';

                if (preg_match('`[0-9]`', $row['en_servicetime'])) {
                    if ($row['mtype'] == '1' || $row['mtype'] == '2') {
                        if (trim($row['en_travelfee']) == "" || $row['en_travelfee'] == NULL || $row['en_travelfee'] == '0.00') {
                            $row['sendquote'] = '<a data-id="' . $row['enquiry_id'] . '" data-movetype="'. $row['mtype'] .'" class="btn blue-madison" disabled>Send Email</a>';
                        } else {
                            $row['sendquote'] = '<a href="javascript: void(0);"  data-id="' . $row['enquiry_id'] . '" data-movetype="'. $row['mtype'] .'" class="btn blue-madison send-quote-mail">Send Email</a>';
                        }
                    } else {
                        $row['sendquote'] = '<a href="javascript: void(0);"  data-id="' . $row['enquiry_id'] . '" data-movetype="'. $row['mtype'] .'" class="btn blue-madison send-quote-mail">Send Email</a>';
                    }
                } else {
                    $row['sendquote'] = '<a data-id="' . $row['enquiry_id'] . '" data-movetype="'. $row['mtype'] .'" class="btn blue-madison" disabled>Send Email</a>';
                }
                //  $row['quoteSent'] = $row['quoteSent'];
                //  $row['en_date'] = '<a href="' . base_url('/enquiries/view/' . $row['en_unique_id']) . '">' . date('d/m/Y h:s A', strtotime($row['en_date'])) . '</a>';
                // $row['edit'] = '<a href="' . base_url('/enquiries/viewEnquiries/' . $row['en_unique_id']) . '" class="btn btn-success btn-xs ng-scope ng-isolate-scope" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;' . '<a class="btn btn-danger btn-xs ng-scope ng-isolate-scope deleteenquiry" data-id="' . $row['en_unique_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>';
                $data[] = $row;
            }
            $recordsFiltered = $recordsTotal;
            //             echo "<pre>";
//            print_r($row);
//            die;
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

    /* */

    /* Multiple Enquiry List Delete Start DRC@D */

    function getAjaxDeleteFromEnqueryList($ids) {
        if($this->session->admin_id == '1' || $this->session->admin_id == '2'){
          if (count($ids) > 0) {
            $this->db->where_in("en_unique_id", $ids);
            $num_rows = $this->db->count_all_results('enquiry');

            if ($num_rows == count($ids)) {
                $this->db->where_in("en_unique_id", $ids);
                $this->db->update("enquiry", array('is_deleted ' => 1));
                return true;
            } else {
                return false;
            }
          }
        }
        else {
          return false;
        }
    }

    /* Multiple Enquiry List Delete Over */

    /* Multiple Enquiry List Qualify Start DRC@D */

    function getAjaxQualifyFromEnqueryList($ids) {
        if (count($ids) > 0) {
            $this->db->where_in("en_unique_id", $ids);
            $num_rows = $this->db->count_all_results('enquiry');

            if ($num_rows == count($ids)) {
                $this->db->where_in("en_unique_id", $ids);
                $this->db->update("enquiry", array('is_qualified ' => 1, 'booking_status' => 1, 'qualified_date' => date('Y-m-d H:i:s')));

                return true;
            } else {
                return false;
            }
        }
    }

    /* Get multiple qualify data...........................@DRCZ */

    function getAjaxCustomerQualifedData($en_unique_ids) {
        $this->db->select("enquiry.en_fname,enquiry.en_lname,enquiry.en_phone,enquiry.en_email,enquiry.en_movingfrom_state,c1.contact_reltype")->from("enquiry")
                ->join("contact as c1", "c1.contact_id = enquiry.contact_id", "left")
                // ->join("contact as c","c.contact_id = enquiry.customer_id", "left")
                ->where_in("enquiry.en_unique_id", $en_unique_ids)
                ->where("is_qualified", 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getNotesOfEnq($enquiryID) {
        $this->db->select('*')->from('notes')
                ->where('enquiry_id', $enquiryID);
        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getCountTodayNewEnquiry() {
        $query = $this->db->get_where("enquiry", array("en_date >=" => date('Y-m-d') . ' 00:00:00', "is_deleted" => 0));
        return $query->num_rows();
    }

    function getCountTodayNewBooking() {
        $query = $this->db->get_where("enquiry", array("qualified_date >=" => date('Y-m-d') . ' 00:00:00', "is_deleted" => 0, "is_qualified" => 1));
        return $query->num_rows();
    }

    function getCountTomorrowNewBooking() {
        $query = $this->db->get_where("enquiry", array("en_servicedate =" => date('Y-m-d', strtotime(date("Y-m-d") . " +1 day")) . ' 00:00:00', "is_deleted" => 0, "is_qualified" => 1));
        return $query->num_rows();
    }

    function getCountYesterDayNewEnquiry() {
        $query = $this->db->get_where("enquiry", array("en_date >=" => date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))) . ' 00:00:00', "en_date <=" => date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))) . ' 23:59:59', "is_deleted" => 0));

        return $query->num_rows();
    }

    function getCountYesterDayNewBooking() {
        $query = $this->db->get_where("enquiry", array("qualified_date >=" => date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))) . ' 00:00:00', "qualified_date <=" => date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))) . ' 23:59:59', "is_deleted" => 0, "is_qualified" => 1));
//        echo $this->db->last_query();
        return $query->num_rows();
    }

    function getThismonthBookings() {
        $query = $this->db->get_where("enquiry", array("qualified_date >=" => date('Y-m-01') . ' 00:00:00', "qualified_date <=" => date('Y-m-d') . ' 23:59:59', "is_deleted" => 0, "is_qualified" => 1));
        return $query->num_rows();
    }

    /**
     * 
     * @param type $salesType
     * @return boolean
     */
    function getChartDataByMonth($salesType = 0) {
        $this->db->select("COUNT(*) as cnt, DATE_FORMAT(en_date, '%m') as enqMonth,DATE_FORMAT(en_date, '%M') as enqStrMonth,DATE_FORMAT(en_date, '%Y') as enqYear");
        $this->db->group_by("enqYear");
        $this->db->group_by("enqMonth");
        $this->db->order_by("enqYear");
        $this->db->order_by("enqMonth");
        $query = $this->db->get_where("enquiry", array("is_deleted" => 0, "is_qualified" => $salesType, 'en_date <>' => "null"));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getChartDataByMonthNew() {
        $this->db->select("IF(is_qualified = 0, DATE_FORMAT(en_date, '%m'), DATE_FORMAT(qualified_date, '%m')) AS enqMonth,
    IF(is_qualified = 0, DATE_FORMAT(en_date, '%M'), DATE_FORMAT(qualified_date, '%M')) AS enqStrMonth,
    IF(is_qualified = 0, DATE_FORMAT(en_date, '%y'), DATE_FORMAT(qualified_date, '%y')) AS enqYear,sum(if(is_qualified=0,1,0)) as enquiryCnt,sum(if(is_qualified=1,1,0)) as bookingCnt");
        $this->db->group_by("enqYear");
        $this->db->group_by("enqMonth");
        $this->db->order_by("enqYear");
        $this->db->order_by("enqMonth");
        $this->db->having('enqYear', date('y'));
        $this->db->limit(3, 0);
        $query = $this->db->get_where("enquiry", array("is_deleted" => 0, 'en_date <>' => "null"));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /* function getChartDataByYearNew() {
      $sql = "select e as enqMonth, DATE_FORMAT(CONCAT('1199-',e,'-06'), '%M') as enqStrmonth,Y as enqYear,q as enquiryCnt,q1 as bookingcnt from(
      select  'EnqCount'as cnt,DATE_FORMAT(en_date, '%y') as Y,DATE_FORMAT(en_date, '%m') as e,count(DATE_FORMAT(en_date, '%m'))as q from enquiry where is_deleted=0 AND `en_date` <> 'null' and `en_date` >= DATE_ADD(DATE_ADD(LAST_DAY(DATE_SUB(CURRENT_DATE(),INTERVAL 1 YEAR)),INTERVAL 1 DAY),INTERVAL -1 MONTH)  group by year(en_date),month(en_date ) )as q
      left join(
      select  'bookingcount'as cnt1,DATE_FORMAT(qualified_date, '%y')as Y1,DATE_FORMAT(qualified_date, '%m')as e1,count(DATE_FORMAT(qualified_date, '%m'))as q1 from enquiry where is_qualified=1 and is_deleted=0 AND `en_date` <> 'null' and `qualified_date` >= DATE_ADD(DATE_ADD(LAST_DAY(DATE_SUB(CURRENT_DATE(),INTERVAL 1 YEAR)),INTERVAL 1 DAY),INTERVAL -1 MONTH)  group by year(qualified_date),month(qualified_date ) )as v on q.e=v.e1 and q.y=v.y1 order by q.y,q.e";

      $query = $this->db->query($sql);

      if ($query->num_rows() > 0) {
      return $query->result_array();
      } else {
      return false;
      }
      } */

    function getChartDataByYearNew() {

        $sql = "SELECT
    e AS enqMonth,
    DATE_FORMAT(CONCAT('1199-', e, '-06'),
    '%M') AS enqStrmonth,
    Y AS enqYear,
    q AS enquiryCnt,
	qr AS reenq,
	qp AS packenq,
    q1 AS bookingcnt,
    z AS packcnt,
    g AS totalbooking
FROM
    (
    SELECT
        'EnqCount' AS cnt,
        DATE_FORMAT(en_date, '%y') AS Y,
        DATE_FORMAT(en_date, '%m') AS e,
        COUNT(DATE_FORMAT(en_date, '%m')) AS q
    FROM
        enquiry
    WHERE
        is_deleted = 0 AND `en_date` <> 'null' AND `en_date` >= DATE_ADD(
            DATE_ADD(
                LAST_DAY(
                    DATE_SUB(
                        CURRENT_DATE(), INTERVAL 1 YEAR)
                    ),
                    INTERVAL 1 DAY
                ),
                INTERVAL -1 MONTH
            )
        GROUP BY
            YEAR(en_date),
            MONTH(en_date)
        ) AS q
		
	LEFT JOIN(
    SELECT
        'EnqCount' AS cnt,
        DATE_FORMAT(en_date, '%y') AS Yr,
        DATE_FORMAT(en_date, '%m') AS er,
        COUNT(DATE_FORMAT(en_date, '%m')) AS qr
    FROM
        enquiry
    WHERE
        is_deleted = 0 AND `en_date` <> 'null' AND en_movetype IN(1, 2) AND `en_date` >= DATE_ADD(
            DATE_ADD(
                LAST_DAY(
                    DATE_SUB(
                        CURRENT_DATE(), INTERVAL 1 YEAR)
                    ),
                    INTERVAL 1 DAY
                ),
                INTERVAL -1 MONTH
            )
        GROUP BY
            YEAR(en_date),
            MONTH(en_date)
        ) AS qr
		ON
            q.e = qr.er AND q.y = qr.yr
			
    LEFT JOIN(
    SELECT
        'EnqCount' AS cnt,
        DATE_FORMAT(en_date, '%y') AS Yp,
        DATE_FORMAT(en_date, '%m') AS ep,
        COUNT(DATE_FORMAT(en_date, '%m')) AS qp
    FROM
        enquiry
    WHERE
        is_deleted = 0 AND `en_date` <> 'null' AND en_movetype IN(4, 5) AND `en_date` >= DATE_ADD(
            DATE_ADD(
                LAST_DAY(
                    DATE_SUB(
                        CURRENT_DATE(), INTERVAL 1 YEAR)
                    ),
                    INTERVAL 1 DAY
                ),
                INTERVAL -1 MONTH
            )
        GROUP BY
            YEAR(en_date),
            MONTH(en_date)
        ) AS qp
		ON
            q.e = qp.ep AND q.y = qp.yp				
			
    LEFT JOIN(
        SELECT
            'bookingcount' AS cnt1,
            DATE_FORMAT(qualified_date, '%y') AS Y1,
            DATE_FORMAT(qualified_date, '%m') AS e1,
            COUNT(
                DATE_FORMAT(qualified_date, '%m')
            ) AS g
        FROM
            enquiry
        WHERE
            is_qualified = 1 AND is_deleted = 0 AND en_movetype IN(1, 2, 4, 5, 6) AND `en_date` <> 'null' AND `qualified_date` >= DATE_ADD(
                DATE_ADD(
                    LAST_DAY(
                        DATE_SUB(
                            CURRENT_DATE(), INTERVAL 1 YEAR)
                        ),
                        INTERVAL 1 DAY
                    ),
                    INTERVAL -1 MONTH
                )
            GROUP BY
                YEAR(qualified_date),
                MONTH(qualified_date)
            ) AS g1
        ON
            q.e = g1 .e1 AND q.y = g1.y1
        LEFT JOIN(
            SELECT
                'bookingcount' AS cnt1,
                DATE_FORMAT(qualified_date, '%y') AS Y1,
                DATE_FORMAT(qualified_date, '%m') AS e1,
                COUNT(
                    DATE_FORMAT(qualified_date, '%m')
                ) AS q1
            FROM
                enquiry
            WHERE
                is_qualified = 1 AND is_deleted = 0 AND en_movetype IN(1, 2) AND `en_date` <> 'null' AND `qualified_date` >= DATE_ADD(
                    DATE_ADD(
                        LAST_DAY(
                            DATE_SUB(
                                CURRENT_DATE(), INTERVAL 1 YEAR)
                            ),
                            INTERVAL 1 DAY
                        ),
                        INTERVAL -1 MONTH
                    )
                GROUP BY
                    YEAR(qualified_date),
                    MONTH(qualified_date)
                ) AS v
            ON
                q.e = v .e1 AND q.y = v.y1
            LEFT JOIN(
                SELECT
                    'bookingcount' AS cnt1,
                    DATE_FORMAT(qualified_date, '%y') AS Y1,
                    DATE_FORMAT(qualified_date, '%m') AS e1,
                    COUNT(
                        DATE_FORMAT(qualified_date, '%m')
                    ) AS z
                FROM
                    enquiry
                WHERE
                    is_qualified = 1 AND is_deleted = 0 AND en_movetype IN(4, 5) AND `en_date` <> 'null' AND `qualified_date` >= DATE_ADD(
                        DATE_ADD(
                            LAST_DAY(
                                DATE_SUB(
                                    CURRENT_DATE(), INTERVAL 1 YEAR)
                                ),
                                INTERVAL 1 DAY
                            ),
                            INTERVAL -1 MONTH
                        )
                    GROUP BY
                        YEAR(qualified_date),
                        MONTH(qualified_date)
                    ) AS v1
                ON
                    q.e = v1 .e1 AND q.y = v1.y1
                ORDER BY
                    q.y
                DESC
                    ,
                    q.e
                DESC";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getChartDataByFiveMonth() {

        $sql = "SELECT
    e AS enqMonth,
    DATE_FORMAT(CONCAT('1199-', e, '-06'),
    '%M') AS enqStrmonth,
    Y AS enqYear,
    q AS enquiryCnt,
    q1 AS bookingcnt,
    z AS packcnt,
    sc AS storageCnt,
    g AS totalbooking
FROM
    (
    SELECT
        'EnqCount' AS cnt,
        DATE_FORMAT(en_date, '%y') AS Y,
        DATE_FORMAT(en_date, '%m') AS e,
        COUNT(DATE_FORMAT(en_date, '%m')) AS q
    FROM
        enquiry
    WHERE
        is_deleted = 0 AND `en_date` <> 'null' AND `en_date` >= DATE_ADD(
            DATE_ADD(
                LAST_DAY(
                    DATE_SUB(
                        CURRENT_DATE(), INTERVAL +4 MONTH)
                    ),
                    INTERVAL 1 DAY
                ),
                INTERVAL -1 MONTH
            )
        GROUP BY
            YEAR(en_date),
            MONTH(en_date)
        ) AS q
    LEFT JOIN(
        SELECT
            'bookingcount' AS cnt1,
            DATE_FORMAT(qualified_date, '%y') AS Y1,
            DATE_FORMAT(qualified_date, '%m') AS e1,
            COUNT(
                DATE_FORMAT(qualified_date, '%m')
            ) AS g
        FROM
            enquiry
        WHERE
            is_qualified = 1 AND is_deleted = 0 AND en_movetype IN(1, 2, 4, 5, 6) AND `en_date` <> 'null' AND `qualified_date` >= DATE_ADD(
                DATE_ADD(
                    LAST_DAY(
                        DATE_SUB(
                            CURRENT_DATE(), INTERVAL +4 MONTH)
                        ),
                        INTERVAL 1 DAY
                    ),
                    INTERVAL -1 MONTH
                )
            GROUP BY
                YEAR(qualified_date),
                MONTH(qualified_date)
            ) AS g1
        ON
            q.e = g1 .e1 AND q.y = g1.y1
        LEFT JOIN(
            SELECT
                'bookingcount' AS cnt1,
                DATE_FORMAT(qualified_date, '%y') AS Y1,
                DATE_FORMAT(qualified_date, '%m') AS e1,
                COUNT(
                    DATE_FORMAT(qualified_date, '%m')
                ) AS q1
            FROM
                enquiry
            WHERE
                is_qualified = 1 AND is_deleted = 0 AND en_movetype IN(1, 2) AND `en_date` <> 'null' AND `qualified_date` >= DATE_ADD(
                    DATE_ADD(
                        LAST_DAY(
                            DATE_SUB(
                                CURRENT_DATE(), INTERVAL +4 MONTH)
                            ),
                            INTERVAL 1 DAY
                        ),
                        INTERVAL -1 MONTH
                    )
                GROUP BY
                    YEAR(qualified_date),
                    MONTH(qualified_date)
                ) AS v
            ON
                q.e = v .e1 AND q.y = v.y1
            LEFT JOIN(
                SELECT
                    'bookingcount' AS cnt1,
                    DATE_FORMAT(qualified_date, '%y') AS Y1,
                    DATE_FORMAT(qualified_date, '%m') AS e1,
                    COUNT(
                        DATE_FORMAT(qualified_date, '%m')
                    ) AS z
                FROM
                    enquiry
                WHERE
                    is_qualified = 1 AND is_deleted = 0 AND en_movetype IN(4, 5) AND `en_date` <> 'null' AND `qualified_date` >= DATE_ADD(
                        DATE_ADD(
                            LAST_DAY(
                                DATE_SUB(
                                    CURRENT_DATE(), INTERVAL +4 MONTH)
                                ),
                                INTERVAL 1 DAY
                            ),
                            INTERVAL -1 MONTH
                        )
                    GROUP BY
                        YEAR(qualified_date),
                        MONTH(qualified_date)
                    ) AS v1
                ON
                    q.e = v1 .e1 AND q.y = v1.y1
                LEFT JOIN(
                SELECT
                'bookingcount' AS cnt1,
                DATE_FORMAT(qualified_date, '%y') AS Y1,
                DATE_FORMAT(qualified_date, '%m') AS e1,
                COUNT(
                DATE_FORMAT(qualified_date, '%m')
                ) AS sc
                FROM
                enquiry
                WHERE
                is_qualified = 1 AND is_deleted = 0 AND en_movetype IN(6) AND `en_date` <> 'null' AND `qualified_date` >= DATE_ADD(
                DATE_ADD(
                LAST_DAY(
                DATE_SUB(
                CURRENT_DATE(), INTERVAL +4 MONTH)
                ),
                INTERVAL 1 DAY
                ),
                INTERVAL -1 MONTH
                )
                GROUP BY
                YEAR(qualified_date),
                MONTH(qualified_date)
                ) AS v2
                ON
                q.e = v2 .e1 AND q.y = v2.y1
                ORDER BY
                    q.y,
                    q.e";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /* Enquiry/Booking log................@DRCZ */

    function AddEnquiryUpdateLog($enquiryLogData) {

        $this->db->set('enquiry_log_date', 'now()', FALSE);
        return $this->db->insert('enquiry_log', $enquiryLogData);
    }

    public function getEnquiryLog($enqid) {
        $this->db->select('*')->from('enquiry_log')
                ->join('admin', 'admin.admin_id = enquiry_log.enquiry_session_id')
                ->where('enquiry_id', $enqid)
                ->order_by('enquiry_log_id', 'desc');
        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    /* @DRCZ start.............Add OPS notes in crm */

    public function addOPSNotes($notesdata, $enquiryId) {
        $this->db->set('notes_date', 'now()', FALSE);
        $this->db->set('enquiry_id', $enquiryId);
        return $this->db->insert('notes', $notesdata);
    }

    /* @DRCZ end.............Add OPS notes in crm */
    /* Deposit payment notification @DRCZ */

    public function getPaymentNotify() {
        $this->db->select('concat(en_fname," ",en_lname)as fullname, enquiry_id, en_deposit_received, en_deposit_amt, en_initial_sellprice, en_unique_id, en_date, depositreceiveddate, move_type.movetype_name, is_qualified ')->from('enquiry')
                ->join('move_type', 'move_type.movetype_id = enquiry.en_movetype')
                ->where('enquiry.en_deposit_received', 1)
                ->where('enquiry.depositnotification', 0)
                ->where('move_type.is_disabled', 0)
                ->where('enquiry.is_deleted', 0)
                // ->where('enquiry.is_qualified', 0)
                ->where('enquiry.depositreceiveddate !=', '0000-00-00 00:00:00')
//                ->order_by('enquiry.enquiry_id', 'desc');
                ->order_by('enquiry.depositreceiveddate', 'desc');
        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function cntDepositNotify() {
        $this->db->select('enquiry_id')->from('enquiry')
        ->where('depositnotification', 0)
        ->where('en_deposit_received', 1)
        ->where('is_deleted', 0)  
        ->where('depositreceiveddate !=', '0000-00-00 00:00:00');
        // ->where('is_qualified', 0);
        return $query = $this->db->get()->result_array();
    }

    public function getBookingCompletedRecords(){
      $enquiryId = $this->input->post('enquiry_id');
      if($enquiryId!=''){
          return $query = $this->db->select("
          en_deposit_received,en_deposit_paidby,en_eway_refno,en_eft_receivedon,en_eway_token, final_payment_receivedby,final_payment_eway_refno,final_payment_eft_payment,head_office_paid, removalist_paid,en_month_payment_received,en_paymentmethod,en_anniversarydate,
          en_ewayrecurring_payment,en_futurepayment_log")
        ->where('en_deposit_received', 1)
        ->where('is_deleted', 0)
        ->where('final_payment_eway_refno !=', '')
        ->where('enquiry_id',$enquiryId)
        ->get('enquiry')->result_array();
        // echo $this->db->last_query();die;
      }
    }

    function updateDepositStatus($enqid,$ip) {
        date_default_timezone_set("Australia/Sydney");
        $arr=array(
          'admin_id'=>$this->session->admin_id,
          'ip'=>$ip,
          'date_time'=>date('d-m-y H:i')
        );
        $encodedData=json_encode($arr);
        $data=array(
          'depositnotification' => 1,
          'dismissed_deposit_notification_by' => $encodedData
        );
        $this->db->where('en_unique_id', $enqid);
        return $this->db->update('enquiry',$data);
    }

    function updateStorageNotifyDate($enqid){
        $res = $this->db->select('en_movetype,en_storage_notify_date')
        ->where('en_unique_id',$enqid)
        ->get('enquiry')->result_array();
        if($res[0]['en_movetype'] == '6'){
          $notifiedDate=$res[0]['en_storage_notify_date'];
          $updatedDate = date('Y-m-d',strtotime($notifiedDate.'+1 month'));
        }
        $this->db->set('en_storage_notify_date',$updatedDate)
        ->where('en_unique_id', $enqid)
        ->update('enquiry');
    }
    
    /* Deposit payment notification @DRCZ */

    /**
     * @author Darshak Shah<darshak.shah at drcinfotech.com>
     * @uses Get all the enquiries which we have to send an email to CRM's users to contact enquiries users.
     * 
     */
    function getEnquiryForFollowupQuoteReminders_old() {
//        echo date('Y-m-d D H:i:s');
        $lastFriday = date('Y-m-d', strtotime('last friday'));
        $yesterday = date('Y-m-d', strtotime("-1 days"));
        $today = date('Y-m-d');
//        echo "<br>";
        if (date('D') == 'Sat' || date('D') == 'Sun') {
            return false;
        } // If Sautrday and Sunday then it will be not exectute. We will use both days data in Monday.
        if (date('H') >= 17) {// If time is more than 14 then we will use those data after 14s in next day.
//            if (date('D') == 'Fri') { //If time is more than 14 and its Friday then we will use those data in Monday.
//                return false;
//            }else{
//                echo "asdf";
//            }
            return false;
        }
        if ((date('H') == 12 && date('i') <= 1)) {
            if (date('D') == 'Mon') {
                $this->db->where("DATE_FORMAT(en_date,'%Y-%m-%d %H:%i') BETWEEN DATE_FORMAT('" . $lastFriday . " 17:01','%Y-%m-%d %H:%i') AND  DATE_FORMAT('" . $today . " 09:00','%Y-%m-%d %H:%i')");
            } else {
                $this->db->where("DATE_FORMAT(en_date,'%Y-%m-%d %H:%i') BETWEEN DATE_FORMAT('" . $yesterday . " 17:01','%Y-%m-%d %H:%i') AND  DATE_FORMAT('" . $today . " 09:00','%Y-%m-%d %H:%i')");
            }
        } else if ((date('H') >= 9) && (date('H') < 12)) {
            if (date('D') == 'Mon') {
                $this->db->where("DATE_FORMAT(en_date,'%Y-%m-%d %H:%i') = DATE_FORMAT('" . $lastFriday . " " . abs(date('H') + 5) . ":" . date('i') . "','%Y-%m-%d %H:%i')");
            } else {
                $this->db->where("DATE_FORMAT(en_date,'%Y-%m-%d %H:%i') = DATE_FORMAT('" . $yesterday . " " . abs(date('H') + 5) . ":" . date('i') . "','%Y-%m-%d %H:%i')");
            }
        } else {
            //For other timing
            $this->db->where("DATE_FORMAT(en_date,'%Y-%m-%d %H:%i') = DATE_FORMAT('" . $today . " " . abs(date('H') - 3) . ":" . date('i') . "','%Y-%m-%d %H:%i')");
        }


//        die;
//        $this->db->limit(3);
        $this->db->select('enquiry_id, en_movetype, en_unique_id,en_movetype,en_fname,en_lname,en_date,en_movingfrom_state,en_movingto_state');
        $this->db->order_by('enquiry_id', 'desc');
//        $this->db->where("DATE_FORMAT(en_date,'%Y-%m-%d %H:%i') BETWEEN DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 185 Minute),'%Y-%m-%d %H:%i') AND  DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 180 Minute),'%Y-%m-%d %H:%i')");
        $query = $this->db->get_where("enquiry", array('is_qualified' => 0, 'is_deleted' => 0, 'created_from !=' => '', "is_follow_email_sent" => 0));
//
//        echo $this->db->last_query();
//        die;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function getEnquiryForFollowupQuoteReminders() {
        $lastFriday = date('Y-m-d', strtotime('last friday'));
        $yesterday = date('Y-m-d', strtotime("-1 days"));
        $today = date('Y-m-d');
        $endQuery = "";

        if (date('D') == 'Sat' || date('D') == 'Sun') {
          return false;
        } // If Sautrday and Sunday then it will be not exectute. We will use both days data in Monday.
        if (date('H') >= 17) {// If time is more than 14 then we will use those data after 14s in next day.
          return false;
        }

        if ((date('H') == 12 && date('i') <= 1)) {
          $fromDate="";
          if (date('D') == 'Mon') {
            $fromDate=$lastFriday;
          } else {
           $fromDate=$yesterday;
         }
         $endQuery=" BETWEEN DATE_FORMAT('" . $fromDate . " 17:01','%Y-%m-%d %H:%i') AND DATE_FORMAT('" . $today . " 09:00','%Y-%m-%d %H:%i')";
       } 
       else if ((date('H') >= 9) && (date('H') < 12)) {
        $fromDate="";
        if (date('D') == 'Mon') {
          $fromDate=$lastFriday;
        } else {
          $fromDate=$yesterday;
        }

        $endQuery=" BETWEEN DATE_FORMAT('" . $fromDate . " " . abs(date('H') + 5) . ":" . date('i') .':00'. "','%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('" . $fromDate . " " . abs(date('H') + 5) . ":" . date('i') . ':59' . "','%Y-%m-%d %H:%i:%s')"; 
      } 
      else {
        $endQuery=" BETWEEN DATE_FORMAT('" . $today . " " . abs(date('H') -3) . ":" . date('i') .':00'. "','%Y-%m-%d %H:%i:%s') AND DATE_FORMAT('" . $today . " " . abs(date('H') - 3) . ":" . date('i') . ':59' . "','%Y-%m-%d %H:%i:%s')";
      }

      $fullQuery ="SELECT ee.email_log_id, ee.email_log_date, ee.enquiry_id,data.en_movetype, data.en_unique_id,data.en_fname,data.en_lname,data.en_date,data.en_movingfrom_state,data.en_movingto_state 
      FROM 
      (SELECT MAX(email_log_id) AS emailLOGID,e.en_movetype, e.en_unique_id,e.en_fname,e.en_lname,e.en_date, e.en_movingfrom_state,e.en_movingto_state 
      FROM enquiry e 
      RIGHT JOIN email_log el ON e.enquiry_id = el.enquiry_id 
      WHERE (email_log_subject LIKE '%quote%' OR email_log_subject LIKE 'Good%') 
      and e.is_qualified = 0 
      and e.is_deleted = 0 
      and e.created_from != '' 
      and e.is_follow_email_sent = 0 
      GROUP BY e.enquiry_id 
      ORDER BY email_log_id DESC) AS data, 
      email_log ee 
      WHERE ee.email_log_id = data.emailLOGID 
      and ee.email_log_date".$endQuery;
      $query=$this->db->query($fullQuery);

    //   $queryFiresAt = date('d-m-Y H:i:s');
    //   $queryFired= $this->db->last_query();

    //   $logArr=array(
    //     'firedTime'=>$queryFiresAt,
    //     'queryFired' =>$queryFired,
    //     'no_result_records'=> $query->num_rows()
    //   );
    //   $this->db->insert('reminder_log',$logArr);
      
      if ($query->num_rows() > 0) {
        return $query->result_array();
      } else {
        return false;
      }

    }
    
    
    function getEmailMasterId(){
      
      $enquiryId = $this->input->post('enquiry_id');
      $moveType = $this->input->post('moveType');
      $templateType = $this->input->post('templateType');

      $templateMasterId=$this->db->select('template_master_id')
        ->where('template_master_name',$templateType)
        ->get('template_master')->row();
      // echo $templateMasterId->template_master_id;
      
      $emailMasterId=$this->db->select('email_master_id')
        ->where('en_movetype',$moveType)
        ->where('template_master_id',$templateMasterId->template_master_id)
        ->get('email_master')->row();

      // echo $emailMasterId->email_master_id;die;

      $logCount=$this->db->select('email_log_id')
        ->where('email_master_id',$emailMasterId->email_master_id)
        ->where('enquiry_id',$enquiryId)
        ->get('email_log')->result_array();
      
      // echo $this->db->last_query();die;
      return count($logCount);

    }

    public function getPaymentDetails(){
        $enquiryId=$this->input->post('enquiry_id');
        return $res=$this->db->select("en_deposit_received,en_deposit_paidby,en_eway_refno,en_eft_receivedon,en_eway_token, final_payment_receivedby,final_payment_eway_refno,final_payment_eft_payment,head_office_paid, removalist_paid,en_month_payment_received,en_paymentmethod,en_anniversarydate,
          en_ewayrecurring_payment,en_futurepayment_log")
        ->where('enquiry_id',$enquiryId)
        ->get('enquiry')->result_array();
        // echo "<pre>";
        // print_r($res);
    }
    
    public function searchEmail(){
      $keyword=$this->input->post('keyword');
       return $res = $this->db->select('contact_fname,contact_lname,contact_email,contact_phno')
        ->distinct()
        ->like('contact_email', $keyword)
        ->get('contact')->result_array();
        // echo $this->db->last_query();die;
    }

    public function getStorageNotification(){
      return $res = $this->db->select('enquiry_id,en_unique_id,en_fname,en_lname,en_movetype,en_movingfrom_suburb,en_movingfrom_state')
          ->where('(booking_status = 1 or booking_status = 2) ')
          ->where('en_movetype','6')
          ->where('en_storage_notify_date !=','0000-00-00')
          ->where('en_storage_notify_date <=',date('Y-m-d'))
          ->where('is_deleted','0')
          ->order_by('enquiry_id','desc')
          ->get('enquiry')->result_array();
    }
    public function getStorageNotificationCount(){
      return $res = $this->db->select('count(enquiry_id) as count')
          ->where('(booking_status = 1 or booking_status = 2) ')
          ->where('en_movetype','6')
          ->where('en_storage_notify_date !=','0000-00-00')
          ->where('en_storage_notify_date<=',date('Y-m-d'))
          ->where('is_deleted','0')
          ->order_by('enquiry_id','desc')
          ->get('enquiry')->result_array();
    }


	/**
	 * Returns the mobile token used for SMS quotes
	 * or creates a new one if expired
	 * @param int $enquiryId
	 * @return string
	 * @throws Exception
	 */
	public function getMobileToken(int $enquiryId)
	{
		$query = $this->db->get_where("enquiry", array("enquiry_id" => $enquiryId, "is_qualified" => 0));
		if ( $query->num_rows() == 0 ){
			throw new Exception('enquiry id ' . $enquiryId . ' not found');
		}
		$enquiry = $query->result()[0];
		#dd(\Carbon\Carbon::parse($enquiry->mobile_token_expire)->timestamp < \Carbon\Carbon::now()->timestamp);


		if ( $enquiry->mobile_token === NULL || $enquiry->mobile_token_expire === NULL ){
			$token = getToken(6);
			$this->db->reset_query();
			$this->db->set('mobile_token', $token);
			$this->db->set('mobile_token_expire', \Carbon\Carbon::now()->addHours($this->config->item('sms')->mobile_token_expire_hours));
			$this->db->where('enquiry_id', $enquiryId);
			$this->db->update('enquiry');
			return $token;
		}

		return $enquiry->mobile_token;
	}
	/**
	 *
	 * @param type $enquiryID
	 */
	function getEnquiryDataByMobileToken($mobileToken) {
		$query = $this->db->get_where("enquiry", [
			"mobile_token" => $mobileToken,
			"is_qualified" => 0
		]);
		if ( $query->num_rows() == 0 ){
			return false;
		}
		$enquiry = $query->result()[0];

		if ( $enquiry->mobile_token === NULL || $enquiry->mobile_token_expire === NULL ){
			return false;
		}
        
		return (array) $enquiry;
	}

    public function isSmsSent(){
        $eId= $this->input->post('enquiryId');
        return $this->db->select('is_sms_sent')
        ->where('enquiry_id',$eId)
        ->get('enquiry')->row();
    }

    public function addSmsActivity($id,$number,$type,$isEdited=''){
        $this->db->where('enquiry_id',$id)
        ->update('enquiry',array('is_sms_sent'=>'1'));
        $enquiry = $this->db->where('enquiry_id',$id)
        ->get('enquiry')->row_array();
        $template ='';
        if($type =='send'){
            $editedMsgCount = $this->db->select('email_log_editor')
            ->where('enquiry_id',$id)
            ->where('email_master_id','62')
            ->or_where('email_master_id','63')
            ->or_where('email_master_id','64')
            ->where('is_edited','1')
            ->order_by('email_log_id','desc')
            ->limit('1')
            ->get('email_log')->result_array();
            if(count($editedMsgCount) > 0){
                $template  = $editedMsgCount[0]['email_log_editor'];
            }
            else{
                $template  = $this->getSmsTemplate($enquiry);
            }
        }
        else if($type == 'edit'){
            $template  = $this->input->post('editor2');
        }
        $isEditedVar = '0';
        if($isEdited != ''){
            $isEditedVar = '1';
        }
        
        $emailLogArr=array(
            'email_master_id'=>'62',
            'enquiry_id'=> $id,
            'email_log_from' => '',
            'email_log_to' => serialize($number),
            'email_log_cc' =>'',
            'email_log_bcc' => '',
            'email_log_subject' => 'SMS Sent',
            'email_log_editor' => $template,
            'email_log_date' => date("Y-m-d H:i:s", time()),
            'email_sent_by' => $this->session->userdata('admin_id'),
            'is_edited' => $isEditedVar
        );
        $this->db->insert('email_log',$emailLogArr);
    }

    public function getSmsTemplate($enquiry){

        if ($enquiry['en_additional_charges'] != "0.00" && $enquiry['en_additional_charges'] != NULL) {
			$addcharge = '. There is also a charge of $' . (int)$enquiry["en_additional_charges"] . ' for the ' . $enquiry["en_additional_item"] . '.';
		} else {
			$addcharge = '';
		}
		if ($enquiry["en_no_of_trucks"] == 1) {
			$truck = $enquiry["en_no_of_trucks"] . " truck";
		} else {
			$truck = $enquiry["en_no_of_trucks"] . " trucks";
		}

        $this->load->model('email_template_model');
		$emailTypeArray = $this->email_template_model->getEmailIDByName('Sms');
		if ($emailTypeArray === FALSE) {
			return false;
		}
		// $emailData = $this->email_template_model->getEmailTemplate($result[0]['en_movetype'], $emailTypeArray[0]['template_master_id']);
		$moveType='';
		if($enquiry['en_movetype'] == '1' || $enquiry['en_movetype'] == '2' ){
			$moveType = '1'; 
		}
		else if($enquiry['en_movetype'] == '4'){
			$moveType = '4'; 
        }
        else if($enquiry['en_movetype'] == '5'){
			$moveType = '5'; 
		}
		$emailData = $this->email_template_model->getEmailTemplate($moveType, $emailTypeArray[0]['template_master_id']);
		if ($emailData !== FALSE) {

			if ($emailData[0]['en_movetype'] == 4 || $emailData[0]['en_movetype'] == 5 || $emailData[0]['en_movetype'] == 7 || $emailData[0]['en_movetype'] == 8) {
				$emailData[0]['email_editor'] = str_replace("{{amt}}", $enquiry["en_initial_sellprice"], $emailData[0]['email_editor']);
			} else {
				$emailData[0]['email_editor'] = str_replace("{{amt}}", $enquiry["en_deposit_amt"], $emailData[0]['email_editor']);
			}
			$servicet = strrpos($enquiry['en_servicetime'], "-");


			if ($emailData[0]['en_movetype'] == 1 || $emailData[0]['en_movetype'] == 2) {
				if ($servicet > 0) {
					$emailData[0]['email_editor'] = str_replace("{{datetimepre}}", "between ", $emailData[0]['email_editor']);
					$emailData[0]['email_editor'] = str_replace("{{datetime}}", $enquiry['en_servicetime'] . " on " . date('l d/m/Y', strtotime($enquiry['en_servicedate'])), $emailData[0]['email_editor']);
					// $emailData[0]['email_editor'] = str_replace("{{datetime}}", $result[0]['en_servicetime'], $emailData[0]['email_editor']);
				} else {
					$emailData[0]['email_editor'] = str_replace("{{datetimepre}}", "at ", $emailData[0]['email_editor']);
					// $emailData[0]['email_editor'] = str_replace("{{datetime}}", $result[0]['en_servicetime'], $emailData[0]['email_editor']);
					$emailData[0]['email_editor'] = str_replace("{{datetime}}", $enquiry['en_servicetime'] . " on " . date('l d/m/Y', strtotime($enquiry['en_servicedate'])), $emailData[0]['email_editor']);
				}
			} else {
				$emailData[0]['email_editor'] = str_replace("{{datetime}}", $enquiry['en_servicetime'] . " on " . date('l d/m/Y', strtotime($enquiry['en_servicedate'])), $emailData[0]['email_editor']);
			}
			$emailData[0]['email_to'] = $enquiry['en_email'];
			// $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_deposit_amt"], $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{uuid}}", $enquiry["en_unique_id"], $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{noofmover}}", $enquiry["en_no_of_movers"], $emailData[0]['email_editor']);
			//  $emailData[0]['email_editor'] = str_replace("{{nooftruck}}", $result[0]["en_no_of_trucks"], $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{nooftruck}}", $truck, $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{hourlyrate}}", (int)$enquiry["en_client_hourly_rate"], $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{initialsellprice}}", (int)$enquiry["en_initial_sellprice"], $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{noofladiesbooked}}", $enquiry["en_ladies_booked"], $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int)$enquiry["en_initial_hours_booked"], $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{tavelfee}}", (int)$enquiry["en_travelfee"], $emailData[0]['email_editor']);
			$emailData[0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($enquiry['en_servicedate'])) . ' ' . $enquiry['en_servicetime'], $emailData[0]['email_subject']);
			$emailData[0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($enquiry['en_servicedate'])) . ' ' . $enquiry['en_servicetime'], $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{clientfirstname}}", $enquiry['en_fname'], $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{emailTo}}", $enquiry['en_email'], $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{additionalcharges}}", $addcharge, $emailData[0]['email_editor']);
			$emailData[0]['email_editor'] = str_replace("{{additionalchargeitem}}", $enquiry["en_additional_item"], $emailData[0]['email_editor']);
			if ($enquiry['en_additional_charges'] != 0.00 && $enquiry['en_additional_charges'] != NULL) {
				$emailData[0]['email_editor'] = str_replace("{{additionalchargeforpacker}}", "and " . $enquiry["en_additional_item"], $emailData[0]['email_editor']);
			} else {
				$emailData[0]['email_editor'] = str_replace("{{additionalchargeforpacker}}", "", $emailData[0]['email_editor']);
			}

			if ($enquiry['en_movetype'] == 4 || $enquiry['en_movetype'] == 5) {
				$type11 = "QuoteP";
			} else if ($enquiry['en_movetype'] == 7 || $enquiry['en_movetype'] == 8) {
				$type11 = "QuoteLP";
			} else if ($enquiry['en_movetype'] == 1 || $enquiry['en_movetype'] == 2 || $enquiry['en_movetype'] == 3) {
				$type11 = "QuoteR";
			} else {
				$type11 = "Quote";
			}
			if ($enquiry['en_servicetime'] == "" || $enquiry['en_servicetime'] == "No preference") {
				return false;
			}
		}

        return $emailData[0]['email_editor'];

    }

    function getLatestSmsTemplate($eId){
        $sql ="SELECT email_log_editor FROM `email_log` WHERE enquiry_id = '$eId' AND email_log_subject like 'SMS Sent%' 
        ORDER BY email_log_id DESC LIMIT 1";
        return $res = $this->db->query($sql)->row_array();
    }

    public function updateWaiverInfo($id) {
        $sql = "UPDATE enquiry SET waiver_count = waiver_count + 1 WHERE en_unique_id = '$id'";
        $this->db->query($sql);
    }

    public function getWaiverCount($id) {
        return $res = $this->db->select('waiver_count')
        ->where('en_unique_id',$id)
        ->get('enquiry')->row_array();
    }

}
