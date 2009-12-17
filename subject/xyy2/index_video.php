<?php
	require_once('../../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<? 	
		css_include_tag('index');
		$db=get_db();
		$record=$db->query('select photo_url,video_url from smg_video where id='.$_REQUEST['id']);
  ?>
</head>
<body>
<?php show_video_player('309','238',$record[0]->photo_url,$record[0]->video_url); ?>
</body>
</html>