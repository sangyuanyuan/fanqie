<? 
include('../frame.php');
$db=get_db();
$StrSql='insert into smg_activities_signup (name,dept_id,mobile,createtime,age,sex) values ("'.$_POST['name'].'",'.$_POST['dept_id'].',"'.$_POST['phone'].'",now(),"'.$_POST['age'].'","'.$_POST['sex'].'")';
$Record = $db->execute($StrSql) or die ("insert error");
echo '<script language=javascript>alert("�ύ�ɹ���")</script>';
echo '<script language=javascript>window.location.href="/";</script>';
exit;


?>