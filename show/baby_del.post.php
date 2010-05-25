<?php
  require_once('../frame.php');
	$id=$_REQUEST['id'];
	$sql="delete from smg_baby_item where id=".$id;
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