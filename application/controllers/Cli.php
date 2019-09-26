<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cli extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //if(!$this->input->is_cli_request()) {echo "Get Out"; exit; }
    }

    public function removeSession() {
        foreach (get_dir_file_info("tmps/") as $files) {
            if (time() - $files['date'] >= 60 * 60 * 24 * 1) { // 1 days
                unlink("tmps/" . $files['name']);
            }
        }
    }

    public function clearNotification() {
        $this->db->empty_table('notification');
    }

    function feedbackCurrentbooking($auth) {
        die;
        if ($auth != "zzz123mavani458795gggg54ggg") {
            exit;
        }
        //  mail("zeel.mavani@drcinfotech.com","Cronjobexecute","Hi Zeel");
        $this->db->select('enquiry.client_feedback,enquiry.booking_status,enquiry.qualified_date,enquiry.en_date,enquiry.en_servicedate,CONCAT(contact.contact_fname , " " , contact.contact_lname) AS clientname,date(DATE_SUB(NOW(), INTERVAL 1 DAY)) as comdate')->from('enquiry')
                ->join('contact', 'contact.contact_id = enquiry.customer_id', 'left')
                ->where('enquiry.booking_status', 1)
                ->where('enquiry.is_deleted', 0)
                ->where('date(DATE_SUB(NOW(), INTERVAL 1 DAY)) = date(enquiry.qualified_date) AND (enquiry.client_feedback = "" OR enquiry.client_feedback IS NULL)')
                ->where('enquiry.is_qualified', 1);
        //  ->limit(1);
        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $emaildata[] = array(
                    'email_from' => 'info@hireamover.com.au',
                    'email_to' => 'info@hireamover.com.au',
                    'email_bcc' => '',
                    'email_cc' => 'zeel.mavani@drcinfotech.com',
                    'email_subject' => 'Feedback required on for ' . $row['clientname'] . ', ' . date("d-m-Y", strtotime($row['en_servicedate'])),
                    'email_editor' => "Please contact " . $row['clientname'] . " to obtain feedback on this job",
                );

                $sendEmail = sendEmail($emaildata, 'feedbackCurrentbooking');
                unset($emaildata);
            }
        }
    }

    function feedbackReminder($auth) {
//die('d');

        if ($auth != "zzz123mavani458795gggg54") {
            exit;
        }
        // mail("darshak.shah@drcinfotech.com", "Cronjobexecute", "Hi D");


        $this->db->select('DISTINCT(enquiry_log.enquiry_id),enquiry.enquiry_id,enquiry.en_unique_id,enquiry.client_feedback,enquiry.en_movingfrom_state,enquiry.booking_status,date(enquiry_log.enquiry_log_date) as enqlogdate ,'
                        . 'enquiry_log.enquiry_status,CONCAT(contact.contact_fname , " " , contact.contact_lname) AS clientname'
                        . ',date(DATE_SUB(NOW(), INTERVAL 3 DAY)) as comdate, enquiry.en_servicedate')->from('enquiry')
                ->join('enquiry_log', 'enquiry.enquiry_id = enquiry_log.enquiry_id')
                ->join('contact', 'contact.contact_id = enquiry.customer_id', 'left')
                ->where_not_in('en_movetype', 6)
                ->where('enquiry.booking_status', 2)
                ->where('enquiry.is_deleted', 0)
                ->where('date(DATE_SUB(NOW(), INTERVAL 3 DAY)) = date(enquiry_log.enquiry_log_date)')
                ->like('enquiry_log.enquiry_status', 'Booking status')
                ->where('enquiry.client_feedback', "")
                ->where('enquiry.is_qualified', 1);
        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        $this->load->model("email_template_model");

        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $row) {

                $this->db->select('enquiry.enquiry_id,enquiry.en_unique_id,date(auto_email_reminder.auto_email_log_date) as autoenqlogdate,auto_email_reminder.enquiry_id')->from('enquiry')
                        ->join('auto_email_reminder', 'auto_email_reminder.enquiry_id = enquiry.enquiry_id')
                        ->where('auto_email_reminder.enquiry_id', $row['enquiry_id']);
                $query1 = $this->db->get();
//                        echo $this->db->last_query();
//        die;
                if ($query1->num_rows() > 0) {

                    $this->db->select('enquiry.enquiry_id,enquiry.en_unique_id,enquiry.client_feedback,enquiry.en_movingfrom_state,enquiry.booking_status,date(auto_email_reminder.auto_email_log_date) as autoenqlogdate ,'
                                    . 'CONCAT(contact.contact_fname , " " , contact.contact_lname) AS clientname'
                                    . ',date(DATE_SUB(NOW(), INTERVAL 3 DAY)) as comdate, enquiry.en_servicedate')->from('enquiry')
                            ->join('contact', 'contact.contact_id = enquiry.customer_id', 'left')
                            ->join('auto_email_reminder', 'auto_email_reminder.enquiry_id = enquiry.enquiry_id', 'left')
                            ->where('enquiry.booking_status', 2)
                            ->where('enquiry.is_deleted', 0)
                            ->where('date(DATE_SUB(NOW(), INTERVAL 3 DAY)) = date(auto_email_reminder.auto_email_log_date)')
                            ->where('enquiry.client_feedback', "")
                            ->where('enquiry.is_qualified', 1)
                            ->where('enquiry.enquiry_id', $row['enquiry_id'])
                            ->order_by('auto_email_reminder.auto_email_log_date');
                    $query2 = $this->db->get();

                    foreach ($query2->result_array() as $row2) {
                        $emaildata1[] = array(
                            'email_from' => 'info@hireamover.com.au',
                            'email_to' => 'info@hireamover.com.au',
                            'email_bcc' => '',
                            'email_cc' => '',
                            'email_subject' => 'Feedback required for ' . $row2['clientname'] . ',' . date("d-m-Y", strtotime($row2['en_servicedate'])) . ' ('.$row2['en_movingfrom_state'].')',
                            'email_editor' => "Please contact <a href=" . base_url('/booking/viewBooking/' . $row2['en_unique_id']) . ">" . $row2['clientname'] . "</a>" . " to obtain feedback on this job",
                                //'email_editor' => "Please contact " . $row2['clientname'] . " to obtain feedback on this job",
                        );
                        // echo "U :" . $row2['clientname'];
                        $sendEmail1 = sendEmail($emaildata1, 'feedbackreminder');
                        $this->email_template_model->addAutoEmailLog($emaildata1, $row2['enquiry_id']);
                        unset($emaildata1);
                        //  sleep(5);
                    }
                } else {
                    $emaildata[] = array(
                        'email_from' => 'info@hireamover.com.au',
                        'email_to' => 'info@hireamover.com.au',
                        'email_bcc' => '',
                        'email_cc' => '',
                        'email_subject' => 'Feedback required for ' . $row['clientname'] . ',' . date("d-m-Y", strtotime($row['en_servicedate'])) . ' ('.$row['en_movingfrom_state'].')',
                        'email_editor' => "Please contact <a href='" . base_url('/booking/viewBooking/' . $row['en_unique_id']) . "'>" . $row['clientname'] . "</a> to obtain feedback on this job",
                            //'email_editor' => "Please contact " . $row['clientname'] . " to obtain feedback on this job",
                    );
                    $sendEmail = sendEmail($emaildata, 'feedbackreminder');
                    $this->email_template_model->addAutoEmailLog($emaildata, $row['enquiry_id']);
                    unset($emaildata);
                    // sleep(5);
                }
            }
        }

        $this->db->select('enquiry.enquiry_id,enquiry.en_unique_id,enquiry.en_movingfrom_state,enquiry.client_feedback,enquiry.booking_status,date(auto_email_reminder.auto_email_log_date) as autoenqlogdate ,'
                        . 'CONCAT(contact.contact_fname , " " , contact.contact_lname) AS clientname'
                        . ',date(DATE_SUB(NOW(), INTERVAL 3 DAY)) as comdate, enquiry.en_servicedate')->from('enquiry')
                ->join('contact', 'contact.contact_id = enquiry.customer_id', 'left')
                ->join('auto_email_reminder', 'auto_email_reminder.enquiry_id = enquiry.enquiry_id', 'left')
                ->where_not_in('en_movetype', 6)
                ->where('enquiry.booking_status', 2)
                ->where('enquiry.is_deleted', 0)
                ->where('enquiry.client_feedback', "")
                ->where('enquiry.is_qualified', 1)
                ->order_by('auto_email_reminder.auto_email_reminder_id', 'desc');
        $query3 = $this->db->get();
