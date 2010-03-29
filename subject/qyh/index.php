<?
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG - 三项教育 - 群英汇</title>
	<?php css_include_tag('qyh','qyh_top','qyh_bottom');
		use_jquery();
		js_include_once_tag('total');
	?>
<script>
	total("专题-群英汇","show");
</script>
</head>
<body>
	<div id=ibody>	
		<?php include('inc/top.inc.php');?>
			<div id=qyh_index>
				<div id=index_top>
					<div class=index_t_title>风云英雄榜</div>
					<?php $news=$db->query('select short_title,photo_src,id from smg_news where category_id=194 and is_adopt=1 order by priority asc,created_at desc'); ?>
					<div id=t_l_pic>
						<a target="_blank" href="/show/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 src="<?php echo $news[0]->photo_src; ?>"></a>	
					</div>
					<div id=fd><a target="_blank" href="/show/news/news.php?id=<?php echo $news[0]->id; ?>"><?php echo $news[0]->short_title; ?></a></div>
					<div class=t_r_pic>
						<div class="t_r_picimg"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[1]->id; ?>"><img border=0 src="<?php echo $news[1]->photo_src; ?>"></a></div>
						<div class="t_r_picimg" style="margin-left:38px;"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[2]->id; ?>"><img border=0 src="<?php echo $news[2]->photo_src; ?>"></a></div>
						<div class="t_r_picimg" style="margin-left:32px;"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[3]->id; ?>"><img border=0 src="<?php echo $news[3]->photo_src; ?>"></a></div>
						<div class="t_r_pictitle"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[1]->id; ?>"><?php echo $news[1]->short_title; ?></a></div>
						<div class="t_r_pictitle" style="margin-left:38px;"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[2]->id; ?>"><?php echo $news[2]->short_title; ?></a></div>
						<div class="t_r_pictitle" style="margin-left:32px;"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[3]->id; ?>"><?php echo $news[3]->short_title; ?></a></div>
					</div>
					<div class=t_r_pic>
						<div class="t_r_picimg"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[4]->id; ?>"><img border=0 src="<?php echo $news[4]->photo_src; ?>"></a></div>
						<div class="t_r_picimg" style="margin-left:38px;"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[5]->id; ?>"><img border=0 src="<?php echo $news[5]->photo_src; ?>"></a></div>
						<div class="t_r_picimg" style="margin-left:32px;"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[6]->id; ?>"><img border=0 src="<?php echo $news[6]->photo_src; ?>"></a></div>
						<div class="t_r_pictitle"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[4]->id; ?>"><?php echo $news[4]->short_title; ?></a></div>
						<div class="t_r_pictitle" style="margin-left:38px;"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[5]->id; ?>"><?php echo $news[5]->short_title; ?></a></div>
						<div class="t_r_pictitle" style="margin-left:32px;"><a target="_blank" href="/show/news/news.php?id=<?php echo $news[6]->id; ?>"><?php echo $news[6]->short_title; ?></a></div>
					</div>
					<?php $news=$db->query('select content,id from smg_news where category_id=195 and is_adopt=1 order by priority asc,created_at desc limit 1'); ?>
					<div class=index_t_title>群英汇介绍</div>
					<div id=t_l_content><a target="_blank" href="/show/news/news.php?id=<?php $news[0]->id; ?>"><?php echo $news[0]->content; ?></a></div>
				</div>
				<div id=index_mid_l>
					<div id=title>心灵之光</div>
					<?php $news=$db->query('select photo_src,id,description,short_title from smg_news where category_id=196 and is_adopt=1 order by priority asc,created_at desc limit 6');
					for($i=0;$i<count($news);$i++){ ?>
						<div class=m_l_content>
							<div class=pic><a target="_blank" href="/show/news/news.php?id=<?php echo $news[$i]->id; ?>"><img border=0 src="<?php echo $news[$i]->photo_src; ?>"></a></div>
							<div class=piccontent><a target="_blank" href="/show/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo delhtml($news[$i]->short_title)."<br>".delhtml($news[$i]->description); ?></a></div>
							<div class=ly><a target="_blank" href="/show/news/news.php?id=<?php echo $news[$i]->id; ?>">[欢迎留言]</a></div>
						</div>
					<?php } ?>
				</div>
				<div id=index_mid_r_t>
					<div id=title>
						<div id=wz>对话群英</div>
						<div id=more><a target="_blank" href="/bbs/forumdisplay.php?fid=81">>> 进入留言板</a></div>
					</div>
					<?php $dialog=$db->query('select * from smg_dialog where title like "%对话群英%" and is_adopt=1 order by create_time desc limit 1'); ?>
					<div class=pic>
						<a target="_blank" href="dialog.php?id=<?php echo $dialog[0]->id; ?>"><img border=0 src="<?php echo $dialog[0]->photo_url; ?>"></a>	
					</div>
					<div id=dialogname>
						<div class=name><a target="_blank" href="dialog.php?id=<?php echo $dialog[0]->id; ?>"><?php echo $dialog[0]->title; ?></a></div>
						<div class=content><a target="_blank" href="dialog.php?id=<?php echo $dialog[0]->id; ?>"><?php echo $dialog[0]->content; ?></div>
					</div>
				</div>
				<?php $pic=$db->query('select photo_src,id,title from smg_news where category_id=204 and is_adopt=1 order by priority asc,created_at desc limit 1'); ?>
				<div id=index_mid_r_b>
					<div id=pic><img src="<?php echo $pic[0]->photo_src; ?>"></div>
					<div id=wz><a target="_blank" href="/show/news/news.php?id=<?php echo $pic[0]->id; ?>"><?php echo $pic[0]->title; ?></a></div>	
				</div>
				<div id=index_b1>
					<div id=title>群英闪烁</div> 
					<?php $pic=$db->query('select photo_src,id from smg_news where category_id=206 and is_adopt=1 order by priority asc,created_at desc limit 5');
					for($i=0;$i<count($pic);$i++){ ?>
						<div class=pic><a target="_blank" href="/show/news/news.php<?php echo $pic[0]->id; ?>"><img border=0 src="<?php echo $pic[$i]->photo_src; ?>"></a></div>
					<?php } ?>
					<div id=jiangxiang>
						<div class=jx>
							<div class=wz><a href="">长江韬奋奖</a></div>
						</div>
						<div class=jx>
							<div class=wz><a href="">优秀新闻工作者奖</a></div>
						</div>	
						<div class=jx>
							<div class=wz><a href="">德艺双馨奖</a></div>
						</div>	
						<div class=jx>
							<div class=wz><a href="">金话筒奖</a></div>
						</div>
					</div>
				</div>
				<div class=index_b_l>
					<div class=title>群英们的故事</div>
					<?php  $news=$db->query('select photo_src,id,description,title from smg_news where category_id=200 and is_adopt=1 order by priority asc,created_at desc limit 5');?>
					<div class=content_l>
						<div class=pic><a target="_blank" href="/show/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 src="<?php echo $news[$i]->photo_src; ?>"></a></div>
						<div class=piccontent><a target="_blank" href="/show/news/news.php?id=<?php echo $news[0]->id; ?>"><?php echo $news[0]->description; ?></a></div>	
					</div>
					<div class=content_r>
						<?php for($i=1;$i<count($news);$i++){ ?>
						<div class=b_l_c>
							<div class=pic><a target="_blank" href="/show/news/news.php?id=<?php echo $news[$i]->id; ?>"><img border=0 src="<?php echo $news[$i]->photo_src; ?>"></a></div>
							<div class=piccontent><a target="_blank" href="/show/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->title; ?></a></div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class=index_b_r>
					<div class=title>奖项介绍</div>
					<?php  $news=$db->query('select photo_src,id,description,title from smg_news where category_id=202 and is_adopt=1 order by priority asc,created_at desc limit 12');?>
					<div class=content>
						<?php for($i=0;$i<count($news);$i++){ ?>
						<div class=cl><a target="_blank" href="/show/news/news.php?id=<?php echo $news[$i]->id; ?>">·<?php echo $news[$i]->title; ?></a></div>
						<?php } ?>
					</div>
				</div>
				<div class=index_b_l>
					<div class=title>群英们的足迹</div>
					<?php  $news=$db->query('select photo_src,id,description,title from smg_news where category_id=201 and is_adopt=1 order by priority asc,created_at desc limit 12');?>	
						<div class=content_l>
						<div class=pic><a target="_blank" href="/show/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 src="<?php echo $news[0]->photo_src; ?>"></a></div>
						<div class=piccontent><a target="_blank" href="/show/news/news.php?id=<?php echo $news[0]->id; ?>"><?php echo $news[0]->description; ?></a></div>	
					</div>
					<div class=content_r>
						<?php for($i=0;$i<6;$i++){ ?>
						<div class=b_l_c>
							<div class=pic><a target="_blank" href="/show/news/news.php?id=<?php echo $news[$i]->id; ?>"><img border=0 src="<?php echo $news[$i]->photo_src; ?>"></a></div>
							<div class=piccontent><a target="_blank" href="/show/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo delhtml($news[$i]->title)."<br>".delhtml($news[$i]->description); ?></a></div>
						</div>
						<?php } ?>
					</div>
				</div>
				
				<div class=index_b_r>
					<div class=title>群英博客</div>
					<?php  $news=$db->query('select photo_src,id,description,title from smg_news where category_id=203 and is_adopt=1 order by priority asc,created_at desc limit 12');?>
					<div class=content>
						<?php for($i=0;$i<count($news);$i++){ ?>
						<div class=cl><a target="_blank" href="/show/news/news.php?id=<?php echo $news[$i]->id; ?>">·<?php echo $news[$i]->title; ?></a></div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php include('inc/bottom.inc.php');?>
	</div>
</body>
</html>

