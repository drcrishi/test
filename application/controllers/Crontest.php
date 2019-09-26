<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Crontest extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //if(!$this->input->is_cli_request()) {echo "Get Out"; exit; }
    }

    public function testing(){
    	$data=array(
    		'firedTime'=> date('Y-m-d H:i:s'),
    		'queryFired'=> 'testing',
    		'no_result_records' => '1'
    	);
    	$this->db->insert('reminder_log',$data);
    	// echo $this->db->last_query();
    }

}
