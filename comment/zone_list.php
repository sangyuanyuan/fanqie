<?php
	require_once('../frame.php');
	session_start();
	setsession($_SERVER['HTTP_HOST']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-记录列表页面</title>
	<? 	
		css_include_tag('comment_list','top','bottom');
		use_jquery();
		js_include_once_tag("comment_list","total");
		$db = get_db();
		$sql="select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='".$_REQUEST["type"]."' order by created_at desc";
		$comment=$db->paginate($sql,10);	
  ?>
<script>
	total("更多评论","news");
</script>
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="#">评论</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="#">评论列表</a>
		</div>
		<div id=l_b>
			<div class=comment>
			 <?php for($i=0;$i<count($comment);$i++){ ?>
					<div class=content>	
						<div class=title>
							<div style="width:230px; margin-top:10px; margin-left:10px; line-height:20px; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><?php echo $comment[$i]->nick_name;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<div style="width:220px; float:left; display:inline;"><img title="送鲜花" class="flower" src="/images/news/news_flower.jpg" style="float:left; display:inline;"><input type="hidden" value="<?php echo $comment[$i]->diggtoid;?>" style="none"><div id="hidden_flower" style="width:50px; height:12px; margin-left:3px; margin-top:15px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline;"><?php echo $comment[$i]->flowernum;?></div><img title="扔番茄" class="tomato" style="float:left; display:inline" src="/images/news/news_tomato.jpg"><input type="hidden" value="<?php echo $comment[$i]->diggtoid;?>" style="none"><div style="width:50px; height:12px; margin-top:15px; margin-left:10px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline"><?php echo $comment[$i]->tomatonum;?></div></div>　
								<div style="width:140px; line-height:20px; color:#FF0000; float:right; display:inline"><?php echo $comment[$i]->created_at; ?></div>
							</div>
						</div>
						<div class=context>
							<?php echo strfck($comment[$i]->comment);  ?>
						</div>
					</div>
					<?php  }?><div class=page><?php paginate('comment_list.php?id='.$_REQUEST['id'].'&type='.$_REQUEST['type']);?></div>
					</div>
				</div>
	</div>
	<div id=ibody_right>
		<div id=r_t><a target="_blank" href="/news/news_sub.php"><img border=0 src="/images/news/news_head_r_t.jpg"></a></div>
		<div id=r_m>
			<div id=title>小编推荐</div>
			<?php 
			 $sql="select n.*,c.platform from smg_news n inner join smg_category c on n.category_id=c.id and is_adopt=1 and tags='小编推荐' order by n.priority asc,last_edited_at desc limit 8";
			 $xbjj=$db->query($sql);
			 for($i=0;$i<count($xbjj);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 		<?php if($xbjj[$i]->category_id==1||$xbjj[$i]->category_id==2){ ?>
						<div class=cl1><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else
					{?>
						<div class=cl1><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }
					}else{
						?>
						<div class=pic2>0<?php echo $i+1;?></div>
						<?php if($xbjj[$i]->category_id==1||$xbjj[$i]->category_id==2){ ?>
						<div class=cl2><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else{?>
						<div class=cl2><a target="_blank" href="/<?php echo $xbjj[$i]->platform;?>/news/news.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }
					}?>				
				</div>
			<?php }?>
		</div>
		<div id=r_b_t>
			<div class=b_t_title1 param=1>论坛新帖</div>
			<div class=b_t_title1 param=2>博客新帖</div>
			<div class=b_t_title1 param=3 style="background:url(/images/news/news_r_b_t_title2.jpg) no-repeat">精彩视频</div>
			<div class="b_t" id="b_t_1" style="display:none;">
				<? 
					$sql="SELECT * FROM bbs_posts where first=1 order by pid desc limit 10";
					$bbs=$db->query($sql);
					for($i=0;$i<count($bbs);$i++){
				?>
				<div class="r_content">
					<ul>
			 			<li>·<a target="_blank" href="/bbs/viewthread.php?tid=<?php echo $bbs[$i]->tid;?>"><?php echo $bbs[$i]->subject; ?></a></li>
					</ul>		
				</div>
				<? }?>
			</div>
			<div class=b_t id="b_t_2" style="display:none;">
				<? 
					$sql="SELECT * FROM blog_spaceitems order by itemid desc limit 10";
					$blog=$db->query($sql);
					for($i=0;$i<count($bbs);$i++){
				?>
				<div class="r_content">
					<ul>
			 			<li>·<a target="_blank" href="/blog/?uid-<?php echo $blog[$i]->uid;?>-action-viewspace-itemid-<?php echo $blog[$i]->itemid;?>"><?php echo $blog[$i]->subject; ?></a></li>		
					</ul>
				</div>
				<? }?>
			</div>
			<div class=b_t id="b_t_3" style="display:inline;">
			<?php 
			 $sql="select * from smg_video where is_adopt=1 order by priority asc,created_at desc limit 10";
			 $jcsp=$db->query($sql);
			 for($i=0;$i<count($jcsp);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<ul>
						<li>·<a target="_blank" href="/show/video.php?id=<?php echo $jcsp[$i]->id;?>"><?php echo strfck($jcsp[$i]->title); ?></a></li>
					</ul>			
				</div>
			<? }?>
			</div>
		</div>
		<div id=r_b_b>
			<div class=b_b_title1 style="font-weight:bold; color:#000000; text-decoration:none;" param=1>部门发表量</div>
			<div class=b_b_title1 param=2 style="color:#C2130E; text-decoration:underline; background:url('/images/news/news_r_b_b_title1.jpg') no-repeat;">部门点击排行榜</div>
			<div id="b_b_1" class="b_b" style="display:none">
			<?php 
			 $sql="SELECT * FROM smg_fgl_count";
			$pubcount=$db->query($sql);
			$total=0;
			for($i=0;$i<count($pubcount);$i++)
			{
				$total=$total+(int)$pubcount[$i]->fgl;
			}
			 for($i=0;$i<count($pubcount);$i++){	 	
			 ?>
			 	<div class="r_b2_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><?php echo $pubcount[$i]->name;?></div><div class=percentage><?php $count=$pubcount[$i]->fgl/$total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><?php echo $pubcount[$i]->name;?></div><div class=percentage><?php $count=$pubcount[$i]->fgl/$total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }?>				
				</div>
			<? }?>
			</div>
			
			<div id=b_b_2 class="b_b" style="display:block;">
			<?php 
			 $sql="select * from smg_djl_count limit 10";
			 $clickcount=$db->query($sql);
			 $total=$db->query("select sum(num) as total from smg_djl_count");
			 for($i=0;$i<count($clickcount);$i++){	 	
			 ?>
			 	<div class="r_b2_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><?php echo delhtml($clickcount[$i]->name);?></div><div class=percentage><?php $count=$clickcount[$i]->num/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><?php echo delhtml($clickcount[$i]->name);?></div><div class=percentage><?php $count=$clickcount[$i]->num/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }?>				
				</div>
			 <? }?>
			 </div>
		</div>
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>

