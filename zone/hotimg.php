<?php
	require_once('../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-热图</title>
	<? 	
		css_include_tag('zone_hotimg','top','bottom');
		use_jquery();
		js_include_tag('total.js');
  ?>
	
</head>
<script>
	total("热图","zone");
</script>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t>劲爆热图</div>
 		<?php
  		$sql = 'select i.id as img_id,i.src,i.title,i.url from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="劲爆热图" and c.platform="zone" order by i.priority asc,created_at desc limit 8';
			$record=$db -> query($sql);	
		?>
		<div id=l_b>
			<?php for($i=0;$i<=7;$i++){?>
			<div class=box>
				<div class=pic><a href="<?php echo $record[$i]->url ?>" target="_blank"><img src="<?php echo $record[$i]->src?>" border=0></a></div>
				<div class="title"><a href="<?php echo $record[$i]->url ?>" target="_blank"><?php echo $record[$i]->title?></a></div>
			</div>
			<? }?>
		</div>
	</div>
	<div id=ibody_right>
		<div id=r>
			<div class=r_title>HOT讨论区</div>
 			<?php
  			$sql = 'select i.id as img_id,i.src,i.title,i.url from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="HOT讨论区" and c.platform="zone" order by i.priority asc,created_at desc limit 2';
				$record=$db -> query($sql);	
			?>
			<a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[0]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a><a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[1]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a>
			<?php
				$sql = 'select n.id as news_id,n.short_title, c.platform from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="讨论区" and c.platform="zone" order by n.priority asc,created_at desc limit 7';
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
  			$sql = 'select i.id as img_id,i.src,i.title,i.url from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="观点视角" and c.platform="zone" order by i.priority asc,created_at desc limit 2';
				$record=$db -> query($sql);	
			?>
			<a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[0]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a><a href="<?php echo $record[0]->url?>" target=_blank><img src="<?php echo $record[1]->src?>" width="125" height="72" border=0 style="margin-left:8px;"></a>

			<?php
				$sql = 'select n.id as news_id,n.short_title, c.platform from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="观点视角" and c.platform="zone" order by n.priority asc,created_at desc limit 7';
				$record=$db -> query($sql);
			?>
			<?php for($i=0;$i<7;$i++){?>			
				<div class="content2">
					<a href="/<?php echo $record[$i]->platform ?>/news/news.php?id=<?php echo $record[$i]->news_id ?>" target=_blank>·<?php echo $record[$i]->short_title ?></a>
				</div>
			<? }?>			
			
			
		</div>
		<div id=r>
			<div class=r_title>博主秀</div>
 			<?php
  			$sql = 'select n.id,n.content,n.short_title,c.platform,n.photo_src  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="博主秀" and c.platform="zone" order by n.priority asc,n.created_at desc limit 6';
				$record=$db -> query($sql);	
			?>
			<div class=content3>
				<a href="<?php echo "/".$record[0]->platform."/news/news.php?id=".$record[0]->id ?>" target=_blank><img src="<?php echo $record[0]->photo_src?>" border=0></a>
				<div id=title><a href="<?php echo "/".$record[0]->platform."/news/news.php?id=".$record[0]->id ?>" target=_blank><?php echo $record[0]->short_title?></a></div>
				<div id=description><a href="<?php echo "/".$record[0]->platform."/news/news.php?id=".$record[0]->id ?>" target=_blank><?php echo strip_tags($record[0]->content); ?></a></div>
				<?php for($i=1;$i<=5;$i++){?>
				<div class=box><a href="<?php echo "/".$record[$i]->platform."/news/news.php?id=".$record[$i]->id ?>" target=_blank><?php echo $record[$i]->short_title?></a></div>
				<? }?>
			</div>
		</div>
				

		<a href="dialog_list.php" id=r_dialog target=_ blank><img src="/images/zone/blog_r_dialog.jpg" border=0></a>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>
