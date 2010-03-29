<?php 
	require_once('../frame.php');
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
	echo "OK";
?>