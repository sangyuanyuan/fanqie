<div id=logo><embed src="sxxx.swf" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="1000" height="150"></embed></div>
<?php
$deptsort = $db->query('SELECT sum(s.click_count) as djl,d.name FROM smg_subject_items i inner join smg_subject sb on i.subject_id=sb.id and sb.name="三项学习教育专题" inner join smg_news s on i.resource_id=s.id inner join smg_dept d on s.dept_id=d.id  group by s.dept_id order by djl desc limit 8');
$xxjb = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="信息简报" order by i.priority asc, n.created_at desc limit 7');
$zxdt = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="最新动态" order by i.priority asc, n.created_at desc');
$jdls = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="经典论述" order by i.priority asc, n.created_at desc limit 6');
$ldjh = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="领导讲话" order by i.priority asc, n.created_at desc limit 6');
$xxxd = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="学习心得" order by i.priority asc, n.created_at desc');
$ztjz = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="专题讲座" order by i.priority asc, n.created_at desc limit 6');
$gzzd = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="规章制度" order by i.priority asc, n.created_at desc limit 6');
$alfx = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="案例警示" order by i.priority asc, n.created_at desc limit 6');
$mtpl = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.target_url,n.file_name,i.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="news" and i.is_adopt=1 and c.name="媒体评论" order by i.priority asc, n.created_at desc limit 6');
?>		
		<div id=title><div class="cl"><a target="_blank" href="index.php">首页</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $jdls[0]->cid; ?>">经典论述</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $zxdt[0]->cid; ?>">最新动态</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $ldjh[0]->cid; ?>">领导讲话</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $xxxd[0]->cid; ?>">学习心得</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $xxjb[0]->cid;?>">信息简报</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $ztjz[0]->cid;?>">专题讲座</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $alfx[0]->cid; ?>">案例警示</a></div><div class="cl"><a target="_blank" href="djlist.php?id=<?php echo $mtpl[0]->cid; ?>">媒体评论</a></div><div class="cl"><a target="_blank" href="/djnews/djnews.php">学实活动</a></div></div>
		<div style="width:1002px; background:#F9B628;">
			<div id=content>
				<div id=context>
					<div id=left>
						<a target="_blank" href="sxxx_blog.php"><img style="margin-top:5px; margin-left:1px;" border=0 src="images/hdsq-1.jpg"></a>
						<div style="margin-right:10px; font-size:14px; font-weight:bold; float:right; display:inline;"><a target="_blank" href="kbsm.doc">开博说明</a>　<a target="_blank" href="/login/login.php">我要开博</a></div>
						<div id=content>
							<a style="margin-top:10px; float:left; display:inline;" target="_blank" href="/show/vote.php"><img width=225 border=0 src="hero.jpg"></a>
							<a style="margin-top:10px; float:left; display:inline;" target="_blank" href="/newscentersxxx/"><img width=225 border=0 src="newscentersxxx.jpg"></a>
							<div class=title><a href="/subject/djnews/">学实活动</a></div>
							<div class=title>活动视频</div>
							
								<? 
								$video = $db->query('select n.id,n.title,n.photo_url,n.video_url,i.category_id as cid from smg_subject_items i left join smg_video n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.name="三项学习教育专题" and i.category_type="video" and i.is_adopt=1 and c.name="三项学习教育活动视频" order by i.priority asc, n.created_at desc limit 3');?>
								<div style="width:200px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><? show_video_player(200,230,$video[0]->photo_url,$video[0]->video_url);?></div>
									<? 	
								for($i=1;$i<count($video);$i++){?>
								<div style="width:200px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline"><img width=5 height=5 src="/images/icon/blacksqu.jpg">　<a target="_blank" href="/show/video.php?id=<? echo $video[$i]->id;?>"><? echo $video[$i]->title;?></a></div>
								<? }?>			
							<div class=more><a target="_blank" href="video_list.php?id=<?php echo $video[0]->cid ?>">更多>></a></div>
							
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
							<div class=title>点击新闻访问排行榜</div>	
								<? 
								for($i=0;$i<count($deptsort);$i++){?>
								<div style="width:150px; height:15px; line-height:15px; margin-top:10px; margin-left:10px; <? if($i<3){?>color:red; font-weight:bold;<? }?> overflow:hidden; float:left; display:inline"><? echo $deptsort[$i]->name;?></div><div style="width:50px; margin-top:10px; margin-right:10px; text-align:right; <? if($i<3){?>color:red; font-weight:bold;<? }?> float:left; display:inline;"><? echo $deptsort[$i]->djl;?></div>
								<? }?>
							
							<div id=lxfs>
								SMG三项学习教育办公室秘书处<br>
								地址：威海路298号上视大厦副楼18楼<br>
								分机：<span style="color:#EB6100; font-weight:bold;">5271</span>　邮编：200041<br>
								
							</div>
							<div class=title>相关链接</div>
							<a style="margin-top:10px; float:left; display:inline;" target="_blank" href="http://www.xinhuanet.com/zgjx/"><img width=225 border=0 src="zgjxsxjy.jpg"></a>
						</div>
					</div>