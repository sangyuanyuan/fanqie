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
 			<div id=t_l_t>
 				<div id=menu>
 					<div class=item id=item1 value="1" style="background:url(/images/index/btn2.jpg);color:#9f9f9f;">每日之星</div>
  				<div class=item id=item2 value="2" style="background:url(/images/index/btn1.jpg)">视频新闻</div>
 					<div class=item id=item3 value="3" style="background:url(/images/index/btn2.jpg);color:#9f9f9f;">番茄广告</div>
				</div>	
 				<?
					$sql = 'select n.short_title,n.photo_src from smg_news n left join smg_category c on n.category_id=c.id where c.name="每日之星" and c.category_type="news" order by n.priority asc limit 4';
					$record_star=$db -> query($sql);
					$sql = 'select n.short_title,n.video_photo_src,n.video_src from smg_news n left join smg_category c on n.category_id=c.id where c.name="视频新闻" and c.category_type="news" order by n.priority asc limit 4';
					$record_video=$db -> query($sql);
					$sql = 'select i.title,i.src from smg_images i left join smg_category c on i.category_id=c.id where c.name="番茄广告" and c.category_type="picture" order by i.priority asc limit 4';
					$record_ad=$db -> query($sql);
  			?>
  			<div class=content id=content1>
  				
  				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
					<div id="focus_01"></div> 
					<script type="text/javascript"> 
					var pic_width1=271; //图片宽度
					var pic_height1=183; //图片高度
					var pics1="<?php echo $record_star[0]->photo_src.",".$record_star[1]->photo_src.",".$record_star[2]->photo_src.",".$record_star[3]->photo_src."," ?>";
					var mylinks1="/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php";
					var texts1="<?php echo $record_star[0]->short_title.",".$record_star[1]->short_title.",".$record_star[2]->short_title.",".$record_star[3]->short_title."," ?>";
 	
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
 				<div class=content id=content2 style="background:url(/images/index/bg_flash.jpg);display:inline;">
 					<iframe id=video_src src="index_video.php?photo=<?php echo $record_video[0]->video_photo_src ?>&video=<?php echo $record_video[0]->video_src ?>" width=225px height=182px scrolling="no" frameborder="0"></iframe>
 				</div>
  			<div class=content id=content3>
					<div id="focus_02"></div> 
 					<script type="text/javascript"> 
					var pic_width1=271; 
					var pic_height1=183; 
					var pics1="<?php echo $record_ad[0]->src.",".$record_ad[1]->src.",".$record_ad[2]->src.",".$record_ad[3]->src."," ?>";
					var mylinks1="/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php";
					var texts1="<?php echo $record_ad[0]->title.",".$record_ad[1]->title.",".$record_ad[2]->title.",".$record_ad[3]->title."," ?>";
 	
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
 						<li class=video style="color:#2C345B; font-weight:bold; background:url(/images/icon/arrow2.gif) no-repeat 0 3px" value1=<?php echo $record_video[0]->video_photo_src ?> value2=<?php echo $record_video[0]->video_src ?>><?php echo $record_video[0]->short_title ?></li>
 						<li class=video value1=<?php echo $record_video[1]->video_photo_src ?> value2=<?php echo $record_video[1]->video_src ?>><?php echo $record_video[1]->short_title ?></li>
 						<li class=video value1=<?php echo $record_video[2]->video_photo_src ?> value2=<?php echo $record_video[2]->video_src ?>><?php echo $record_video[2]->short_title ?></li>
 						<li class=video value1=<?php echo $record_video[3]->video_photo_src ?> value2=<?php echo $record_video[3]->video_src ?>><?php echo $record_video[3]->short_title ?></li>
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
 			<div id=t_l_m>

 			</div>
 			<!-- end !-->


 			<!-- start top_left_bottom !-->
 			<div id=t_l_b>

 			</div>
 			<!-- end !-->

		</div>

		<div id=p2>
 			<!-- start top_right_top !-->
 			<div id=t_r_t>

 			</div>
 			<!-- end !-->
		</div>

		<div id=p3>
 			<!-- start top_right_center_top !-->
 			<div id=t_r_c_t>

 			</div>
 			<!-- end !-->
			
 			<!-- start top_right_center_middle !-->
 			<div id=t_r_c_m>

 			</div>
 			<!-- end !-->
		

 			<!-- start top_right_center_bottom_left !-->
 			<div id=t_r_c_b_l>

 			</div>
 			<!-- end !-->


 			<!-- start top_right_center_bottom_right !-->
 			<div id=t_r_c_b_r>

 			</div>
 			<!-- end !-->
		
		</div>
		
		<div id=p4>
 			<!-- start top_right_right_top !-->
 			<div id=t_r_r_t>

 			</div>
 			<!-- end !-->			
			
 			<!-- start top_right_right_middle !-->
 			<div id=t_r_r_m>

 			</div>
 			<!-- end !-->						

 			<!-- start top_right_right_bottom !-->
 			<div id=t_r_r_b>

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