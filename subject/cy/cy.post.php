<?php 
	require "../../frame.php";
	
	$news = new table_class('smg_news_wycy');
	$news->update_attributes($_POST['cy'],false);
	$news->keywords = str_replace('　',' ',$news->keywords);
	$news->created_at = date("Y-m-d H:i:s");
	$news->save();		
	alert("提交成功！谢谢参与！");
	redirect('index.php');
?>