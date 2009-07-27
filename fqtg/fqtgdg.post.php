<?
require_once('../frame.php');
$db=get_db();
	$StrSql='insert into smg_tg_signup(tg_id,name,spname,num,phone,address,createtime,remark,dept_id) values ('.$_POST['tg_id'].',"'.$_POST['buyname'].'","'.$_POST['spname'].'",'.$_POST['num'].',"'.$_POST['phone'].'","'.$_POST['address'].'",now(),"'.$_POST['remark'].'",'.$_POST['deptid'].')';
	$Record = $db->execute($StrSql);
alert("订购成功！");
redirect('/fqtg/fqtgdg.php?id='.$_POST['tg_id']);
exit;
?>