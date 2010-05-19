<?php
	require_once('../libraries/sqlrecordsmanager.php');
  require_once('../libraries/tableobject_class.php');
  require_once('../inc/pubfun.inc.php');
	ConnectDB();
	
  $cookie= (isset($_COOKIE['smg_userid'])) ? $_COOKIE['smg_userid'] : 0;
  if($cookie==0)
	{
			echo '<script language=javascript>alert("请登录后投票");</script>';
			redirecturl('/admin/');
			CloseDB();
			exit;
	}
	else
	{
		$sql="select count(*) as countnum from smg_baby_voterecord where userid='".$cookie."'";
		$count = $dbc->QueryDB($sql);
		$dbc->MoveFirst();
		$count = $dbc->FieldByName('countnum');
		print_r($count);
		if($count > 0)
		{
			echo '<script language=javascript>alert("请不要重复投票！");</script>';
			//redirecturl('/vote/babyvote.php');
			CloseDB();
			exit;
		}
	}
  for($i=1;$i< 6;$i++){
		$StrSql='insert into smg_baby_voterecord (babyid,createtime,voteitemid,userid) values('.$_POST['baby'.$i].',now(),'.$i.','.$cookie.')';
		$Record = mysql_query($StrSql) or die ("insert error");
	}
	CloseDB();
	echo '<script language=javascript>alert("投票成功！")</script>';
	echo '<script language=javascript>window.location.href="/vote/babyvote.php";</script>';
	exit;
?>