<?php
	require_once('../frame.php');
	$id=$_REQUEST['id'];
	$tags=urldecode($_REQUEST['tags']);
	$type=$_REQUEST['type'];
	$iscream=$_REQUEST['cream'];
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
		js_include_once_tag('news_list','total');
		$db = get_db();
		if($id!=""&&$id!=null&&$type=="")
		{
			if($id>2)
			{
				$sql="select n.title,c.platform,n.id,n.last_edited_at,n.category_id,c.id as cid,c.name as categoryname from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and n.category_id=".$id." order by n.priority asc,n.created_at desc";
			}
			else
			{
				$sql="select n.title,c.platform,n.id,n.last_edited_at,n.category_id,c.id as cid,c.name as categoryname from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and n.category_id in (1,2) order by n.priority asc,n.created_at desc";	
			}
		}
		else if($tags!=""&&$tags!=null)
		{
			$sql="select n.title,c.platform,n.id,n.created_at,n.category_id,c.id as cid,c.name as categoryname from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and n.tags='".$tags."' order by n.created_at desc";
		}
		else if($id!=""&&$type!="")
		{
			$sql="select n.id,n.title,n.created_at,n.category_id,n.platform,c.name as cname from smg_news n inner join smg_subject_items i on i.resource_id=n.id and i.category_type='news' and n.is_adopt=1 inner join smg_subject_category c on c.id=i.category_id and c.id=".$id." inner join smg_subject s on c.subject_id=s.id and s.identity='".$type."' order by n.priority asc, n.created_at desc";
		}
		else 
		{
			$sql="select title,platform,id,created_at,category_id from smg_news where is_adopt=1 order by created_at desc";	
		}
		if($id==4&&$iscream!="")
		{
			$sql="select n.title,c.platform,n.id,n.last_edited_at,n.category_id,c.id as cid,c.name as categoryname from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and n.category_id=".$id." and n.cream>=30 order by n.priority asc,n.created_at desc";
		}
		$record=$db->paginate($sql,30);		
  ?>
<script>
	<?php if($id!=238){?>
		total("新闻列表","news");
	<?php }else{?>
		total("收听收视警示榜","subject");
	<?php } ?>
