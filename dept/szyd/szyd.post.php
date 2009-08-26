<?php
/* recipients */
$to="zhgl@51dab.cn"; // note the comma
$from=$_POST['from'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$target_url=$_POST['target_url'];
mail($to,$subject,$message,"From: ".$from."\r\nReply-To: ".$from."\r\n");
echo '<script language=javascript>alert("邮件发送成功！")</script>';
echo '<script language=javascript>window.location.href="'.$target_url.'";</script>';
?> 