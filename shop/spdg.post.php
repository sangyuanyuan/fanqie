<?
require_once('../frame.php');
$db=get_db();
	$StrSql='insert into smg_shop_signup(tg_id,name,spname,num,phone,address,createtime,remark) values ('.$_POST['tg_id'].',"'.$_POST['buyname'].'","'.$_POST['spname'].'",'.$_POST['num'].',"'.$_POST['phone'].'","'.$_POST['address'].'",now(),"'.$_POST['remark'].'")';
	$Record = $db->execute($StrSql);
alert("订购成功！");
redirect('/shop/spdg.php?id='.$_POST['tg_id']);
exit;
?>