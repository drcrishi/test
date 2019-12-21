<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SecureQuoteApi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("email_template_model");
		$this->load->model("enquiry_model");
		$this->load->model("booking_model");
		$this->load->model("contact_model");
	}

	/**
	 * @param $mobileToken
	 */
	public function getQuote($mobileToken)
	{
		error_reporting(-1);
		ini_set('display_errors', 'on');
		$enquiry = $this->getEnquiryModel()->getEnquiryDataByMobileToken($mobileToken);
		if (!$enquiry) {
			return response()->json(['status' => 'failed']);
		}
		
		$emailTypeArray = $this->getEnquiryModel()->getLatestSmsTemplate($enquiry['enquiry_id']);
		// prd($emailTypeArray);
		return response()->json(['html'=>$emailTypeArray['email_log_editor']]);
	}

	/**
	 * @return Enquiry_model
	 */
	public function getEnquiryModel()
	{
		return $this->enquiry_model;
	}
}
