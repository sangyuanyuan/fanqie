<?php


/**
 +-----------------------------------------------------------------------------+
 * THChat�����ļ� 	|UserInfo_Class.PHP| �û�������
 +-----------------------------------------------------------------------------+
 * @copyright  Copyright (c) 2007 www.zzye.com.cn  All rights reserved. 
 * @author     Cupdir <Cupdir@gmail.com>
 * @version    1.0
 +-----------------------------------------------------------------------------+
 */

#------------------------------------------------------------------------------+
#			--��ֹ��������--
#------------------------------------------------------------------------------+
if(!defined("CUPDIR")){
	die("Access Denied!");
}
#------------------------------------------------------------------------------+





#------------------------------------------------------------------------------+
#		�������Ա���ԣ�|�û����췽��|�û��б���|��ֹ��½����|��ȡIP����|
#					  |Cookie����|�û���½����|�û���½��Ϣ����|�û�ע��
#------------------------------------------------------------------------------+

#��Ա����
Class UserInfo_Class
{	
	private $ID;
	private $Username;
	private $Password;
	private $State;
	private $LineTime;
	

function __construct($Username='',$Password='',$State=0,$LineTime='null')
{
		
				$this->Username	= $Username;
				$this->Password	= $Password;
				$this->State	= (INT)$State;
				$this->LineTime	= $LineTime;							
}
#��ʾ�û��б���
function LiUser($num='')
{
		global $DB;
		$P = $DB->query("SELECT Username,State FROM info LIMIT {$num}");
		UserInfo_Class::Nologin();
		while($R = $DB->fetch_array($P))
		{
			echo "<li>";
			$un=$R["Username"];
			$s= "<b onclick=mtowho('".$un."');>".$R['Username']."</b>";
			echo $s;
			if( $_COOKIE['Chat_Login_State'] == 1)
			{
			echo "<font color='#F7F7F7'>--����</font>";
			}else 
			{
			echo "<font color='#000000'>--����</font>";
			}
			echo "</li>";
		}
}

function Nologin($error)
{
	if(empty($_COOKIE['Chat_Login_Name']))
		{
			
			echo "<br>";
			echo "<a href=\"index.html\"><center>$error<center></a>";
			die();
			
		}	
	
}

function GetRealClientIP()
{
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip_real = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
		$ip_real = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
		$ip_real = getenv("REMOTE_ADDR");
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
		$ip_real = $_SERVER['REMOTE_ADDR'];
	else
		$ip_real = "unknown";

	$ip_arr = explode(",",$ip_real);
	
	if( empty($ip_arr[1]) )
		$client_ip = trim($ip_arr[0]);
	else
		$client_ip = trim($ip_arr[1]);
	
	return($client_ip);
}

private function Cookie()
{
	$Login_User	=	$_COOKIE['Chat_Login_Name'];
	$Login_Time	=	Date('Y-m-d');
	$Login_IP	=	$_COOKIE['Chat_This_LoginIP'];
	
	UserInfo_Class::Nologin();
	echo "<div align=center id='font'><li>���ѳɹ���¼ ^_^</font></li></div>";
	echo "�û���:".$Login_User."<br>";
	echo "ʱ��:".$Login_Time."<br>";
	echo "��½IP:".$Login_IP."<br>";
	
}

function UserLogin($Username,$Password)
{
			 global $DB;
			 $this->Username	=	$Username;
			 $this->Password	=	$Password;
			 
	If(empty($this->Username) || empty($this->Password)) {
		die('error0');
	}
	
	$L = $DB->fetch_one_array("SELECT * FROM `info` WHERE LOWER(`Username`)=LOWER('".$this->Username."')");
	
	/**********************
	 if($L['Password'])
	{
		
		echo "������һ�";
	}else 
	{
		
		echo "�޼�¼��ע��";
	}
	************************/
	
	if(strtolower($L['Username']) == $this->Username && $L['Password'] == $this->Password)
	{
		if( $_COOKIE['Chat_Login_State'] == 1 )
			{
				die('error_r');
			}
			
			$UserIP		=	UserInfo_Class::GetRealClientIP();
			$login_salt = 	rand(1000,9999);
			@setcookie("Chat_Login_State","1",time()+86400);
			@setcookie("Jump_This_Url",'chat.html');
			@setcookie("Chat_Login_ID",$L['ID'],time()+86400);
			@setcookie("Chat_Login_Name",$L['Username'],time()+86400);
			@setcookie("Chat_Login_Pwd",md5($L['Password'].$login_salt),time()+86400);
			@setcookie("Chat_Last_Logintime",$L['LineTime'],time()+86400);
			@setcookie("Chat_Last_Loginip",$L['LoginIP'],time()+86400);
			@setcookie("Chat_This_LoginTime",time(),time()+86400);
			@setcookie("Chat_This_LoginIP",$UserIP,time()+86400);
			
			$info['State']		= (int)1;
			$info['LoginSalt'] 	= $login_salt;
			$info['LoginTime'] 	= Date('Y-m-d');
			$info['LoginIP'] 	= $UserIP;
			$info['LoginCount'] = array('`LoginCount`+1');
			
			$DB->query($DB->update_sql("`info`",$info,"`ID`='".$L['ID']."'"));
			
			if(isset($_COOKIE['Jump_This_Url']) && !empty($_COOKIE['Jump_This_Url']))
			{
				die('jump');
			}else 
			{
				die('ok');
			}
			
		}
		else
		{	
			die('error2');
		}
		die('no');
	
	
	
}

function UserReg($RegName,$RegPass,$new_user_open)
{
	
	global $DB;
	if($new_user_open == '0') {
		die("��ǰϵͳ��ֹ���û�ע��");
	}
	if(empty($RegName) || empty($RegPass)) {
		die("���ע����Ϣ��д������");
	}
	if( strlen($RegName) > 10 || strlen($RegName) < 3 ) {
		die("�û������Ȳ��Ϸ� -_-");
	}
	if( strlen($RegPass) < 6 || strlen($RegPass) > 18 ) {
		die("���볤��Ӧ�ô���6С��18 -_-");
	}
	foreach( array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#','.') as $value ){
		if (strpos($RegName,$value) !== false){
			die("�û������зǷ��ַ� -_-");
		}
	}

	if($DB->fetch_one("SELECT count(*) FROM `info` WHERE LOWER(`Username`)=LOWER('".$RegName."')") != 0) {
		die("�û����Ѵ��ڣ�");
	}
	
	$info['Username'] 	= $RegName;
	$info['Password'] 	= md5($RegPass);
	$info['Regtime'] 	= time();
	$info['State']		= 0;
	
	if($DB->query($DB->insert_sql("`info`",$info))) {
		die('OK');
		}else{
			die("ע��ʧ�ܣ����������Ƿ���ȷ ^_^");
	}
}

function User_Info() {	
		UserInfo_Class::Cookie();
	}
}
