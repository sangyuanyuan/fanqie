<?php
    require_once('../../frame.php');
	
	//var_dump($_POST);
	$comment = new table_class('smg_comment');
	if($_POST['name']!=''){
		$comment->nick_name = $_POST['name'];
	}else{
		$comment->nick_name = '匿名用户';
	}
	
	$comment->comment = $_POST['comment'];
	$comment->resource_type = 'wxh2';
	$comment->resource_id = 0;
	$comment->created_at = date("Y-m-d H:i:s");
	$comment->ip = $_SERVER['REMOTE_ADDR'];
	$comment->save();
	alert('提交成功！');
	redirect('index.php');
?>


