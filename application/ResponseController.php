<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 18/10/2018
 * Time: 5:55 PM
 */


class ResponseController
{

	protected $payload = [
		'headers' => [],
		'content' => ''
	];

	/**
	 * @return string
	 */
	function __toString()
	{
		$this->getPayload();
		$this->resetPayload();
		return '';
	}
	function __destruct()
	{
		$this->getPayload();
		$this->resetPayload();
	}

	public function abort(\Exception $exception, $httpCode = null)
	{
		if ( $httpCode ) http_response_code($httpCode);

		$CI =& get_instance();
		echo $CI->load->view("template/header",[],true);
		echo $CI->load->view("template/css",[],true);
		echo $CI->load->view("template/js",[],true);
		echo $CI->load->view("abort",['message'=>$exception->getMessage()], true);
		echo $CI->load->view("template/footer",[],true);
		exit;
	}

	public function view($template, $params = [])
	{
		$CI =& get_instance();
		echo $CI->load->view("template/header",[],true);
		echo $CI->load->view("template/css",[],true);
		echo $CI->load->view("template/js",[],true);
		echo $CI->load->view($template,$params,true);
		echo $CI->load->view("template/footer",[],true);
		return $this;
	}

	public function json($object, array $headers = null)
	{

		$this->setHeader('Content-Type: application/json');
		if ( $headers && is_array($headers) ){
			foreach($headers as $header){
				$this->setHeader($header);
			}
		}
		$this->setContent(json_encode($object));
		echo $this->getPayload();
		return $this;
	}

	public function redirect($url, $deprecatedHttpStatus = null)
	{
		$this->setHeader("Location:" . $url);

		return $this;
	}

	/**
	 * Redirect back to the previous address
	 * @return $this
	 */
	public function back()
	{
		$this->redirect($_SERVER['HTTP_REFERER']);
		return $this;
	}

	public function withSuccess($msg)
	{
		$_SESSION['success'] = $msg;
		return $this;
	}
	public function withError($msg)
	{
		$_SESSION['errors'][] = $msg;
		return $this;
	}

	public function withErrors($array)
	{
		foreach($array as $key => $msg){
			$_SESSION['errors'][$key] = $msg;
		}
		return $this;
	}

	public function withSuccessFlash($msg)
	{
		\flash($msg, 'success');
		return $this;
	}
	public function withErrorFlash($msg)
	{
		\flash($msg, 'danger');
		return $this;
	}

	public function getPayload()
	{
		foreach($this->payload['headers'] as $header){
			header($header, true);
		}

		echo $this->payload['content'];

		// Avoid firing twice
		$this->resetPayload();

		return $this;
	}
	protected function resetPayload(){
		$this->payload = [
			'headers' => [],
			'content' => ''
		];

		return $this;
	}

	public function setHeader($header)
	{
		$this->payload['headers'][] = $header;
		return $this;
	}

	public function setContent($content)
	{
		$this->payload['content'] = $content;
		return $this;
	}

}