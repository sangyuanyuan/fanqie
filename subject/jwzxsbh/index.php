<?php 
	require_once('../../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>番茄网 - 技术运营中心世博专题</title>
	<?php
		use_jquery();
		css_include_tag('jwzxsbh');
		js_include_once_tag('total');
	?>
	<script>
		total("专题-技术运营中心世博会","other");
	</script>
</head>
<body>
	<?php $db=get_db(); ?>
	<div id=ibody>
		<div id=flash><embed src="4.swf" quality="high" width=801 height=100 type='application/x-shockwave-flash'></embed></div>
		<div class=dh1 style="margin-left:55px;"><a target="_blank" href="/news/news_subject_list.php?id=139">重点关注</a></div>
		<div class=dh2><a target="_blank" href="/news/news_subject_list.php?id=132">采风世博园</a></div>
		<div class=dh1><a target="_blank" href="/news/news_subject_list.php?id=133">领导视察</a></div>
		<div class=dh1><a target="_blank" href="/news/news_subject_list.php?id=134">世博之星</a></div>
		<div class=dh1><a target="_blank" href="/news/news_subject_list.php?id=135">IBC要闻</a></div>
		<div class=dh1><a target="_blank" href="/news/news_subject_list.php?id=136">运营动态</a></div>
		<div class=dh1><a target="_blank" href="#">世博寄语</a></div>
		<div class=dh1><a target="_blank" href="/news/news_subject_list.php?id=137">主题活动</a></div>
		<div class=dh1><a target="_blank" href="/news/news_subject_list2.php">技术资讯站</a></div>
		<div id=ileft>
			<div id=l_top>
				<?php $record_video = $db->query('select n.video_photo_src,n.video_src,n.short_title,n.id,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="重点关注" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
				<div class=title>重点关注</div>
				<div class=more><a target="_blank" href="/news/news_subject_list.php?id=139"><img border=0 src="images/more.jpg"></a></div>
				<div id=video>
					<iframe id=video_src src="index_video.php?photo=<?php echo $record_video[0]->video_photo_src; ?>&video=<?php echo $record_video[0]->video_src ?>" width=178 height=136 scrolling="no" frameborder="0"></iframe>
				</div>
				<div class=video_list style="margin-top:12px;"><span target="_blank" class=video param1=<?php echo $record_video[0]->video_photo_src ?> param2=<?php echo $record_video[0]->video_src ?>><?php echo $record_video[0]->short_title; ?></span></div>
				<div class=video_list><span target="_blank" class=video param1=<?php echo $record_video[1]->video_photo_src ?> param2=<?php echo $record_video[1]->video_src ?>><?php echo $record_video[1]->short_title; ?></span></div>
				<div class=video_list><span target="_blank" class=video param1=<?php echo $record_video[2]->video_photo_src ?> param2=<?php echo $record_video[2]->video_src ?>><?php echo $record_video[2]->short_title; ?></span></div>
			</div>
			<div id=l_m>
				<div class=title>寄语世博</div>
				<div class=more><a target="_blank" href="#"><img border=0 src="images/more.jpg"></a></div>
				<div id=content>
					<? $newslist=$db->query('select * from smg_comment where resource_type="jwzxsbh" order by created_at desc');?>
					<marquee height="89" DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
						<? for($i=0; $i<count($newslist); $i++){?>
							<div style="width:166px; margin-left:5px; margin-bottom:10px; word-break:break-all; float:left; display:inline;"><span style="color:#0000FF;"><? echo $newslist[$i]->nick_name;?></span>说：<? echo $newslist[$i]->comment;?></div>
						<? }?>
					</marquee>
				</div>
				<form name="commentform" method="post" action="/pub/pub.post.php">
					<div id=comment_name>姓名:　<input type="text" name="post[nick_name]" id="commenter"></div>
					<div id=comment_content><div class=wz>内容:</div><div class=wztext><textarea id="commentcontent" name="post[comment]"></textarea></div></div>
					<input type="hidden" name="type" value="comment">
					<input type="hidden" id="resource_type" name="post[resource_type]" value="jwzxsbh">
					<div id=send><button id=btn type="submit"></button></div>
				</form>
			</div>
			<div id=l_b>
				<div class=title>相关资料</div>
				<div class=more><a target="_blank" href=""><img border=0 src="images/more.jpg"></a></div>
				<div id=content>
					<a target="_blank" href="/"><img border=0 src="images/tomato.jpg"></a><br>
					<a target="_blank" href="/">番茄网</a><br>
					<a target="_blank" href="http://www.expo2010.cn/"><img border=0 src="images/sbh.jpg"></a><br>
					<a target="_blank" href="http://www.expo2010.cn/">上海世博会官网</a><br>
					<a target="_blank" href="http://172.27.203.81:8080/blog/index.php?uid-3328"><img border=0 src="images/blog.jpg"></a><br>
					<a target="_blank" href="http://172.27.203.81:8080/blog/index.php?uid-3328">EXPOTECH博客</a><br>
				</div>
			</div>
		</div>
		<div id=iright>
			<div id=r_t>
				<div class=title>采风世博园</div>
				<div class=more><a target="_blank" href="/news/news_subject_list.php?id=132"><img border=0 src="images/more.jpg"></a></div>
				<div id=gd>
				<?php $photo = $db->query('select n.photo_src,n.id,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="采风世博园" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc');?>
	        <script type="text/javascript"> 
						function ScrollImgLeft(){
							var speed=20
							var scroll_begin = document.getElementById("scroll_begin");
							var scroll_end = document.getElementById("scroll_end");
							var scroll_div = document.getElementById("scroll_div");
							scroll_end.innerHTML=scroll_begin.innerHTML
							  function Marquee(){
							    if(scroll_end.offsetWidth-scroll_div.scrollLeft<=0)
							      scroll_div.scrollLeft-=scroll_begin.offsetWidth
							    else
							      scroll_div.scrollLeft++
							  }
							var MyMar=setInterval(Marquee,speed)
							  scroll_div.onmouseover=function() {clearInterval(MyMar)}
							  scroll_div.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
						}		
					</script>
					<div style="text-align:center">
					  <div class="sqBorder">
					  <!--#####滚动区域#####-->
					    <div id="scroll_div" class="scroll_div">
					      <div id="scroll_begin">
					        <ul>
					        	<? for($i=0;$i<count($photo);$i++){?>
					          <li><a target="_blank" href="/news/news/news.php?id=<? echo $photo[$i]->id;?>"><img border=0 width=65 height=58 src="<? echo $photo[$i]->photo_src;?>"  /></a></li>
					          <? }?>
					        </ul>
					      </div>
					      <div id="scroll_end"></div>
					    </div>
					  <!--#####滚动区域#####-->
					  </div>
					  <script type="text/javascript">ScrollImgLeft();</script>
					</div>
				</div>
			</div>
			<div id=r_b_left>
				<div class=r_b_l>
					<?php $news = $db->query('select n.photo_src,n.id,n.title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="领导视察" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
					<div class=title>领导视察</div>
					<div class=more><a target="_blank" href="/news/news_subject_list.php?id=133"><img border=0 src="images/more.jpg"></a></div>
					<?php for($i=0;$i<count($news);$i++){ ?>
					<div class=content1>
							<div class=icon1><img border=0 src="images/icon1.jpg"></div><div class=cl1><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo delhtml($news[$i]->title); ?></a></div><?php if($i==0){ ?><div class=new><img src="images/new.gif"></div><?php } ?>	
					</div>
					<?php } ?>
				</div>
				<div class=r_b_l>
					<?php $news = $db->query('select n.photo_src,n.id,n.title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="世博之星" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
					<div class=title>世博之星</div>
					<div class=more><a target="_blank" href="/news/news_subject_list.php?id=134"><img border=0 src="images/more.jpg"></a></div>
					<div class=content3>
						<div class=pic><a target="_blank" href=""><img border=0 width=71 height=47 src="<?php echo $news[0]->photo_src; ?>"></a></div>
						<?php for($i=0;$i<count($news);$i++){ ?>
							<div class=cl2 <?php if($i==0){?>style="margin-top:5px;"<?php } ?> ><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo delhtml($news[$i]->title); ?></a></div>
						<?php } ?>
					</div>
				</div>
				<div class=r_b_l>
					<?php $news = $db->query('select n.photo_src,n.id,n.title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="IBC要闻" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
					<div class=title>IBC要闻</div>
					<div class=more><a target="_blank" href="/news/news_subject_list.php?id=135"><img border=0 src="images/more.jpg"></a></div>
					<?php for($i=0;$i<count($news);$i++){ ?>
					<div class=content2>
							<div class=icon2><img border=0 src="images/icon2.jpg"></div><div class=cl1><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo delhtml($news[$i]->title); ?></a></div><?php if($i==0){ ?><div class=new><img src="images/new.gif"></div><?php } ?>	
					</div>
					<?php } ?>
				</div>
				<div class=r_b_l>
					<?php $news = $db->query('select n.photo_src,n.id,n.title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="运营动态" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
					<div class=title>运营动态</div>
					<div class=more><a target="_blank" href="/news/news_subject_list.php?id=136"><img border=0 src="images/more.jpg"></a></div>
					<?php for($i=0;$i<count($news);$i++){ ?>
					<div class=content2>
							<div class=icon3><img border=0 src="images/icon3.jpg"></div><div class=cl1><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo delhtml($news[$i]->title); ?></a></div><?php if($i==0){ ?><div class=new><img src="images/new.gif"></div><?php } ?>	
					</div>
					<?php } ?>
				</div>
				<div class=r_b_l>
					<?php $news = $db->query('select n.photo_src,n.id,n.title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="主题活动" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
					<div class=title>主题活动</div>
					<div class=more><a target="_blank" href="/news/news_subject_list.php?id=137"><img border=0 src="images/more.jpg"></a></div><?php if($i==0){ ?><div class=new><img src="images/new.gif"></div><?php } ?>
					<?php for($i=0;$i<count($news);$i++){ ?>
					<div class=content2>		
							<div class=icon4><img border=0 src="images/icon4.jpg"></div><div class=cl1><a target="_blank" href="/news/news/news.php?id=<?php echo $news[$i]->id; ?>"><?php echo delhtml($news[$i]->title); ?></a></div><?php if($i==0){ ?><div class=new><img src="images/new.gif"></div><?php } ?>							
					</div>
					<?php } ?>
				</div>
			</div>
			<div class=r_b_r>
				<div class=title style="margin-left:30px;">技术资讯站</div>
				<div class=more><a target="_blank" href="/news/news_subject_list2.php"><img border=0 src="images/more.jpg"></a></div>
				
				<div class=r_b_r_c>
					<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="IBC高清电视演播室" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
					<div class=r_b_r_content style="margin-left:0px;">
						<div class=r_b_r_title>IBC高清演播室</div>
						<div class=content>
							<div class=context>
								<a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 width=81 height=56 src="<?php echo $news[0]->photo_src; ?>"></a><br>
								<div class=cl style="margin-top:5px;"><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>">·<?php echo delhtml($news[0]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[1]->id; ?>">·<?php echo delhtml($news[1]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[2]->id; ?>">·<?php echo delhtml($news[2]->short_title); ?></a></div>
							</div>		
						</div>
					</div>
					<div class=r_b_r_content>
						<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="世博轴HD透明演播室" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
						<div class=r_b_r_title>世博轴透明演播室</div>
						<div class=content>
							<div class=context>
								<a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 width=81 height=56 src="<?php echo $news[0]->photo_src; ?>"></a><br>
								<div class=cl style="margin-top:5px;"><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>">·<?php echo delhtml($news[0]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[1]->id; ?>">·<?php echo delhtml($news[1]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[2]->id; ?>">·<?php echo delhtml($news[2]->short_title); ?></a></div>
							</div>		
						</div>
					</div>
					<div class=r_b_r_content style="margin-left:3px;">
						<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="IBC网络演播室" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
						<div class=r_b_r_title>　IBC网络演播室</div>
						<div class=content>
							<div class=context>
								<a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 width=81 height=56 src="<?php echo $news[0]->photo_src; ?>"></a><br>
								<div class=cl style="margin-top:5px;"><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>">·<?php echo delhtml($news[0]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[1]->id; ?>">·<?php echo delhtml($news[1]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[2]->id; ?>">·<?php echo delhtml($news[2]->short_title); ?></a></div>
							</div>		
						</div>
					</div>
				</div>
				
				<div class=r_b_r_c>
					<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="广播直播室" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
					<div class=r_b_r_content style="margin-left:0px;">
						<div class=r_b_r_title>广播直播室</div>
						<div class=content>
							<div class=context>
								<a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 width=81 height=56 src="<?php echo $news[0]->photo_src; ?>"></a><br>
								<div class=cl style="margin-top:5px;"><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>">·<?php echo delhtml($news[0]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[1]->id; ?>">·<?php echo delhtml($news[1]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[2]->id; ?>">·<?php echo delhtml($news[2]->short_title); ?></a></div>
							</div>		
						</div>
					</div>
					<div class=r_b_r_content>
						<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="广播透明转播车" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
						<div class=r_b_r_title>广播透明转播车</div>
						<div class=content>
							<div class=context>
								<a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 width=81 height=56 src="<?php echo $news[0]->photo_src; ?>"></a><br>
								<div class=cl style="margin-top:5px;"><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>">·<?php echo delhtml($news[0]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[1]->id; ?>">·<?php echo delhtml($news[1]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[2]->id; ?>">·<?php echo delhtml($news[2]->short_title); ?></a></div>
							</div>		
						</div>
					</div>
					<div class=r_b_r_content style="margin-left:3px;">
						<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="SMG专用工作区" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
						<div class=r_b_r_title>　SMG专用工作区</div>
						<div class=content>
							<div class=context>
								<a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 width=81 height=56 src="<?php echo $news[0]->photo_src; ?>"></a><br>
								<div class=cl style="margin-top:5px;"><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>">·<?php echo delhtml($news[0]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[1]->id; ?>">·<?php echo delhtml($news[1]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[2]->id; ?>">·<?php echo delhtml($news[2]->short_title); ?></a></div>
							</div>		
						</div>
					</div>
				</div>
				
				<div class=r_b_r_c>
					<div class=r_b_r_content style="margin-left:0px;">
						<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="ENG新闻采访系统" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
						<div class=r_b_r_title>ENG新闻采访系统</div>
						<div class=content>
							<div class=context>
								<a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 width=81 height=56 src="<?php echo $news[0]->photo_src; ?>"></a><br>
								<div class=cl style="margin-top:5px;"><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>">·<?php echo delhtml($news[0]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[1]->id; ?>">·<?php echo delhtml($news[1]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[2]->id; ?>">·<?php echo delhtml($news[2]->short_title); ?></a></div>
							</div>		
						</div>
					</div>
					<div class=r_b_r_content>
						<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="后期编辑制作系统" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
						<div class=r_b_r_title>后期编辑制作系统</div>
						<div class=content>
							<div class=context>
								<a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 width=81 height=56 src="<?php echo $news[0]->photo_src; ?>"></a><br>
								<div class=cl style="margin-top:5px;"><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>">·<?php echo delhtml($news[0]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[1]->id; ?>">·<?php echo delhtml($news[1]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[2]->id; ?>">·<?php echo delhtml($news[2]->short_title); ?></a></div>
							</div>		
						</div>
					</div>
					<div class=r_b_r_content style="margin-left:3px;">
						<?php $news = $db->query('select n.photo_src,n.id,n.short_title,c.id as cid from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type="news" and i.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.name="高清转播系统" inner join smg_subject s on c.subject_id=s.id and s.name="技术运营中心世博会专题" order by i.priority asc,n.created_at desc limit 3'); ?>
						<div class=r_b_r_title>　高清转播系统</div>
						<div class=content>
							<div class=context>
								<a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>"><img border=0 width=81 height=56 src="<?php echo $news[0]->photo_src; ?>"></a><br>
								<div class=cl style="margin-top:5px;"><a target="_blank" href="/news/news/news.php?id=<?php echo $news[0]->id; ?>">·<?php echo delhtml($news[0]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[1]->id; ?>">·<?php echo delhtml($news[1]->short_title); ?></a></div>
								<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $news[2]->id; ?>">·<?php echo delhtml($news[2]->short_title); ?></a></div>
							</div>		
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</body>
</html>
<script>
$(function(){
	$(".video").click(function()
	{
		total("视频新闻","news");	
		$(".video").css('background','url(/images/icon/arrow1.gif) no-repeat 0 3px');
		$(".video").css('color','#000000');
		$(".video").css('font-weight','normal');		
		$(this).css('background','url(/images/icon/arrow2.gif) no-repeat 0 3px');
		$(this).css('color','#2C345B');		
		$(this).css('font-weight','bold');	
		video_src($(this).attr('param1'),$(this).attr('param2'));

	})
	
	$('#item1').click(function(){
		window.location.href="http://172.27.203.81:8080/show/list.php?id=24&type=news"
	});
	
	
});




function video_src(photo,video)
{
	$("#video_src").attr('src','index_video.php?photo='+photo+'&video='+video);
}	
</script>