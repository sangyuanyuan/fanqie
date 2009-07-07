<?php 
	require "../../frame.php";
	//var_dump($_POST);
	$news = new table_class('smg_news');
	$news->update_attribuites($_POST['news'],false);
	var_dump($news);
?>