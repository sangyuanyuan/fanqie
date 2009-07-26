<?php
	require_once('../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-对话列表</title>
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
			$record=$db -> paginate($sql,5,"param1");
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

		<div id=page1><?php paginate("","","param1");?></div>
	</div>
	
	<div id=ibody_right>
		<a href="dialog_collection.php?width=400&height=250" class="thickbox" id="r_t"></a>
		<div id=r_b>
			<div id=title>征集话题列表</div>
			<?php
				$sql = 'select * from smg_dialog_collection order by create_time desc';
				$record=$db -> paginate($sql,5,"param2");

			?>
			<div id=content>
				<?php for($i=0;$i<count($record);$i++){ ?>
				<div class=box>
					<img src="/images/zone/digg.jpg" style="cursor:pointer" class="digg" id="<?php echo $record[$i]->id?>" > <span class=font3>人气：</span><span class=font3 id="digg<?php echo $record[$i]->id?>"><?php echo $record[$i]->dig?></span><br>
					<span class=font1>发起人：</span><?php echo $record[$i]->use_id?><br>
					<span class=font1>题目：</span><?php echo $record[$i]->title?><br>
					<span class=font1>内容：</span><?php echo $record[$i]->content?><br>
					<span class=font2><?php echo $record[$i]->create_time?></span><br>
				</div>
				<? }?>
			</div>
			<div id=page2><?php paginate("","","param2");?></div>

		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
<script>
$(function(){
	$(".digg").click(function()
	{
		var num=$(this).attr("id");
		var digg=$("#digg"+num).html();
		digg=parseInt(digg)+1;
		$("#digg"+num).html(digg);
		$.post('/zone/dialog.post.php',{'type':'digg','id':num},function(data){
				}
		)

	})		
});


</script>