<?php

require_once '../DB.php';

#获取帐号数据
function find_user_record($id){
	$db = DB::getInstance();
	$ret = $db->find(DB_NAME,TB_USER,"*",array("id"=>$id));
	if(sizeof($ret)){
		return $ret[0];
	}
	return NULL;
}

$json_data = file_get_contents("php://input");
$data = json_decode($json_data,true);

$account = find_user_record($data["user"]);
if($account == null){
	echo -1;
	return;
}

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
$record["user"] = $data["user"];
$record["date"] = time();
$record["name"] = $account["name"];
$db = DB::getInstance();

$ret = $db->insert(DB_NAME,TB_BILLING,$record);

echo $ret;