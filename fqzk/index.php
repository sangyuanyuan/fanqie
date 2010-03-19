<?php
	require_once('../frame.php');
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-番茄周刊</title>
	<?php css_include_tag('fqzk','top','bottom');
		use_jquery();
		js_include_once_tag('total');
	 ?>
<script>
	total("番茄周刊","other");
</script>
</head>
<body>
	<? require_once('../inc/top.inc.html');?>
	<div id=ibody>
		<div id=title>
			<div id=wz>番茄周刊</div>
			<div id=qs>第一期</div>
		</div>
		<div id=itop>
			<div id=t_l>
				<div class="l_title">
					<div class="title_name">视频</div>
					<div class="click_count">点击数：次</div>
				</div>
				<div class=video1>
					<img src="">	
				</div>
				<div class="l_title">
					<div class="title_name">视频</div>
					<div class="click_count">点击数：次</div>
				</div>
				<div class=video2>
					<img src="">	
				</div>
				<div class="l_title">
					<div class="title_name">视频</div>
					<div class="click_count">点击数：次</div>
				</div>
				<div class=video3>
					<img src="">		
				</div>
				<div class="l_title">
					<div class="title_name">视频</div>
					<div class="click_count">点击数：次</div>
				</div>
				<div class=video2>
					<img src="">	
				</div>
			</div>
			<div id=t_c>
					<div id=c_title>视频</div>
					<div id=video><iframe id=video_src src="index_video.php?photo=<?php echo $record_video[0]->video_photo_src; ?>&video=<?php echo $record_video[0]->video_src ?>" width=491 height=388 scrolling="no" frameborder="0"></iframe></div>
			</div>
			<div id=t_r>
				<div class="l_title">
					<div class="title_name">视频</div>
					<div class="click_count">点击数：次</div>
				</div>
				<div class=video3>
					<img src="">	
				</div>
				<div class="l_title">
					<div class="title_name">视频</div>
					<div class="click_count">点击数：次</div>
				</div>
				<div class=video1>
					<img src="">	
				</div>
				<div class="l_title">
					<div class="title_name">视频</div>
					<div class="click_count">点击数：次</div>
				</div>
				<div class=video3>
					<img src="">		
				</div>
				<div class="l_title">
					<div class="title_name">视频</div>
					<div class="click_count">点击数：次</div>
				</div>
				<div class=video2>
					<img src="">	
				</div>
			</div>
		</div>
		<div id=t_b></div>
	</div>
	<? require_once('../inc/bottom.inc.html');?>
</body>
</html>