//                echo $this->db->last_query();
//        die;

        $enqArray = array();
        foreach ($query3->result_array() as $row3) {

            if (in_array($row3['enquiry_id'], $enqArray)) {
                continue;
            } else {
                array_push($enqArray, $row3['enquiry_id']);

                if ($row3['autoenqlogdate'] == date("Y-m-d", strtotime("-3 days", strtotime(date('Y-m-d'))))) {

                    $emaildata2[] = array(
                        'email_from' => 'info@hireamover.com.au',
                        'email_to' => 'info@hireamover.com.au',
                        'email_bcc' => '',
                        'email_cc' => '',
                        'email_subject' => 'Feedback required for ' . $row3['clientname'] . ',' . date("d-m-Y", strtotime($row3['en_servicedate'])) . ' ('.$row3['en_movingfrom_state'].')',
                        'email_editor' => "Please contact <a href=" . base_url('/booking/viewBooking/' . $row3['en_unique_id']) . ">" . $row3['clientname'] . "</a>" . " to obtain feedback on this job",
                            //'email_editor' => "Please contact " . $row3['clientname'] . " to obtain feedback on this job",
                    );

                    $sendEmail2 = sendEmail($emaildata2, 'feedbackreminder');
                    $this->email_template_model->addAutoEmailLog($emaildata2, $row3['enquiry_id']);
                    unset($emaildata2);
                    // sleep(5);
                } else {
                    continue;
                }
            }
        }
        // die;
    }

    /* INSTANT QUOTE....@DRCZ */

    function InstantQuotePaymentNotRec($auth) {

        die;
        if ($auth != "gggggzzzzzzz20162016ggggzzzz") {
            exit;
        }
        $this->db->select('*,DATE_ADD(en_date, INTERVAL 5 MINUTE) as addd')->from('enquiry')
                ->where('is_deleted', 0)
                ->where('is_qualified', 0)
                ->where('DATE_FORMAT(now(), "%Y-%m-%d %H:%i") = Date_format(DATE_ADD(en_date, INTERVAL 5 MINUTE),"%Y-%m-%d %H:%i")')
                // ->where('NOW() = DATE_ADD(en_date, INTERVAL 5 MINUTE)')
                ->where('en_deposit_received', 0)
                ->like('created_from', 'PackerInstantQuotePaymentEligible');
        $query = $this->db->get();
//        echo $this->db->last_query();
//        die;
        if ($query->num_rows() > 0) {

            foreach ($query->result_array() as $row) {

                //  mail("zeel.mavani@drcinfotech.com","Cronjobexecute","Hi In"); 
                // if(date('Y-m-d H:i:s') == date("Y-m-d H:i:s", strtotime("+5 minutes", strtotime($row['en_date'])))){
                //    $handle = fopen("PIQ_LOG", "a");
                //     fwrite($handle, "yes " . print_r($row['enquiry_id'], true));
                // }
                $this->db->select('enquiry_id, email_master_id,email_log_date')->from('email_log')
                        ->where('enquiry_id', $row['enquiry_id']);
                $query1 = $this->db->get();
//                        echo $this->db->last_query();
//                        echo "<br>";

                if ($query1->num_rows() > 0) {
                    //  mail("zeel.mavani@drcinfotech.com","Cronjobexecute","Hi Zeel"); 
                    //  $handle = fopen("PIQ_LOG", "a");
                    //    fwrite($handle, "TestingEmail " . print_r($row['enquiry_id'], true));
                    //continue;
                } else {
                    //  mail("zeel.mavani@drcinfotech.com","Yes","Hi Zeel mavani"); 
                    /* SEND AUTO EMAIL............@DRCZ */
                    $url = "http://crm.hireamover.com.au/email/sendAutoInstantQuote/" . $row['enquiry_id'] . "/Quote?auth=slientEmailAhj";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    return $output;
                    // file_get_contents("http://crm.hireamover.com.au/email/sendAutoInstantQuote/" . $row['enquiry_id'] . "/Quote?auth=slientEmailAhj");
                }
            }
        }
    }

    /* INSTANT QUOTE....@DRCZ */

    function followupQuoteReminders() {
//        die;
//        mail('darshak.shah@drcinfotech.com','Hi D!',date('Y-m-d H:i:s'));
        $emailAction = "FollowupQuoteReminders";
        $this->load->model("enquiry_model");
        $this->load->model("email_template_model");
        $emailTypeArray = $this->email_template_model->getEmailIDByName($emailAction);
        if ($emailTypeArray === FALSE) {
            return false;
        }
        $enquiryData = $this->enquiry_model->getEnquiryForFollowupQuoteReminders();
        foreach ($enquiryData as $eD) {
            
            $this->db->where('enquiry_id', $eD['enquiry_id']);
            $this->db->update("enquiry",array("is_follow_email_sent"=>1));
            
            $emailData = $this->email_template_model->getEmailTemplate($eD['en_movetype'], $emailTypeArray[0]['template_master_id']);
            if ($emailData !== FALSE) {
                $emailData[0]['email_editor'] = str_replace("{{uuid}}", $eD["en_unique_id"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientfirstname}}", $eD['en_fname'].' '.$eD['en_lname'], $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{clientfirstname}}", $eD['en_fname'].' '.$eD['en_lname'], $emailData[0]['email_subject']);
                if($eD['en_movetype']!=5){
                    $emailData[0]['email_subject'] = str_replace("{{state}}", "[". $eD['en_movingfrom_state']."]" , $emailData[0]['email_subject']);
                }else{
                    $emailData[0]['email_subject'] = str_replace("{{state}}", "[". $eD['en_movingto_state']."]" , $emailData[0]['email_subject']);
                }
                $emailData[0]['email_editor']=html_entity_decode($emailData[0]['email_editor']);
                $emailData[0]['email_to'] = "info@hireamover.com.au";
                // $emailData[0]['email_bcc'] = "darshak.shah@drcinfotech.com";

                // $emailData[0]['email_to'] = "info@hireamover.com.au";
                // $emailData[0]['email_to'] = "darshak.shah@drcinfotech.com";

//                echo "<pre>";
//                print_r($emailData);
//                die;
                if ($eD['en_movetype'] == 4 || $eD['en_movetype'] == 5) {
                    $type11 = "QuoteP";
                } else if ($eD['en_movetype'] == 7 || $eD['en_movetype'] == 8) {
                    $type11 = "QuoteLP";
                } else if ($eD['en_movetype'] == 1 || $eD['en_movetype'] == 2 || $eD['en_movetype'] == 3) {
                    $type11 = "QuoteR";
                } else {
                    $type11 = $emailAction;
                }
                var_dump(sendEmail($emailData, $type11));
            } else {
                echo "no no no";
                continue;
            }
        }
