<div id=logo></div>
<?php
$deptsort = $db->query('SELECT sum(s.click_count) as djl,d.name FROM smg_subject_items i inner join smg_subject sb on i.subject_id=sb.id and sb.name="学习实践活动专题" inner join smg_news s on i.resource_id=s.id inner join smg_dept d on s.dept_id=d.id  group by s.dept_id order by djl desc limit 10');
$xxjb = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id=cid from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="学习实践活动专题" and i.category_type="news" and i.is_adopt=1 and c.name="信息简报" order by i.priority asc, n.created_at desc limit 7');
$zxdt = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id=cid from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="学习实践活动专题" and i.category_type="news" and i.is_adopt=1 and c.name="最新动态" order by i.priority asc, n.created_at desc limit 6');
$ldjh = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id=cid from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="学习实践活动专题" and i.category_type="news" and i.is_adopt=1 and c.name="领导讲话" order by i.priority asc, n.created_at desc limit 6');
$bzap = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id=cid from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="学习实践活动专题" and i.category_type="news" and i.is_adopt=1 and c.name="步骤安排" order by i.priority asc, n.created_at desc limit 6');
$wjzb = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id=cid from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="学习实践活动专题" and i.category_type="news" and i.is_adopt=1 and c.name="文件摘编" order by i.priority asc, n.created_at desc limit 6');
$jyjs = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id=cid from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="学习实践活动专题" and i.category_type="news" and i.is_adopt=1 and c.name="经验介绍" order by i.priority asc, n.created_at desc limit 6');
$xxzl = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,c.id=cid from smg_news n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="学习实践活动专题" and i.category_type="news" and i.is_adopt=1 and c.name="学习资料" order by i.priority asc, n.created_at desc limit 6');
?>

		<div id=title><div class="cl"><a target="_blank" href="index.php">首页</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $ldjh[0]->cid; ?>">领导讲话</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $xxzl[0]->cid;?>">学习资料</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php $bzap[0]->cid ?>">步骤安排</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $zxdt[0]->cid;?>">最新动态</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $xxjb[0]->cid;?>">信息简报</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php $wjzb[0]->cid; ?>">文件摘编</a></div><div class="cl"><a target="_blank" href="djlist2.php">我为集团献一计</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $jyjs[0]->cid;?>">经验介绍</a></div><div class="cl"><a target="_blank" href="/sxjy/">三项学习教育</a></div></div>
		<div style="width:1002px; background:#F9B628;">
			<div id=content>
				<div id=context>
					<div id=left>
						<div id=content>
							<div class=title>最新动态</div>	
								<? 								
								for($i=0;$i<count($zxdt);$i++){
									if($zxdt[$i]->news_type==3)//url链接类新闻
								  {
								  	redirect($zxdt[$i]->target_url);
								  	CloseDB();
								  	exit;
								  }
								  //文件新闻
								  if($zxdt[$i]->news_type==2)
								  {
								  	//echo $news->newstpe;
								   	redirect($zxdt[$i]->file_name);
								  	CloseDB();
								  	exit; 	
								  }
								?>
									
								<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="djcontent.php?id=<? echo $zxdt[$i]->id;?>"><? echo $zxdt[$i]->short_title;?></a></div>
								<? if($i<2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
							
							<div class=tp>
								<div class=pic>
									<a target="_blank" target="_blank" href="djcontent.php?id=<? echo $news[0]->id;?>">
										<img border=0 width=90 height=70 src="<? if($news[0]->photourl!=""){echo $news[0]->photourl;}else {echo '/images/logo.jpg';}?>">
									</a>
								</div>
								<div class=pic>
									<a target="_blank" target="_blank" href="djcontent.php?id=<? echo $news[1]->id;?>">
										<img border=0 width=90 height=70 src="<? if($news[1]->photourl!=""){echo $news[1]->photourl;}else {echo '/images/logo.jpg';}?>">
									</a>
								</div>
							</div>
							<div class=more><a target="_blank" href="djlist.php?id=<?php $zxdt[0]->cid;?>">更多>></a></div>
							<div class=title>活动视频</div>
								<? 
								$video = $db->query('select n.id,n.title,n.photo_url,n.video_url,c.id=cid from smg_video n left join smg_subject_items i on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="活动视频" and i.category_type="news" and i.is_adopt=1 and c.name="学习实践活动专题" order by i.priority asc, n.created_at desc limit 3');?>
								<div style="width:200px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><? show_video_player(200,230,$video[0]->photo_url,$video[0]->video_url);?></div>
									<? 	
								for($i=1;$i<count($video);$i++){?>
								<div style="width:200px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="/show/video.php?id=<? echo $video[$i]->id;?>"><? echo $video[$i]->title;?></a></div>
								<? }?>			
							<div class=more><a target="_blank" href="/video/videolist2.php?id=14">更多>></a></div>
							<div class=title>三项学习教育</div>
							<a href="/subjec/sxxx/"><img border=0 style="margin-left:10px; margin-top:5px;" width="205" height="58" src="images/sxxx.jpg"></a>
							<div class=title>信息简报</div>						
								<? 
									for($i=0;$i<count($xxjb);$i++){
									if($xxjb[$i]->news_type==3)//url链接类新闻
								  {
								  	redirect($xxjb[$i]->target_url);
								  	CloseDB();
								  	exit;
								  }
								  //文件新闻
								  if($xxjb[$i]->news_type==2)
								  {
								  	//echo $news->newstpe;
								   	redirect($xxjb[$i]->file_name);
								  	CloseDB();
								  	exit; 	
								  }			
								?>
								<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><a target="_blank" href="djcontent.php?id=<? echo $xxjb[$i]->id;?>"><? echo $xxjb[$i]->short_title;?></a></div>
								<? if($i<2){?><div style="width:29px; height:15px; float:left; display:inline;"><img border=0 src="/images/pic/new.gif"></div><? }?>
								<? }?>
								<div class=more><a target="_blank" href="djlist.php?id=<?php echo $xxjb[0]->cid;?>">更多>></a></div>
							<div class=title>专题访问排行榜</div>	
								<? 
								for($i=0;$i<count($deptsort);$i++){?>
								<div style="width:150px; height:15px; line-height:15px; margin-top:10px; margin-left:10px; <? if($i<3){?>color:red; font-weight:bold;<? }?> overflow:hidden; float:left; display:inline"><? echo $deptsort[$i]->name;?></div><div style="width:50px; margin-top:10px; margin-right:10px; text-align:right; <? if($i<3){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $deptsort[$i]->djl;?></div>
								<? }?>
							
							<div id=lxfs>
								SMG学习实践活动办公室<br>
								地址：威海路298号上视大厦副楼18楼<br>
								传真：<span style="color:#EB6100; font-weight:bold;">62561664</span>　邮编：200041<br>
								电子邮箱：kxfzg@smg.sh.cn
							</div>
						</div>
					</div>