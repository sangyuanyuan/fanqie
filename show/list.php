<?php
	require_once('../frame.php');
	$id = $_REQUEST['id'];
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
  	?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	 <div id=ibody_left>
     <!-- start left_top !-->
 	 	 <div id=l_t>
	 	 	<?php 
				$video = new table_class('smg_video');
				$video -> find('first');
				show_video_player('276','235',$video->photo_url,$video->video_url,$autostart = "false"); 
			?>
 	 	 </div>
 	   <!-- end -->
 	 
     <!-- start left_middle !-->
 	 	 <div id=l_m>
 	 	 	<?php
				$db = get_db();
				$sql = 'select i.title,i.src from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="番茄广告" and c.category_type="picture" order by i.priority asc limit 4';
				$record_ad=$db -> query($sql);
			?>
	 	 	<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
			<div id="focus_02"></div> 
			<script type="text/javascript"> 
				var pic_width1=276; 
				var pic_height1=146; 
				var pics1="<?php echo $record_ad[0]->src.",".$record_ad[1]->src.",".$record_ad[2]->src.",".$record_ad[3]->src ?>";
				var mylinks1="/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php,/fqtg/fqtglist.php";
				var texts1="<?php echo $record_ad[0]->title.",".$record_ad[1]->title.",".$record_ad[2]->title.",".$record_ad[3]->title ?>";
	
				var picflash = new sohuFlash("/flash/focus.swf", "focus_02", "276", "146", "4","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics1);
				picflash.addVariable("piclink",mylinks1);
				picflash.addVariable("pictext",texts1);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth","276");
				picflash.addVariable("borderheight","146");
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","15");				
				picflash.addVariable("pic_width",pic_width1);
				picflash.addVariable("pic_height",pic_height1);
				picflash.write("focus_02");				
			</script>   	
 	 	 </div>
 	   <!-- end -->
 	   
     <!-- start left_bottom !-->
 	 	 <div class=l_b>
 	 	 	<?php 
				$sql = 'select * from smg_video where week(created_at)=week("'.date("Y-m-d").'") order by click_count desc limit 5;';
				$records = $db->query($sql);
			?>
			<div class=title><div class=left>视频排行榜</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
			<?php for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="show_video?id=<?php echo $records[$i]->id;?>"><img border=0 width=40 height=40 src="<?php echo $records[$i]->photo_url?>"></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="show_video?id=<?php echo $records[$i]->id;?>"><?php echo $records[$i]->title;?></a></div>
						<div class=bottom><a target="_blank" href="show_video?id=<?php echo $records[$i]->id;?>">被播放了<?php echo $records[$i]->click_count ?>次</a></div>
					</div>
				</div>
			<? }?>
 	 	 </div>
 	   <!-- end --> 	   
 	   
     <!-- start left_bottom !-->
 	 	 <div class=l_b>
 	 	 	<?php 
				$category_id = category_id_by_name('我型我秀');
				if($category_id==''){$category_id=1;}
				$sql = 'select * from smg_images where week(created_at)=week("'.date("Y-m-d").'") order by click_count desc limit 5;';
				$records = $db->query($sql);
			?>
			<div class=title><div class=left>我型我秀排行榜</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
			<?php for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=40 height=40 src="<?php echo $records[$i]->src?>"></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><?php echo $records[$i]->title;?></a></div>
						<div class=bottom><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>">被点击了<?php echo $records[$i]->click_count;?>次</a></div>
					</div>
				</div>
			<? }?>
 	 	 </div>
 	   <!-- end --> 	
 	 </div>
	 <div id=ibody_right>
     <!-- start right !-->
 	 	 <div id=r>
 	 	 	<div class=title><div class=left><?php if($id!=''){echo category_name_by_id($id);}else{echo '图片列表';}?></div></div>
			<?php  
				if($id!=''){
					$sql = 'select id,short_title,created_at from smg_news where category_id='.$id.' and is_adopt=1 order by created_at desc,priority asc';
				}else{
					$sql = 'select id,title as short_title,created_at from smg_images where is_adopt=1 order by created_at desc,priority asc';
				}
				$records = $db->paginate($sql,45);
				close_db();
				$count = count($records);
				for($i=0;$i<$count;$i++){
			?>
			<div class=content>
				<div class=left>
					<a href="<?if($id!=''){echo '/news/news.php';}else{echo 'show.php';}?>?id=<?php echo $records[$i]->id;?>" title="<?php echo $records[$i]->short_title;?>"><?php echo $records[$i]->short_title;?></a>
				</div>
				<div class=right>
					<?php echo $records[$i]->created_at; ?>
				</div>
			</div>
			<?php }?>
			<div id=paginate><?php paginate();?></div>
		</div>
 	 </div>
 	   <!-- end --> 		 	
</div>  	 
<? require_once('../inc/bottom.inc.php');?>


</body>
</html>