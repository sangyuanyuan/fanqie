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
		css_include_tag('top','bottom','thickbox','zone_video');
		use_jquery();
 	?>
</head>
<body>
	<?php
		require_once('../inc/top.inc.html');
		js_include_once_tag('thickbox');
		$db=get_db();
		$pic="select i.src,i.id,i.src2 from smg_images i left join smg_category c on i.category_id=c.id where c.category_type='picture' and c.name='高清电影海报' order by i.priority asc,i.created_at desc";
		$photo=$db->query($pic);
	?>
	<div id="ibody">
		<div id="top_box">
			<div id="bbs">
				<?php 
					$sql="select tid,subject from bbs_threads where fid=72 and authorid!=0 order by tid desc limit 4";
					$record=$db->query($sql);
					for($i=0;$i<count($record);$i++)
					{
				 ?>
				<div class="context"><a target="_blank" href="http://172.27.203.81:8080/bbs/viewthread.php?tid=<?php echo $record[$i]->tid;?>" title="<?php echo $record[$i]->subject;?>"><span style="font-weight:bold;">☉</span><?php echo $record[$i]->subject;?></a></div>
				<?php } ?>
			</div>
		</div>
		<div id="middel_box">
			<div id=left>
				<div id="left_pic1"><a target="_blank" href="images.php?id=<?php echo $photo[0]->id; ?>"><img border=0 src="<?php echo $photo[0]->src; ?>"></a></div>
				<div id="left_pic2"><a target="_blank" href="images.php?id=<?php echo $photo[1]->id; ?>"><img border=0 src="<?php echo $photo[1]->src; ?>"></a></div>
			</div>
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
					<div class="comment_box"><span style="color:#FFCC00"><?php echo $record[$i]->nick_name?>说:</span><?php echo $record[$i]->comment;?></div>
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
				<div class="thread_show" style="display:block" id="quanzi">
					<?php
						$db = get_db();
						$sql = "select tid,subject,uid from home_thread where tagid=8 order by tid desc limit 8";
						$record = $db->query($sql);
						$count = count($record);
						for($i=0;$i< $count;$i++){
					?>
					<div class="thread_box"><a target="_blank" href="http://172.27.203.81:8080/home/space.php?uid=<?php echo $record[$i]->uid;?>&do=thread&id=<?php echo $record[$i]->tid;?>" title="<?php echo $record[$i]->subject;?>"><?php echo $record[$i]->subject;?></a></div>
					<?php
						}
					?>
				</div>
				<div class="thread_show" style="display:none" id="luntan">
					<?php
						$db = get_db();
						$sql = "select tid,subject from bbs_threads where fid=70 and authorid!=0 order by tid desc limit 8";
						$record = $db->query($sql);
						$count = count($record);
						for($i=0;$i< $count;$i++){
					?>
					<div class="thread_box"><a target="_blank" href="http://172.27.203.81:8080/bbs/viewthread.php?tid=<?php echo $record[$i]->tid;?>" title="<?php echo $record[$i]->subject;?>"><?php echo $record[$i]->subject;?></a></div>
					<?php
						}
					?>
				</div>
				<div id="thread_botton"><a style="color:#FFCC00;" class="change" name="quanzi" target="_blank" href="http://172.27.203.81:8080/home/space.php?do=mtag&tagid=8">社区</a>|<a class="change" name="luntan" target="_blank" href="http://172.27.203.81:8080/bbs/forumdisplay.php?fid=70">论坛</a></div>
			</div>
			<div id=right>
				<div id="right_pic1"><a target="_blank" href="images.php?id=<?php echo $photo[2]->id; ?>"><img border=0 src="<?php echo $photo[2]->src; ?>"></a></div>
				<div id="right_pic2"><a target="_blank" href="images.php?id=<?php echo $photo[3]->id; ?>"><img border=0 src="<?php echo $photo[3]->src; ?>"></a></div>
			</div>
		</div>
		<div id="bottom_box">
			<div id=yg>
				<?php $video = $db->query('select * from smg_video v left join smg_category c on v.category_id=c.id where c.category_type="video" and c.name="高清" and v.is_adopt=1 order by v.priority asc,created_at desc');
					if(count($video)==0)
					{
				 ?>
					<marquee height="25" width="610"  scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
						<?php 
							$news = $db->query('select title,target_url from smg_news v left join smg_category c on v.category_id=c.id where c.category_type="news" and c.name="高清预告" and v.is_adopt=1 order by v.priority asc,created_at desc');
							echo $news[0]->title;
						?>
					</marquee>
				<?php } ?>
			</div>
			<div id="video">
				<?php $video=$db->query("select * from smg_video where category_id=150 order by priority asc,created_at desc limit 1"); 
					if($video[0]->is_adopt==1)
					{
				?>
				<OBJECT   id=MediaPlayer1   codeBase=http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701standby=Loading   type=application/x-oleobject   height=375   width=630   classid=CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6   VIEWASTEXT> 
					<PARAM   NAME= "URL"   VALUE= "<?php echo $video[0]->online_url; ?>"> 
					<PARAM   NAME= "playCount"   VALUE= "1"> 
					<PARAM   NAME= "autoStart"   VALUE= "true"> 
					<PARAM   NAME= "invokeURLs"   VALUE= "false">
					<PARAM   NAME= "uiMode"   VALUE= "Full">
					<PARAM   NAME= "EnableContextMenu"   VALUE= "true">			
					<embed src="<?php echo $video[0]->online_url; ?>" align="baseline" border="0" width="630" height="375" type="application/x-mplayer2"pluginspage="" name="MediaPlayer1" showcontrols="1" showpositioncontrols="0" showaudiocontrols="1" showtracker="1" showdisplay="0" showstatusbar="1" autosize="0" showgotobar="0" showcaptioning="0" autostart="false" autorewind="0" animationatstart="0" transparentatstart="0" allowscan="1" enablecontextmenu="1" clicktoplay="0" defaultframe="datawindow" invokeurls="0"></embed> 
				</OBJECT>
				<?php }else{ ?>
				<embed src="<?php echo $news[0]->target_url; ?>" quality="high" width="630" height="375" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"></embed>
				<?php } ?>
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
			$(this).css('color','#FFCC00');
			$(".thread_show").hide();
			$("#"+$(this).attr('name')).show();
		})
	})
</script>