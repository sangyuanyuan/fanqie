<?php 
	require "../frame.php";
	$db = get_db();
	
	$strsql='update smg_news_head_ctrl set state='.$_POST['zhibo'].',created_at=now()'; 
	$record = $db->execute($strsql);

?>