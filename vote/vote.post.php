<?php
    require_once('../frame.php');
	$vote_item_id=$_REQUEST['item_id'];
	$ip=getenv('REMOTE_ADDR');
	$userid=$_REQUEST['userid'];
	$type=$_REQUEST['type'];
	$target_url=$_REQUEST['$target_url'];
	$vote_id=$_REQUEST['vote_id'];
	$db=get_db();
	if($type=="user_id")
	{
		
		if($userid==0)
		{
			alert('请先登录再投票！');
			redirect('/login/login.php');
		}
		else
		{
			$sql="select count(*) as countnum from smg_vote_item_record where vote_item_id=".$vote_item_id." and userid=".$userid;
			$count=$db->query($sql);
			if($count[0]->countnum>0)
			{
				alert('您已经投过票了请不要重复投票！');
				redirect($target_url);
			}
		}
	}
	if($type=="ip")
	{
		
			$sql="select count(*) as countnum from smg_vote_item_record where vote_item_id=".$vote_item_id." and ip='".$ip."'";
			$count=$db->query($sql);
			if($count[0]->countnum>0)
			{
				alert('您已经投过票了请不要重复投票！');
				redirect($target_url);
			}
	}
	if($userid!="")
	{
		$sql="insert into smg_vote_item_record(vote_item_id,created_at,ip,userid,vote_id) value (".$vote_item_id.",now(),'".$ip."',".$userid.",".$vote_id.")";
	}
	else
	{
		$sql="insert into smg_vote_item_record(vote_item_id,created_at,ip,vote_id) value (".$vote_item_id.",now(),'".$ip."',".$vote_id.")";
	}
	if($db->execute($sql))
	{
		
	}
	else{
		echo "error";
	}
?>