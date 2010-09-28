<?php
	require_once('../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>传媒人投票页面</title>
<?php
	css_include_tag('news_news_list','top','bottom');
	use_jquery();
	js_include_once_tag('total');
?>
<script>
	total("传媒人投票页面","news");	
</script>
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<div id=ibody_left>
		<table>
			<tr>
				<td style="font-size:14px; font-weight:bold;">您多久能看到一次《传媒人》报？</td>
			</tr>
			<tr>
				<td><input class="rd1" type="radio" name="radio1">A.每周都能看到</td>
			</tr>
			<tr>
				<td><input class="rd1" type="radio" name="radio1">B.不是每周固定都能看到</td>
			</tr>
			<tr>
				<td><input class="rd1" type="radio" name="radio1">C.偶尔看到 </td>
			</tr>
			<tr>
				<td><input class="rd1" type="radio" name="radio1">D.从来没看到过</td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>	
			<tr>
				<td style="font-size:14px; font-weight:bold;">您是通过什么途径看到《传媒人》报的？</td>
			</tr>
			<tr>
				<td><input class="rd2" type="radio" name="radio2">A.每周都会发到我的办公室座位上</td>
			</tr>
			<tr>
				<td><input class="rd2" type="radio" name="radio2">B.每周到指定地点领取</td>
			</tr>
			<tr>
				<td><input class="rd2" type="radio" name="radio2">C.我自己没有，从同事那里借阅</td>
			</tr>
			<tr>
				<td><input class="rd2" type="radio" name="radio2">D.其它</td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>	
			<tr>
				<td style="font-size:14px; font-weight:bold;">您一般花多长时间阅读《传媒人》报？</td>
			</tr>
			<tr>
				<td><input class="rd3" type="radio" name="radio3">A.一个小时以上</td>
			</tr>
			<tr>
				<td><input class="rd3" type="radio" name="radio3">B.半个小时到一个小时</td>
			</tr>
			<tr>
				<td><input class="rd3" type="radio" name="radio3">C.半小时以内</td>
			</tr>
			<tr>
				<td><input class="rd3" type="radio" name="radio3">D.只是简单浏览</td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>	
			<tr>
				<td style="font-size:14px; font-weight:bold;">您认为《传媒人》报更需要加强的方面在于：（多选）</td>
			</tr>
			<tr>
				<td><input class="ck1" type="checkbox" >A.沟通信息</td>
			</tr>
			<tr>
				<td><input class="ck1" type="checkbox" >B.交流经验</td>
			</tr>
			<tr>
				<td><input class="ck1" type="checkbox" >C.鼓舞士气</td>
			</tr>
			<tr>
				<td><input class="ck1" type="checkbox" >D.构建团队文化</td>
			</tr>
			<tr>
				<td><input class="ck1" type="checkbox" >E.表彰先进</td>
			</tr>
			<tr>
				<td><input class="ck1" type="checkbox" >F.其他</td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>	
			<tr>
				<td style="font-size:14px; font-weight:bold;">您喜欢看《传媒人》报哪些版面？（多选）</td>
			</tr>
			<tr>
				<td><input class="ck2" type="checkbox" >A.一版</td>
			</tr>
			<tr>
				<td><input class="ck2" type="checkbox" >B.二版</td>
			</tr>
			<tr>
				<td><input class="ck2" type="checkbox" >C.三版</td>
			</tr>
			<tr>
				<td><input class="ck2" type="checkbox" >D.四版</td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>	
			<tr>
				<td style="font-size:14px; font-weight:bold;">您是否曾向《传媒人》报投过稿？</td>
			</tr>
			<tr>
				<td><input class="rd4" type="radio" name="radio4">A.投过，被评为优稿</td>
			</tr>
			<tr>
				<td><input class="rd4" type="radio" name="radio4">B.投过，被采用</td>
			</tr>
			<tr>
				<td><input class="rd4" type="radio" name="radio4">C.投过，没有被采用</td>
			</tr>
			<tr>
				<td><input class="rd4" type="radio" name="radio4">D.没有投过稿</td>
			</tr>
			<tr>
				<td height="10"></td>
			</tr>
			<tr>
				<td style="font-size:14px; font-weight:bold;">您是否知道集团的内部局域网上有《传媒人》报的电子版（http://172.27.203.88/media）？</td>
			</tr>
			<tr>
				<td><input class="rd5" type="radio" name="radio5">A.知道，经常浏览</td>
			</tr>
			<tr>
				<td><input class="rd5" type="radio" name="radio5">B.知道，但不常浏览</td>
			</tr>
			<tr>
				<td><input class="rd5" type="radio" name="radio5">C.从不知道</td>
			</tr>
		</table>
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