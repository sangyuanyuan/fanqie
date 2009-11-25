<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-新闻-新闻列表页面</title>
	<? 	
		css_include_tag('news_dy_list','top','bottom');
		use_jquery();
		js_include_once_tag('news_list','total');
		$db = get_db();
		$sql="select n.short_title,n.title,c.platform,n.id,n.sub_headline,n.sub_news_id,n.category_id,n.click_count,c.id as cid,c.name as categoryname from smg_news n inner join smg_category c on n.category_id=c.id and n.is_adopt=1 and n.category_id=157 order by n.priority asc,n.created_at desc";
		$record=$db->paginate($sql,30);		
  ?>
<script>
	total("新闻列表","news");
</script>
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="#">新闻</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><?php if($id!=""||$id!=null){ ?><a href="news_list.php?id=<? echo $record[0]->cid;?>"><?php echo $record[0]->categoryname;?></a><?php } else if($tags!=""||$tags!=null){?><a href="news_list.php?tags=<? echo $tags;?>"></a><?php echo $tags;?><?php } else{ ?><a href="news_list.php">所有新闻</a><? }?>
		</div>
		<div id=l_b>
			<div class="title" style="margin-top:0px;">改革发展调研</div>
			<div style="width:670px; background:#cccccc; padding-top:7px; padding-left:10px; margin-bottom:20px; font-size:14px; font-weight:bold; float:left; display:inline;"><span style="color:red">小编提示：</span>10月21日，上海广播电视台、上海东方传媒集团有限公司揭牌。这标志着上海广播电视改革发展迈入了新的历史征程。处于这样一个特殊时期，我们广电人应该有何作为？我们要如何加强广播电视台的管理职能，壮大广播电视事业？如何激发内部活力，打造未来在中国乃至国际具有广泛影响的大型骨干文化企业和让我们民族引以为骄傲的传媒品牌？
围绕这些主题，上海广播电视台台长黎瑞刚将于近期陆续前往各个部门开展调研活动，每次调研的讲话稿以及相关内容都将刊登在番茄网“改革发展调研”专区，敬请关注！</div>
			<?php for($i=0;$i<count($record);$i++){
				?>
				<div class=l_b_l>
					<div class=l_b_l_r><a target="_blank" href="/<?php echo $record[$i]->platform;?>/news/news_head.php?id=<?php echo $record[$i]->id;?>"><?php echo '<span style="font-size:14px;">('.delhtml($record[$i]->short_title).')</span>'.delhtml($record[$i]->title);?></a><br><span style="font-size:12px;">点击量：<?php echo $record[$i]->click_count; ?></span></div>
					<div class=l_b_l_b>
						<?php
		 					if($record[$i]->sub_headline==1)
		 					{ 
		 							echo $record[$i]->news_description; 
		 					}
		 					if($record[$i]->sub_headline<>1&&$record[$i]->sub_headline<>""&&$record[$i]->sub_news_id<>"")
		 					{
		 							$sub_news_str=explode(",",$record[$i]->sub_news_id); 
						  		$sub_news_str_num=sizeof($sub_news_str)-1;
		
									for($j=0;$j<=$sub_news_str_num;$j++)
									{
											$sql="select n.*,n.id as news_id,c.* from smg_news n left join smg_category c on n.category_id=c.id where n.id=".$sub_news_str[$j];
											$record_sub_news = $db -> query($sql);
											echo '[<a href="/'.$record_sub_news[0]->platform.'/news/news_head.php?id='.$record_sub_news[0]->news_id.'" target=_blank>'.$record_sub_news[0]->short_title.'</a>]';
									}
							}	
						?>
					</div>
				</div>
			<?php } ?>
			<div id=bbs>
				<div class="title"><div style="width:600px; float:left; display:inline;">在线调研BBS</div><div class=more><a target="_blank" href="/bbs/forumdisplay.php?fid=75">更多>></a></div></div>
				<?php $sql="SELECT subject,tid,lastpost,author FROM bbs_threads where fid=75 order by lastpost desc limit 5";
						$bbs=$db->query($sql);?>
						<div class=thread style="margin-top:10px; text-align:center; font-weight:bold;">标题</a></div><div class="image"></div><div class="author" style="margin-top:10px; font-size:14px; font-weight:bold;">作者</div><div class="date" style="margin-top:10px; font-size:14px; font-weight:bold;">最后回复时间</div>
					<?	for($i=0;$i<count($bbs);$i++)
						{
				 ?>
				 	<div class=thread><a target="_blank" href="http://172.27.203.81:8080/bbs/viewthread.php?tid=<?php echo $bbs[$i]->tid; ?>"><?php echo $bbs[$i]->subject; ?></a></div><div class="image"><?php if($i<2){ ?><img src="/images/pic/new.gif"><?php } ?></div><div class="author"><?php echo $bbs[$i]->author; ?></div><div class="date"><?php echo Format_Date($bbs[$i]->lastpost); ?></div>
				 <?php } ?>
			</div>
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

