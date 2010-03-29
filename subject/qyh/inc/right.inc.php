<?php if($rightstyle<>"list"){ ?>
<div id=r_top><?php $pic=$db->query('select photo_src,id,short_title from smg_news where category_id=204 and is_adopt=1 order by priority asc,created_at desc limit 1'); ?><a target="_blank" href="/show/news/news.php?id=<?php echo $pic[0]->id; ?>"><img border=0 src="<?php echo $pic[0]->photo_src; ?>"></a></div>
<div id=wz><a target="_blank" href="/show/news/news.php?id=<?php echo $pic[0]->id; ?>"><?php echo $pic[0]->short_title; ?></a></div>
<?php } ?>
<!--<div class=r_content>
	<div class=r_c_title>嘉宾回顾</div>
	<div class=r_context>
		<?php for($i=0;$i<11;$i++){ ?>
			<div class=cl><a href="">·全国长江韬奋奖</a></div>	
		<?php } ?>
		<div class=more><a href="">更多...</a></div>
	</div>
</div>-->
<div class=r_content>
	<?php $news=$db->query('select id,short_title from smg_news where category_id=196 and is_adopt=1 order by priority asc,created_at desc limit 6'); ?>
	<div class=r_c_title>心灵之光</div>
	<div class=r_context>
		<?php for($i=0;$i<11;$i++){ ?>
			<div class=cl><a target="_blank" href="/shows/news/news.php?id=<?php echo $news[$i]->id; ?>">·<?php echo $news[$i]->short_title; ?></a></div>	
		<?php } ?>
		<div class=more><a target="_blank" href="/news/news_list.php?id=196">更多...</a></div>
	</div>
</div>
<!--<div class=r_content>
	<div class=r_c_title>相关新闻</div>
	<div class=r_context>
		<?php for($i=0;$i<11;$i++){ ?>
			<div class=cl><a href="">·全国长江韬奋奖</a></div>	
		<?php } ?>
		<div class=more><a href="">更多...</a></div>
	</div>
</div>-->