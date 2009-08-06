<?php
	require_once('../frame.php');
	$db = get_db();
	$sql = 'select * from smg_category_dept where category_type="link"';
	$record = $db->query($sql);
	$count  = count($record);
	for($i=0;$i<$count;$i++){
		$sql = 'update smg_link set category_id='.$record[$i]->id.' where category_id='.$record[$i]->old_id;
	}
?>