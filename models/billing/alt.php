<?php 

require_once '../DB.php';


if(!isset($_GET["id"])){
	die("not record id");
}
$cond = array();
$cond["id"] = $_GET["id"];

//1:agree 2:disagree
if(!isset($_GET["statue"])){
	die("not statue to set");
}

$change = array();
$change["statue"] = $_GET["statue"];

$db = DB::getInstance();

$ret = $db->update(DB_NAME,TB_BILLING,$change,$cond);

echo $ret;