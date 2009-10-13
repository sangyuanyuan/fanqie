<?php
	require_once('../../frame.php');
	use_jquery();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-专题-全家都来赛</title>
	<LINK href="css/index.css" type=text/css rel=stylesheet>
	<?php 
		$db=get_db();
		$record_video=$db->query('select * from smg_video v left join smg_category c on v.category_id=c.id where c.name="全家视频" and c.category_type="video" order by v.priority asc,v.created_at desc limit 4');
		$record_video1=$db->query('select * from smg_video v left join smg_category c on v.category_id=c.id where c.name="全家视频" and c.category_type="video" order by v.click_count desc,v.created_at asc limit 5');
	?>
</head>
<body>
	<div id="fbody">
		<div id=fl><a target="_blank" href="/news/news_list.php?id=137"><img border=0 src="images/msrs.jpg"></a></div><div id=fr><a target="_blank" href="/news/news_list.php?id=138"><img border=0 src="images/fqss.jpg"></a></div>
		<div id=ftop>
			<div id="bmrs">88888</div>
		</div>
		<div style="width:1000px; height:10px; float:left; display:inline"></div>
		<div id="video_l">
			<div id=light></div>
			<div id="video">
				
				<div id="video_content">
					<iframe id=video_src src="video.php?photo=<?php echo $record_video[0]->photo_url;?>&video=<?php echo $record_video[0]->video_url;?>" width=422 height=317 scrolling="no" frameborder="0"></iframe>
				</div>
			</div>
		</div>
		<div id="video_right">
			<?php for($i=1;$i<4;$i++){ ?>
				<div class=video_r>
						<div class="video_img">
							<div class="video_image"><a param="<?php $record_video[$i]->video_url;?>" class="video_url"><img border=0 src="<?php echo $record_video[$i]->photo_url;?>"></a></div>
						</div>	
						<div class="video_vote"><div class="title"><?php echo $record_video[$i]->title; ?></div><div class="vote"><a param="<?php echo $record_video[$i]->id;?>" class="digg">投票</a></div></div>
				</div>
			<?php } ?>
		</div>
		<div id=t_r>
			<div id=t_r_title>
				<div id="title">视频内容</div>
				<div id=more><a target="_blank" href="/show/list.php?id=141&type=video">历史视频>></a></div>
			</div>
			<div id=t_r_b>
				<div id=content>
					<div id="left"><a target="_blank" href=""><img src="<?php echo $record_video1[0]->photo_url; ?>"></a></div>
					<div id="right">
						<div id="title"><a target="_blank" href="/show/video.php?id=<?php echo $record_video1[0]->id; ?>"><?php echo $record_video1[0]->title; ?></a></div>
						<div id=context><a target="_blank" href="/show/video.php?id=<?php echo $record_video1[0]->id; ?>"><?php echo mb_substr(strip_tags($record_video1[0]->content),0,15,"utf-8")."...";?></a></div>
						<div id="tp"><a param="<?php echo $record_video1[0]->id;?>" class="digg">投票</a></div>
					</div>
				</div>
				<?php for($i=1;$i<count($record_video1);$i++){ ?>
				<div class=content>
					<div class=content_l>
						<a target="_blank" href="/show/video.php?id=<?php echo $record_video1[$i]->id;?>"><img src="<?php echo $record_video1[$i]->photo_url; ?>"></a>	
					</div>
					<div class=content_c>
						<div class=title><a target="_blank" href="/show/video.php?id=<?php echo $record_video1[$i]->id; ?>"><?php echo $record_video1[$i]->title; ?></a></div>
						<div class=context><a target="_blank" href="/show/video.php?id=<?php echo $record_video1[$i]->id; ?>"><?php echo mb_substr(strip_tags($record_video1[$i]->content),0,15,"utf-8")."...";?></a></div>
					</div>
					<div class=content_r>
						<a class="digg" param="<?php echo $record_video1[$i]->id;?>">投票</a>	
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div id="video_b">
			<div id=content></div>
		</div>
	</div>
</body>
</html>
<script>
	$(function(){
		$(".digg").click(function(){
				$.post("video.post.php",{'id':$(this).attr('param')},function(data){			
				if(data=='OK'){
					alert('投票成功！');
				}})
		});
		$(".video_url").click(function(){
				var photo=$(this).next.attr('src');
				var video=$(this).attr('param');
				video_src(photo,video);
		});
	});
	function video_src(photo,video)
	{
		$("#video_src").attr('src','video.php?photo='+photo+'&video='+video);
	}
</script>