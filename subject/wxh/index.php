﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
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
						<PARAM   NAME= "URL"   VALUE= ""> 
						<PARAM   NAME= "playCount"   VALUE= "1"> 
						<PARAM   NAME= "autoStart"   VALUE= "true"> 
						<PARAM   NAME= "invokeURLs"   VALUE= "false">
						<PARAM   NAME= "uiMode"   VALUE= "Full">
						<PARAM   NAME= "EnableContextMenu"   VALUE= "true">			
						<embed src="" align="baseline" border="0" width="408" height="270" type="application/x-mplayer2"pluginspage="" name="MediaPlayer1" showcontrols="1" showpositioncontrols="0" showaudiocontrols="1" showtracker="1" showdisplay="0" showstatusbar="1" autosize="0" showgotobar="0" showcaptioning="0" autostart="false" autorewind="0" animationatstart="0" transparentatstart="0" allowscan="1" enablecontextmenu="1" clicktoplay="0" defaultframe="datawindow" invokeurls="0"></embed> 
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
								$comment=$db->query('select * from smg_comment where resource_type="wxh2" order by created_at desc');
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
			<div class=b_title style="border-left:none;">热点问题</div>
			<div class=b_title style="border-left:none; border-right:none;">所有问题</div>
			<div class=b_title style="border-right:none;">人气榜</div>
			<div class=b_content style="border-left:none;">
				<?php
				$question=$db->query("select * from smg_wxh_question where is_adopt=1 order by priority asc, created_at desc");
				 for($i=0;$i<10;$i++){ ?>
					<div class=cl><a class=thickbox href="question.php?height=255&width=320&id=<?php echo $question[$i]->id; ?>"><?php echo $question[$i]->nick_name."：".$question[$i]->title; ?></a></div><div class="flower"><img class="flowernum" param="<?php echo $question[$i]->id; ?>" src="/images/wxh_flower.gif">　<span style="display:none;"><?php echo $question[$i]->flowernum; ?></span></div>
				<?php } ?>
			</div>
			<div class=b_content style="border-left:none; border-right:none;">
				<div id="demo" style="height:315px; width:330px; overflow:hidden ">
					<div id="demo1">
					    <?php for($i=0;$i<count($question);$i++){ ?>
								<div class=cl><a class=thickbox href="question.php?height=255&width=320&id=<?php echo $question[$i]->id; ?>"><?php echo $question[$i]->nick_name."：".$question[$i]->title; ?></a></div><div class="flower"><img class="flowernum" param="<?php echo $question[$i]->id; ?>" src="/images/wxh_flower.gif">　<span style="display:none;"><?php echo $question[$i]->flowernum; ?></span></div>
							<?php } ?>
					</div>
					<div id="demo2"></div>
					
					<!--滚动的javascript-->
					<script>
					var speed=50;
					var demo = document.getElementById('demo');
					var demo1 = document.getElementById('demo1');
					var demo2 = document.getElementById('demo2'); 
					demo2.innerHTML=demo1.innerHTML
					function Marquees(){
					if(demo2.offsetTop-demo.scrollTop<=0)
					demo.scrollTop-=demo1.offsetHeight
					else{
					demo.scrollTop++
					}
					}
					var MyMars=setInterval(Marquees,speed)
					demo.onmouseover=function() { clearInterval(MyMars) }
					demo.onmouseout=function() { MyMars=setInterval(Marquees,speed) }
					</script><!--滚动的javascript结束-->
       	</div> 
				
					<div class=cl><a style="font-size:16px; font-weight:bold; float:right; display:inline;" class="thickbox" href="question.php?height=255&width=320">我要提问</a></div>
			</div>
			<div class=b_content style="border-right:none;">
				<?php 
				$question=$db->query("select * from smg_wxh_question where is_adopt=1 order by flowernum desc limit 10");
				for($i=0;$i<10;$i++){ ?>
					<div class=cl><a class=thickbox href="question.php?height=255&width=320&id=<?php echo $question[$i]->id; ?>"><?php echo $question[$i]->nick_name."：".$question[$i]->title; ?></a></div><div class="flower"><img class="flowernum" param="<?php echo $question[$i]->id; ?>" src="/images/wxh_flower.gif">　<span ><?php echo $question[$i]->flowernum; ?></span></div>
				<?php } ?>
			</div>
				<?
				$pic=$db->query('select id,title,photo_src,flower from smg_news where category_id=232 and is_adopt=1 order by priority asc,created_at desc limit 14');
				 for($i=0;$i<count($pic);$i++)
				{
					//$flower = file_get_contents($pic[$i]->id.'.txt');
				?>
				<div class="b_content_person" <?php if($i==6){ ?>style="margin-left:5px;"<?php } ?>>
					<div class="b_c_t">
						<a target="_blank" href="/news/news/news.php?id=<?php echo $pic[$i]->id; ?>"><img border=0 width=70 height=90 src="<?php echo $pic[$i]->photo_src; ?>"></a>	
					</div>
					<div class="b_c_b">
						<div class=b_c_b_t><a href="/news/news/news.php?id=<?php echo $pic[$i]->id; ?>"><?php echo delhtml($pic[$i]->title); ?></a></div>
						<div class=b_c_b_b><div class=b_c_b_wz><?php echo $flower; ?></div><div class=b_c_b_pic name="<?php echo $pic[$i]->id; ?>"><img class="flower"   src="/images/wxh_flower.gif"></div></div>
					</div>
				</div>
				<?php } ?>
			<input id="session" type="hidden" value="<?php echo $_SESSION['smg_role']; ?>">
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
			$.post("flowernum.post.php",{'id':$(this).attr('name'),'num':flowernum},function(data){
				alert('献花成功！');
			});
			total('专题DIGG','subject');
		
	});
	$('#find').click(function(){
		window.open('comment_list.php?type=wxh');
	});	
	$('#fb').click(function(){
		tb_show(null,$(this).attr('name'),null);	
	});
	$('.flowernum').click(function(){
		var flowernum=$(this).next().html();
		flowernum=parseInt(flowernum)+1;
		$(this).next().html(flowernum);
		$.post("questionflower.post.php",{'id':$(this).attr('param')},function(data){
				alert('献花成功！');
			});
			total('专题DIGG','subject');
	});
});
</script>