<?php



defined('BASEPATH') OR exit('No direct script access allowed');



function webNotification() {

    $CI = & get_instance();

    if ($CI->session->userdata('admin_id')) {

        $CI->load->model("notify_model");

        $array = $CI->notify_model->getNotification();

        $newArray = array();

        foreach ($array as $a) {

            $newArray[] = array(

                'description' => $a['en_fname']." ".$a['en_lname']." <br> Removal Enquiry",

                'type' => "new",

                'time' => "10",

            );

        }

        return $newArray;

    }

    return false;

}

function getAdminInitials($adminId){
    $CI = & get_instance();
    $res=$CI->db->select('CONCAT (LEFT(admin_firstname , 1),LEFT(admin_lastname , 1)) as booking_created_by')
        ->where('admin_id',$adminId)
        ->get('admin')->row_array();
    return $res['booking_created_by'];
}

function getContactFirstName($contactId){
    $CI = & get_instance();
    $res = $CI->db->select('contact_fname')
    ->where('contact_id',$contactId)
    ->get('contact')->result_array();
    if(!empty($res)){
        return $res;
    }
    else{
        return '';
    }
}
function getStorageNotifyDate($enqId){
    $CI = & get_instance();
    return $CI->db->select('en_storage_notify_date')
        ->where('enquiry_id',$enqId)
        ->get('enquiry')->row_array();
}
function pr($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function prd($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    die;
}