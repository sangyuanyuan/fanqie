<?php
include('../../frame.php');
 $db=get_db();
if ($_POST["type"]=="xlcscan")
{
	$StrSql='update smg_xlcs set is_adopt=0 where id='.$_POST['id']; 
	$Record = $db->execute($StrSql);
	echo "OK";
}
if ($_POST["type"]=="xlcspub")
{

	$StrSql='update smg_xlcs set is_adopt=1 where id='.$_POST['id']; 
	$Record = $db->execute($StrSql);
	echo "OK";

}
if ($_POST["type"]=="xlcsdel")
{
	$StrSql='delete from smg_xlcs where id='.$_POST['id'];
	$Record = $db->execute($StrSql);
	echo "OK";
}
?>