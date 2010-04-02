<?php 
	require_once('../frame.php');
	$db=get_db();
	$db->execute('update zd_question set show_index=0');
	$db->execute('update zd_question set show_index=1 where id='.$_POST['id']);
	echo "OK";
?>