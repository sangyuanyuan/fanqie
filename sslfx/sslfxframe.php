<?php require_once('../frame.php'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<style>
		html { overflow-x:hidden; }
	</style>
</head>
<body style=" OVERFLOW:SCROLL;OVERFLOW-X:HIDDEN"> 
<?php $db=get_db(); 
$news=$db->query('select content from smg_news where id=22505');  
echo get_fck_content($news[0]->content);?>
</body>
</html>