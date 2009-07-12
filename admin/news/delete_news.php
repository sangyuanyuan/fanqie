<?php
	require "../../frame.php";
	$delete_news_id  = implode(',',$_POST['delete_news']);
	$back_news_id = implode(',',$_POST['back_news']);
	echo "delete:" .$delete_news_id .';back:' .$back_news_id;
	
	
?>