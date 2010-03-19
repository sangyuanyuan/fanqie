<?php
	require_once('../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-番茄周刊</title>
	<?php css_include_tag('fqzk','top','bottom','thickbox');
		use_jquery();
		js_include_once_tag('total','thickbox');
	 ?>
<script>
	total("番茄周刊","other");
</script>
</head>
<body>
	<? require_once('../inc/top.inc.html');	?>
	<div id=ibody>
		<?php $record_video=$db->query('select * from smg_video where category_id=191 and is_adopt=1 order by priority asc,created_at desc');
		 $record_video1=$db->query('select * from smg_video where category_id=190 and is_adopt=1 order by priority asc,created_at desc');
		 ?>
		<div id=title>
			<div id=wz>番茄周刊</div>
			<div id=qs><?php echo $record_video1[0]->keywords; ?></div>
		</div>
		
		<div id=itop>
			<div id=t_l>
				<div class="l_title">
					<div class="title_name"><?php echo delhtml($record_video[0]->title); ?></div>
					<div class="click_count">点击数：<?php echo $record_video[0]->click_count; ?>次</div>
				</div>
				<div class=video1>
					<img param1=<?php echo $record_video[0]->photo_url ?> param2=<?php echo $record_video[0]->video_url ?> src="<?php echo $record_video[0]->photo_url ?>">	
				</div>
				<div class="l_title">
					<div class="title_name"><?php echo delhtml($record_video[1]->title); ?></div>
					<div class="click_count">点击数：<?php echo $record_video[1]->click_count; ?>次</div>
				</div>
				<div class=video2>
					<img param1=<?php echo $record_video[1]->photo_url ?> param2=<?php echo $record_video[1]->video_url ?> src="<?php echo $record_video[1]->photo_url ?>">	
				</div>
				<div class="l_title">
					<div class="title_name"><?php echo delhtml($record_video[2]->title); ?></div>
					<div class="click_count">点击数：<?php echo $record_video[2]->click_count; ?>次</div>
				</div>
				<div class=video3>
					<img param1=<?php echo $record_video[2]->photo_url ?> param2=<?php echo $record_video[2]->video_url ?> src="<?php echo $record_video[2]->photo_url ?>">		
				</div>
				<div class="l_title">
					<div class="title_name"><?php echo delhtml($record_video[3]->title); ?></div>
					<div class="click_count">点击数：<?php echo $record_video[3]->click_count; ?>次</div>
				</div>
				<div class=video2>
					<img param1=<?php echo $record_video[3]->photo_url ?> param2=<?php echo $record_video[3]->video_url ?> src="<?php echo $record_video[3]->photo_url ?>">	
				</div>
			</div>
			<div id=t_c>
				<div id=c_title><?php echo delhtml($record_video1[1]->title); ?></div>
				<div id=video><iframe id=video_url src="index_video.php?photo=<?php echo $record_video1[0]->photo_url; ?>&video=<?php echo $record_video1[0]->video_url ?>" width=491 height=388 scrolling="no" frameborder="0"></iframe></div>
				<div id=video_content><a href=""><?php echo $record_video1[0]->description; ?></a></div>
			</div>
			<div id=t_r>
				<div class="l_title">
					<div class="title_name"><?php echo delhtml($record_video[4]->title); ?></div>
					<div class="click_count">点击数：<?php echo $record_video[4]->click_count; ?>次</div>
				</div>
				<div class=video3>
					<img param1=<?php echo $record_video[4]->photo_url ?> param2=<?php echo $record_video[4]->video_url ?> src="<?php echo $record_video[4]->photo_url ?>">	
				</div>
				<div class="l_title">
					<div class="title_name"><?php echo delhtml($record_video[5]->title); ?></div>
					<div class="click_count">点击数：<?php echo $record_video[5]->click_count; ?>次</div>
				</div>
				<div class=video1>
					<img param1=<?php echo $record_video[5]->photo_url ?> param2=<?php echo $record_video[5]->video_url ?> src="<?php echo $record_video[5]->photo_url ?>">	
				</div>
				<div class="l_title">
					<div class="title_name"><?php echo delhtml($record_video[6]->title); ?></div>
					<div class="click_count">点击数：<?php echo $record_video[6]->click_count; ?>次</div>
				</div>
				<div class=video3>
					<img param1=<?php echo $record_video[6]->photo_url ?> param2=<?php echo $record_video[6]->video_url ?> src="<?php echo $record_video[6]->photo_url ?>">		
				</div>
				<div class="l_title">
					<div class="title_name"><?php echo delhtml($record_video[7]->title); ?></div>
					<div class="click_count">点击数：<?php echo $record_video[7]->click_count; ?>次</div>
				</div>
				<div class=video2>
					<img param1=<?php echo $record_video[7]->photo_url ?> param2=<?php echo $record_video[7]->video_url ?> src="<?php echo $record_video[7]->photo_url ?>">	
				</div>
			</div>
		</div>
		<div id=t_b></div>
		<div id=b_l>
			<div class=btn><a class="thickbox" href="index_comment.php?height=200&width=645">网友评论</a></div>
			<?php $comment=$db->query('select * from smg_comment where resource_type="fqzk" order by created_at desc'); ?>
			<div id=b_l_content>
					<div id=comment>
						<marquee height="480" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
							<?php for($i=0;$i<count($comment);$i++){ ?>
								<div class=comment_name><?php echo $comment[$i]->nick_name; ?><span style="font-weight:normal;">说：</span></div>
								<div class=comment_content><?php echo $comment[$i]->comment; ?></div>
							<?php } ?>
						</marquee>
					</div>
			</div>
		</div>
		<div id=b_r>
			<div class=btn><a target="_blank" href="upload.php">网友上传</a></div>
			<?php $news=$db->query('select id,title from smg_news where category_id=192 and is_adopt=1 order by priority asc,created_at desc limit 24'); ?>
			<div id=b_r_content>
				<div id=list>
					<?php for($i=0;$i<count($news);$i++){ ?>
						<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo delhtml($news[$i]->title); ?></a></div>
					<?php } ?>	
				</div>	
			</div>
		</div>
		<div id=b_b></div>
	</div>
	<? require_once('../inc/bottom.inc.html');?>
</body>
</html>
<script>
$(function(){
	$(".video").click(function()
	{
		total("番茄周刊","other");	
		video_src($(this).attr('param1'),$(this).attr('param2'));
	})
	
	
});




function video_src(photo,video)
{
	$("#video_src").attr('src','index_video.php?photo='+photo+'&video='+video);
}
</script>