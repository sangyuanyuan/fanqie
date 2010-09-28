<?php
    require_once('../frame.php');
	$db = get_db();
	$sql = 'select dept_id,dept_category_id,created_at from smg_news_debug';
	$record = $db->query($sql);
	$count = count($record);
	for($i=0;$i<$count;$i++){
		$sql = 'update smg_news set dept_category_id='.$record[$i]->dept_category_id.' where dept_id='.$record[$i]->dept_id.' and created_at="'.$record[$i]->created_at.'"';
		$db->execute($sql);
	}
?>