<?php
include('../../frame.php');
 $db=get_db();
if ($_POST["type"]=="xlcscan")
{
	$StrSql='update smg_fhtg set is_adopt=0 where id='.$_POST['id']; 
	$Record = $db->execute($StrSql);
	echo "OK";
}
if ($_POST["type"]=="xlcspub")
{

	$StrSql='update smg_fhtg set is_adopt=1 where id='.$_POST['id']; 
	$Record = $db->execute($StrSql);
	echo "OK";

}
if ($_POST["type"]=="xlcsdel")
{
	$sql = 'delete from smg_fhtg_item where fhtg_id in (select id from smg_fhtg where id='.$_POST['id'].')';
	$db -> execute($sql);
	$sql = 'delete from smg_fhtg where id='.$_POST['id'];
	$db -> execute($sql);
	echo "OK";
}
?>