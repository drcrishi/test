<?php

function response(){
	return new ResponseController();
}

function dd($var){
	echo "<pre>";
	var_dump($var);
	echo "<pre>";
	exit;
}