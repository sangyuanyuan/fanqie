<?php require_once('../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<style>
		html { overflow-x:hidden; }
		table{width:550px; float:left; display:inline;}
		tr{width:550px; float:left; display:inline;}
		td{width:12.5%;}
	</style>
</head>
<body>
<?php $db=get_db(); 
$news=$db->query('select content from smg_news where id=22505');  
echo get_fck_content($news[0]->content);?>
</body>
</html>