<?
	include('../inc/db.inc.php');
	ConnectDB();
	if($_POST['num']==5||$_POST['num']==6)
	{
		$ip = getenv('REMOTE_ADDR');
		$cookie= (isset($_COOKIE['vote_users'])) ? $_COOKIE['vote_users'] : 0;
		if($cookie==0)
		{
			$strsql='select * from smg_jspd_voterecord where ip="'.$ip.'"';
		}
		else
		{
			$strsql='select * from smg_jspd_voterecord where ip="'.$cookie.'"';
		}
		
		$Record = mysql_query($strsql) or die ("select error");
		$record_num=mysql_num_rows($Record);
		if($record_num < 25)
		{
			if($ip=="172.27.4.80"||$ip=="172.25.201.88"||$ip=="172.28.10.33")
			{
				if($cookie==0)
				{
					$y2k = mktime(0,0,0,1,1,2020); 
					SetCookie(vote_user,mt_rand(0,1000000),$y2k,'/');
					$cookie=$_COOKIE['vote_users'];
				}
				for($i=1;$i<=5;$i++)
				{
					$StrSql='insert into smg_jspd_voterecord (voteid,createtime,ip) values('.$_POST['baby'.$i].',now(),"'.$cookie.'")';
					$Record = mysql_query($StrSql) or die ("insert error");
				}		
			}
			else
			{
				for($i=1;$i<=5;$i++)
				{
					$StrSql='insert into smg_jspd_voterecord (voteid,createtime,ip) values('.$_POST['baby'.$i].',now(),"'.$ip.'")';
					$Record = mysql_query($StrSql) or die ("insert error");
				}
			}
			echo '<script language=javascript>alert("投票成功！")</script>';
			echo '<script language=javascript>window.location.href="vote.php";</script>';
		}
		else
		{
			echo '<script language=javascript>alert("您已超过投票次数，不能再投，谢谢！")</script>';
			echo '<script language=javascript>window.location.href="vote.php";</script>';
		}
	}
	else
	{
			echo '<script language=javascript>alert("请选择五个摄影作品再投票！")</script>';
			echo '<script language=javascript>window.location.href="vote.php";</script>';
	}
	
	CloseDB();
?>