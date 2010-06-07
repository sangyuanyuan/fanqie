<?php
	require_once('../../frame.php');
  $db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -2010世界杯</title>
	<?php css_include_tag('2010worldcup');
		use_jquery();
		js_include_once_tag('total');
	?>
	<script>
		total("2010世界杯专题","zone");
	</script>	
</head>
<body>
	<div id=logo></div>
	<div id=ibody>
		<?php $sql = 'select n.photo_url,n.video_url,n.title from smg_subject_items i left join smg_video n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="video" and i.is_adopt=1 and c.name="南非世界杯视频" order by i.priority asc, n.created_at desc limit 4';
				$record_video=$db -> query($sql);
		?>
		<div id=video>
			<iframe id=video_src src="video.php?photo=<?php echo $record_video[0]->photo_url; ?>&video=<?php echo $record_video[0]->video_url; ?>" width=463 height=322 scrolling="no" frameborder="0"></iframe>	
		</div>
		<?php 
				$sql = 'select n.photo_src,n.content,n.id,n.title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="news" and i.is_adopt=1 and c.name="赛程表" order by i.priority asc, n.created_at desc limit 1';
				$racecard=$db -> query($sql);
		?>
		<div id=racecard>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/racecard_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="http://172.27.203.81:8080/bbs/viewthread.php?tid=2793&extra=page%3D1">电视直播表</a></div>	
			</div>
			<div id=content><a target="_blank" href="/zone/news/news.php?id=<?php echo $racecard[0]->id; ?>"><?php echo $racecard[0]->content; ?></a></div>
		</div>
		<?php $comment=$db->query('select * from smg_comment where resource_type="2010worldcup" and resource_id=100000000 order by created_at desc limit 4'); ?>
		<div id=comment>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/comment_title.jpg"></div>
				<div class="adidas"><img src="/images/worldcup/adidas.jpg"></div>
				<div class="title_more"><a target="_blank" href="/comment/comment_list.php?id=100000000&type=2010worldcup">更多留言</a></div>	
			</div>
			<div id=content>
				<?php for($i=0;$i<count($comment);$i++){ ?>
					<div class=context <?php if($i==0){ ?>style="border-top:none;"<?php } ?>>
						<div class=name>评论者：<?php echo $comment[$i]->nick_name; ?></div><div class=time><?php echo $comment[$i]->created_at; ?></div>
						<div class=commentcontent><?php echo $comment[$i]->comment; ?></div>
					</div>
				<?php } ?>
			</div>
			<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
				<div id=commenter>
					<div id=name>昵称：<input type="text" name="post[nick_name]"></div>
					<div id=commentcontent>内容：<textarea id="contentcomment" name="post[comment]"></textarea></div>
					<div id=submit>发送留言</div>
					<input type="hidden" id="resource_id" name="post[resource_id]" value="100000000">
					<input type="hidden" id="resource_type" name="post[resource_type]" value="2010worldcup">
					<input type="hidden" id="target_url" name="post[target_url]" value="<?php $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
					<input type="hidden" name="type" value="comment">	
				</div>
			</form>
		</div>
		<div id=video_bottom>
			<?php for($i=1;$i<4;$i++){ ?>
				<div class=video_pic param1=<?php echo $record_video[$i]->photo_url ?> param2=<?php echo $record_video[$i]->video_url ?>><img src="<?php echo $record_video[$i]->photo_url; ?>"><div class=pictitle><?php echo $record_video[$i]->title; ?></div></div>
			<?php } ?>
		</div>
		<div id=gg><a href=""><img border=0 src="/images/worldcup/gg.jpg" /></div>
		<?php 
				$sql = 'select n.photo_src,n.description,n.id,n.title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="news" and i.is_adopt=1 and c.name="五星体育在南非" order by i.priority asc, n.created_at desc limit 15';
				$africa=$db -> query($sql);
		?>
		<div id=africa>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/africa_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="http://172.27.203.81:8080/bbs/forumdisplay.php?fid=86&page=1">更多内容</a></div>	
			</div>
			<div class=photo><a target="_blank" href="/zone/news/news.php?id=<?php echo $africa[0]->id; ?>"><img border=0 src="<?php echo $africa[0]->photo_src; ?>"></a></div>
			<div class=desc><a target="_blank" href="/zone/news/news.php?id=<?php echo $africa[0]->id; ?>"><?php echo $africa[0]->description; ?></a></div>
			<div class=news_content>
				<?php for($i=1;$i<14;$i++){ ?>
					<div class=context><a target="_blank" href="/zone/news/news.php?id=<?php echo $africa[$i]->id; ?>"><?php echo $africa[$i]->title; ?></a></div>
				<?php } ?>
			</div>
		</div>
		<?php 
				$sql = 'select n.photo_src,n.description,n.id,n.title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="news" and i.is_adopt=1 and c.name="绿茵风云" order by i.priority asc, n.created_at desc limit 15';
				$worldsoccer=$db -> query($sql);
		?>
		<div id=worldsoccer>
			<div class=title>
				<div class="title_left"><img src="/images/worldcup/worldsoccer_title.jpg"></div>
				<div class="title_more"><a target="_blank" href="http://172.27.203.81:8080/bbs/forumdisplay.php?fid=86&page=1">更多内容</a></div>	
			</div>
			<div class=photo><a target="_blank" href="/zone/news/news.php?id=<?php echo $worldsoccer[0]->id; ?>"><img border=0 src="<?php echo $worldsoccer[0]->photo_src; ?>"></a></div>
			<div class=desc><a target="_blank" href="/zone/news/news.php?id=<?php echo $worldsoccer[0]->id; ?>"><?php echo $worldsoccer[0]->description; ?></a></div>
			<div class=news_content>
				<?php for($i=1;$i<14;$i++){ ?>
					<div class=context><a target="_blank" href="/zone/news/news.php?id=<?php echo $worldsoccer[$i]->id; ?>"><?php echo $worldsoccer[$i]->title; ?></a></div>
				<?php } ?>
			</div>
		</div>
		
		
		<div id=bottom>
			<div id=turnleft></div>
			<?php 
				$sql = 'select n.photo_src,n.id from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="南非世界杯" and i.category_type="news" and i.is_adopt=1 and c.name="精彩图片" order by i.priority asc, n.created_at desc';
				$photo=$db -> query($sql);
				if(count($photo)%4==0)
				{
					$count=count($photo)/4;	
				}
				else
				{
					$count=count($photo)/4 + 1;		
				}
				for($i=0;$i<$count;$i++){
			?>
			<div class=bottom_content param=<?php echo $i; ?> id=bottom_content<?php echo $i;?> <?php if($i>0){ ?>style="display:none;"<?php } ?>>
				<?php for($j=0;$j<4;$j++){ ?>
					<div class=pic><a target="_blank" href="/zone/news/news.php?id=<?php echo $photo[$i]->id; ?>"><img border=0 src="<?php echo $photo[$i]->photo_src; ?>"></a></div>
				<?php } ?>	
			</div>
			<?php } ?>
			<div id=turnright></div>
			<input type="hidden" id="hidden_count" value="<?php echo $count; ?>" >
		</div>
	</div>
