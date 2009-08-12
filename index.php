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
	  js_include_once_tag('index','total');
  ?>
	
</head>
<script>
total("首页","other");	
</script>
<body>
<? require_once('inc/top.inc.html');?>
<div id=ibody>
 <div id=ibody_top>
 		<div id=p1>
 			<!-- start top_left_top !-->
 			<?php
				$sql = 'select i.id as img_id,i.title,i.src,i.priority as ipriority from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="每日之星" and c.platform="show" order by i.priority asc,i.created_at desc limit 4';
				$record_star=$db -> query($sql);
				$sql = 'select n.short_title, c.platform,n.video_photo_src,n.video_src from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="视频新闻" and c.platform="news" order by n.priority asc,created_at desc limit 4';
				$record_video=$db -> query($sql);
				$sql = 'select i.id as img_id,i.title,i.src,i.priority as ipriority from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="番茄广告" and c.platform="show" order by i.priority asc,i.created_at desc limit 4';
				$record_ad=$db -> query($sql);
				$sql = 'select name from smg_image_show';
				$record_inline = $db->query($sql);
  		?>
 			<div id=t_l_t>
 				<div id=menu>
 					<div class=item id=item1 param="1" <?php if($record_inline[0]->name=='mrzx'){?>style="background:url(/images/index/btn1.jpg)"<?php }else{?>style="background:url(/images/index/btn2.jpg);color:#9f9f9f;"<?php }?>>每日之星</div>
  				<div class=item id=item2 param="2" <?php if($record_inline[0]->name=='spxw'){?>style="background:url(/images/index/btn1.jpg)"<?php }else{?>style="background:url(/images/index/btn2.jpg);color:#9f9f9f;"<?php }?>>视频新闻</div>
 					<div class=item id=item3 param="3" <?php if($record_inline[0]->name=='fqgg'){?>style="background:url(/images/index/btn1.jpg)"<?php }else{?>style="background:url(/images/index/btn2.jpg);color:#9f9f9f;"<?php }?>>番茄广告</div>
				</div>	
  			<div class=content_tlt id=content1 <?php if($record_inline[0]->name=='mrzx'){?>style="display:inline"<?php }?>>
				<?php if($record_star[1]->ipriority<>0){?>
					<a href="/show/show.php?id=<?php echo $record_star[0]->img_id?>" target=_blank><img src="<?php echo $record_star[0]->src?>" width=270px; height=180px; border=0></a>
				<? }else{?>
					<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
					<div id="focus_01"></div> 
					<script type="text/javascript"> 
					var pic_width1=256; //图片宽度
					var pic_height1=183; //图片高度
					
					<?php 
						$pics1=$record_star[0]->src;
						$mylinks1="/show/show.php?id=".$record_star[0]->img_id;
						$texts1=flash_str_replace($record_star[0]->title);
						if($record_star[1]->ipriority==0){$pics1=$pics1.",".$record_star[1]->src;$mylinks1=$mylinks1.","."/show/show.php?id=".$record_star[1]->img_id;$texts1=$texts1.",".flash_str_replace($record_star[1]->title);}
						if($record_star[2]->ipriority==0){$pics1=$pics1.",".$record_star[2]->src;$mylinks1=$mylinks1.","."/show/show.php?id=".$record_star[2]->img_id;$texts1=$texts1.",".flash_str_replace($record_star[2]->title);}
						if($record_star[3]->ipriority==0){$pics1=$pics1.",".$record_star[3]->src;$mylinks1=$mylinks1.","."/show/show.php?id=".$record_star[3]->img_id;$texts1=$texts1.",".flash_str_replace($record_star[3]->title);}
						
					?>
					var pics1=<?php echo '"',$pics1,'"'?>;
					var mylinks1=<?php echo '"',$mylinks1,'"'?>;
					var texts1=<?php echo '"',$texts1,'"'?>;			
					 	
					var picflash = new sohuFlash("/flash/focus.swf", "focus_01", "256", "183", "4","#FFFFFF");
					picflash.addParam('wmode','opaque');
					picflash.addVariable("picurl",pics1);
					picflash.addVariable("piclink",mylinks1);
					picflash.addVariable("pictext",texts1);				
					picflash.addVariable("pictime","5");
					picflash.addVariable("borderwidth","256");
					picflash.addVariable("borderheight","183");
					picflash.addVariable("borderw","false");
					picflash.addVariable("buttondisplay","true");
					picflash.addVariable("textheight","15");				
					picflash.addVariable("pic_width",pic_width1);
					picflash.addVariable("pic_height",pic_height1);
					picflash.write("focus_01");				
					</script>	
					
				<? }?>	
  		  </div>
 				<div class=content_tlt id=content2 style="background:url(/images/index/bg_flash.jpg) no-repeat;" <?php if($record_inline[0]->name=='spxw'){?>style="display:inline"<?php }?>>
 					<iframe id=video_src src="index_video.php?photo=<?php echo $record_video[0]->video_photo_src ?>&video=<?php echo $record_video[0]->video_src ?>" width=235px height=182px scrolling="no" frameborder="0"></iframe>
 				</div>
  			<div class=content_tlt id=content3 <?php if($record_inline[0]->name=='fqgg'){?>style="display:inline"<?php }?>>
				<?php if($record_ad[1]->ipriority<>0){?>
					<a href="/show/show.php?id=<?php echo $record_ad[0]->img_id?>" target=_blank><img src="<?php echo $record_ad[0]->src?>" width=270px; height=180px; border=0></a>
				<? }else{?>
					<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
					<div id="focus_02"></div> 
					<script type="text/javascript"> 
					var pic_width1=256; //图片宽度
					var pic_height1=183; //图片高度
					
					<?php 
						$pics1=$record_ad[0]->src;
						$mylinks1="/show/show.php?id=".$record_ad[0]->img_id;
						$texts1=flash_str_replace($record_ad[0]->title);
						if($record_ad[1]->ipriority==0){$pics1=$pics1.",".$record_ad[1]->src;$mylinks1=$mylinks1.","."/show/show.php?id=".$record_ad[1]->img_id;$texts1=$texts1.",".flash_str_replace($record_ad[1]->title);}
						if($record_ad[2]->ipriority==0){$pics1=$pics1.",".$record_ad[2]->src;$mylinks1=$mylinks1.","."/show/show.php?id=".$record_ad[2]->img_id;$texts1=$texts1.",".flash_str_replace($record_ad[2]->title);}
						if($record_ad[3]->ipriority==0){$pics1=$pics1.",".$record_ad[3]->src;$mylinks1=$mylinks1.","."/show/show.php?id=".$record_ad[3]->img_id;$texts1=$texts1.",".flash_str_replace($record_ad[3]->title);}
						
					?>
					var pics1=<?php echo '"',$pics1,'"'?>;
					var mylinks1=<?php echo '"',$mylinks1,'"'?>;
					var texts1=<?php echo '"',$texts1,'"'?>;			
								
					var picflash = new sohuFlash("/flash/focus.swf", "focus_02", "256", "183", "4","#FFFFFF");
					picflash.addParam('wmode','opaque');
					picflash.addVariable("picurl",pics1);
					picflash.addVariable("piclink",mylinks1);
					picflash.addVariable("pictext",texts1);				
					picflash.addVariable("pictime","5");
					picflash.addVariable("borderwidth","256");
					picflash.addVariable("borderheight","183");
					picflash.addVariable("borderw","false");
					picflash.addVariable("buttondisplay","true");
					picflash.addVariable("textheight","15");				
					picflash.addVariable("pic_width",pic_width1);
					picflash.addVariable("pic_height",pic_height1);
					picflash.write("focus_02");				
					</script>		
				<? }?>
  			</div>
 				<div class=list id=list1 <?php if($record_inline[0]->name=='mrzx'){?>style="display:inline"<?php }?>>
 					<ul>
 						<?php for($i=0; $i<count($record_star); $i++){?>
 						<li><a href="/show/show.php?id=<?php echo $record_star[$i]->img_id ?>" target=_blank><?php echo strip_tags($record_star[$i]->title) ?></a></li>
 						<? }?>
 					</ul>		
 				</div>  			 			
  			<div class=list id=list2  <?php if($record_inline[0]->name=='spxw'){?>style="display:inline"<?php }?>>
 					<ul>
 						<li class=video style="color:#2C345B; font-weight:bold; background:url(/images/icon/arrow2.gif) no-repeat 0 3px" param1=<?php echo $record_video[0]->video_photo_src ?> param2=<?php echo $record_video[0]->video_src ?>><?php echo $record_video[0]->short_title ?></li>
 						<li class=video param1=<?php echo $record_video[1]->video_photo_src ?> param2=<?php echo $record_video[1]->video_src ?>><?php echo $record_video[1]->short_title ?></li>
 						<li class=video param1=<?php echo $record_video[2]->video_photo_src ?> param2=<?php echo $record_video[2]->video_src ?>><?php echo $record_video[2]->short_title ?></li>
 						<li class=video param1=<?php echo $record_video[3]->video_photo_src ?> param2=<?php echo $record_video[3]->video_src ?>><?php echo $record_video[3]->short_title ?></li>
 					</ul>	
 				</div>
 				<div class=list id=list3 <?php if($record_inline[0]->name=='fqgg'){?>style="display:inline"<?php }?>>
 					<ul>
 						<?php for($i=0; $i<count($record_ad); $i++){?>
 						<li><a href="/show/show.php?id=<?php echo $record_ad[$i]->img_id ?>" target=_blank><?php echo strip_tags($record_ad[$i]->title) ?></a></li>
 						<? }?>
 					</ul>		
 				</div>
 			</div>
 			<!-- end !-->




 			<!-- start top_left_middle !-->
  		<?php
				$sql = 'select n.id,n.short_title,c.platform,c.id as cid  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="专题新闻" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 10';
				$record_subject=$db -> query($sql);
				$sql = 'select n.id,n.short_title,c.platform,c.id as cid  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="对外出击" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 10';
				$record_out=$db -> query($sql);
  		?>
  		<div id=t_l_m>
 				<div class=btn_tlm param=1 id=btn_tlm_1 style="background:url(/images/index/btn3.jpg) no-repeat"><a href="/news/news_list.php?id=<?php echo $record_subject[0]->cid?>" target=_blank>专题新闻</a></div>
 				<div class=btn_tlm param=2 id=btn_tlm_2 style="background:url(/images/index/btn4.jpg) no-repeat"><a href="/news/news_list.php?id=<?php echo $record_out[0]->cid?>" target=_blank>对外出击</a></div>
 				<div class=list_tlm id=list_tlm1 >
 					<ul>
 						<?php for($i=0; $i<count($record_subject); $i++){?>
 						<li><span style="color:#CCCCCC">·</span><a href="/<?php echo $record_subject[$i]->platform ?>/news/news.php?id=<?php echo $record_subject[$i]->id ?>" target=_blank><?php echo $record_subject[$i]->short_title ?></a></li>
 						<? }?>
 				  </ul>
 				</div>
 				<div class=list_tlm id=list_tlm2 style="display:inline;">
 					<ul>
 						<?php for($i=0; $i<count($record_out); $i++){?>
 						<li><span style="color:#CCCCCC">·</span><a href="/<?php echo $record_out[$i]->platform ?>/news/news.php?id=<?php echo $record_out[$i]->id ?>" target=_blank><?php echo $record_out[$i]->short_title ?></a></li>
 						<? }?>
 				  </ul>
 				</div>
 			</div>
 			<!-- end !-->


 			<!-- start top_left_bottom !-->
 			<?php
				$sql = 'select n.id,n.short_title,n.title,c.platform,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.tags="小编加精"   and is_recommend=1 order by n.priority asc,n.created_at desc limit 10';
				$record_marrow=$db -> query($sql);
				$sql = 'select n.id,n.short_title,c.platform,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="新闻速读" and c.platform="server"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 10';
				$record_quick=$db -> query($sql);
			?>
			<div id=t_l_b>
 				<div class=btn_tlb param=1 id=btn_tlb_1 style="background:url(/images/index/btn4.jpg) no-repeat"><a href="/news/news_list.php?tags=%E5%B0%8F%E7%BC%96%E5%8A%A0%E7%B2%BE" target=_blank>小编加精</a></div>
 				<div class=btn_tlb param=2 id=btn_tlb_2  style="background:url(/images/index/btn3.jpg) no-repeat"><a href="/news/news_list.php?id=<?php echo $record_quick[0]->cid?>" target=_blank>新闻速读</a></div>
 				<div class=list_tlb id=list_tlb1 style="display:inline;">
 					<ul>
 						<?php for($i=0; $i<count($record_marrow); $i++){?>
 						<li><span style="color:#CCCCCC">·</span><a href="/<?php echo $record_marrow[$i]->platform ?>/news/news.php?id=<?php echo $record_marrow[$i]->id ?>" target=_blank><?php echo strip_tags($record_marrow[$i]->title); ?></a></li>
 						<? }?>
 				  </ul>
 				</div>
 				<div class=list_tlb id=list_tlb2>
 					<ul>
 						<?php for($i=0; $i<count($record_quick); $i++){?>
 						<li><span style="color:#CCCCCC">·</span><a href="/<?php echo $record_quick[$i]->platform ?>/news/news.php?id=<?php echo $record_quick[$i]->id ?>" target=_blank><?php echo $record_quick[$i]->short_title ?></a></li>
 						<? }?>
 				  </ul>
 				</div>


 			</div>
 			<!-- end !-->

		</div>

		<div id=p2>
 			<!-- start top_right_top !-->
  		<?php
				$sql = 'select n.*,n.id as news_id,n.description as news_description,c.*,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="大头条" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 1';
				$record_head=$db -> query($sql);
			?>
			<div id=t_r_t>
 				<div id=title><a href="<?php echo "/".$record_head[0]->platform."/news/news_head.php?id=".$record_head[0]->news_id ?>" target="_blank"><?php echo $record_head[0]->short_title ?></a><?php echo show_video($record_head[0]->video_flag,40,35)?></div>
 				<a href="/news/news_list.php?id=<?php echo $record_head[0]->cid; ?>" id=btn target=_blank></a>
 				<div id=content>
 				<?php
 					if($record_head[0]->sub_headline==1)
 					{ 
 							echo $record_head[0]->news_description; 
 					}
 					if($record_head[0]->sub_headline<>1&&$record_head[0]->sub_headline<>""&&$record_head[0]->sub_news_id<>"")
 					{
 							$sub_news_str=explode(",",$record_head[0]->sub_news_id); 
				  		$sub_news_str_num=sizeof($sub_news_str)-1;

							for($i=0;$i<=$sub_news_str_num;$i++)
							{
									$sql="select n.*,n.id as news_id,c.* from smg_news n left join smg_category c on n.category_id=c.id where n.id=".$sub_news_str[$i];
									$record_sub_news = $db -> query($sql);
									echo '[<a href="'.$record_sub_news[0]->platform.'/news/news_head.php?id='.$record_sub_news[0]->news_id.'" target=_blank>'.$record_sub_news[0]->short_title.'</a>]';
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
					$sql = 'select n.*,n.id as news_id,n.sub_news_id,n.description as news_description,c.* from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="小头条" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 2 ';
					$record_head=$db -> query($sql);
					for($j=0;$j<=1;$j++){
				?>
 				<div class=title><a href="<?php echo "/".$record_head[$j]->platform."/news/news_head.php?id=".$record_head[$j]->news_id ?>" target="_blank"><?php echo $record_head[$j]->short_title ?></a><?php echo show_video($record_head[$j]->video_flag,22,20)?><?php echo show_img($record_head[$j]->image_flag,22,20)?></div>
				<div class=content>
 				<?php
 					if($record_head[$j]->sub_headline==1)
 					{ 
 							echo $record_head[$j]->news_description; 
 					}
 					if($record_head[$j]->sub_headline<>1&&$record_head[$j]->sub_headline<>""&&$record_head[$j]->sub_news_id<>"")
 					{
 							$sql="select n.*,n.id as news_id,c.* from smg_news n left join smg_category c on n.category_id=c.id where n.id in (".$record_head[$j]->sub_news_id.")";
							$record_sub_news = $db -> query($sql);
 						

							for($i=0;$i<count($record_sub_news);$i++)
							{

									echo '[<a href="'.$record_sub_news[$i]->platform.'/news/news_head.php?id='.$record_sub_news[$i]->news_id.'" target=_blank>'.$record_sub_news[$i]->short_title.'</a>]';
							}		
							/*
							echo "<br>";
							for($i=3;$i<=$sub_news_str_num;$i++)
							{
								  if($i>5){break;}
									$sql="select n.*,n.id as news_id,c.* from smg_news n left join smg_category c on n.category_id=c.id where n.id=".$sub_news_str[$i];
									$record_sub_news = $db -> query($sql);
									echo '[<a href="'.$record_sub_news[0]->platform.'/news/news_head.php?id='.$record_sub_news[0]->news_id.'" target=_blank>'.$record_sub_news[0]->short_title.'</a>]';
							}	
							*/	
					}	
				?>					
				</div>
				<? }?>

 			</div>
 			<!-- end !-->
			
 			<!-- start top_right_center_middle !-->
 			<div id=t_r_c_m>
 				<a href="/news/news_list.php?id=23" target="_blank" id=title></a>
  			<?php
					$sql = 'select n.short_title,c.platform,n.id  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="重点关注-头" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 1 ';
					$record_import=$db -> query($sql);
					
				?>		
				<div id=content1><a href="<?php echo "/".$record_import[0]->platform."/news/news.php?id=".$record_import[0]->id ?>" target="_blank"><?php echo $record_import[0]->short_title; ?></a></div>
 				<a href="" id=btn ></a>
 				<?php

					$sql = 'select * from smg_news_show;';
					$record=$db -> query($sql); 				
					$days=$record[0]->days;
 					if($record[0]->days==0)
 					{	$sql = 'select n.short_title,n.title,c.platform,n.id,n.image_flag,n.video_flag,n.created_at from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="重点关注-普" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 41';	}
 					else
 					{ $sql = 'select n.short_title,n.title,c.platform,n.id,n.image_flag,n.video_flag,n.created_at from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="重点关注-普" and c.platform="news" and TO_DAYS(NOW())-TO_DAYS(n.created_at) <= '.$record[0]->days.'  order by n.click_count desc,n.created_at desc limit 41';}
					$record_import_a=$db -> query($sql);
					$sql = 'select n.photo_src, c.platform,n.id from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="重点关注-图" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 6';
					$record_import_b=$db -> query($sql);
					$sql = 'select n.short_title, c.platform,n.id,n.image_flag,n.video_flag from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="重点关注-专" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 2';
					$record_import_c=$db -> query($sql);
					
				?>	
 				<div id=box>
 					<div id=l>
 						<ul>
 						 <?php for($i=0; $i<5; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>
 						<div class=space></div>
  					<ul>
 						 <?php for($i=5; $i<8; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>
 						<div class=space></div>
  					<ul>
 						 <?php for($i=8; $i<11; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>
 						<div class=space></div>
						<a href="<?php echo "/".$record_import_b[0]->platform."/news/news.php?id=".$record_import_b[0]->id ?>" target="_blank"><img class=imgs src="<?php echo $record_import_b[0]->photo_src ?>" border=0 ></a>
						<a href="<?php echo "/".$record_import_b[1]->platform."/news/news.php?id=".$record_import_b[1]->id ?>" target="_blank"><img class=imgs src="<?php echo $record_import_b[1]->photo_src ?>" border=0 ></a>
  					<ul>
 						 <?php for($i=11; $i<13; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>						
 					</div>	
 					
 					<div id=c>
   					<ul>
 						 <?php for($i=13; $i<18; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>								
 						<div style="width:138px; height:49px; margin-top:5px; margin-bottom:5px; padding:3px; text-align:center; border:1px solid #ff0000; float:left; display:inline">
 							<a href="/subject/sxxx/" target=_blank><img src="/images/1.jpg" width="125px; height:20px;" border=0></a>
 							<a style="line-height:15px; text-decoration:none; color:#000000" href="<?php echo "/".$record_import_c[0]->platform."/news/news.php?id=".$record_import_c[0]->id ?>" target="_blank"><?php echo $record_import_c[0]->short_title ?></a>
 						</div>
 			
   					<ul>
 						 <?php for($i=18; $i<21; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>			
 						<div class=space></div>
   					<ul>
 						 <?php for($i=21; $i<26; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>	
 					</div>	 
 					
 					<div id=r>
 						<div style="width:138px; height:49px; margin-top:5px; margin-bottom:5px; padding:3px; text-align:center; border:1px solid #ff0000; float:left; display:inline">
 							<a href="/subject/djnews/" target=_blank><img src="/images/2.jpg" width="125px; height:20px;" border=0></a>
 							<a style="line-height:15px; text-decoration:none; color:#000000" href="<?php echo "/".$record_import_c[1]->platform."/news/news.php?id=".$record_import_c[1]->id ?>" target="_blank"><?php echo $record_import_c[1]->short_title ?></a>
 						</div>
     				<ul>
 						 <?php for($i=26; $i<27; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>	 						
 						<div class=space></div>
     				<ul>
 						 <?php for($i=27; $i<30; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>	 						
 						<div class=space></div>
      			<ul>
 						 <?php for($i=30; $i<33; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>	 						
 						<div class=space></div>												
      			<ul>
 						 <?php for($i=33; $i<38; $i++){?>
 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div><div><a <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" title=<?php echo strip_tags($record_import_a[$i]->title)?>><?php echo $record_import_a[$i]->short_title ?></a></div></li>
             <? }?>
 						</ul>	
 					</div>	 				
 				</div>
 				<?php
					$sql = 'select n.short_title, c.platform,n.id as news_id,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="广而告之" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 6';
					$record_marguee=$db -> query($sql);
				?>
				<a href="/news/news_list.php?id=<?php echo $record_marguee[0]->cid?>" target="_blank" id=title2></a>
 				<div id=content_marguee>
 					<MARQUEE scrollAmount=1 scrollDelay=60 behavior=scroll  width="100%" style="line-height:24px;">
 						<?php for($i=0; $i<6; $i++){?>
							<a href="/<?php echo $record_marguee[$i]->platform?>/news/news.php?id=<?php echo $record_marguee[$i]->news_id?>" target=_blank><?php echo $record_marguee[$i]->short_title?></a>　
						<? }?>
 					</MARQUEE>	
 				</div>
 			</div>
 			<!-- end !-->
		

 			<!-- start top_right_center_bottom_left !-->
 			<div id=t_r_c_b_l>
 				<iframe src="index_report.html" frameborder=0 scrolling="no" ></iframe>
 			</div>
 			<!-- end !-->


 			<!-- start top_right_center_bottom_right !-->
  		<?php
				$sql = 'select n.id as news_id, n.photo_src,n.short_title,c.platform,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="业界动态" and c.platform="server"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 8';
				$record_industry=$db -> query($sql);
			?>
			<div id=t_r_c_b_r>
					<div id=title></div>
					<a href="/news/news_list.php?id=<?php echo $record_industry[0]->cid?>" id=more target=_blank></a>
					<div id=box1>
						<a href="/<?php echo $record_industry[0]->platform?>/news/news.php?id=<?php echo $record_industry[0]->news_id?>" target=_blank><img src="<?php echo $record_industry[0]->photo_src ?>" border=0></a>
						<ul>
							<li><a href="/<?php echo $record_industry[1]->platform?>/news/news.php?id=<?php echo $record_industry[1]->news_id?>" target=_blank><?php echo $record_industry[1]->short_title ?></a></li>
							<li><a href="/<?php echo $record_industry[2]->platform?>/news/news.php?id=<?php echo $record_industry[2]->news_id?>" target=_blank><?php echo $record_industry[2]->short_title ?></a></li>
							<li><a href="/<?php echo $record_industry[3]->platform?>/news/news.php?id=<?php echo $record_industry[3]->news_id?>" target=_blank><?php echo $record_industry[3]->short_title ?></a></li>
						</ul>	
					</div>	
					<div id=box2>
						<ul>
							<li>·<a href="/<?php echo $record_industry[3]->platform?>/news/news.php?id=<?php echo $record_industry[4]->news_id?>" target=_blank><?php echo $record_industry[4]->short_title ?></a></li>
							<li>·<a href="/<?php echo $record_industry[3]->platform?>/news/news.php?id=<?php echo $record_industry[5]->news_id?>" target=_blank><?php echo $record_industry[5]->short_title ?></a></li>
							<li>·<a href="/<?php echo $record_industry[3]->platform?>/news/news.php?id=<?php echo $record_industry[6]->news_id?>" target=_blank><?php echo $record_industry[6]->short_title ?></a></li>
							<li>·<a href="/<?php echo $record_industry[3]->platform?>/news/news.php?id=<?php echo $record_industry[7]->news_id?>" target=_blank><?php echo $record_industry[7]->short_title ?></a></li>
						</ul>						
					</div>
 			</div>
 			<!-- end !-->
		
		</div>
		<div id=p4>
 			<!-- start top_right_right_top !-->
 			<div id=t_r_r_t>
 				<div class=menu_trrt id=menu_trrt1 param=1 style="background:url(/images/index/btn7.jpg) no-repeat; font-weight:bold;"><a href="/fqtg/fqtglist.php" target=_blank>我要团购</a></div>
 				<div class=menu_trrt id=menu_trrt2 param=2 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:6px;">快乐番茄</div>
 				<div class=menu_trrt id=menu_trrt3 param=3 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:5px;">讨论区</div>
 					<?php
 						$sql = 'select * from smg_tg where isadopt=1 order by priority asc,createtime desc limit 3';
						$record_tg=$db -> query($sql);		
					?>	
 				<div class=content_trrt id=content_trrt1>
					<?php for($i=0;$i<3;$i++){?>
					<div class=box>
						<a href="/fqtg/fqtglist.php" target=_blank><img src="<?php echo $record_tg[$i]->photourl ?>" target=_blank border=0></a>
						<ul>
							<li style="height:18px; overflow:hidden;"><a href="/fqtg/fqtg.php?id=<?php echo $record_tg[$i]->id?>" target=_blank><?php echo $record_tg[$i]->title ?></a></li>
							<li style="height:36px; line-height:18px; color:#A1A0A0; overflow:hidden;"><?php echo strip_tags($record_tg[$i]->content);?></li>
							<li style="color:#BD0A01">番茄价：<?php echo $record_tg[$i]->price ?></li>
						</ul>
					</div>
					<? }?>
 				</div>
 				<?php
 					$sql = 'select n.short_title,n.id as news_id,c.platform from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="快乐番茄" and c.platform="server" order by n.priority asc limit 12';
					$record_happy=$db -> query($sql);		
				?>	
 				<div class=content_trrt id=content_trrt2 style="display:none;">
 					<div class=box>
						<ul>
							<?php for($i=0;$i<4;$i++){?>
							<li>·<a href="/<?php echo $record_happy[$i]->platform?>/news/news.php?id=<?php echo $record_happy[$i]->news_id?>" target=_blank><?php echo $record_happy[$i]->short_title ?></a></li>
							<? }?>
						</ul>
					</div>
					<div class=box>
						<ul>
							<?php for($i=4;$i<8;$i++){?>
							<li>·<a href="/<?php echo $record_happy[$i]->platform?>/news/news.php?id=<?php echo $record_happy[$i]->news_id?>" target=_blank><?php echo $record_happy[$i]->short_title ?></a></li>
							<? }?>
						</ul>
					</div>
					<div class=box>
						<ul>
							<?php for($i=8;$i<12;$i++){?>
							<li>·<a href="/<?php echo $record_happy[$i]->platform?>/news/news.php?id=<?php echo $record_happy[$i]->news_id?>" target=_blank><?php echo $record_happy[$i]->short_title ?></a></li>
							<? }?>
						</ul>
					</div> 				
 				</div>
 				<?php
 					$sql = 'select n.short_title,n.id as news_id,c.platform  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="讨论区" and c.platform="zone" order by n.priority asc limit 12';
					$record_discuss=$db -> query($sql);		
				?>	
 				<div class=content_trrt id=content_trrt3 style="display:none;">
 					<div class=box>
						<ul>
							<?php for($i=0;$i<4;$i++){?>
							<li>·<a href="/<?php echo $record_discuss[$i]->platform?>/news/news.php?id=<?php echo $record_discuss[$i]->news_id?>" target=_blank><?php echo $record_discuss[$i]->short_title ?></a></li>
							<? }?>
						</ul>
					</div>
					<div class=box>
						<ul>
							<?php for($i=4;$i<8;$i++){?>
							<li>·<a href="/<?php echo $record_discuss[$i]->platform?>/news/news.php?id=<?php echo $record_discuss[$i]->news_id?>" target=_blank><?php echo $record_discuss[$i]->short_title ?></a></li>
							<? }?>
						</ul>
					</div>
					<div class=box>
						<ul>
							<?php for($i=8;$i<12;$i++){?>
							<li>·<a href="/<?php echo $record_discuss[$i]->platform?>/news/news.php?id=<?php echo $record_discuss[$i]->news_id?>" target=_blank><?php echo $record_discuss[$i]->short_title ?></a></li>
							<? }?>
						</ul>
					</div> 	 				
 				</div>
 				
 				
 			</div>
 			<!-- end !-->			
 			<!-- start top_right_right_middle !-->
 			<?php
 					$sql = 'select n.short_title, n.id as news_id, c.platform,c.id as c_id from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="我要报料" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc';
					$record_baoliao=$db -> query($sql);		
			?>	 		
			<div id=t_r_r_m>
 				<a href="/news/news_sub.php" id=btn target=_blank></a>
				<div class=more><a target="_blank" href="/news/news_list.php?id=<?php echo $record_baoliao[0]->c_id; ?>">More</a></div>
				<div id=content_trrm>
					<?php for($i=0;$i<12;$i++){?><a href="/<?php echo $record_baoliao[$i]->platform?>/news/news.php?id=<?php echo $record_baoliao[$i]->news_id?>" target=_blank><span style="color:#ff0000">·</span><?php echo $record_baoliao[$i]->short_title ?></a> <? }?>				
					</div>
 			</div>
 			<!-- end !-->						

 			<!-- start top_right_right_bottom !-->
 			<?php
 					$sql = 'select n.short_title,n.id as news_id,c.* from smg_news n left join smg_category c on n.category_id=c.id  where TO_DAYS(NOW())-TO_DAYS(n.last_edited_at) <= 30 order by n.click_count desc limit 10';
					$record_news=$db -> query($sql);	
					$sql='select uid,itemid,subject from blog_spaceitems order by itemid desc limit 10';
					$record_blog=$db -> query($sql);	
					$sql="select tid,subject from bbs_posts where first=1 order by pid desc limit 10";
					$record_bbs=$db -> query($sql);	
			?>	 
 			<div id=t_r_r_b>
 				<div class=menu_trrb id=menu_trrb1 param=1 style="background:url(/images/index/btn7.jpg) no-repeat; margin-left:9px; font-weight:bold;">新闻排行</div>
 				<div class=menu_trrb id=menu_trrb2 param=2 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:6px;">最新博文</div>
 				<div class=menu_trrb id=menu_trrb3 param=3 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:5px;">最新热帖</div>
				<div id=number>
					<?php for($i=1;$i<=10;$i++){?>
					<img src="/images/number/<?php echo $i?>.jpg">
					<? }?>
				</div>
				<div class=content_trrb id=content_trrb1 style="display:inline">
					<ul>
					<?php for($i=0;$i<10;$i++){?>
						<li><a href="/<?php echo $record_news[$i]->platform ?>/news/news.php?id=<?php echo $record_news[$i]->news_id ?>"   <?php if($i<=2){?>  style="color:#E52520" <?php }?> target=_blank ><?php echo $record_news[$i]->short_title; ?></a></li>
					<? }?>	
					</ul>
				</div>
				<div class=content_trrb id=content_trrb2>
					<ul>
					<?php for($i=0;$i<10;$i++){?>
						<li><a href="/blog/?uid-<?php echo $record_blog[$i]->uid; ?>-action-viewspace-itemid-<?php echo $record_blog[$i]->itemid; ?>" <?php if($i<=2){?>  style="color:#E52520" <?php }?> target=_blank ><?php echo $record_blog[$i]->subject; ?></a></li>
					<? }?>	
					</ul>
				</div>
				<div class=content_trrb id=content_trrb3>
					<ul>
					<?php for($i=0;$i<10;$i++){?>
						<li><a href="/bbs/viewthread.php?tid=<?php echo $record_bbs[$i]->tid; ?>" <?php if($i<=2){?>  style="color:#E52520" <?php }?> target=_blank ><?php echo $record_bbs[$i]->subject; ?></a></li>
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
  		<?php
 					$sql = 'select n.id as news_id,n.description,n.short_title,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="节目点评" and c.platform="show"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 6';
					$record_program=$db -> query($sql);
			?>	
			<div id=m_l_t>
 				<a href="/show/list.php?type=news&id=<?php echo $record_program[0]->cid ?>"  target=_blank id=more></a>
 				<img src="/images/index/program.jpg">
				<div id=content_mlt>
					<li style="height:25px; line-height:25px; font-weight:bold; font-size:14px;" ><a style="color:#FF6600;" href="/show/article.php?id=<?php echo $record_program[0]->news_id ?>" target=_blank><?php echo $record_program[0]->short_title ?></a></li>
					<?php for($i=1;$i<6;$i++){?>
					<li><a href="/show/article.php?id=<?php echo $record_program[$i]->news_id ?>" target=_blank><?php echo $record_program[$i]->short_title ?></a></li>
					<? }?>
 				</div>
 			</div>
 			<!-- end !-->	   	
    
  		<!-- start middle_left_bottom !-->
 			<div id=m_l_b>
 				<div id=title>博 客</div>
 				<a href="/zone/" id=more target=_blank></a>
 				<?
  				$sql = 'select i.id as img_id,i.src,c.id as cid from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="首页博客" and c.platform="zone" order by i.priority asc limit 1';
					$record_blog=$db -> query($sql);	
				?>
 				<a href="/show/show.php?id=<?php echo $record_blog[0]->img_id ?>" target=_blank><img src="<?php echo $record_blog[0]->src ?>" border=0></a>
 				<?php
 					$sql = 'select n.short_title,n.id as news_id,c.platform  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="博客" and c.platform="zone"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 5';
					$record_blog=$db -> query($sql);		
				?>	 
				<div id=content_mlb>
					<ul>
						<li style="color:#666666; font-weight:bold; font-size:13px; line-height:25px; height:25px;"><a href="/<?php echo $record_blog[0]->platform ?>/news/news.php?id=<?php echo $record_blog[0]->news_id ?>" target=_blank><?php echo $record_blog[0]->short_title ?></a></li>
						<?php for($i=1;$i<5;$i++){ ?>
						<li><a href="/<?php echo $record_blog[$i]->platform ?>/news/news.php?id=<?php echo $record_blog[$i]->news_id ?>" target=_blank>·<?php echo $record_blog[$i]->short_title ?></a></li>
						<? }?>
					</ul>
 				</div> 				
 			</div>
 			<!-- end !-->	     
    
    </div> 	
 	
    <div id=p2>
    	
  		<!-- start middle_center_top !-->
  		<?php
  				$sql = 'select i.id as img_id,i.title,i.src,c.id as cid from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="我行我秀" and c.platform="show" order by i.priority asc,i.created_at desc limit 6';
					$record_show=$db -> query($sql);

 					$sql = 'select n.id as news_id,n.short_title,c.id as cid  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="部门比拼" and c.platform="show"  and is_recommend=1 order by n.priority asc, n.created_at desc limit 5';
					$record_dept=$db -> query($sql);
  		?>
 			<div id=m_c_t>
 				<a href="/show/show_index.php" id=more1 target=_blank></a>
 				<a href="/show/list.php?type=news&id=<?php echo $record_dept[0]->cid?>" id=more2 target=_blank></a>

  			<div id=box1>
	  			<a href="/show/show.php?id=<?php echo $record_show[0]->img_id?>" target=_blank><img src="<?php echo $record_show[0]->src ?>" border=0></a>
  				<ul>
  					<?php for($i=0;$i<5;$i++){?>
  					<li><a href="/show/show.php?id=<?php echo $record_show[$i]->img_id?>" target=_blank><?php echo strip_tags($record_show[$i]->title)?></a></li>
  					<? }?>
   				</ul>
  			</div>
  			<div id=box2>

  				<ul>
  					<?php for($i=0;$i<=4;$i++){?>
  					<li><a href="/show/article.php?id=<?php echo $record_dept[$i]->news_id?>" target=_blank><?php echo $record_dept[$i]->short_title?></a></li>
  					<? }?>
   				</ul> 			
  			</div>
 			</div>
 			<!-- end !-->	      	
    	
  		<!-- start middle_center_top !-->
 			<div id=m_c_b>
 				<a href="/news/news_list.php?id=45" id=more1 target=_blank></a>
 				<a href="/zone/dialog_list.php" id=more2 target=_blank></a>
 				<div class=box>
   				<?php
 						$sql = 'select n.id as news_id,n.short_title,n.tags,c.platform,c.name from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="番茄专栏" and c.platform="zone"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 5';
						$record=$db -> query($sql);
  				?> 		
  				<ul>
  					<?php for($i=0;$i<=4;$i++){?>
  					<li><font color="#000000">【<?php echo $record[$i]->tags ?>】</font><a href="/<?php echo $record[$i]->platform?>/news/news.php?id=<?php echo $record[$i]->news_id?>" target=_blank><?php echo $record[$i]->short_title?></a></li>
  					<? }?>
 					</ul>	
  				
  							
 				</div>
 				
 				<div class=box>
   				<?php
 						$sql = 'select * from smg_dialog where is_adopt=1 order by create_time desc limit 4';
						$record=$db -> query($sql);
  				?>
  				<a href="/zone/dialog.php?id=<?php echo $record[0]->id ?>" target=_blank><img src="<?php echo $record[0]->photo_url ?>" border=0></a>
  				<div id=context1>
  					<a href="/zone/dialog.php?id=<?php echo $record[0]->id ?>" target=_blank><?php echo $record[0]->title ?></a>
  				</div>
  				<div id=context2>
  					<?php echo $record[0]->content ?>
  				</div>
  				<div id=context3>
  					<li><span style="color:#FF9900">·</span><a href="/zone/dialog.php?id=<?php echo $record[1]->id ?>" target=_blank><?php echo $record[1]->title ?></a></li>
  					<li><span style="color:#FF9900">·</span><a href="/zone/dialog.php?id=<?php echo $record[2]->id ?>" target=_blank><?php echo $record[2]->title ?></a></li>
  					<li><span style="color:#FF9900">·</span><a href="/zone/dialog.php?id=<?php echo $record[3]->id ?>" target=_blank><?php echo $record[3]->title ?></a></li>
  				</div>
 				</div>
 			</div>
 			<!-- end !-->	      	
    	    
    </div> 	
    <div id=p3>
      <!-- start middle_right_top !-->
      <?
       	$sql = 'select v.title,v.photo_url, v.id as video_id, c.id as cid from smg_video v left join smg_category c on v.category_id=c.id where v.is_adopt=1 and c.name="佳片共赏" and c.platform="show" order by v.priority asc,v.created_at desc limit 6';
				$record_video=$db -> query($sql);
			?>
 			<div id=m_r_t>
 				<a href="/show/video_index.php" id=more target=_blank></a>
				<div id=content_mrt>
  					<li><a href="/show/video.php?id=<?php echo $record_video[0]->video_id ?>" style="color:#F0474E; font-size:14px; font-weight:bold" target=_blank><?php echo $record_video[0]->title?></a></li>
					<?php for($i=1;$i<6;$i++){?>
  					<li><span style="color:#FF9900">·</span><a href="/show/video.php?id=<?php echo $record_video[$i]->video_id ?>" target=_blank><?php echo $record_video[$i]->title?></a></li>
					<? }?>
				
				</div>
 			</div>
 			<!-- end !-->		
    	
      <!-- start middle_right_bottom !-->
 			<div id=m_r_b>
 				<div id=title>论 坛</div>
 				<a href="/bbs/" id=more target=_blank></a>
				<?php
 					$sql = 'select n.short_title,n.id as news_id,c.platform  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="论坛" and c.platform="zone" order by n.priority asc limit 6';
					$record_blog=$db -> query($sql);		
				?>	 
				<div id=content_mrb>
					<ul>
						<li style="font-weight:bold; font-size:15px; line-height:25px; height:25px;"><a href="/<?php echo $record_blog[0]->platform ?>/news/news.php?id=<?php echo $record_blog[0]->news_id ?>" target=_blank style="color:#FF9900;"><?php echo $record_blog[0]->short_title ?></a></li>
						<?php for($i=1;$i<6;$i++){ ?>
						<li><a href="/<?php echo $record_blog[$i]->platform ?>/news/news.php?id=<?php echo $record_blog[$i]->news_id ?>" target=_blank>·<?php echo $record_blog[$i]->short_title ?></a></li>
						<? }?>
					</ul>
 				</div>
 			</div>
 			<!-- end !-->	    
    </div> 	
 </div>
 <div id=ibody_bottom>
    <div id=p1>
      <!-- start bottom_top_left !-->
 			<div id=b_t_l>
 				<?php  
					$sql = 'select id,name from smg_vote where is_sub_vote =0 and is_adopt=1 and (category_id=0 or category_id=11) order by created_at desc limit 12';
					$record = $db->query($sql);
					$count = count($record);
				?>
				<div class=l_box>
					<?php
						$l_count = $count>7?7:$count;
						for($i=0;$i<$l_count;$i++){
					?>
					<div class="bottom_title"><li><span style="color:#FF9900">·</span><a href="/vote/vote.php?vote_id=<?php echo $record[$i]->id ?>" title="<?php echo strip_tags($record[$i]->name); ?>" target=_blank><?php echo strip_tags($record[$i]->name);?></a></li></div>
					<?php
						}
					?>
				</div>
				<div class=r_box>
					<?php
						$count = $count-7>0?$count:7;
						for($i=7;$i<$count;$i++){
					?>
					<div class="bottom_title"><li><span style="color:#FF9900;">·</span><a href="/vote/vote.php?vote_id=<?php echo $record[$i]->id ?>" title="<?php echo strip_tags($record[$i]->name); ?>" target=_blank><?php echo strip_tags($record[$i]->name);?></a></li></div>
					<?php
						}
					?>
				</div>
				<div id=vote><a href="/vote/vote_list.php" target="_blank"><img border=0 src="/images/index/vote.jpg"></a></div>
				<div id=begin_vote><a href="/vote/beginvote.php" target="_blank"><img border=0 src="/images/index/begin_vote.jpg"></a></div>
 			</div>
 			<!-- end !-->	      	
 
      <!-- start bottom_top_right !-->
 			<div id=b_t_r>
				<div class=m_box>
					<?php  
						$sql = 'select id,title from smg_question where is_adopt=1 order by create_time desc limit 6';
						$record = $db->query($sql);
						$count = count($record);
					?>
					<div class="top_title"><a href="/answer/answer.php?id=<?php echo $record[0]->id; ?>" title="<?php echo $record[0]->title; ?>" target=_blank><?php echo $record[0]->title; ?></a></div>
					<?php 
						for($i=1;$i<$count;$i++){
					?>
					<div class="bottom_title"><li><span style="color:#FF9900">·</span><a href="/answer/answer.php?id=<?php echo $record[$i]->id ?>" title="<?php echo $record[$i]->title; ?>" target=_blank><?php echo $record[$i]->title ?></a></li></div>
					<?php
						}
					?>
				</div>
				<div class=r_box>
					<div id=begin_question><a href="/answer/question.php" target="_blank"><img border=0 src="/images/index/begin_question.jpg"></a></div>
					<div id=question><a href="/answer/answerlist.php" target="_blank"><img border=0 src="/images/index/question.jpg"></a></div>
				</div>
 			</div>
 			<!-- end !-->	 
    	
    </div>
    <div id=p2>
      <!-- start bottom_bottom_left !-->
 			<div id=b_b_l>
 				<div id=title>生日祝福</div>
				<div id="box_body">
	 				<marquee direction="up" scrollamount="1" height="100" width="300" onmouseover=this.stop() onmouseout=this.start()  >
	 				<?php
						$today = date("m-d");
						$sql = 'select t1.nickname,t1.gender,t2.name from smg_user_real t1 join smg_org_dept t2 on t1.org_id=t2.orgid where t1.birthday_short="'.date("m-d").'" and t1.hide_birthday=0 and t1.state=3';
						$records = $db->query($sql);
						$count = count($records);
						for($i=0;$i<$count;$i++){
					?>
						<?php if($records[$i]->gender=='男'){?><img src="/images/index/birthday_boy.jpg"><?php }else{?><img src="/images/index/birthday_girl.jpg"><?php } ?><a href="/server/today.php" target="_blank"><?php echo $records[$i]->nickname; ?><span style="color:#727272">[<?php echo  $records[$i]->name; ?>]</span></a><a href="/server/today.php" target="_blank"><img src="/images/index/birthday_sun.jpg" border=0 ></a>　　
					<?php
						}
					?>
					</marquee>
				</div>
 			</div>
 			<!-- end !-->	     	
    	
      <!-- start bottom_bottom_center !-->
 			<div id=b_b_c>
 				<div id=title>番茄喜讯</div>
				<DIV id=Layer5 style=" margin-top:40px; margin-left:10px; ">
				      <DIV id=demo6 style="OVERFLOW: hidden; WIDTH: 95%;">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo7 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=left>
				              	<?php
									$marry=$db->query('select photo,name from smg_marry order by id desc limit 5');
									for($i=0;$i<count($marry);$i++){
								?>
				                <TD><div class=content>
							<div class=pic><a target="_blank" href="/server/marry.php"><img border=0 width=90 height=70 src="<?php echo $marry[$i]->photo;?>"></a></div>
							<div class=context><a target="_blank" href="/server/marry.php"><?php echo $marry[$i]->name;?></a><br></div>
						</div></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id="demo8" vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
								        var demo6 = document.getElementById('demo6');
										var demo7 = document.getElementById('demo7');
										var demo8 = document.getElementById('demo8');  
								      	$(document).ready(function(){
											var speed=30//速度数值越大速度越慢
											demo8.innerHTML=demo7.innerHTML
											function Marquee(){
											if(demo8.offsetWidth-demo6.scrollLeft<=0)
											demo6.scrollLeft-=demo7.offsetWidth
											else{
											demo6.scrollLeft++
											}
											}
											var MyMar=setInterval(Marquee,speed)
											demo6.onmouseover=function() {clearInterval(MyMar)}
											demo6.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
										})
									</SCRIPT>
				</DIV>
 			</div>
 			<!-- end !-->	     	
    
      <!-- start bottom_bottom_right !-->
 			<div id=b_b_r>
				<div id=title>在线杂志</div>
				<?php  
					$sql = 'select t1.id as i_id,t1.title,t1.description,t1.url,t1.src from smg_images t1 join smg_category t2 on t1.category_id=t2.id where t1.is_adopt=1 and t2.name="在线杂志" and t2.category_type="picture" order by created_at desc limit 3';
					$records = $db->query($sql);
					$count = count($records);
					for($i=0;$i<$count;$i++){
				?>
				<div class=box>
					<div class=pic><a href="/show/show.php?id=<?php echo $records[$i]->i_id;?>" target="_blank" title="<?php echo $records[$i]->title;?>"><img src="<?php echo $records[$i]->src;?>" border=0 width=70 height=90></a></div>
					<div class=title><?php echo $records[$i]->title;?></div>
				</div>
				<?php
					}
				?>
 			</div>
 			<!-- end !-->	 

    </div>
 </div> 
 
 
</div>
<? require_once('inc/bottom.inc.php');?>


</body>
</html>