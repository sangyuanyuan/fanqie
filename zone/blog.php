<?php
	require_once('../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-博文</title>
	<? 	
		css_include_tag('zone_blog','top','bottom');
		use_jquery();
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t>工作这点事</div>
		<?php
			$sql = 'select b.*,s.message from blog_spaceitems b left join blog_spaceblogs s on b.itemid=s.itemid where b.catid=91 and b.type="blog" order by b.itemid desc limit 6';
			$record=$db -> query($sql);	
		?>
		<?php for($i=0;$i<6;$i++){ ?>
			<div class=l>
				<div class=name><a href="/blog/?uid-<?php echo $record[$i]->uid?>" target=_blank><?php echo $record[$i]->username ?></a></div>
				<div class=context><a href="/blog/?uid-<?php echo $record[$i]->uid?>-action-viewspace-itemid-<?php echo $record[$i]->itemid?> " target=_blank><?php echo delhtml($record[$i]->message) ?></a></div>
			</div>
		<?PHP }?>
	</div>
	<div id=ibody_center>
		<div id=c_t>
			<div id=title>
				<div class=menu id=1>心情故事</div>	
				<div class=menu id=2 style="color:#DE4900; font-weight:bold;">生活这点事</div>	
				<div class=menu id=3>娱乐这点事</div>	
			</div>
			<?php
				$sql = 'select * from blog_spaceitems b where catid=10 order by itemid desc limit 17';
				$record=$db -> query($sql);	
			?>
			<div class=content_c id=content_c1 style="display:none;">
				<?php  for($i=0;$i<17;$i++){?>
					<li>[<a href="/blog/?uid-<?php echo $record[$i]->uid?>" target=_blank><?php echo $record[$i]->username ?></a>] <a href="/blog/?uid-<?php echo $record[$i]->uid?>-action-viewspace-itemid-<?php echo $record[$i]->itemid?> " target=_blank><?php echo $record[$i]->subject ?></a></li>
				<? }?>
			</div>
			<?php
				$sql = 'select * from blog_spaceitems b where catid=90 order by itemid desc limit 17';
				$record=$db -> query($sql);	
			?>
			<div class=content_c id=content_c2>
				<?php  for($i=0;$i<17;$i++){?>
					<li>[<a href="/blog/?uid-<?php echo $record[$i]->uid?>" target=_blank><?php echo $record[$i]->username ?></a>] <a href="/blog/?uid-<?php echo $record[$i]->uid?>-action-viewspace-itemid-<?php echo $record[$i]->itemid?> " target=_blank><?php echo $record[$i]->subject ?></a></li>
				<? }?>
			</div>
			<?php
				$sql = 'select * from blog_spaceitems b where catid=92 order by itemid desc limit 17';
				$record=$db -> query($sql);	
			?>
			<div class=content_c id=content_c3 style="display:none;">
				<?php  for($i=0;$i<17;$i++){?>
					<li>[<a href="/blog/?uid-<?php echo $record[$i]->uid?>" target=_blank><?php echo $record[$i]->username ?></a>] <a href="/blog/?uid-<?php echo $record[$i]->uid?>-action-viewspace-itemid-<?php echo $record[$i]->itemid?> " target=_blank><?php echo $record[$i]->subject ?></a></li>
				<? }?>
			</div>
		
		</div>
		<div id=c_b>
			<div id=title>劲酷热图</div>	
			<?php
  			$sql = 'select i.id as img_id,i.src,i.title,i.url from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="劲爆热图" and c.platform="zone" order by i.priority asc limit 3';
				$record=$db -> query($sql);	
			?>
			<?php for($i=0;$i<3;$i++){?>
			<div class=box>
				<a href="<?php echo $record[$i]->url ?>" target=_blank><img src="<?php echo $record[$i]->src?>" border=0></a>
				<div class="title"><a href="<?php echo $record[$i]->url ?>" target=_blank><?php echo $record[$i]->title?></a></div>
			</div>
			<? }?>			
			
			
		</div>
	</div>
	<div id=ibody_right>
		<div id=r>
			<div class=r_title>HOT讨论区</div>
 			<?php
  			$sql = 'select i.id as img_id,i.src,i.title,i.url from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="HOT讨论区" and c.platform="zone" order by i.priority asc limit 2';
				$record=$db -> query($sql);	
			?>
			<a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[0]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a><a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[1]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a>
			<?php
				$sql = 'select n.id as news_id,n.short_title, c.platform from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="讨论区" and c.platform="zone" order by n.priority asc limit 7';
				$record=$db -> query($sql);
			?>
			<?php for($i=0;$i<7;$i++){?>			
				<div class="content1">
					<a href="/<?php echo $record[$i]->platform ?>/news/news.php?id=<?php echo $record[$i]->news_id ?>" target=_blank>·<?php echo $record[$i]->short_title ?></a>
				</div>
			<? }?>
		</div>
		<div id=r>
			<div class=r_title>观点视角</div>
 			<?php
  			$sql = 'select i.id as img_id,i.src,i.title,i.url from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="观点视角" and c.platform="zone" order by i.priority asc limit 2';
				$record=$db -> query($sql);	
			?>
			<a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[0]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a><a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[1]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a>

			<?php
				$sql = 'select n.id as news_id,n.short_title, c.platform from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="观点视角" and c.platform="zone" order by n.priority asc limit 7';
				$record=$db -> query($sql);
			?>
			<?php for($i=0;$i<7;$i++){?>			
				<div class="content2">
					<a href="/<?php echo $record[$i]->platform ?>/news/news.php?id=<?php echo $record[$i]->news_id ?>" target=_blank>·<?php echo $record[$i]->short_title ?></a>
				</div>
			<? }?>			
			
			
		</div>
		<div id=r>
			<div class=r_title>博主真人秀</div>
 			<?php
  			$sql = 'select i.src,i.title,i.url,i.description from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="博主真人秀" and c.platform="zone" order by i.priority asc limit 1';
				$record=$db -> query($sql);	
			?>
			<div class=content3>
				<a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[0]->src?>" border=0></a>
				<div id=title><a href="<?php echo $record[0]->url?>" target=_blank><?php echo $record[0]->title?></a></div>
				<div id=description>
					<?php echo $record[0]->description ?>
				</div>
			</div>
		</div>
				

		<a href="dialog_list.php" id=r_dialog target=_ blank><img src="/images/zone/blog_r_dialog.jpg" border=0></a>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>


<script>


$(function(){
	$(".menu").mouseover(function(){
			
			var item=$(this).attr('id');
			$(".menu").css('color','#000000');
			$(".menu").css('font-weight','normal');
			$(".content_c").hide();
			
			$("#"+item).css('color','#DE4900');
			$("#"+item).css('font-weight','bold');

			$("#content_c"+item).show();
	});
		
});

</script>