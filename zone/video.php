<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-视频</title>
	<?php
		css_include_tag('top','bottom','thickbox');
		css_include_tag('zone_video');
		use_jquery();
 	?>
</head>
<body>
	<?php
		require_once('../inc/top.inc.html');
		js_include_once_tag('thickbox');
	?>
	<div id="ibody">
		<div id="top_box"></div>
		<div id="middel_box">
			<div id="comment">
				<div id="comment_show">
					<marquee height="150" width="165" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
					<?php
						$db = get_db();
						$sql = "select nick_name,comment from smg_comment where resource_type='zone_video' order by created_at desc";
						$record = $db->query($sql);
						$count = count($record);
						for($i=0;$i<$count;$i++){
					?>
					<div class="comment_box"><?php echo $record[$i]->nick_name."说：".$record[$i]->comment;?></div>
					<?php
						}
					?>
					</marquee>
				</div>
				<div id="comment_botton"><a class="thickbox" title="请发表留言" href="video_comment.php?height=255&width=320">点击发表评论</a></div>
			</div>
			
			<div id="vote">
				<div id="vote_show">
					<?php
						$db = get_db();
						$sql = "select name,id from smg_vote where category_id=149 and is_adopt=1 order by priority asc,created_at desc limit 8";
						$record = $db->query($sql);
						$count = count($record);
						for($i=0;$i<$count;$i++){
					?>
					<div class="vote_box"><a target="_blank" href="/vote/vote.php?vote_id=<?php echo $record[$i]->id;?>" title="<?php echo name;?>"><?php echo $record[$i]->name;?></a></div>
					<?php
						}
					?>
				</div>
				<div id="vote_botton">投票</div>
			</div>
		</div>
		<div id="bottom_box"></div>
	</div>
	<? require_once('../inc/bottom.inc.php');?>
</body>
<html>