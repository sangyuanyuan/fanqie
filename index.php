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
		if(date('Y-m-d')=='2010-04-21'){ css_include_tag('index_filter'); }
		css_include_tag('index','top','bottom');
		use_jquery();
	  js_include_once_tag('index','total','fd');
  ?>
	
</head>
<script>
total("首页","other");
</script>
<script language="JAVASCRIPT">
     colors2 = new Array(7); 
     colors2[0]="#313131";
     colors2[1]="#333300";
     colors2[2]="#665500";
     colors2[3]="#997700";
     colors2[4]="#CC9900";
     colors2[5]="#FD9531";
     colors2[6]="#FF0000";

     var i=0;
     function fLi2() {
      if (i<7) {
         //line2.style.color = colors2[i];
         //line3.style.color = colors2[i];
         i++;
         timerID2 = setTimeout( "fLi2()", 100);
       }
       else {
	       i=0;
	       TimerID2=setTimeout("fLi2()",1000);
       }
      }
 </script>

<!--<script>
	window.onload = aa;
  window.onresize = aa;
  function aa() {
	  var getE = document.getElementById('container');
	  var getBody = document.getElementById('body');
	  getE.style.left = (getBody.clientWidth - getE.offsetWidth)/2 + "px";
	}
</script>-->
<body id="body" onload="TimerID2=setTimeout('fLi2()',1000);">
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
					<a   href="/show/show.php?id=<?php echo $record_star[0]->img_id?>" target=_blank><img src="<?php echo $record_star[0]->src?>" width=270; height=180; border=0></a>
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
 				<div class=content_tlt id=content2 <?php if($record_inline[0]->name=='spxw'){?>style="display:inline;"<?php }?>>
 					
 						<iframe id=video_src src="index_video.php?photo=<?php echo $record_video[0]->video_photo_src ?>&video=<?php echo $record_video[0]->video_src ?>" width=235px height=182px scrolling="no" frameborder="0"></iframe>
 				</div>
  			<div class=content_tlt id=content3 <?php if($record_inline[0]->name=='fqgg'){?>style="display:inline"<?php }?>>
				<?php if($record_ad[1]->ipriority<>0){?>
					<a   href="/show/show.php?id=<?php echo $record_ad[0]->img_id?>" target=_blank><img src="<?php echo $record_ad[0]->src?>" width=270px; height=180px; border=0></a>
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
 						<li><a   href="/show/show.php?id=<?php echo $record_star[$i]->img_id ?>" target=_blank><?php echo strip_tags($record_star[$i]->title) ?></a></li>
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
 						<li><a   href="/show/show.php?id=<?php echo $record_ad[$i]->img_id; ?>" target=_blank><?php echo strip_tags($record_ad[$i]->title) ?></a></li>
 						<? }?>
 					</ul>		
 				</div>
 			</div>
 			<!-- end !-->
			
 			<!-- start top_left_middle !-->
  		<?php
 					$sql = 'select n.short_title, n.title, n.id as news_id, n.photo_src, n.cream, c.platform,c.id as c_id from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="我要报料" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc';
					$record_baoliao=$db -> query($sql);		
			?>	 		
			<div id=t_l_m>
 				<div id=title>
 					<div id=title_l>最火报料</div>
 					<div id=title_r><button id=wybl_btn></button></div>
 				</div>
 				<div id=content>
 					<div id=content_t>
 						<div id=title1>热议话题</div><div id=more><a target="_blank" href="news/news_list.php?id=<?php echo $record_baoliao[0]->c_id; ?>">more>></a></div>
 						
 						<div id=c_r>
 							<?php for($i=0;$i<7;$i++){?>
 								<div class=crcl><a <?php if($record_baoliao[$i]->cream >=30){ ?>style="padding-left:15px; background:url('images/cream1.gif') no-repeat;"<?php } ?> target="_blank" title="<?php echo $record_baoliao[$i]->title; ?>" href="/news/news/news_wybl.php?id=<?php echo $record_baoliao[$i]->news_id; ?>"><?php echo delhtml($record_baoliao[$i]->short_title); ?></a></div>
 							<?php } ?>
 						</div>
 						
 					</div>
 					<div id=content_b>
 						<?php for($i=7;$i<29;$i++){ ?>
 						<div class=cbcl>
 								<a <?php if($record_baoliao[$i]->cream >=50){ ?>style="padding-left:15px; background:url('images/cream1.gif') no-repeat;"<?php } ?> target="_blank" title="<?php echo $record_baoliao[$i]->title; ?>" href="/news/news/news_wybl.php?id=<?php echo $record_baoliao[$i]->news_id; ?>"><?php echo $record_baoliao[$i]->short_title; ?></a>	
 						</div>
 						<?php } ?>
 					</div>
 				</div>
			
 			</div>
 			<!-- end !-->


 			<!-- start top_left_bottom !-->
 			<?php
				$sql = 'select n.id,n.short_title,n.title,c.platform,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.tags="小编加精"   and is_recommend=1 order by n.priority asc,n.created_at desc limit 8';
				$record_marrow=$db -> query($sql);
				$sql = 'select n.id,n.short_title,c.platform,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="新闻速读" and c.platform="server"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 8';
				$record_quick=$db -> query($sql);
			?>
			<!--<div id=t_l_b>
 				<div class=btn_tlb param=1 id=btn_tlb_1 style="background:url(/images/index/btn4-1.jpg) no-repeat"><a   href="/news/news_list.php?tags=%E5%B0%8F%E7%BC%96%E5%8A%A0%E7%B2%BE" target=_blank>小编加精</a></div>
 				<div class=btn_tlb param=2 id=btn_tlb_2  style="background:url(/images/index/btn3-1.jpg) no-repeat"><a   href="/news/news_list.php?id=<?php echo $record_quick[0]->cid?>" target=_blank>新闻速读</a></div>
 				<div class=btn_tlb param=3 id=btn_tlb_3  style="background:url(/images/index/btn3-1.jpg) no-repeat"><a   href="/news/news_list.php?id=<?php echo $record_quick[0]->cid?>" target=_blank>业界动态</a></div>
 				<div class=list_tlb id=list_tlb1 style="display:inline;">
 					<ul>
 						<?php for($i=0; $i<count($record_marrow); $i++){?>
 						<li><div style="width:185px; height:20px; line-height:20px; float:left; display:inline;"><span style="color:#CCCCCC">·</span><a   title="<?php echo delhtml($record_marrow[$i]->short_title);?>" href="/<?php echo $record_marrow[$i]->platform ?>/news/news.php?id=<?php echo $record_marrow[$i]->id ?>" target=_blank><?php echo strip_tags($record_marrow[$i]->short_title); ?></a></div><?php if($i<3){?><div style="width:40px; height:20px; line-height:20px; float:right; display:inline;"><img src="/images/pic/new.gif"></div><?php } ?></li>
 						<? }?>
 				  </ul>
 				</div>
 				<div class=list_tlb id=list_tlb2>
 					<ul>
 						<?php for($i=0; $i<count($record_quick); $i++){?>
 						<li><div style="width:185px; height:20px; line-height:20px; float:left; display:inline;"><span style="color:#CCCCCC">·</span><a   title="<?php echo delhtml($record_quick[$i]->short_title);?>" href="/<?php echo $record_quick[$i]->platform ?>/news/news.php?id=<?php echo $record_quick[$i]->id ?>" target=_blank><?php echo $record_quick[$i]->short_title ?></a></div><?php if($i<3){?><div style="width:40px; height:20px; line-height:20px; float:right; display:inline;"><img src="/images/pic/new.gif"></div><?php } ?></li>
 						<? }?>
 				  </ul>
 				</div>
				<div class=list_tlb id=list_tlb3>
 					<ul>
 						<?php for($i=0; $i<count($record_industry); $i++){?>
 						<li><div style="width:185px; height:20px; line-height:20px; float:left; display:inline;"><span style="color:#CCCCCC">·</span><a   title="<?php echo delhtml($record_industry[$i]->short_title);?>" href="/<?php echo $record_industry[$i]->platform ?>/news/news.php?id=<?php echo $record_industry[$i]->news_id ?>" target=_blank><?php echo $record_industry[$i]->short_title ?></a></div><?php if($i<3){?><div style="width:40px; height:20px; line-height:20px; float:right; display:inline;"><img src="/images/pic/new.gif"></div><?php } ?></li>
 						<? }?>
 				  </ul>
 				</div>

 			</div>-->
 			<!-- end !-->

		</div>
		<?php $ss=$db->query('select description,content from smg_news where id=47026');
