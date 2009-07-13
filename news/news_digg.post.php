<?php
    require_once('../frame.php');
	$ip=getenv('REMOTE_ADDR');
	$type=$_REQUEST['type'];
	$commentid=$_REQUEST['comment_id'];
	$sql="insert into smg_comment_digg(ip,type,comment_id) values('".$ip."','".$type."',".$commentid.")";
	$db = get_db();
	if($db->execute($sql))
	{
		echo 'OK';
	}
	else
	{
		echo 'error';
	}
?>
