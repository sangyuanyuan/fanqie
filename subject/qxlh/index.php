<?php
	require_once('../../frame.php');
    $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -七小罗汉</title>
	<LINK href="index.css" type=text/css rel=stylesheet>
	<?php
		use_jquery();
		js_include_once_tag('total');
	?>
	<script>
		total("七小罗汉专题","subject");
	</script>
</head>
<body>
	<div id=ibody>
		<?php $record = $db->query('select n.photo_url,n.video_url from smg_subject_items i left join smg_video n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="七小罗汉" and i.category_type="video" and i.is_adopt=1 and c.name="首页视频" order by i.priority asc, n.created_at desc limit 1'); ?>
		<div id=video><?php show_video_player('408','230',$record[0]->photo_url,$record[0]->video_url); ?></div>
		<div id=person><div id=dcrw><a target="_blank" href="http://172.27.203.81:8080/news/news/news.php?id=53075"><img border=0 src="images/dcrw.jpg"></a></div><div id=jqjj><a target="_blank" href="http://172.27.203.81:8080/news/news/news.php?id=53066"><img border=0 src="images/jqjj.jpg"></a></div></div>
		<?php $news=$db->query('select n.id,n.short_title,c.id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="七小罗汉" and i.category_type="news" and i.is_adopt=1 and c.name="精彩动态" order by i.priority asc, n.created_at desc limit 16'); ?>
		<div id=more><a target="_blank" href="/news/news_subject_list.php?id=<?php echo $news[0]->cid; ?>"><img border=0 src="images/more.jpg"></a></div>
		<div id=news>
			<div class=news_content>
				<?php for($i=8;$i<16;$i++){ ?>
					<div class=cl><a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a></div>
				<?php } ?>
			</div>
			<div class=news_content>
				<?php for($i=0;$i<8;$i++){ ?>
					<div class=cl><a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->short_title; ?></a></div>
				<?php } ?>	
			</div>
		</div>
		<div id=bottom>
			<?php 
				$sql = 'select n.src,n.url from smg_subject_items i left join smg_images n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="CCG EXPO" and i.category_type="photo" and i.is_adopt=1 and c.name="炫图下载" order by i.priority asc, n.created_at desc';
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
	</div>
</body>
</html>

