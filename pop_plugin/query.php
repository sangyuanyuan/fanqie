<?php
include "../frame.php";
$user = $_GET['user'];
if(!$user) die();
$db = get_db();
$db->query("SELECT group_concat(task_id SEPARATOR \",\") as ids FROM smg_pop_history where user='{$user}' and created_at >= '" . date('Y-m-d')."'");
if($db->field_by_name('ids')){
	$read_ids = "(" . $db->field_by_name('ids')  .")";
}
$sql = "select id,width,height from smg_pop_task where is_adopt=1 and created_at >='" .date('Y-m-d') ."'";
if($read_ids){
	$sql .= " and id not in {$read_ids}";
}
$sql .= " order by created_at asc limit 1";
$item = $db->query($sql);
if($db->record_count>0){
	echo $item[0]->id ."|" .$item[0]->width ."|" .$item[0]->height; 
}