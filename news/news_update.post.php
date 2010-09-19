<?php
	require_once('../frame.php');
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
	  $newsid=$_REQUEST['newsid'];
		$sql="update smg_news set click_count=click_count+1 where id=".$newsid;
		$db = get_db();
		if($db->execute($sql))
		{
			
		}
		else
		{
			echo 'error';
		}
		$_SESSION['url']="";
	}
	else
	{
		die('请从网站入口提交！');	
	}
?>