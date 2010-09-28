	<div id=right>
			<div id=title><img src="/images/pic/answer_right.gif">排行榜</div>
			<div class=t>个人排行榜</div>
			<div class=content>
				<div class=title><div class=name>姓名</div><div class=score>分数</div></div>
				<?php 
					$db = get_db();
					if($_REQUEST['id']!=36){ 
						$sql = 'select nick_name,point from smg_question_record where r_type="wydt" order by point desc limit 5';
					}
					else
					{
						$sql = 'select nick_name,point from smg_question_record where r_type="wydt" and r_id=-1 order by point desc limit 10';	
					}
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=context>
					<div class=name><?php echo $records[$i]->nick_name; ?></div><div class=score><?php echo $records[$i]->point; ?></div>
				</div>
				<?php } ?>
			</div>
			<?php if($_REQUEST['id']!=36){ ?>
			<div class=t>个人每周排行榜</div>
			<div class=content>
				<div class=title><div class=name>姓名</div><div class=score>分数</div></div>
				<?php 
					$sql = 'select nick_name,point from smg_question_record where r_type="wydt" and TO_DAYS(NOW())-TO_DAYS(created_at) <= 7 order by point desc limit 5';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=context>
					<div class=name><?php echo $records[$i]->nick_name; ?></div><div class=score><?php echo $records[$i]->point; ?></div>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			<div id=title><img src="/images/pic/answer_right.gif">热门答题</div>
			<div class=content style="padding-top:10px;">
				<?php 
					$sql = 'select id,title from smg_question where is_adopt=1 order by create_time desc limit 10';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
					<div class=content1 ><a target="_blank" href="/answer/answer.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
				<?php } ?>
			</div>
			
</div>