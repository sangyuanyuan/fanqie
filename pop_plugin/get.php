<?php
include '../frame.php';
$id = intval($_GET['id']);
$user = $_GET['user'];
if(!$user || $id <= 0) die();
$db = get_db();
$db->query("select content from smg_pop_task where id={$id}");
if($db->record_count <=0 ) die();
$content = $db->field_by_name('content');
$db->execute("insert into smg_pop_history (created_at,task_id,user) values (now(),{$id},'{$user}') ");
echo $content;
?>