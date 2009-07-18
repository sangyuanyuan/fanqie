<?php
	require_once('../frame.php');
	$id=$_REQUEST['id'];
	if($id==""||$id==null){die('没有找到网页');}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-新闻-新闻列表页面</title>
	<? 	
		css_include_tag('news_news_list','top','bottom');
		use_jquery();
		js_include_once_tag('news_list');
		$db = get_db();
		$sql="select n.*,c.id as cid,c.name as categoryname from smg_news n inner join smg_category c on n.category_id=c.id and n.category_id=".$id;
		$record=$db->paginate($sql,20);		
  ?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="#">新闻</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="news_list.php?id=<? echo $record[0]->cid;?>"><?php echo $record[0]->categoryname;?></a>
		</div>
		<div id=l_b>
			<?php for($i=0;$i<count($record);$i++){ ?>
				<div class=l_b_l>
					<div class=l_b_l_l><img src="/images/news/li_square.jpg" /></div>
					<div class=l_b_l_r><a target="_blank" href="news.php?id=<?php echo $record[$i]->id;?>"><?php echo get_fck_content($record[$i]->title);?></a></div>
				</div>
				<div class=l_b_r><?php echo $record[$i]->last_edited_at; ?></div>
			<?php }?>
			<div id=page><?php paginate('news_list.php?id='.$id);?></div>
		</div>
	</div>
	<div id=ibody_right>
		<div id=r_t><a target="_blank" href="/news/news_sub.php"><img border=0 src="/images/news/news_head_r_t.jpg"></a></div>
		<div id=r_m>
			<div id=title>小编推荐</div>
			<?php 
			 $sql="select * from smg_news where is_adopt=1 and id<>".$id." and tags='小编推荐' order by priority asc,last_edited_at desc";
			 $xbjj=$db->paginate($sql,8);
			 for($i=0;$i<count($xbjj);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><a starget="_blank" href="/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else{?>
						<div class=pic2>0<?php echo $i+1;?></div>
						<div class=cl2><a starget="_blank" href="/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }?>				
				</div>
			<?php }?>
		</div>
		<div id=r_b_t>
			<div class=b_t_title1 param=1>论坛新帖</div>
			<div class=b_t_title1 param=2>博客新帖</div>
			<div class=b_t_title1 param=3 style="background:url(/images/news/news_r_b_t_title2.jpg) no-repeat">精彩视频</div>
			<div class="b_t" id="b_t_1" style="display:none;">
				<? 
					$sql="SELECT * FROM bbs_posts where subject<>'' order by pid desc";
					$bbs=$db->paginate($sql,10);
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
					$sql="SELECT * FROM blog_spaceitems order by itemid desc";
					$blog=$db->paginate($sql,10);
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
			 $sql="select * from smg_video where is_adopt=1 order by priority asc,created_at desc";
			 $jcsp=$db->paginate($sql,10);
			 for($i=0;$i<count($jcsp);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<ul>
						<li>·<a target="_blank" href="/show/video.php?id=<?php $jcsp[$i]->id;?>"><?php echo get_fck_content($jcsp[$i]->title); ?></a></li>
					</ul>			
				</div>
			<? }?>
			</div>
		</div>
		<div id=r_b_b>
			<div class=b_b_title1 param=1>部门发表量</div>
			<div class=b_b_title1 param=2 style="background:url('/images/news/news_r_b_b_title1.jpg') no-repeat;">部门点击排行榜</div>
			<div id="b_b_1" class="b_b" style="display:none">
			<?php 
			 $sql="select count(*) as num,d.name from smg_news n right join smg_dept d on n.dept_id=d.id group by n.dept_id order by num desc";
			 $clickcount=$db->paginate($sql,10);
			 $total=$db->query("select count(*) as total from smg_dept where dept_id<>''");
			 for($i=0;$i<count($clickcount);$i++){	 	
			 ?>
			 	<div class="r_b2_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><a starget="_blank" href="/news/news_head.php?id=<?php echo $clickcount[$i]->id;?>"><?php echo delhtml($clickcount[$i]->name);?></a></div><div class=percentage><?php $count=$clickcount[$i]->num/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><a starget="_blank" href="/news/news_head.php?id=<?php echo $clickcount[$i]->id;?>"><?php echo delhtml($clickcount[$i]->name);?></a></div><div class=percentage><?php $count=$clickcount[$i]->num/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }?>				
				</div>
			<? }?>
			</div>
			<div id="b_b_2" class="b_b" style="display:block;">
			<?php 
			 $sql="select * from smg_dept order by click_count desc";
			 $clickcount=$db->paginate($sql,10);
			 $total=$db->query("select sum(click_count) as total from smg_dept");
			 for($i=0;$i<count($clickcount);$i++){	 	
			 ?>
			 	<div  class="r_b2_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><a starget="_blank" href="/news/news_head.php?id=<?php echo $clickcount[$i]->id;?>"><?php echo delhtml($clickcount[$i]->name);?></a></div><div class=percentage><?php $count=$clickcount[$i]->click_count/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><a starget="_blank" href="/news/news_head.php?id=<?php echo $clickcount[$i]->id;?>"><?php echo delhtml($clickcount[$i]->name);?></a></div><div class=percentage><?php $count=$clickcount[$i]->click_count/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
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