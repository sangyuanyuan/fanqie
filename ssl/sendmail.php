<?php 
//�ı����� 
$text = $_POST['text']; 
//���� 
$subject = $_POST['subject']; 
//������ 
$from = $_POST['from']; 
//������ 
$to = 'wangbinsheng@smg.sh.cn'; 
//���� 
$file = $_FILES['upload_file']['tmp_name'];
// ����ֽ��� 
$boundary = uniqid( ""); 
$headers = "Content-type:multipart/mixed; boundary=\"$boundary\"\r\n";
$headers .= "From:$from\r\n"; 
//ȷ���ϴ��ļ���MIME���� 
if($_FILES['upload_file']['type']) 
$mimeType = $_FILES['upload_file']['type']; 
else 
$mimeType ="application/unknown"; 
//�ļ��� 
$fileName = $_FILES['upload_file']['name'];


// ���ļ� 
$fp = fopen($file, "r"); 
// ������ļ�����һ��� 
$read = fread($fp, filesize($file));
//������base64����������� 
$read = base64_encode($read);

//������ַ��г���ÿ��76���ַ���ɵ�С�� 
$read = chunk_split($read);

//�������ǿ��Խ�b�ʼ�������  
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

//�����ʼ� 
if(mail($to,$subject,$body,$headers)){
	echo '<script language=javascript>alert("���ͳ发送成功！")</script>';
	echo '<script language=javascript>window.location.href="index.php";</script>';
}
else
{
	echo '<script language=javascript>alert("����ʧ�ܣ�发送失败！")</script>';
	echo '<script language=javascript>window.location.href="index.php";</script>';
}
?> 
