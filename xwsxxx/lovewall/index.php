<?php
require_once('../../frame.php');
		if($HTTP_COOKIE_VARS["lovewall"]==""){
		SetCookie("lovewall",$_SERVER["SERVER_ADDR"]); 
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>电视新闻中心三项学习教育</title>
<style><!--@import url(inc/style.css);--></style>
<?php use_jquery();
js_include_once_tag('total');
?>
<script>
	total("电视新闻中心三项学习教育","other");
</script>
</head>
<body>
<div id="header">
</div><div id="menu">
	<?php $lovewall_ip=$HTTP_COOKIE_VARS["lovewall"];?>
	<a href="/bbs" target="_blank"><img src="hehun_images/01.gif" width="27" height="17" /></a>
    <a href="index.php">首页</a> <img src="hehun_images/02.gif" width="16" height="16" /><a href="hehun_list.php?id=2">推荐排行榜</a> <img src="hehun_images/03.gif" width="16" height="16" /> <a href="hehun_list.php?id=1">人气排行榜 </a> <img src="hehun_images/05.gif" width="15" height="12" /> <a href="hehun_add.php">我要推荐 </a></div>
<div id="main">
	<script type="text/javascript" src="inc/index.js"></script>
<?php 
include("inc/coon.php");
$lovewall_name=$_REQUEST['name'];
if($lovewall_ip!=""){
	$result=mysql_query("select * from centernews_love where ip='".$lovewall_ip."' order by hehun_id");
}else{
	$result=mysql_query("select * from centernews_love where hehun_sign='".$lovewall_name."' order by hehun_id");
}
$db=get_db();
$num=mysql_numrows($result); 
for ($i=0;$i<$num;$i++) { 
$hehun_id=mysql_result($result,$i,"hehun_id");
$commentnum=$db->query("select count(*) as num from smg_comment where resource_id=".$hehun_id." and resource_type='newscenter_sxxx'");
$hehun_class=mysql_result($result,$i,"hehun_class"); 
$hehun_images=mysql_result($result,$i,"hehun_images"); 
$hehun_head=mysql_result($result,$i,"hehun_head");
$hehun_sign=mysql_result($result,$i,"hehun_sign");
$hehun_lr=mysql_result($result,$i,"hehun_lr");
$hehun_date=mysql_result($result,$i,"hehun_date");
$hehun_cs=mysql_result($result,$i,"hehun_cs");
$top =rand(300,500);
$left=rand(81,625)
?>
<div id="Layer<?=$hehun_id?>" class="Face<?=$hehun_class?>" style="top:<?=$top?>px;left:<?=$left?>px;z-index:1" onmousedown="Move(this,event)" ondblclick="Show(1)">
<p class="Num">被推荐人：<?=$hehun_head?><img src="hehun_images/close.gif" alt="关闭" onclick="Close(<?=$hehun_id?>)" /></p><p class="Detail"><img width=50 height=50 alt="" src="<?=$hehun_images?>" />
	<span class="Head"><?=$hehun_head?></span><br /><a target="_blank" href="news.php?id=<?=$hehun_id; ?>"><?=$hehun_lr?></p><p class="Sign"><table class="Sign"width="95%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="left"><a href="zf.php?id=<?=$hehun_id;?>" title="我要献花">我要献花：<?=$hehun_cs?>次</a></div></td>
    <td><div align="left"><a href="news.php?id=<?=$hehun_id;?>">我要评论：<?=$commentnum[0]->num;?>次</div></td>
    <td><div align="right"><?=$hehun_sign?></div></td>
  </tr>
</table></p><p class="Date"><?=$hehun_date?></p></div>
<?php
}
?>
</div>
</body>
</html>
