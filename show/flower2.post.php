<?php
    require_once('../frame.php');
	
	//var_dump($_POST);
	if(date('Y-m-d')!="2010-09-18"){
		$comment = new table_class('smg_comment');
		if($_POST['flower_name']!=''){
			$comment->nick_name = $_POST['flower_name'];
		}else{
			$comment->nick_name = '匿名用户';
		}
		
		$comment->comment = $_POST['flower_omment'];
		$comment->resource_type = 'vote_flower';
		$comment->resource_id = $_POST['id'];
		$comment->created_at = date("Y-m-d H:i:s");
		$comment->ip = $_SERVER['REMOTE_ADDR'];
		$comment->save();
		redirect('/show/vote_jiang.php');
	}
	else
	{
		alert('对不起今天关闭一切提交！');	
	}
?>

