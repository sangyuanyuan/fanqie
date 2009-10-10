<?php
	require_once('../../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-专题-全家都来赛</title>
	<LINK href="css/index.css" type=text/css rel=stylesheet>
	<?php 
		
	?>
</head>
<body>
	<div id="fbody">
		<div id=ftop>
			<div id="bmrs">88888</div>
		</div>
		<div style="width:1000px; height:20px; float:left; display:inline"></div>
		<div id="video">
			<div id="video_content">
				<iframe id=video_src src="video.php?photo=<?php echo $record_video[0]->video_photo_src;?>&video=<?php echo $record_video[0]->video_src;?>" width=422 height=317 scrolling="no" frameborder="0"></iframe>
			</div>
		</div>
		<div class="video_img"></div>
	</div>
</body>
</html>