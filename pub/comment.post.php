<?php 
	require "../frame.php";
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
		$comment = new table_class('smg_comment');
		$comment->update_attributes($_REQUEST['comment'],false);
		if(intval($_REQUEST['comment_id'])>0){
			$comment->id = intval($_REQUEST['comment_id']);
		}else if(intval($_REQUEST['id'])>0){
			$comment->id = intval($_REQUEST['id']);
		}
		if($comment->id <= 0){
			$comment->created_at = date("Y-m-d H:i:s");
			$comment->ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		if($comment->save()){
			echo $comment->id;
		}else{
			echo -1;
		}
	}else
	{
		die('请从网站入口提交！');	
	}
	
?>