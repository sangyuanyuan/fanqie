<?php
	require_once('../../frame.php');
    $db = get_db();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -世博总动员</title>
	<?php css_include_tag('subject_sbzdy');
		use_jquery();
		js_include_once_tag('total');
	?>
	<script>
		total("世博总动员","subject");
	</script>	
</head>
<body>
	<div id=ibody>
		<?php $sql = 'select n.photo_url,n.video_url,n.title,n.id from smg_subject_items i left join smg_video n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="世博总动员" and i.category_type="video" and i.is_adopt=1 and c.name="精彩视频" order by i.priority asc, n.created_at desc';
				$record_video=$db -> query($sql);
		?>
		<div id=video>
			<iframe id=video_src src="video.php?photo=<?php echo $record_video[0]->photo_url; ?>&video=<?php echo $record_video[0]->video_url; ?>" width=408 height=200 scrolling="no" frameborder="0"></iframe>	
			<?php for($i=1;$i<6;$i++){ ?>
				<div class=video_pic param1=<?php echo $record_video[$i]->photo_url ?> param2=<?php echo $record_video[$i]->video_url ?>><img src="<?php echo $record_video[$i]->photo_url; ?>"><div class=pictitle><?php echo $record_video[$i]->title; ?></div></div>
			<?php } ?>
		</div>
		<div id=news_more></div>
		<?php $sql = 'select n.photo_src,n.content,n.id,n.title,n.description,n.short_title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="世博总动员" and i.category_type="news" and i.is_adopt=1 and c.name="最新动态" order by i.priority asc, n.created_at desc';
				$news=$db -> query($sql);
		?>
		<div id=news>
			<div class=newspic><a target="_blank" href="/subject/news/news.php?id=<?php echo $news[0]->id; ?>"><img src="<?php echo $news[0]->photo_src; ?>"></a></div>
			<div class=piccontent>
					<div class=title><a target="_blank" href="/subject/news/news.php?id=<?php echo $news[0]->id; ?>"><?php echo $news[0]->short_title; ?></a></div>
					<div class=context><a target="_blank" href="/subject/news/news.php?id=<?php echo $news[0]->id; ?>"><?php echo $news[0]->description; ?></a></div>
			</div>
			<div class=content>
				<?php for($i=1;$i<7;$i++){ ?>
					<div class=cl><a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a></div>
				<?php } ?>
			</div>
			<div class=content>
				<?php for($i=7;$i<13;$i++){ ?>
					<div class=cl><a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a></div>
				<?php } ?>
			</div>
		</div>
		<div id=image>
			<?php 
				$sql = 'select n.src,n.url from smg_subject_items i left join smg_images n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="世博总动员" and i.category_type="photo" and i.is_adopt=1 and c.name="炫图下载" order by i.priority asc, n.created_at desc';
				$photo=$db -> query($sql);
			?>
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

</body>
</html>

<script>
	$(function(){
		$(".video_pic").click(function(){
			$("#video_src").attr('src','video.php?photo='+$(this).attr('param1')+'&video='+$(this).attr('param2'));
		});
		$("#news_more").click(function(){
			location.href="/news/news_subject_list.php?id=199";
		});
	});
</script>