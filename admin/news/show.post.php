<?php 
	require "../../frame.php";
	$db = get_db();
	
	$strsql='update smg_news_show set days='.$_POST['days']; 
	$record = $db->execute($strsql);
	


	
?>