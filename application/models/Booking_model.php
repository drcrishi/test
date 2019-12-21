<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getEnquiryDataByUUID($en_unique_id) {

        $this->db->select("enquiry_id, is_qualified");
        $this->db->where('en_unique_id', $en_unique_id);
        $this->db->where('is_qualified', 1);
        $this->db->from("enquiry");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }
    }

    function getBookingUUID($id) {
        $this->db->select("en_unique_id")->from("enquiry")
                ->where("enquiry_id", $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        }
    }

    function getNotesById($enquiryId) {
        $this->db->select('enquiry.enquiry_id,notes.notes_id,notes.enquiry_id,notes.notes_title,notes.notes_description,notes.notes_attachedfile,notes.notes_date,group_concat(notes_id separator "##") as nid,group_concat(notes_title separator "##") as nt, group_concat(notes_description separator "##") as nd, group_concat(notes_date separator "##") as ndate, group_concat(notes_attachedfile separator "##") as nattach,group_concat(created_by_name separator "##") as uName')->from('enquiry')
                ->join('notes', 'enquiry.enquiry_id = notes.enquiry_id', 'left')
//                ->join('admin', 'enquiry.created_by = admin.admin_id', 'left')
                ->where('is_qualified', 1)
                ->where('enquiry.enquiry_id', $enquiryId)
                ->where('notes.is_deleted', 0)
                ->group_by('enquiry.enquiry_id');

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    /**
     * Edit Booking data.........@DRCZ
     */
    function editBookingById($enquiryId, $data) {

        $packerNameArr=$this->input->post('packer-name');
        $packerHoursArr=$this->input->post('packer-hours');
        $packerDataFromEnquiry=$this->getPackerIdFromEnquiry($enquiryId);
        $packerDataFromEnquiry=array_column($packerDataFromEnquiry, 'packer_id');

        //non-billable
        $nonBillablePackerNameArr=$this->input->post('non-billable-packer-name');
        $nonBillablePackerHoursArr=$this->input->post('non-billable-packer-hours');
        $nonBillablePackerDataFromEnquiry=$this->getPackerIdFromEnquiry($enquiryId);
        $nonBillablePackerDataFromEnquiry=array_column($packerDataFromEnquiry, 'packer_id');
        $nonBillableCombinedArr = array_combine($nonBillablePackerNameArr,$nonBillablePackerHoursArr);

        if(count($packerNameArr) != count($packerDataFromEnquiry)){
            $diff=array_diff($packerDataFromEnquiry,$packerNameArr);
            foreach ($diff as $toBeDeleted) {
                //echo $toBeDeleted;
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
        ->order_by('c.contact_fname')
        ->get()->result_array();
        // echo "<pre>";
        // print_r($res);die;
    }

    public function getCustomerName($q) {
        $this->db->select('*,concat(contact_fname," ",contact_lname)as clientname');
        $this->db->having("clientname LIKE '%$q%'");
        // $this->db->like('contact_fname', $q);
        $this->db->where('contact_reltype', 3);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('contact');
        //  echo $this->db->last_query();
        $y = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {

                $row_set['items'][$y]['name'] = htmlentities(stripslashes($row['clientname']));
                $row_set['items'][$y]['email'] = htmlentities(stripslashes($row['contact_email']));
                $row_set['items'][$y]['phno'] = htmlentities(stripslashes($row['contact_phno']));

                $row_set['items'][$y]['id'] = htmlentities(stripslashes($row['contact_id'])); //build an array
                $y++;
            }
            return json_encode($row_set); //format the array into json data
        } else {
            return json_encode(array("items" => ""));
        }
    }

    public function export_bookingdata() {

        $this->db->select('*,contact.contact_fname,move_type.movetype_name')->from('enquiry')
                ->join('move_type', 'enquiry.en_movetype = move_type.movetype_id')
                ->join('contact', 'contact.contact_reltype=enquiry.contact_id', 'left')
                ->join('admin', 'admin.admin_id = enquiry.created_by', 'left')
                ->where('enquiry.is_qualified', 1)
                ->where('enquiry.is_deleted', 0)
                ->order_by('enquiry.enquiry_id', 'DESC');
        $query = $this->db->get();

//        $this->db->order_by("enquiry_id", "DESC");
//        $query = $this->db->get("enquiry");
//        echo $this->db->last_query();
//        die;
        return $query->result();
    }

    public function addNotes($notesdata, $enquiryId) {
        $this->db->set("created_by_name", $this->session->userdata('admin_firstname'));
        $this->db->set("created_by", $this->session->userdata('admin_id'));
        $this->db->set('notes_date', 'now()', FALSE);
        $this->db->set('enquiry_id', $enquiryId);
        return $this->db->insert('notes', $notesdata);
    }

    public function getContactName($en_unique_id) {

        $this->db->select('contact.contact_id,contact.contact_fname,contact.contact_lname,contact.contact_email,contact.contact_phno')->from('contact')
                ->join('enquiry', 'enquiry.customer_id = contact.contact_id')
                ->where('enquiry.en_unique_id', $en_unique_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $contactname = htmlentities(stripslashes($row['contact_fname']));
                $contactlname = htmlentities(stripslashes($row['contact_lname']));
                $contactemail = htmlentities(stripslashes($row['contact_email']));
                $contactph = htmlentities(stripslashes($row['contact_phno']));
                $contactid = htmlentities(stripslashes($row['contact_id']));
                $row_set[] = $contactname . " " . $contactlname;
            }
            return json_encode($row_set); //format the array into json data
        }
    }

    public function getClientByUUID($en_unique_id) {
        $this->db->select('contact.contact_fname,contact.contact_lname')->from('contact')
                ->join('enquiry', 'enquiry.customer_id = contact.contact_id')
                ->where('enquiry.en_unique_id', $en_unique_id);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();

            $clientname = $row[0]['contact_fname'] . " " . $row[0]['contact_lname'];
            return $clientname;
        }
    }

    public function addBookingdata($data) {
        $this->db->set('en_unique_id', 'UUID()', FALSE);
        $this->db->set('qualified_date', 'now()', FALSE);
        $this->db->set('en_date', 'now()', FALSE);
        $this->db->set('is_qualified', 1);
        $count = $this->db->insert('enquiry', $data);
        // echo $this->db->last_query();die;
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

    public function getContactIdByName($q, $enqstate) {
        $this->db->select('*');
        $this->db->like('contact_fname', $q);
        $this->db->like('contact_state', $enqstate);
        $this->db->where('contact_reltype', 1);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('contact');
//         echo $this->db->last_query();
//         die;
        $y = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set['items'][$y]['name'] = htmlentities(stripslashes($row['contact_fname'])) . " " . htmlentities(stripslashes($row['contact_state']));
                $row_set['items'][$y]['id'] = htmlentities(stripslashes($row['contact_id'])); //build an array
                $y++;
            }
            return json_encode($row_set); //format the array into json data
        } else {
            return json_encode(array("items" => ""));
        }
    }

    /* Removalist filter on bookinglist.....@DRCZ */

    public function getRemovalistNameForFilter($q) {
        $this->db->select('*');
        $this->db->like('CONCAT(contact_fname," ",contact_lname)', $q);
        //       $this->db->like('contact_state');
        $this->db->where('contact_reltype', 1);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('contact');
//         echo $this->db->last_query();
//         die;
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

    /* Removalist filter on bookinglist.....@DRCZ */

    /**
     * Get enquiry data for gridview......@DRCZ
     */
    function getBookingData() {
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

    public function getPackerName($q, $enqstate) {
        $this->db->select('*');
        $this->db->like('contact_fname', $q);
        $this->db->like('contact_state', $enqstate);
        $this->db->where('contact_reltype', 2);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get('contact');
        // echo $this->db->last_query();
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

    function disableBooking($id) {
        $this->db->update("enquiry", array("is_deleted" => 1), array("en_unique_id" => $id));
        // echo $this->db->last_query();
        return true;
    }

    function disableNotes($notes_id) {
//         echo "hiii";
//         echo $notes_id;
        $this->db->update("notes", array("is_deleted" => 1), array("notes_id" => $notes_id));
        return true;
    }

    /**
     * Multiple delete of booking start @DRCZ
     */
    function getAjaxDeleteFromBookingList($ids) {
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
        else{
            return false;
        }
    }

    //Duplicate bookinglist..................@DRCZ
    function getDuplicateBookingListData($bk_unique_ids) {
        // echo "hiii";
        $enq_id = $bk_unique_ids[0];
        $this->db->select("*")->from('enquiry')
                ->where('en_unique_id', $enq_id);
        $query = $this->db->get();
//         echo $this->db->last_query();
//         die;
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
                'contact_id' => $row[0]['contact_id'], // Not copy when duplicate booking
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
                'is_qualified' => $row[0]['is_qualified'],
                'created_by' => $row[0]['created_by'],
                'booking_created_by'=>$this->session->admin_id
            );
//            print_r($data);
//            die;
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

    function getDuplicateBookingData($bk_unique_ids) {

        $this->db->select("*")->from('enquiry')
                ->where('en_unique_id', $bk_unique_ids);
        $query = $this->db->get();
//         echo $this->db->last_query();
//         die;
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
                // 'contact_id' => $row[0]['contact_id'], // Not copy when duplicate booking
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
                'is_qualified' => $row[0]['is_qualified'],
                'created_by' => $row[0]['created_by'],
                'booking_created_by'=>$this->session->admin_id
            );
//            print_r($data);
//            die;
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

    /* Get Ajax Data */

    function getAjaxData() {
        /* IF Query comes from DataTables do the following */
        if (!empty($_POST)) {

            /* Useful $_POST Variables coming from the plugin */
            $draw = $_POST["draw"]; //counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
            $orderByColumnIndex = $_POST['order'][0]['column']; // index of the sorting column (0 index based - i.e. 0 is the first record)

            $orderBy1 = $orderBy = $_POST['columns'][$orderByColumnIndex]['data']; //Get name of the sorting column from its index			
            if ($orderBy == 'checkbox_val' && $orderBy1 == 'checkbox_val') {
                $orderBy1 = $orderBy = 'enquiry_id';
            }
            $orderType1 = $orderType = $_POST['order'][0]['dir']; // ASC or DESC


            if (strcmp($orderBy, "contact_fullname") == 0) {
                $orderBy1 = 'enquiry_id';
            }

            $start = $_POST["start"]; //Paging first record indicator.
//            $start = 0;
            $length = $_POST['length']; //Number of records that the table can display in the current draw
            /* END of POST variables */
//echo $orderType;
//die;
            $where = "e.is_deleted = 0 and e.is_qualified = 1";
            $where1 = "";
            if (!empty($_POST['first_name'])) {
                $where .= " AND ( c2.contact_fname like '" . addslashes(trim($_POST['first_name'])) . "%' )";
            }
            if (!empty($_POST['last_name'])) {
                $where .= " AND ( c2.contact_lname like '" . addslashes(trim($_POST['last_name'])) . "%' )";
            }

            if (!empty($_POST['removalistfilter'])) {
                $length = 1000;
                //$where .= " AND ( c.contact_fname like '" . addslashes(trim($_POST['removalistfilter'])) . "%' )";
                $where1 .= " AND ( CONCAT(c.contact_fname , ' ', c.contact_lname) like '" . addslashes(trim($_POST['removalistfilter'])) . "%' )";
            }
//            if (!empty($_POST['removalist_booking'])) {
//                $where .= " AND ( CONCAT(c.contact_fname, ' ', c.contact_lname) like '" . $_POST['removalist_booking'] . "%' )";
//            }
            // if (!empty($_POST['en_movingfrom_state'])) {
            //     $where .= " AND ( e.en_movingfrom_state like '" . trim($_POST['en_movingfrom_state']) . "%' or e.en_movingto_state like '" . trim($_POST['en_movingfrom_state']) . "%' )";
            // }

            $stateWiseSearch = '';
            if (!empty($_POST['en_movingfrom_state'])) {
                $stateWiseSearch .= " and data.en_movingfrom_state like '" . trim($_POST['en_movingfrom_state']) . "%'";
            }
            

//            if (!empty($_POST['movetype_name'])) {
//                $where .= " AND ( m.movetype_name like '" . $_POST['movetype_name'] . "%' )";
//            }
            if (!empty($_POST['email'])) {
                $where .= " AND ( e.en_email like '" . addslashes(trim($_POST['email'])) . "%' )";
            }
            if (!empty($_POST['en_date'])) {
                $where .= " AND ( e.qualified_date like '" . $_POST['en_date'] . "%' )";
            }
            if (!empty($_POST['en_date1']) && !empty($_POST['en_date2'])) {
                $where .= " AND ( e.qualified_date >= '" . $_POST['en_date1'] . " 00:00:00' )";
                $where .= " AND ( e.qualified_date <= '" . $_POST['en_date2'] . " 23:59:59' )";
            }
            if (!empty($_POST['en_servicedate'])) {
                // $where .= " AND ( e.en_servicedate like '" . $_POST['en_servicedate'] . "%' )";
                $where .= " AND IF( e.en_movetype = '6', e.en_storagedate, e.en_servicedate) like '" . $_POST['en_servicedate'] . "%' ";
            }
            if (!empty($_POST['fullname'])) {
                $where .= " AND (( CONCAT(c2.contact_fname , ' ', c2.contact_lname) like '%" . addslashes(trim($_POST['fullname'])) . "%' )
                OR ( c2.contact_fname like '%" . addslashes(trim($_POST['fullname'])) . "%' )
                OR ( c2.contact_lname like '%" . addslashes(trim($_POST['fullname'])) . "%' ))";
            }
            /* if (!empty($_POST['fullname'])) {
              $where .= " AND (( CONCAT(c2.contact_fname , ' ', c2.contact_lname) like '%" . addslashes(trim($_POST['fullname'])) . "%' )
              OR ( c2.contact_fname like '%" . addslashes(trim($_POST['fullname'])) . "%' )
              OR ( c2.contact_lname like '%" .addslashes(trim($_POST['fullname'])) . "%' )
              OR ( CONCAT(c.contact_fname , ' ', c.contact_lname) like '%" . addslashes(trim($_POST['fullname'])) . "%' )
              OR ( c.contact_fname like '%" . addslashes(trim($_POST['fullname'])) . "%' )
              OR ( c.contact_lname like '%" . addslashes(trim($_POST['fullname'])) . "%' ))";
              } */

            // Alphabetic Search
            /* if (!empty($_POST['alphabet']) && $_POST['alphabet'] != 'all') {
              $where .= " AND ( e.en_fname like '" . $_POST['alphabet'] . "%' )";
              } */

            // For Dropdown filter ( View enquerys)			
            if ($_POST['view_booking'] != "") {
                if ($_POST['view_booking'] != 'all') {
                    if ($_POST['view_booking'] == '1') {
                        $where .= " AND (( e.booking_status = '" . $_POST['view_booking'] . "' )";
                        $where .= " OR ( e.booking_status = '2' ))";
                    } else {
                        $where .= " AND ( e.booking_status = '" . $_POST['view_booking'] . "' )";
                    }
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
            //  $sql = "SELECT *,(IF(find_in_set('JobSheet',group_concat(template_master_name)) > 0, 'Yes', 'No')) AS JobSheet,(IF(find_in_set('BookingConfirmation',group_concat(template_master_name)) > 0, 'Yes', 'No')) AS BookingConfirmation,IF(e.en_deposit_received = 1,'Yes','No') is_deposited,concat(c.contact_fname,' ',c.contact_lname) as contact_fullname FROM enquiry AS e INNER JOIN move_type AS m ON e.en_movetype = m.movetype_id LEFT JOIN contact c ON c.contact_id = e.contact_id LEFT JOIN contact AS c2 ON c2.contact_id = e.customer_id LEFT JOIN email_log AS email ON e.enquiry_id = email.enquiry_id left JOIN email_master emI ON email.email_master_id =emI.email_master_id LEFT JOIN template_master tm ON tm.template_master_id=emI.template_master_id where " . $where . " group by e.enquiry_id";

            $sql = "SELECT enquiry_id FROM enquiry AS e "
                    . "INNER JOIN move_type AS m ON e.en_movetype = m.movetype_id   LEFT JOIN contact AS c2 ON c2.contact_id = e.customer_id"
                    . " where " . $where . " group by e.enquiry_id";
            //echo $sql; die;
            $query = $this->db->query($sql);
            $recordsTotal = $query->num_rows();

            // Loop Query

            /* $sql = "SELECT     qualified_date,IF(e.en_movetype = 6,
              en_storagedate,
              en_servicedate) AS en_servicedate,
              en_servicetime,
              en_movingfrom_state,
              movetype_name,
              en_movingto_state,
              en_unique_id,
              qualified_date,
              booking_status,
              e.en_movetype as mtype , (IF(FIND_IN_SET('JobSheet', GROUP_CONCAT(template_master_name)) > 0, 'Yes', 'No')) AS JobSheet, (IF(FIND_IN_SET('BookingConfirmation', GROUP_CONCAT(template_master_name)) > 0, 'Yes', 'No')) AS BookingConfirmation, IF(e.en_deposit_received = 1, 'Yes', 'No') is_deposited,  GROUP_CONCAT(distinct(CONCAT(trim(c.contact_fname), ' ', trim(c.contact_lname)))SEPARATOR '<br/>') AS contact_fullname, CONCAT(trim(c2.contact_fname) , ' ', trim(c2.contact_lname)) AS clientname FROM enquiry AS e INNER JOIN move_type AS m ON e.en_movetype = m.movetype_id LEFT JOIN contact c ON find_in_set(c.contact_id,e.contact_id) LEFT JOIN contact AS c2 ON c2.contact_id = e.customer_id LEFT JOIN email_log AS email ON e.enquiry_id = email.enquiry_id LEFT JOIN email_master emI ON email.email_master_id = emI.email_master_id LEFT JOIN template_master tm ON tm.template_master_id = emI.template_master_id where $where group by e.enquiry_id ORDER BY $orderBy $orderType limit $start,$length"; */
            $sql = "SELECT data.*,(if(data.contact_id IS NULL, data.en_storage_provider, concat(c.contact_fname,' ',c.contact_lname) )) as contact_fullname 
            from (SELECT qualified_date,IF(e.en_movetype = 6,
            en_storagedate,
            en_servicedate) AS en_servicedate,
            en_servicetime,
            IF(
                e.en_movetype = 5,
                en_movingto_state,
                en_movingfrom_state
            ) AS en_movingfrom_state,
            movetype_name,
            en_storagedate,
            en_movingto_state,
            en_unique_id,
            booking_status,
            (IF(jobsheetsent > 0, 'Yes', 'No')) AS JobSheet, (IF(bookingconfirmationsent > 0, 'Yes', 'No')) AS BookingConfirmation,    
            CONCAT(trim(c2.contact_fname) , ' ', trim(c2.contact_lname)) AS clientname,e.contact_id,e.en_storage_provider,e.enquiry_id,
            e.booking_created_by 
            FROM enquiry AS e 
            INNER JOIN move_type AS m ON e.en_movetype = m.movetype_id  
            LEFT JOIN contact AS c2 ON c2.contact_id = e.customer_id 
            where $where group by e.enquiry_id ORDER BY $orderBy1 $orderType1 limit $start,$length ) as data , contact c 
            where  FIND_IN_SET(c.contact_id, if(data.contact_id IS NULL,0,if(data.contact_id = '',0,data.contact_id))) > 0 
            $where1 $stateWiseSearch order by  $orderBy $orderType,data.enquiry_id desc";
            // echo $sql;die;
            $query = $this->db->query($sql);
            if (!empty($_POST['removalistfilter'])) {
                $recordsTotal = $query->num_rows();
            }
            $query = $query->result_array();

            $data = array();
            $results1 = array();
            foreach ($query as $row) {
                $results1[$row['enquiry_id']]['contact_fname'][] = $row['contact_fullname'];
            }
            $skipRecords = array();
            foreach ($query as $row) {
                $sortedNames=$results1[$row['enquiry_id']]['contact_fname'];
                asort($sortedNames);
                // $row['contact_fullname'] = implode("<br/>", $results1[$row['enquiry_id']]['contact_fname']);
                $row['contact_fullname'] = implode("<br/>", $sortedNames);
                if (in_array($row['enquiry_id'], $skipRecords)) {
                    continue;
                }
                $skipRecords[] = $row['enquiry_id'];
                if ($row['movetype_name'] == "Home") {
                    $row['movetype_name'] = "Home";
                }
                if ($row['movetype_name'] == "Office") {
                    $row['movetype_name'] = "Office";
                }
                if ($row['en_servicedate'] != NULL) {
                    $row['en_servicedate'] = date("d/m/y", strtotime($row['en_servicedate']));
                } else {
                    $row['en_servicedate'] = "";
                }
                /* if ($row['mtype'] == "6") {
                  if ($row['en_storagedate'] == NULL) {
                  $row['en_servicedate'] = "";
                  } else {
                  $row['en_servicedate'] = date("d/m/Y", strtotime($row['en_storagedate']));
                  }
                  } else {
                  if ($row['en_servicedate'] == NULL) {
                  $row['en_servicedate'] = "";
                  } else {
                  $row['en_servicedate'] = date("d/m/Y", strtotime($row['en_servicedate']));
                  }
                  } */
//                if ($row['is_qualified'] == 1) {
//                    $row['en_fname'] = $row['clientname'];
//                }
                //  if ($row['mtype'] == 5) {
                if ($row['movetype_name'] == "Unpacking") {
                    $row['contact_fullname'] = $row['contact_fullname'];
                    $row['en_movingfrom_state'] = $row['en_movingto_state'];
                } else {
                    $row['en_movingfrom_state'] = $row['en_movingfrom_state'];
                }
                if ($row['JobSheet'] == "Yes") {
                    $row['JobSheet'] = '<i class="fa fa-check fa-2x" style="color:green" aria-hidden="true"></i>';
                } else {
                    $row['JobSheet'] = '<i class="fa fa-times fa-2x" style="color:red" aria-hidden="true"></i>';
                }
                if ($row['BookingConfirmation'] == "Yes") {
                    $row['BookingConfirmation'] = '<i class="fa fa-check fa-2x" style="color:green" aria-hidden="true"></i>';
                } else {
                    $row['BookingConfirmation'] = '<i class="fa fa-times fa-2x" style="color:red" aria-hidden="true"></i>';
                }
                if ($row['booking_status'] == 1) {
                    $row['booking_status'] = "Current";
                } else if ($row['booking_status'] == 2) {
                    $row['booking_status'] = "Other";
                } else if ($row['booking_status'] == 3) {
                    $row['booking_status'] = "Completed";
                }

                if($row['booking_created_by'] == '' || $row['booking_created_by'] == NULL ){
                    $row['booking_created_by'] = '-';
                }
                else{
                    $row['booking_created_by']= getAdminInitials($row['booking_created_by']);
                }

                $row['checkbox_val'] = '<input type="checkbox" name="checkbox_val[]" class="checkbox_val" value="' . $row['en_unique_id'] . '">';
                $row['qualified_date'] = '<a class="booklink" href="' . base_url('/booking/viewBooking/' . $row['en_unique_id']) . '">' . date('d/m/y H:i', strtotime($row['qualified_date'])) . '</a>';
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

    /**
     * 
     * @param type $bookingID
     */
    function getBookingDataByBookingID($bookingID) {
        $this->db->select("enquiry.*,c.contact_email as removalistEmail,c.contact_email_2 as removalistEmail2, contact.contact_email as clientEmail,contact.contact_fname as clientFname,contact.contact_lname as clientLname,contact.contact_phno as clientContactNo, contact.company_name as clientCompanyname");
        $this->db->join("contact", "contact.contact_id=enquiry.customer_id");
        $this->db->join("contact as c", "c.contact_id=enquiry.contact_id", "left");
        $getMoveTypeID = $this->db->get_where("enquiry", array("enquiry_id" => $bookingID, "is_qualified" => 1));
//echo $this->db->last_query();
        if ($getMoveTypeID->num_rows() > 0) {
            return $getMoveTypeID->result_array();
        } else {
            return false;
        }
    }

    public function Add_ImportedBookingData($data_booking) {

        $enqUniqueId = $data_booking['en_unique_id'];
        $qualifiedDate = $data_booking['qualified_date'];
        $serviceDate = $data_booking['en_servicedate'];
        $client = $data_booking['customer_id'];
        $serviceTime = $data_booking['en_servicetime'];
        $fname = $data_booking['en_fname'];
        $lname = $data_booking['en_lname'];
        $phone = $data_booking['en_phone'];
        $state = $data_booking['en_movingfrom_state'];
        $movetype = $data_booking['movetype_name'];
        $depositReceived = $data_booking['en_deposit_received'];
        $removalist = $data_booking['contact_fname'];
        $bookingStatus = $data_booking['booking_status'];
        $adminname = $data_booking['admin_firstname'];

        $this->db->select('*,contact.contact_fname,move_type.movetype_name')->from('enquiry')
                ->join('move_type', 'enquiry.en_movetype = move_type.movetype_id')
                ->join('contact', 'contact.contact_reltype=enquiry.contact_id', 'left')
                ->join('admin', 'admin.admin_id = enquiry.created_by', 'left')
                ->where('enquiry.en_unique_id', $enqUniqueId)
//                ->where('contact.contact_fname',$removalist)
                ->where('enquiry.is_qualified', 1)
                ->where('enquiry.is_deleted', 0)
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
        if ($bookingStatus == "Current") {
            $booking = 1;
        } else if ($row['booking_status'] == "Other") {
            $booking = 2;
        } else if ($row['booking_status'] == "Completed") {
            $booking = 3;
        }
        if ($depositReceived == "Yes") {
            $depo = 1;
        } elseif ($depositReceived == "No") {
            $depo = 0;
        }
        $data = array(
            'en_unique_id' => $enqUniqueId,
            'qualified_date' => $qualifiedDate,
            'en_servicedate' => $serviceDate,
            'customer_id' => $client,
            'en_servicetime' => $serviceTime,
            'en_servicedate' => $serviceDate,
            'en_fname' => $fname,
            'en_lname' => $lname,
            'en_phone' => $phone,
            'en_movingfrom_state' => $state,
            'en_movetype' => $movetypeId,
            'en_deposit_received' => $depo,
            'customer_id' => $removalist,
            'booking_status' => $booking,
            'created_by' => $this->session->userdata('admin_id'),
        );
//        echo "<pre>";
//        print_r($removalist);
//        die;
        if ($query->num_rows() > 0) {
            $this->db->where('en_unique_id', $enqUniqueId);
            return $this->db->update('enquiry', $data);
//           echo $this->db->last_query();
//           die;
        } else {
            return $this->db->insert('enquiry', $data);
        }
    }

    function revenueReportData($data) {
        $servicefrom = $data['servicedatefrom'];
        $serviceto = $data['servicedateto'];
        $movetype = $data['enmovetype'];
        $state = $data['state'];
        $removalist = $data['removalist'];
        $bookingstatus = $data['bookingstatus'];
        if (isset($state) && (trim($state) != '')) {
            $having = 'HAVING movingfrom_state = "' . $state . '"';
            // $this->db->having('movingfrom_state', $state);
        }
        if (isset($removalist) && (trim($removalist) != '')) {
            $where = ' and c.contact_fname ="' . $removalist . '"';
        }

        if ($movetype != 'All') {
            if ($movetype == 12) {
                $mov = ' and en_movetype IN (1,2)';
            } else if ($movetype == 45) {
                $mov = ' and en_movetype IN (4,5)';
            } else {
                $mov = ' and en_movetype =' . $movetype;
            }
        }
        $booking_status="";
        if ($bookingstatus == 3) {
            $booking_status = ' and booking_status ="3"';
        }

        $sql = 'select data.*, if(data.en_movetype = 6,data.en_storage_provider, group_concat(concat(contact_fname," ",contact_lname)SEPARATOR " <br/> ")) as rp from 
            (SELECT if(en_movetype=1 or en_movetype=2 or en_movetype=3,1,if(en_movetype=4  or en_movetype=5,4,6)) as en_movetype,
            if(en_movetype=5,en_movingto_state,en_movingfrom_state) as movingfrom_state,
            en_movingfrom_state,
            concat(c.contact_fname," ",c.contact_lname) as removalist,
            c.contact_id as removalist_id,
            concat(c2.contact_fname," ",c2.contact_lname) as client,
            c2.contact_id as client_id,
            enquiry_id,
            if(en_movetype =6 , en_storagedate, en_servicedate) as en_servicedate,
            if(en_movetype =6 , en_quotedcost_price, en_total_costprice) as en_total_costprice,
            if(en_movetype =6 , en_quotedsell_price, en_total_sellprice) as en_total_sellprice,
            enquiry.contact_id as packer,
            if(en_movetype =6 , (en_quotedsell_price - en_quotedcost_price), (en_total_sellprice - en_total_costprice)) as margin,
            booking_status,en_storage_provider
            FROM `enquiry` LEFT JOIN `contact` `c` ON `c`.`contact_id` = `enquiry`.`contact_id` JOIN
	    `contact` `c2` ON `enquiry`.`customer_id` = `c2`.`contact_id` WHERE
            ((en_servicedate >= "' . $servicefrom . '" '
                . 'AND en_servicedate <= "' . $serviceto . '" ) or en_storagedate >= " ' . $servicefrom .'" and en_storagedate <= "'. $serviceto .'" )'
                . $booking_status . ' AND is_qualified=1 AND enquiry.is_deleted=0  ' . $where . '' . $mov . ' ' . $having . ' '
                . 'ORDER BY en_movingfrom_state , client, en_movetype) as data,'
                . ' contact where if(en_movetype=6,1=1,FIND_IN_SET(contact_id, data.packer)) '
                . 'group by data.enquiry_id '
                . 'order by `movingfrom_state`,data.en_movetype ,rp, data.client asc';
        // echo $sql;die;
        $query = $this->db->query($sql);
//        echo $this->db->last_query();
        //die;
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    /* Update fname and lastname when add booking...............@DRCZ */

    public function updateEnquiryName($contactList, $en_unique_id) {
        $this->db->where('en_unique_id', $en_unique_id);
        return $this->db->update('enquiry', $contactList);
    }

    function addJobsheetMailLog($enqId) {
        $this->db->set('jobsheetsent', 1);
        $this->db->where('enquiry_id', $enqId);
        return $this->db->update('enquiry');
    }

    function addBookingConfirmationMailLog($enqId) {
        $this->db->set('bookingconfirmationsent', 1);
        $this->db->where('enquiry_id', $enqId);
        return $this->db->update('enquiry');
    }

    function addQuoteMailLog($enqId) {
        $this->db->set('quotesent', 1);
        $this->db->where('enquiry_id', $enqId);
        return $this->db->update('enquiry');
    }

    //Multiple Booking Disqualify........@DRCZ
    function getAjaxDisQualifyFromEnqueryList($ids) {
        if (count($ids) > 0) {

            $this->db->where_in("en_unique_id", $ids);
            $num_rows = $this->db->count_all_results('enquiry');

            if ($num_rows == count($ids)) {
                $this->db->where_in("en_unique_id", $ids);
                $this->db->update("enquiry", array('is_qualified ' => 0, 'qualified_date' => date('Y-m-d H:i:s')));
                return true;
            } else {
                return false;
            }
        }
    }

    function getClientForImportData($Client) {
        $this->db->select('contact_id')->from('contact')
                ->where('contact_reltype', 3)
                ->where('CONCAT_WS(" ",contact_fname,contact_lname) LIKE "%' . $Client . '%"', NULL, FALSE);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    function getPackersForImportData($packers) {

        $query = $this->db->query('SELECT 
        distinct c.contact_id
      FROM
          contact c,
          enquiry e
      WHERE
        CONCAT(c.contact_fname," ",c.contact_lname) LIKE "%' . $packers . '%"
        AND (en_movetype = 4 OR en_movetype = 5) AND  contact_reltype = 2');

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    function getRemovalistImportData($Removalist) {
        $query = $this->db->query('SELECT 
        distinct c.contact_id
      FROM
          contact c,
          enquiry e
      WHERE
        CONCAT(c.contact_fname," ",c.contact_lname) LIKE "%' . $Removalist . '%"
        AND (en_movetype = 1 OR en_movetype = 2) AND  contact_reltype = 1');

        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    /* Edit client's company name from booking.....@DRCZ */

    function editCompanyNameById($clientID, $client_companyName) {
        $this->db->where('contact_id', $clientID);
        return $this->db->update('contact', $client_companyName);
//         echo $this->db->last_query();
//         die;
    }

    /* Edit client's company name from booking.....@DRCZ */

    public function add_packer_hours(){
        $enquiryId=$this->input->post('packerEnquiryId');
        $hours = $this->input->post('hours');
        $packerArr=explode(',',$this->input->post('packerIds'));
        array_pop($packerArr);
        $batchArr=array();
        foreach ($packerArr as $row) {
            $data=array(
                'packer_id'=>$row,
                'packer_enquiry_id'=>$enquiryId,
                'packer_total_hours'=>$hours
            );
            $batchArr[]=$data;
        }
        $this->db->insert_batch('packer_hours', $batchArr); 
    }

    public function remove_packer_hours(){
        $this->db->where('packer_enquiry_id',$this->input->post('packerEnquiryId'))
            ->where('packer_id',$this->input->post('packerId'))
            ->delete('packer_hours');
    }
    
    public function getContactEmail($enquiryId, $contactId){
        $res = $this->db->select('contact_email')
        ->where('contact_id',$contactId)
        ->get('contact')->row_array();

        $this->db->where('enquiry_id',$enquiryId)
        ->delete('cronjob_mails');

        $cronArr = array(
            'enquiry_id' => $enquiryId,
            'contact_id' => $this->input->post("contact_id"),
            'contact_email'=> $res['contact_email']
        );
        $this->db->insert('cronjob_mails',$cronArr);
    }

    public function updateCronJobsheetMail($enquiryId){
        $this->db->where('enquiry_id',$enquiryId)
        ->update('cronjob_mails',array('is_email_sent'=> '1'));
    }

    function storageReportData($data) {
        // $servicefrom = $data['servicedatefrom'];
        // $serviceto = $data['servicedateto'];
        // $movetype = $data['enmovetype'];
        $state = $data['state'];
        // $removalist = $data['removalist'];
        $bookingstatus = $data['bookingstatus'];
        if (isset($state) && (trim($state) != '')) {
            $having = 'HAVING movingfrom_state = "' . $state . '"';
        }
        // if (isset($removalist) && (trim($removalist) != '')) {
        //     $where = ' and c.contact_fname ="' . $removalist . '"';
        // }

        // if ($movetype != 'All') {
        //     if ($movetype == 12) {
        //         $mov = ' and en_movetype IN (1,2)';
        //     } else if ($movetype == 45) {
        //         $mov = ' and en_movetype IN (4,5)';
        //     } else {
        //         $mov = ' and en_movetype =' . $movetype;
        //     }
        // }

        $mov = ' and en_movetype = '. 6;

        $booking_status="";
        if ($bookingstatus == 12) {
            $booking_status = '( booking_status ="1" or booking_status = "2") AND';
        }
        else if ($bookingstatus == 3) {
            $booking_status = ' ( booking_status ="3") AND';
        }
        
        // $booking_status = ' ( booking_status ="1" or booking_status = "2") ';

        $sql = 'select data.*, data.en_storage_provider as rp from 
            (SELECT if(en_movetype=1 or en_movetype=2 or en_movetype=3,1,if(en_movetype=4  or en_movetype=5,4,6)) as en_movetype,
            if(en_movetype=5,en_movingto_state,en_movingfrom_state) as movingfrom_state,
            en_movingfrom_state,
            concat(c.contact_fname," ",c.contact_lname) as removalist,
            c.contact_id as removalist_id,
            concat(c2.contact_fname," ",c2.contact_lname) as client,
            c2.contact_id as client_id,
            enquiry_id,
            en_storagedate as en_servicedate,
            en_quotedcost_price as en_total_costprice,
            en_quotedsell_price as en_total_sellprice,
            enquiry.contact_id as packer,
            (en_quotedsell_price - en_quotedcost_price) as margin,
            booking_status,en_storage_provider,storage_completed_date
            FROM `enquiry` LEFT JOIN `contact` `c` ON `c`.`contact_id` = `enquiry`.`contact_id` JOIN
	    `contact` `c2` ON `enquiry`.`customer_id` = `c2`.`contact_id` WHERE'
                . $booking_status . ' is_qualified=1 AND enquiry.is_deleted=0  ' . $mov . ' ' . $having . ' '
                . 'ORDER BY en_movingfrom_state , client, en_movetype) as data,'
                . ' contact where if(en_movetype=6,1=1,FIND_IN_SET(contact_id, data.packer)) '
                . 'group by data.enquiry_id '
                . 'order by `movingfrom_state`,data.en_movetype ,rp, data.client asc';
        $query = $this->db->query($sql);
        // echo $sql;die;
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

}
