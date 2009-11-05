<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-交流-HD研究院图集</title>
	<?php css_include_tag('image-slideshow-vertical','top','bottom');
		use_jquery();
		js_include_once_tag('image-slideshow-vertical','total');
	?>
	<script>
	total("交流-HD研究院","zone");
</script>	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id="slideshowvertical">
	<?php 
		$db=get_db();
		$sql="select * from smg_images i left join smg_category c on i.category_id=c.id where c.category_type='picture' and c.name='高清电影海报' order by i.created_at desc";
		$image=$db->query($sql);
	?>
	<div id="previewPane">
		<img src="<?php echo $image[0]->src2; ?>">	
		<span id="waitMessage">Loading image. Please wait</span>
		<div id="largeImageCaption"><?php echo get_fck_content($image[0]->title); ?></div>
	</div>
	<div id="galleryContainer">
		<div id="arrow_up"><img src="images/arrow-up.gif" id="arrow_up_image"></div>
		
		<div id="theImages">
			<div>
				<?php for($i=0;$i<count($image);$i++){ ?>
					<a href="#" onclick="showPreview('<?php echo $image[$i]->src2; ?>','<?php echo $i+1; ?>');return false"><img src="<?php echo $image[$i]->src; ?>"></a>
				<?php } ?>	
				<?php for($i=0;$i<count($image);$i++){ ?>
					<div class="imageCaption"><?php echo get_fck_content($image[$i]->title); ?></div>
				<?php } ?>	
						
			<div id="slideEnd"></div>
			</div>
		
		</div>
		<div id="arrow_down"><img src="images/arrow-down.gif" id="arrow_down_image"></div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>
</body>
</html>