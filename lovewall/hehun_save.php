<?php
  include("inc/coon.php");
  include("inc/number.php");
 	$hehun_class=hehun_convet($_POST["face"]);
 	$hehun_images=hehun_convet($_POST["icon"]);
 	$hehun_head=hehun_convet($_POST["pick"]);
 	$hehun_sign=hehun_convet($_POST["send"]);
 	$hehun_lr=hehun_convet($_POST["info"]);
 	$today = date("Y-m-d G:i:s");  
 	$ip=$HTTP_COOKIE_VARS["lovewall"];
if( !$hehun_head || !$hehun_sign || !$hehun_lr) { 
die("<script>alert('所有表单必须填写！');history.back();</script>"); 
}	
if(!ereg("[0-9-]",$hehun_class)){
die("<script>alert('输入错误，请返回重填！');history.back();</script>");
}
if(!ereg("[0-9-]",$hehun_images)){
die("<script>alert('输入错误，请返回重填！');history.back();</script>");
}
if(strlen($hehun_head)>16 || strlen($hehun_sign)>16){
die("<script>alert('发送人或祝福人姓名过长，请返回重填！');history.back();</script>");
}
if(strlen($hehun_lr)>140){
die("<script>alert('发送人内容过长，请返回重填！');history.back();</script>");
}
$sql = "INSERT INTO hehun_love (hehun_class,hehun_images,hehun_head,hehun_sign,hehun_lr,hehun_date,ip) VALUES ($hehun_class,'$hehun_images','$hehun_head','$hehun_sign','$hehun_lr','$today','$ip')";   //构造sql语句
$result = mysql_query($sql);
echo '<SCRIPT language=JavaScript>alert("您的祝福已发出！")</SCRIPT><meta http-equiv="refresh" content="0;URL=index.php">'; exit;
?>