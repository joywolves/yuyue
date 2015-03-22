<?php

require_once '../DB.php';


function get_all(){
	$db = DB::getInstance();
	$ret = $db->find(DB_NAME,TB_BILLING,"*");
	return $ret;
}

function get_agree(){

}

function get_disagree(){

}

function get_not_handle(){
	$db = DB::getInstance();
	$ret = $db->find(DB_NAME,TB_BILLING,"*",array("statue"=>0));
	return $ret;
}
function get_user_billing(){
	$db = DB::getInstance();
	$ret = $db->find(DB_NAME,TB_BILLING,"*",array("user"=>$_GET["user"]));
	return $ret;
}
$ret = null;

switch($_GET["type"]){
	case 1:
		$ret = get_all();
		break;
	case 2:
		$ret = get_agree();
		break;
	case 3:
		$ret = get_disagree();
		break;
	case 4:
		$ret = get_not_handle();
		break;
	case 5:
		$ret = get_user_billing();
		break;
	default:
		die("error_type:".$_GET["type"]);
};

echo json_encode($ret);