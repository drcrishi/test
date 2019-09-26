<?php 

/*
	Name:- DB helper (Codeigniter)
	Author :- Rishi Ezhava
	Date :- 27-07-19 
*/


/*
	Get all records of a single table
	--------------------------
	$table : 			String -> Required => name of the table 
*/
function getAllRecords($table){
	 $CI = & get_instance();
	 return $CI->db->get($table)->result_array();
}


/*
	Get records with where and not where conditions from a single table
	--------------------------
	$table : 			String -> Required => name of the table 
	$selectFields : 	Array -> Optional => fields you want to select
	$whereArray : 		Array -> Required => where condition to be fulfilled
	$notWhereArray : 	Array -> Optional => where not conditions to be fulfilled
*/
function getAllFieldsWithWhere($table,$selectFields= array(), $whereArray, $notWhereArray = array()){
	$CI = & get_instance();

	if(!empty($selectFields)){
		$selectString = implode(',', $selectFields);
		$CI->db->select($selectString);
	}
	foreach ($whereArray as $wKey => $wValue) {
		$CI->db->where($wKey,$wValue);
	}
	if(!empty($notWhereArray)){
		foreach ($notWhereArray as $nwKey => $nwValue) {
			$CI->db->where($nwKey.'!=',$nwValue);
		}	
	}
	return $CI->db->get($table)->result_array();
}


/*
	Get number of records with where and not where conditions from a single table
	--------------------------
	$table 	: 			String -> Required => name of the table 
	$whereArray : 		Array -> Required => where condition to be fulfilled
	$notWhereArray : 	Array -> Optional => where not conditions to be fulfilled
*/
function getCount($table, $whereArray=array(), $notWhereArray = array()){
	$CI = & get_instance();
	if(!empty($whereArray)){
		foreach ($whereArray as $wKey => $wValue) {
			$CI->db->where($wKey,$wValue);
		}
	}
	if(!empty($notWhereArray)){
		foreach ($notWhereArray as $nwKey => $nwValue) {
			$CI->db->where($nwKey.'!=',$nwValue);
		}
	}
	$res = $CI->db->get($table)->result_array();
	if(!empty($res)){
		return count($res);
	}
	else{
		return '0';
	}
}


/*
	Print the last query
*/

function lq(){
	$CI = & get_instance();
	echo $CI->db->last_query();
}


/*
	Get last inserted id
*/
function lId(){
	$CI = & get_instance();
	return $CI->db->insert_id();
}



?>