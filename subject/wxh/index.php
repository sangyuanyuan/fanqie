<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-专题-务虚会</title>
	<?php
		require_once('../../frame.php');
		css_include_tag('subject_wxh','thickbox');
		use_jquery();
		js_include_once_tag('thickbox','total');
	?>
<script>
total("务虚会专题","other");
</script>
</head>
<body>
	<div id=ibody>
		<div id=itop></div>
		<div id=ileft>
				<div id=l_t><a target="_blank" href="#">议程</a></div>
				<div id=l_video>
					<OBJECT   id=MediaPlayer1   codeBase=http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701standby=Loading   type=application/x-oleobject   height=270   width=408   classid=CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6   VIEWASTEXT> 
						<PARAM   NAME= "URL"   VALUE= "mms://172.27.202.23:5765/broadcast"> 
						<PARAM   NAME= "playCount"   VALUE= "1"> 
						<PARAM   NAME= "autoStart"   VALUE= "true"> 
						<PARAM   NAME= "invokeURLs"   VALUE= "false">
						<PARAM   NAME= "uiMode"   VALUE= "Full">
						<PARAM   NAME= "EnableContextMenu"   VALUE= "true">			
						<embed src="mms://172.27.202.23:5765/broadcast" align="baseline" border="0" width="408" height="270" type="application/x-mplayer2"pluginspage="" name="MediaPlayer1" showcontrols="1" showpositioncontrols="0" showaudiocontrols="1" showtracker="1" showdisplay="0" showstatusbar="1" autosize="0" showgotobar="0" showcaptioning="0" autostart="false" autorewind="0" animationatstart="0" transparentatstart="0" allowscan="1" enablecontextmenu="1" clicktoplay="0" defaultframe="datawindow" invokeurls="0"></embed> 
					</OBJECT>	
				</div>
		</div>
		<div id=iright>
			<div class=r_content>
				<div class=title><a class="thickbox" title="请发表留言" href="video_comment.php?height=255&width=320">留言</a></div>
				<div class=content>
					<marquee height="80" width="250" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
							<?php 
								$db=get_db(); 
								$comment=$db->query('select * from smg_comment where resource_type="wxh" order by created_at desc limit 4');
								for($i=0;$i<count($comment);$i++)
								{
									echo $comment[$i]->nick_name.':'.$comment[$i]->comment.'<br>';
								} 
							?>
					</marquee>
				</div>
			</div>
			<div class=r_content style="margin-top:20px;">
				<div class=title>投票</div>
				<div class=content>
						<?php $vote=$db->query('select * from smg_vote where category_id=181 and is_adopt=1 order by priority asc,created_at desc limit 4');
							for($i=0;$i<count($vote);$i++)
							{
						?>
						<div class=cl><a href="/vote/vote.php?vote_id=<?php echo $vote[$i]->id;?>"><?php echo $vote[$i]->name;?></a></div>
						<?php } ?>
				</div>
			</div>
		</div>
		<div id=ibottom>
			<?php $pic=$db->query('select src from smg_images where category_id=182 and is_adopt=1 order by priority asc,created_at desc limit 6');
			for($i=0;$i<count($pic);$i++)
			{
			?>
			<div class="b_content" <?php if($i==0){ ?>style="margin-left:130px;"<?php } ?>>
				<div class="b_t">
					<a target="_blank" href="<?php echo $pic[$i]->src; ?>"><img width=108 height=90 src="<?php echo $pic[$i]->src; ?>"></a>	
				</div>
				<div class="b_b"></div>
			</div>
			<?php } ?>
		</div>
	</div>
</body>
</html>