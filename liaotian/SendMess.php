<?php


/**
 +-----------------------------------------------------------------------------+
 * THChat公共文件		|SendMess.PHP|	信息发送操作
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
//创建一个登陆对象Mess()方法,引用|LIB|Mess_Class.php类
#---------------------------------------------------------------+
$Mess	=	new Mess_class();
$Mess	->	Mess();
#---------------------------------------------------------------+
?>