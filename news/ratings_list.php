<?php
	require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-收视率预测列表</title>
	<? 	
		css_include_tag('news_news_list','top','bottom');
		use_jquery();
		js_include_once_tag('news_list','total');
		$db = get_db();
		$sql="SELECT v.value,v.date,i.id,i.name,i.content FROM smg_rating_value v left join smg_report_item i on v.item_id=i.id where i.is_dept=1 and i.is_show=1 order by v.date desc";
		$record=$db->paginate($sql,30);
		
  ?>
<script>
		total("收视率预测列表","server");
</script>
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a>
		</div>
		<div id=l_b>
			<div class=l_b_l style="width:450px; font-size:14px; font-weight:bold;">
					<div class=l_b_l_l style="background:none;"></div>
					<div class=l_b_l_r style="width:430px; ">
						<div style="width:400px; float:left; display:inline;">节目名称</div><div style="width:30px; float:right; display:inline;">收视率</div></div>
				</div>
				<div class=l_b_r style="width:170px; font-size:14px; font-weight:bold; color:#000000;">预测时间段</div>
			<?php for($i=0;$i<count($record);$i++){
				$w = date( "w ",strtotime(substr($record[$i]->date,0,10)));
			  if($w!=0)
			  {
					$date=aweek(substr($record[$i]->date,0,10),1);
				}
				if(substr($record[$i]->date,0,10)==$date[5]||$w==0)
				{
					$datetime=substr($record[$i]->date,0,10);	
				}
				else
				{
					$datetime=$date[0]." -- ".$date[4];	
				}		
				?>
				<div class=l_b_l style="width:450px;">
					<div class=l_b_l_l></div>
					<div class=l_b_l_r style="width:430px;">
						<div style="width:400px; float:left; display:inline;"><a target="_blank" href="/news/ratings.php?id=<?php echo $record[$i]->id;?>"><?php echo delhtml($record[$i]->name);?></a></div><div style="width:30px; float:right; display:inline;"><?php echo $record[$i]->value; ?></div></div>
				</div>
				<div class=l_b_r style="width:170px;"><?php echo $datetime; ?></div>
				<?php } ?>
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

