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
				$sql = 'select i.title,i.src from smg_images i left join smg_category c on i.category_id=c.id where i.is_adopt=1 and c.name="番茄广告" and c.category_type="picture" order by i.priority asc,created_at desc limit 4';
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
				$sql="select * from smg_news where is_adopt=1 and category_id in (select id from smg_category where name='每日之星') and is_adopt=1 order by priority asc,last_edited_at desc";
				$star=$db->query($sql);
			?>
 	 	 	<div class=l_title>
 	 	 		<div class=title_l>
 	 	 			每日之星
 	 	 		</div>
				<div class=title_r>
					<?php if(count($star)>0){?><a target="_blank" href="list.php?id=<?php $star[0]->category_id;?>">More..</a><?php } ?>
				</div>
 	 	 	</div>
			<?php for($i=0;$i<count($star);$i++){?>
				<div class="content"><img src="/images/show/red_square.jpg">　<a href="star.php?id=<?php echo $star[$i]->id;?>"><?php echo $star[$i]->title;?></a></div>
			<?php }?>
 	 	 </div>
 	   <!-- end -->
 	 
     <!-- start left_middle !-->
 	 	 <div id=l_m>
 	 	 	<?php 
				$sql = 'select * from smg_video where month(created_at)=month("'.date("Y-m-d").'") order by click_count desc limit 5;';
				$spphb=$db->query($sql,5);
			?>
 	 	 	<div class=l_title>
 	 	 		<div class=title_l>
 	 	 			视频排行榜
 	 	 		</div>
				<div class=title_r>
					<?php if(count($star)>0){?><!--<a target="_blank" href="list.php?id=<?php $star[0]->category_id;?>">More..</a>--><?php } ?>
				</div>
 	 	 	</div>
			<div class=content>
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
									<a href="video.php?id=<?php echo $spphb[$i]->id;?>">test<?php echo $spphb[$i]->title;?></a><br>
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
			<?php 
				$sql = 'select * from smg_images where month(created_at)=month("'.date("Y-m-d").'") order by click_count desc limit 5;';
				$wxwxph=$db->query($sql);
				$sql="select * from smg_images where is_adopt=1 and category_id in (select id from smg_category where name='摄友') order by click_count desc";
				$sy=$db->paginate($sql,5);
			?>
			<div class=l_title>
 	 	 		<div class=title_l>
 	 	 			<span id="t_l1" onmouseover="ChangeTab(1)" style="border-right:1px dotted #25619A;">我行我秀排行榜 </span>
					<span id="t_l2" onmouseover="ChangeTab(2)" style="margin-left:5px;">摄友排行榜</span>
 	 	 		</div>
				<div class=title_r>
					<?php if(count($star)>0){?><!--<a target="_blank" href="list.php?id=<?php $star[0]->category_id;?>">More..</a>--><?php } ?>
				</div>
 	 	 	</div>
			<div class=content>
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
									<a target="_blank" href="<?php echo $wxwxph[$i]->url;?>"><?php echo $wxwxph[$i]->title;?></a><br>
									<span><?php echo get_fck_content($wxwxph[$i]->description);?></span>
									<span>点击量：<?php echo $wxwxph[$i]->click_count;?></span>
								</div>
							</div>
						<?php }else{?>
							<div class=context2 <?php if($i==(count($spphb)-1)){?>style="border:0;"<?php } ?>>
								<div class=left><a target="_blank" href="video.php?id=<?php echo $wxwx[$i]->id;?>"><?php echo get_fck_content($wxwxph[$i]->title);?></a></div>
								<div class=right><?php echo $wxwxph[$i]->click_count;?></div>
							</div>
						<?php } ?>
					</div>
				<?php } 
				 for($i=0;$i<count($sy);$i++){?>
					<div class="context" id="picph2" style="display:none;">
						<?php if($i<3){?>
							<div class=pic1>0<?php echo $i+1;?></div>
						<?php }else{?>
							<div class=pic2>0<?php echo $i+1;?></div>
						<?php } if($i==0){?>					
							<div class=context1>
								<div class=left><img style="margin-top:2px; margin-left:2px; float:left; display:inline;" width=67 height=52 src="<?php echo $sy[$i]->src;?>"></div>
								<div class=right>
									<a target="_blank" href="<?php echo $sy[$i]->url;?>"><?php echo $sy[$i]->title;?></a><br>
									<span><?php echo get_fck_content($sy[$i]->description);?></span>
									<span>点击量：<?php echo $sy[$i]->click_count;?></span>
								</div>
							</div>
						<?php }else{?>
							<div class=context2>
								<div class=left><a target="_blank" href="video.php?id=<?php echo $sy[$i]->id;?>"><?php echo get_fck_content($sy[$i]->title);?></a></div>
								<div class=right><?php echo $sy[$i]->click_count;?></div>
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
				$sql="select * from smg_images where is_adopt=1 and category_id in (select id from smg_category where name='在线杂志') order by created_at desc";
				$magazine=$db->paginate($sql,1);
			?>
 	 	 	<div class=l_title>
 	 	 		<div class=title_l>
 	 	 			在线杂志
 	 	 		</div>
				<div class=title_r>
					<?php if(count($magazine)>0){?><a target="_blank" href="list.php?id=<?php $magazine[0]->category_id;?>">More..</a><?php } ?>
				</div>
 	 	 	</div>
			<div class="l_b_l">
				<a target="_blank" href="<?php echo $magazine[0]->url;?>"><img width=129 height=163 border=0 src="<?php echo $magazine[0]->src;?>"></a>
			</div>
			<div class="l_b_r">
				<a target="_blank" href="<?php echo $magazine[0]->url;?>"><?php echo $magazine[0]->title;?></a><br>
				<span style="width:; height:85px; margin-top:5px;"><?php echo $magazine[0]->description;?></span><br>
				发行日期：<?php echo substr($magazine[0]->created_at,0,9); ?>
			</div>
 	 	 </div>
 	   <!-- end -->

 	 </div>	 
 	 
 	 <div id=ibody_center>
 	 	<?php 
		$sql="select * from smg_images where is_adopt=1 and category_id in (select id from smg_category where name='我行我秀') order by priority asc,created_at desc";
		$wxwx=$db->paginate($sql,6);?>
     <!-- start center !-->
 	 	 <div id=c>
 	 	 	<div class="c_title">
 	 	 		<div class=title_l>我行我秀</div>
				<div class=title_r><a target="_blank" href="show_index.php">More..</a></div>
			</div>
			<div class="context">
				<div class=c_content>
					<div class=left>
						<div class=pic><a target="_blank" href="<?php echo $wxwx[0]->url;?>"><img width=120 height=90 border=0 src="<?php echo $wxwx[0]->src;?>"><br><?php echo $wxwx[$i]->title; ?></a></div><?php echo $wxwx[0]->uploader;?></div>
					<div class=right>
						<div class=pic><a target="_blank" href="<?php echo $wxwx[1]->url;?>"><img width=120 height=90 border=0 src="<?php echo $wxwx[1]->src;?>"><br><?php echo $wxwx[$i]->title; ?></a></div><?php echo $wxwx[1]->uploader;?></div>
				</div>
				<div class=c_content>
					<div class=left>
						<div class=pic><a target="_blank" href="<?php echo $wxwx[2]->url;?>"><img width=120 height=90 border=0 src="<?php echo $wxwx[0]->src;?>"><br><?php echo $wxwx[$i]->title; ?></a></div><?php echo $wxwx[0]->uploader;?></div>
					<div class=right>
						<div class=pic><a target="_blank" href="<?php echo $wxwx[3]->url;?>"><img width=120 height=90 border=0 src="<?php echo $wxwx[1]->src;?>"><br><?php echo $wxwx[$i]->title; ?></a></div><?php echo $wxwx[1]->uploader;?></div>
				</div>
				<div class=c_content>
					<div class=left>
						<div class=pic><a target="_blank" href="<?php echo $wxwx[4]->url;?>"><img width=120 height=90 border=0 src="<?php echo $wxwx[0]->src;?>"><br><?php echo $wxwx[$i]->title; ?></a></div><?php echo $wxwx[0]->uploader;?></div>
					<div class=right>
						<div class=pic><a target="_blank" href="<?php echo $wxwx[5]->url;?>"><img width=120 height=90 border=0 src="<?php echo $wxwx[1]->src;?>"><br><?php echo $wxwx[$i]->title; ?></a></div><?php echo $wxwx[1]->uploader;?></div>
				</div>
			</div>
			<?php 
				$sql="select * from smg_video where is_adopt=1 and category_id in (select id from smg_category where name='番茄视频') order by priority asc,created_at desc";
				$video=$db->paginate($sql,4);?>
			<div class="c_title">
 	 	 		<div class=title_l>番茄视频</div>
				<div class=title_r><a target="_blank" href="show_video.php">More..</a></div>
			</div>
			<div class="context">
				<div class=c_content>
					<div class=left>
						<div class=pic><a target="_blank" href="<?php echo $video[0]->url;?>"><img width=120 height=90 border=0 src="<?php echo $wxwx[0]->src;?>"><br><?php echo $wxwx[$i]->title; ?></a></div><?php echo $wxwx[0]->uploader;?></div>
					<div class=right>
						<div class=pic><a target="_blank" href="<?php echo $video[1]->url;?>"><img width=120 height=90 border=0 src="<?php echo $wxwx[1]->src;?>"><br><?php echo $wxwx[$i]->title; ?></a></div><?php echo $wxwx[1]->uploader;?></div>
				</div>
				<div class=c_content>
					<div class=left>
						<div class=pic><a target="_blank" href="<?php echo $video[2]->url;?>"><img width=120 height=90 border=0 src="<?php echo $wxwx[0]->src;?>"><br><?php echo $wxwx[$i]->title; ?></a></div><?php echo $wxwx[0]->uploader;?></div>
					<div class=right>
						<div class=pic><a target="_blank" href="<?php echo $video[3]->url;?>"><img width=120 height=90 border=0 src="<?php echo $wxwx[1]->src;?>"><br><?php echo $wxwx[$i]->title; ?></a></div><?php echo $wxwx[1]->uploader;?></div>
				</div>
 	 		</div>
		</div>
 	   <!-- end -->
	 </div>	
 	 
 	 <div id=ibody_right>
     <!-- start right !-->
	 <?php 
	 	$sql="select * from smg_news where is_adopt=1 and category_id in (select id from smg_category where name='节目点评') order by priority asc,last_edited_at desc";
	  	$jmdp=$db->paginate($sql,7);
	  ?>
 	 	 <div class=r>
 	 	 	<div class=r_title>
 	 	 		<div class=title_l>节目点评</div>
				<div class=title_r>
					<?php if(count($jmdp)>0){?><a target="_blank" href="list.php?id=<?php $jmdp[0]->category_id;?>">More..</a><?php } ?>
				</div>
 	 	 	</div>
			<div class=content>
				<?php for($i=0;$i<count($jmdp);$i++){?>
					<div class="content"><img src="/images/show/red_square.jpg">　<a href="star.php?id=<?php echo $jmdp[$i]->id;?>"><?php echo $jmdp[$i]->title;?></a></div>
				<?php }?>
			</div>
 	 	 </div>
 	   <!-- end -->
 	   <?php 
	 	$sql="select * from smg_news where is_adopt=1 and category_id in (select id from smg_category where name='部门比拼') order by priority asc,last_edited_at desc";
	  	$bmbp=$db->paginate($sql,7);
	  ?>
     <!-- start right !-->
 	 	 <div class=r>
 	 	 	<div class=r_title>
 	 	 		<div class=title_l>部门比拼</div>
				<div class=title_r>
					<?php if(count($bmbp)>0){?><a target="_blank" href="list.php?id=<?php $bmbp[0]->category_id;?>">More..</a><?php } ?>
				</div>
 	 	 	</div>
			<div class=content>
				<?php for($i=0;$i<count($bmbp);$i++){?>
					<div class="content"><img src="/images/show/red_square.jpg">　<a href="star.php?id=<?php echo $bmbp[$i]->id;?>"><?php echo $bmbp[$i]->title;?></a></div>
				<?php }?>
			</div>
 	 	 </div>
 	   <!-- end -->
 	    <?php 
	 	$sql="select * from smg_news where is_adopt=1 and category_id in (select id from smg_category where name='台前幕后') order by priority asc,last_edited_at desc";
	  	$tqmh=$db->paginate($sql,7);
	  ?>
     <!-- start right !-->
 	 	 <div class=r>
 	 	 	<div class=r_title>
 	 	 		<div class=title_l>台前幕后</div>
				<div class=title_r>
					<?php if(count($tqmh)>0){?><a target="_blank" href="list.php?id=<?php $tqmh[0]->category_id;?>">More..</a><?php } ?>
				</div>
 	 	 	</div>
			<div class=content>
				<?php for($i=0;$i<count($tqmh);$i++){?>
					<div class="content"><img src="/images/show/red_square.jpg">　<a href="star.php?id=<?php echo $tqmh[$i]->id;?>"><?php echo $tqmh[$i]->title;?></a></div>
				<?php }?>
			</div>
 	 	 </div>
 	   <!-- end --> 
 	 </div>	
</div>
<? require_once('../inc/bottom.inc.php');?>
</body>
</html>