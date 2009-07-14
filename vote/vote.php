<?php
    require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -投票</title>
	<?php 
		css_include_tag('top.css','bottom.css','vote.css','vote_right.css');
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
					<div class=title2><span>精彩投票</span></div>
					<div class=title1><span>最新投票</span></div>
					<div class=title2><span>发起投票</span></div>
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
		<?php include('../inc/vote_right.inc.php');?>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>

<script>
	$(function(){
		alert('aa');
		alert($("#commenter").attr('value'));
	})
		
</script>
