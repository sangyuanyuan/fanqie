<?php
	require_once('../../frame.php');
	$id = $_REQUEST['id'];
	$l_sql = 'select t1.title,t1.id,t1.created_at,t3.name from smg_images t1 join smg_subject_items t2 on t1.id=t2.resource_id join smg_subject_category t3 on t2.category_id=t3.id where t2.category_id='.$id.' and t1.is_adopt=1 order by t1.priority asc,t1.created_at desc';
	$l_title = 'title';
	$link = '/show/show.php?id=';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-列表</title>
	<?php
		css_include_tag('show_list');
		css_include_tag('top');
		css_include_tag('bottom');
		use_jquery();
		js_include_tag('total');
  	?>
</head>
<script>
	total("列表","show");	
</script>
<body>
<? require_once('../../inc/top.inc.html');?>
<div id=ibody>
	 <div id=ibody_left>
     <!-- start left_top !-->
 	 	 <div id=l_t>
	 	 	<?php 
				$db = get_db();
				$sql="select photo_url,video_url from smg_video where tags='视频推荐' and is_adopt=1 and photo_url is not null order by priority asc,created_at desc limit 1";
				$record=$db->query($sql);
				show_video_player('276','235',$record[0]->photo_url,$record[0]->video_url,$autostart = "false"); 
			?>
 	 	 </div>
 	   <!-- end -->
 	 
     <!-- start left_middle !-->
 	 	 <div id=l_m>
 	 	 	<?php 
				$sql = 'select i.id as img_id,i.title,i.src,i.priority as ipriority from smg_images i left join smg_category c on i.category_id=c.id where i.priority=0 and i.is_adopt=1 and c.name="番茄广告" and c.platform="show" order by i.priority asc,i.created_at desc limit 4';
				$record_ad=$db -> query($sql);
				$count = count($record_ad);
				for($i=0;$i<$count;$i++){
					$picsurl[]=$record_ad[$i]->src;
					$picslink[]='/show/show.php?id='.$record_ad[$i]->id;
					$picstext[]=flash_str_replace($record_ad[$i]->title);
				}
			?>
			
			<?php if($count==1){?>
				<a href="/show/show.php?id=<?php echo $record_ad[0]->img_id?>" target=_blank>
					<img src="<?php echo $record_ad[0]->src?>" width=275; height=177; border=0>
				</a>
			<? }else{?>
				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
				<div id="focus_02"></div> 
				<script type="text/javascript"> 
				var pic_width1=276; //图片宽度
				var pic_height1=180; //图片高度
				var pics="<?php echo implode(',',$picsurl);?>";
				var mylinks="<?php echo implode(',',$picslink);?>";
				var texts="<?php echo implode(',',$picstext);?>";
				var picflash = new sohuFlash("/flash/focus.swf", "focus_02", pic_width1, pic_height1, "4","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics);
				picflash.addVariable("piclink",mylinks);
				picflash.addVariable("pictext",texts);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth",pic_width1);
				picflash.addVariable("borderheight",pic_height1);
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","15");				
				picflash.addVariable("pic_width",pic_width1);
				picflash.addVariable("pic_height",pic_height1);
				picflash.write("focus_02");				
				</script>		
			<? }?>  	
 	 	 </div>
 	   <!-- end -->
 	   
     <!-- start left_bottom !-->
 	 	 <div class=l_b>
 	 	 	<?php 
				$sql = 'select t1.id,t1.description,t1.click_count,t1.title,t1.photo_url from smg_video t1 join smg_category t2 on t1.category_id=t2.id where TO_DAYS(NOW())-TO_DAYS(t1.created_at) <= 30 and t1.is_adopt=1 and t2.platform="show" order by t1.click_count desc limit 5';
				$records = $db->query($sql);
			?>
			<div class=title><div class=left>视频排行榜</div></div>
			<?php for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=40 height=40 src="<?php echo $records[$i]->photo_url?>"></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>" title="<?php echo $records[$i]->title;?>"><?php echo $records[$i]->title;?></a></div>
						<div class=bottom>被播放了<?php echo $records[$i]->click_count ?>次</div>
					</div>
				</div>
			<? }?>
 	 	 </div>
 	   <!-- end --> 	   
 	   
     <!-- start left_bottom !-->
 	 	 <div class=l_b>
 	 	 	<?php 
				$sql = 'select t1.id,t1.description,t1.click_count,t1.title,t1.src from smg_images t1 join smg_category t2 on t1.category_id=t2.id where TO_DAYS(NOW())-TO_DAYS(t1.created_at) <= 30 and year(t1.created_at)=year(now()) and is_adopt=1 and t2.platform="show" order by t1.click_count desc limit 5';
				$records = $db->query($sql);
			?>
			<div class=title><div class=left>我行我秀排行榜</div></div>
			<?php for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=40 height=40 src="<?php echo $records[$i]->src?>"></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>" title="<?php echo $records[$i]->title;?>"><?php echo $records[$i]->title;?></a></div>
						<div class=bottom>被点击了<?php echo $records[$i]->click_count;?>次</div>
					</div>
				</div>
			<? }?>
 	 	 </div>
 	   <!-- end --> 	
 	 </div>
	 <div id=ibody_right>
     <!-- start right !-->
 	 	 <div id=r>
 	 	 	<?php
				if($l_sql!=''){
				$records = $db->paginate($l_sql,50);
				close_db();
			?>
 	 	 	<div class=title><div class=left><?php echo $records[0]->name;?></div></div>
			<?php  
					$count = count($records);
					for($i=0;$i<$count;$i++){
			?>
			<?php if($title=="每日之星"){?>
			<div class=content>
				<div class=pic>
					<a href="<?php if($type!='magazine'){echo $link.$records[$i]->id;}else{echo $records[$i]->online_url;}?>" target="_blank" title="<?php echo strip_tags($records[$i]->$l_title);?>"><img src="<?php echo $records[$i]->photo_src ?>" width="140" height="80" border=0></a>
				</div>
				<div class=left style="width:310px;">
					<a href="<?php if($type!='magazine'){echo $link.$records[$i]->id;}else{echo $records[$i]->online_url;}?>" target="_blank" title="<?php echo strip_tags($records[$i]->$l_title);?>"><?php echo strip_tags($records[$i]->$l_title);?></a>
				</div>
				<div class=right>
					<?php if($type!='magazine'){echo $records[$i]->created_at;}else{echo $records[$i]->create_time;}?>
				</div>
			</div>
			<?php	
			}else{
			?>
			<div class=content>
				<div class=left>
					<a href="<?php if($type!='magazine'){echo $link.$records[$i]->id;}else{echo $records[$i]->online_url;}?>" target="_blank" title="<?php echo strip_tags($records[$i]->$l_title);?>"><?php echo strip_tags($records[$i]->$l_title);?></a>
				</div>
				<div class=right>
					<?php if($type!='magazine'){echo $records[$i]->created_at;}else{echo $records[$i]->create_time;}?>
				</div>
			</div>
			<?php
			} ?>
			<?php } }?>
			<div id=paginate><?php paginate();?></div>
		</div>
 	 </div>
 	   <!-- end --> 		 	
</div>  	 
<? require_once('../../inc/bottom.inc.php');?>


</body>
</html>