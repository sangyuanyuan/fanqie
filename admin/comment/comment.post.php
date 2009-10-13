<?php
    require_once('../../frame.php');
	if($_POST['post_type']=="del"){
		$db = get_db();
		$sql = "insert into smg_del_comment (comment_id,news_id,ip,time) values (".$_POST['comment_id'].",".$_POST['news_id'].",'".$_SERVER['REMOTE_ADDR']."','".date("Y-m-d H:i:s")."')";
		$db ->execute($sql);
		close_db();
		$post = new table_class("smg_comment");
		$post -> delete($_POST['comment_id']);
		echo $_POST['comment_id'];
	}else{
		$db = get_db();
		$sql = 'update smg_comment set comment="'.$_POST['comment'].'" where id='.$_POST['id'];
		$db ->execute($sql);
		close_db();
	}
	
?>