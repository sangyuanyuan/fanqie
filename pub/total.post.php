<?php
	require "../frame.php";
	$db = get_db();
	$PostDiv="abderraf123123";
	$datetime1=date('Y-m-d')." 00:00:00";
	$datetime2=date('Y-m-d')." 23:59:59";
	list($name,$platform) = split ($PostDiv, $_POST["total"]);


	
	$strsql='select * from smg_total where platform="'.$platform.'" and name="'.$name.'" and datetime>="'.$datetime1.'" and datetime<="'.$datetime2.'"'; 
	$record=$db -> query($strsql);
	if(count($record)==0)
	{
		$strsql='insert into smg_total (platform,name,datetime,count) values("'.$platform.'","'.$name.'",now(),1)'; 
		$record = $db->execute($strsql);
	}
	else
	{
		$strsql='update smg_total set count=count+1 where platform="'.$platform.'" and name="'.$name.'" and datetime>="'.$datetime1.'" and datetime<="'.$datetime2.'"'; 
		$record = $db->execute($strsql);		
	}
	
	
?>