<?php
    require_once('../frame.php');
	$ip=getenv('REMOTE_ADDR');
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
?>
