<?php
	require "../../frame.php";
	$db = get_db();
	if($_POST['delete_news']){
		$delete_news_id  = implode(',',$_POST['delete_news']);
		$sql = 'delete from smg_news where id in(' .$delete_news_id .')';
		$db->execute($sql);
	}
	if($_POST['back_news']){
		$back_news_id = implode(',',$_POST['back_news']);	
		$sql = 'update smg_news set is_recommend=2, is_adopt=0 where id in(' .$back_news_id .')';
		$db->execute($sql);		
	}
	
	
	
?>