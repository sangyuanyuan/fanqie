﻿<?php
require_once('../../../frame.php');
		if($HTTP_COOKIE_VARS["lovewall"]==""){
		SetCookie("lovewall",$_SERVER["SERVER_ADDR"]); 
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>番茄网爱墙</title>
<style><!--@import url(inc/style.css);--></style>
<?php use_jquery();
js_include_once_tag('total');
?>
<script>
	total("专题-六一专题","other");
</script>
</head>
<body>
<div style="display:none;" id="aspk" onclick="Hide();"></div>
<div id="header">
	<span style="float:left;"></span>
	<div id="banner" style="font-size:20px; font-weight:bold; line-height:20px; color:#ff0000;">全体番茄小编们祝SMG宝宝们节日快乐！</div>
</div><div id="menu">
	<?php $lovewall_ip=$HTTP_COOKIE_VARS["lovewall"];?>
	<a href="/bbs" target="_blank"><img src="hehun_images/01.gif" width="27" height="17" /></a>
    <a href="index.php?id=1">我的祝福</a> <img src="hehun_images/02.gif" width="16" height="16" /><a href="hehun_add.php">我要祝福</a> <img src="hehun_images/03.gif" width="16" height="16" /> <a href="hehun_list.php">福气排行 </a> <img src="hehun_images/05.gif" width="15" height="12" /> <a href="index.php">首页 </a> <img src="hehun_images/06.gif" width="16" height="16" /> <a href="/blog/" target="_blank">博客 </a> </div>
<div id="main">
	<script type="text/javascript" src="inc/index.js"></script>
<?php 
include("inc/coon.php");
$lovewall_id=$_REQUEST['id'];
if($lovewall_id!=""&&$lovewall_ip!=""){
	$result=mysql_query("select * from hehun_love where ip='".$lovewall_ip."' order by hehun_id");
}else{
	$result=mysql_query("select * from hehun_love order by hehun_id"); 
}
$num=mysql_numrows($result); 
for ($i=0;$i<$num;$i++) { 
$hehun_id=mysql_result($result,$i,"hehun_id");
$hehun_class=mysql_result($result,$i,"hehun_class"); 
$hehun_images=mysql_result($result,$i,"hehun_images"); 
$hehun_head=mysql_result($result,$i,"hehun_head");
$hehun_sign=mysql_result($result,$i,"hehun_sign");
$hehun_lr=mysql_result($result,$i,"hehun_lr");
$hehun_date=mysql_result($result,$i,"hehun_date");
$hehun_cs=mysql_result($result,$i,"hehun_cs");
$top =rand(110,418);
$left=rand(81,625)
?>
<div id="Layer<?=$hehun_id?>" class="Face<?=$hehun_class?>" style="top:<?=$top?>px;left:<?=$left?>px;z-index:1" onmousedown="Move(this,event)" ondblclick="Show(1)">
<p class="Num">爱墙编号：<?=$hehun_head?><img src="hehun_images/close.gif" alt="关闭" onclick="Close(<?=$hehun_id?>)" /></p><p class="Detail"><img width=50 height=50 alt="" src="<?=$hehun_images?>" /><span class="Head"><?=$hehun_head?></span><br /><?=$hehun_lr?></p><p class="Sign"><table class="Sign"width="95%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="left"><a href="zf.php?id=<?=$hehun_id?>" title="点击祝福">我要祝福：<?=$hehun_cs?>次</a></div></td>
    <td><div align="right"><?=$hehun_sign?></div></td>
  </tr>
</table></p><p class="Date"><?=$hehun_date?></p></div>	
<?php
}
?>
</div>
<div id="footer">
	<h1>
		<a href="index.php" title="爱墙">首页</a> - 
		<a href="hehun_add.php" title="贴字条">贴字条</a> - 
		<a href="hehun_list.php" title="字条列表">字条列表</a>
	</h1>
</div>
</body>
</html>
