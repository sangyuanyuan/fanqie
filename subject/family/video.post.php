<?php 
	require "../frame.php";
	$db=get_db();
	$db->execute('update smg_video set flower=flower+1 where id='.$_POST['id']);
	echo 'OK';
?>