<?php
	require_once('../../frame.php');
  $db = get_db();
	
  $cookie= (isset($_COOKIE['smg_userid'])) ? $_COOKIE['smg_userid'] : 0;
  if($cookie==0)
	{
			echo '<script language=javascript>alert("请登录后投票");</script>';
			redirect('/login/login.php');
			exit;
	}
	else
	{
		$sql="select count(*) as countnum from smg_baby_voterecord where userid='".$cookie."'";
		$count = $db->query($sql);
		if($count[0]->countnum > 0)
		{
			echo '<script language=javascript>alert("请不要重复投票！");</script>';
			//redirecturl('/vote/babyvote.php');
			exit;
		}
	}
  for($i=1;$i< 6;$i++){
		$StrSql='insert into smg_baby_voterecord (babyid,createtime,voteitemid,userid) values('.$_POST['baby'.$i].',now(),'.$i.','.$cookie.')';
		$Record = $db->execute($StrSql) or die ("insert error");
	}
	echo '<script language=javascript>alert("投票成功！")</script>';
	echo '<script language=javascript>window.location.href="/vote/babyvote.php";</script>';
	exit;
?>