<?php require_once('../frame.php');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>番茄网宝宝爱墙</title>
<style><!--@import url(inc/style.css);--></style>
<?php use_jquery();
js_include_once_tag('total');
?>
<script>
	total("宝宝爱墙","show");
</script>
</head>
<body>
<div style="display:none;" id="aspk" onclick="Hide();"></div>
<div id="header">
	<span style="float:left;"></span>
	<div id="banner">番茄网宝宝爱墙</div>
</div>
<div id="menu">
<a href="/bbs" target="_blank"><img src="hehun_images/01.gif" width="27" height="17" /></a>
    <a href="index.php?id=1">我的许愿</a> <img src="hehun_images/02.gif" width="16" height="16" /><a href="hehun_add.php">我要许愿</a> <img src="hehun_images/03.gif" width="16" height="16" /> <a href="hehun_list.php">福气排行 </a> <img src="hehun_images/05.gif" width="15" height="12" /> <a href="index.php">首页 </a> <img src="hehun_images/06.gif" width="16" height="16" /> <a href="/blog/" target="_blank">博客 </a> </div>
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="List">
	<tr>
		<th>许愿编号</th>
		<th>许愿内容</th>
		<th>发送人</th>
		<th>接收人</th>
		<th>日期</th>
	</tr>
	<tr class="tr">
<?php 
include("inc/coon.php");
$limit=10;
$start=$_GET["start"];
if(empty($start)) $start=0; 
$result=mysql_query("select * from smg_qx"); 
$num_max=mysql_numrows($result); 

$result=mysql_query("select * from smg_qx order by hehun_cs  DESC limit $start,$limit"); 
$num=mysql_numrows($result); 
for ($i=0;$i<$num;$i++) { 
$hehun_id=mysql_result($result,$i,"hehun_id");
$hehun_class=mysql_result($result,$i,"hehun_class"); 
$hehun_images=mysql_result($result,$i,"hehun_images"); 
$hehun_head=mysql_result($result,$i,"hehun_head");
$hehun_sign=mysql_result($result,$i,"hehun_sign");
$hehun_lr=mysql_result($result,$i,"hehun_lr");
$hehun_date=mysql_result($result,$i,"hehun_date");
$top =rand(110,418);
$left=rand(81,625)
?>
	<td class="ListA"><?=$hehun_id?></td>
	<td class="ListB"><a href="index.php"><?=$hehun_lr?></a></td>
	<td class="ListC"><?=$hehun_sign?></td><td class="ListC"><?=$hehun_head?></td>
	<td class="ListD"><?=$hehun_date?></td></tr>   
	<tr>
<?
}
?>
<td colspan="5" class="ListP">
<div align="right"><a href="hehun_list.php">第一页</a>
<? 
$prve=$start-$limit; 
if ($prve>=0) { 
echo "<a href=hehun_list.php?start=$prve>上一页</a>"; 
echo "   ";
} 
//设置向后翻页的跳转 
$next=$start+$limit; 
if ($next<$num_max) { 
echo "<a href=hehun_list.php?start=$next>下一页</a>"; 
} 
?>共<font color=red><?php echo "$num_max" ?></font>条祝福</div></td>
	</tr>
</table><div id="footer">
	<h1>
		<a href="index.php" title="爱墙">首页</a> - 
		<a href="hehun_add.php" title="贴字条">贴字条</a> - 
		<a href="hehun_list.php" title="字条列表">字条列表</a> 
	</h1>
</div></body>
</html>
