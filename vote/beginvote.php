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
					<div class=title2><span>最新投票</span></div>
					<div class=title1><span>发起投票</span></div>
					<div id=line></div>
				</div>
				<div id=question>
					<div id=wz>为哪款手机而烦恼？给宝宝起一个什么名字？今年生日怎么过？那就发动所有好友投票帮你决定吧！你也可以用“投票”来做其他方面的小调查</div>
					<div id=top>
						投票主题：<input type="text" style="width:280px; border:1px solid #000000;">　　　<span>添加详细投票说明</span>
					</div>
					<div id=mid>
						<?PHP for($i=0;$i<10;$i++){ ?>
							<div class=option>侯选项<? echo $i+1;?>：<input type="text" style="width:200px; border:1px solid #000000;"></div>
							<?PHP if($i==9){?><div class=more>增加更多的选项</div><?PHP }?>
						<? }?>
						<div id=btn><button>发布投票</button></div>
					</div>
				</div>
			</div>
		</div>
		<?php include('../inc/vote_right.inc.php');?>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>
