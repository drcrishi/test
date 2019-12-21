<?php
/**
 * Created by PhpStorm.
 * User: fil
 * Date: 13/08/18
 * Time: 5:55 PM
 */

namespace App\SMS;


use function curl_close;
use function curl_init;
use function curl_setopt;
use Exception as ExceptionAlias;

class Sms
{
	/**
	 * @param string $to
	 * @param string $message
	 * @param string $reference
	 * @return bool
	 * @throws ExceptionAlias
	 */
	public function send(string $to, string $message, string $reference, string $moveType)
	{

		# Validate $to mobile number
		if ( !$this->validateMobileNumber($to) ){
			throw new ExceptionAlias("Invalid mobile number");
		}
		# Generate params to send to SMSBroadcast
		$CI =& get_instance();
		$CI->config->load('sms');
		$config = [
			'username'  => $CI->config->item('sms')->username,
			'password'  => $CI->config->item('sms')->password,
			'from'      => $CI->config->item('sms')->from,
			'to'        => !empty( $CI->config->item('sms')->redirect) ?  $CI->config->item('sms')->redirect : $to,
			'message'   => $message,
			'ref'       => $reference,
		];

		$response = explode(':',$this->apiRequest($config));
		switch($response[0]){
			case 'BAD':
				throw new \Exception($response[2]);
				break;
			case 'ERROR':
				throw new \Exception($response[1]);
				break;
		}
		return true;
	}

	/**
	 * Submits API request to SMS Broadcast
	 * @param array $params
	 * @return bool|string
	 */
	protected function apiRequest(array $params){
		$ch = curl_init("https://api.smsbroadcast.com.au/api-adv.php");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	}

	/**
	 * @return object
	 */
	protected function config()
	{
		# TODO: Get CodeIgnitor Config
		return (object) [
			'username' => '',
			'password' => '',
			'from' => 'MyCompany'
		];
	}

	/**
	 * @param string $mobileNumber
	 * @return bool
	 */
	protected function validateMobileNumber(string $mobileNumber){
		return preg_match_all("/^(4|04|614|\+614)\d{8}$/",$mobileNumber) > 0;
	}

}