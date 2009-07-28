﻿<?php
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
	<?php 
		require_once('../inc/top.inc.php');
		validate_form("vote");
	?>
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
				<form id="vote" action="beginvote.post.php" method="post">
				<div id=question>
					<div id=wz>为哪款手机而烦恼？给宝宝起一个什么名字？今年生日怎么过？那就发动所有好友投票帮你决定吧！你也可以用“投票”来做其他方面的小调查</div>
					<div id=top>
						投票主题：<input type="text"  name="vote[name]" class="required" style="width:250px; border:1px solid #000000;">　　<span id=add_description style="cursor:pointer;">添加详细投票说明</span><br><br>	
						能选几项：<input type="text"  name="vote[max_item_count]" class="required number" style="width:250px; border:1px solid #000000;">
						<div id=description style="margin-top:10px; display:none;">
							答题说明：<textarea name="vote[description]" style="width:280px; border:1px solid #000000;"></textarea>
						</div>
					</div>
					
					<div id=mid>
						<div class=option>侯选项：<input type="text" name="item[0][name]" class="required" style="width:200px; border:1px solid #000000;"></div>
						<div class=option>侯选项：<input type="text" name="item[1][name]" class="required" style="width:200px; border:1px solid #000000;"></div>
						<div class=more id=more>增加更多的侯选项</div><br>
						<div id=btn><button type="submit">发布投票</button></div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<?php include('../inc/vote_right.inc.php');?>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>

<script>
	$(function(){
		var num = 2;
		
		$("#more").click(function(){
			$(this).before('<div class=option>侯选项：<input type="text" name="item['+num+'][name]" class="required" style="width:200px; border:1px solid #000000;"><span style="cursor:pointer; margin-left:15px;" class=del>删除</span></div>')
			num++;
			$(".del").click(function(){
				$(this).parent().remove();
			})
		});
		
		$("#add_description").click(function(){
			$("#description").show();
			$("#description").children().attr('class','required');
		});
	})
</script>
