<?
require_once('../../frame.php');
include('.../../login/uc_client/config.inc.php');
include('../../login/uc_client/client.php');

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
	if($_POST['subtype']=="updatepwd")
	{
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
			/*$strsql='select * from smg_user where name="'.$_POST['updatepwd']['userid'].'"';
			if($db->query($strsql))
				$id=$db->field_by_name('id');*/
			$ucresult = uc_user_edit($_POST['updatepwd']['userid'], $_POST['updatepwd']['admin_password'], $_POST['updatepwd']['admin_password1']);
			//$strsql='update smg_user set password="'.$_POST['updatepwd']['admin_password1'].'" where id='.$id;
			if($ucresult==1)
				alert("密码更新成功！");
			redirect('changepwd.php');
		}
		else 
		{
			alert("更新密码失败！");
			redirect('changepwd.php');
		}
		
	}
	if($_POST['subtype']=="resetpwd")
	{
		$success=reset_password($_POST['updatepwd']['userid'],'Password@1','Password@1',1,$_POST['updatepwd']['username']);
		if($success==0)
		{
			$result->update_attributes($_POST['updatepwd']);
			$result->updateuserid=$cookie;
			$result->state =1;
			$result->createtime=date('Y-m-d');
			$result->save();
			/*$strsql='select * from smg_user where name="'.$_POST['updatepwd']['userid'].'"';
			if($db->query($strsql))
			{
				$id=$db->field_by_name('id');
			}
			$strsql='update smg_user set password="Password@1" where id='.$id;*/
			$ucresult = uc_user_edit($_POST['updatepwd']['userid'], $_POST['updatepwd']['admin_password'], 'Password@1');
			if($ucresult==1)
				alert("密码重置成功！");
			redirect('resetpwd.php');
		}
		else 
		{
			alert("更新密码失败！");
			redirect('resetpwd.php');
		}
	}
redirect('/');
?>