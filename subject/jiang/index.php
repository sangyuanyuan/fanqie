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
	?>
	<script>
	total("专题-首届上海广播电视台、SMG年度颁奖盛典","news");
</script>
</head>
<body>
	<div id=bodys>
		<div id=logo></div>
		<div id=ibody_left>
			<?php $photo=$db->query('select * from smg_video where id=1305'); ?>
			<div id=l_t>
				<?php show_video_player('290','300',$photo[0]->photo_url,$photo[0]->video_url); ?>
			</div>
			<div id=l_b>
				<div id=title>投票调查</div>
				<div id=content>
					<?php 
						$vote=$db->query('select id from smg_vote where category_id=177 order by priority asc,created_at desc limit 1');
							$vote = new smg_vote_class();
							$vote->find(291);
							$vote->display();
						 ?>	
				</div>	
			</div>
		</div>
		<div id=ibody_center>
			<div id=c_title>首届上海广播电视台、SMG年度颁奖盛典</div>
			<div id=line></div>
			<?php $news=$db->query('select id,title from smg_news where category_id=171 and is_adopt=1 order by priority asc,created_at desc limit 14'); 
				for($i=0;$i<count($news);$i++)
				{
			?>	
				<div class="c_list">·<a style="" target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo delhtml($news[$i]->title);?></a></div>
			<?php } ?>
		</div>
		<div id=ibody_right>
			<div id=r_t>
				<div class=r_title>获奖名单</div>	
				<div id=content>
					<a target="_blank" href="/show/vote.php"><img border=0 width="270" height="190" src="/upload/images/qMBTY0FRCj.jpg"></a>
				</div>
			</div>
			<div id=r_b>
				<div class=r_title>留言评论</div>	
				<div id=content>
					<?php $news=$db->query('select nick_name,comment from smg_comment where resource_type="firstjiang" order by created_at desc'); ?>
					<div id=c_top>
						<marquee direction=up behavior="scroll" SCROLLDELAY="200" height=100 width=270 >
							<?php for($i=0;$i<count($news);$i++){ ?>
							<span style="font-weight:bold;"><?php echo $news[$i]->nick_name; ?></span>:<?php echo $news[$i]->comment; ?><br>
							<?php } ?>
						</marquee>
					</div>
					<div id=c_bottom>
						<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
							姓　名：<input type="text" id="commenter" name="post[nick_name]"><br>
							<input type="hidden" id="resource_type" name="post[resource_type]" value="firstjiang">
							<input type="hidden" id="target_url" name="post[target_url]" value="<?php $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
							内　容：<textarea id="comment" name="post[comment]"></textarea><br>
							<input type="hidden" name="type" value="comment">
							<button style="margin-top:10px; margin-right:15px; border:1px solid #cccccc; background:#ffffff; line-height:20px; float:right; display:inline;" id="comment_sub" >提交评论</button>
			</form>
						</div>
				</div>
			</div>
		</div>
		<div class=dh style="background:url(images/dh1.gif) no-repeat;"><div class=more><a target="_blank" href="image_list.php?category_id=172">更多>></a></div></div>
		<?php $news=$db->query('select id,short_title,description,photo_src from smg_news where category_id=172 and is_adopt=1 order by priority asc,created_at desc limit 12'); 
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
		<?php } ?>
		<div class=dh style="background:url(images/dh2.gif) no-repeat;"><div class=more><a target="_blank" href="image_list.php?category_id=173">更多>></a></div></div>
		<?php $photo=$db->query('select id,src from smg_images where category_id=173 and is_adopt=1 order by priority asc,created_at desc limit 20'); 
				for($i=0;$i<count($photo);$i++)
				{
			?>	
		<div class=photo>
			<a target="_blank" href="<?php echo $photo[$i]->src;?>"><img border=0 width=200 height=200 src="<?php echo $photo[$i]->src;?>"></a>
		</div>
		<?php } ?>
		<div id=bottom>
			<?php $news=$db->query('select id,short_title from smg_news where category_id=178 and is_adopt=1 order by priority asc,created_at desc'); ?>
			<div id=title>2009年重要奖获奖结果</div>
			<div id=content>
				<?php for($i=0;$i<count($news);$i++){ ?>
					<button param="<?php echo $news[$i]->id ?>" class="btn"><?php echo delhtml($news[$i]->short_title); ?></button>
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>
<script>
	$(document).ready(function(){
		$('.btn').click(function(){
			var num=$(this).attr("param");
			window.open("http://172.27.203.81:8080/news/news/news.php?id="+num);
		});
	});
</script>