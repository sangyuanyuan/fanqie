<?php
	include "../../frame.php";
	$user_id = $_POST['id'];
	$sql = "update smg_user set role_name='member' where id=$user_id";
	$db = get_db();
	$db->execute($sql);
?>