</body>
</html>
<script>
	$(function(){
		$(".video_pic").click(function(){
			$("#video_src").attr('src','video.php?photo='+$(this).attr('param1')+'&video='+$(this).attr('param2'));
		});
		$("#turn_left").click(function(){
			var num=$(this).next().attr('param');
			var count=$("#hidden_content").val();
			if(num==0)
			{
				$(".bottom_content").css('display','none');
				$("#bottom_content"+count).css('display','inline');
			}
			else
			{
				$(".bottom_content").css('display','none');
				$("#bottom_content"+(num-1)).css('display','inline');
			}
		});
		
		$("#turn_right").click(function(){
			var num=$(this).next().attr('param');
			var count=$("#hidden_content").val();
			if(num==count)
			{
				$(".bottom_content").css('display','none');
				$("#bottom_content0").css('display','inline');
			}
			else
			{
				$(".bottom_content").css('display','none');
				$("#bottom_content"+(num+1)).css('display','inline');
			}
		});
		
		$("#submit").click(function(){
			var content = $("#contentcomment").val();
			if(content==""){
				alert('评论内容不能为空！');
				return false;
			}
			if(content.length>1500)
			{
				alert('评论内容过长请分次评论！');
				return false;
			}
			document.subcomment.submit();
		});
	});
</script>
