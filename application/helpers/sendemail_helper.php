<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function sendEmail($data, $type) {

    $CI = & get_instance();
    $email = $CI->config->item($type);
    // $CI->email->initialize($email);
        
    $mailConfig = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'smtp.mailtrap.io',
        'smtp_port' => 2525,
        'smtp_user' => '2bd4ab35c3ddd2',
        'smtp_pass' => '344097eba561e2',
        'crlf' => "\r\n",
        'newline' => "\r\n"
    );
    $CI->email->initialize($mailConfig);

    $emailFromName="";
    if(strpos($data[0]['email_from'], "hireamover")!==FALSE){
        $emailFromName="Hire A Mover";    
    }else if(strpos($data[0]['email_from'], "hireapacker")!==FALSE){
        $emailFromName="Hire A Packer";    
    }
    $CI->email->set_mailtype("html");
    $CI->email->from($data[0]['email_from'],$emailFromName);
    $CI->email->to($data[0]['email_to']);
    $CI->email->bcc($data[0]['email_bcc']);
    $CI->email->cc($data[0]['email_cc']);
    $CI->email->subject($data[0]['email_subject']);
    $CI->email->message($data[0]['email_editor']);
    return $CI->email->send();
}
