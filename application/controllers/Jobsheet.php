<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jobsheet extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isLogin())
            show_404();
            $this->data = array();
    }

    public function open($bookingID = "") {
        if ($bookingID == "" || !isset($bookingID)) {
            show_404();
        }
        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();
        $Url = "https://www.hireamover.com.au/jobsheet/getjobsheet.php";
        // OK cool - then let's create a new cURL resource handle
        $ch = curl_init();
        // Now set some options (most are optional)
        // Set URL to download
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('bookingID' => $bookingID, 'pdf' => 'yes')));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        $errpr = curl_error($ch);
        curl_close($ch);

        if ($errpr == "") {
            if (count($output) > 0) {
                $html = json_decode($output, TRUE);
                stripcslashes($html[0]['jobsheet_body']);
                $pdf->WriteHTML(stripcslashes($html[0]['jobsheet_body']));
                $pdf->Output('./jobsheetpdf/' . $filename, "I");
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

}
