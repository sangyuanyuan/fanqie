<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=gb2312">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -摄影评选结果</title>
	<link href="/css/smg.css" rel="stylesheet" type="text/css">
	<script language="javascript" src="/js/smg.js"></script>
	<script language="javascript" src="baby.js"></script>
</head>
<body>
<? include('../inc/top.inc.html');?>
<?php
  require_once('../libraries/tablemanager.class.php');
  require_once('../libraries/sqlrecordsmanager.php');
  require_once('../inc/pubfun.inc.php');
  
  $sqlmanager = new SqlRecordsManager();
  $babylist =$sqlmanager->GetRecords('select * from smg_jspd_vote');
  $allcount=$sqlmanager->GetRecords('select count(*) as num from smg_jspd_voterecord');
?>
<div id=bodys>
 	<div id=baby style="width:996px; margin-left:0px;">
 		<div style="width:996px; margin-top:5px; margin-left:49px; text-align:center; font-size:15px; color:red; font-weight:bold;">
</div>
 		<? for($i=0;$i<count($babylist);$i++){?>
 			<div class=pic1>
 				<div class=bh><? echo $babylist[$i]->id;?></div><a href="babyshow.php?id=<? echo $babylist[$i]->id;?>"><img border=0 width=150 height=150 src="<? echo $babylist[$i]->smallphotourl;?>" /></a><div class=nd><a href="babyshow.php?id=<? echo $babylist[$i]->id;?> "> 
 					<? echo $babylist[$i]->name;?></a>
 				<br>
 				<table>
	 					<tr>
	 						<td>
	 					结果:</td>
				 				<td><? $count =$sqlmanager->GetRecords('select count(*) as num from smg_jspd_voterecord where voteid='.$babylist[$i]->id);?> 	
							　<? echo $count[0]->num;?>票</td><? $total+=$count[0]->num;?>
						</tr>
						<tr><td>总票数：</td><td><? echo $total;?>票</td></tr>
						<? $total=0;?>
				</table>
 				</div>
 			</div>
 		<?}?>
 		
	<div style="width:996px; margin-top:5px; margin-left:49px; text-align:center; font-size:15px; color:red; font-weight:bold;"><input type="button" onclick="javascript:window.location.href='vote.php';" value="继续投票">
</div>
</div>
<? include('../inc/bottom.inc.html');
   CloseDB();
?>	
</body>
</html>