<?php


/**
 +-----------------------------------------------------------------------------+
 * THChat�����ļ�		|LoginOut.PHP|	�û��˳�ģ��
 +-----------------------------------------------------------------------------+
 * @copyright  Copyright (c) 2007 www.zzye.com.cn  All rights reserved. 
 * @author     Cupdir <Cupdir@gmail.com>
 * @version    1.0
 +-----------------------------------------------------------------------------+
 */





#-----------------------------------------------+
//|����ȫ�ֱ��������|dirname|�����õ���ǰ·��|
#-----------------------------------------------+
include_once(dirname(__FILE__).'/./global.php'); 
#-----------------------------------------------+


if(isset($_GET['do']) && trim($_GET['do']) == "out")
{
	
	@setcookie("Chat_Login_State","",time()-3600);
	@setcookie("Chat_Login_ID","",time()-3600);
	@setcookie("Chat_Login_Name","",time()-3600);
	@setcookie("Chat_Login_Pwd","",time()-3600);
	@setcookie("Chat_Last_Logintime","",time()-3600);
	@setcookie("Chat_Last_Loginip","",time()-3600);
	@setcookie("Chat_This_LoginTime","",time()-3600);
	@setcookie("Jump_This_Url","",time()-3600);
	
	header("location:".$_SERVER['HTTP_REFERER']);
	
	die();
	
}