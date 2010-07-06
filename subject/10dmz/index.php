<?php
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -CCG EXPO</title>
	<?php css_include_tag('2010dmz');
		use_jquery();
		js_include_once_tag('total');
	?>
	<script>
		total("2010动漫展","subject");
	</script>	
</head>
<body>
	<div id=logo><img width="995" height="396" border=0 id="day" src=""></div>
	<div id=ibody>
		
		<?php $sql = 'select n.photo_url,n.video_url,n.title,n.id from smg_subject_items i left join smg_video n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="CCG EXPO" and i.category_type="video" and i.is_adopt=1 and c.name="佳片展播" order by i.priority asc, n.created_at desc';
				$record_video=$db -> query($sql);
		?>
		<div id=video>
			<div class=title>
				<div class="title_left"><img src="/images/dmz/video_title.jpg"></div>
			</div>
			<iframe id=video_src src="video.php?photo=<?php echo $record_video[0]->photo_url; ?>&video=<?php echo $record_video[0]->video_url; ?>" width=463 height=290 scrolling="no" frameborder="0"></iframe>	
		</div>
		<?php 
				$sql = 'select n.photo_src,n.content,n.id,n.title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="CCG EXPO" and i.category_type="news" and i.is_adopt=1 and c.name="活动公告" order by i.priority asc, n.created_at desc limit 1';
				$racecard=$db -> query($sql);
		?>
		<div id=racecard>
			<div class=title>
				<div class="title_left"><img src="/images/dmz/hdgg_title.jpg"></div>
				<div class="title_more"></div>	
			</div>
			<div id=content><a target="_blank" href="/zone/news/news.php?id=<?php echo $racecard[0]->id; ?>"><?php echo $racecard[0]->content; ?></a></div>
		</div>
		<?php $comment=$db->query('select * from smg_question where problem_id="51" order by create_time asc limit 5'); ?>
		<div id=comment>
			<div class=title>
				<div class="title_left"><img src="/images/dmz/yjhd_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="" style="color:#ff0000; font-size:14px; font-weight:bold;">答题抢票</a></div>	
			</div>
			<div style="width:100%; height:28px; line-height:14px; font-size:12px; text-indent:2em; color:#ff0000; text-align:center; float:left; display:inline;">7月2日获奖名单：许理 沈陶瑜 TobyGwan<br>7月5日获奖名单：刘晨 吉吉 罗伯特</div>
			<div id=answer>CCG EXPO互动答题第一期</div><div id=submit>我要答题</div>
			<div id=content>	
				<?php for($i=0;$i<count($comment);$i++){ ?>
					<div class=context <?php if($i==0){ ?>style="border-top:none;"<?php } ?>>
						<div class=commentcontent><a target="_blank" href="/answer/pro_answer.php?id=<?php echo $comment[$i]->problem_id; ?>"><?php echo $comment[$i]->title; ?></a></div>
					</div>
				<?php } ?>
			</div>
			
		</div>
		<div id=video_bottom>
			<DIV id=demo9 style="OVERFLOW: hidden; WIDTH: 95%; margin-left:10px;">
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
		<div id=gg><img border=0 src="/images/dmz/banner.jpg" /></div>
		<?php 
				$sql = 'select n.photo_src,n.description,n.id,n.title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="CCG EXPO" and i.category_type="news" and i.is_adopt=1 and c.name="炫动速递" order by i.priority asc, n.created_at desc limit 15';
				$africa=$db -> query($sql);
		?>
		<div id=africa>
			<div class=title style="margin-top:5px;">
				<div class="title_left"><img src="/images/dmz/xdsd_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="/news/news_subject_list.php?id=<?php echo $africa[0]->cid; ?>">更多内容</a></div>	
			</div>
			<div class=photo><a target="_blank" href="/zone/news/news.php?id=<?php echo $africa[0]->id; ?>"><img border=0 src="<?php echo $africa[0]->photo_src; ?>"></a></div>
			<div class=desc><a target="_blank" href="/zone/news/news.php?id=<?php echo $africa[0]->id; ?>"><?php echo $africa[0]->description; ?></a></div>
			<div class=news_content>
				<?php for($i=1;$i<11;$i++){ ?>
					<div class=context><a target="_blank" href="/zone/news/news.php?id=<?php echo $africa[$i]->id; ?>"><?php echo $africa[$i]->title; ?></a></div>
				<?php } ?>
			</div>
		</div>
		<?php 
				$sql = 'select n.photo_src,n.description,n.id,n.title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="CCG EXPO" and i.category_type="news" and i.is_adopt=1 and c.name="最新动态" order by i.priority asc, n.created_at desc limit 15';
				$worldsoccer=$db -> query($sql);
		?>
		<div id=worldsoccer>
			<div class=title style="margin-top:5px;">
				<div class="title_left"><img src="/images/dmz/zxdt_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="/news/news_subject_list.php?id=<?php echo $worldsoccer[0]->cid; ?>">更多内容</a></div>	
			</div>
			<div class=photo><a target="_blank" href="/zone/news/news.php?id=<?php echo $worldsoccer[0]->id; ?>"><img border=0 src="<?php echo $worldsoccer[0]->photo_src; ?>"></a></div>
			<div class=desc><a target="_blank" href="/zone/news/news.php?id=<?php echo $worldsoccer[0]->id; ?>"><?php echo $worldsoccer[0]->description; ?></a></div>
			<div class=news_content>
				<?php for($i=1;$i<11;$i++){ ?>
					<div class=context><a target="_blank" href="/zone/news/news.php?id=<?php echo $worldsoccer[$i]->id; ?>"><?php echo $worldsoccer[$i]->title; ?></a></div>
				<?php } ?>
			</div>
		</div>
		
		
		<div id=bottom>
			<?php 
				$sql = 'select n.src,n.url from smg_subject_items i left join smg_images n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="CCG EXPO" and i.category_type="photo" and i.is_adopt=1 and c.name="炫图下载" order by i.priority asc, n.created_at desc';
				$photo=$db -> query($sql);
			?>
			<div class=title style="margin-top:5px;">
					<div class="title_left"><img src="/images/dmz/xdtp_title.jpg"></div>
			</div>
			<div class=bottom_content >
				<DIV id=demo6 style="OVERFLOW: hidden; WIDTH: 100%;">
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
				                <TD><div class=pic><a target="_blank" href="<?php echo $photo[$i]->src; ?>"><img border=0 src="<?php echo $photo[$i]->src; ?>"></a></div></TD>
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
		<div id=bottom_bg><img src="/images/dmz/bottom_bg.jpg"></div>
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
			window.open('/answer/pro_answer.php?id=51');
		});
		var d=new Date();
		var starttime=d.getYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
		var day=getDateDiff(starttime,'2010-07-08');
		if(day>0&&day<7)
		{
			$("#day").attr('src','/images/dmz/logo'+day+'.jpg');
		}
		else if(day==0)
		{
			$("#day").attr('src','/images/dmz/logo_start.jpg');	
		}
		else if(day<=-4)
		{
			$("#day").attr('src','/images/dmz/logo_end.jpg');		
		}
		else
		{
			$("#day").attr('src','/images/dmz/logo_ing.jpg');			
		}
	});
	function getDateDiff(date1,date2){
	   var   re   =   /^(\d{4})\S(\d{1,2})\S(\d{1,2})$/;   
	   var   dt1,dt2;   
	   if   (re.test(date1))   
	   {   
	    dt1   =   new   Date(RegExp.$1,RegExp.$2   -   1,RegExp.$3);   
	   } 
	    
	   if   (re.test(date2))   
	   {   
	    dt2   =   new   Date(RegExp.$1,RegExp.$2   -   1,RegExp.$3);   
	   }  
	    
	   return Math.floor((dt2-dt1)/(1000 * 60 * 60 * 24));
	}
</script>
