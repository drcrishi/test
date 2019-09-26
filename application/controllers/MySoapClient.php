<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MySoapClient extends CI_Controller {

    private $wsdl, $client;

    public function __construct() {
        parent::__construct();
        global $wsdl, $client;

        $this->load->library("Nusoap_lib");
        $proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
        $proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
        $proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
        $proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';

        $wsdl = base_url() . 'MySoapServer?wsdl';
        $client = new nusoap_client($wsdl, 'wsdl', $proxyhost, $proxyport, $proxyusername, $proxypassword);

        $err = $client->getError();
        if ($err) {
            echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        }
    }

    public function index() {
        global $wsdl, $client;

        try {
            $param = array('tmp' => 'XYZ');
            $result = $client->call('echoTest', $param, '', '', false, true);
            echo '<h2>Result</h2><pre>';
            print_r($result);
            echo '</pre>';
        } catch (SoapFault $exception) {
            echo $exception;
        }

        echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
        //echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>'; //this generates a lot of text!
    }

}