<?php
	require_once('frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<? 	
		css_include_tag('index');
  ?>
</head>

<body>
<div class=box>
	<?php 
		$db = get_db();
		$sql = 'select * from smg_images where category_id=168 and is_adopt=1 and parent_id='.$_REQUEST['id'].' order by priority asc,created_at desc';
		$records = $db->query($sql);
		$count = count($records);
		for($i=0;$i<$count;$i++){
	?>
	
	<div class=content>
		<div class=pic><img src="<?php echo $records[$i]->src;?>" width="102" height="102" border="0"></div>
		<div class=info>
		姓名：<?php echo $records[$i]->publisher; ?><br>
		留言：<span><?php echo $records[$i]->description; ?></span>
		</div>
	</div>
	<?php } ?>
</div>
</body>
</html>