$ds=$db->query('select description,content from smg_news where id=47027');
$gb=$db->query('select description,content from smg_news where id=47028');
 ?>
		<!--<div id=p2_top><span style="color:#ff0000;">今日宣传值班</span>：上视大厦 （日）<?php echo delhtml($ss[0]->description); ?>（夜）<?php echo delhtml($ss[0]->content); ?>　东视大厦 （日）<?php echo delhtml($ds[0]->description); ?>（夜）<?php echo delhtml($ds[0]->content); ?>　广播大厦　<?php echo delhtml($gb[0]->content); ?>　　<a style="color:#ff0000;" target="_blank" href="news/news/news.php?id=47297">宣传值班表</a>
			<span style="color:#ff0000;">今日宣传值班</span>：上视大厦 <?php echo delhtml($ss[0]->description); ?>　东视大厦 <?php echo delhtml($ds[0]->description); ?>　广播大厦　<?php echo delhtml($gb[0]->description); ?>　
		</div>-->
		<div id=p2>
 			<!-- start top_right_top !-->
  		<?php
				$sql = 'select n.*,n.id as news_id,n.description as news_description,c.*,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="大头条" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 1';
				$record_head=$db -> query($sql);
			?>
			<div id=t_r_t>
 				<div id=title><a   href="<?php echo "/".$record_head[0]->platform."/news/news_head.php?id=".$record_head[0]->news_id ?>" target="_blank"><?php echo $record_head[0]->short_title ?></a><?php echo show_video($record_head[0]->video_flag,40,35)?><?php echo show_img($record_head[0]->image_flag,40,35)?></div>
 				<a   href="/news/news_list.php?id=<?php echo $record_head[0]->cid; ?>" id=btn target=_blank></a>
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
									if(date("Y-m-d")!="2010-04-21"){
										echo '[<a href="'.$record_sub_news[0]->platform.'/news/news_head.php?id='.$record_sub_news[0]->news_id.'" target=_blank>'.$record_sub_news[0]->short_title.'</a>]';
									}
									else
									{
										echo '[<a style="color:#000000;" href="'.$record_sub_news[0]->platform.'/news/news_head.php?id='.$record_sub_news[0]->news_id.'" target=_blank>'.$record_sub_news[0]->short_title.'</a>]';	
									}
							}		

					}	
				?>
 				</div>

 			</div>
 			<!-- end !-->
		</div>

		<div id=p3>
 			<!-- start top_right_center_top !-->
 			<!--<div id=t_r_c_t>
 				<div id=left><a   target="_blank" href="subject/xyy2/"><img border=0 src="images/xyy2_logo.gif"></a></div>
 				<div id=right><?php
						$sql = 'select n.*,n.id as news_id,n.sub_news_id,n.description as news_description,c.* from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="小头条" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 2 ';
						$record_head=$db -> query($sql);
						for($j=0;$j<=1;$j++){
					?>
	 				<div class=title><a   href="<?php echo "/".$record_head[$j]->platform."/news/news_head.php?id=".$record_head[$j]->news_id ?>" target="_blank"><?php echo $record_head[$j]->short_title ?></a><?php echo show_video($record_head[$j]->video_flag,22,20)?><?php echo show_img($record_head[$j]->image_flag,22,20)?></div>
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
	
										echo '[<a   href="'.$record_sub_news[$i]->platform.'/news/news_head.php?id='.$record_sub_news[$i]->news_id.'" target=_blank>'.$record_sub_news[$i]->short_title.'</a>]';
								}		
								/*
								echo "<br>";
								for($i=3;$i<=$sub_news_str_num;$i++)
								{
									  if($i>5){break;}
										$sql="select n.*,n.id as news_id,c.* from smg_news n left join smg_category c on n.category_id=c.id where n.id=".$sub_news_str[$i];
										$record_sub_news = $db -> query($sql);
										echo '[<a   href="'.$record_sub_news[$i]->platform.'/news/news_head.php?id='.$record_sub_news[$i]->news_id.'" target=_blank>'.$record_sub_news[$i]->short_title.'</a>]';
								}	
								*/	
						}	
					?>					
					</div>
					
					<? }?>
 			</div>-->
 			<div id=t_r_c_t>
	 				<?php
						$sql = 'select n.*,n.id as news_id,n.sub_news_id,n.description as news_description,c.* from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="小头条" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 2 ';
						$record_head=$db -> query($sql);
						for($j=0;$j<=1;$j++){
					?>
	 				<div class=title><a   href="<?php echo "/".$record_head[$j]->platform."/news/news_head.php?id=".$record_head[$j]->news_id ?>" target="_blank"><?php echo $record_head[$j]->short_title ?></a><?php echo show_video($record_head[$j]->video_flag,22,20)?><?php echo show_img($record_head[$j]->image_flag,22,20)?></div>
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
										 if(date("Y-m-d")=="2010-04-21")
										 {
												echo '[<a style="color:#000000;" href="'.$record_sub_news[$i]->platform.'/news/news_head.php?id='.$record_sub_news[$i]->news_id.'" target=_blank>'.$record_sub_news[$i]->short_title.'</a>]';
										 }
										 else
										 {
										 		echo '[<a href="'.$record_sub_news[$i]->platform.'/news/news_head.php?id='.$record_sub_news[$i]->news_id.'" target=_blank>'.$record_sub_news[$i]->short_title.'</a>]';
										 }
								}		
								/*
								echo "<br>";
								for($i=3;$i<=$sub_news_str_num;$i++)
								{
									  if($i>5){break;}
										$sql="select n.*,n.id as news_id,c.* from smg_news n left join smg_category c on n.category_id=c.id where n.id=".$sub_news_str[$i];
										$record_sub_news = $db -> query($sql);
										echo '[<a   href="'.$record_sub_news[$i]->platform.'/news/news_head.php?id='.$record_sub_news[$i]->news_id.'" target=_blank>'.$record_sub_news[$i]->short_title.'</a>]';
								}	
								*/	
						}	
					?>					
					</div>
					
					<? }?>
 			</div>
 			<!-- end !-->
			
 			<!-- start top_right_center_middle !-->
 			<div id=t_r_c_m >
 				<a href="/news/news_list.php?id=23" target="_blank" id=title></a>
  			<?php
					$sql = 'select n.short_title,c.platform,n.id  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="重点关注-头" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 2 ';
					$record_import=$db -> query($sql);
					$sql='select * from smg_zhibo_ctrl';
					$zhibo=$db->query($sql);
					$zb='select target_url from smg_news where category_id=209 and is_adopt=1 order by priority asc ,created_at desc limit 1'
				?>		
				<div id=content1 <?php if($zhibo[0]->state==0){?>style="width:350px;"<?php } ?> ><a href="<?php echo "/".$record_import[0]->platform."/news/news.php?id=".$record_import[0]->id ?>" target="_blank"><?php echo $record_import[0]->short_title; ?></a>　<?php if($zhibo[0]->state==0){ ?><a href="<?php echo "/".$record_import[1]->platform."/news/news.php?id=".$record_import[1]->id ?>" target="_blank"><?php echo $record_import[1]->short_title; ?></a><? }?></div>
 				<?php if(($today>='2010-04-30 08:00:00'&&$today<='2010-04-30 21:00:00')||($today>='2010-05-01 08:00:00'&&$today<='2010-05-01 21:00:00')||($today>='2010-05-02 08:00:00'&&$today<='2010-05-02 21:00:00')){  ?><a target="_blank" href="mms://218.78.215.67/fanqie_dfws"><img style="margin-top:7px;" border=0 src="images/index/zb.gif" /></a><?php }if($zhibo[0]->state==1){ ?><a href="/subject/zhibo/" id=btn ></a><?php } else{?><!--<a   target="_blank" style="margin-top:10px; margin-left:10px; font-weight:bold; line-height:20px; color:red; text-decoration:underline; float:left; display:inline;" href="/news/news/news.php?id=28775">献血报名</a>--><?php } ?>
 				<?php

					$sql = 'select * from smg_news_show;';
					$record=$db -> query($sql); 				
					$days=$record[0]->days;
 					if($record[0]->days==0)
 					{	
 						$sql = 'select n.short_title,n.title,c.platform,n.id,n.image_flag,n.video_flag,n.created_at from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.id = 222 and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 12';
 						$sql1 = 'select n.short_title,n.title,c.platform,n.id,n.image_flag,n.video_flag,n.created_at from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.id = 223 and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 12';
 					}
 					else
 					{ 
 						$sql = 'select n.short_title,n.title,c.platform,n.id,n.image_flag,n.video_flag,n.created_at from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.id =222 and c.platform="news" and TO_DAYS(NOW())-TO_DAYS(n.created_at) <= '.$record[0]->days.'  order by n.click_count desc,n.created_at desc limit 11';
 						$sql1 = 'select n.short_title,n.title,c.platform,n.id,n.image_flag,n.video_flag,n.created_at from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.id =223 and c.platform="news" and TO_DAYS(NOW())-TO_DAYS(n.created_at) <= '.$record[0]->days.'  order by n.click_count desc,n.created_at desc limit 11';
 					}
					$record_import_a=$db -> query($sql);
					$record_import_a1=$db -> query($sql1);
					$sql = 'select n.photo_src,c.platform,c.id as cid,n.id,n.short_title from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="重点关注-图" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 6';
					$record_import_b=$db -> query($sql);
					$sql = 'select n.short_title, c.platform,n.id,n.image_flag,n.video_flag from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="重点关注-专" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 2';
					$record_import_c=$db -> query($sql);
					$sql='select n.short_title, c.id as cid,n.id,n.image_flag,n.video_flag from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="改革发展调研" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 2';
					$record_import_d=$db->query($sql);
					$sql="SELECT subject,tid,lastpost,author FROM bbs_threads where fid=75 order by lastpost desc limit 5";
					$bbs=$db->query($sql);
				?>	
 				<div id=box>
 					<div id="wxh_subject">
 						<?php
							$sql = 'select n.*,n.id as news_id,n.description as news_description,c.*,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="暑期宣传" and c.platform="news" and is_recommend=1 order by n.priority asc,n.created_at desc limit 4';
							$record_sub_news=$db -> query($sql);
						?>
 						<div id=wxh_title><a href="<?php echo "/".$record_sub_news[0]->platform."/news/news_head.php?id=".$record_sub_news[0]->news_id ?>" target="_blank"><?php echo delhtml($record_sub_news[0]->short_title); ?></a></div>
		 				<div id=wxh_content>
		 				<?php
	
									for($i=1;$i< count($record_sub_news);$i++)
									{
											if($i<(count($record_sub_news)-1))
											{
												if(date("Y-m-d")=="2010-04-21")
												{
													echo '[<a style="color:#000000;" href="'.$record_sub_news[$i]->platform.'/news/news_head.php?id='.$record_sub_news[$i]->news_id.'" target=_blank>'.$record_sub_news[$i]->short_title.'</a>]';
												}
												else
												{
													echo '[<a href="'.$record_sub_news[$i]->platform.'/news/news_head.php?id='.$record_sub_news[$i]->news_id.'" target=_blank>'.$record_sub_news[$i]->short_title.'</a>]';
												}
											}
											else
											{
												if(date("Y-m-d")=="2010-04-21")
												{
													echo '[<a style="color:#000000;" href="'.$record_sub_news[$i]->platform.'/news/news_head.php?id='.$record_sub_news[$i]->news_id.'" target=_blank>'.$record_sub_news[$i]->short_title.'</a>]<a  style="color:#000000; margin-left:2px;" target="_blank" href="/news/news_list.php?id='.$record_sub_news[$i]->cid.'">更多</a>';	
												}
												else
												{
													echo '[<a href="'.$record_sub_news[$i]->platform.'/news/news_head.php?id='.$record_sub_news[$i]->news_id.'" target=_blank>'.$record_sub_news[$i]->short_title.'</a>]<a  style="color:#ff0000; margin-left:2px;" target="_blank" href="http://172.27.203.81:8080/bbs/viewthread.php?tid=2921&extra=">参与讨论</a><a  style="color:#ff6600; margin-left:2px;" target="_blank" href="/news/news_list.php?id='.$record_sub_news[$i]->cid.'">更多</a>';		
												}
											}
									}		
						?>
		 				</div>
 					</div>
 					<div id=l>
 						<div class=title><a target="_blank" href="/news/news_list.php?id=222">重要新闻</a></div>
 						<div class=content>
	 						<ul>
	 						 <?php for($i=0; $i<count($record_import_a); $i++){?>
	 							<li <?php if($record_import_a[$i]->image_flag||$record_import_a[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a[$i]->image_flag)?><?php show_video2($record_import_a[$i]->video_flag)?></div>
	 								<div <?php  if($record_import_a[$i]->image_flag==1||$record_import_a[$i]->video_flag==1){?>style="height:18px; line-height:18px; overflow:hidden; float:left; display:inline;"<?php } ?>><? if($record_import_a[$i]->video_flag!=1){ ?><a   <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news.php?id=".$record_import_a[$i]->id ?>" target="_blank" ><?php }else{ ?><a   <? news_date($record_import_a[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a[$i]->platform."/news/news_video.php?id=".$record_import_a[$i]->id ?>" target="_blank" ><?php } ?><?php if($record_import_a[$i]->image_flag==0 && $record_import_a[$i]->video_flag==0){ ?>.<?php } ?><?php echo get_fck_content($record_import_a[$i]->short_title); ?></a></div></li>
	             <? }?>
	 						</ul>
	 						
						</div>	
 					</div>	
 					
 					<div id=c>
 						<div id=c_title><a target="_blank" href="/news/news_list.php?id=223">最新新闻</a></div>
 						<div id=c_content>
	 						<ul>
	 						 <?php for($i=0; $i<count($record_import_a1); $i++){?>
	 							<li <?php if($record_import_a1[$i]->image_flag||$record_import_a1[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($record_import_a1[$i]->image_flag)?><?php show_video2($record_import_a1[$i]->video_flag)?></div><div <?php  if($record_import_a1[$i]->image_flag==1||$record_import_a1[$i]->video_flag==1){?>style=" height:18px; line-height:18px; overflow:hidden; float:left; display:inline;"<?php } ?>><? if($record_import_a1[$i]->video_flag!=1){ ?><a   <? news_date($record_import_a1[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a1[$i]->platform."/news/news.php?id=".$record_import_a1[$i]->id ?>" target="_blank" ><?php }else{ ?><a   <? news_date($record_import_a1[$i]->created_at,$days)?> href="<?php echo "/".$record_import_a1[$i]->platform."/news/news_video.php?id=".$record_import_a1[$i]->id ?>" target="_blank" ><?php } ?><?php if($record_import_a1[$i]->image_flag==0 && $record_import_a1[$i]->video_flag==0){ ?>.<?php } ?><?php echo $record_import_a1[$i]->short_title ?></a></div></li>
	             <? }?>
	 						</ul>
						</div>
 					</div>	 
 					
 					<div id=r>
 						<div class=title><a target="_blank" href="/news/news_list.php?id=33">广而告之</a></div>
 						<?php
							$sql = 'select n.short_title, c.platform,n.id as news_id,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="广而告之" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 6';
							$gegz=$db -> query($sql);
						?>
 						<div class=content>
 							<div class=r_content_t>
	 							<ul>
		 						 <?php for($i=0; $i<count($gegz); $i++){?>
		 							<li <?php if($gegz[$i]->image_flag||$gegz[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($gegz[$i]->image_flag)?><?php show_video2($gegz[$i]->video_flag)?></div><div <?php  if($gegz[$i]->image_flag==1||$gegz[$i]->video_flag==1){?>style="width:142px; height:18px; line-height:18px; overflow:hidden; float:left; display:inline;"<?php } ?>><? if($gegz[$i]->video_flag!=1){ ?><a   <? news_date($gegz[$i]->created_at,$days)?> href="<?php echo "/".$gegz[$i]->platform."/news/news.php?id=".$gegz[$i]->news_id ?>" target="_blank" ><?php }else{ ?><a   <? news_date($gegz[$i]->created_at,$days)?> href="<?php echo "/".$gegz[$i]->platform."/news/news_video.php?id=".$gegz[$i]->news_id ?>" target="_blank" ><?php } ?><?php if($gegz[$i]->image_flag==0 && $gegz[$i]->video_flag==0){ ?>.<?php } ?><?php echo $gegz[$i]->short_title ?></a></div></li>
		             <? }?>
		 						</ul>
		 					</div>
		 					<?php 
							 $sql='select n.short_title, c.platform, n.id as news_id,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="小编视点" and c.platform="news"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 6';
							 $xbjj=$db->query($sql);
							?>
	 						<div class=title style="width:112px; margin-top:4px; background:url('/images/index/jt.jpg') no-repeat; border-top:1px dashed #666666; overflow:hidden;"><a target="_blank" href="/news/news_list.php?id=227">小编加精</a></div>
	 						<div class=r_content_t>
	 							<ul>
		 						 <?php for($i=0; $i<count($xbjj); $i++){?>
		 							<li <?php if($xbjj[$i]->image_flag||$xbjj[$i]->video_flag==1){echo 'style="background:none; padding:0px;" ';}?>><div><?php show_img2($xbjj[$i]->image_flag)?><?php show_video2($xbjj[$i]->video_flag)?></div><div <?php  if($xbjj[$i]->image_flag==1||$xbjj[$i]->video_flag==1){?>style="width:142px; height:18px; line-height:18px; overflow:hidden; float:left; display:inline;"<?php } ?>><? if($xbjj[$i]->video_flag!=1){ ?><a   <? news_date($xbjj[$i]->created_at,$days)?> href="<?php echo "/".$xbjj[$i]->platform."/news/news.php?id=".$xbjj[$i]->news_id ?>" target="_blank" ><?php }else{ ?><a   <? news_date($xbjj[$i]->created_at,$days)?> href="<?php echo "/".$xbjj[$i]->platform."/news/news_video.php?id=".$xbjj[$i]->news_id ?>" target="_blank" ><?php } ?><?php if($xbjj[$i]->image_flag==0 && $xbjj[$i]->video_flag==0){ ?>.<?php } ?><?php echo $xbjj[$i]->short_title ?></a></div></li>
		             <? }?>
		 						</ul>
		 					</div>
	 					</div>		
 					</div>	 				
 				</div>
 				<div id=b>
	 				<div class="content">
							<a href="/news/abld_list.php" target=_blank><img src="/images/4.jpg" width="125" border=0></a>
							<a style="width:160px; height:15px; line-height:15px; text-decoration:none; color:#000000; overflow:hidden; float:left; display:inline;" href="/news/abld_list.php" target="_blank">双月劳动竞赛</a>
	 				</div>
	 				<div class="content">
							<a href="/subject/djnews/" target=_blank><img src="/images/2.jpg" width="125px; height:20px;" border=0></a>
							<a style="width:160px; height:15px; line-height:15px; text-decoration:none; color:#000000; overflow:hidden; float:left; display:inline;" href="<?php echo "/".$record_import_c[1]->platform."/news/news.php?id=".$record_import_c[1]->id ?>" target="_blank"><?php echo $record_import_c[1]->short_title ?></a>
	 				</div>
	 				<div class="content">
						<a href="/subject/sxxx2/" target=_blank><img src="/images/1.jpg" width="125px; height:20px;" border=0></a>
						<a style="width:160px; height:15px; line-height:15px; text-decoration:none; color:#000000; overflow:hidden; float:left; display:inline;" href="<?php echo "/".$record_import_c[0]->platform."/news/news.php?id=".$record_import_c[0]->id ?>" target="_blank"><?php echo $record_import_c[0]->short_title ?></a>
					</div>
				</div>
 			</div>
 			<!-- end !-->
		

 			<!-- start top_right_center_bottom_left !-->
 			<div id=t_r_c_b_l>
 				<iframe src="index_report.html" frameborder=0 scrolling="no" ></iframe>
 			</div>
 			<!-- end !-->
 			<?php 
 				$today=date("Y-m-d",time())." 23:59:59";
 				$lastyesterday=date("Y-m-d",strtotime("-2 day"))." 00:00:00";
 				$sql="select count(*) as num from smg_news n left join smg_category c on n.category_id=c.id where c.name='视听观察周刊' and category_type='news' and n.created_at>='".$lastyesterday."' and n.created_at<='".$today."' order by n.created_at desc";
 				$stgc=$db->query($sql);
 				$sql="select count(*) as num from smg_news n left join smg_category c on n.category_id=c.id where c.name='节目观察周刊' and category_type='news' and n.created_at>='".$lastyesterday."' and n.created_at<='".$today."' order by n.created_at desc";
 				$jmgc=$db->query($sql);
 				$sql="select count(*) as num from smg_news n left join smg_category c on n.category_id=c.id where c.name='传媒观察周刊' and category_type='news' and n.created_at>='".$lastyesterday."' and n.created_at<='".$today."' order by n.created_at desc";
 				$cmgc=$db->query($sql);
 				$sql="select count(*) as num from smg_news n left join smg_category c on n.category_id=c.id where c.name='发展研究专报' and category_type='news' and n.created_at>='".$lastyesterday."' and n.created_at<='".$today."' order by n.created_at desc";
 				$fzyjzb=$db->query($sql);
 			?>
			<div id=t_r_c_b_c>
				<div id="title"><img src="/images/index/fzyjbb.jpg"></div>
				<div class="cl"><a   target="_blank" <?php if((int)$stgc[0]->num > 0){ ?>style="color:red;"<?php } ?> href="/news/news_list.php?id=133">视听观察周刊</a></div>
				<div class="cl"><a   target="_blank" <?php if((int)$jmgc[0]->num > 0){ ?>style="color:red;"<?php } ?> href="/news/news_list.php?id=134">节目观察周刊</a></div>
				<div class="cl"><a   target="_blank" <?php if((int)$cmgc[0]->num > 0){ ?>style="color:red;"<?php } ?> href="/news/news_list.php?id=135">传媒观察周刊</a></div>
				<div class="cl"><a   target="_blank" <?php if((int)$fzyjzb[0]->num > 0){ ?>style="color:red;"<?php } ?> href="/news/news_list.php?id=136">发展研究专报</a></div>
				<div class="cl"><a target="_blank" href="/news/news_list.php?id=217">广电科技信息</a></div>
				<a   target="_blank" href="/news/newscenter_list.php" style="margin-top:5px;"><img border=0 width=90 height=30 src="images/34.jpg"></a>
			</div>
			

 			<!-- start top_right_center_bottom_right !-->
  		
			<div id=t_r_c_b_r>
				<?php
				$sql = 'select n.id,n.short_title,n.category_id,c.platform,c.id as cid  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="业界动态" and c.platform="server"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 20';
				$record_out=$db -> query($sql);
				 ?>
				 <div id=title></div><div id=more><a   target="_blank" href="news/news_list.php?id=<?php echo $record_out[0]->cid; ?>"><img border=0 src="images/index/more1.gif"></a></div>
				<div class=box1 style="height:60px; margin-top:10px;">
					<ul>
						<marquee height="50" width=100% DIRECTION="up" scrollamount="1" onmouseover=this.stop() onmouseout=this.start()>
						<?php for($i=0;$i<count($record_out);$i++){ ?>
							<li><a  style="margin-top:5px; margin-right:5px; text-decoration:none;" target="_blank" href="/server/news/news.php?id=<?php echo $record_out[$i]->id; ?>"><?php echo $record_out[$i]->short_title; ?></a></li>
						<?php } ?>
						</marquee>
					</ul>
				</div>
					<!--<div id=title></div>
					<a   href="/news/news_list.php?id=64" id=more target=_blank></a>-->
					<div class=box1 style="margin-top:5px;">
						<a   target="_blank" href="/sslfx/"><img border=0 src="/images/index/rating_logo.jpg"></a><br>
						<ul>
							<li><a   style="margin-top:5px; margin-right:5px; color:red; font-weight:bold; text-decoration:none;" target="_blank" href="/news/news_list.php?id=64">更多番茄工具</a></li>
						</ul>
					</div>
					<!--<div id=box2>
						<ul>
							<li>·<a   style="color:red; font-weight:bold;" target="_blank" href="/sslfx/">电视节目收视定量分析工具</a></li>
							<li>·<a   target="_blank" href="/server/news/news.php?id=12302">员工自助系统</a></li>
							<li>·<a   target="_blank" href="/server/news/news.php?id=12312">人力资源部常用表格</a></li>
							<li>·<a   target="_blank" href="/server/news/news.php?id=12310">办公室常用表格</a></li>
						</ul>						
					</div>-->
 			</div>
 			<!-- end !-->
		
		</div>
		<div id=p4>
 			<!-- start top_right_right_top !-->
 			<div id=t_r_r_t>
 				<div class=menu_trrt id=menu_trrt1 param=1 style="background:url(/images/index/btn7.jpg) no-repeat; font-weight:bold;"><a   style="color:#ff0000" href="/fqtg/fqtglist.php" target=_blank>我要团购</a></div>
 				<div class=menu_trrt id=menu_trrt2 param=2 style="background:url(/images/index/btn8.jpg) no-repeat;  margin-left:6px;"><a   href="/news/news_list.php?id=30" target=_blank>快乐番茄</a></div>
 				<div class=menu_trrt id=menu_trrt3 param=3 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:5px;" ><a   style="color:#ff0000" href="/zone/" target=_blank>番茄百家</a></div>
 				<?php
 						$sql = 'select * from smg_tg where isadopt=1 order by priority asc,createtime desc limit 9';
						$record_tg=$db -> query($sql);
						$sql="select * from smg_fhtg where is_adopt=1 and show_index=1 order by priority asc,created_at desc limit 3";
						$fhtg=$db->query($sql);
					?>
				<div class=tg_content id=content_trrt1>
	 				<div class=content_trrt id=content_trrt10>
						<?php if(count($fhtg)==0){ 
							 for($i=0;$i<3;$i++){?>
						<div class=box style="margin-bottom:10px;">
							<a   href="/fqtg/fqtglist.php" target=_blank><img src="<?php echo $record_tg[$i]->photourl; ?>" target=_blank border=0></a>
							<ul>
								<li style="width:95px; overflow:hidden;"><a   href="/fqtg/fqtglist.php" target=_blank><?php echo $record_tg[$i]->title ?></a></li>
								<li style="width:95px; height:30px; line-height:15px; color:#A1A0A0; overflow:hidden;"><?php echo strip_tags($record_tg[$i]->content);?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#BD0A01; text-decoration:line-through">市场价：<?php echo $record_tg[$i]->marketprice ?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#ff0000">番茄价：<?php echo $record_tg[$i]->price ?></li>
							</ul>
						</div>
						<? }}else{?>
						<?php for($i=0;$i<2;$i++){?>
						<div class=box style="margin-bottom:5px;">
							<a   href="/fqtg/fqtglist.php" target=_blank><img src="<?php echo $record_tg[$i]->photourl; ?>" target=_blank border=0></a>
							<ul>
								<li style="width:95px; overflow:hidden;"><a   href="/fqtg/fqtglist.php" target=_blank><?php echo $record_tg[$i]->title ?></a></li>
								<li style="width:95px; height:30px; line-height:15px; color:#A1A0A0; overflow:hidden;"><?php echo strip_tags($record_tg[$i]->content);?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#BD0A01; text-decoration:line-through">市场价：<?php echo $record_tg[$i]->marketprice ?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#ff0000">番茄价：<?php echo $record_tg[$i]->price ?></li>
							</ul>
						</div>
						<?php }?>
						<div class=box style="margin-bottom:5px;">
							<a   href="/fqtg/fqtglist.php" target=_blank><img src="<?php echo $fhtg[0]->src; ?>" target=_blank border=0></a>
							<ul>
								<li style="width:95px; overflow:hidden;"><a   href="/fqtg/fqtglist.php" target=_blank><?php echo $fhtg[0]->title ?></a></li>
								<li style="width:95px; height:30px; line-height:15px; color:#A1A0A0; overflow:hidden;"><?php echo strip_tags($fhtg[0]->content);?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#BD0A01; text-decoration:line-through">市场价：<?php echo $fhtg[0]->marketprice ?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#ff0000">番茄价：<?php echo $fhtg[0]->price ?></li>
							</ul>
						</div>
						<?php }?>
						<!--<a   target="_blank" href="subject/xyy2/pkend.php"><img border=0 width=180 height=122 src="images/xyy2.gif"></a>-->
	 				</div>
	 				<div class=content_trrt id=content_trrt11 style="display:none;">
						<?php if(count($fhtg)<2){ 
							 for($i=3;$i<6;$i++){?>
						<div class=box style="margin-bottom:10px;">
							<a   href="/fqtg/fqtglist.php" target=_blank><img src="<?php echo $record_tg[$i]->photourl; ?>" target=_blank border=0></a>
							<ul>
								<li style="width:95px; overflow:hidden;"><a   href="/fqtg/fqtglist.php" target=_blank><?php echo $record_tg[$i]->title ?></a></li>
								<li style="width:95px; height:30px; line-height:15px; color:#A1A0A0; overflow:hidden;"><?php echo strip_tags($record_tg[$i]->content);?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#BD0A01; text-decoration:line-through">市场价：<?php echo $record_tg[$i]->marketprice ?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#ff0000">番茄价：<?php echo $record_tg[$i]->price ?></li>
							</ul>
						</div>
						<? }}else{?>
						<?php for($i=2;$i<4;$i++){?>
						<div class=box style="margin-bottom:5px;">
							<a   href="/fqtg/fqtglist.php" target=_blank><img src="<?php echo $record_tg[$i]->photourl; ?>" target=_blank border=0></a>
							<ul>
								<li style="width:95px; overflow:hidden;"><a   href="/fqtg/fqtglist.php" target=_blank><?php echo $record_tg[$i]->title ?></a></li>
								<li style="width:95px; height:30px; line-height:15px; color:#A1A0A0; overflow:hidden;"><?php echo strip_tags($record_tg[$i]->content);?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#BD0A01; text-decoration:line-through">市场价：<?php echo $record_tg[$i]->marketprice ?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#ff0000">番茄价：<?php echo $record_tg[$i]->price ?></li>
							</ul>
						</div>
						<?php }?>
						<div class=box style="margin-bottom:5px;">
							<a   href="/fqtg/fqtglist.php" target=_blank><img src="<?php echo $fhtg[1]->src; ?>" target=_blank border=0></a>
							<ul>
								<li style="width:95px; overflow:hidden;"><a   href="/fqtg/fqtglist.php" target=_blank><?php echo $fhtg[1]->title ?></a></li>
								<li style="width:95px; height:30px; line-height:15px; color:#A1A0A0; overflow:hidden;"><?php echo strip_tags($fhtg[1]->content);?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#BD0A01; text-decoration:line-through">市场价：<?php echo $fhtg[1]->marketprice ?></li>
								<li style="width:95px; height:15px; line-height:15px; color:#ff0000">番茄价：<?php echo $fhtg[1]->price ?></li>
							</ul>
						</div>
						<?php }?>
						<!--<a   target="_blank" href="subject/xyy2/pkend.php"><img border=0 width=180 height=122 src="images/xyy2.gif"></a>-->
	 				</div>
	 			</div>
 				<?php
 					$sql = 'select n.short_title,n.id as news_id,c.platform from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="快乐番茄" and c.platform="server" order by n.priority asc,n.created_at desc limit 12';
					$record_happy=$db -> query($sql);		
				?>	
 				<div class=content_trrt id=content_trrt2 style="display:none;">
 					<div class=box>
						<ul>
							<?php for($i=0;$i<4;$i++){?>
							<li >·<a   href="/<?php echo $record_happy[$i]->platform?>/news/news.php?id=<?php echo $record_happy[$i]->news_id?>" target=_blank><?php echo $record_happy[$i]->short_title ?></a></li>
							<? }?>
						</ul>
					</div>
					<div class=box>
						<ul>
							<?php for($i=4;$i<8;$i++){?>
							<li >·<a   href="/<?php echo $record_happy[$i]->platform?>/news/news.php?id=<?php echo $record_happy[$i]->news_id?>" target=_blank><?php echo $record_happy[$i]->short_title ?></a></li>
							<? }?>
						</ul>
					</div>
					<div class=box style="height:108px;">
						<ul>
							<?php for($i=8;$i<count($record_happy);$i++){?>
							<li >·<a   href="/<?php echo $record_happy[$i]->platform?>/news/news.php?id=<?php echo $record_happy[$i]->news_id?>" target=_blank><?php echo $record_happy[$i]->short_title ?></a></li>
							<? }?>
						</ul>
					</div> 				
 				</div>
 				<div class=content_trrt id=content_trrt3 style="display:none;">
 					<div class=box>
						<ul>
							<?php
								$sql = 'select n.short_title,n.id as news_id,c.platform  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="博客" and c.platform="zone"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 4';
								$record_discuss=$db -> query($sql);	
								for($i=0;$i<4;$i++){?>
							<li >·<a   href="/<?php echo $record_discuss[$i]->platform?>/news/news.php?id=<?php echo $record_discuss[$i]->news_id?>" target=_blank><?php echo $record_discuss[$i]->short_title ?></a></li>
							<? }?>
							<!--<?php 
								$sql = 'select n.short_title,n.id as news_id,c.platform  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="上班这点事" and c.platform="zone" order by n.priority asc,n.created_at desc limit 2';
								$record_discuss=$db -> query($sql);	
								for($i=0;$i<2;$i++){?>
							<li >·<a   href="/<?php echo $record_discuss[$i]->platform?>/news/news.php?id=<?php echo $record_discuss[$i]->news_id?>" target=_blank><?php echo $record_discuss[$i]->short_title ?></a></li>
							<? }?>-->
						</ul>
					</div>
					<div class=box>
						<ul>
							<?php
								$sql = 'select n.short_title,n.id as news_id,c.platform  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="博客" and c.platform="zone"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 4,4';
								$record_discuss=$db -> query($sql);	
								for($i=0;$i<4;$i++){?>
							<li >·<a   href="/<?php echo $record_discuss[$i]->platform;?>/news/news.php?id=<?php echo $record_discuss[$i]->news_id?>" target=_blank><?php echo $record_discuss[$i]->short_title ?></a></li>
							<? }?>
							<!--<?php 
								$sql = 'select n.short_title,n.id as news_id,c.platform  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="观点视角" and c.platform="zone" order by n.priority asc,n.created_at desc limit 3';
								$record_discuss=$db -> query($sql);	
								for($i=0;$i<2;$i++){?>
							<li >·<a   href="/<?php echo $record_discuss[$i]->platform?>/news/news.php?id=<?php echo $record_discuss[$i]->news_id?>" target=_blank><?php echo $record_discuss[$i]->short_title ?></a></li>
							<? }?>-->
						</ul>
					</div>
					<div class=box style="height:108px;">
						<ul>
							<!--<li >·<a   href="/<?php echo $record_discuss[2]->platform?>/news/news.php?id=<?php echo $record_discuss[2]->news_id?>" target=_blank><?php echo $record_discuss[2]->short_title ?></a></li>-->
							<?php
								//$sql = 'select n.short_title,n.id as news_id,c.platform  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="分享生活" and c.platform="zone" order by n.priority asc,n.created_at desc limit 3';
								$sql='select n.id as news_id,n.short_title,n.tags,c.platform,c.name from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="番茄专栏" and c.platform="zone"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 4';
								$record_discuss=$db -> query($sql);	
								for($i=0;$i<count($record_discuss);$i++){?>
							<li >·<font color="#000000">[<?php echo $record_discuss[$i]->tags ?>]</font><a   href="/<?php echo $record_discuss[$i]->platform?>/news/news.php?id=<?php echo $record_discuss[$i]->news_id?>" target=_blank><?php echo $record_discuss[$i]->short_title ?></a></li>
							<? }?>
						</ul>
					</div> 	 				
 				</div>
 				
 				
 			</div>
 			<!-- end !-->			
 			<!-- start top_right_right_middle !-->
  		<div id=t_r_r_m>
  			<?php $sql = 'select n.id as news_id, n.photo_src,n.short_title,c.platform,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="番茄声音" and c.platform="zone"  and is_recommend=1 order by n.priority asc,n.created_at desc';
						$record_industry=$db -> query($sql); ?>
 				<div class=btn_tlm param=1 id=btn_tlm_1 style="margin-left:20px;background:url(/images/index/btn4.jpg) no-repeat"><a   href="/news/news_list.php?id=<?php echo $record_industry[0]->cid?>" target=_blank>番茄声音</a></div>
 				<div class=btn_tlm id=btn_tlm_1 style="width:67px; height:19px; background:url(/images/index/btn4a.jpg) no-repeat"><a   target="_blank" href="/bbs/forumdisplay.php?fid=16" target=_blank>发声音</a></div>
 				<div class=list_tlm id=list_tlm1 style="display:inline;">
 					<ul>
 						<?php
 						
 						 for($i=0; $i<count($record_industry); $i++){?>
 						<li><div style="width:200px; height:20px; line-height:20px; float:left; display:inline;"><span style="color:#CCCCCC">·</span><a   title="<?php echo delhtml($record_industry[$i]->short_title); ?>" href="/<?php echo $record_industry[$i]->platform ?>/news/news.php?id=<?php echo $record_industry[$i]->news_id ?>" target=_blank><?php echo $record_industry[$i]->short_title ?></a></div></li>
 						<? }?>
 				  </ul>
 				</div>
 				<!--<div class=list_tlm id=list_tlm2>
 					<ul>
 						<?php for($i=0; $i<count($record_out); $i++){?>
 						<li><div style="width:200px; height:20px; line-height:20px; float:left; display:inline;"><span style="color:#CCCCCC">·</span><a   title="<?php echo delhtml($record_out[$i]->short_title); ?>" href="/<?php echo $record_out[$i]->platform ?>/news/news.php?id=<?php echo $record_out[$i]->id ?>" target=_blank><?php echo $record_out[$i]->short_title ?></a></div></li>
 						<? }?>
 				  </ul>
 				</div>-->
 			</div>
 			<!-- end !-->						

 			<!-- start top_right_right_bottom !-->
 			<?php
 					$sql = 'select n.short_title,n.id as news_id,c.* from smg_news n left join smg_category c on n.category_id=c.id  where TO_DAYS(NOW())-TO_DAYS(n.last_edited_at) <= 7 and n.is_adopt=1 order by n.click_count desc limit 10';
					$record_news=$db -> query($sql);
					$sql='select id,short_title,platform from smg_news where category_id=216 and is_adopt=1 order by priority asc,created_at desc limit 10';
					$greentomato=$db -> query($sql);
					$sql="select id,short_title,platform from smg_news where category_id=218 and is_adopt=1 order by priority asc,created_at desc limit 10";
					$yyts=$db -> query($sql);	
			?>	 
 			<div id=t_r_r_b>
 				<div class=menu_trrb id=menu_trrb1 param=1 style="background:url(/images/index/btn7.jpg) no-repeat; margin-left:9px; font-weight:bold;"><a href="/news/news_list.php?id=216" target="_blank">绿番茄</a></div>
 				<div class=menu_trrb id=menu_trrb2 param=2 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:5px;"><a   href="/news/news_list.php?id=218" target="_blank">语音提示</a></div>
 				<div class=menu_trrb id=menu_trrb3 param=3 style="background:url(/images/index/btn8.jpg) no-repeat; margin-left:5px;"><a   href="/news/news_top_list.php" target="_blank">新闻排行</a></div>
				<div class=content_trrb id=content_trrb1 style="display:inline">
					<ul>
					<?php for($i=0;$i<count($greentomato);$i++){?>
						<li><a href="/<?php echo $greentomato[$i]->platform; ?>/news/news.php?id=<?php echo $greentomato[$i]->id ?>" <?php if($i<=2){?>  style="color:#E52520" <?php }?> target=_blank ><?php echo delhtml($greentomato[$i]->short_title); ?></a></li>
					<? }?>	
					</ul>
				</div>
				<div class=content_trrb id=content_trrb2>
					<ul>
					<?php for($i=0;$i<count($yyts);$i++){?>
						<li><a href="/<?php echo $yyts[$i]->platform ?>/news/news.php?id=<?php echo $yyts[$i]->id ?>"<?php if($i<=2){?>  style="color:#E52520" <?php }?> target=_blank ><?php echo delhtml($yyts[$i]->short_title); ?></a></li>
					<? }?>	
					</ul>
				</div>

				<div class=content_trrb id=content_trrb3>
					
					<ul>
					<?php for($i=0;$i<count($record_news);$i++){?>
						<li style="padding-left:12px; background:url('/images/number/<?php echo $i+1; ?>.jpg') 0 3px no-repeat;"><a href="/<?php echo $record_news[$i]->platform ?>/news/news.php?id=<?php echo $record_news[$i]->news_id ?>"<?php if($i<=2){?>  style="color:#E52520" <?php }?> target=_blank ><?php echo delhtml($record_news[$i]->short_title); ?></a></li>
					<? }?>	
					</ul>
				</div>
				<!--<div id=dyz><a target="_blank" href="news/news_list.php?id=218"><img border=0 src="images/index/dyz.jpg"></a></div>
				<div id=dyzcontent>
					<?php $sql = 'select id,short_title from smg_news where category_id=218 and is_adopt=1 order by priority asc,created_at desc';
					$dyz=$db -> query($sql); ?>
					<marquee direction="up" scrollamount="2" height=100% width=100% onmouseover=this.stop() onmouseout=this.start()>
						<?php for($i=0;$i<count($dyz);$i++){ ?>
							<div class=cl><a target="_blank" href="/news/news/news.php?id=<?php echo $dyz[$i]->id; ?>"><?php echo $dyz[$i]->short_title; ?></a></div>
						<?php } ?>
					</marquee>
				</div>-->
 			</div>
 			<!-- end !-->					
		</div>
				
 </div>
 <div id=ibody_line <?php if(date('Y-m-d')=="2010-04-01"){ ?>style="background:url('images/index/line1.jpg') no-repeat;"<?PHP } ?>></div>
 <div id=ibody_middle>
    <div id=p1>
  		<!-- start middle_left_top !-->
  		<?php
 					$sql = 'select n.id as news_id,n.description,n.short_title,c.id as cid from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="节目点评" and c.platform="show"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 6';
					$record_program=$db -> query($sql);
			?>	
			<div id=m_l_t>
 				<a   href="/show/list.php?type=news&id=<?php echo $record_program[0]->cid ?>"  target=_blank id=more></a>
 				<img src="/images/index/program.jpg">
				<div id=content_mlt>
					<li style="height:25px; line-height:25px; font-weight:bold; font-size:14px;" ><a   style="color:#FF6600;" href="/show/article.php?id=<?php echo $record_program[0]->news_id ?>" target=_blank><?php echo $record_program[0]->short_title ?></a></li>
					<?php for($i=1;$i<6;$i++){?>
					<li><a   href="/show/article.php?id=<?php echo $record_program[$i]->news_id ?>" target=_blank><?php echo $record_program[$i]->short_title ?></a></li>
					<? }?>
 				</div>
 			</div>
 			<!-- end !-->	   	
    
  		<!-- start middle_left_bottom !-->
 			<div id=m_l_b>
 				<div id=title>博 客</div>
 				<a   href="/zone/" id=more target=_blank></a>
 				<!--<?
  				$sql = 'select i.id as img_id,i.src,c.id as cid from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="首页博客" and c.platform="zone" order by i.priority asc limit 1';
					$record_blog=$db -> query($sql);	
				?>
 				<a   href="/show/show.php?id=<?php echo $record_blog[0]->img_id ?>" target=_blank><img src="<?php echo $record_blog[0]->src ?>" border=0></a>-->
 				<?php
 					$sql = 'select n.short_title,n.id as news_id,c.platform  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="博客" and c.platform="zone"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 6';
					$record_blog=$db -> query($sql);		
				?>	 
				<div class=content_mlb>
					<ul>
						<li style="color:#FF9900; font-weight:bold; font-size:13px; line-height:25px; height:25px;"><a   style="color:#FF9900" href="/<?php echo $record_blog[0]->platform ?>/news/news.php?id=<?php echo $record_blog[0]->news_id ?>" target=_blank>·<?php echo $record_blog[0]->short_title ?></a></li>
						<?php for($i=1;$i<6;$i++){ ?>
						<li><a   href="/<?php echo $record_blog[$i]->platform ?>/news/news.php?id=<?php echo $record_blog[$i]->news_id ?>" target=_blank>·<?php echo $record_blog[$i]->short_title ?></a></li>
						<? }?>
					</ul>
 				</div>
 				<div class=content_mlb>
 					<?php
 						$sql = 'select n.id as news_id,n.short_title,n.tags,c.platform,c.name from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="番茄专栏" and c.platform="zone"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 6';
						$record=$db -> query($sql);
  				?> 	
					<ul>
						<li style="color:#FF9900; font-weight:bold; font-size:13px; line-height:25px; height:25px;"><font color="#FF9900;">[<?php echo $record[0]->tags ?>]</font><a   style="color:#FF9900" href="/<?php echo $record[0]->platform?>/news/news.php?id=<?php echo $record[0]->news_id;?>" target=_blank><?php echo $record[0]->short_title;?></a></li>
						<?php for($i=1;$i<6;$i++){ ?>
						<li><font color="#000000">[<?php echo $record[$i]->tags ?>]</font><a   href="/<?php echo $record[$i]->platform?>/news/news.php?id=<?php echo $record[$i]->news_id;?>" target=_blank><?php echo $record[$i]->short_title;?></a></li>
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
 				<a   href="/show/show_index.php" id=more1 target=_blank></a>
 				<a   href="/show/list.php?type=news&id=<?php echo $record_dept[0]->cid?>" id=more2 target=_blank></a>

  			<div id=box1>
	  			<a   href="/show/show.php?id=<?php echo $record_show[0]->img_id?>" target=_blank><img src="<?php echo $record_show[0]->src ?>" border=0></a>
  				<ul>
  					<?php for($i=0;$i<5;$i++){?>
  					<li><a   href="/show/show.php?id=<?php echo $record_show[$i]->img_id?>" target=_blank><?php echo strip_tags($record_show[$i]->title)?></a></li>
  					<? }?>
   				</ul>
  			</div>
  			<div id=box2>

  				<ul>
  					<?php for($i=0;$i<=4;$i++){?>
  					<li><a   href="/show/article.php?id=<?php echo $record_dept[$i]->news_id?>" target=_blank><?php echo $record_dept[$i]->short_title?></a></li>
  					<? }?>
   				</ul> 			
  			</div>
 			</div>
 			<!-- end !-->	      	
    	
  		<!-- start middle_center_top !-->
 			<div id=m_c_b <?php if(date('Y-m-d')=="2010-04-01"){ ?>style="background:url('images/index/bg_m_c_b1.jpg') no-repeat;"<?php } ?>>
 				<a   href="/zone/video.php" id=more1 target=_blank></a>
 				<a   href="/zone/dialog_list.php" id=more2 target=_blank></a>
 				<div class=box>
   				<?php
 						$sql = 'select n.id as news_id,n.short_title,n.tags,c.platform,c.name from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="番茄专栏" and c.platform="zone"  and is_recommend=1 order by n.priority asc,n.created_at desc limit 5';
						$record=$db -> query($sql);
						$pic="select i.src,i.id,i.src2,i.url from smg_images i left join smg_category c on i.category_id=c.id where c.category_type='picture' and c.name='高清电影首页海报' order by i.priority asc,i.created_at desc";
						$photo=$db->query($pic);
						$sql = "select name,id from smg_vote where category_id=149 and is_adopt=1 and id=248 order by priority asc,created_at desc";
						$vote = $db->query($sql);
						$sql = "select tid,subject,uid from home_thread where tagid=8 order by tid desc limit 4";
						$qz = $db->query($sql);
						$sql="SELECT * FROM home_blog order by dateline desc limit 1";
						$homeblog=$db->query($sql);
						$sql="select tid,subject from bbs_threads where fid=72 and authorid!=0 order by tid desc limit 1";
						$bbs=$db->query($sql);
						$sql = "select tid,subject from bbs_threads where fid=70 and authorid!=0 order by tid desc limit 2";
						$bbsvideo = $db->query($sql);
  				?>
  				<a   href="<?php echo $photo[0]->url;?>" target=_blank><img style="width:60px; height:96px;" src="<?php echo $photo[0]->src; ?>" border=0></a>
  				<ul>
  					<!--<li><a   style="color:#ff0000; font-weight:bold;" href="/vote/vote.php?vote_id=<?php echo $vote[0]->id;?>" target=_blank><?php echo $vote[0]->name;?></a></li>-->
  					<?php for($i=0;$i<count($qz);$i++){ ?>
  						<li><a   <?php if($i<1){ ?>style="color:#ff0000; font-weight:bold;"<?php } ?> href="/home/space.php?uid=<?php echo $qz[$i]->uid;?>&do=thread&id=<?php echo $qz[$i]->tid;?>" target=_blank><?php echo $qz[$i]->subject;?></a></li>
  					<?php } ?>
  					<li><a   href="/home/space.php?uid=<?php echo $homeblog[0]->uid;?>&do=blog&id=<?php echo $homeblog[0]->blogid;?>" target=_blank><?php echo $homeblog[0]->subject;?></a></li>
  					<!--<li><a   href="/bbs/viewthread.php?tid=<?php echo $bbs[0]->tid;?>" target=_blank><?php echo $bbs[0]->subject;?></a></li>
  					<li><a   href="/bbs/viewthread.php?tid=<?php echo $bbsvideo[0]->tid;?>" target=_blank><?php echo $bbsvideo[0]->subject;?></a></li>
  					<li><a   href="/bbs/viewthread.php?tid=<?php echo $bbsvideo[1]->tid;?>" target=_blank><?php echo $bbsvideo[1]->subject;?></a></li>-->
 					</ul>	
  				
  							
 				</div>
 				
 				<div class=box>
   				<?php
 						$sql = 'select * from smg_dialog where is_adopt=1 order by create_time desc limit 4';
						$record=$db -> query($sql);
  				?>
  				<a   href="/zone/dialog.php?id=<?php echo $record[0]->id ?>" target=_blank><img src="<?php echo $record[0]->photo_url ?>" border=0></a>
  				<div id=context1>
  					<a   href="/zone/dialog.php?id=<?php echo $record[0]->id ?>" target=_blank><?php echo $record[0]->title ?></a>
  				</div>
  				<div id=context2>
  					<?php echo $record[0]->content ?>
  				</div>
  				<div id=context3>
  					<li><span style="color:#FF9900">·</span><a   href="/zone/dialog.php?id=<?php echo $record[1]->id ?>" target=_blank><?php echo $record[1]->title ?></a></li>
  					<li><span style="color:#FF9900">·</span><a   href="/zone/dialog.php?id=<?php echo $record[2]->id ?>" target=_blank><?php echo $record[2]->title ?></a></li>
  					<li><span style="color:#FF9900">·</span><a   href="/zone/dialog.php?id=<?php echo $record[3]->id ?>" target=_blank><?php echo $record[3]->title ?></a></li>
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
 				<a   href="/show/video_index.php" id=more target=_blank></a>
				<div id=content_mrt>
  					<li><a   href="/show/video.php?id=<?php echo $record_video[0]->video_id ?>" style="color:#F0474E; font-size:14px; font-weight:bold" target=_blank><?php echo $record_video[0]->title?></a></li>
					<?php for($i=1;$i<6;$i++){?>
  					<li><span style="color:#FF9900">·</span><a   href="/show/video.php?id=<?php echo $record_video[$i]->video_id ?>" target=_blank><?php echo $record_video[$i]->title?></a></li>
					<? }?>
				
				</div>
 			</div>
 			<!-- end !-->		
    	
      <!-- start middle_right_bottom !-->
 			<div id=m_r_b>
 				<div id=title>论 坛</div>
 				<a   href="/bbs/" id=more target=_blank></a>
				<?php
 					$sql = 'select n.short_title,n.id as news_id,c.platform  from smg_news n left join smg_category c on n.category_id=c.id where n.is_adopt=1 and c.name="论坛" and c.platform="zone" order by n.priority asc limit 6';
					$record_blog=$db -> query($sql);		
				?>	 
				<div id=content_mrb>
					<ul>
						<li style="font-weight:bold; font-size:15px; line-height:25px; height:25px;"><a   href="/<?php echo $record_blog[0]->platform ?>/news/news.php?id=<?php echo $record_blog[0]->news_id ?>" target=_blank style="color:#FF9900;"><?php echo $record_blog[0]->short_title ?></a></li>
						<?php for($i=1;$i<6;$i++){ ?>
						<li><a   href="/<?php echo $record_blog[$i]->platform ?>/news/news.php?id=<?php echo $record_blog[$i]->news_id ?>" target=_blank>·<?php echo $record_blog[$i]->short_title ?></a></li>
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
 			<div id=b_t_l <?php if(date('Y-m-d')=="2010-04-01"){ ?>style="background:url('images/index/bg_b_t_l1.jpg') no-repeat;"<?php } ?>>
				<div class=l_box>
 					<?php $sql = 'select id,title from smg_question where is_adopt=1 and problem_id<>39 order by create_time desc limit 5';
 								$record = $db->query($sql);
 					 ?>
 					<div class="top_title"><a   href="/answer/pro_answer.php?id=49"  target=_blank>答题：2010端午答题</a></div>
 					<?php for($i=0;$i<count($record);$i++)
						{?>
						<div class="bottom_title"><li><span style="color:#FF9900">·</span><a   href="/answer/pro_answer.php?id=49"  target=_blank>答题：<?php echo $record[$i]->title;?></a></li></div>
					 <?php } ?>
 				</div>
				<div class=m_box>
					<?php  
								
						//$sql = 'select id,name from smg_problem where is_adopt=1 order by create_time desc limit 6';
						
						$sql="select id,title from smg_xlcs where is_adopt=1 order by created_at desc limit 6";
						$xlcs=$db->query($sql);
						$count = count($record);
					?>
					<div class="top_title"><a   href="/xlcs/xlcs.php?xlcsid=<?php echo $xlcs[0]->id;?>"  target=_blank>心理测试：<?php echo $xlcs[0]->title;?></a></div>
					
					<?php
						for($i=1;$i<count($xlcs);$i++)
						{?>
					<div class="bottom_title"><li><span style="color:#FF9900">·</span><a   href="/xlcs/xlcs.php?xlcsid=<?php echo $xlcs[$i]->id;?>"  target=_blank>心理测试：<?php echo $xlcs[$i]->title;?></a></li></div>
					 <?php } ?>
						<? //for($i=1;$i<$count;$i++){
					?>
					<!--<div class="bottom_title"><li><span style="color:#FF9900">·</span><a   href="/answer/answer.php?id=<?php echo $record[$i]->id;?>"  target=_blank><?php echo $record[$i]->title;?></a></li></div>-->
					<?php
						//}
					?>
				</div>
				<?php  
					$sql = 'select id,name from smg_vote where is_sub_vote =0 and is_adopt=1 and (category_id=0 or category_id=11) order by created_at desc limit 6';
					$record = $db->query($sql);
					$count = count($record);
				?>
				<div class=r_box>
					<?php
						for($i=0;$i<$count;$i++){
					?>
					<div class="bottom_title"><li><span style="color:#FF9900;">·</span><a   href="/vote/vote.php?vote_id=<?php echo $record[$i]->id ?>" title="<?php echo strip_tags($record[$i]->name); ?>" target=_blank><?php echo strip_tags($record[$i]->name);?></a></li></div>
					<?php
						}
					?>
				</div>
				<div id=vote><a href="/answer/question.php" target="_blank"><img border=0 src="/images/index/vote1.jpg"></a></div>
				<div id=begin_vote><a href="/vote/beginvote.php" target="_blank"><img border=0 src="/images/index/begin_vote1.jpg"></a></div>
 			</div>
 			<!-- end !-->	      	
 
      <!-- start bottom_top_right !-->
 			<div id=b_t_r>
 				<div class=l_box>
 					<DIV id=demo9 style="OVERFLOW: hidden; WIDTH: 95%;">
				      <TABLE cellSpacing=0 cellPadding=0 border=0>
				        <TBODY>
				        <TR>
				          <TD id=demo10 vAlign=top align=middle>
				            <TABLE cellSpacing=0 cellPadding=2 border=0>
				              <TBODY>
				              <TR align=left>
				              	<?php  
									$sql = 'select t1.id as i_id,t1.title,t1.description,t1.url,t1.src from smg_images t1 join smg_category t2 on t1.category_id=t2.id where t1.is_adopt=1 and t2.name="在线杂志" and t2.category_type="picture" order by created_at desc';
									$records = $db->query($sql);
									$count = count($records);
									for($i=0;$i<$count;$i++){
								?>
				                <TD><div class=box>
										<div class=pic><a href="/show/show.php?id=<?php echo $records[$i]->i_id;?>" target="_blank" title="<?php echo $records[$i]->title;?>"><img src="<?php echo $records[$i]->src;?>" border=0 width=70 height=90></a></div>
										<div class=title><?php echo $records[$i]->title;?></div>
									</div></TD>
				                <? }?>
				              </TR></TBODY></TABLE></TD>
				          			<TD id="demo11" vAlign=top></TD></TR></TBODY></TABLE></DIV>
								      <SCRIPT>
								        var demo9 = document.getElementById('demo9');
										var demo10 = document.getElementById('demo10');
										var demo11 = document.getElementById('demo11');  
								      	$(document).ready(function(){
											var speed=30//速度数值越大速度越慢
											demo11.innerHTML=demo10.innerHTML
											function Marquee(){
											if(demo11.offsetWidth-demo9.scrollLeft<=0)
											demo9.scrollLeft-=demo10.offsetWidth
											else{
											demo9.scrollLeft++
											}
											}
											var MyMar=setInterval(Marquee,speed)
											demo9.onmouseover=function() {clearInterval(MyMar)}
											demo9.onmouseout=function() {MyMar=setInterval(Marquee,speed)}
										})
									</SCRIPT>
									
 				</div>
 				<div class=r_box>
	 				<table width="240" align="left">
							<tr>	
								<td><a   style="text-decoration:none; color:#000000; font-weight:normal;" target="_blank" href="http://www.ddmap.com/">丁丁地图</a></td><td><a   style="text-decoration:none; color:#000000; font-weight:normal;" target="_blank"  href="http://www.ddtong.cn/">实时交通路况查询</a></td>
							</tr>
							<tr>
								
								<td><a   style="text-decoration:none; color:#000000; font-weight:normal;" target="_blank" href="http://meishi.enjoyoung.cn/">人气美食</a></td><td><a   style="text-decoration:none; color:#000000; font-weight:normal;" target="_blank" href="http://www.shjtaq.com/zwfg/dzjc_new.asp">上海交通违章查询</a></td>
							</tr>
							<tr>	
								<td><a   style="text-decoration:none; color:#000000; font-weight:normal;" target="_blank" href="http://www.qunar.com/">机票折扣查询</a></td><td><a   style="text-decoration:none; color:#000000; font-weight:normal;" target="_blank" href="http://jujia.enjoyoung.cn/xingshangportal/main/main.do">星尚居家</a></td>
							</tr>
							<tr style="border-bottom:dashed 1px #999999">
								<td><a   style="text-decoration:none; color:#000000; font-weight:normal;" target="_blank" href="http://www.soku.net/huoche/TrainStation/381.Html">火车时刻表</a></td><td><a   style="text-decoration:none; color:#000000; font-weight:normal;" target="_blank" href="http://www.feeyo.com/flightsearch.htm">航班时刻查询</a></td>
							</tr>
							<tr height=1><td height=1 colspan=2><div style="width:100%; line-height:0px; height:1px; border-bottom:dashed 1px #999999;"></div></td></tr>
							<script type="text/javascript" src="http://hq.sinajs.cn/list=s_sh000001,s_sz399001" charset="utf-8"></script>
							<script type="text/javascript"> 
								var elements=hq_str_s_sh000001.split(","); 
								document.write("<tr><td><a target='_blank' href='http://finance.sina.com.cn/realstock/company/sh000001/nc.shtml'>上证指数:"+elements[1]+"</a></td><td>");
								elements=hq_str_s_sz399001.split(",");
								document.write("<a target='_blank' href='http://finance.sina.com.cn/realstock/company/sz399001/nc.shtml'>深圳成指:"+elements[1]+"</a></td></tr>");
							</script>
					</table>
				</div>
 			</div>
 			<!-- end !-->	 
    	
    </div>
			<div id=server_brithday>
				<div id=title>生日祝福</div>
				<?php
						$today = date("m-d");
						$sql = 'select t1.nickname,t1.gender,t1.loginname,t2.name from smg_user_real t1 join smg_org_dept t2 on t1.org_id=t2.orgid where t1.birthday_short="'.$today.'" and t1.hide_birthday=0 and t1.state=3';
						$records = $db->query($sql);
						$count = count($records);
						for($i=0;$i< $count;$i++){
				?>
				<div class=brithday_content id="brithday_content<?php echo $i; ?>" <?php if($i >0){ ?>style="display:none;"<?php } ?>>
					<div class=photo><!--<img src="" />--></div>
					<div class=brithdayinfo>
						<div class=brithdayinfo_l>
							<div class=title>生日提醒：</div>
							<div class=l_content>今天是<a href="/server/today.php"><?php echo $records[$i]->nickname; ?></a>的生日（<?php echo $today; ?>）<br><a href="/server/today.php">送他/她生日礼物</a></div>
						</div>
						<?php $sql="select distinct(gift_src) from smg_birthday_gift where reciever='".$records[$i]->loginname."' order by created_at desc";
						$gift=$db->query($sql); ?>
						<div class=brithdayinfo_r>
							<div class=title>已收到的礼物：</div>
							<?php for($j=0;$j<count($gift);$j++){ ?>
							<div class=pic><img src="<?php echo $gift[$j]->gift_src; ?>" /></div>
							<?php } ?>
						</div>	
					</div>
				</div>
				<?php } ?>
				<input id="countbirthday" type="hidden" value="<?php echo $count; ?>">
			</div>
    </div>
 </div> 
 
 
</div>
<? require_once('inc/bottom.inc.php');?>


</body>
</html>
<!--<script>
	var MSG1 = new CLASS_MSN_MESSAGE("aa",300,140,"重要通知：","通知",'首届上海广播电视台、SMG年度颁奖盛典改为1月20日（周三）18：45开始，请相互转告、保持关注！<br>　　　　　　　　　　　　　总编室<br>　　　　　　　　　　二零一零年一月十九日');  
    MSG1.rect(null,null,null,screen.height-50); 
    MSG1.speed = 100; 
    MSG1.step  = 20;  
    MSG1.show();
</script>-->
