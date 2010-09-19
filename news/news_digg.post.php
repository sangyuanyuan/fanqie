<?php
  require_once('../frame.php');
	$ip=getenv('HTTP_X_FORWARDED_FOR');
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
		$type=$_REQUEST['type'];
		$commentid=$_REQUEST['comment_id'];
		$sql="insert into smg_digg(ip,type,diggtoid,file_type) values('".$ip."','".$type."',".$commentid.",'comment')";
		$db = get_db();
		if($db->execute($sql))
		{
	
		}
		else
		{
			echo 'error';
		}
	}
?>
