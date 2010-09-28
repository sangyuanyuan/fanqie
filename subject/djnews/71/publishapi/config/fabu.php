<?php

//调用OAS的获取当前登录会员信息, 默认为当前目录上层的oas目录, 如有变动路径请自行修改
$UserInfo = include_once("../oas/getuserinfo.php");

if(empty($UserInfo['UserName'])) {

	smsg("你未登陆本网站，不允许发布任何信息",$IN['referer']);

}
$IN['UserName'] = $UserInfo['UserName'];

function add_start(&$var) {	//新增操作预处理

	if(empty($var['Content']))

	smsg("<font color='#FF0000'>新增内容失败,因文新闻内容字段不能为空</font>",$var['referer']); //内容字段为空的话,提示失败,并结束执行返回
}



function add_end(&$var) { //新增操作后置处理

	smsg("新增内容成功,页面正在跳转中...",$var['referer']);  //显示新增成功,并返回,至此,新增操作已成功执行完成

}

function edit_start(&$var) {  //编辑操作预处理
	global $UserInfo,$db,$NodeInfo,$db_config;	//声明$UserInfo和$db等使用全局变量，这步是必要的，因为这些变量都是在函数外面声明的

	//根据传入的IndexID,得到该文件的作者,模型号是在index.php中获取的,表前缀是在主config.php中定义的
	if($NodeInfo['TableID'] == 1) {
	  //如果是新闻模型,则取Author字段
	  $sql=$db->getRow("SELECT Author FROM " .$db_config['table_pre']. "publish_" .$NodeInfo['TableID']. " WHERE IndexID='".$var['IndexID']."'");
	} else {
	  //如果是另外的模型,则取UserName字段
	  $sql=$db->getRow("SELECT UserName FROM " .$db_config['table_pre']. "publish_" .$NodeInfo['TableID']. " WHERE IndexID='".$var['IndexID']."'");
	}
	/*如果编辑前文章的作者跟现在编辑的作者不同,则编辑失败.    
	注意: 新闻模型中的作者字段是Author,而供求模型的作者字段是UserName, 为了方便就一起判断了*/

	if($sql['UserName'] != $UserInfo['UserName']  and  $sql['Author'] != $UserInfo['UserName']) {

		smsg("<font color='#ff0000'>编辑失败,你无权限修改本文章</font>",$var['referer']);

	}


}

function edit_end(&$var) {  //编辑操作后置处理

	smsg("编辑内容已成功执行,页面正在跳转",$var['referer']);

}

function del_start(&$var) {  //删除操作预处理

	global $UserInfo,$db,$NodeInfo,$db_config;	//声明$UserInfo和$db等使用全局变量，这步是必要的，因为这些变量都是在函数外面声明的

	if($NodeInfo['TableID'] == 1) {
	  //如果是新闻模型,则取Author字段
	  $sql=$db->getRow("SELECT Author FROM " .$db_config['table_pre']. "publish_" .$NodeInfo['TableID']. " WHERE IndexID='".$var['IndexID']."'");
	} else {
	  //如果是另外的模型,则取UserName字段
	  $sql=$db->getRow("SELECT UserName FROM " .$db_config['table_pre']. "publish_" .$NodeInfo['TableID']. " WHERE IndexID='".$var['IndexID']."'");
	}

	//如果编辑前文章的作者跟现在编辑的作者不同,则编辑失败
	//注意: 新闻模型中的作者字段是Author,而供求模型的作者字段是UserName, 为了方便就一起判断了

	if($sql['UserName'] != $UserInfo['UserName']  and  $sql['Author'] != $UserInfo['UserName']) {

		smsg("<font color='#ff0000'>删除失败,你无权限删除本文章</font>{$sql['Author']}|{$sql['UserName']}|{$UserInfo['UserName']}|{$NodeInfo['TableID']}",$var['referer']);

	}


}

function del_end(&$var) {  //删除操作后置处理


	smsg("内容已被正功删除,页面正在跳转",$var['referer']);

}

?>