<?php
	$db = get_db();
	$latest_votes = $db->query("select * from smg_vote where is_sub_vote = 0 and  is_adopt=1 order by id desc limit 10");
?>
<div id=right>
			<div id=title><img src="/images/pic/answer_right.gif">热门投票</div>
			<?PHP for($i=0;$i<count($latest_votes);$i++){?>
				<div class=content><a target="_blank" href="/vote/vote.php?vote_id=<?php echo $latest_votes[$i]->id;?>"><?php echo strip_tags($latest_votes[$i]->name);?></a></div>
			<?PHP }?>		
</div>