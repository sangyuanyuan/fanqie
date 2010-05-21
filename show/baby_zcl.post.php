<?php
    require_once('../frame.php');
	$id=$_REQUEST['id'];
	$sql="update smg_baby_vote zcl=zcl+1 where id=".$id;
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