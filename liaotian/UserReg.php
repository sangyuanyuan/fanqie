<?php


/**
 +-----------------------------------------------------------------------------+
 * THChat�����ļ�		|UserReg.PHP|	�û�ע��ģ��
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


#---------------------------------------------------------------+
//����һ��ע�����UserReg()����,����|LIB|UserInfo_Class.php��
#---------------------------------------------------------------+
$UserReg	=	new UserInfo_Class();
#---------------------------------------------------------------+

	#--------------------------------------------------------------+
	//addslashes|���������ǲ�ѯ���ݿ��еĵ����š�˫���š���б�ߡ�NULL �ַ�|
	//strtolower|���������ǽ���д�ַ���ת��ΪСд|
	#--------------------------------------------------------------+
	$RegName 	= addslashes(strtolower(trim($_POST['username'])));
	$RegPass 	= trim($_POST['password']);
	#--------------------------------------------------------------+

	
if(isset($_GET['do']) && trim($_GET['do']) == "reg"){
   
	
	$UserReg	-> 	UserReg($RegName,$RegPass,$new_user_open);

}

if(isset($_GET['do']) && trim($_GET['do']) == "user" ){
	
	$UserReg	->	Overuser($RegName);
}



	
	
	#---------------------------------------------------------------+