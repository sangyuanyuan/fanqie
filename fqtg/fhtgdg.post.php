<?
require_once('../frame.php');
session_start();
if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
{
	$db=get_db();
	$cookie=$_COOKIE['smg_user_nickname'];
	$sql="select maxnum,fhtg_id from smg_fhtg_item where id=".$_POST['tg_id'];
	$maxnum=$db->query($sql);
	$num=1000000;
	$sql="select * from smg_tg_signup where fhtg_id=".$_POST['tg_id'];
	$count=$db->query($sql);
	if($maxnum[0]->maxnum!="")
	{
		$num=(int)$maxnum[0]->maxnum;
	}
	
	if(count($count)< $num)
	{
		$StrSql='insert into smg_tg_signup(fhtg_id,name,spname,num,phone,address,createtime,remark,dept_id) values ('.$_POST['tg_id'].',"'.$_POST['buyname'].'","'.$_POST['spname'].'",'.$_POST['num'].',"'.$_POST['phone'].'","'.$_POST['address'].'",now(),"'.$_POST['remark'].'",'.$_POST['deptid'].')';
		$Record = $db->execute($StrSql);
		echo 'OK';
	}
	else
	{
		echo '商品不足，订购失败！';
	}
	$_SESSION['url']="";
}
else
{
	die('请从正常入口进入提交页面！');
}
?>