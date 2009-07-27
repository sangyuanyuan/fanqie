<?
include('../frame.php');
$db=get_db();
if ($_POST["type"]=="tgcan")
{
	
	$StrSql='update smg_tg set isadopt=0 where id='.$_POST['id']; 
	$Record = $db->execute($StrSql);
	echo "OK";
}

if ($_POST["type"]=="tgpub")
{

	$StrSql='update smg_tg set isadopt=1 where id='.$_POST['id']; 
	$Record = $db->execute($StrSql);
	echo "OK";

}



if ($_POST["type"]=="tgdel")
{

	$StrSql='delete from smg_tg where id='.$_POST['id'];
	$Record = $db->execute($StrSql);
	
	echo "OK";
}



if ($_POST["type"]=="deltg")
{

	$strsql='delete from smg_tg_signup where id='.$_POST['id']; 
	$Record = $db->execute($strsql);
	echo "OK";

}



if ($_POST["type"]=="shopdel")
{
	$PostStr = iconv("utf-8","gbk",$PostStr);

	$StrSql='delete from smg_shop where id='.$_POST["id"]; 
	$Record = $db->execute($StrSql);
	$StrSql='delete from smg_shop_signup where tg_id='.$_POST["tgid"]; 
	$Record = $db->execute($StrSql);
	$StrSql='delete from smg_shop_comment where tg_id='.$_POST["tgid"]; 
	$Record = $db->execute($StrSql);
	echo "OK";
}

if ($_POST["type"]=="shopcan")
{
	

	$StrSql='update smg_shop set isadopt=0 where id='.$_POST['id']; 
	$Record = $db->execute($StrSql);
	echo "OK";

}


if ($_POST["type"]=="shoppub")
{

	$StrSql='update smg_shop set isadopt=1 where id='.$_POST['id']; 
	$Record = $db->execute($StrSql);
	echo "OK";

}



?>
