﻿<?php
  require_once('../frame.php');
  if(date('Y-m-d')!="2010-09-18"){
		$id=$_REQUEST['id'];
		$sql="delete from smg_baby_item where id=".$id;
		$db = get_db();
		if($db->execute($sql))
		{
			echo 'OK';
		}
		else
		{
			echo 'error';
		}
	}
	else
	{
		alert('对不起今天关闭一切提交！');	
	}
?>