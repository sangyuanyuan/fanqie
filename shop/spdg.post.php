<?
require_once('../libraries/tablemanager.class.php');
require_once('../libraries/sqlrecordsmanager.php');
require_once('../inc/pubfun.inc.php');
ConnectDB();
	$StrSql='insert into smg_shop_signup(tg_id,name,spname,num,phone,address,createtime,remark) values ('.$_POST['tg_id'].',"'.$_POST['buyname'].'","'.$_POST['spname'].'",'.$_POST['num'].',"'.$_POST['phone'].'","'.$_POST['address'].'",now(),"'.$_POST['remark'].'")';
	$Record = mysql_query($StrSql) or die ("insert error");
CloseDB();
echo '<script language=javascript>alert("�ύ�ɹ���")</script>';
echo '<script language=javascript>window.location.href="/shop/spdg.php?id='.$_POST['tg_id'].'";</script>';
exit;
?>