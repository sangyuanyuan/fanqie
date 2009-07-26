<?
require_once('../frame.php');
$db=get_db();
	$id=$_POST['id'];
	$strsql='update smg_tg_signup set state=1 where id='.$id; 
	$Record = $db->execute($strsql);
	echo "OK";

?>