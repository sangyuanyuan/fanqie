<?
require_once('../frame.php');
$db=get_db();
$cookie="";
$cookie=$_COOKIE['smg_user_nickname'];

if($_POST['tg_id']!=64)
{
	$StrSql='insert into smg_tg_signup(tg_id,name,spname,num,phone,address,createtime,remark,dept_id) values ('.$_POST['tg_id'].',"'.$_POST['buyname'].'","'.$_POST['spname'].'",'.$_POST['num'].',"'.$_POST['phone'].'","'.$_POST['address'].'",now(),"'.$_POST['remark'].'",'.$_POST['deptid'].')';
	$Record = $db->execute($StrSql);
	alert("订购成功！");
}
else
{
	if($cookie=="")
	{
		alert('请登录后再订购');
		redirect('/admin/admin.php');
	}
	$StrSql='insert into smg_tg_signup(tg_id,name,spname,num,phone,address,createtime,remark) values (64,"'.$cookie.'","免费徽菜抵用券",1,"'.$_POST['phone'].'","'.$_POST['address'].'",now(),"'.$_POST['remark'].'")';
	$Record = $db->execute($StrSql);
	alert("订购成功！");
}

redirect('/fqtg/fqtgdg.php?id='.$_POST['tg_id']);
exit;
?>