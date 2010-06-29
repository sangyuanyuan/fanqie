<?php 
	require_once('../../frame.php');
	$db = get_db();
	$cookie=$_COOKIE['smg_user_nickname'];
	$friend=$db->query('select friend_id from smg_user where nick_name="'.$cookie.'"');
	$count=$db->query('select * from smg_user where nick_name="'.$cookie.'" and friend_id like "%'.$_POST['id'].'%"');
	if($count==0)
	{
		if($friend[0]->friend_id=="")
		{
			$db->execute('update smg_user set friend_id="'.$_POST['id'].'" where nick_name="\"'.$_POST['id'].'\""');
		}
		else
		{
			$db->execute('update smg_user set friend_id='.$friend[0]->friend_id.',"'.$_POST['id'].'"');	
		}
	}
	else
	{
		echo "num error";	
	}
?>