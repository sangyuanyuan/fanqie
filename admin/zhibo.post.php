<?php 
	require "../frame.php";
	$db = get_db();
	
	$strsql='update smg_zhibo_ctrl set state='.$_POST['zhibo']; 
	$record = $db->execute($strsql);
	


	
?>