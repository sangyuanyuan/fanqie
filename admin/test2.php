<?php
    require_once('../frame.php');
	$db = get_db();
	$sql = 'select dept_id,dept_category_id,title,created_at from smg_new_debug where dept_category_id!=0';
	$record = $db->query($sql);
	for($i=0;$i<$record;$i++){
		$sql = 'update smg_news set dept_category_id='.$record[$i]->dept_category_id.' where dept_id='.$record[$i]->dept_id.' and title="'.$record[$i]->title.'" and created_at='.$record[$i]->created_at;
		$db->execute($sql);
	}
?>