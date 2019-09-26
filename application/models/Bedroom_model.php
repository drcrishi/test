<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bedroom_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getBedroomMoversList(){
        return $this->db->where('bm_status',1)
        ->order_by('bm_id','asc')
        ->get('bedroom_movers')->result_array();
    }

    public function getMoversTrucksList(){
        return $this->db->where('mt_status',1)
        ->order_by('mt_id','asc')
        ->get('movers_trucks')->result_array();
    }
    public function save($ruleType){
        $data=array(); 
        if($ruleType == 'bedroom' || $ruleType == 'desk'){
            if($ruleType == 'bedroom'){
                $data['bm_no_of_bedrooms']=$this->input->post('bedroom');   
                $data['bm_no_of_desks']='0';
                $data['sign']= $this->input->post('sign');
                $data['bm_no_of_movers']=$this->input->post('movers');
            }
            else{
                $data['bm_no_of_bedrooms']='0';
                $data['bm_no_of_desks']=$this->input->post('desk');
                $data['sign']= $this->input->post('sign');
                $data['bm_no_of_movers']=$this->input->post('movers');
            }
            if($this->checkDuplicate($data,$ruleType)){
                return $msg = "duplicate";
            }
            else{
                if (!$this->input->post('ruleId')) {
                    $this->db->insert('bedroom_movers',$data);
                    return $this->db->insert_id();
                }
                else{
                    $this->db->where('bm_id',$this->input->post('ruleId'))
                    ->update('bedroom_movers',$data);
                    return $msg = "update";
                }
            }
            
        }
        else if($ruleType == 'mover'){
            $data['mt_no_of_movers']=$this->input->post('mover');   
            $data['sign']=$this->input->post('sign'); 
            $data['mt_no_of_trucks']=$this->input->post('truck');
            if($this->checkDuplicate($data,$ruleType)){
                return $msg = "duplicate";
            }
            else{
                if (!$this->input->post('ruleId')) {
                    $this->db->insert('movers_trucks',$data);
                    return $this->db->insert_id();
                }
                else{
                    $this->db->where('mt_id',$this->input->post('ruleId'))
                    ->update('movers_trucks',$data);
                    return $msg = "update";
                }
            }
        }
    }

    public function deleteRecord(){
        if($this->input->post('type') == 'bedroom' || $this->input->post('type') == 'desk'){
            $this->db->where('bm_id',$this->input->post('recordId'))
            ->delete('bedroom_movers');
            return $this->db->affected_rows();    
        }
        else if($this->input->post('type') == 'mover'){
            $this->db->where('mt_id',$this->input->post('recordId'))
            ->delete('movers_trucks');
            return $this->db->affected_rows();       
        }
    }

    public function checkDuplicate($data,$type){
        if($type=='bedroom' || $type == 'desk'){
            if($type == 'bedroom'){
                unset($data['bm_no_of_desks']);
            }
            else{
                unset($data['bm_no_of_bedrooms']);
            }
            unset($data['bm_no_of_movers']);
            unset($data['sign']);
            $res=$this->db->select('bm_id')
            ->where($data)
            ->get('bedroom_movers')->result_array();
            if(empty($res) || $res[0]['bm_id'] == $this->input->post('ruleId')){
                return false; 
            }
            else{
                return true;
            }
        }
        elseif($type == 'mover'){
            unset($data['mt_no_of_trucks']);
            unset($data['sign']);
            $res=$this->db->select('mt_id')
            ->where($data)
            ->get('movers_trucks')->result_array();
            if(empty($res) || $res[0]['mt_id'] == $this->input->post('ruleId')){
                return false; 
            }
            else{
                return true;
            }
        }
    }

    // public function getFeesByBedroom($bedroom_desk,$type){
    public function getFeesByBedroom($dataArr){

        $data=array(
            'type' => $dataArr['moveType'],
            'date'=>$dataArr['datepicker'],
            'bedroom_desk' => $dataArr['bedroom_desk'],
            'state'=>$dataArr['state']
        );

        $field='';
        $moveType='';
        if($data['type'] == '1'){
            $field = 'bm_no_of_bedrooms';
            $movetype ='1';
        }
        else if($data['type'] == '2'){
            $field = 'bm_no_of_desks';
            $movetype ='2';
        }

        $query='select bm_id from bedroom_movers where '. $field .' = '. $data['bedroom_desk'];
        $result=$this->db->query($query)->result_array();
        if(empty($result)){
            return false;
        }

        $query1= 'select data.no_movers, mt.mt_no_of_trucks from (select bm_no_of_movers as no_movers from bedroom_movers where ' . $field . ' = '. $data['bedroom_desk'].') as data join movers_trucks as mt on data.no_movers = mt.mt_no_of_movers';

        $result1=$this->db->query($query1)->result_array();

        // check in holiday

        $query2 = "SELECT pricelist_id, rule_type, movetype,dates,no_of_trucks,no_of_movers,travel_fee,client_hour_rate,
        states 
        FROM pricelist
        WHERE `movetype` = " . $movetype . " AND `no_of_trucks` = " . $result1[0]['mt_no_of_trucks'] . " AND `no_of_movers` = " . $result1[0]['no_movers'] ." and  pricelist.dates REGEXP '" . $data['date'] . "' and states REGEXP '" . $data['state'] . "' AND status = 1 AND `rule_type` = 3";

        $result2=$this->db->query($query2)->result_array();
        if(!empty($result2)){
            return $result2;
        }

        // check in custom 

        $day=$this->getDayFromDate($data['date']);
        $query3="SELECT pricelist_id, rule_type, movetype, dates, no_of_trucks, no_of_movers, travel_fee, client_hour_rate,
         states
        FROM
        `pricelist`
        WHERE
        `movetype` = " . $movetype . " AND `no_of_trucks` = " . $result1[0]['mt_no_of_trucks'] . " AND `no_of_movers` = " . $result1[0]['no_movers'] . " and states REGEXP '". $data['state'] ."' AND days_range REGEXP '".$day."' AND  `rule_type` = 2 AND status = 1";

        $result3=$this->db->query($query3)->result_array();
        if(!empty($result3)){
            return $result3;
        }

        // check in default
        $query4= "SELECT  pricelist_id, rule_type, movetype,dates,no_of_trucks,no_of_movers,travel_fee,client_hour_rate,
        states
        FROM  `pricelist`
        WHERE
        `movetype` = " .  $movetype . " AND `no_of_trucks` = " . $result1[0]['mt_no_of_trucks'] . " AND `no_of_movers` = " . $result1[0]['no_movers'] . " AND days_range REGEXP '".$day."' AND  `rule_type` = 1 AND status = 1 ";

        $result4 = $this->db->query($query4)->result_array();
        return $result4;

    }

    public function getDayFromDate($date){
        return date('w', strtotime($date));
    }
    
    public function getPackingRules($data){
        $day = $this->getDayFromDate($data['datepicker']);
        $query1="select rule_type, movetype, per_person_packing_rate 
        from pricelist
        where states REGEXP '". $data['state'] ."' AND pricelist.dates REGEXP '" . $data['datepicker'] . "' and  status = 1 and rule_type = 5 and movetype = ". $data['moveType'];

        $result1=$this->db->query($query1)->result_array();
        if(!empty($result1)){
            return $result1;
        }

        $query2="select rule_type, movetype, per_person_packing_rate 
        from pricelist
        where states REGEXP '". $data['state'] ."' AND days_range REGEXP ".$day." and  status = 1 and rule_type = 4 
        and movetype = ". $data['moveType'];

        $result2 = $this->db->query($query2)->result_array();
        if(!empty($result2)){
            return $result2;
        }
    }
}
