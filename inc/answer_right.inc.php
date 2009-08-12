	<div id=right>
			<div id=title><img src="/images/pic/answer_right.gif">排行榜</div>
			<div class=t>个人排行榜</div>
			<div class=content>
				<div class=title><div class=name>姓名</div><div class=score>分数</div></div>
				<?php 
					$db = get_db();
					$sql = 'select nick_name,point from smg_question_record where r_type="wydt" order by point desc limit 5';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=context>
					<div class=name><?php echo $records[$i]->nick_name; ?></div><div class=score><?php echo $records[$i]->point; ?></div>
				</div>
				<?php } ?>
			</div>
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
			<div id=title><img src="/images/pic/answer_right.gif">热门投票</div>
</div>