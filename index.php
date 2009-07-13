<?php
	require_once('frame.php');
	$db = get_db();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-首页</title>
	<? 	
		css_include_tag('index','top','bottom');
		use_jquery();
	  js_include_once_tag('index');
  ?>
	
</head>

<body>
<? require_once('inc/top.inc.html');?>
<div id=ibody>
 <div id=ibody_top>
 		<div id=p1>
 			<!-- start top_left_top !-->
 			<?php
				$sql = 'select n.short_title,n.photo_src from smg_news n left join smg_category c on n.category_id=c.id where c.name="每日之星" and c.category_type="news" order by n.priority asc limit 4';
				$record_star=$db -> query($sql);
				$sql = 'select n.short_title,n.video_photo_src,n.video_src from smg_news n left join smg_category c on n.category_id=c.id where c.name="视频新闻" and c.category_type="news" order by n.priority asc limit 4';
				$record_video=$db -> query($sql);
				$sql = 'select i.title,i.src from smg_images i left join smg_category c on i.category_id=c.id where c.name="番茄广告" and c.category_type="picture" order by i.priority asc limit 4';
				$record_ad=$db -> query($sql);
  		?>
 			<div id=t_l_t>
 				<div id=menu>
 					<div class=item id=item1 param="1" style="background:url(/images/index/btn2.jpg);color:#9f9f9f;">每日之星</div>
  				<div class=item id=item2 param="2" style="background:url(/images/index/btn1.jpg)">视频新闻</div>
 					<div class=item id=item3 param="3" style="background:url(/images/index/btn2.jpg);color:#9f9f9f;">番茄广告</div>
				</div>	
  			<div class=content_tlt id=content1>
  				
  				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
					<div id="focus_01"></div> 
					<script type="text/javascript"> 
					var pic_width1=271; //图片宽度
					var pic_height1=183; //图片高度
					var pics1="<?php echo $record_star[0]->photo_src.",".$record_star[1]->photo_src.",".$record_star[2]->photo_src.",".$record_star[3]->photo_src ?>";
					var mylinks1="/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php";
					var texts1="<?php echo $record_star[0]->short_title.",".$record_star[1]->short_title.",".$record_star[2]->short_title.",".$record_star[3]->short_title ?>";
 	
					var picflash = new sohuFlash("/flash/focus.swf", "focus_01", "271", "183", "4","#FFFFFF");
					picflash.addParam('wmode','opaque');
					picflash.addVariable("picurl",pics1);
					picflash.addVariable("piclink",mylinks1);
					picflash.addVariable("pictext",texts1);				
					picflash.addVariable("pictime","5");
					picflash.addVariable("borderwidth","271");
					picflash.addVariable("borderheight","183");
					picflash.addVariable("borderw","false");
					picflash.addVariable("buttondisplay","true");
					picflash.addVariable("textheight","15");				
					picflash.addVariable("pic_width",pic_width1);
					picflash.addVariable("pic_height",pic_height1);
					picflash.write("focus_01");				
					</script>  				
  		  </div>
 				<div class=content_tlt id=content2 style="background:url(/images/index/bg_flash.jpg);display:inline;">
 					<iframe id=video_src src="index_video.php?photo=<?php echo $record_video[0]->video_photo_src ?>&video=<?php echo $record_video[0]->video_src ?>" width=225px height=182px scrolling="no" frameborder="0"></iframe>
 				</div>
  			<div class=content_tlt id=content3>
					<div id="focus_02"></div> 
 					<script type="text/javascript"> 
					var pic_width1=271; 
					var pic_height1=183; 
					var pics1="<?php echo $record_ad[0]->src.",".$record_ad[1]->src.",".$record_ad[2]->src.",".$record_ad[3]->src ?>";
					var mylinks1="/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php";
					var texts1="<?php echo $record_ad[0]->title.",".$record_ad[1]->title.",".$record_ad[2]->title.",".$record_ad[3]->title ?>";
 	
					var picflash = new sohuFlash("/flash/focus.swf", "focus_02", "271", "183", "4","#FFFFFF");
					picflash.addParam('wmode','opaque');
					picflash.addVariable("picurl",pics1);
					picflash.addVariable("piclink",mylinks1);
					picflash.addVariable("pictext",texts1);				
					picflash.addVariable("pictime","5");
					picflash.addVariable("borderwidth","271");
					picflash.addVariable("borderheight","183");
					picflash.addVariable("borderw","false");
					picflash.addVariable("buttondisplay","true");
					picflash.addVariable("textheight","15");				
					picflash.addVariable("pic_width",pic_width1);
					picflash.addVariable("pic_height",pic_height1);
					picflash.write("focus_02");				
					</script>   				
  			</div>
 				<div class=list id=list1>
 					<ul>
 						<?php for($i=0; $i<count($record_star); $i++){?>
 						<li><?php echo $record_star[$i]->short_title ?></li>
 						<? }?>
 					</ul>		
 				</div>  			 			
  			<div class=list id=list2  style="display:inline;">
 					<ul>
 						<li class=video style="color:#2C345B; font-weight:bold; background:url(/images/icon/arrow2.gif) no-repeat 0 3px" param1=<?php echo $record_video[0]->video_photo_src ?> param2=<?php echo $record_video[0]->video_src ?>><?php echo $record_video[0]->short_title ?></li>
 						<li class=video param1=<?php echo $record_video[1]->video_photo_src ?> param2=<?php echo $record_video[1]->video_src ?>><?php echo $record_video[1]->short_title ?></li>
 						<li class=video param1=<?php echo $record_video[2]->video_photo_src ?> param2=<?php echo $record_video[2]->video_src ?>><?php echo $record_video[2]->short_title ?></li>
 						<li class=video param1=<?php echo $record_video[3]->video_photo_src ?> param2=<?php echo $record_video[3]->video_src ?>><?php echo $record_video[3]->short_title ?></li>
 					</ul>	
 				</div>
 				<div class=list  id=list3>
 					<ul>
 						<?php for($i=0; $i<count($record_ad); $i++){?>
 						<li><?php echo $record_ad[$i]->title ?></li>
 						<? }?>
 					</ul>		
 				</div>
 			</div>
 			<!-- end !-->




 			<!-- start top_left_middle !-->
  		<?php
				$sql = 'select n.short_title from smg_news n left join smg_category c on n.category_id=c.id where c.name="专题新闻" and c.category_type="news" order by n.priority asc limit 10';
				$record_subject=$db -> query($sql);
				$sql = 'select n.short_title from smg_news n left join smg_category c on n.category_id=c.id where c.name="对外出击" and c.category_type="news" order by n.priority asc limit 10';
				$record_out=$db -> query($sql);
  		?>
  		<div id=t_l_m>
 				<div class=btn_tlm param=1 style="background:url(/images/index/btn3.jpg) no-repeat">专题新闻</div>
 				<div class=btn_tlm param=2 style="background:url(/images/index/btn4.jpg) no-repeat">对外出击</div>
 				<div class=list_tlm id=list_tlm1>
 					<ul>
 						<?php for($i=0; $i<count($record_subject); $i++){?>
 						<li><span style="color:#CCCCCC">·</span><?php echo $record_subject[$i]->name ?></li>
 						<? }?>
 				  </ul>
 				</div>
 				<div class=list_tlm id=list_tlm2  style="display:inline;">
 					<ul>
 						<?php for($i=0; $i<count($record_out); $i++){?>
 						<li><span style="color:#CCCCCC">·</span><?php echo $record_out[$i]->short_title ?></li>
 						<? }?>
 				  </ul>
 				</div>
 			</div>
 			<!-- end !-->


 			<!-- start top_left_bottom !-->
 			<?php
				$sql = 'select n.short_title from smg_news n where n.tags="小编加精"  order by n.last_edited_at desc limit 10';
				$record_marrow=$db -> query($sql);
				$sql = 'select n.short_title from smg_news n left join smg_category c on n.category_id=c.id where c.name="新闻速读" and c.category_type="news" order by n.priority asc limit 10';
				$record_quick=$db -> query($sql);
			?>
			<div id=t_l_b>
 				<div class=btn_tlb param=1 style="background:url(/images/index/btn4.jpg) no-repeat">小编加精</div>
 				<div class=btn_tlb param=2 style="background:url(/images/index/btn3.jpg) no-repeat">新闻速读</div>
 				<div class=list_tlb id=list_tlb1 style="display:inline;">
 					<ul>
 						<?php for($i=0; $i<count($record_marrow); $i++){?>
 						<li><span style="color:#CCCCCC">·</span><?php echo $record_marrow[$i]->short_title ?></li>
 						<? }?>
 				  </ul>
 				</div>
 				<div class=list_tlb id=list_tlb2>
 					<ul>
 						<?php for($i=0; $i<count($record_quick); $i++){?>
 						<li><span style="color:#CCCCCC">·</span><?php echo $record_quick[$i]->short_title ?></li>
 						<? }?>
 				  </ul>
 				</div>


 			</div>
 			<!-- end !-->

		</div>

		<div id=p2>
 			<!-- start top_right_top !-->
  		<?php
				$sql = 'select n.* from smg_news n left join smg_category c on n.category_id=c.id where c.name="大头条" and c.category_type="news" order by n.priority asc limit 1';
				$record_head=$db -> query($sql);
			?>
			<div id=t_r_t>
 				<div id=title><?php echo $record_head[0]->short_title ?></div>
 				<a href="" id=btn></a>
 				<div id=content>
 				<?php
 					if($record_head[0]->sub_headline==1)
 					{ 
 							echo $record_head[0]->description; 
 					}
 					else
 					{
 							$sub_news_str=explode(",",$record_head[0]->sub_news_id); 
				  		$sub_news_str_num=sizeof($sub_news_str)-1;

							for($i=0;$i<=$sub_news_str_num;$i++)
							{
									$sql="select * from smg_news where id=".$sub_news_str[$i];
									$record_sub_news = $db -> query($sql);
									echo "[<a href=''>".$record_sub_news[0]->short_title."</a>]";
							}		

					}	
				?>
 				</div>

 			</div>
 			<!-- end !-->
		</div>

		<div id=p3>
 			<!-- start top_right_center_top !-->
 			<div id=t_r_c_t>
 				<?php
					$sql = 'select n.* from smg_news n left join smg_category c on n.category_id=c.id where c.name="小头条" and c.category_type="news" and n.priority=1 ';
					$record_head=$db -> query($sql);
				?>
				<div class=title><?php echo $record_head[0]->short_title ?></div>
				<div class=content>
 				<?php
 					if($record_head[0]->sub_headline==1)
 					{ 
 							echo $record_head[0]->description; 
 					}
 					else
 					{
 							$sub_news_str=explode(",",$record_head[0]->sub_news_id); 
				  		$sub_news_str_num=sizeof($sub_news_str)-1;

							for($i=0;$i<=$sub_news_str_num;$i++)
							{
									$sql="select * from smg_news where id=".$sub_news_str[$i];
									$record_sub_news = $db -> query($sql);
									echo "[<a href=''>".$record_sub_news[0]->short_title."</a>]";
							}		

					}	
				?>					
				</div>
 				<?php
					$sql = 'select n.* from smg_news n left join smg_category c on n.category_id=c.id where c.name="小头条" and c.category_type="news" and n.priority=2 ';
					$record_head=$db -> query($sql);
				?>
				<div class=title><?php echo $record_head[0]->short_title ?></div>
				<div class=content>
 				<?php
 					if($record_head[0]->sub_headline==1)
 					{ 
 							echo $record_head[0]->description; 
 					}
 					else
 					{
 							$sub_news_str=explode(",",$record_head[0]->sub_news_id); 
				  		$sub_news_str_num=sizeof($sub_news_str)-1;
						
							for($i=0;$i<=$sub_news_str_num;$i++)
							{
									$sql="select * from smg_news where id=".$sub_news_str[$i];
									$record_sub_news = $db -> query($sql);
									echo "[<a href=''>".$record_sub_news[0]->short_title."</a>]";
							}		

					}	
				?>						
				</div>
 			</div>
 			<!-- end !-->
			
 			<!-- start top_right_center_middle !-->
 			<div id=t_r_c_m>
 				<div id=title></div>
  			<?php
					$sql = 'select n.short_title from smg_news n left join smg_category c on n.category_id=c.id where c.name="重点关注-头" and c.category_type="news" order by n.priority asc limit 1 ';
					$record_import=$db -> query($sql);
				?>				
				<div id=content1><?php echo $record_import[0]->short_title; ?></div>
 				<a href="" id=btn ></a>
 				<?php
					$sql = 'select n.short_title from smg_news n left join smg_category c on n.category_id=c.id where c.name="重点关注-普" and c.category_type="news" order by n.priority asc limit 41';
					$record_import_a=$db -> query($sql);
					$sql = 'select n.photo_src from smg_news n left join smg_category c on n.category_id=c.id where c.name="重点关注-图" and c.category_type="news" order by n.priority asc limit 6';
					$record_import_b=$db -> query($sql);
				?>	
 				<div id=box>
 					<div id=l>
 						<ul>
 						 <?php for($i=0; $i<6; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>
 						<div class=space></div>
  					<ul>
 						 <?php for($i=6; $i<9; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>
 						<div class=space></div>
  					<ul>
 						 <?php for($i=9; $i<12; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>
 						<div class=space></div>
						<img src="<?php echo $record_import_b[0]->photo_src ?>" >
 						<img src="<?php echo $record_import_b[0]->photo_src ?>" >
  					<ul>
 						 <?php for($i=12; $i<14; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>						
 					</div>	
 					
 					<div id=c>
   					<ul>
 						 <?php for($i=14; $i<20; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>								
 						<div class=space></div>
						<img src="<?php echo $record_import_b[0]->photo_src ?>" >
 						<img src="<?php echo $record_import_b[0]->photo_src ?>" >
 						<div class=space></div>
   					<ul>
 						 <?php for($i=20; $i<23; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>			
 						<div class=space></div>
   					<ul>
 						 <?php for($i=23; $i<28; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>	
 					</div>	 
 					
 					<div id=r>
						<img src="<?php echo $record_import_b[0]->photo_src ?>" >
 						<img src="<?php echo $record_import_b[0]->photo_src ?>" >
    				<ul>
 						 <?php for($i=28; $i<31; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>	 						
 						<div class=space></div>
     				<ul>
 						 <?php for($i=31; $i<34; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>	 						
 						<div class=space></div>
      			<ul>
 						 <?php for($i=34; $i<37; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>	 						
 						<div class=space></div>												
      			<ul>
 						 <?php for($i=37; $i<42; $i++){?>
 							<li><a href=""><?php echo $record_import_a[$i]->short_title ?></a></li>
             <? }?>
 						</ul>	
 					</div>	 				
 				
 				</div>
 			</div>
 			<!-- end !-->
		

 			<!-- start top_right_center_bottom_left !-->
 			<div id=t_r_c_b_l>
 				<iframe src="a.html" frameborder=0 scrolling="no" ></iframe>
 			</div>
 			<!-- end !-->


 			<!-- start top_right_center_bottom_right !-->
  		<?php
				$sql = 'select n.photo_src from smg_news n left join smg_category c on n.category_id=c.id where c.name="业界动态-图" and c.category_type="news" order by n.priority asc limit 1';
				$record_industry=$db -> query($sql);
				$sql = 'select n.short_title from smg_news n left join smg_category c on n.category_id=c.id where c.name="业界动态-普" and c.category_type="news" order by n.priority asc limit 7';
				$record_industry2=$db -> query($sql);		
			?>
			<div id=t_r_c_b_r>
					<div id=title></div>
					<a href="" id=more></a>
					<div id=box1>
						<img src="<?php echo $record_industry[0]->photo_src ?>" >
						<ul>
							<li><?php echo $record_industry2[0]->short_title ?></li>
							<li><?php echo $record_industry2[1]->short_title ?></li>
							<li><?php echo $record_industry2[2]->short_title ?></li>
						</ul>	
					</div>	
					<div id=box2>
						<ul>
							<li>·<?php echo $record_industry2[3]->short_title ?></li>
							<li>·<?php echo $record_industry2[4]->short_title ?></li>
							<li>·<?php echo $record_industry2[5]->short_title ?></li>
							<li>·<?php echo $record_industry2[6]->short_title ?></li>
						</ul>						
					</div>
 			</div>
 			<!-- end !-->
		
		</div>
		
		<div id=p4>
 			<!-- start top_right_right_top !-->
 			<div id=t_r_r_t>
 				<div class=menu_trrt id=menu_trrt1 param=1 style="background:url(/images/index/btn7.jpg) no-repeat; font-weight:bold;">我要团购</div>
 				<div class=menu_trrt id=menu_trrt2 param=2 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:6px;">快乐番茄</div>
 				<div class=menu_trrt id=menu_trrt3 param=3 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:5px;">讨论区</div>
 				<div class=content_trrt id=content_trrt1 style="display:inline;">
					<div class=box>
						<img src="/images/5.jpg">
						<ul>
							<li>运动女孩装</li>
							<li>运动女孩装</li>
							<li style="line-height:25px; color:#A1A0A0">市场价：100</li>
							<li style="color:#BD0A01">番茄价：50</li>
						</ul>
					</div>
					<div class=box>
						<img src="/images/5.jpg">
						<ul>
							<li>运动女孩装</li>
							<li>运动女孩装</li>
							<li style="line-height:25px; color:#A1A0A0">市场价：100</li>
							<li style="color:#BD0A01">番茄价：50</li>
						</ul>
					</div>
					<div class=box>
						<img src="/images/5.jpg">
						<ul>
							<li>运动女孩装</li>
							<li>运动女孩装</li>
							<li style="line-height:25px; color:#A1A0A0">市场价：100</li>
							<li style="color:#BD0A01">番茄价：50</li>
						</ul>
					</div> 					
 				</div>
 				<?php
 					$sql = 'select n.short_title from smg_news n left join smg_category c on n.category_id=c.id where c.name="快乐番茄" and c.category_type="news" order by n.priority asc limit 12';
					$record_happy=$db -> query($sql);		
				?>	
 				<div class=content_trrt id=content_trrt2>
 					<div class=box>
						<ul>
							<?php for($i=0;$i<4;$i++){?>
							<li>·<?php echo $record_happy[$i]->short_title ?></li>
							<? }?>
						</ul>
					</div>
					<div class=box>
						<ul>
							<?php for($i=4;$i<8;$i++){?>
							<li>·<?php echo $record_happy[$i]->short_title ?></li>
							<? }?>
						</ul>
					</div>
					<div class=box>
						<ul>
							<?php for($i=8;$i<12;$i++){?>
							<li>·<?php echo $record_happy[$i]->short_title ?></li>
							<? }?>
						</ul>
					</div> 				
 				</div>
 				<?php
 					$sql = 'select n.short_title from smg_news n left join smg_category c on n.category_id=c.id where c.name="讨论区" and c.category_type="news" order by n.priority asc limit 12';
					$record_discuss=$db -> query($sql);		
				?>	
 				<div class=content_trrt id=content_trrt3>
 					<div class=box>
						<ul>
							<?php for($i=0;$i<4;$i++){?>
							<li>·<?php echo $record_discuss[$i]->short_title ?></li>
							<? }?>
						</ul>
					</div>
					<div class=box>
						<ul>
							<?php for($i=4;$i<8;$i++){?>
							<li>·<?php echo $record_discuss[$i]->short_title ?></li>
							<? }?>
						</ul>
					</div>
					<div class=box>
						<ul>
							<?php for($i=8;$i<12;$i++){?>
							<li>·<?php echo $record_discuss[$i]->short_title ?></li>
							<? }?>
						</ul>
					</div> 	 				
 				</div>
 				
 				
 			</div>
 			<!-- end !-->			
			
 			<!-- start top_right_right_middle !-->
 			<?php
 					$sql = 'select n.short_title from smg_news n left join smg_category c on n.category_id=c.id where c.name="我要报料" and c.category_type="news" order by n.priority asc limit 12';
					$record_baoliao=$db -> query($sql);		
			?>	 		
			<div id=t_r_r_m>
 				<a href="" id=btn></a>
				<div id=content_trrm>
					<?php for($i=0;$i<12;$i++){?>.<a href=""><?php echo $record_baoliao[$i]->short_title ?></a> <? }?>				
					</div>
 			</div>
 			<!-- end !-->						

 			<!-- start top_right_right_bottom !-->
 			<?php
 					$sql = 'select n.short_title from smg_news n  where TO_DAYS(NOW()) - TO_DAYS(n.last_edited_at) <= 7 order by n.click_count desc limit 10';
					$record_news=$db -> query($sql);		
			?>	 
 			<div id=t_r_r_b>
 				<div class=menu_trrb id=menu_trrb1 param=1 style="background:url(/images/index/btn7.jpg) no-repeat; margin-left:9px; font-weight:bold;">新闻排行</div>
 				<div class=menu_trrb id=menu_trrb2 param=2 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:6px;">博客排行</div>
 				<div class=menu_trrb id=menu_trrb3 param=3 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:5px;">论坛排行</div>
				<div id=number>
					<?php for($i=1;$i<=10;$i++){?>
					<img src="/images/number/<?php echo $i?>.jpg">
					<? }?>
				</div>
				<div class=content_trrb id=content_trrb1 style="display:inline">
					<ul>
					<?php for($i=0;$i<10;$i++){?>
						<li><a href=""   <?php if($i<=2){?>  style="color:#E52520" <?php }?> ><?php echo $record_news[$i]->short_title; ?></a></li>
					<? }?>	
					</ul>
				</div>
				<div class=content_trrb id=content_trrb2>
					<ul>
					<?php for($i=0;$i<10;$i++){?>
						<li><a href=""   <?php if($i<=2){?>  style="color:#E52520" <?php }?> >123</a></li>
					<? }?>	
					</ul>
				</div>
				<div class=content_trrb id=content_trrb3>
					<ul>
					<?php for($i=0;$i<10;$i++){?>
						<li><a href=""   <?php if($i<=2){?>  style="color:#E52520" <?php }?> >456</a></li>
					<? }?>	
					</ul>
				</div>

 			</div>
 			<!-- end !-->				
		</div>
				
 </div>
 <div id=ibody_line></div>
 <div id=ibody_middle>
    <div id=p1>
  		<!-- start middle_left_top !-->
 			<div id=m_l_t>

 			</div>
 			<!-- end !-->	   	
    
  		<!-- start middle_left_bottom !-->
 			<div id=m_l_b>

 			</div>
 			<!-- end !-->	     
    
    </div> 	
 	
    <div id=p2>
    	
  		<!-- start middle_center_top !-->
 			<div id=m_c_t>

 			</div>
 			<!-- end !-->	      	
    	
  		<!-- start middle_center_top !-->
 			<div id=m_c_b>

 			</div>
 			<!-- end !-->	      	
    	    
    </div> 	
    <div id=p3>
      <!-- start middle_right_top !-->
 			<div id=m_r_t>

 			</div>
 			<!-- end !-->		
    	
      <!-- start middle_right_bottom !-->
 			<div id=m_r_b>

 			</div>
 			<!-- end !-->	    
    </div> 	
 </div>
 <div id=ibody_bottom>
    <div id=p1>
      <!-- start bottom_top_left !-->
 			<div id=b_t_l>

 			</div>
 			<!-- end !-->	      	
 
      <!-- start bottom_top_right !-->
 			<div id=b_t_r>

 			</div>
 			<!-- end !-->	 
    	
    </div>
    <div id=p2>
      <!-- start bottom_bottom_left !-->
 			<div id=b_b_l>

 			</div>
 			<!-- end !-->	     	
    	
      <!-- start bottom_bottom_center !-->
 			<div id=b_b_c>

 			</div>
 			<!-- end !-->	     	
    
      <!-- start bottom_bottom_right !-->
 			<div id=b_b_r>

 			</div>
 			<!-- end !-->	 

    </div>
 </div> 
 
 
</div>
<? require_once('inc/bottom.inc.php');?>


</body>
</html>