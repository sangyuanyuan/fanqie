<?php
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -2010世界杯</title>
	<?php css_include_tag('2010worldcup');
		use_jquery();
		js_include_once_tag('total');
	?>
	<script>
		total("2010世界杯专题","zone");
	</script>	
</head>
<body>
	<div id=logo></div>
	<div id=ibody>
		<?php $sql = 'select n.photo_url,n.video_url,n.title,n.id from smg_subject_items i left join smg_video n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="video" and i.is_adopt=1 and c.name="南非世界杯视频" order by i.priority asc, n.created_at desc';
				$record_video=$db -> query($sql);
		?>
		<div id=video>
			<iframe id=video_src src="video.php?photo=<?php echo $record_video[0]->photo_url; ?>&video=<?php echo $record_video[0]->video_url; ?>" width=463 height=322 scrolling="no" frameborder="0"></iframe>	
		</div>
		<?php 
				$sql = 'select n.photo_src,n.content,n.id,n.title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="news" and i.is_adopt=1 and c.name="赛程表" order by i.priority asc, n.created_at desc limit 1';
				$racecard=$db -> query($sql);
		?>
		<div id=racecard>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/racecard_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="http://172.27.203.81:8080/bbs/viewthread.php?tid=2793&extra=page%3D1">电视直播表</a></div>	
			</div>
			<div id=content><a target="_blank" href="/zone/news/news.php?id=<?php echo $racecard[0]->id; ?>"><?php echo $racecard[0]->content; ?></a></div>
		</div>
		<?php $comment=$db->query('select * from smg_question where problem_id="50" order by create_time asc limit 5'); ?>
		<div id=comment>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/comment_title.jpg"></div>
				<div class="adidas"><img src="/images/worldcup/adidas.jpg"></div>
				<div class="title_more"><a target="_blank" href="video_list.php?id=<?php echo $record_video[0]->id; ?>">精彩视频</a></div>	
			</div>
			<div style="width:100%; height:25px; line-height:25px; font-size:18px; color:#ff0000; text-align:center; float:left; display:inline;">参加活动的网友均有机会获得adidas精美小礼品</div>
			<div id=answer>世界杯答题第一期</div><div id=submit>我要答题</div>
			<div id=content>	
				<?php for($i=0;$i<count($comment);$i++){ ?>
					<div class=context <?php if($i==0){ ?>style="border-top:none;"<?php } ?>>
						<div class=commentcontent><a target="_blank" href="/answer/pro_answer.php?id=<?php echo $comment[$i]->problem_id; ?>"><?php echo $comment[$i]->title; ?></a></div>
					</div>
				<?php } ?>
			</div>
			
		</div>
		<div id=video_bottom>
			<DIV id=demo9 style="OVERFLOW: hidden; WIDTH: 95%;">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo10 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=left>
				              	<?php  
									$count = count($record_video);
									for($i=0;$i<$count;$i++){
								?>
				                <TD><div class=video_pic param1=<?php echo $record_video[$i]->photo_url ?> param2=<?php echo $record_video[$i]->video_url ?>><img src="<?php echo $record_video[$i]->photo_url; ?>"><div class=pictitle><?php echo $record_video[$i]->title; ?></div></div></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id="demo11" vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
								        var demo9 = document.getElementById('demo9');
										var demo10 = document.getElementById('demo10');
										var demo11 = document.getElementById('demo11');  
								      	$(document).ready(function(){
											var speed=30//速度数值越大速度越慢
											demo11.innerHTML=demo10.innerHTML
											function Marquee(){
											if(demo11.offsetWidth-demo9.scrollLeft<=0)
											demo9.scrollLeft-=demo10.offsetWidth
											else{
											demo9.scrollLeft++
											}
											}
											var MyMar=setInterval(Marquee,speed)
											demo9.onmouseover=function() {clearInterval(MyMar)}
											demo9.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
										})
									</SCRIPT>
		</div>
		<div id=gg><a href=""><img border=0 src="/images/worldcup/gg.jpg" /></div>
		<?php 
				$sql = 'select n.photo_src,n.description,n.id,n.title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="news" and i.is_adopt=1 and c.name="五星体育在南非" order by i.priority asc, n.created_at desc limit 15';
				$africa=$db -> query($sql);
		?>
		<div id=africa>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/africa_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="http://172.27.203.81:8080/bbs/forumdisplay.php?fid=86&page=1">更多内容</a></div>	
			</div>
			<div class=photo><a target="_blank" href="/zone/news/news.php?id=<?php echo $africa[0]->id; ?>"><img border=0 src="<?php echo $africa[0]->photo_src; ?>"></a></div>
			<div class=desc><a target="_blank" href="/zone/news/news.php?id=<?php echo $africa[0]->id; ?>"><?php echo $africa[0]->description; ?></a></div>
			<div class=news_content>
				<?php for($i=1;$i<14;$i++){ ?>
					<div class=context><a target="_blank" href="/zone/news/news.php?id=<?php echo $africa[$i]->id; ?>"><?php echo $africa[$i]->title; ?></a></div>
				<?php } ?>
			</div>
		</div>
		<?php 
				$sql = 'select n.photo_src,n.description,n.id,n.title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="news" and i.is_adopt=1 and c.name="绿茵风云" order by i.priority asc, n.created_at desc limit 15';
				$worldsoccer=$db -> query($sql);
		?>
		<div id=worldsoccer>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/worldsoccer_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="http://172.27.203.81:8080/bbs/forumdisplay.php?fid=86&page=1">更多内容</a></div>	
			</div>
			<div class=photo><a target="_blank" href="/zone/news/news.php?id=<?php echo $worldsoccer[0]->id; ?>"><img border=0 src="<?php echo $worldsoccer[0]->photo_src; ?>"></a></div>
			<div class=desc><a target="_blank" href="/zone/news/news.php?id=<?php echo $worldsoccer[0]->id; ?>"><?php echo $worldsoccer[0]->description; ?></a></div>
			<div class=news_content>
				<?php for($i=1;$i<14;$i++){ ?>
					<div class=context><a target="_blank" href="/zone/news/news.php?id=<?php echo $worldsoccer[$i]->id; ?>"><?php echo $worldsoccer[$i]->title; ?></a></div>
				<?php } ?>
			</div>
		</div>
		
		
		<div id=bottom>
			<?php 
				$sql = 'select n.src,n.url from smg_subject_items i left join smg_images n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="photo" and i.is_adopt=1 and c.name="精彩图片" order by i.priority asc, n.created_at desc';
				$photo=$db -> query($sql);
			?>
			<div class=bottom_content >
				<DIV id=demo6 style="OVERFLOW: hidden; WIDTH: 95%;">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo7 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=left>
				              	<?php 
													for($i=0;$i<count($photo);$i++){
												?>
				                <TD><div class=pic><a target="_blank" href="<?php echo $photo[$i]->url; ?>"><img border=0 src="<?php echo $photo[$i]->src; ?>"></a></div></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id="demo8" vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
								        var demo6 = document.getElementById('demo6');
										var demo7 = document.getElementById('demo7');
										var demo8 = document.getElementById('demo8');  
								      	$(document).ready(function(){
											var speed=30//速度数值越大速度越慢
											demo8.innerHTML=demo7.innerHTML
											function Marquee(){
											if(demo8.offsetWidth-demo6.scrollLeft<=0)
											demo6.scrollLeft-=demo7.offsetWidth
											else{
											demo6.scrollLeft++
											}
											}
											var MyMar=setInterval(Marquee,speed)
											demo6.onmouseover=function() {clearInterval(MyMar)}
											demo6.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
										})
									</SCRIPT>
			</div>
		</div>
	</div>
</body>
</html>
<script>
	$(function(){
		$(".video_pic").click(function(){
			$("#video_src").attr('src','video.php?photo='+$(this).attr('param1')+'&video='+$(this).attr('param2'));
		});
		$("#turn_left").click(function(){
			var num=$(this).next().attr('param');
			var count=$("#hidden_content").val();
			if(num==0)
			{
				$(".bottom_content").css('display','none');
				$("#bottom_content"+count).css('display','inline');
			}
			else
			{
				$(".bottom_content").css('display','none');
				$("#bottom_content"+(num-1)).css('display','inline');
			}
		});
		
		$("#turn_right").click(function(){
			var num=$(this).next().attr('param');
			var count=$("#hidden_content").val();
			if(num==count)
			{
				$(".bottom_content").css('display','none');
				$("#bottom_content0").css('display','inline');
			}
			else
			{
				$(".bottom_content").css('display','none');
				$("#bottom_content"+(num+1)).css('display','inline');
			}
		});
		
		$("#submit").click(function(){
			window.open('/answer/pro_answer.php?id=50');
		});
	});
</script>
