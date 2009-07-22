<?php
    require_once('../frame.php');
	$id = $_REQUEST['id'];
	$record = new table_class('smg_question_record');
	$record->find($id);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG</title>
	<?php 
		css_include_tag('top.css','bottom.css','answer','answer_right');
	?>
</head>

<?php
	require_once('../inc/top.inc.php');
?>

<div id=ibody>
	<div id=answer>
		<div id=left>
			<div id=title>
				<div id=backup><a target="_blank" href="/">＜＜返回上一页</a></div>
			</div>
			<div id=content>
				<div id=head>
					<div class=title2><span><a href="answerlist.php">答题荟萃</a></span></div>
					<div class=title2><span><a href="question.php">发起答题</a></span></div>
					<div id=line></div>
				</div>
				
				<div id=r_top>
					<div class=t_word>你已经结束了本次答题！</div>
					<div class=t_word></>请选择<a href='answerlist.php'>继续答题</a>,或<a href='/'>返回首页</a></div>
				</div>
				<div id=r_bottom>
					<div class=b_word>本次答题总数：<font color="#000000"><?php echo $record->question_count;?></font></div>
					<div class=b_word>本次答题得分：<font color="#000000"><?php echo $record->point;?></font></div>
					<div class=b_word>
						答题正确率：<font color="#FF9900">
						<?php
							$tot = $record->point*10;
							$tot = $tot/$record->question_count;
							$tot = substr($tot, 0, 2).'%';
							echo $tot;
						?>
					</div>
				</div>
				<div style="width:400px;height:40px;">
				</div>
			</div>
		</div>
		<?php include('../inc/answer_right.inc.php');?>
	</div>
	
</div>

<?php include('../inc/bottom.inc.php');?>
</body>
</html>