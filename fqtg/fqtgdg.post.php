<?
require_once('../frame.php');
session_start();
if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
{
	$db=get_db();
	$cookie=$_COOKIE['smg_user_nickname'];
	$sql="select maxnum,personmax from smg_tg where id=".$_POST['tg_id'];
	$maxnum=$db->query($sql);
	$num=1000000;
	$postnum=(int)$_POST['num'];
	$sql="select sum(num) as num from smg_tg_signup where tg_id=".$_POST['tg_id'];
	$count=$db->query($sql);
	if($maxnum[0]->personmax==""||$maxnum[0]->personmax==0)
	{
		if($maxnum[0]->maxnum!="")
		{
			$num=(int)$maxnum[0]->maxnum;
		}
		$total=(int)$count[0]->num+$postnum;
		if($total<=$num)
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
		if($maxnum[0]->maxnum!="")
		{
			$num=(int)$maxnum[0]->maxnum;
		}
		if((int)$count[0]->num < $num)
		{
			$sql="select * from smg_tg_signup where tg_id=".$_POST['tg_id']." and name='".$cookie."'";
			$peson=$db->query($sql);
			if(count($peson)==0)
			{
				$StrSql='insert into smg_tg_signup(tg_id,name,spname,num,phone,address,createtime,remark) values ('.$_POST['tg_id'].',"'.$cookie.'","'.$_POST['spname'].'",'.$maxnum[0]->personmax.',"'.$_POST['phone'].'","'.$_POST['address'].'",now(),"'.$_POST['remark'].'")';
				$Record = $db->execute($StrSql);
				alert("订购成功！");
			}
			else
			{
				alert('请不要重复订购！');	
			}
		}
		else
		{
				alert('商品不足，订购失败！');
		}
	}
	$_SESSION['url']="";
	redirect('/fqtg/fqtgdg.php?id='.$_POST['tg_id']);
	exit;
}else
{
	die('请从正常入口进入提交页面！');	
}
?>