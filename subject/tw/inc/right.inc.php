<div id="right">
 <div id="r_new">
 					<div id="new_title">最新发布</div>
 					<?php $newnews = $db->query('select n.photo_src,n.id,n.short_title,n.news_type,n.file_name,n.category_id as cid from smg_subject_items i left join smg_news n on i.resource_id=n.id left join smg_subject_category c on c.id=i.category_id left join smg_subject s on c.subject_id=s.id where s.id=33 and i.category_type="news" and i.is_adopt=1 order by i.priority asc, n.created_at desc limit 5');?>
 					<div id="new_content">
 							<DIV class="new_d"></div>
 							<div class="new_con"><a target="_blank" href="news.php?id=<?php echo $newnews[0]->id; ?>"><?php echo $newnews[0]->short_title; ?></a></div>	
 					</div>
 					<?php for($i=1; $i<5; $i++){ ?>
	 					<div class="new_c">
	 							<DIV class="new_d"></div>
	 							<div class="new_con"><a target="_blank" href="news.php?id=<?php echo $newnews[$i]->id; ?>"><?php echo $newnews[$i]->short_title; ?></a></div>	
	 					</div>
 					<?php }?>
 	</div>				 					
 	<div id="day">
 								<div id="day_title">今日值班</div>
 								<div class="day_content">
 									<marquee width=100% height=100% DIRECTION="up" scrollamount="2" onmouseover=this.stop() onmouseout=this.start()>
 										<?php $day=$db->query('select id,content from smg_news where id=46862');?>
 										<a target="_blank" href="../news.php?id=<?php echo $day[0]->id; ?>"><?php echo get_fck_content($day[0]->content);?></a>
 									</marquee>
 								</div>
 	</div>
 	<div id="ministry">
 							<div id="m_title">服务信息</div>
 							<div id="m_a">
 										<div id="m_imga"></div>
 										<div class="ma"><a target="_blank" href="">志愿者知识</a></div>
 							</div>
 							<div class="m_div">
 										<div id="m_img"></div>
 										<div class="ma"><a target="_blank" href="">活动信息共享</a></div>
 							</div>
 							<div class="m_div">
 										<div id="m_img2"></div>
 										<div class="ma"><a target="_blank" href="">下载区</a></div>
 							</div>	
 	</div>
 	<DIV ID="z_title">
 			<div id="zz_title">志愿者心声</div>
 			<div id="zz_div">
 				<?php for($i=0;$i<4;$i++){ ?>
 					<div class="zz_content">
 								<div class="zz_name">撒旦发:</div>撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发
 					</div>
 				<?php }?>						 				
 			</div>
 	</DIV>
 </div>