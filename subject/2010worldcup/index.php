<?php
	require_once('../../frame.php');
    $db = get_db();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -2010世界杯</title>
	<?php css_include_tag('2010worldcup');
		use_jquery();
		js_include_once_tag('total');
	?>
	<script>
		total("2010世界杯专题","zone");
	</script>	
</head>
<body>
	<div id=logo></div>
	<div id=ibody>
		<div id=video></div>
		<div id=worldsoccer>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/worldsoccer_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="">更多内容</a></div>	
			</div>
			<div class=photo><a target="_blank" href=""><img border=0 src="/images/worldcup/2.jpg"></a></div>
			<div class=desc><a target="_blank" href="">阿迪达斯和国际足联在开普敦共同发布2010年南非世界杯官方比赛用球“JABULANI”。“JABULANI”源于非洲祖鲁语，意为“普天同庆”。新的比赛用球在技术上取得历史性突破，设计上则融入了南非元素。</a></div>
			<div class=news_content>
				<?php for($i=0;$i<8;$i++){ ?>
					<div class=context><a target="_blank" href="">哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈</a></div>
				<?php } ?>
			</div>
		</div>
		<div id=video_bottom>
			<?php for($i=0;$i<3;$i++){ ?>
				<div class=pic><img src="/images/worldcup/1.jpg"></div>
			<?php } ?>
		</div>
		<div id=gg><a href=""><img border=0 src="/images/worldcup/gg.jpg" /></div>
		<div id=africa>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/africa_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="">更多内容</a></div>	
			</div>
			<div class=photo><a target="_blank" href=""><img border=0 src="/images/worldcup/2.jpg"></a></div>
			<div class=desc><a target="_blank" href="">阿迪达斯和国际足联在开普敦共同发布2010年南非世界杯官方比赛用球“JABULANI”。“JABULANI”源于非洲祖鲁语，意为“普天同庆”。新的比赛用球在技术上取得历史性突破，设计上则融入了南非元素。</a></div>
			<div class=news_content>
				<?php for($i=0;$i<12;$i++){ ?>
					<div class=context><a target="_blank" href="">哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈</a></div>
				<?php } ?>
			</div>
		</div>
		<div id=comment>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/comment_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="">更多留言</a></div>	
			</div>
			<div id=content>
				<?php for($i=0;$i<5;$i++){ ?>
					<div class=context <?php if($i==0){ ?>style="border-top:none;"<?php } ?>>
						<div class=name>评论者：robbin</div><div class=time>2010-05-28 15:11:00</div>
						<div class=commentcontent>只有观念相同 才会惺惺相惜 迸发如此共鸣吼吼</div>
					</div>
				<?php } ?>
			</div>
			<form>
				<div id=commenter>
					<div id=name>昵称：<input type="text"></div>
					<div id=commentcontent>内容：<textarea></textarea></div>
					<div id=submit>发送留言</div>	
				</div>
			</form>
		</div>
		<div id=racecard>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/racecard_title.jpg"></div>
				<div class="title_more"></div>	
			</div>
			<div id=content>哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈哇哈哈哈哈哈哈</div>
		</div>
		<div id=bottom>
			<div id=turnleft></div>
			<div class=content>
				<?php for($j=0;$j<4;$j++){ ?>
					<div class=pic></div>
				<?php } ?>	
			</div>
			<div id=turnright></div>	
		</div>
	</div>
</body>
</html>

