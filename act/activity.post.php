<? 
include('../frame.php');
$db=get_db();

$StrSql='insert into smg_activities_signup (name,dept_id,mobile,createtime,sex,activities_id) values ("'.$_POST['name'].'",'.$_POST['dept_id'].',"'.$_POST['phone'].'",now(),"'.$_POST['sex'].'",'.$_POST['activities_id'].')';
$Record = $db->execute($StrSql) or die ("insert error");
echo '<script language=javascript>alert("提交成功！")</script>';
echo '<script language=javascript>window.location.href="/act/list.php?id=3";</script>';
exit;
?>