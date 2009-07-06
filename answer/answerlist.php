<?php
    require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -答题列表</title>
	<?php 
		css_include_tag('top.css','bottom.css','answer.css','answer_right.css');
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
					<div class=title2><span>最新答题</span></div>
					<div class=title1><span>答题荟萃</span></div>
					<div class=title2><span>发起答题</span></div>
					<div id=line></div>
				</div>
				<?php for($i=0;$i<18;$i++){?>
				<div class=listcontext><a target="_blank" href="#">我是流氓我怕谁？</a></div>
				<?php } ?>
			</div>
		</div>
		<?php include('../inc/answer_right.inc.php');?>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>
