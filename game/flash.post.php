<?
	require_once('../frame.php');
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
		$db =get_db();
		$StrSql='insert into smg_game(name,phone,created_at,num) values ("'.$_POST['playname'].'","'.$_POST['phone'].'",now(),'.$_POST['score'].')';
		$Record = $db->execute($StrSql);
		echo '<script language=javascript>alert("提交成功！");</script>';
		echo '<script language=javascript>window.location.href="/game/flashview.php";</script>';
		exit;
	}
	else
	{
		die('请从正常入口进入提交页面！');
	}
?>