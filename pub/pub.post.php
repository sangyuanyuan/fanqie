<?php
	require_once('../frame.php');
	
	
   	if($_POST['type']=='comment'){
   		$comment = new table_class('smg_comment');
		$comment->nick_name = $_POST['commenter'];
		$comment->comment = $_POST['content'];
		$comment->resource_id = $_POST['resource_id'];
		$comment->resource_type = $_POST['resource_type'];
		$comment->created_at = date("Y-m-d H-i-s");
		$comment -> save();
   	}
?>