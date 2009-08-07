<?php
	require_once('../frame.php');
	$db = get_db();
	/*$sql = 'select * from smg_category_dept where category_type="link"';
	$record = $db->query($sql);
	$count  = count($record);
	for($i=0;$i<$count;$i++){
		$sql = 'update smg_link set category_id='.$record[$i]->id.' where category_id='.$record[$i]->ord_id;
		$db->execute($sql);
	}
	$sql = 'select * from smg_category_dept where category_type="news"';
	$record = $db->query($sql);
	$count  = count($record);
	for($i=0;$i<$count;$i++){
		$sql = 'update smg_news set dept_category_id='.$record[$i]->id.' where dept_category_id='.$record[$i]->ord_id;
		$db->execute($sql);
	}
	$sql = 'select * from smg_category_dept where category_type="picture"';
	$record = $db->query($sql);
	$count  = count($record);
	for($i=0;$i<$count;$i++){
		$sql = 'update smg_images set dept_category_id='.$record[$i]->id.' where dept_category_id='.$record[$i]->ord_id;
		$db->execute($sql);
	}
	$sql = 'select * from smg_category_dept where category_type="video"';
	$record = $db->query($sql);
	$count  = count($record);
	for($i=0;$i<$count;$i++){
		$sql = 'update smg_video set dept_category_id='.$record[$i]->id.' where dept_category_id='.$record[$i]->ord_id;
		$db->execute($sql);
	}
	$sql = 'select * from smg_category_dept where category_type="vote"';
	$record = $db->query($sql);
	$count  = count($record);
	for($i=0;$i<$count;$i++){
		$sql = 'update smg_vote set dept_category_id='.$record[$i]->id.' where dept_category_id='.$record[$i]->ord_id;
		$db->execute($sql);
	}*/
	$sql = 'select * from smg_subject_vote_item';
	$record = $db->query($sql);
	$count  = count($record);
	for($i=0;$i<$count;$i++){
		$sql = 'update smg_zongcai_item set state=2 where state=0 and name="'.$record[$i]->name.'"';
		$db->execute($sql);
	}
?>