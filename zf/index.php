<?php
require_once('../frame.php');
		if($HTTP_COOKIE_VARS["lovewall"]==""){
		SetCookie("lovewall",$_SERVER["SERVER_ADDR"]); 
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上海广播电视台、上海东方传媒（集团）有限公司期许</title>
<style><!--@import url(inc/style.css);--></style>
<?php use_jquery();
js_include_once_tag('total');
?>
<script>
	total("地震祝福","other");
</script>
</head>
<body>
<div style="display:none;" id="aspk" onclick="Hide();"></div>
<div id="header">
</div>
<div id="main">
	<script type="text/javascript" src="inc/index.js"></script>
<?php 
include("inc/coon.php");
$lovewall_id=$_REQUEST['id'];
if($lovewall_id!=""&&$lovewall_ip!=""){
	$result=mysql_query("select * from smg_qx where ip='".$lovewall_ip."' order by hehun_id");
}else{
	$result=mysql_query("select * from smg_qx order by hehun_id"); 
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
<p class="Num">祈福编号：<?=$hehun_head?><img src="hehun_images/close.gif" alt="关闭" onclick="Close(<?=$hehun_id?>)" /></p><p class="Detail"><img width=50 height=50 alt="" src="<?=$hehun_images?>" /><span class="Head"><?=$hehun_head?></span><br /><?=$hehun_lr?></p><p class="Sign"><table class="Sign"width="95%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="left"><a href="zf.php?id=<?=$hehun_id?>" title="点击祈福">我要祈福：<?=$hehun_cs?>次</a></div></td>
    <td><div align="right"><?=$hehun_sign?></div></td>
  </tr>
</table></p><p class="Date"><?=$hehun_date?></p></div>	
<?php
}
?>
</div>
</body>
</html>
