<?php
include '../frame.php';
if(!is_ajax())die();
$user_id = intval($_COOKIE['smg_user_id']);
if($user_id<=0){
	die();
}
$param = '';
if($_GET['param']){
	$param = implode('|',$_GET['param']);
}
$sql = "insert into smg_user_page(user_id,pos_name,pos_priority,created_at,model_type_id,display_name,params) values";
$sql .= "({$user_id},'{$_GET['position']}',100,now(),{$_GET['model_id']},'{$_GET['model_name']}','$param')";
$db = get_db();
if($db->execute($sql)){ ?>
	$.fn.colorbox.close();
	location.reload();
<?php 	
}else{
?>
	alert("添加失败！");
	$.fn.colorbox.close();
<?php }