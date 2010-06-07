<?php
	require_once('../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
</head>
<body scroll="no">
	<?php
		$content=$db->query("select content from smg_pop_task order by created_at desc limit 1");
	 echo get_fck_content($content[0]->content);
	 ?>
</body>
</html>