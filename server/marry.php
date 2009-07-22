<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-服务-婚庆</title>
	<? 	
		css_include_tag('server_marry','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_top>
		<div id=t_t></div>
		<div id=t_l>
			<div class=box>
				<?php 
					$db = get_db();
					$sql = 'select * from smg_marry where sex="woman"';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=content>
					<div class=radio><input type="radio" name="woman_choose" value="<?php echo $i+1; ?>"></div>
					<div class=pic><img src="<?php echo $records[$i]->photo;?>" width="102" height="142" border="0"></div>
					<div class=info>
					姓名：<?php echo $records[$i]->name; ?>&nbsp;
					出生年份：<?php echo substr($records[$i]->birthday, 0, 4); ?>&nbsp;
					身高：<?php echo $records[$i]->height; ?></br>
					学历：<?php echo $records[$i]->education; ?>&nbsp;
					毕业学校：<?php echo $records[$i]->school; ?></br>
					职业：<?php echo $records[$i]->job; ?>&nbsp;
					收入：<?php echo $records[$i]->income; ?></br>
					恋爱史：<?php echo $records[$i]->history; ?></br>
					择偶标准：<?php echo $records[$i]->request; ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div id=t_r>
			<div id=wybm><a href="apply.php" target="_blank"><img src="/images/server/wybm.gif" border=0></a></div>
			<div class=box>
				<?php 
					$db = get_db();
					$sql = 'select * from smg_marry where sex="man"';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=content>
					<div class=radio><input type="radio" name="man_choose" value="<?php echo $i+1; ?>"></div>
					<div class=pic><img src="<?php echo $records[$i]->photo;?>" width="102" height="142" border="0"></div>
					<div class=info>
					姓名：<?php echo $records[$i]->name; ?>&nbsp;
					出生年份：<?php echo substr($records[$i]->birthday, 0, 4); ?>&nbsp;
					身高：<?php echo $records[$i]->height; ?></br>
					学历：<?php echo $records[$i]->education; ?>&nbsp;
					毕业学校：<?php echo $records[$i]->school; ?></br>
					职业：<?php echo $records[$i]->job; ?>&nbsp;
					收入：<?php echo $records[$i]->income; ?></br>
					恋爱史：<?php echo $records[$i]->history; ?></br>
					择偶标准：<?php echo $records[$i]->request; ?>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div id=ibody_middle></div>
	<div id=ibody_line></div>
	<div id=ibody_bottom>
		<div class=b1></div>
		<div class=b2></div>
		<div class=b1></div>
		<div class=b2></div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
