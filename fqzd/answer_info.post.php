<?php 
	require_once('../frame.php');
	$db=get_db();
	$db->execute('insert into zd_answer_info(name,answer_id,created_at,ip) values ("'.$_COOKIE['smg_user_nickname'].'",'.$_POST['answer_id'].',now(),"'.$_SERVER['REMOTE_ADDR'].'")');
	$db->execute('update smg_user set zd_score=zd_score+'.$_POST['type'].' where id='.$_POST['user_id']);
	echo 'update smg_user set zd_score=zd_score+'.$_POST['type'].' where id='.$_POST['user_id'];
?>