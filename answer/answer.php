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
					<div class=title1><span>最新答题</span></div>
					<div class=title2><span>答题荟萃</span></div>
					<div class=title2><span>发起答题</span></div>
					<div id=line></div>
				</div>
				<?php 
					$db = get_db();
					$sql = 'select id,title from smg_question where is_adopt=1 order by create_time desc';
					$record1 = $db->paginate($sql,5);
					$count = count($record1);
					$question_ids = $record1[0]->id;
					for($i=1;$i<$count;$i++){
						$question_ids = $question_ids.','.$record1[$i]->id;
					}
					$sql = 'select name,question_id from smg_question_item where question_id in('.$question_ids.') order by question_id';
					$record2 = $db->query($sql);
					for($i=0;$i<$count;$i++){?>
				<div class=context>
					<div class=c>
						<div class=title><a target="_blank" href="#"><?php echo $record1[$i]->title;?></a></div>
						<?php 
							$j = 0;
							$k = 0;
							while($record2[$j]->question_id){
								if($record2[$j]->question_id==$record1[$i]->id){
									$k++;
						?>
						<input type="checkbox"><?php echo $record2[$j]->name; ?><br>
						<?
								}
								if($k==3)break;
								$j++;
							}
						?>
						·　·　·
					</div>
				</div>
				<?php } ?>
				<div id=paginate><?php paginate();?></div>
			</div>
		</div>
		<?php include('../inc/answer_right.inc.php');?>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>
