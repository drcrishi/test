<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Packer extends CI_Controller
{

    var $MODEL = 'Packer_model';

    public function __construct()
    {
        parent::__construct();
        if (!isLogin())
            redirect(base_url());
        $this->data = array();
        $this->load->model($this->MODEL, 'model');
        $this->load->helper('file');
        date_default_timezone_set('Australia/Sydney');
    }

    public function index()
    {
        $this->data['title'] = "Packing/Unpacking Rules";
        $data['packerData'] = $this->model->getPackerData(); 
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js',
            'global/plugins/moment.min.js',
            'global/plugins/bootstrap-daterangepicker/daterangepicker.min.js',
        );
        $data['jsTPFooter'] = array(
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            // 'https://cdn.alloyui.com/3.0.1/aui/aui-min.js',

        );
        $data['jsFooter'] = array(
            // 'pages/scripts/form-enquiries.js',
            'custom/js/bootstrap-select.min.js',
            'pages/scripts/form-packer.js',
            'pages/scripts/jquery-ui.multidatespicker.js'
        );
        $data['css'] = array(
            'global/plugins/select2/css/select2.min.css',
            // 'global/plugins/select2/css/select2-bootstrap.min.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css',
            'global/plugins/bootstrap-daterangepicker/daterangepicker.css',
            'pages/css/jquery-ui.multidatespicker.css'
        );
        $data['cssTP'] = array(
            '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
            'assets/pages/css/pricelist.css'
        );
        $data['isPriceList']="yes";
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('packer_view', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function add()
    {
        $response = array();
        $this->load->library('form_validation');
        $typeId = $this->input->post('ruleType');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('movetype', 'movetype', 'trim|required|greater_than_equal_to[1]|less_than_equal_to[5]');
        $this->form_validation->set_rules('states[]', 'states', 'required');
        $this->form_validation->set_rules('perPersonPackingRate', 'perPersonPackingRate', 'trim|required|greater_than_equal_to[1]');
        $this->form_validation->set_rules('packerCost', 'packerCost', 'trim|required|greater_than_equal_to[1]');
        if($typeId =='4'){
            $this->form_validation->set_rules('dayFrom', 'dayFrom', 'trim|required|greater_than_equal_to[0]|less_than_equal_to[6]');
            $this->form_validation->set_rules('dayTo', 'dayTo', 'trim|required|greater_than_equal_to[0]|less_than_equal_to[6]');
        }
        else if($typeId =='5'){
             $this->form_validation->set_rules('datefrom', 'datefrom', 'trim|required|callback_checkPreviousDate');
        }
        if ($this->form_validation->run() == FALSE) {
            $response['code'] = '0';
            $response['msg'] = $this->form_validation->error_array();
        } else {
            $res = $this->model->saveValues($typeId);
            if($res == "dateExists"){
                $response['code'] = '4';
                $response['msg'] = 'Given date/dates is already added in Holiday List';
                $response['id'] = '';
            }
            else if ($res == "exists") {
                $response['code'] = '3';
                $response['msg'] = 'Record Already Exists';
                $response['id'] = '';
            } else if ($res == "update") {
                $response['code'] = '2';
                $response['msg'] = 'Record Updated Successfully';
                $response['id'] = '';
            } else {
                $response['code'] = '1';
                $response['msg'] = 'Record Added Successfully';
                $response['id'] = $res;
            }
        }
        echo json_encode($response);
    }

    public function delete()
    {
        $response = array();
        if ($this->model->deletePricelist()) {
            $response['code'] = '1';
            $response['msg'] = 'Deleted Successfully';
        }
        echo json_encode($response);
    }

    public function updateStatus(){
    	$response = array();
    	if($this->model->updateStatus()){
    		$response['code'] = '1';
            $response['msg'] = 'Updated Successfully';
    	}
    	else{
    		$response['code'] = '0';
            $response['msg'] = 'Something went wrong... Please try again.';
    	}
    	echo json_encode($response);
    }

    public function getPriceRules($data = "")
    {
        $data = array(
            'movetype' => '1',
            'date'=>'12-06-2019',
            'no_of_trucks'=>'1',
            'no_of_movers'=>'2',
            'state'=>'VIC'
        );
        echo "<pre>";
        print_r($this->model->getPriceRules($data));
        
    }

    public function checkPreviousDate($dates){
        $datesArr=explode(',',$dates);
        $flagArr=array();
        foreach ($datesArr as $date) {
            $date=trim($date);
            $date=strtotime($date);
            $date2= strtotime(date("d-m-Y"));
            if($date < $date2){
                $flagArr[]='0';
            }
            else{
                $flagArr[]='1';
            }
        }
        if(in_array('0',$flagArr)){
            $this->form_validation->set_message('checkPreviousDate', 'Only future dates are allowed.');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    public function rules(){
        $this->load->view('get_price_rules_values');
    }
    public function getRules(){
        // echo "<pre>";
        $movingType= $this->input->post('moveType');
        if($movingType == '1' || $movingType == '2'){
            $data=array(
            'movetype' => $this->input->post('moveType'),
            'date'=>$this->input->post('datepicker'),
            'no_of_trucks'=>$this->input->post('noOfTrucks'),
            'no_of_movers'=>$this->input->post('noOfMovers'),
            'state'=>$this->input->post('state')
        );
        echo json_encode($this->model->getPriceRules($data));    
        }
        else if($movingType == '4' || $movingType == '5'){
            $data=array(
                'movetype' =>$moveType=$this->input->post('moveType'),
                'state'=>$state=$this->input->post('state'),
                'date'=>$date=$this->input->post('datepicker')
            );
            echo json_encode($this->model->getPackingRules($data));
        }
    }

    public function getPackingRules(){
        echo json_encode($this->model->getPackingRules());
    }

}
