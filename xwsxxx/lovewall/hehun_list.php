<?php require_once('../../frame.php');?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>番茄网爱墙</title>
<style><!--@import url(inc/style.css);--></style>
<?php use_jquery();
js_include_once_tag('total');
$type=$_REQUEST['id'];
?>
<script>
	total("专题-六一专题","other");
</script>
</head>
<body>
<div style="display:none;" id="aspk" onclick="Hide();"></div>
<div id="header">
	<span style="float:left;"></span>
	<div id="banner">番茄网爱墙</div>
</div>
<div id="menu">
<a href="/bbs" target="_blank"><img src="hehun_images/01.gif" width="27" height="17" /></a>
    <a href="index.php">首页</a>  <img src="hehun_images/05.gif" width="15" height="12" /> <a href="hehun_add.php">我要推荐 </a><img src="hehun_images/02.gif" width="16" height="16" /><a href="hehun_list.php?id=2">推荐排行榜</a> <img src="hehun_images/03.gif" width="16" height="16" /> <a href="hehun_list.php?id=1">人气排行榜 </a></div>
<table width="100%" border="0" cellpadding="0" cellspacing="1" class="List">
	<tr>
		<?php if($type==1){?>
		<th>内容</th>
		<th>发送人</th>
		<th>接收人</th>
		<th>次数</th>
		<th>日期</th>
		<?php }else if($type==2){ ?>
		<th>被推荐人</th>
		<th>被推荐次数</th>
		<?php } ?>
	</tr>

<?php 
include("inc/coon.php");
$limit=10;
$start=$_GET["start"];
if(empty($start)) $start=0; 
$result=mysql_query("select * from centernews_love"); 
$num_max=mysql_numrows($result); 
if($type==1)
{
	$result=mysql_query("select * from centernews_love order by hehun_cs DESC limit 10");
}
else if($type==2)
{
	$result=mysql_query("select hehun_id,hehun_head,count(*) as num from centernews_love group by hehun_head order by num  DESC limit $start,$limit");
}
$num=mysql_numrows($result);
for ($i=0;$i<$num;$i++) {
$top =rand(300,500);
$left=rand(81,625);
if($type==1)
{
$hehun_id=mysql_result($result,$i,"hehun_id");
$hehun_class=mysql_result($result,$i,"hehun_class"); 
$hehun_images=mysql_result($result,$i,"hehun_images"); 
$hehun_head=mysql_result($result,$i,"hehun_head");
$hehun_sign=mysql_result($result,$i,"hehun_sign");
$hehun_lr=mysql_result($result,$i,"hehun_lr");
$hehun_date=mysql_result($result,$i,"hehun_date");
$hehun_cs=mysql_result($result,$i,"hehun_cs");

?>
<tr class="tr">
	<td>><?=$hehun_lr?></td>
	<td><?=$hehun_sign?></td>
	<td><?=$hehun_head?></td>
	<td><?=$hehun_cs?></td>
	<td><?=$hehun_date?></td>
</tr>   

<?
}else if($type==2){
	$hehun_id=mysql_result($result,$i,"hehun_id");
	$hehun_head=mysql_result($result,$i,"hehun_head");
	$count_num=mysql_result($result,$i,"num");?>
<tr class="tr">
	<td><?=$hehun_head?></a></td>
	<td align="center"><?=$count_num?>(<a href="index.php?head=<?=$hehun_head ?>">查看</a>)</td>
</tr> 
<?}
}
?>
<tr>
<td colspan="5" class="ListP">
<div align="right"><a href="hehun_list.php?type=<?php echo $type;?>">第一页</a>
<? 
$prve=$start-$limit; 
if ($prve>=0) { 
echo "<a href=hehun_list.php?type=".$type."start=$prve>上一页</a>"; 
echo "   ";
} 
//设置向后翻页的跳转 
$next=$start+$limit; 
if ($next<$num_max) { 
echo "<a href=hehun_list.php?type=".$type."&start=$next>下一页</a>"; 
} 
?>共<font color=red><?php echo "$num_max" ?></font>条祝福</div></td>
	</tr>
</table><div id="footer">
</div></body>
</html>
