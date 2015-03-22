<?php

require_once '../DB.php';

#获取帐号数据
function find_account_record($account){
	$db = DB::getInstance();
	$ret = $db->find(DB_NAME,TB_USER,"*",array("account"=>$account));
	if(sizeof($ret)){
		return $ret[0];
	}
	return NULL;
}

#检查参数
if(!isset($_GET["account"]) || !isset($_GET["pass"])){
	echo '{"code":-1}';
	return;
}

#帐号4-16
if(!preg_match("/^[a-zA-Z][\w\d_]{3,15}$/",$_GET["account"])){
	echo '{"code":-2}';
	return;
}

#密码6-20
if(!preg_match("/^[\w\d_]{6,20}$/",$_GET["pass"])){
	echo '{"code":-3}';
	return;
}

#查看数据
$account = find_account_record($_GET["account"]);
if($account == NULL){
	echo '{"code":-4}';
	return;
}
#检查密码
if($account["pass"] != ($_GET["pass"])){
	echo '{"code":-5}';
	return;
}
//not useful why???
setcookie("user",$account["id"]);

$ret = array();
$ret["code"] = 1;
$ret["user"] = $account["id"];
if($account["type"] == 1){
	$ret["url"] = "show.html";
}else{
	$ret["url"] = "handle.html";
}
echo json_encode($ret);

