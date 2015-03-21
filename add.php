<?php

require_once './DB.php';


$json_data = file_get_contents("php://input");
$data = json_decode($json_data,true);

$keys = array(
	"phone","money", "address"
	);

$record = array();

foreach($keys as $key){
	if(!isset($data[$key])){
		die("keys is null:".$key);
	}
	$record[$key] = $data[$key];
}

$record["code"] = uniqid();  
$record["statue"] = 0;

$db = DB::getInstance();

$ret = $db->insert(DB_NAME,TB_BILLING,$record);

echo $ret;