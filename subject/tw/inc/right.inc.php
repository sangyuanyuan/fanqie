<div id="right">
 <div id="r_new">
 					<div id="new_title">最新发布</div>
 					
 					<div id="new_content">
 							<DIV class="new_d"></div>
 							<div class="new_con"><a target="_blank" href="">四大发生大幅啊事件发生负担阿桑哈哈哈</a></div>	
 					</div>
 					<?php for($i=1; $i<5; $i++){ ?>
 					<div class="new_c">
 							<DIV class="new_d"></div>
 							<div class="new_con"><a target="_blank" href="">四大发生大幅啊事件发生负担阿桑哈哈哈哈哈哈哈哈哈</a></div>	
 					</div>
 					<?php }?>
 	</div>				 					
 	<div id="day">
 								<div id="day_title">今日值班</div>
 								<div class="day_content">
 										<?php $day=$db->query('select id,content from smg_news where id=46862');?>
 										<a target="_blank" href="../news.php?id=<?php echo $day[0]->id; ?>"><?php echo get_fck_content($day[0]->content);?></a>
 								</div>
 	</div>
 	<div id="ministry">
 							<div id="m_title">服务信息</div>
 							<div id="m_a">
 										<div id="m_imga"></div>
 										<div class="ma">志愿者知识</div>
 							</div>
 							<div class="m_div">
 										<div id="m_img"></div>
 										<div class="ma">活动信息共享</div>
 							</div>
 							<div class="m_div">
 										<div id="m_img2"></div>
 										<div class="ma">下载区</div>
 							</div>	
 	</div>
 	<DIV ID="z_title">
 			<div id="zz_title">志愿者心声</div>
 			<div id="zz_div">	
 					<div class="zz_content">
 								<div class="zz_name">撒旦发:</div>撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发
 					</div>	
 					<div class="zz_content">
 								<div class="zz_name">撒旦发:</div>撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发
 					</div>	
 					<div class="zz_content">
 								<div class="zz_name">撒旦发:</div>撒射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发
 					</div>	
 					<div class="zz_content">
 								<div class="zz_name">撒旦发:</div>旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发撒旦发射点发
 					</div>						 				
 			</div>
 	</DIV>
 </div>