<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Notify_model extends CI_Model {



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

        $this->load->model("enquiry_model");

    }



    /**

     * @author Darshak Shah <darshak.shah@drcinfotech.com>

     * @param array $data Collection of notification table fields

     */

    function setNotification($data) {

        $enquiryID = $this->enquiry_model->getEnquiryIDFromUUID($data['uuid']);

        unset($data['uuid']);

        $data['enquiry_id'] = $enquiryID;

        $this->db->set("notification_time", "NOW()", FALSE);

        $this->db->insert("notification", $data);

        return true;

    }

    

    /**

     * @author Darshak Shah <darshak.shah@drcinfotech.com>

     * @uses Get Notification records

     */

    function getNotification(){

        

        $this->db->select(array("notification_type","notification_time","en_fname","en_lname"));

        $this->db->from("notification");

        $this->db->join("enquiry","enquiry.enquiry_id=notification.enquiry_id");

        $this->db->where('en_date >= now() - interval 10 second');

        $this->db->limit(10);

        $this->db->order_by("notification_id","desc");

        $query=$this->db->get();

        return $query->result_array();

    }



    /**

     * Get not shown records

     */

    function getunreadNotification(){

        $this->db->select('enquiry_id,en_unique_id,en_fname,en_lname,en_movetype,en_date,en_deposit_amt,    en_servicedate,en_movingfrom_suburb,en_movingfrom_state');

        $this->db->from("enquiry");

        $this->db->where('en_date >= now() - interval 60 second');

        $this->db->where('created_by IS NULL', null, false);

        $this->db->where('is_deleted', 0);

        // $this->db->where('notify_shown','0');

        $query=$this->db->get();

        return $query->result_array();

    }



    /**

     * updates shown notification

     */

    function updateShownNotification(){

        $type=$this->input->post('type');

        $id=$this->input->post('enquiry_id');



        if($type =="enquiry"){

            $data=array(

                'notify_shown'=>'1',

            );

        }

        elseif ($type == "deposit") {

             $data=array(

                'notify_deposit'=>'1',

            );

        }

        $this->db->where('enquiry_id',$id)

                ->update('enquiry',$data);

    }



    /**

     * Get not shown deposit records

     */

    function getDepositNotification(){

        $this->db->select('enquiry_id,en_unique_id,en_fname,en_lname,en_movetype,en_date,en_deposit_amt,    en_servicedate,en_movingfrom_suburb,en_movingfrom_state');

        $this->db->from("enquiry");

        // $this->db->where('notify_deposit','0');

        $this->db->where('depositreceiveddate >= now() - interval 60 second');

        $this->db->where('depositreceiveddate!=','0000-00-00 00:00:00');

        $query=$this->db->get();

        return $query->result_array();

    }

}

