<?php 
	require_once('../frame.php');
	$db=get_db();
	$user=$db->query('select * from zd_answer_info where name="'.$_COOKIE['smg_user_nickname'].'" and answer_id='.$_POST['answer_id']);
	if(count($user)==0)
	{
		$db->execute('insert into zd_answer_info(name,answer_id,created_at,ip) values ("'.$_COOKIE['smg_user_nickname'].'",'.$_POST['answer_id'].',now(),"'.$_SERVER['REMOTE_ADDR'].'")');
		$db->execute('update smg_user set zd_score=zd_score+'.$_POST['type'].' where id='.$_POST['user_id']);
		echo "打分成功！";
	}
	else
	{
		echo "您已经为此答案打过分请不要重复打分！";	
	}
?>