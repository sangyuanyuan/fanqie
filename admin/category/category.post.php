<?php
 	require_once('../../frame.php');
	$id_str=explode("|",$_POST['id_str']); 
	$short_title_length_str=explode("|",$_POST['short_title_length_str']); 
	$id_str_num=sizeof($id_str)-1;
	for($i=$id_str_num-1;$i>=0;$i--)
	{
		if($short_title_length_str[$i]==""){$short_title_length_str[$i]="100";}
		$db = get_db();
		$sql="update ".$_POST['db_table']." set short_title_length=".$short_title_length_str[$i]." where id=".$id_str[$i];
		$db->execute($sql);
	}
?>
