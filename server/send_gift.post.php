<?php
include "../frame.php";
$gift = new table_class('smg_birthday_gift');
$gift->update_attributes($_POST['gift'],false);
$gift->created_at = now();
if($gift->save()){
	echo '恭喜您,礼物赠送成功!';
}else{
	echo '礼物赠送失败!';
}
?>