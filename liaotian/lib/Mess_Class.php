<?php


/**
 +-----------------------------------------------------------------------------+
 * THChat公共文件 	|Mess_Class.PHP| 消息处理类
 +-----------------------------------------------------------------------------+
 * @copyright  Copyright (c) 2007 www.zzye.com.cn  All rights reserved. 
 * @author     Cupdir <Cupdir@gmail.com>
 * @version    1.0
 +-----------------------------------------------------------------------------+
 */


#------------------------------------------------------------------------------+
#			--禁止单独调用--
#------------------------------------------------------------------------------+
if(!defined("CUPDIR"))
{
	die("Access Denied!");
}
#------------------------------------------------------------------------------+


#------------------------------------------------------------------------------+
#		定义类成员属性
#------------------------------------------------------------------------------+
class Mess_class
{
	
	var 	$ID;
	var 	$Mess;
	var 	$Mtowho;
	var		$Mfont;
	var 	$Mfcolor;
	var 	$Elist;
	var 	$Strtime;
#------------------------------------------------------------------------------+




#------------------------------------------------------------------------------+
#		发送消息方法
#------------------------------------------------------------------------------+	
function Mess()
	{
		global $DB;
		UserInfo_Class::Nologin();
		$info = array(
		'ID'		=>$this->ID			=	'null',
		'Mess'		=>$this->Mess		=	$_GET['mess'],	
		'Mtowho'	=>$this->Mtowho		=	$_GET['mtowho'],
		'Mfont'		=>$this->Mfont		=	$_GET['mfont'],
		'Mfcolor'	=>$this->Mfcolor	=	$_GET['mfcolor'],
		'Elist'		=>$this->Elist		=	$_GET['elist'],
		'Strtime'	=>$this->Strtime	=	$_GET['strTime'],	
		);

		if($DB->query($DB->insert_sql('mess',$info)))
		{
			$instid = $DB->insert_id();
			echo $instid;
		}
		else 
		{
			echo "插入失败";
		}
		
	}	
#---------------------------------------------------------------------------------+	

	
#------------------------------------------------------------------------------+
#		消息接收方法
#------------------------------------------------------------------------------+
function MessBox()
	{
		global $DB;
		UserInfo_Class::Nologin('连接服务器失败.可能您没有登陆');
		$strtime		= $_GET['strTime'];
		$Mess_Box	 	= "SELECT DISTINCT Mess,Mtowho,Mfont,Mfcolor,Elist FROM mess  BY" .$strtime;
		$result 		= $DB->query($Mess_Box);

		while($Re = $DB->fetch_array($result))
			{
				$box = array(
						'Mess'		=>	$Re['Mess'],
						'Mtowho'	=>	$Re['Mtowho'],
						'Mfont'		=>	$Re['Mfont'],
						'Mfcolor'	=>	$Re['Mfcolor'],
						'Elist'		=>	$Re['Elist']
						);
				$Who	=	$_COOKIE['Chat_Login_Name'];
				echo "<u onclick=mtowho('".$Who."');>".$Who."</U>对".$box['Mtowho']."说:<font color=".$box['Mfcolor'].">".$box['Mess']."</font>"."<img src=./smilies/".$box['Elist'].">";
				echo "<br>";
			}
		
		return $box;
	}
}
#--------------------------------------------------------------------------------
?>