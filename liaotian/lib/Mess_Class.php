<?php


/**
 +-----------------------------------------------------------------------------+
 * THChat�����ļ� 	|Mess_Class.PHP| ��Ϣ������
 +-----------------------------------------------------------------------------+
 * @copyright  Copyright (c) 2007 www.zzye.com.cn  All rights reserved. 
 * @author     Cupdir <Cupdir@gmail.com>
 * @version    1.0
 +-----------------------------------------------------------------------------+
 */


#------------------------------------------------------------------------------+
#			--��ֹ��������--
#------------------------------------------------------------------------------+
if(!defined("CUPDIR"))
{
	die("Access Denied!");
}
#------------------------------------------------------------------------------+


#------------------------------------------------------------------------------+
#		�������Ա����
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
#		������Ϣ����
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
			echo "����ʧ��";
		}
		
	}	
#---------------------------------------------------------------------------------+	

	
#------------------------------------------------------------------------------+
#		��Ϣ���շ���
#------------------------------------------------------------------------------+
function MessBox()
	{
		global $DB;
		UserInfo_Class::Nologin('���ӷ�����ʧ��.������û�е�½');
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
				echo "<u onclick=mtowho('".$Who."');>".$Who."</U>��".$box['Mtowho']."˵:<font color=".$box['Mfcolor'].">".$box['Mess']."</font>"."<img src=./smilies/".$box['Elist'].">";
				echo "<br>";
			}
		
		return $box;
	}
}
#--------------------------------------------------------------------------------
?>