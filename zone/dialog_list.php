<?php
	require_once('../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-对话全文</title>
	<? 	
		css_include_tag('zone_dialog_list','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t></div>
		<?php
			$sql = 'select * from smg_dialog order by create_time desc';
			$record=$db -> query($sql);
		?>
		<?php for($i=0;$i<5;$i++){ ?>
			<div class=l_b>
				<div class=title><a href="" ><?php echo $record[$i]->title ?></a></div>
				<div class=date><?php echo $record[$i]->create_time ?></div>
				<?php if($record[$i]->video_url==""){ ?>
				<img src="<?php echo $record[$i]->photo_url ?>">
				<?php }else{?>
						<div class=video><?php show_video_player('250','130',$record[$i]->photo_url,$record[$i]->video_url,$autostart = "false");?></div>
				<?php }?>
				<div class=content><?php echo $record[$i]->content ?></div>
			</div>
		<?php } ?>
	</div>
	<div id=ibody_right>
		<div id=r_t></div>
		<div id=r_b_title></div>
		<div id=r_b></div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
