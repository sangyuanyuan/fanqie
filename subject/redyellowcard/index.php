<?php
	require_once('../../frame.php');
    $db = get_db();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -节目淘汰</title>
	<?php css_include_tag('subject_redyellowcard');
		use_jquery();
	?>
	<script>
		total("节目淘汰","subject");
	</script>	
</head>
<body>
	<div id=ibody>			
		<div id=banner></div>
		<div id=left>
			<?php $sql = 'select n.photo_src,n.content,n.id,n.title,n.description,n.short_title,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="节目淘汰" and i.category_type="news" and i.is_adopt=1 and c.name="2009年数据" order by i.priority asc, n.created_at desc limit 26';
				$news=$db -> query($sql);
			?>
			<div id=title>2009年数据</div>
			<div id=content>
				<?php for($i=0;$i<count($news);$i++){ ?>
					<div class=cl><a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $new[$i]->short_title; ?></a></div>
				<?php } ?>
			</div>	
		</div>
		<div id=center>
			<div id=c_t><img src="/images/subject/redyellowcard_center.jpg"></div>
			<div class=c_title>
				<?php $sql = 'select n.photo_src,n.content,n.id,n.title,n.description,n.short_title,n.created_at,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="节目淘汰" and i.category_type="news" and i.is_adopt=1 and c.name="提醒栏目" order by i.priority asc, n.created_at desc limit 5';
				$news=$db -> query($sql);
			?>
				<div class="c_title_left">提醒栏目</div>
				<div class="c_title_right"><a target="_blank" href="/news/news_subject_list.php?id=<?php echo $news[0]->id; ?>">更多内容</a></div>
			</div>
			<div class=c_content>
				<?php for($i=0;$i<count($news);$i++){ ?>
				<div class=cl>
					<a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->title." (".substr($news[$i]->created_at,0,10).")"; ?></a>	
				</div>
				<?php } ?>
			</div>
			<div class=c_title>
				<?php $sql = 'select n.photo_src,n.content,n.id,n.title,n.description,n.short_title,n.created_at,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="节目淘汰" and i.category_type="news" and i.is_adopt=1 and c.name="黄牌栏目" order by i.priority asc, n.created_at desc limit 5';
				$news=$db -> query($sql);
			?>
				<div class="c_title_left" style="color:yellow">黄牌栏目</div>
				<div class="c_title_right"><a target="_blank" href="/news/news_subject_list.php?id=<?php echo $news[0]->id; ?>">更多内容</a></div>
			</div>
			<div class=c_content>
				<?php for($i=0;$i<count($news);$i++){ ?>
				<div class=cl>
					<a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->title." (".substr($news[$i]->created_at,0,10).")"; ?></a>	
				</div>
				<?php } ?>
			</div>
			<div class=c_title>
				<?php $sql = 'select n.photo_src,n.content,n.id,n.title,n.description,n.short_title,n.created_at,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="节目淘汰" and i.category_type="news" and i.is_adopt=1 and c.name="红牌栏目" order by i.priority asc, n.created_at desc limit 5';
				$news=$db -> query($sql);
			?>
				<div class="c_title_left" style="color:red">红牌栏目</div>
				<div class="c_title_right"><a target="_blank" href="/news/news_subject_list.php?id=<?php echo $news[0]->id; ?>">更多内容</a></div>
			</div>
			<div class=c_content>
				<?php for($i=0;$i<count($news);$i++){ ?>
				<div class=cl>
					<a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->title." (".substr($news[$i]->created_at,0,10).")"; ?></a>	
				</div>
				<?php } ?>
			</div>
		</div>
		<div id=right>
			<div id=r_t_title></div>
			<?php $sql = 'select n.photo_src,n.content,n.id,n.title,n.description,n.short_title,n.created_at,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="节目淘汰" and i.category_type="news" and i.is_adopt=1 and c.name="执行规则" order by i.priority asc, n.created_at desc limit 5';
				$news=$db -> query($sql);
			?>
			<div id=r_t_content>
				<?php for($i=0;$i<count($news);$i++){ ?>
				<div class=cl>
					<a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->title." (".substr($news[$i]->created_at,0,10).")"; ?></a>	
				</div>
				<?php } ?>	
			</div>
			<div id=r_b_title></div>
			<?php $sql = 'select n.photo_src,n.content,n.id,n.title,n.description,n.short_title,n.created_at,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="节目淘汰" and i.category_type="news" and i.is_adopt=1 and c.name="执行规则" order by i.priority asc, n.created_at desc limit 5';
				$news=$db -> query($sql);
			?>
			<div id=r_b_content>
				<?php for($i=0;$i<count($news);$i++){ ?>
				<div class=cl>
					<a target="_blank" href="/subject/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo $news[$i]->title." (".substr($news[$i]->created_at,0,10).")"; ?></a>	
				</div>
				<?php } ?>	
			</div>
		</div>
		<div id=comment>
			<div id=b_left>
				<?php $comment=$db->query('select * from smg_comment where resource_type="redyellowcard" order by created_at desc'); ?>
				<div id=content>
					<marquee height="240" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
						<?php for($i=0;$i<count($comment);$i++){ ?>
							<span style="color:red"><?php echo $comment[$i]->nick_name; ?></span>：<?php echo $comment[$i]->comment; ?><br>
						<?php } ?>	
					</marquee>
				</div>	
			</div>
			<div id=b_right>
				<div id=title>发表我的评论</div>
				<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
				<div id=content>
					<span style="color:blue;">昵称</span>　<input id="commenter" name="post[nick_name]" type="text"><br>
					<span style="color:blue;">内容</span>　<textarea name="post[comment]" id="redyellowcardcomment" rows="10" cols="45"></textarea><br>
					<input type="hidden" id="resource_type" name="post[resource_type]" value="redyellowcard">
					<input type="hidden" id="target_url" name="post[target_url]" value="<?php $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
					<input type="hidden" name="type" value="comment">
					<button id="comment_sub"></button>	
				</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<script>
$(document).ready(function(){
	$("#comment_sub").click(function(){
			var content = $("#redyellowcardcomment").val();
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
