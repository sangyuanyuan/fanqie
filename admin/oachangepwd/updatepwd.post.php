﻿<?
require_once('../../frame.php');
 function reset_password($userid, $oldpwd, $newpwd, $type, $operatorid=null){
  	$operatorid = is_null($operatorid) ? $userid : $operatorid;
  	$client = new SoapClient("http://172.27.203.49/ssov1.0/changepassword.asmx?WSDL");
  	$ChangePasswordRequest = array("ApplicationId" => "2018", "TimeStamp" => "288701749051598","ChangeType" => $type,"UserId" => $userid, "OldPassword" => $oldpwd,"NewPassword" => $newpwd,"OperatorId" => $operatorid);
  	$result = $client->ChangePassword( $ChangePasswordRequest);
		return  $result->Result;
  }
 
$result=new table_class('smg_updatepwd');
$db = get_db();
$success=0;
	if($_POST['updatepwd']['username']==0)
	{
		alert("请登录以后再进入重置密码页面!");
		redirect('/login/');
	}
	$success=reset_password($_POST['updatepwd']['userid'], $_POST['updatepwd']['admin_password'], $_POST['updatepwd']['admin_password1'], 0);
	if($success==0)
	{
		
		$result->update_attributes($_POST['updatepwd']);
		$result->updateuserid=$cookie;
		$result->state =0;
		$result->createtime=date('Y-m-d');
		$result->save();
		$strsql='select * from smg_user where name="'.$_POST['updatepwd']['userid'].'"';
		if($db->query($strsql))
			$id=$db->field_by_name('id');
		$strsql='update smg_user set password="'.$_POST['updatepwd']['admin_password1'].'" where id='.$id;
		if($db->execute($strsql))
			die('密码更新成功！');;
	}
	else 
	{
		die('密码更新失败！');
	}
?>