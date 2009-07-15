<?php 
	require "../frame.php";
	$comment = new table_class('smg_comment');
	$comment->update_attributes($_REQUEST['comment'],false);
	if(intval($_REQUEST['comment_id'])>0){
		$comment->id = intval($_REQUEST['comment_id']);
	}else if(intval($_REQUEST['id'])>0){
		$comment->id = intval($_REQUEST['id']);
	}
	
	if($comment->save()){
		echo $comment->id;
	}else{
		echo -1;
	}
	
?>