<?php  
	require_once('../../frame.php');
	$id=$_POST['id'];
	$db=get_db();
	$db->execute('update smg_wxh_question set flowernum=flowernum+1 where id='.$id);
?>