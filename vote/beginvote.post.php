<?php
	require "../frame.php";
if(date('Y-m-d')!="2010-09-18"){
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
		$vote = new table_class('smg_vote');
		$vote -> update_attributes($_POST['vote'],false);
		$vote ->vote_type = 'word_vote';
		$vote->created_at = date("Y-m-d H:i:s");
		$vote->limit_type = 'ip';
		$vote->category_id = 0;
		$vote->is_app=1;
		$vote->is_adopt = 1;
		$vote->save();
		
		if($_POST['item']){
			foreach($_POST['item'] as $v){
				$item = new table_class('smg_vote_item');
				$item->title = $v[name];
				$item->vote_id = $vote->id;
				$item -> save();
			}
		}
		
		alert('上传成功！谢谢参与！');
		redirect('vote_list.php');
	}
	else
	{
		die('请从网站入口提交！');	
	}
}
	else
	{
		alert('对不起今天关闭一切提交！');	
	}
?>