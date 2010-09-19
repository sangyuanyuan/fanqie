<?php
	require "../frame.php";
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
		$db=get_db();
		$db->execute('delete from smg_comment where id='.$_POST['id']);
		$_SESSION['url']="";
	}
	else
	{
		die('请从正常入口进入提交页面！');	
	}
?>