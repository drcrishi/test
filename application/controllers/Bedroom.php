<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bedroom extends CI_Controller
{

    var $MODEL = 'Bedroom_model';
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
        $this->data['title'] = "Bedroom";
        $data['BedroomMoversList'] = $this->model->getBedroomMoversList();
        $data['MoversTrucksList'] = $this->model->getMoversTrucksList();
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

        );
        $data['jsFooter'] = array(
            'custom/js/bootstrap-select.min.js',
            'pages/scripts/form-bedroom.js',
            'pages/scripts/jquery-ui.multidatespicker.js'
        );
        $data['css'] = array(
            'global/plugins/select2/css/select2.min.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css',
            'global/plugins/bootstrap-daterangepicker/daterangepicker.css',
            'pages/css/jquery-ui.multidatespicker.css'
        );
        $data['cssTP'] = array(
            '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
            'assets/pages/css/pricelist.css'
        );
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('bedroom_view', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function add(){
        $response = array();
        $this->load->library('form_validation');
        $ruleType = $this->input->post('ruleType');
        $this->form_validation->set_error_delimiters('', '');
        if($ruleType == 'bedroom'){
            $this->form_validation->set_rules('bedroom', 'bedroom', 'trim|required|greater_than_equal_to[0]');
            $this->form_validation->set_rules('movers', 'movers', 'trim|required|greater_than_equal_to[0]');
        }
        else if($ruleType == 'desk'){
            $this->form_validation->set_rules('desk', 'desk', 'trim|required|greater_than_equal_to[0]');
            $this->form_validation->set_rules('movers', 'movers', 'trim|required|greater_than_equal_to[0]');
        }
        else if($ruleType == 'mover'){
            $this->form_validation->set_rules('mover', 'mover', 'trim|required|greater_than_equal_to[0]');
            $this->form_validation->set_rules('truck', 'truck', 'trim|required|greater_than_equal_to[0]');
        }
        if ($this->form_validation->run() == FALSE) {
            $response['code'] = '0';
            $response['msg'] = $this->form_validation->error_array();
        } else {
            $res=$this->model->save($ruleType);
            if($res=='duplicate'){
                $response['code'] = '3';
                $response['msg'] = 'Record Already Exists';
            }
            else if($res=='update'){
                $response['code'] = '2';
                $response['msg'] = 'Record Updated Successfully';
            }
            else{
                $response['code'] = '1';
                $response['msg'] = 'Record Added Successfully';
                $response['recordid'] = $res;    
            }
            echo json_encode($response);
        }
    }

    public function delete(){
        $response = array();
        if($this->model->deleteRecord()){
            $response['code'] = '1';
            $response['msg'] = 'Record Deleted Successfully';
        }
        else{
            $response['code'] = '2';
            $response['msg'] = 'Something went wrong... Please try again later';
        }
        echo json_encode($response);
    }

    public function testQuery(){

        // home/office
        $data=array(
            'bedroom_desk'=>'3',
            'moveType'=>'1',
            'state'=>'NSW',
            'datepicker'=>'28-07-2019'
        );
        $data1=array(
            'bedroom_desk'=>'10',
            'moveType'=>'2',
            'state'=>'VIC',
            'datepicker'=>'24-07-2019'
        );
        $flag=$this->model->getFeesByBedroom($data);
        if(!$flag){
            echo "no records found";
        }
        else{
            // $result=$this->model->getFeesByBedroom($data);
            // pr($data1);
            pr($flag);
        }

       

        // packing/unpacking
        $data2=array(
            'moveType'=>'4',
            'state'=>'NSW',
            'datepicker'=>'25-07-2019'
        );
        $data3=array(
            'moveType'=>'5',
            'state'=>'NSW',
            'datepicker'=>'25-07-2019'
        );
        $result2=$this->model->getPackingRules($data2);
        // pr($data2);
        pr($result2);

    }

}
