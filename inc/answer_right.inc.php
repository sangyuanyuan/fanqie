<div id=right>
			<div id=title><img src="/images/pic/answer_right.gif">排行榜</div>
			<div class=t>个人排行榜</div>
			<div class=content>
				<div class=title><div class=name>姓名</div><div class=score>分数</div></div>
				<?php 
					$db = get_db();
					$sql = 'select nick_name,point from smg_question_record order by point desc limit 5';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=context>
					<div class=name><?php echo $records[$i]->nick_name; ?></div><div class=score><?php echo $records[$i]->point; ?></div>
				</div>
				<?php } ?>
			</div>
			<div class=t>部门排行榜</div>
			<div class=content>
				<div class=title><div class=name>部门</div><div class=score>总分</div></div>
				<?php 
					$sql = 'select sum(t1.point) as point,t2.name as name from smg_question_record t1 join smg_dept t2 on t1.dept_id=t2.id group by t1.dept_id order by sum(t1.point) desc limit 5';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=context>
					<div class=name><?php echo $records[$i]->name; ?></div><div class=score><?php echo $records[$i]->point; ?></div>
				</div>
				<?php } ?>
			</div>
			<div class=t>部门每周排行榜</div>
			<div class=content>
				<div class=title><div class=name>部门</div><div class=score>得分</div></div>
				<?php 
					$sql = 'select sum(t1.point) as point,t2.name as name from smg_question_record t1 join smg_dept t2 on t1.dept_id=t2.id where week(t1.created_at)=week("'.date("Y-m-d").'") group by t1.dept_id order by sum(t1.point) desc limit 5';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=context>
					<div class=name><?php echo $records[$i]->name; ?></div><div class=score><?php echo $records[$i]->point; ?></div>
				</div>
				<?php } ?>
			</div>
			<div class=t>部门参与人数</div>
			<div class=content>
				<div class=title><div class=name>部门</div><div class=score>人数</div></div>
				<?php 
					$sql = 'select count(t1.point) as count,t2.name as name from smg_question_record t1 join smg_dept t2 on t1.dept_id=t2.id group by t1.dept_id order by sum(t1.point) desc limit 5';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=context>
					<div class=name><?php echo $records[$i]->name; ?></div><div class=score><?php echo $records[$i]->count; ?></div>
				</div>
				<?php } ?>
			</div>
			<div class=t>部门每周参与人数</div>
			<div class=content>
				<?php 
					$sql = 'select count(t1.point) as count,t2.name as name from smg_question_record t1 join smg_dept t2 on t1.dept_id=t2.id where week(t1.created_at)=week("'.date("Y-m-d").'") group by t1.dept_id order by sum(t1.point) desc limit 5';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=context>
					<div class=name><?php echo $records[$i]->name; ?></div><div class=score><?php echo $records[$i]->count; ?></div>
				</div>
				<?php } ?>
			</div>
</div>