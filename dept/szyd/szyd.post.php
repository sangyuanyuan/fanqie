<?php
/* recipients */
$to="zhgl@51dab.cn"; // note the comma
$from=$_POST['from'];
$subject = $_POST['subject'];
$message = $_POST['message'];
mail($to,$subject,$message,"From: ".$from."\r\nReply-To: ".$from."\r\n");
echo '<script language=javascript>alert("�ʼ����ͳɹ���")</script>';
echo '<script language=javascript>window.location.href="/szyd/";</script>';
?> 