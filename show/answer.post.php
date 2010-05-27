<?php
	require_once('../frame.php');
	$ip=$_SERVER['REMOTE_ADDR'];
	if($_POST['type']=='replay'){
		$question = new table_class('smg_show_answer');
		$question ->update_attributes($_POST['post'],false);
		$question->created_at=date("Y-m-d H-i-s");
		$question->ip=$ip;
		$question->save();
		alert('回答已提交！');
		redirect('article.php?id='.$_POST['post']['news_id']);
	}
	else if($_POST['type']=='del')
	{
		$db=get_db();
		$sql="delete from smg_show_answer where question_id=".$_POST['id'];
		$db->execute($sql);
		$sql="delete from smg_show_question where id=".$_POST['id'];
		$db->execute($sql);
		echo '删除成功！';
	}
?>