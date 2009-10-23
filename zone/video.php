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
			
			<div id="thread">
				<div class="thread_show" style="display:none" id="quanzi">
					<?php
						$db = get_db();
						$sql = "select tid,subject,uid from home_thread where tagid=8 order by tid desc limit 8";
						$record = $db->query($sql);
						$count = count($record);
						for($i=0;$i<$count;$i++){
					?>
					<div class="thread_box"><a target="_blank" href="http://172.27.203.81:8080/home/space.php?uid=<?php echo $record[$i]->uid;?>&do=thread&id=<?php echo $record[$i]->tid;?>" title="<?php echo $record[$i]->subject;?>"><?php echo $record[$i]->subject;?></a></div>
					<?php
						}
					?>
				</div>
				<div class="thread_show" id="luntan">
					<?php
						$db = get_db();
						$sql = "select tid,subject from bbs_threads where fid=70 and authorid!=0 order by tid desc limit 8";
						$record = $db->query($sql);
						$count = count($record);
						for($i=0;$i<$count;$i++){
					?>
					<div class="thread_box"><a target="_blank" href="http://172.27.203.81:8080/bbs/viewthread.php?tid=<?php echo $record[$i]->tid;?>" title="<?php echo $record[$i]->subject;?>"><?php echo $record[$i]->subject;?></a></div>
					<?php
						}
					?>
				</div>
				<div id="thread_botton"><a class="change" name="quanzi" target="_blank" href="http://172.27.203.81:8080/home/space.php?do=mtag&tagid=8">圈子</a>|<a style="color:red;" class="change" name="luntan" target="_blank" href="http://172.27.203.81:8080/bbs/forumdisplay.php?fid=70">论坛</a></div>
			</div>
		</div>
		<div id="bottom_box">
			<div id="video">
				<?php
					show_video_player('630','460',$video->photo_url,$video->video_url,$autostart = "false");
				?>
			</div>
		</div>
	</div>
	<? require_once('../inc/bottom.inc.php');?>
</body>
<html>
	
<script>
	$(function(){
		$(".change").hover(function(){
			$(".change").css('color','black');
			$(this).css('color','red');
			$(".thread_show").hide();
			$("#"+$(this).attr('name')).show();
		})
	})
</script>