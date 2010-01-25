<?
	require_once('../../frame.php');
  $db = get_db();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -首届上海广播电视台、SMG年度颁奖盛典</title>
	<?php css_include_tag('jiang');
		use_jquery();
		js_include_once_tag('total','firstjiang');
		$category_id=$_REQUEST['category_id'];
	?>
	<script>
	total("专题-首届上海广播电视台、SMG年度颁奖盛典","news");
</script>
</head>
<body>
	<div id=bodys>
		<div id=logo></div>
		<?php if($category_id==172){ ?>
		<div class=dh style="background:url(images/dh1.gif) no-repeat;"></div>
		<?php $news=$db->query('select id,short_title,description,photo_src from smg_news where category_id=172 and is_adopt=1 order by priority asc,created_at desc'); 
				for($i=0;$i<count($news);$i++)
				{
			?>	
		<div class=newsphoto>
			<div class=pleft>
				<a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id;?>"><img border=0 width=160 height=90 src="<?php echo $news[$i]->photo_src; ?>"></a>
			</div>
			<div class=pright>
				<div class=title><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id;?>"><?php echo delhtml($news[$i]->short_title); ?></a></div>
				<div class=context><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id;?>"><?php echo mb_substr(strip_tags($news[$i]->description),0,23,"utf-8")."......";?>[详细]</a></div>	
			</div>
		</div>
		<?php }}else if($category_id==173){ ?>
		<div class=dh style="background:url(images/dh2.gif) no-repeat;"></div>
		<?php $photo=$db->query('select id,src from smg_images where category_id=173 and is_adopt=1 order by priority asc,created_at desc'); 
				for($i=0;$i<count($photo);$i++)
				{
			?>	
		<div class=photo>
			<a target="_blank" href="<?php echo $photo[$i]->src;?>"><img border=0 width=200 height=200 src="<?php echo $photo[$i]->src;?>"></a>
		</div>
		<?php }} ?>
	</div>
</body>
</html>