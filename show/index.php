﻿<?php
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
		js_include_tag('total');
 	?>
</head>
<script>
	total("首页","show");	
</script>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	 <div id=ibody_top>
     <!-- start top_left !-->
 	 	 <div id=t_l>
 	 	 	<?php 
				$db = get_db();
				$sql="select photo_url,video_url from smg_video where tags='视频推荐' and is_adopt=1 and photo_url is not null order by priority asc,created_at desc limit 1";
				$record=$db->query($sql);
				show_video_player('288','230',$record[0]->photo_url,$record[0]->video_url);
			?>
 	 	 </div>
 	   <!-- end -->
 	 
      <!-- start top_right !-->
 	 	 <div id=t_r>
 	 	 	<?php 
				$sql = 'select i.id as img_id,i.title,i.src2,i.priority as ipriority from smg_images i left join smg_category c on i.category_id=c.id where i.priority=0 and i.is_adopt=1 and c.name="番茄广告" and c.platform="show" order by i.priority asc,i.created_at desc limit 4';
				$record_ad=$db -> query($sql);
				$count = count($record_ad);
				for($i=0;$i<$count;$i++){
					$picsurl[]=$record_ad[$i]->src2;
					$picslink[]='/show/show.php?id='.$record_ad[$i]->id;
					$picstext[]=flash_str_replace($record_ad[$i]->title);
				}
			?>
			
			<?php if($count==1){?>
				<a href="/show/show.php?id=<?php echo $record_ad[0]->img_id?>" target=_blank>
					<img src="<?php echo $record_ad[0]->src2?>" width=589; height=209; border=0>
				</a>
			<? }else{?>
				<script src="/flash/sohuflash_1.js" type="text/javascript"></script>
				<div id="focus_02"></div> 
				<script type="text/javascript"> 
				var pic_width1=590; //图片宽度
				var pic_height1=212; //图片高度
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
 	 </div>
 	 
 	 <div id=ibody_left>
     <!-- start left_top !-->
 	 	 <div id=l_t>
 	 	 	<?php 
				$category_id = category_id_by_name('每日之星');
				$sql='select id,title,short_title,last_edited_at from smg_news where is_adopt=1 and category_id='.$category_id.' order by last_edited_at desc limit 9';
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
					<div class=c_a><a target="_blank" href="article.php?id=<?php echo $star[$i]->id;?>" title="<?php echo strip_tags($star[$i]->title);?>"><?php echo strip_tags($star[$i]->short_title);?></a></div>
					<div class=c_t><?php echo  substr($star[$i]->last_edited_at, 5, 5);?></div>
				</div>
			<?php }?>
 	 	 </div>
 	   <!-- end -->
 	 
     <!-- start left_middle !-->
 	 	 <div id=l_m>
 	 	 	<?php 
				$sql = 'select t1.id,t1.description,t1.click_count,t1.title,t1.photo_url from smg_video t1 join smg_category t2 on t1.category_id=t2.id where month(t1.created_at)=month("'.date("Y-m-d").'") and year(t1.created_at)=year("'.date("Y-m-d").'") and t1.is_adopt=1 and t2.platform="show" order by t1.click_count desc limit 5';
				$spphb=$db->query($sql);
				$sql = 'SELECT t1.publisher,t1.dept_id,count(t1.title) as num FROM smg_video t1 join smg_category t2 on t1.category_id=t2.id where t1.publisher!="" and t1.is_adopt=1 and t1.publisher!="admin" and t2.platform="show" group by t1.publisher limit 5';
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
									<a href="video.php?id=<?php echo $spphb[$i]->id;?>" target="_blank"><?php echo $spphb[$i]->title;?></a><br>
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
									<a href="list.php?publisher=<?php echo urlencode($bk[$i]->publisher);?>&type=video" target="_blank"><?php echo $bk[$i]->publisher;?></a><br>
									<span><?php echo get_dept_info($bk[$i]->dept_id)->name;?></span>
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
				$sql = 'select t1.id,t1.description,t1.click_count,t1.title,t1.src from smg_images t1 join smg_category t2 on t1.category_id=t2.id where month(t1.created_at)=month("'.date("Y-m-d").'") and year(t1.created_at)=year("'.date("Y-m-d").'") and is_adopt=1 and t2.platform="show" order by t1.click_count desc limit 5;';
				$wxwxph=$db->query($sql);
				$sql = 'SELECT t1.publisher,t1.dept_id,count(t1.title) as num FROM smg_images t1 join smg_category t2 on t1.category_id=t2.id where t1.publisher!="" and t1.publisher!="admin" and t1.is_adopt=1 and t2.platform="show" group by t1.publisher order by num desc limit 5';
				$sy=$db->query($sql);
			?>
			<div class=l_title>
 	 	 		<div class=title_l>
 	 	 			<span id="t_l1" class=change  name="hide2" value="我行我秀排行榜" style="cursor:pointer; border-right:1px dotted #25619A; color:#25619A">我行我秀排行榜</span>
					<span id="t_l2" class=change  name="hide2" value="摄友排行榜" style="cursor:pointer; margin-left:5px; color:#999999">摄友排行榜</span>
 	 	 		</div>
				<div class=title_r>
					<?php if(count($star)>0){?><!--<a target="_blank" href="list.php?id=<?php $star[0]->category_id;?>">More..</a>--><?php } ?>
				</div>
 	 	 	</div>
			<div class="content hide2" id="我行我秀排行榜">
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
				 for($i=0;$i<count($sy);$i++){?>
					<div class="context" >
						<?php if($i<3){?>
							<div class=pic1>0<?php echo $i+1;?></div>
						<?php }else{?>
							<div class=pic2>0<?php echo $i+1;?></div>
						<?php } if($i==0){?>					
							<div class=context1>
								<div class=right>
									<a target="_blank" href="list.php?publisher=<?php echo $sy[$i]->publisher;?>&type=image"><?php echo $sy[$i]->publisher;?></a><br>
									<span><?php echo get_dept_info($sy[$i]->dept_id)->name;?></span>
									<span>图片数：<?php echo $sy[$i]->num;?></span>
								</div>
							</div>
						<?php }else{?>
							<div class=context2 <?php if($i==(count($sy)-1)){?>style="border:0;"<?php } ?> >
								<div class=left><a target="_blank" href="list.php?publisher=<?php echo urlencode($sy[$i]->publisher);?>&type=image"><?php echo $sy[$i]->publisher;?></a></div>
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
				$category_id = category_id_by_name('在线杂志','picture');
				$sql="select t1.id,t1.url,t1.src,t1.description,t1.title,t1.created_at from smg_images t1 join smg_category t2 on t1.category_id = t2.id where t1.is_adopt=1 and t2.name='在线杂志' order by t1.priority asc,t1.created_at desc limit 1";
				$record=$db->query($sql);
			?>
 	 	 	<div class=l_title>
 	 	 		<div class=title_l>
 	 	 			在线杂志
 	 	 		</div>
				<div class=title_r>
					<?php if(count($record)>0){?><a target="_blank" href="list.php?type=image&id=<?php echo $category_id;?>">More..</a><?php } ?>
				</div>
 	 	 	</div>
			<div class="l_b_l">
				<a target="_blank" href="<?php echo $record[0]->url;?>"><img width=129 height=163 border=0 src="<?php echo $record[0]->src;?>"></a>
			</div>
			<div class="l_b_r">
				<div style="width:120px; overflow:hidden"><a target="_blank" href="<?php echo $record[0]->url;?>"><?php echo $record[0]->title;?></a></div>
				<div class=m_info>本期主要内容：</br><font color="#666666"><?php echo $record[0]->description;?></font></div>
				<div class=m_info>发行日期：</br><?php echo substr($record[0]->created_at,0,10); ?></div>
			</div>
 	 	 </div>
 	   <!-- end -->

 	 </div>	 
 	 
 	 <div id=ibody_center>
 	 	<?php
			$category_id = category_id_by_name('我行我秀','picture');
			$sql = "select id,src,title,publisher,dept_id from smg_images where category_id=".$category_id." and is_adopt=1 order by priority,created_at desc limit 6";
			$records = $db->query($sql);
			$count = count($records);
		?>
     <!-- start center !-->
 	 	 <div id=c>
 	 	 	<div class="c_title">
 	 	 		<div class=title_l>我行我秀</div>
				<div class=title_r><a target="_blank" href="show_index.php">More..</a></div>
			</div>
			<div class="c_context">
				<?php for($i=0;$i<$count;$i++){ ?>
				<div class=c_content>
					<div class=pic><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=120 height=90 src="<?php echo $records[$i]->src?>"></a></div>
					<div class=title><a target="_blank" href="show.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					<div class=publisher>作者：<?php if($records[$i]->publisher!=''){ ?><a target="_blank" href="list.php?type=image&publisher=<?php echo $records[$i]->publisher; ?>"><?php } ?><?php echo $records[$i]->publisher!=''?$records[$i]->publisher:(get_dept_info($records[$i]->dept_id)->name!=''?get_dept_info($records[$i]->dept_id)->name:'匿名用户');?><?php if($records[$i]->publisher!=''){ ?></a><?php } ?></div>
				</div>	
				<?php } ?>		
			</div>
			<?php 
				$sql="select t1.id,t1.photo_url,t1.title,t1.publisher,dept_id from smg_video t1 join smg_category t2 on t1.category_id=t2.id where t1.is_adopt=1 and t2.platform='show' order by t1.priority asc,t1.created_at desc limit 4";
				$records = $db->query($sql);
				$count = count($records);
			?>
			<div class="c_title">
 	 	 		<div class=title_l>番茄视听</div>
				<div class=title_r><a target="_blank" href="video_index.php">More..</a></div>
			</div>
			<div class="c_context">
				<?php for($i=0;$i<$count;$i++){ ?>
				<div class=c_content>
					<div class=pic ><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><img border=0 width=120 height=90 src="<?php echo $records[$i]->photo_url?>"></a></div>
					<div class=title><a target="_blank" href="video.php?id=<?php echo $records[$i]->id;?>"><?php echo strip_tags($records[$i]->title);?></a></div>
					<div class=publisher>播客：<?php echo $records[$i]->publisher!=''?$records[$i]->publisher:(get_dept_info($records[$i]->dept_id)->name!=''?get_dept_info($records[$i]->dept_id)->name:'匿名用户');?></div>
				</div>	
				<?php } ?>		
			</div>
		</div>
 	   <!-- end -->
	 </div>	
 	 
 	 <div id=ibody_right>
     <!-- start right !-->
 	 	 <div class=box>
 	 	 	<?php 
				$category_id = category_id_by_name('节目点评');
				$sql='select id,title,short_title,last_edited_at from smg_news where is_adopt=1 and category_id='.$category_id.' order by priority,last_edited_at desc limit 11';
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
					<div class=c_a><a href="article.php?id=<?php echo $star[$i]->id;?>" target="_blank" title="<?php echo strip_tags($star[$i]->title);?>"><?php echo strip_tags($star[$i]->short_title);?></a></div>
					<div class=c_t><?php echo  substr($star[$i]->last_edited_at, 5, 5);?></div>
				</div>
			<?php }?>
 	 	 </div>
		 
		  <div class=box>
 	 	 	<?php 
				$category_id = category_id_by_name('部门比拼');
				$sql='select id,title,short_title,last_edited_at from smg_news where is_adopt=1 and category_id='.$category_id.' order by priority,last_edited_at desc limit 11';
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
					<div class=c_a><a href="article.php?id=<?php echo $star[$i]->id;?>" target="_blank" title="<?php echo strip_tags($star[$i]->title);?>"><?php echo strip_tags($star[$i]->short_title);?></a></div>
					<div class=c_t><?php echo  substr($star[$i]->last_edited_at, 5, 5);?></div>
				</div>
			<?php }?>
 	 	 </div>
		 
		  <div class=box>
 	 	 	<?php 
				$category_id = category_id_by_name('台前幕后');
				$sql='select id,title,short_title,last_edited_at from smg_news where is_adopt=1 and category_id='.$category_id.' order by priority,last_edited_at desc limit 11';
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
					<div class=c_a><a href="article.php?id=<?php echo $star[$i]->id;?>" target="_blank" title="<?php echo strip_tags($star[$i]->title);?>"><?php echo strip_tags($star[$i]->short_title);?></a></div>
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