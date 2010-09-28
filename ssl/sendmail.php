<?php 
//文本内容 
$text = $_POST['text']; 
//标题 
$subject = $_POST['subject']; 
//发送者 
$from = $_POST['from']; 
//接受者 
$to = 'wangbinsheng@smg.sh.cn'; 
//附件 
$file = $_FILES['upload_file']['tmp_name'];
// 定义分界线 
$boundary = uniqid( ""); 
$headers = "Content-type:multipart/mixed; boundary=\"$boundary\"\r\n";
$headers .= "From:$from\r\n"; 
//确定上传文件的MIME类型 
if($_FILES['upload_file']['type']) 
$mimeType = $_FILES['upload_file']['type']; 
else 
$mimeType ="application/unknown"; 
//文件名 
$fileName = $_FILES['upload_file']['name'];


// 打开文件 
$fp = fopen($file, "r"); 
// 把整个文件读入一个变量 
$read = fread($fp, filesize($file));
//我们用base64方法把它编码 
$read = base64_encode($read);

//把这个长字符串切成由每行76个字符组成的小块 
$read = chunk_split($read);

//现在我们可以建立邮件的主体  
$body = "--$boundary
Content-type: text/plain; charset=iso-8859-1
Content-transfer-encoding: 8bit
$body
--$boundary
Content-type: $mimeType; name=$fileName
Content-disposition: attachment; filename=$fileName
Content-transfer-encoding: base64

$read
--$boundary--";

//发送邮件 
if(mail($to,$subject,$body,$headers)){
	echo '<script language=javascript>alert("发送成功！")</script>';
	echo '<script language=javascript>window.location.href="index.php";</script>';
}
else
{
	echo '<script language=javascript>alert("发送失败！")</script>';
	echo '<script language=javascript>window.location.href="index.php";</script>';
}
?> 
