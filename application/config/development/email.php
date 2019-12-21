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

$defaultEmailConfig = [
	'protocol' => "smtp",
	'smtp_host' => "localhost",
	'smtp_port' => "1025",
	'mailtype' => "html",
	//'charset' => "iso-8859-1",
	'crlf' => "\r\n",
	'newline' => "\r\n",
	'smtp_timeout' => 20
];

foreach ($config1['model'] as $econf) {
    $config[$econf['emailtype']] = $defaultEmailConfig;
}


$config['testEmail'] = $defaultEmailConfig;
$config['testEmail1'] = $defaultEmailConfig;
$config['Quote'] = $defaultEmailConfig;
$config['Followup'] = $defaultEmailConfig;
$config['JobSheet'] = $defaultEmailConfig;
$config['BookingConfirmation'] = $defaultEmailConfig;
$config['SendFeedback'] = $defaultEmailConfig;
$config['SendReminder'] = $defaultEmailConfig;
$config['email'] = $defaultEmailConfig;
$config['forgotpassword'] = $defaultEmailConfig;
$config['feedbackreminder'] = $defaultEmailConfig;
$config['feedbackCurrentbooking'] = $defaultEmailConfig;
$config['NoAnswerFeedbackP'] = $defaultEmailConfig;
$config['NoAnswerFeedbackR'] = $defaultEmailConfig;
$config['StoragePaymentReminder'] = $defaultEmailConfig;