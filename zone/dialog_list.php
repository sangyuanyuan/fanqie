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
		css_include_tag('zone_dialog_list','top','bottom','thickbox');
		use_jquery();
		js_include_tag('thickbox');
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t></div>
		<?php
		
			$sql = 'select * from smg_dialog order by create_time desc';
			$record=$db -> paginate($sql,1);
		?>
		<?php for($i=0;$i<count($record);$i++){ ?>
			<div class=l_b>
				<div class=title><a href="dialog.php?id=<?php echo $record[$i]->id?>" target=_blank><?php echo $record[$i]->title ?></a></div>
				<div class=date><?php echo $record[$i]->create_time ?></div>
				<?php if($record[$i]->video_url==""){ ?>
				<img src="<?php echo $record[$i]->photo_url ?>">
				<?php }else{?>
						<div class=video><?php show_video_player('250','130',$record[$i]->photo_url,$record[$i]->video_url,$autostart = "false");?></div>
				<?php }?>
				<div class=content><?php echo $record[$i]->content ?></div>
			</div>
		<?php } ?>
		<div id=page1><?php paginate();?></div>
	</div>
	<div id=ibody_right>
		<a href="dialog_collection.php?width=400&height=250" class="thickbox" id="r_t"></a>
		<div id=r_b>
			<div id=title>征集话题列表</div>
			<?php
				$sql = 'select * from smg_dialog_collection order by create_time desc limit 10';
				$record=$db -> query($sql);
			?>
			<div id=content>
				<div class=box></div>
				
			</div>
		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
