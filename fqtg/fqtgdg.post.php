<?
require_once('../frame.php');
$db=get_db();
$cookie="";
$cookie=$_COOKIE['smg_user_nickname'];

if($_POST['tg_id']!=64)
{
	$sql="select maxnum from smg_tg where id=".$_POST['tg_id'];
	$maxnum=$db->query($sql);
	$num=1000000;
	if($maxnum[0]->maxnum!="")
	{
		$num=(int)$maxnum[0]->maxnum;
	}
	$sql="select * from smg_tg_signup where tg_id=".$_POST['tg_id'];
	$count=$db->query($sql);
	if(count($count)< $num)
	{
		$StrSql='insert into smg_tg_signup(tg_id,name,spname,num,phone,address,createtime,remark,dept_id) values ('.$_POST['tg_id'].',"'.$_POST['buyname'].'","'.$_POST['spname'].'",'.$_POST['num'].',"'.$_POST['phone'].'","'.$_POST['address'].'",now(),"'.$_POST['remark'].'",'.$_POST['deptid'].')';
		$Record = $db->execute($StrSql);
		alert("订购成功！");
	}
	else
	{
			alert('商品不足，订购失败！');
	}
}
else
{
	if($cookie=="")
	{
		alert('请登录后再订购');
		redirect('/admin/admin.php');
		exit;
	}
	$StrSql='insert into smg_tg_signup(tg_id,name,spname,num,phone,address,createtime,remark) values (64,"'.$cookie.'","免费徽菜抵用券",1,"'.$_POST['phone'].'","'.$_POST['address'].'",now(),"'.$_POST['remark'].'")';
	$Record = $db->execute($StrSql);
	alert("订购成功！");
}
redirect('/fqtg/fqtgdg.php?id='.$_POST['tg_id']);
exit;
?>