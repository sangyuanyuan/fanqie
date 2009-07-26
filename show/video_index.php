<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-视频主页</title>
	<?php
		css_include_tag('show_video_index','top','bottom');
		use_jquery();
  	?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	 <div id=ibody_left>
 	 	 <div id=l_t>
 	 	 	 <div id=video>
 	 	 	 	<?php 
					$db = get_db();
					$sql="select photo_url,video_url from smg_video where tags='视频推荐' and is_adopt=1 and photo_url is not null order by priority asc,created_at desc limit 1";
					$record = $db->query($sql);
					show_video_player('285','265',$record[0]->photo_url,$record[0]->video_url,$autostart = "false");
				?>
			 </div>
 	 	 </div>
		 
		 <div id=pic><a href="show_sub.php?type=video" target="_blank" ><img src="/images/show/video_up.jpg" border=0></a></div>
		 
		 <div class=l_m>
			<div class=title><div class=left>热门标签</div></div>
			<div class=content style="border-bottom:none;">
			<?php
				$sql = 'select keywords from smg_images where keywords!="" order by click_count desc limit 10';
				$records = $db->query($sql);
				$c = array();
				for($i=0;$i<count($records);$i++){
					$keywords = explode(',', $records[$i]->keywords);
					if(count($keywords)==0)$keywords = explode('，', $records[$i]->keywords);
					if(count($keywords)==0)$keywords = explode('　', $records[$i]->keywords);
					if(count($keywords)==0)$keywords = explode(' ', $records[$i]->keywords);
					for($j=0;$j<count($keywords);$j++){
						if(!in_array($keywords[$j],$c))array_push($c,$keywords[$j]);
					}
					$keywords = '';
				}
				for($i=0;$i<count($c);$i++){
			?>
			<a class="tag<?php echo rand(1, 6);?>" target="_blank" href="/search/?key=<?php echo urlencode($c[$i]);?>&search_type=smg_images"><?php echo $c[$i];?></a>
			<?php } ?>
			</div>
		</div>	

 	 	 <div id=l_m1>
 	 	 	<?php
				$db = get_db();
				$sql = 'select i.id,i.title,i.src from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="番茄广告" and c.category_type="picture" order by i.priority asc limit 4';
				$record_ad=$db -> query($sql);
			?>
			<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
			<div id="focus_02"></div> 
			<script type="text/javascript"> 
				var pic_width1=276; 
				var pic_height1=190; 
				var pics1="<?php echo $record_ad[0]->src.",".$record_ad[1]->src.",".$record_ad[2]->src.",".$record_ad[3]->src ?>";
				var mylinks1="<?php echo "show.php?id=".$record_ad[0]->id.",show.php?id=".$record_ad[1]->id.",show.php?id=".$record_ad[2]->id.",show.php?id=".$record_ad[3]->id ?>";
				var texts1=<?php echo '"',flash_str_replace($record_ad[0]->title).",".flash_str_replace($record_ad[1]->title).",".flash_str_replace($record_ad[2]->title).",".flash_str_replace($record_ad[3]->title).'"'; ?>;
	
				var picflash = new sohuFlash("/flash/focus.swf", "focus_02", "287", "190", "4","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics1);
				picflash.addVariable("piclink",mylinks1);
				picflash.addVariable("pictext",texts1);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth","287");
				picflash.addVariable("borderheight","190");
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","15");				
				picflash.addVariable("pic_width",pic_width1);
				picflash.addVariable("pic_height",pic_height1);
				picflash.write("focus_02");				
			</script> 
 	 	 </div>
		 
		 <div class=l_m>
			<div class=title><div class=left>用户排行榜</div></div>
			<?php
				$sql = 'SELECT t1.publisher,count(t1.title) as num FROM smg_video t1 join smg_category t2 on t1.category_id=t2.id where t1.publisher!="" and t1.publisher!="admin" and t2.platform="show" group by t1.publisher limit 5';
				$records = $db->query($sql);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class=content <?php if($i==$count-1){?>style="border-bottom:none;"<?php }?>>
					<div class=left><?php echo $i+1;?></div>
					<div class=right>
						<div class=top><a target="_blank" href="list.php?publisher=<?php echo urlencode($records[$i]->publisher);?>&type=video"><?php echo $records[$i]->publisher; ?></a></div>
						<div class=bottom>发布了<?php echo $records[$i]->num; ?>个视频！</div>
					</div>
				</div>
			<? }?>
		</div>
		
		<div id=l_b>
			<div class=title>最新评论</div>
			<?php
				$sql = 'SELECT * from smg_comment where resource_type="video" order by created_at desc limit 7';
				$records = $db->query($sql);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
			<div class=content>
				<div class=left><?php echo substr($records[$i]->created_at, 5, 5);?></div>
				<div class=right><a href="video.php?id=<?php echo $records[$i]->resource_id; ?>" target="_blank"><?php echo $records[$i]->comment;?></a></div>
			</div>
			<?php } ?>
		</div>
 	 </div>
	 
	 

	 
	 <div id=ibody_right>
	 	<div id=r_t>
	 		<?php 
				$category_id = category_id_by_name('视频首页顶部图','video');
				$sql = 'select * from smg_video where category_id='.$category_id.' and is_adopt=1  order by priority asc,created_at desc limit 4';
				$records = $db->query($sql);
			?>
		 	<div id=r_t_l>
		 		<div id=r_t_l_t>
		 			<a id="pic_url" href="video.php?id=<?php echo $records[0]->id?>" target="_blank"><img id="big_pic" width="480" height="225" src="<?php echo $records[0]->photo_url;?>" border=0></a>
		 		</div>
				<div id=r_t_l_b>
					<?php
						for($i=0;$i<4;$i++){
					?>
					<img class="img" id="<?php echo $i+1;?>" width="80" height="46" src="<?php echo $records[$i]->photo_url?>" border=0 value="video.php?id=<?php echo $records[$i]->id?>" <?php if($i==0){?>style="opacity:1; filter:alpha(opacity=100);"<?}?>>
					<?php
						}
					?>
				</div>
		 	</div>
			
			<div id=r_t_r>
				<div class=title>视频排行榜</div>
					<?php
						$sql = 'select id,title,click_count from smg_video where is_adopt=1 order by click_count desc limit 10;';
						$records = $db->query($sql);
						$count = count($records);
						for($i=0;$i<$count;$i++){
					?>
					<div class=content>
						<div class="<?php if($i<3){echo 'left';}else{echo 'left2';}?>"><?php echo $i+1; ?></div>
						<div class=right><a href="video.php?id=<?php echo $records[$i]->id;?>" target="_blank" title="<?php echo $records[$i]->title;?>" ><?php echo strip_tags($records[$i]->title);?></a></div>
						<div class=click_count><?php echo $records[$i]->click_count; ?></div>
					</div>
					<?php }?>
			</div>
		</div>
			
		
 	 	<div id=r_b>
 	 		<div class=r_b_title>
		  		<div class=left>最新视频</div>
				<div class=more><a target="_blank" href="list.php?type=video">更多</a></div>
		  	</div>
			<div class=r_b_content>
			<?php
				$sql = 'select * from smg_video where is_adopt=1 order by created_at desc limit 4';
				$records = $db->query($sql);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class=content>
					<div class=pic><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=120 height=75 src="<?php echo $records[$i]->photo_url?>"></a></div>
					<div class=title><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					<div class=publisher>播客：<?php if($records[$i]->publisher!=''){echo $records[$i]->publisher;}else{echo get_dept_info($records[$i]->dept_id)->name;}?></div>
					<div class=keywords><?php echo $records[$i]->created_at;?></div>
					<div class=keywords>点击：<?php echo $records[$i]->click_count;?>次</div>
				</div>
			<?php } ?>
			</div>
			<div class=line></div>
			<?php $category_id = category_id_by_name('佳片共赏','video'); ?>
			<div class=r_b_title>
		  		<div class=left>佳片共赏</div>
				<div class=more><a target="_blank" href="list.php?type=video&id=<?php echo $category_id; ?>">更多</a></div>
		  	</div>
			<div class=r_b_content>
			<?php
				$sql = 'select * from smg_video where is_adopt=1 and category_id='.$category_id.' order by priority asc,created_at desc limit 8';
				$records = $db->query($sql);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class=content>
					<div class=pic><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=120 height=75 src="<?php echo $records[$i]->photo_url?>"></a></div>
					<div class=title><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					<div class=publisher>播客：<?php if($records[$i]->publisher!=''){echo $records[$i]->publisher;}else{echo get_dept_info($records[$i]->dept_id)->name;}?></div>
					<div class=keywords><?php echo $records[$i]->created_at;?></div>
					<div class=keywords>点击：<?php echo $records[$i]->click_count;?>次</div>
				</div>
			<?php } ?>
			</div>
			<div class=line></div>
			<div class=r_b_title>
		  		<div class=left>视频新闻</div>
		  	</div>
			<div class=r_b_content>
			<?php
				$sql = 'select t1.id,t1.dept_id,t1.short_title,t1.publisher_id,t1.created_at,t1.click_count,t2.platform from smg_news t1 join smg_category t2 on t1.category_id=t2.id where t1.is_adopt=1 and t1.video_flag=1 and t1.video_photo_src!="" and t1.short_title!="" order by t1.priority asc, t1.created_at desc limit 4';
				$records = $db->query($sql);
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
				<div class=content>
					<div class=pic><a target="_blank" href="/<?php echo $records[$i]->platform; ?>/news/news.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=120 height=75 src="<?php echo $records[$i]->video_photo_src?>"></a></div>
					<div class=title><a target="_blank" href="/<?php echo $records[$i]->platform; ?>/news/news.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->short_title);?></a></div>
					<div class=publisher><?php if($records[$i]->publisher_id!=''){echo $records[$i]->publisher_id;}else{echo get_dept_info($records[$i]->dept_id)->name;}?></div>
					<div class=keywords><?php echo $records[$i]->created_at;?></div>
					<div class=keywords>点击：<?php echo $records[$i]->click_count;?>次</div>
				</div>
			<?php } ?>
			</div>
 	 	</div>	 	
	 </div>  	 
</div>
<?php
	close_db();
	require_once('../inc/bottom.inc.php');
?>


</body>
</html>

<script>
	var num = 2;
	
	$(function(){
		$(".img").click(function(){
			$(".img").css('opacity','0.3');
			$(this).css('opacity','1');
			$("#big_pic").attr('src',$(this).attr('src'));
			$("#pic_url").attr('href',$(this).attr('value'));
		})
	})
	
	
	function change(){
		$(".img").css('opacity','0.3');
		$("#"+num).css('opacity','1');
		$("#big_pic").attr('src',$("#"+num).attr('src'));
		$("#pic_url").attr('href',$("#"+num).attr('value'));
		if(num!=4){num++}else{num=1}
	}
	
	setInterval(change,5000);
</script>