<?php 
	require_once('../frame.php');
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
		$question = new table_class('zd_answer');
		if($_POST['name']!=''){
			$question->publisher = $_POST['name'];
		}else{
			$question->publisher = '匿名';
		}
		$question->question_id = $_POST['qid'];
		$question->content = $_POST['acontent'];
		$question->created_at = date("Y-m-d H:i:s");
		$question->ip = $_SERVER['REMOTE_ADDR'];
		$question->save();
		$_SESSION['url']="";
		echo "OK";
	}
	else
	{
		die('请从正常入口进入提交页面！');	
	}
?>