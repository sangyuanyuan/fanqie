<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-专题-务虚会</title>
	<?php
		require_once('../../frame.php');
		css_include_tag('subject_wxh','thickbox1');
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
				<div id=l_t><a target="_blank" href="/news/news/news.php?id=33271">议程</a></div>
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
					<marquee height="100" width="250" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
							<?php 
								$db=get_db(); 
								$comment=$db->query('select * from smg_comment where resource_type="wxh" order by created_at desc');
								for($i=0;$i<count($comment);$i++)
								{
									echo $comment[$i]->nick_name.':'.$comment[$i]->comment.'<br>';
								} 
							?>
					</marquee><br>
					<button id="fb" name="video_comment.php?height=255&width=320">发表评论</button>　<button id="find">查看所有评论</button>
				</div>
			</div>
			<div class=r_content style="margin-top:20px;">
				<div class=title>投票</div>
				<div class=content>
						<?php 
						$vote=$db->query('select id from smg_vote where category_id=181 order by priority asc,created_at desc limit 1');
							$vote = new smg_vote_class();
							$vote->find(298);
							$vote->display(true,true,'target');
						 ?>	
				</div>
			</div>
		</div>
		<div id=ibottom>
			<div id=b_t>
				<?php $pic=$db->query('select id,title,photo_src,flower from smg_news where category_id=185 and is_adopt=1 order by priority asc,created_at desc limit 14');
				for($i=0;$i<6;$i++)
				{
				?>
				<div class="b_content" <?php if($i==0){ ?>style="margin-left:133px;"<?php } ?>>
					<div class="b_c_t">
						<a target="_blank" href="/news/news/news.php?id=<?php echo $pic[$i]->id; ?>"><img border=0 width=70 height=90 src="<?php echo $pic[$i]->photo_src; ?>"></a>	
					</div>
					<div class="b_c_b">
						<div class=b_c_b_t><a href="/news/news/news.php?id=<?php echo $pic[$i]->id; ?>"><?php echo delhtml($pic[$i]->title); ?></a></div>
						<div class=b_c_b_b><div class=b_c_b_wz><?php echo $pic[$i]->flower; ?></div><div class=b_c_b_pic name="<?php echo $pic[$i]->id; ?>"><img class="flower" src="/images/wxh_flower.gif"></div></div>
					</div>
				</div>
				<?php } ?>
			</div>
			<div id=b_b>
				<? for($i=6;$i<count($pic);$i++)
				{
				?>
				<div class="b_content" <?php if($i==6){ ?>style="margin-left:10px;"<?php } ?>>
					<div class="b_c_t">
						<a target="_blank" href="/news/news/news.php?id=<?php echo $pic[$i]->id; ?>"><img border=0 width=70 height=90 src="<?php echo $pic[$i]->photo_src; ?>"></a>	
					</div>
					<div class="b_c_b">
						<div class=b_c_b_t><a href="/news/news/news.php?id=<?php echo $pic[$i]->id; ?>"><?php echo delhtml($pic[$i]->title); ?></a></div>
						<div class=b_c_b_b><div class=b_c_b_wz><?php echo $pic[$i]->flower; ?></div><div class=b_c_b_pic name="<?php echo $pic[$i]->id; ?>"><img class="flower"   src="/images/wxh_flower.gif"></div></div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>
<script>
$(document).ready(function(){
	$(".b_c_b_pic").click(function(){
		var flowernum=$(this).prev().html();
		flowernum=parseInt(flowernum)+1;
		$(this).prev().html(flowernum);
		$.post("/pub/pub.post.php",{'type':'flower','id':$(this).attr('name'),'db_table':'smg_news','digg_type':'wxh'},function(data){			
			if(data!=''){
			}
		});
		total('新闻DIGG','news');
	});
	$('#find').click(function(){
		window.open('comment_list.php?type=wxh');
	});	
	$('#fb').click(function(){
		tb_show(null,$(this).attr('name'),null);	
	})
});
</script>