</script>
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="#">新闻</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><?php if($id!=""||$id!=null){ ?><a href="news_list.php?id=<? echo $record[0]->cid;?>"><?php  if($id>2){ echo $record[0]->categoryname;}else{echo '头条';}?></a><?php } else if($tags!=""||$tags!=null){?><a href="news_list.php?tags=<? echo $tags;?>"></a><?php echo $tags;?><?php } else{ ?><a href="news_list.php">所有新闻</a><? }?>
		</div>
		<div id=l_b>
			<?php if($id==4)
			{ ?>
			<div style="width:670px; padding-top:7px; padding-left:10px; margin-bottom:20px; font-size:14px; font-weight:bold; float:left; display:inline;"><a style="color:#000000" target="_blank" href="news_list.php?id=4&cream=cream">精华报料</a>　　<a style="color:#000000" target="_blank" href="news_list.php?id=4">全部报料</a></div>
			<?php } ?>
			<?php for($i=0;$i<count($record);$i++){
				?>
				<div class=l_b_l>
					<?php if($type==""){  if($record[$i]->category_id==1||$record[$i]->category_id==2){ ?>
					<div class=l_b_l_l></div>
					<div class=l_b_l_r><a target="_blank" href="/<?php echo $record[$i]->platform;?>/news/news_head.php?id=<?php echo $record[$i]->id;?>"><?php echo delhtml($record[$i]->title);?></a></div>
				</div>
				<div class=l_b_r><?php echo $record[$i]->created_at; ?></div>
			<?php }else{?>
			<div class=l_b_l_l <?php if($iscream!=""){ ?>style="background:url('/images/cream.gif') no-repeat;"<?php } ?>></div>
					<div class=l_b_l_r><a target="_blank" href="/<?php echo $record[$i]->platform;?>/news/news.php?id=<?php echo $record[$i]->id;?>"><?php echo delhtml($record[$i]->title);?></a></div>
				</div>
				<div class=l_b_r><?php echo $record[$i]->created_at; ?></div>
			<?php }}else{?>
				<div class=l_b_l_l></div>
					<div class=l_b_l_r><a target="_blank" href="/news/news.php?id=<?php echo $record[$i]->id;?>"><?php echo delhtml($record[$i]->title);?></a></div>
				</div>
				<div class=l_b_r><?php echo $record[$i]->created_at; ?></div>
				<?php }} ?>
			<div id=page><?php paginate('');?></div>
		</div>
	</div>
	<div id=ibody_right>
		<div id=r_t><a target="_blank" href="/news/news_sub.php"><img border=0 src="/images/news/news_head_r_t.jpg"></a></div>
		<div class=r_m>
			<div class=title>小编推荐</div>
			<?php 
			 $sql="select n.short_title,n.id,n.category_id,n.platform from smg_news n inner join smg_category c on n.category_id=c.id and is_adopt=1 and tags='小编推荐' order by n.priority asc,n.created_at desc limit 8";
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
		<div class=r_m>
			<div class=title>精彩视频</div>
			 <?php 
			 $sql="select id,title from smg_video where is_adopt=1 order by priority asc,created_at desc limit 10";
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
		<div id=r_b_t>
			<div class=b_t_title1 style="background:url(/images/news/news_r_b_t_title2.jpg) no-repeat" param=1>论坛新帖</div>
			<div class=b_t_title1 param=2>博客新帖</div>
			<div class="b_t" id="b_t_1" style="display:block;">
				<? 
					$sql="SELECT tid,subject FROM bbs_posts where first=1 order by pid desc limit 5";
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
					$sql="SELECT uid,itemid,subject FROM blog_spaceitems order by itemid desc limit 5";
					$blog=$db->query($sql);
					for($i=0;$i<count($blog);$i++){
				?>
				<div class="r_content">
					<ul>
			 			<li>·<a target="_blank" href="/blog/?uid-<?php echo $blog[$i]->uid;?>-action-viewspace-itemid-<?php echo $blog[$i]->itemid;?>"><?php echo $blog[$i]->subject; ?></a></li>		
					</ul>
				</div>
				<? }?>
			</div>
		</div>
		<div id=r_b_b>
			<div class=b_b_title1 style="font-weight:bold; color:#000000; text-decoration:none;" param=1>本月部门发表量</div>
			<div class=b_b_title1 param=2 style="color:#C2130E; text-decoration:underline; background:url('/images/news/news_r_b_b_title1.jpg') no-repeat;">本月点击排行榜</div>
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
			 $sql="select * from smg_djl_count";
			 $clickcount=$db->query($sql);
			 for($i=0;$i<count($clickcount);$i++)
			 {
			 	if($clickcount[$i]->name!="集团办公室"&&$clickcount[$i]->name!="传媒人报")
			 	{
			 			$click[]=array((int)$clickcount[$i]->num,$clickcount[$i]->name);
			 	}
			 	else if($clickcount[$i]->name=="集团办公室")
			 	{
			 			$cmrb=$db->query("select num from smg_djl_count where name='传媒人报'");
			 			$jtbgs=(int)$clickcount[$i]->num+(int)$cmrb[0]->num;
			 			$click[]=array($jtbgs,$clickcount[$i]->name);
			 	}
			 }
			 $click=array2sort($click,0,'d');
			 $total=$db->query("select sum(num) as total from smg_djl_count");
			 for($i=0;$i<10;$i++){	 	
			 ?>
			 	<div class="r_b2_content">
			 		<?php if($i< 3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><?php echo delhtml($click[$i][1]);?></div><div class=percentage><?php $count=$click[$i][0]/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
					<?php }else{?>
						<div class=pic2><? if($i!=9){?>0<?php echo $i+1;?></a><?php }else {?><?php echo $i+1;?><?php }?></div>
						<div class=cl2><?php echo delhtml($click[$i][1]);?></div><div class=percentage><?php $count=$click[$i][0]/$total[0]->total; echo sprintf("%.2f",$count * 100) .'%';?></div>
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

