<? 
include('../frame.php');
session_start();
if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
{
	$db=get_db();
	$StrSql='insert into smg_activities_signup (name,dept_id,mobile,createtime,sex,activities_id) values ("'.$_POST['name'].'",'.$_POST['dept_id'].',"'.$_POST['phone'].'",now(),"'.$_POST['sex'].'",'.$_POST['activities_id'].')';
	$Record = $db->execute($StrSql) or die ("insert error");
	echo '<script language=javascript>alert("提交成功！")</script>';
	echo '<script language=javascript>window.location.href="/act/list.php?id='.$_POST['activities_id'].'";</script>';
	exit;
}
else
{
	die('请从网站入口提交！');	
}
?>