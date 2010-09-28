<?php
$UserInfo = include_once("../../oas/getuserinfo.php");	//将OAS中的getuserinfo.php包含执行后得到当前登陆用户信息返回值
if(empty($UserInfo['UserName'])) {
	smsg("你未登陆本网站，不允许发布任何信息",$IN['referer']);
} else {
	//print_r($UserInfo);
}

function add_start(&$var) {
	global $UserInfo,$db,$NodeInfo,$db_config;	//声明$UserInfo和$db等使用全局变量，这步是必要的，因为这些变量都是在函数外面声明的
	if($UserInfo['UserName'] != '技术幻想' && $UserInfo['UserName'] != 'easyT') {
		gback("您没有权限发布文章！");	//如果当前登陆用户名不是技术幻想也不是easyT，则不允许新增文章
	} else {
		$var['Author'] = $UserInfo['UserName'];	//否则将文章作者置为当前登陆用户名
	}
	if($_SERVER['REMOTE_ADDR'] != "127.0.0.1") gback("操作禁止!");  //如果用户的IP不等于127.0.0.1,则警告返回
}
function add_end(&$var) {
	refresh_index(1);	//发布结束，刷新1号结点首页
	smsg("发布成功，页面正在跳转中...",$var['referer']);
}

function edit_start(&$var) {
	global $UserInfo,$db,$NodeInfo,$db_config;	//声明$UserInfo和$db等使用全局变量，这步是必要的，因为这些变量都是在函数外面声明的
	//根据传入的IndexID,得到该文件的作者,模型号是在index.php中获取的,表前缀是在主config.php中定义的
	$sql = $db->getRow("SELECT Author FROM " .$db_config['table_pre']. "publish_" .$NodeInfo['TableID']. " WHERE IndexID='{$var['IndexID']}'");	
	if($sql['Author'] != $UserInfo['UserName']) {
		gback("您没有权限编辑本文章！");	//如果当前登陆用户试图编辑不是自己发布的文章时，直接gback.
	}
	if($_SERVER['REMOTE_ADDR'] != "127.0.0.1") gback("操作禁止!");  //如果用户的IP不等于127.0.0.1,则警告返回
}
function del_start(&$var) {
	gback("不允许删除已发布的文章"); //执行删除操作时，直接gback
}
?>