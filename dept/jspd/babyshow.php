<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -摄影展</title>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="/js/smg.js"></script>>
</head>
<body>
<? include('../inc/top.inc.html');?>
<?php
  require_once('../libraries/tablemanager.class.php');
  require_once('../libraries/sqlrecordsmanager.php');
  require_once('../inc/pubfun.inc.php');
  
  if($_REQUEST['id']==''){die('没有找到此摄影展网页');}
  $sqlmanager = new SqlRecordsManager();
  $babyshow = $sqlmanager->GetRecords('select * from smg_jspd_vote where id='.$_REQUEST['id']);
?>
<div id=bodys>
 	<div id=baby>
 		<? for($i=0;$i< count($babyshow);$i++){?>
 			<div style="margin-top:10px; text-align:center;"><img  border=0  src="<? echo $babyshow[$i]->bigphotourl;?>" /></div>
 		<?}?>
	</div>  
</div>
<? include('../inc/bottom.inc.html');
   CloseDB();
?>	
</body>
</html>
