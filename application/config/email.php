<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$CI = & get_instance();

$CI->load->library('session');
//var_dump($CI->session->userdata('emailConfig'));
if (is_null($CI->session->userdata('emailConfig'))) {
    $CI->load->model("EmailConf_model");
    $config1['model'] = $CI->EmailConf_model->getEmailDataConfig();
    $CI->session->set_userdata('emailConfig', $config1['model']);
} else {
    $config1['model'] = $CI->session->userdata('emailConfig');
}

foreach ($config1['model'] as $econf) {
    $protocol = $econf['protocol'];
    $smtp_host = $econf['smtp_host'];
    $smtp_port = $econf['smtp_port'];
    $smtp_user = $econf['smtp_user'];
    $smtp_pass = $econf['smtp_pass'];

    $config[$econf['emailtype']] = array(
        'protocol' => $protocol,
//        'protocol' => "mail",
        'smtp_host' => $smtp_host,
        'smtp_crypto' => "tls",
        'smtp_port' => $smtp_port,
        'smtp_user' => $smtp_user,
        'smtp_pass' => $smtp_pass,
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'crlf' => "\r\n",
        'newline' => "\r\n",
        'smtp_timeout' => 20
    );
}


$config['testEmail'] = array(
    'protocol' => "smtp",
    'smtp_host' => "smtp.office365.com",
    'smtp_crypto' => "tls",
    'smtp_port' => "587",
    'smtp_user' => "info@hireapacker.com.au",
    'smtp_pass' => "Pack1369",
    'mailtype' => "html",
    'charset' => "iso-8859-1",
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);

$config['testEmail1'] = array(
    'protocol' => "smtp",
    'smtp_host' => "smtp.mandrillapp.com",
    'smtp_crypto' => "tls",
    'smtp_port' => "25",
    'smtp_user' => "Hire A Box",
    'smtp_pass' => "1T5mbiws1JeZVKLPD9SMBA",
    'mailtype' => "html",
    'charset' => "iso-8859-1",
    'crlf' => "\r\n",
    'newline' => "\r\n"
);

