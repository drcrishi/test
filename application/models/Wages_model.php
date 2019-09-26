<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wages_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getWageReport() {
        $fromDate = $this->input->post('servicedatefrom');
        $toDate = $this->input->post('servicedateto');

        $qry = "SELECT e.enquiry_id,CONCAT(e.en_fname,' ',e.en_lname) as client_name,e.en_movetype,e.en_servicedate,e.en_movingfrom_state,e.en_movingto_state,p.packer_id,(p.packer_total_hours + p.packer_nonbillable_total_hours ) as packer_total_hours, CONCAT (c.contact_fname, ' ' ,c.contact_lname) as packer_name
        FROM enquiry as e
        JOIN packer_hours p on e.enquiry_id = p.packer_enquiry_id
        JOIN contact c on p.packer_id = c.contact_id
        WHERE e.en_servicedate >= DATE_FORMAT(STR_TO_DATE('".$fromDate."', '%d-%m-%Y'), '%Y-%m-%d') 
        AND e.en_servicedate <= DATE_FORMAT(STR_TO_DATE('".$toDate."', '%d-%m-%Y'), '%Y-%m-%d')
        AND (e.en_movetype = 4 || e.en_movetype = 5) 
        AND (e.booking_status = 1 || e.booking_status = 2 || e.booking_status = 3)
        AND e.is_qualified = 1
        AND e.is_deleted = 0
        ORDER BY packer_name, en_servicedate";
        
        // $qry = "select data.*, CONCAT(cc.contact_fname,' ',cc.contact_lname) as client_name from  (SELECT e.enquiry_id, e.en_unique_id, e.customer_id,e.en_movetype,e.en_servicedate,e.en_movingfrom_state,e.en_movingto_state,p.packer_id,p.packer_total_hours, CONCAT (c.contact_fname, ' ' ,c.contact_lname) as packer_name
        // FROM enquiry as e
        // JOIN packer_hours p on e.enquiry_id = p.packer_enquiry_id
        // JOIN contact c on p.packer_id = c.contact_id
        // WHERE e.en_servicedate >= DATE_FORMAT(STR_TO_DATE('".$fromDate."', '%d-%m-%Y'), '%Y-%m-%d') 
        // AND e.en_servicedate <= DATE_FORMAT(STR_TO_DATE('".$toDate."', '%d-%m-%Y'), '%Y-%m-%d')
        // AND (e.en_movetype = 4 || e.en_movetype = 5) 
        // AND (e.booking_status = 1 || e.booking_status = 2 || e.booking_status = 3)
        // AND e.is_deleted = 0
        // ORDER BY packer_name) AS data, enquiry ee
        // join contact cc on ee.customer_id = cc.contact_id
        // where data.en_unique_id = ee.en_unique_id 
        // ORDER BY packer_name, data.en_servicedate
        // ";
        
        return $result=$this->db->query($qry)->result_array();
    }

}
