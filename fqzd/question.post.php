<?php 
	require_once('../frame.php');
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
		$question = new table_class('zd_question');
		if($_POST['smg_uid']!=''){
			$question->publisher = $_POST['smg_uid'];
		}else{
			$question->publisher = '匿名';
		}
		$question->title = $_POST['qtitle'];
		$question->content = $_POST['qcontent'];
		$question->created_at = date("Y-m-d H:i:s");
		$question->ip = $_SERVER['REMOTE_ADDR'];
		$question->save();
		
		if($question->publier<>'匿名')
		{
			$db=get_db();
			$db->execute('update smg_user set zd_score=zd_score+5 where id='.$_POST['smg_uid']);
		}
		$_SESSION['url']="";
	}
	else
	{
		die('请从正常入口进入提交页面！');	
	}
?>