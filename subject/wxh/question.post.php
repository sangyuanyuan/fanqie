<?php
    require_once('../../frame.php');
	
	//var_dump($_POST);
	$comment = new table_class('smg_wxh_question');
	if($_POST['name']!=''){
		$comment->nick_name = $_POST['name'];
	}else{
		$comment->nick_name = '匿名用户';
	}
	
	$comment->content = $_POST['content'];
	$comment->title=$_POST['title'];
	$comment->created_at = date("Y-m-d H:i:s");
	$comment->ip = $_SERVER['REMOTE_ADDR'];
	$comment->jd=2;
	$comment->priority=0;
	$comment->save();
	alert('提交成功！');
	redirect('index.php');
?>