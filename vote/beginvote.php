<?php
    require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-服务-发起投票</title>
	<?php 
		css_include_tag('top.css','bottom.css','vote.css','vote_right.css');
		js_include_tag('total');
	?>
</head>
<script>
	total("发起投票","server");	
</script>
<body>
	<?php 
		require_once('../inc/top.inc.php');
		validate_form("vote");
	?>
	<div id=answer>
		<div id=left>
			<div id=title>
				<div id=backup><a target="_blank" href="/">返回首页</a></div>
			</div>
			<div id=content>
				<div id=head>
					<div class=title2><span><a href="vote_list.php">最新投票</a></span></div>
					<div class=title1><span>发起投票</span></div>
					<div id=line></div>
				</div>
				<form id="vote" action="beginvote.post.php" method="post">
				<div id=question>
					<div id=wz></div>
					<div id=top>
						投票题目：<input type="text" id="vote_name"  name="vote[name]" class="required" style="width:250px; border:1px solid #000000;"><br><br>	
						能选几项：<input type="text"  name="vote[max_item_count]" value="1" class="required number" style="width:250px; border:1px solid #000000;">(1为单选,2以上为多选)<br><br>
						姓&nbsp&nbsp&nbsp&nbsp名：<input type="text"  name="vote[publisher]" value="<?php echo $_COOKIE['smg_user_nickname'];?>" class="required" style="width:250px; border:1px solid #000000;">
						<div id=description style="margin-top:10px; ">
							投票说明：<textarea name="vote[description]"  class="required" id="vote_description" style="width:280px; border:1px solid #000000;"></textarea>
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
			
	
	})
</script>