//$config['sendQuote'] = array(
//    'protocol' => 'sendmail',
//    'mailtype' => 'html',
//    'charset' => 'iso-8859-1',
//    'crlf' => "\r\n",
//    'newline' => "\r\n"
//);
$config['Quote'] = array(
    'protocol' => 'sendmail',
    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_port' => 2525,
    'smtp_user' => '3b5520b377c7ff',
    'smtp_pass' => 'b7dd64d242107f',
    'mailtype' => 'html',
    'charset' => 'iso-8859-1',
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
//$config['QuoteR'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireamover.com.au",
//    'smtp_pass' => "Moving1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
//$config['QuoteP'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireapacker.com.au",
//    'smtp_pass' => "Pack1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
//$config['QuoteLP'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@luxepackers.com.au",
//    'smtp_pass' => "Packers1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
$config['Followup'] = array(
    'protocol' => 'sendmail',
    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_port' => 2525,
    'smtp_user' => '3b5520b377c7ff',
    'smtp_pass' => 'b7dd64d242107f',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
//$config['FollowupP'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireapacker.com.au",
//    'smtp_pass' => "Pack1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
//$config['FollowupR'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireamover.com.au",
//    'smtp_pass' => "Moving1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
$config['JobSheet'] = array(
    'protocol' => 'sendmail',
    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_port' => 2525,
    'smtp_user' => '3b5520b377c7ff',
    'smtp_pass' => 'b7dd64d242107f',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
//$config['JobSheetP'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireapacker.com.au",
//    'smtp_pass' => "Pack1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
//$config['JobSheetR'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireamover.com.au",
//    'smtp_pass' => "Moving1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
$config['BookingConfirmation'] = array(
    'protocol' => 'sendmail',
    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_port' => 2525,
    'smtp_user' => '3b5520b377c7ff',
    'smtp_pass' => 'b7dd64d242107f',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
//$config['BookingConfirmationP'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireapacker.com.au",
//    'smtp_pass' => "Pack1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
//$config['BookingConfirmationR'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireamover.com.au",
//    'smtp_pass' => "Moving1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
$config['SendFeedback'] = array(
    'protocol' => 'sendmail',
    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_port' => 2525,
    'smtp_user' => '3b5520b377c7ff',
    'smtp_pass' => 'b7dd64d242107f',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
//$config['SendFeedbackP'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireapacker.com.au",
//    'smtp_pass' => "Pack1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
//$config['SendFeedbackR'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireamover.com.au",
//    'smtp_pass' => "Moving1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
$config['SendReminder'] = array(
    'protocol' => 'sendmail',
    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_port' => 2525,
    'smtp_user' => '3b5520b377c7ff',
    'smtp_pass' => 'b7dd64d242107f',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
//$config['SendReminderP'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireapacker.com.au",
//    'smtp_pass' => "Pack1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
//$config['SendReminderR'] = array(
//    'protocol' => "smtp",
//    'smtp_host' => "smtp.office365.com",
//    'smtp_crypto' => "tls",
//    'smtp_port' => "587",
//    'smtp_user' => "info@hireamover.com.au",
//    'smtp_pass' => "Moving1369",
//    'mailtype' => "html",
//    'charset' => "utf-8",
//    'crlf' => "\r\n",
//    'newline' => "\r\n",
//    'smtp_timeout' => 20
//);
$config['email'] = array(
    'protocol' => 'sendmail',
    'smtp_host' => 'smtp.mail.com',
    'smtp_port' => 587,
    'smtp_user' => 'dev.drc@mail.com',
    'smtp_pass' => 'urvi@456',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
$config['forgotpassword'] = array(
    'protocol' => "smtp",
    'smtp_host' => "smtp.office365.com",
    'smtp_crypto' => "tls",
    'smtp_port' => "587",
    'smtp_user' => "info@hireamover.com.au",
    'smtp_pass' => "Boxes4000",
    'mailtype' => "html",
    'charset' => "iso-8859-1",
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
$config['feedbackreminder'] = array(
    'protocol' => "smtp",
    'smtp_host' => "smtp.office365.com",
    'smtp_crypto' => "tls",
    'smtp_port' => "587",
    'smtp_user' => "info@hireamover.com.au",
    'smtp_pass' => "Boxes4000",
    'mailtype' => "html",
    'charset' => "utf-8",
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
$config['feedbackCurrentbooking'] = array(
    'protocol' => "smtp",
    'smtp_host' => "smtp.office365.com",
    'smtp_crypto' => "tls",
    'smtp_port' => "587",
    'smtp_user' => "info@hireamover.com.au",
    'smtp_pass' => "Boxes4000",
    'mailtype' => "html",
    'charset' => "utf-8",
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
$config['NoAnswerFeedbackP'] = array(
    'protocol' => "smtp",
    'smtp_host' => "smtp.office365.com",
    'smtp_crypto' => "tls",
    'smtp_port' => "587",
    'smtp_user' => "info@hireapacker.com.au",
    'smtp_pass' => "Zaf11323",
    'mailtype' => "html",
    'charset' => "utf-8",
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
$config['NoAnswerFeedbackR'] = array(
    'protocol' => "smtp",
    'smtp_host' => "smtp.office365.com",
    'smtp_crypto' => "tls",
    'smtp_port' => "587",
    'smtp_user' => "info@hireamover.com.au",
    'smtp_pass' => "DN734QJyJHbdnsdLiCaeS6Mz97in",
    'mailtype' => "html",
    'charset' => "utf-8",
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);
$config['StoragePaymentReminder'] = array(
    'protocol' => "smtp",
    'smtp_host' => "smtp.office365.com",
    'smtp_crypto' => "tls",
    'smtp_port' => "587",
    'smtp_user' => "info@hireamover.com.au",
    'smtp_pass' => "Boxes4000",
    'mailtype' => "html",
    'charset' => "utf-8",
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'smtp_timeout' => 20
);