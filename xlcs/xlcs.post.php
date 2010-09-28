<?
	require_once('../frame.php');
	$db=get_db();
	$sql="select id,child_id from smg_xlcs_item where id=".$_POST['chosen_radio'];
	$record=$db->query($sql);
	if($record[0]->child_id!="")
	{
		redirect('xlcs.php?xlcs_id='.$record[0]->child_id);
	}
	else
	{
		redirect('xlcs_result.php?id='.$record[0]->id);	
	}
?>