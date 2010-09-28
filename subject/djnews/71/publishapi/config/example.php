<?php

$IN['Top'] = 2;  //所有应用该配置文件的操作都将会自动将置顶值设为2.
$IN['Title'] = "来自前台:".$IN['Title']	//所有应用该配置文件的操作都将会自动在标题前加上"来自前台:"的字符.

function add_start(&$var) {	//新增操作预处理
	if(empty($var['Content']))
	smsg("<font color='#FF0000'>新增内容失败,因文新闻内容字段不能为空</font>",$var['referer']); //内容字段为空的话,提示失败,并结束执行返回

	if($var['Author'] == "AT") $var['Author'] = "技术幻想"; //如果作者为AT,则将作者重置为技术幻想

	if(strlen($var['Keywords']) < 3) gback("关键字字符数太少!"); //如果关键字字符数少于3,则警告并返回

	if($_SERVER['REMOTE_ADDR'] != "127.0.0.1") gback("操作禁止!");  //如果用户的IP不等于127.0.0.1,则警告返回

	$var['TitleColor'] = "#FF0000";  //所有新增的文章都使标题颜色为红色
}

function add_end(&$var) { //新增操作后置处理
	refresh_index(1);   //刷新结点ID为1的首页
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

	/*如果最后修改时间跟现在时间差小于60秒钟,则编辑失败*/
	if(time() - $sql['ModifiedDate'] < 60) gback("不要无节制的修改相同文章");

	if($_SERVER['REMOTE_ADDR'] != "127.0.0.1") gback("操作禁止!");  //如果用户的IP不等于127.0.0.1,则警告返回
	
	unset($var['PublishDate'],$var['Editor']);  //将发布时间和编辑人员保持不变(意思是不允许更改这两个字段的值)
}

function edit_end(&$var) {  //编辑操作后置处理
	smsg("编辑内容已成功执行,页面正在跳转",$var['referer']);
}

function del_start(&$var) {  //删除操作预处理
	if($_SERVER['REMOTE_ADDR'] != "127.0.0.1") gback("操作禁止!");  //如果用户的IP不等于127.0.0.1,则警告返回
}

function del_end(&$var) {  //删除操作后置处理
	refresh_index(1);   //刷新结点ID为1的首页
	refresh_index(2);   //刷新结点ID为2的首页
	refresh_index(3);   //刷新结点ID为3的首页
	smsg("内容已被正功删除,页面正在跳转",$var['referer']);
}
?>