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
		css_include_tag('top.css','bottom.css','answer.css','answer_right.css','jquery_ui');
		use_jquery_ui();
		js_include_once_tag('My97DatePicker/WdatePicker.js');
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
					<div class=title2><span>答题荟萃</span></div>
					<div class=title1><span>发起答题</span></div>
					<div id=line></div>
				</div>
				<div id=question>
					<div id=wz>想炫下你的知识？想知道除了你还有谁知道这事？有些问题你也不清楚？那就发动好友来答题吧！你也可以用“答题”来了解不知道的东西。</div>
					<div id=top>
						答题主题：<input type="text" style="width:280px; border:1px solid #000000;">　　　<span>添加详细答题说明</span>
					</div>
					<div id=mid>
						题目：<input type="text" style="width:200px; border:1px solid #000000;"><br>
						<div class=option>选项A：<input type="text" style="width:200px; border:1px solid #000000;"><input type="checkbox">此为正解</div>
						<div class=option>选项B：<input type="text" style="width:200px; border:1px solid #000000;"><input type="checkbox">此为正解</div>
						<div class=option>选项C：<input type="text" style="width:200px; border:1px solid #000000;"><input type="checkbox">此为正解</div>
						<div class=more>增加更多的选项</div><br>
						<button>发布答题</button>
					</div>
				</div>
				
			</div>
			
		</div>
		<?php include('../inc/answer_right.inc.php');?>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>
<script>
	$(".date_jquery").datepicker(
			{
				monthNames:['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
				dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dayNamesMin:["日","一","二","三","四","五","六"],
				dayNamesShort:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
				dateFormat: 'yy-mm-dd'
			}
	);
</script>
