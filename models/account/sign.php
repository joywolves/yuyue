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

#插入帐号记录
function insert_account_record($data){
	$db = DB::getInstance();
	$ret = $db->insert(DB_NAME,TB_USER,$data);
	return $ret;
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
if($account != NULL){
	echo '{"code":-4}';
	return;
}
//TODO need check $_GET
insert_account_record($_GET);
echo '{"code":1}';