//         mail('darshak.shah@drcinfotech.com','Hi D!',date('Y-m-d H:i:s'));
    }

    //20-08-19
    function sendStorageNotifications($auth){
        if ($auth != "rrrRishi987654321Ezhavaeee") {
            exit;
        }

        $res = $this->db->select('enquiry_id,en_unique_id,en_movetype,CONCAT(en_fname, " " , en_lname) as client_name')
            ->where('(booking_status = 1 or booking_status = 2)')
            ->where('en_movetype','6')
            ->where('en_storage_notify_date',date('Y-m-d'))
            ->where('is_deleted','0')
            ->order_by('enquiry_id','desc')
            ->get('enquiry')->result_array();
        foreach ($res as $row) {
            $this->load->model('email_template_model');
            $emailData = $this->email_template_model->getEmailTemplate('6','12');
            if ($emailData !== FALSE) {
                $emailData[0]['email_subject'] = str_replace("{{clientname}}", $row['client_name'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{clientname}}", $row['client_name'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{uuid}}", $row['en_unique_id'], $emailData[0]['email_editor']);
            }
            $sent = sendEmail($emailData, 'StoragePaymentReminder');
            // $this->email_template_model->addAutoEmailLog($emailData, $row['enquiry_id']);

            $logFile= fopen("./log_files/storage_mail_log.txt", 'a');
            fwrite($logFile, "================================================================================\r\n");
            fwrite($logFile, date("d-m-Y H:i:s") . "\r\n");
            fwrite($logFile, print_r($emailData, true) . "\r\n");
            fwrite($logFile, "================================================================================\r\n\r\n");

            unset($emailData);
        }
    }

}
