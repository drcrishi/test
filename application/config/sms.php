<?php
defined('BASEPATH') OR exit('No direct script access allowed');



$config['sms'] = (object) [
	'username' => 'brettepi',
	'password' => 'moving1369',
	'from' => '0404820457',
	'redirect' => false, # Redirect all outbound SMS to this number, used for testing
	'mobile_token_expire_hours' =>  12,
];