<?php
    require_once('../frame.php');
	$vote_item_id=$_REQUEST['item_id'];
	$ip=getenv('REMOTE_ADDR');
	$userid=$_REQUEST['userid'];
	
	$db=get_db();
	if($userid!="")
	{
		$sql="insert into smg_vote_item_record(vote_item_id,created_at,ip,userid) value (".$vote_item_id.",now(),'".$ip."',".$userid.")";
	}
	else
	{
		$sql="insert into smg_vote_item_record(vote_item_id,created_at,ip) value (".$vote_item_id.",now(),'".$ip."')";
	}
	if($db->execute($sql))
	{

	}
	else{
		echo "error";
	}
?>