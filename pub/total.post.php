<?php
	require "../frame.php";
	$db = get_db();
	$PostDiv="abderraf123123";
	$datetime1=date('Y-m-d')." 00:00:00";
	$datetime2=date('Y-m-d')." 23:59:59";
	list($name,$platform) = split ($PostDiv, $_POST["total"]);
	if(strpos($_SERVER['HTTP_REFERER'],'?')){
		$parent_name = substr($_SERVER['HTTP_REFERER'], 0, strpos($_SERVER['HTTP_REFERER'],'?'));
	}else{
		$parent_name = $_SERVER['HTTP_REFERER'];
	}
	$table_change = array('http://172.27.203.81:8080'=>'');
	$parent_name = strtr($parent_name,$table_change);
	if($name=='论坛'){
		$parent_name='/bbs/';
	}
	if($name=='博客'){
		$parent_name='/blog/';
	}
	if($name=='新闻DIGG'){
		$parent_name='/news/news_digg.post.php';
	}
	

	if($name==""||$platform==""){exit;}
	
	$strsql='select * from smg_total where platform="'.$platform.'" and name="'.$name.'" and datetime>="'.$datetime1.'" and datetime<="'.$datetime2.'"'; 
	$record=$db -> query($strsql);
	if(count($record)==0)
	{
		$strsql='insert into smg_total (platform,name,datetime,count,parentname) values("'.$platform.'","'.$name.'",now(),1,"'.$parent_name.'")'; 
		$record = $db->execute($strsql);
	}
	else
	{
		$strsql='update smg_total set count=count+1,parentname="'.$parent_name.'" where platform="'.$platform.'" and name="'.$name.'" and datetime>="'.$datetime1.'" and datetime<="'.$datetime2.'"'; 
		$record = $db->execute($strsql);		
	}
	
	
?>