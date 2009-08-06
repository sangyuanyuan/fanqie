<?php require_once('../../frame.php');
	$db=get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -亮剑</title>
	<?php css_include_tag('liangjian');?>
</head>
<body>
	<div id=subject_body >
		<div id=subject_logo ></div>
		<div id=subject_content1>
		<div id=bottom>				
			<div id=right >
					<div class=title style="margin-top:5px;">滚动FLASH</div>
					<div class=content style="width:191px; border:none;">
						<?php	   
								$pics = $db->query('select n.src,n.url,n.title,c.id as cid from smg_images n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="photo" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="滚动FLASH" inner join smg_subject s on c.subject_id=s.id and s.name="亮剑专题" order by n.priority asc,n.created_at desc limit 6');
								$picsurl = array();
								$picslink = array();
								$picstext = array();
								for ($i=0;$i<count($pics);$i++)
								{
									$picsurl[]=$pics[$i]->src;
									$picslink[]=$pics[$i]->url;
									$picstext[]=$pics[$i]->short_title;
								}
						?>
						<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
							<div id="focus_01"></div> 
							<script type="text/javascript"> 
								var pic_width=191; //图片宽度
								var pic_height=210; //图片高度
								var pics="<?php echo implode(',',$picsurl);?>";
								var mylinks="<?php echo implode(',',$picslink);?>";
								
								var texts="<?php echo implode(',',$picstext);?>";
				 
								var picflash = new sohuFlash("/flash/focus.swf", "focus_01", "191", "210", "6","#FFFFFF");
								picflash.addParam('wmode','opaque');
								picflash.addVariable("picurl",pics);
								picflash.addVariable("piclink",mylinks);
								picflash.addVariable("pictext",texts);				
								picflash.addVariable("pictime","5");
								picflash.addVariable("borderwidth","191");
								picflash.addVariable("borderheight","210");
								picflash.addVariable("borderw","false");
								picflash.addVariable("buttondisplay","true");
								picflash.addVariable("textheight","20");
								picflash.addVariable("textcolor","#FF0000");	
								picflash.addVariable("pic_width",pic_width);
								picflash.addVariable("pic_height",pic_height);
								
								picflash.write("focus_01");				
							</script>	
					</div>
					<div class=title>
						<? $news=$db->query('select n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="创新需求" inner join smg_subject s on c.subject_id=s.id and s.name="亮剑专题" order by n.priority asc, n.last_edited_at desc limit 5');?>
						<div class=t1>创新需求</div>
						<a target="_blank" href="/news/news_list.php?type=liangjian&id=<?php echo $news[0]->cid;?>">more</a>
					</div>
					
					<div class=content>
						<? for($i=0; $i<count($news);$i++){?>
							<a target="_blank" href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a>
						<? }?>
					</div>
					<? $news=$db->query('select n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="亮剑视野" inner join smg_subject s on c.subject_id=s.id and s.name="亮剑专题" order by n.priority asc, n.last_edited_at desc limit 5');?>
					<div class=title>
						<div class=t1>亮剑视野</div><a href="/news/news_list.php?type=liangjian&id=<?php echo $news[0]->cid;?>">more</a>
					</div>
					
					<div class=content>
						<? for($i=0;$i<count($news);$i++){?>
							<a href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a>
						<? }?>
					</div>
					<? $news=$db->query('select n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="创新经验讲座" inner join smg_subject s on c.subject_id=s.id and s.name="亮剑专题" order by n.priority asc, n.last_edited_at desc limit 5');?>
					<div class=title>
						<div class=t1>创新经验讲座</div><a href="/news/news_list.php?type=liangjian&id=<?php echo $news[0]->cid;?>">more</a>
					</div>
					<div class=content>
						<? for($i=0;$i<count($news);$i++){?>
							<a href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a>
						<? }?>
					</div>
					<? $news=$db->query('select n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="亮剑征集令" inner join smg_subject s on c.subject_id=s.id and s.name="亮剑专题" order by n.priority asc, n.last_edited_at desc limit 5');?>
					<div class=title>
						<div class=t1>亮剑征集令</div><a href="/news/news_list.php?type=liangjian&id=<?php echo $news[0]->cid;?>">more</a>
					</div>
					<div class=content>
						<? for($i=0;$i<count($news);$i++){?>
							<a href="/news/news.php?id=<? echo $news[$i]->id;?>"><? echo $news[$i]->short_title;?></a>
						<? }?>
					</div>
				</div>
				<div id=subject_contenta style="width:550px; padding-top:20px;">
					<? $news=$db->query('select n.title,n.content from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="亮剑" inner join smg_subject s on c.subject_id=s.id and s.name="亮剑专题" order by n.priority asc, n.last_edited_at desc limit 1');?>
				<div id=alist style="width:540px; margin-top:10px; margin-left:15px;">
					<div id=content2><?php echo delhtml($news[0]->title);?></div>
					<div id=content4><?php echo get_fck_content($news[0]->content);?></div>
				</div>
			<div id=context1>
				<div id=page1>
				  <?php echo print_fck_pages('$news[0]->content','/subject/liangjian/index.php'); ?>
				</div>
			</div>	
		</div>
			</div>
			<div class=subject_title>发表评论<div id=more></div></div>
		`	<div id=context>
				<?php
				$comments = $db->paginate('select * from smg_comment where resource_type="liangjian" order by created_at desc',5);
				for($i=0;$i<count($comments);$i++){?>
				<div class=comment>	
					<div class=title><div style="float:left; display:inline;"><? echo $comments[$i]->nick_name;?></div><div style="margin-right:50px; float:right; display:inline"><? echo $comments[$i]->created_at;?></div></div>
					<? echo $comments[$i]->comment;?>
				</div>
				<? }?>
				<div id=page>
				<? paginate('');?>
				</div>
				<form name="commentform" method="post" action="/pub/pub.post.php">
				<div id=subject_comment>用户：<input type="text" name="post[nick_name]" id="commenter"/><br />
				<div id=comment>评论：</div><textarea id="commentcontent" name="post[comment]"></textarea></div>
				<input type="hidden" name="type" value="comment">
				<input type="hidden" id="resource_type" name="post[resource_type]" value="liangjian">
				<button id=btn type="submit">评　论</button>
				</form>
			</div>
		</div>
		<div id=subject_bottom>Copyright 2005-2006 MotorTrend.com.cn Science and Technology</div>
		</div>
		
	</div>
</body>
</html>

