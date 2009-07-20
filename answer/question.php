<?php
    require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -发起答题</title>
	<?php 
		css_include_tag('top.css','bottom.css','answer.css','answer_right.css');
		use_jquery();
	?>
</head>
<body>
	<?php
		require_once('../inc/top.inc.php');
		validate_form("question");
	?>
	<div id=answer>
		<div id=left>
			<div id=title>
				<div id=backup><a target="_blank" href="/">＜＜返回上一页</a></div>
			</div>
			<div id=content>
				<div id=head>
					<div class=title2><span>最新答题</span></div>
					<div class=title2><span>答题荟萃</span></div>
					<div class=title1><span>发起答题</span></div>
					<div id=line></div>
				</div>
				<form id="question" action="question.post.php" method="post">
				<div id=question>
					<div id=wz>想炫下你的知识？想知道除了你还有谁知道这事？有些问题你也不清楚？那就发动好友来答题吧！你也可以用“答题”来了解不知道的东西。</div>
					<div id=top>
						答题主题：<input type="text" name="question[theme]" style="width:280px; border:1px solid #000000;" class="required">　　　<span id=add_description style="cursor:pointer;">添加详细答题说明</span></br>
						<div id=description style="margin-top:10px; display:none;">
							答题说明：<textarea name="question[description]" style="width:280px; border:1px solid #000000;"></textarea>
						</div>
					</div>
					<div id=mid>
						题目：<input type="text" class="required" name="question[title]" style="width:200px; border:1px solid #000000;"><br>
						<div class=option>选项：<input type="text" name="item[0][name]" class="required" style="width:200px; border:1px solid #000000;"><input class="checkbox" type="checkbox" name=item[0][attribute]>此为正解</div>
						<div class=option>选项：<input type="text" name="item[1][name]" class="required" style="width:200px; border:1px solid #000000;"><input class="checkbox "type="checkbox" name=item[1][attribute]>此为正解</div>
						<div class=more id=more>增加更多的选项</div><br>
						<button id=submit type="submit">发布答题</button>
					</div>
				</div>
				</form>
			</div>
			
		</div>
		<?php include('../inc/answer_right.inc.php');?>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>
<script>
	$(function(){
		var num = 2;
		var flag = false;
		
		$("#more").click(function(){
			$(this).before('<div class=option>选项：<input type="text" class="required" name="item['+num+'][name]" style="width:200px; border:1px solid #000000;"><input type="checkbox" class=checkbox name=item['+num+'][attribute]>此为正解<span style="cursor:pointer; margin-left:5px;" class=del>删除</span></div>')
			num++;
			$(".del").click(function(){
				$(this).parent().remove();
			})
		});
		
		$("#add_description").click(function(){
			$("#description").show();
			$("#description").children().attr('class','required');
		});
		
		$("#submit").click(function(){
			$(".checkbox").each(function(){
				if($(this).attr('checked'))flag=$(this).attr('checked');
			});
			if(!flag){
				alert('请至少选择一个正确答案！');
				return false;
			}
		});
	});
	
</script>
