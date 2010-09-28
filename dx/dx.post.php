<?php
  require_once('../frame.php');
  $db = get_db();
  $mobile=$_POST['mobile'];
  $yz=$_POST['yz'];
  $count = $db->query('select count(*) as num from smg_dx where phone="'.$mobile.'"');
  if($_REQUEST['utype']=='zhuce')
  {	  
	  if($count[0]->num==0)
	  {
		  $StrSql='insert into smg_dx(phone,num) value("'.$mobile.'",'.$yz.')';
		  $db->execute($StrSql);
		  echo "<script LANGUAGE=\"Javascript\">"; 
		  echo "location.href='http://222.68.17.193:8080/qxt/jbs.jsp?phone=".$mobile."&content=".$yz."&sign=2';";
		  echo "location.href='/dx/dx.php';";
		  echo "alert('订阅成功')";
		  echo "</script>";
		}
		else
		{
			die('该号码已经被注册！');	
		}
	}
	else if($_REQUEST['utype']=='zhuxiao')
	{
		echo "<script LANGUAGE=\"Javascript\">"; 
		echo "location.href='http://222.68.17.193:8080/qxt/jbs.jsp?phone=".$mobile."&content=".$yz."&sign=3';";
		echo "alert('退订成功！');";
		echo "location.href='/dx/dx.php';";
		echo "</script>";
		if($count[0]->num>0)
	  {
			$StrSql='delete from smg_dx where phone="'.$mobile.'"';
			$db->execute($StrSql);
		}
		else
		{
			die('该号码还没有被注册！');
		}
	}
  //print_r($comment);
  
?>