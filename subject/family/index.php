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
		<div style="width:1000px; height:10px; float:left; display:inline"></div>
		<div id="video_l">
			<div id=light></div>
			<div id="video">
				
				<div id="video_content">
					<iframe id=video_src src="video.php?photo=<?php echo $record_video[0]->video_photo_src;?>&video=<?php echo $record_video[0]->video_src;?>" width=422 height=317 scrolling="no" frameborder="0"></iframe>
				</div>
			</div>
		</div>
		<div id="video_right">
			<?php for($i=0;$i<3;$i++){ ?>
				<div class=video_r>
						<div class="video_img">
							<div class="video_image"><img border=0 src="images/style.jpg"></div>
						</div>	
						<div class="video_vote"><div class="title">视频1</div><div class="vote"><a target="_blank" href="">投票</a></div></div>
				</div>
			<?php } ?>
		</div>
		<div id=t_r>
			<div id=t_r_title>
				<div id="title">视频内容</div>
				<div id=more><a target="_blank" href="">历史视频>></a></div>
			</div>
			<div id=t_r_b>
				<div id=content>
					<div id="left"><a target="_blank" href=""><img src="images/style2.jpg"></a></div>
					<div id="right">
						<div id="title"><a target="_blank" href="">哇哈哈哈哈哈哈哈哈哈哈哈哈哈哈</a></div>
						<div id=context><a target="_blank" href=""><?php echo mb_substr(strip_tags($record[0]->content),0,15,"utf-8")."...";?></a></div>
						<div id="tp"><a href="">投票</a></div>
					</div>
				</div>
				<?php for($i=0;$i<4;$i++){ ?>
				<div class=content>
					<div class=content_l>
						<a target="_blank" href=""><img src="images/style3.jpg"></a>	
					</div>
					<div class=content_c>
						<div class=title><a target="_blank" href="">哇哈哈哈哈哈哈哈哈哈</a></div>
						<div class=context><a target="_blank" href=""><?php echo mb_substr(strip_tags($record[0]->content),0,15,"utf-8")."...";?></a></div>
					</div>
					<div class=content_r>
						<a href="">投票</a>	
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div id="video_b"></div>
	</div>
</body>
</html>