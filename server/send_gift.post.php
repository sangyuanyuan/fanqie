<?php
include "../frame.php";
$db = get_db();
$gifts = $db->query("select * from smg_gift where id in({$_POST['gift_ids']})");
$cookie=isset($_COOKIE['smg_username']) ? $_COOKIE['smg_username'] : "";
if($cookie!="")
{	 
	$count=$db->query('select count(*) as num from smg_friends where my_name="'.$_SESSION['smg_gift_loginname'].'" and friend_name="'.$cookie.'"');
	if((int)$count[0]->num==0)
	{
	 $friend=$db->execute("insert into smg_friends(my_name,friend_name) value ('".$_SESSION['smg_gift_loginname']."','".$cookie."')");
	}
}
close_db();
$gift = new table_class('smg_birthday_gift');
$gift->update_attributes($_POST['gift'],false);
$gift->reciever = $_SESSION['smg_gift_loginname'];


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