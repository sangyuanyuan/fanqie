<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-首页</title>
	<?php 	
		css_include_tag('show_index','top','bottom');
		use_jquery();
 	?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	 <div id=ibody_top>
     <!-- start top_left !-->
 	 	 <div id=t_l>
 	 	 	<?php 
				$db = get_db();
				$sql="select * from smg_video where category_id in (select id from smg_category where category_type='video' order by priority asc) and is_adopt=1 and photo_url is not null order by priority asc,created_at desc limit 1";
				$record=$db->query($sql);
				show_video_player('293','230',$record[0]->photo_url,$record[0]->video_url);
			?>
 	 	 </div>
 	   <!-- end -->
 	 
      <!-- start top_right !-->
 	 	 <div id=t_r>
 	 	 	<?php
				$db = get_db();
				$sql = 'select i.id,i.title,i.src from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="番茄广告" and c.category_type="picture" order by i.priority asc limit 4';
				$record_ad=$db -> query($sql);
			?>
			<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
			<div id="focus_02"></div> 
			<script type="text/javascript"> 
				var pic_width1=276; 
				var pic_height1=146; 
				var pics1="<?php echo $record_ad[0]->src.",".$record_ad[1]->src.",".$record_ad[2]->src.",".$record_ad[3]->src ?>";
				var mylinks1="<?php echo "show.php?id=".$record_ad[0]->id.",show.php?id=".$record_ad[1]->id.",show.php?id=".$record_ad[2]->id.",show.php?id=".$record_ad[3]->id ?>";
				var texts1="<?php echo $record_ad[0]->title.",".$record_ad[1]->title.",".$record_ad[2]->title.",".$record_ad[3]->title ?>";
	
				var picflash = new sohuFlash("/flash/focus.swf", "focus_02", "590", "212", "4","#FFFFFF");
				picflash.addParam('wmode','opaque');
				picflash.addVariable("picurl",pics1);
				picflash.addVariable("piclink",mylinks1);
				picflash.addVariable("pictext",texts1);				
				picflash.addVariable("pictime","5");
				picflash.addVariable("borderwidth","590");
				picflash.addVariable("borderheight","212");
				picflash.addVariable("borderw","false");
				picflash.addVariable("buttondisplay","true");
				picflash.addVariable("textheight","15");				
				picflash.addVariable("pic_width",pic_width1);
				picflash.addVariable("pic_height",pic_height1);
				picflash.write("focus_02");				
			</script> 
 	 	 </div>
 	   <!-- end -->	 
 	 </div>
 	 
 	 <div id=ibody_left>
     <!-- start left_top !-->
 	 	 <div id=l_t>
 	 	 	<?php 
				$category_id = category_id_by_name('每日之星');
				$sql='select * from smg_news where is_adopt=1 and category_id='.$category_id.' order by last_edited_at desc limit 9';
				$star=$db->query($sql);
			?>
 	 	 	<div class=l_title>
 	 	 		<div class=title_l>
 	 	 			每日之星
 	 	 		</div>
				<div class=title_r>
					<?php if(count($star)>0){?><a target="_blank" href="list.php?id=<?php echo $category_id;?>&type=news">More..</a><?php } ?>
				</div>
 	 	 	</div>
			<?php for($i=0;$i<count($star);$i++){?>
				<div class="content">
					<img src="/images/show/red_square.jpg">
					<div class=c_a><a target="_blank" href="article.php?id=<?php echo $star[$i]->id;?>"><?php echo $star[$i]->short_title;?></a></div>
					<div class=c_t><?php echo  substr($star[$i]->last_edited_at, 5, 5);?></div>
				</div>
			<?php }?>
 	 	 </div>
 	   <!-- end -->
 	 
     <!-- start left_middle !-->
 	 	 <div id=l_m>
 	 	 	<?php 
				$sql = 'select * from smg_video where month(created_at)=month("'.date("Y-m-d").'") and is_adopt=1 order by click_count desc limit 5;';
				$spphb=$db->query($sql);
				$sql = 'SELECT publisher,count(*) as num FROM smg_video where publisher!="" group by publisher limit 5';
				$bk=$db->query($sql);
			?>
 	 	 	<div class=l_title>
 	 	 		<div class=title_l>
 	 	 			<span id="t_l1" class=change value="视频排行榜" name="hide1" style="cursor:pointer; border-right:1px dotted #25619A; color:#25619A">视频排行榜</span>
					<span id="t_l2" class=change value="播客排行榜" name="hide1" style="cursor:pointer; margin-left:5px; color:#999999">播客排行榜</span>
 	 	 		</div>
 	 	 	</div>
			<div class="content hide1" id="视频排行榜">
				<?php
				 for($i=0;$i<count($spphb);$i++){?>
					<div class="context" >
						<?php if($i<3){?>
							<div class=pic1>0<?php echo $i+1;?></div>
						<?php }else{?>
							<div class=pic2>0<?php echo $i+1;?></div>
						<?php } if($i==0){?>
							<div class=context1>
								<div class=left><img style="margin-top:2px; margin-left:2px; float:left; display:inline;" width=67 height=52 src="<?php echo $spphb[$i]->photo_url;?>"></div>
								<div class=right>
									<a href="video.php?id=<?php echo $spphb[$i]->id;?>"><?php echo $spphb[$i]->title;?></a><br>
									<span><?php echo get_fck_content($spphb[$i]->description);?></span>
									<span>点击量：<?php echo $spphb[$i]->click_count;?></span>
								</div>
							</div>
						<?php }else{?>
							<div class=context2 <?php if($i==(count($spphb)-1)){?>style="border:0;"<?php } ?> >
								<div class=left><a target="_blank" href="video.php?id=<?php echo $spphb[$i]->id;?>"><?php echo get_fck_content($spphb[$i]->title);?></a></div>
								<div class=right><?php echo $spphb[$i]->click_count;?></div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="content hide1" id="播客排行榜" style="display:none">
				<?php
				 for($i=0;$i<count($bk);$i++){?>
					<div class="context" >
						<?php if($i<3){?>
							<div class=pic1>0<?php echo $i+1;?></div>
						<?php }else{?>
							<div class=pic2>0<?php echo $i+1;?></div>
						<?php } if($i==0){?>					
							<div class=context1>
								<div class=right>
									<a href="list.php?publisher=<?php echo $bk[$i]->publisher;?>&type=video"><?php echo $bk[$i]->publisher;?></a><br>
									<span><?php echo $bk[$i]->publisher;?></span>
									<span>视频数：<?php echo $bk[$i]->num;?></span>
								</div>
							</div>
						<?php }else{?>
							<div class=context2 <?php if($i==(count($bk)-1)){?>style="border:0;"<?php } ?> >
								<div class=left><a target="_blank" href="list.php?publisher=<?php echo $bk[$i]->publisher;?>&type=video"><?php echo $bk[$i]->publisher;?></a></div>
								<div class=right><?php echo $bk[$i]->num;?></div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<?php 
				$sql = 'select * from smg_images where month(created_at)=month("'.date("Y-m-d").'") and is_adopt=1 order by click_count desc limit 5;';
				$wxwxph=$db->query($sql);
				$sql = 'SELECT publisher,count(*) as num FROM smg_images where publisher!="" group by publisher limit 5';
				$sy=$db->query($sql);
			?>
			<div class=l_title>
 	 	 		<div class=title_l>
 	 	 			<span id="t_l1" class=change  name="hide2" value="我型我秀排行榜" style="cursor:pointer; border-right:1px dotted #25619A; color:#25619A">我型我秀排行榜</span>
					<span id="t_l2" class=change  name="hide2" value="摄友排行榜" style="cursor:pointer; margin-left:5px; color:#999999">摄友排行榜</span>
 	 	 		</div>
				<div class=title_r>
					<?php if(count($star)>0){?><!--<a target="_blank" href="list.php?id=<?php $star[0]->category_id;?>">More..</a>--><?php } ?>
				</div>
 	 	 	</div>
			<div class="content hide2" id="我型我秀排行榜">
				<?php
				 for($i=0;$i<count($wxwxph);$i++){?>
					<div class="context" id="picph1" style="display:inline;">
						<?php if($i<3){?>
							<div class=pic1>0<?php echo $i+1;?></div>
						<?php }else{?>
							<div class=pic2>0<?php echo $i+1;?></div>
						<?php } if($i==0){?>					
							<div class=context1>
								<div class=left><img style="margin-top:2px; margin-left:2px; float:left; display:inline;" width=67 height=52 src="<?php echo $wxwxph[$i]->src;?>"></div>
								<div class=right>
									<a target="_blank" href="show.php?id=<?php echo $wxwxph[$i]->id;?>"><?php echo $wxwxph[$i]->title;?></a><br>
									<span><?php echo get_fck_content($wxwxph[$i]->description);?></span>
									<span>点击量：<?php echo $wxwxph[$i]->click_count;?></span>
								</div>
							</div>
						<?php }else{?>
							<div class=context2 <?php if($i==(count($spphb)-1)){?>style="border:0;"<?php } ?>>
								<div class=left><a target="_blank" href="show.php?id=<?php echo $wxwxph[$i]->id;?>"><?php echo get_fck_content($wxwxph[$i]->title);?></a></div>
								<div class=right><?php echo $wxwxph[$i]->click_count;?></div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<div class="content hide2" id="摄友排行榜" style="display:none">
				<?php
				 for($i=0;$i<count($bk);$i++){?>
					<div class="context" >
						<?php if($i<3){?>
							<div class=pic1>0<?php echo $i+1;?></div>
						<?php }else{?>
							<div class=pic2>0<?php echo $i+1;?></div>
						<?php } if($i==0){?>					
							<div class=context1>
								<div class=right>
									<a href="list.php?publisher=<?php echo $sy[$i]->publisher;?>&type=show"><?php echo $sy[$i]->publisher;?></a><br>
									<span><?php echo $sy[$i]->publisher;?></span>
									<span>图片数：<?php echo $sy[$i]->num;?></span>
								</div>
							</div>
						<?php }else{?>
							<div class=context2 <?php if($i==(count($sy)-1)){?>style="border:0;"<?php } ?> >
								<div class=left><a target="_blank" href="list.php?publisher=<?php echo $sy[$i]->publisher;?>&type=show"><?php echo $sy[$i]->publisher;?></a></div>
								<div class=right><?php echo $sy[$i]->num;?></div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
 	 	 </div>
 	   <!-- end -->

     <!-- start left_bottom !-->
 	 	 <div id=l_b>
 	 	 	<?php 
				$sql="select * from smg_magazine where is_adopt=1 order by priority asc,create_time desc limit 1";
				$magazine=$db->query($sql);
			?>
 	 	 	<div class=l_title>
 	 	 		<div class=title_l>
 	 	 			在线杂志
 	 	 		</div>
				<div class=title_r>
					<?php if(count($magazine)>0){?><a target="_blank" href="list.php?type=magazine">More..</a><?php } ?>
				</div>
 	 	 	</div>
			<div class="l_b_l">
				<a target="_blank" href="<?php echo $magazine[0]->online_url;?>"><img width=129 height=163 border=0 src="<?php echo $magazine[0]->photo_url;?>"></a>
			</div>
			<div class="l_b_r">
				<a target="_blank" href="<?php echo $magazine[0]->online_url;?>"><?php echo $magazine[0]->title;?></a>
				<div class=m_info>本期主要内容：</br><font color="#666666"><?php echo $magazine[0]->description;?></font></div>
				<div class=m_info>发行日期：</br><?php echo substr($magazine[0]->create_time,0,10); ?></div>
			</div>
 	 	 </div>
 	   <!-- end -->

 	 </div>	 
 	 
 	 <div id=ibody_center>
 	 	<?php 
			$sql = "select * from smg_images where is_adopt=1 and publisher is not null order by priority asc,created_at desc limit 6";
			$records = $db->query($sql);
			$count = count($records);
		?>
     <!-- start center !-->
 	 	 <div id=c>
 	 	 	<div class="c_title">
 	 	 		<div class=title_l>我型我秀</div>
				<div class=title_r><a target="_blank" href="show_index.php">More..</a></div>
			</div>
			<div class="c_context">
				<?php for($i=0;$i<$count;$i++){ ?>
				<div class=c_content>
					<div class=pic><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=120 height=90 src="<?php echo $records[$i]->src?>"></a></div>
					<div class=title><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					<div class=publisher><?php echo $records[$i]->publisher?></div>
				</div>	
				<?php } ?>		
			</div>
			<?php 
				$sql="select * from smg_video where is_adopt=1 and publisher is not null order by priority asc,created_at desc limit 4";
				$records = $db->query($sql);
				$count = count($records);
			?>
			<div class="c_title">
 	 	 		<div class=title_l>番茄视频</div>
				<div class=title_r><a target="_blank" href="video_index.php">More..</a></div>
			</div>
			<div class="c_context">
				<?php for($i=0;$i<$count;$i++){ ?>
				<div class=c_content>
					<div class=pic ><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=120 height=90 src="<?php echo $records[$i]->photo_url?>"></a></div>
					<div class=title><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					<div class=publisher><?php echo $records[$i]->publisher?></div>
				</div>	
				<?php } ?>		
			</div>
		</div>
 	   <!-- end -->
	 </div>	
 	 
 	 <div id=ibody_right>
     <!-- start right !-->
 	 	 <div class=box >
 	 	 	<?php 
				$category_id = category_id_by_name('节目点评');
				$sql='select * from smg_news where is_adopt=1 and category_id='.$category_id.' order by last_edited_at desc limit 8';
				$star=$db->query($sql);
			?>
 	 	 	<div class=r_title>
 	 	 		<div class=title_l>
 	 	 			节目点评
 	 	 		</div>
				<div class=title_r>
					<a target="_blank" href="list.php?id=<?php echo $category_id;?>&type=news">More..</a>
				</div>
 	 	 	</div>
			<?php for($i=0;$i<count($star);$i++){?>
				<div class="content">
					<img src="/images/show/red_square.jpg">
					<div class=c_a><a href="article.php?id=<?php echo $star[$i]->id;?>"><?php echo $star[$i]->short_title;?></a></div>
					<div class=c_t><?php echo  substr($star[$i]->last_edited_at, 5, 5);?></div>
				</div>
			<?php }?>
 	 	 </div>
		 
		  <div class=box >
 	 	 	<?php 
				$category_id = category_id_by_name('部门比拼');
				$sql='select * from smg_news where is_adopt=1 and category_id='.$category_id.' order by last_edited_at desc limit 8';
				$star=$db->query($sql);
			?>
 	 	 	<div class=r_title>
 	 	 		<div class=title_l>
 	 	 			部门比拼
 	 	 		</div>
				<div class=title_r>
					<a target="_blank" href="list.php?id=<?php echo $category_id;?>&type=news">More..</a>
				</div>
 	 	 	</div>
			<?php for($i=0;$i<count($star);$i++){?>
				<div class="content">
					<img src="/images/show/red_square.jpg">
					<div class=c_a><a href="article.php?id=<?php echo $star[$i]->id;?>"><?php echo $star[$i]->short_title;?></a></div>
					<div class=c_t><?php echo  substr($star[$i]->last_edited_at, 5, 5);?></div>
				</div>
			<?php }?>
 	 	 </div>
		 
		  <div class=box style="height:443px; background:url(/images/show/show_index_rbg2.gif)">
 	 	 	<?php 
				$category_id = category_id_by_name('台前幕后');
				$sql='select * from smg_news where is_adopt=1 and category_id='.$category_id.' order by last_edited_at desc limit 17';
				$star=$db->query($sql);
			?>
 	 	 	<div class=r_title>
 	 	 		<div class=title_l>
 	 	 			台前幕后
 	 	 		</div>
				<div class=title_r>
					<a target="_blank" href="list.php?id=<?php echo $category_id;?>&type=news">More..</a>
				</div>
 	 	 	</div>
			<?php for($i=0;$i<count($star);$i++){?>
				<div class="content">
					<img src="/images/show/red_square.jpg">
					<div class=c_a><a href="article.php?id=<?php echo $star[$i]->id;?>"><?php echo $star[$i]->short_title;?></a></div>
					<div class=c_t><?php echo  substr($star[$i]->last_edited_at, 5, 5);?></div>
				</div>
			<?php }?>
 	 	 </div>


 	 
 	 </div>	
</div>
<? require_once('../inc/bottom.inc.php');?>
</body>
</html>

<script>
	$(function(){
		$(".change").hover(function(){
			$("."+$(this).attr('name')).hide();
			$("[name="+$(this).attr('name')+"]").css('color','#999999');
			$("#"+$(this).attr('value')).show();
			$(this).css('color','#25619A');
		});
	});
</script>