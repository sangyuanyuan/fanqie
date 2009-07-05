<?php
    require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -答题</title>
	<?php 
		css_include_tag('top.css');
		css_include_tag('bottom.css');
		css_include_tag('answer.css');
	?>
</head>
<body>
	<? require_once('../inc/top.inc.php');?>
	<div id=answer>
		<div id=left>
			<div id=title>
				<div id=backup><a target="_blank" href="#">＜＜返回上一页</a></div>
			</div>
			<div id=content>
				<div id=head>
					<div class=title1><span>最新答题</span></div>
					<div class=title2><span>答题荟萃</span></div>
					<div class=title2><span>发起答题</span></div>
					<div id=line></div>
				</div>
				<?php for($i=0;$i<5;$i++){?>
				<div class=context>
					<div class=l>
						<a target="_blank" href="#"><img border=0 width=65 height=65 src=""></a>
						<a target="_blank" href="#">我是流氓我怕谁</a>
					</div>
					<div class=c>
						<a target="_blank" href="#">我是流氓我怕谁？</a><br>
						<input type="checkbox">老流氓<br>
						<input type="checkbox">流氓老大<br>
						<input type="checkbox">鬼<br>
						·　·　·
					</div>
					<div class=r>
						<span>展开</span>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div id=right>
			<div id=title><img src="/images/pic/answer_right.gif">排行榜</div>
			<?php for($i=0;$i<5;$i++){?>
			<div class=t>个人排行榜</div>
			<div class=content>
				<div class=title><div class=name>姓名</div><div class=score>分数</div></div>
				<?php for($j=0;$j<5;$j++){?>
				<div class=context>
					<div class=name>我是流氓</div><div class=score>100</div>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>
