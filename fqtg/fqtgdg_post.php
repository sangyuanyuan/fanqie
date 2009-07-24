<?
require_once('../frame.php');
$db=get_db();
if ($_POST["tg"]<>"")
{
	$PostStr = $_POST["tg"];
	$PostStr = iconv("utf-8","gbk",$PostStr);
	$strsql='update smg_tg_signup set state=1 where id='.$PostStr; 
	$Record = $db->execute($strsql);
	echo "OK";
}

CloseDB();
?>