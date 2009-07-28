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
				<div id=backup><a target="_blank" href="/">＜＜返回上一页</a></div>
			</div>
			<div id=content>
				<div id=head>
					<div class=title1><span><a href="answerlist.php">答题荟萃</a></span></div>
					<div class=title2><span><a href="question.php">发起答题</a></span></div>
					<div id=line></div>
				</div>
				<?php
					$db = get_db();
					$sql = 'select id,title from smg_question where is_adopt=1 order by create_time desc';
					$records = $db->paginate($sql,18);
					close_db();
					$count = count($records);
					for($i=0;$i<$count;$i++){?>
				<div class=listcontext><a target="_blank" href="answer.php?id=<?php echo $records[$i]->id; ?>"><?php echo $records[$i]->title;?></a></div>
				<?php } ?>
				<div id=paginate><?php paginate();?></div>
			</div>
		</div>
		<?php include('../inc/answer_right.inc.php');?>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>
