<?php
    require_once('../frame.php');
    session_start();
		if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
		{
	    $db=get_db();
	    $newsid=$_POST['news_id'];
	    $value=$_POST['value'];
	    if($newsid!="")
	    {
		    $count=$db->query('select * from smg_dfgb_vote where news_id='.$newsid);
		    if($count>0)
		    {
		    	if($value==1)
		    	{
			    	$db->execute('update smg_dfgb_vote set select1=select1+1 where news_id='.$newsid);
			    }
			    else if($value==2)
		    	{
			    	$db->execute('update smg_dfgb_vote set select2=select2+1 where news_id='.$newsid);
			    }
			    else if($value==3)
		    	{
			    	$db->execute('update smg_dfgb_vote set select3=select3+1 where news_id='.$newsid);
			    }
		    }
		    else
		    {
		    	if($value==1)
		    	{
			    	$db->execute('insert into smg_dfgb_vote (news_id,select1) value ('.$newsid.',1)');
			    }
			    else if($value==2)
		    	{
			    	$db->execute('insert into smg_dfgb_vote (news_id,select2) value ('.$newsid.',1)');
			    }
			    else if($value==3)
		    	{
			    	$db->execute('insert into smg_dfgb_vote (news_id,select3) value ('.$newsid.',1)');
			    }
		    }
	  	}
	  	$_SESSION['url']="";
	  }
	  else
	  {
	  	die('请从网站入口提交！');	
	  }
?>