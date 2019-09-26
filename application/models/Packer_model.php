<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Packer_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPackerData(){
        return $this->db->select('pricelist_id,rule_type,movetype,day_from,day_to,dates,per_person_packing_rate,packer_cost_price,states,status')
        ->where('rule_type','4')
        ->or_where('rule_type','5')
        ->order_by('movetype', 'ASC')
        ->get('pricelist')->result_array();
    }

    public function saveValues($typeId)
    {
        $dayFrom = '';
        $dayTo = '';
        $states = array('NSW,VIC,QLD,WA,SA');
        $dates = "";
        $daysRange='';
        $packerPerHourRate = 0;

        if($typeId == '4'){
            $dayFrom = $this->input->post('dayFrom',TRUE);
            $dayTo = $this->input->post('dayTo',TRUE);
            $daysRange=$this->getDaysRange($dayFrom,$dayTo);
        }
        $states = $this->input->post('states[]');
        if (count($states == '1') && $states[0] == "All") {
            $states = array('NSW,VIC,QLD,WA,SA');
        } 
        if($typeId =='5'){
            $dates = $this->input->post('datefrom',TRUE);
        }

        $encodedStates = implode(',', $states);

        $data = array(
            'rule_type' => $this->input->post('ruleType',TRUE),
            'movetype' => $this->input->post('movetype',TRUE),
            'day_from' => $dayFrom,
            'day_to' => $dayTo,
            'days_range'=>$daysRange,
            'dates' => $dates,
            'per_person_packing_rate'=>$this->input->post('perPersonPackingRate',TRUE),
            'packer_cost_price'=>$this->input->post('packerCost',TRUE),
            'states' => $encodedStates,
            'status' => $this->input->post('priceListStatus',TRUE)
        );

        if (!$this->input->post('pricelistId')) {
            if (count($this->checkIfAlreadyExists($data)) > 0) {
                return "exists";
            }

            $res = $this->db->insert('pricelist', $data);
            $lastInsertedId = $this->db->insert_id();
            $logData=array(
                "Customer_IP_1"=> @$_SERVER['REMOTE_ADDR'],
                "Customer_IP_2"=> @$_SERVER['HTTP_X_FORWARDED_FOR'],
                "http_referer"=> @$_SERVER['HTTP_REFERER'],
                "user_id"=> $this->session->admin_id,
                "action"=>'added',
                "pricelist_id"=> $lastInsertedId,
                'time'=> date('d-m-Y H:i:s')
            );
            $this->updatePricelistLog($logData,$data);
            return $lastInsertedId;
        } else {
            $checkResult=$this->checkIfAlreadyExists($data);
            if($this->input->post('pricelistId') == $checkResult[0]['pricelist_id'] || count($checkResult) == 0){
                $this->db->where('pricelist_id', $this->input->post('pricelistId'));
                $res = $this->db->update('pricelist', $data);
                $logData=array(
                "Customer_IP_1"=> @$_SERVER['REMOTE_ADDR'],
                "Customer_IP_2"=> @$_SERVER['HTTP_X_FORWARDED_FOR'],
                "http_referer"=> @$_SERVER['HTTP_REFERER'],
                "user_id"=> $this->session->admin_id,
                "action"=>'updated',
                "pricelist_id"=> $this->input->post('pricelistId'),
                'time'=> date('d-m-Y H:i:s')
            );
            $this->updatePricelistLog($logData,$data);
                return $msg = "update";
            }
            // echo $this->input->post('pricelistId')."<br>";
            // echo $checkResult[0]['pricelist_id'];die;
            if($this->input->post('pricelistId') != $checkResult[0]['pricelist_id']){
                return "exists";
            }

        }
    }

    public function updatePricelistLog($logdata,$data=""){
        global $pricelist_log;    
        $price_log_path =  "./pricelist_log/";;
        $log_file_name = "pricelist_log_".date("d_m_Y");


        $logToBeWritten = $logdata;

        if($logdata['action']=="added" || $logdata['action']=="updated" ){
            $logToBeWritten = array_merge($logdata,$data);
        }
        if(file_exists($price_log_path.$log_file_name.".txt")){
            $pricelist_log = fopen($price_log_path.$log_file_name.".txt", "a");
        }
        else{
           $pricelist_log= fopen($price_log_path.$log_file_name.".txt", 'w');
        }
        fwrite($pricelist_log, "================================================================================\r\n");
        fwrite($pricelist_log, date("d-m-Y H:i:s") . "\r\n");
        fwrite($pricelist_log, print_r($logToBeWritten, true) . "\r\n");
        fwrite($pricelist_log, "================================================================================\r\n\r\n");
    }

    public function deletePricelist()
    {
        $logData=array(
            "Customer_IP_1"=> @$_SERVER['REMOTE_ADDR'],
            "Customer_IP_2"=> @$_SERVER['HTTP_X_FORWARDED_FOR'],
            "http_referer"=> @$_SERVER['HTTP_REFERER'],
            "user_id"=> $this->session->admin_id,
            "action"=>'deleted',
            "pricelist_id"=> $this->input->post('pricelistId'),
            'time'=> date('d-m-Y H:i:s')
        );
        $this->updatePricelistLog($logData);
        return $this->db->where('pricelist_id', $this->input->post('pricelistId'))->delete('pricelist');
    }

    public function updateStatus(){
        // echo $this->input->post('status');
        // echo $this->input->post('pricelistId').'456';
        $this->db->where('pricelist_id',$this->input->post('pricelistId'))
        ->update('pricelist',array('status'=>$this->input->post('status')));
        if($this->db->affected_rows() >=0){
          return true; 
        }else{
          return false;
        }
    }

    public function checkIfAlreadyExists($data)
    {
        // pr($data);die;
        $isMatchingArray = array(
            'rule_type' => $data['rule_type'],
            'movetype' => $data['movetype'],
            'states' => str_replace(",","|",$data['states']),
        );

        if ($data['rule_type'] == '4') {
            $isMatchingArray['days_range'] = " and ( days_range REGEXP ". $data['day_from'] ." or days_range REGEXP ". $data['day_to']." or (day_from BETWEEN ". $data['day_from'] ." and ". $data['day_to']." or day_to BETWEEN ". $data['day_from'] ." and ". $data['day_to']."))";
        }
        if ($data['rule_type'] == '5' ) {
            $isMatchingArray['dates'] = str_replace(",","|",$data['dates']);
        }

        $whereString="";
        $cntr=0;
        foreach($isMatchingArray as $key=>$value){
            $cntr++;
            if($cntr == 1){
                $whereString .= $key ." = ". $value;    
                continue;
            }

            if($key == "days_range"){
                $whereString.= $value;
                continue;
            }

            if($key=="states" || $key =="dates"){
                $whereString.= " and ". $key ." REGEXP '".$value."'";
                continue;
            }
            $whereString .= " and ". $key ." = ". $value;
        }
        $qry= 'select pricelist_id from pricelist where '.$whereString;
        // echo $qry;die;
        return $res=$this->db->query($qry)->result_array();
    }


    public function getPriceRules($data)
    {
        // echo "<pre>";
        $checkHoliday = $this->isRecordInHoliday($data);
        if(count($checkHoliday)>0){
            // print_r($checkHoliday);
            return $checkHoliday;
        }
        $checkCustom = $this->isRecordInCustom($data);
        if(count($checkCustom)>0){
            // print_r($checkCustom);
            return $checkCustom;
        }
        $checkDefault = $this->isRecordInDefault($data); 
        if(count($checkDefault)>0){
            // print_r($checkDefault);
            return $checkDefault;
        }
    }

    public function isRecordInHoliday($data)
    {
        $query = "SELECT pricelist_id, rule_type, movetype,dates,no_of_trucks,no_of_movers,travel_fee,client_hour_rate,
        states,priority
        FROM
        pricelist
        WHERE `movetype` = " . $data['movetype'] . " AND `no_of_trucks` = " . $data['no_of_trucks'] . " AND `no_of_movers` = " . $data['no_of_movers'] ." and 
        pricelist.dates REGEXP '" . $data['date'] . "' and states REGEXP '" . $data['state'] . "' AND status = 1 AND `rule_type` = 3
        ORDER BY  priority  DESC LIMIT 1";
        // $res=$this->db->query($query)->result_array();
        // echo $this->db->last_query();die;
        return $res=$this->db->query($query)->result_array();
    }

    public function isRecordInDefault($data){
        $day=$this->getDayFromDate($data['date']);
        $query="SELECT  pricelist_id, rule_type, movetype,dates,no_of_trucks,no_of_movers,travel_fee,client_hour_rate,
        states,priority
        FROM
        `pricelist`
        WHERE
        `movetype` = " . $data['movetype'] . " AND `no_of_trucks` = " . $data['no_of_trucks'] . " AND `no_of_movers` = " . $data['no_of_movers'] . " AND days_range REGEXP '".$day."' AND  `rule_type` = 1 AND status = 1 ORDER BY
        priority DESC LIMIT 1";
        // $res=$this->db->query($query)->result_array();
        // echo $this->db->last_query();die;
        return $res=$this->db->query($query)->result_array();
    }

    public function getDayFromDate($date)
    {
        return date('w', strtotime($date));
    }

    public function getDaysRange($startDay,$endDay){
        $range='';
        for($i=$startDay; $i <= 6; $i++){
            $range.=$i.',';
            if($i=='6'){
                if($i== $endDay){
                    break;
                }
                $i=-1;
                continue;
            }
            if($i== $endDay){
                break;
            }
        }
        // echo $range;die;
        return $range;
    }

    public function getPackingRules($data){
        $date=$data['date'];
        $day = $this->getDayFromDate($date);

        $qry="select rule_type, movetype, per_person_packing_rate 
        from pricelist
        where states REGEXP '". $data['state'] ."' AND days_range REGEXP ".$day." and  status = 1 and rule_type = 4 
        and movetype = ". $data['movetype'] ." ORDER BY
        priority DESC LIMIT 1" ;
        return $res= $this->db->query($qry)->result_array();
        // echo $qry;die;
        // $res= $this->db->query($qry)->result_array();
        // echo $this->db->last_query();die;
    }

    public function getHomeOfficeRules($data){
        $data=array(
            'movetype' => $data['moveType'],
            'date'=>$data['datepicker'],
            'no_of_trucks'=>$data['noOfTrucks'],
            'no_of_movers'=>$data['noOfMovers'],
            'state'=>$data['state']
        );
        // echo json_encode($this->getPriceRules($data));    
        return $this->getPriceRules($data);    
            
    }

    public function getPackingUnpackingRules($data){
        $data=array(
            'movetype' =>$data['moveType'],
            'state'=>$data['state'],
            'date'=>$data['datepicker']
        );
        // echo json_encode($this->getPackingRules($data));
        return $this->getPackingRules($data);
    }



}
