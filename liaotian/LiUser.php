<?php


/**
 +-----------------------------------------------------------------------------+
 * THChat公共文件		|LiUser.PHP|	用户列表箱子| |常量ONLINE控制显示条数|
 +-----------------------------------------------------------------------------+
 * @copyright  Copyright (c) 2007 www.zzye.com.cn  All rights reserved. 
 * @author     Cupdir <Cupdir@gmail.com>
 * @version    1.0
 +-----------------------------------------------------------------------------+
 */



#-----------------------------------------------+
//|加载全局变量及类库|dirname|函数得到当前路径|
#-----------------------------------------------+
include_once(dirname(__FILE__).'/./global.php'); 
#-----------------------------------------------+


#---------------------------------------------------------------+
//创建一个登陆对象LiUser()方法,引用|LIB|UserInfo_Class.PHP类
#---------------------------------------------------------------+
$user	=		new UserInfo_Class();
$user	->		LiUser(ONLINE);
#---------------------------------------------------------------+
?>

