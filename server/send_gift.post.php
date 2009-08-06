<?php
include "../frame.php";

$gift = new table_class('smg_birthday_gift');
$gift->update_attributes($_POST['gift'],false);
$gift->reciever = $_SESSION['smg_gift_loginname'];
$db = get_db();
$gifts = $db->query("select * from smg_gift where id in({$_POST['gift_ids']})");

foreach ($gifts as $v) {
	$gift->id=0;
	$gift->created_at = now();
	$gift->gift_src = $v->img_src;
	$gift->name = $v->name;
	$gift->save();
}
#
#$gift->created_at = now();
#if($gift->save()){
#	echo '恭喜您,礼物赠送成功!';
#}else{
#	echo '礼物赠送失败!';
#}

?>