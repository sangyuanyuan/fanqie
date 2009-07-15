<?php
	require_once('../frame.php');
	
	
   	if($_POST['type']=='comment'){
   		$comment = new table_class('smg_comment');
		$comment ->update_attributes($_POST['post'],false);
		$table_change = array('<p>'=>'');
		$table_change += array('</p>'=>'');
		$comment->comment = strtr($comment->comment,$table_change);
		$comment->created_at = date("Y-m-d H-i-s");
		if($comment->nick_name==''){
			$comment->nick_name = '匿名用户';
		}
		$comment -> save();
		redirect($_POST['target_url']);
   	}
?>