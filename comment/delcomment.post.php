<?php
	require "../frame.php";
	$db=get_db();
	$db->execute('delete from smg_comment where id='.$_POST['id']);
	
?>