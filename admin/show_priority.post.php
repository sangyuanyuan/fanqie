<?php 
	require "../frame.php";
	$db = get_db();
	
	$strsql='update smg_image_show set name='.$_POST['days'];
	$record = $db->execute($strsql);
	
?>