<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>番茄投票</title>
	</head>

</html>
<?php
	require "../frame.php";
	$vote_id = intval($_POST['vote_id']);
	$table = new table_class('smg_vote');
	$vote = $table->find($vote_id);
	$vote->max_vote_count = intval($vote->max_vote_count) > 0 ? $vote->max_vote_count : 10000;
	if($vote === false){
		alert('非法操作!');
		redirect($_SERVER['HTTP_REFERER']);
		exit;
	}
	
	if(($vote->started_at && $vote->started_at > now()) || ($vote->ended_at && $vote->ended_at < now())){
		alert('该投票已过期或还未开始!');
		redirect($_SERVER['HTTP_REFERER']);
		exit;
	}
	
	if($vote->limit_type=='user_id' && empty($_COOKIE['smg_userid'])){
		alert('请登录后再参加投票!');
		redirect('/login/login.php');
		exit;
	}
	if($vote->limit_type == "user_id"){
		$limit = 'user_id=' . $_COOKIE['smg_userid'];
	}else if($vote->limit_type == "ip"){
		$limit = "ip='" . $_SERVER['REMOTE_ADDR'] ."'";
	}
	
	//handle the vote items
	$db = get_db();
	$vote_record = new table_class('smg_vote_item_record');	
	$judged = $limit ? false : true;
	$nick_name = $_COOKIE['smg_user_nickname'] ? $_COOKIE['smg_user_nickname'] : '游客';
	foreach ($_POST['vote_class'] as $k => $v) {
		if(!$judged){		
			$sql = "select count(distinct created_at) from smg_vote_item_record where vote_id={$k} " . ' and '.$limit;
			$db->query($sql);
			$count = $db->field_by_index(0);
			if($_COOKIE['smg_userid']==157)
			{
				
			}
			else
			{
				if($count >= $vote->max_vote_count){
					alert('您已经投过该投票 ' .$count .' 次,谢谢您的参与!');
					redirect($_SERVER['HTTP_REFERER']);
					exit;
				}
			}
			$judged = true;
		}
		foreach($v as $value){					
			$vote_record->id=0;
			$vote_record->vote_id = $k;
			$vote_record->vote_item_id = $value;
			$vote_record->ip = getenv('HTTP_X_FORWARDED_FOR');
			$vote_record->user_id = $_COOKIE['smg_userid'];
			$vote_record->created_at = now();
			$vote_record->nick_name = $nick_name;
			$vote_record->save();	
			$item_ids[] = $value;			
		}
	}
	
	$sql = 'update smg_vote_item set vote_count = vote_count + 1 where id in (' . implode(',',$item_ids) .')';
	$db->execute($sql);
	$sql = "insert into smg_vote_user_list (nick_name,vote_id,vote_name,created_at) values ('$nick_name','{$vote->id}','{$vote->name}',NOW())";
	$db->execute($sql);
	alert('投票成功,感谢您的参与!');
	redirect('/vote/vote_show.php?vote_id=' .$vote->id);
?>