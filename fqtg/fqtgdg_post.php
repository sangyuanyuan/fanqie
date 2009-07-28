<?
require_once('../frame.php');
$db=get_db();
if($_POST['type']=='lq')
{
	$id=$_POST['id'];
	$strsql='update smg_tg_signup set state=1 where id='.$id; 
	$Record = $db->execute($strsql);
	echo "OK";
}
if($_POST['type']=='ylq')
{
	$id=$_POST['id'];
	$strsql='update smg_tg_signup set state=0 where id='.$id; 
	$Record = $db->execute($strsql);
	echo "OK";
}

?>