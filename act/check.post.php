<?php
	require "../frame.php";
	$loginname=$_REQUEST['loginname'];
	$actid=$_REQUEST['actid'];
	$db=get_db();
	$ckname=$db->query('select * from smg_user_real where loginname="'.$loginname.'"');
	$ckisdg=$db->query('select * from smg_activities_signup where name="'.$loginname.'" and activities_id='.$actid);
	$cknum=$db->query('select * from smg_activities_signup where activities_id='.$actid);
	if(count($ckisdg)>0)
	{
		$error=1;	
	}
	else if(count($cknum)==10)
	{
		$error=10;	
	}
	else if(count($ckname)==0)
	{
		$error="nobody";
	}
	else
	{
		$error="OK";	
	}
	echo $error;
?>