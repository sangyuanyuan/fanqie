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
	<title>SMG-番茄网-新闻-普通子页</title>
<?php 
		css_include_tag('news_news','top','bottom');
		use_jquery();
		js_include_once_tag('news_cy','total');
		$db = get_db();
		$sql="select * from smg_news_wycy where id=".$id;
		$record=$db->query($sql);
			
?>
<script>
		total("专题-创意","subject");
</script>
</head>
<body>
<?php
require_once('../inc/top.inc.html');
?>
<div id=ibody>
	<div id=ibody_left>
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a>
		</div>
		<div id=l_b>
			<input type="hidden" id="user_id" value="<?php echo $cookie;?>">
			<div id=title><?php echo delhtml($record[0]->title);?></div>
			<div id=comefrom>来源：<?php echo $record[0]->address;?>　作者：<?php echo $record[0]->username;?>　时间：<?php echo $record[0]->created_at;?></div>
			<div id=content>
				<?php echo get_fck_content($record[0]->content);?>
			</div>
			<div id=contentpage><?php echo print_fck_pages($record[0]->content,"/news/news.php?id=".$id); ?></div>	
		</div>
	</div>
	<div id=ibody_right>
		<div id=r_b_b style="margin-top:0px;">
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
			 	if($clickcount[$i]->name!="集团办公室"&&$clickcount[$i]->name!="传媒人报"&&$clickcount[$i]->name!="精神文明办")
			 	{
			 			$click[]=array((int)$clickcount[$i]->num,$clickcount[$i]->name);
			 	}
			 	else if($clickcount[$i]->name=="集团办公室")
			 	{
			 			$cmrb=$db->query("select num from smg_djl_count where name='传媒人报'");
			 			$jswmb=$db->query("select num from smg_djl_count where name='精神文明办'");
			 			$jtbgs=(int)$clickcount[$i]->num+(int)$cmrb[0]->num+(int)$jswmb[0]->num;
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
		<div id=r_t style="margin-top:10px;">
			<?php //$bbtv=$db->query('select file_name from smg_news where dept_category_id=198 and is_dept_adopt=1 order by priority asc,created_at desc'); ?>
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="298" height="88" id="FLVPlayer">
			 <param name="movie" value="/flash/news.swf" />
			 <param name="salign" value="lt" />
			 <param name="quality" value="high" />
			 <param name="wmode" value="opaque" />
			 <param name="scale" value="noscale" />
			 <param name="FlashVars" value="&image=<?php echo $_REQUEST['photo'] ?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" />
			 <embed src="/flash/news.swf" flashvars="&image=<?php echo $_REQUEST['photo']?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" quality="high" scale="noscale" width="298" height="88" name="FLVPlayer" wmode="opaque" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>
			<!--<embed src="<?php echo $bbtv[0]->file_name; ?>" wmode=transparent quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="298" height="88"></embed>-->
			<!--<?php $bbtv=$db->query('select src from smg_images where dept_category_id=197 order by priority asc,created_at desc'); ?>
			<a target="_blank" href="http://www.bbtv.cn"><img border=0 src="<?php echo $bbtv[0]->src; ?>"></a>-->
		</div>
		<?php
		if($record[0]->related_videos!=""){
		$keys = explode(',',$record[0]->related_videos);
		$sql="select photo_url,video_url from smg_video where id=".$keys[0];
		$r_video=$db->query($sql);
		 if($record[0]->video_src==""){?>
			<div class=r_video><?php show_video_player('298','240',$r_video[0]->photo_url,$r_video[0]->video_url);?></div>
		<?php } ?>
		<div class=r_m>
			<?php 
			 for($i=0;$i<count($keys);$i++){
			 	$sql="select id,title from smg_video where id in (".$keys[$i].")";
			 	$videolist=$db->query($sql);
			 ?> 
			 	<div class="r_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><a  href="/show/video.php?id=<?php echo $videolist[0]->id;?>"><?php echo delhtml($videolist[0]->title);?></a></div>
					<?php }else{?>
						<div class=pic2><?php if($i<9){ echo "0".($i+1);}else{ echo $i+1;}?></div>
						<div class=cl2><a  href="/show/video.php?id=<?php echo $videolist[0]->id;?>"><?php echo delhtml($videolist[0]->title);?></a></div>
					<?php }?>				
				</div>
			<? }?>
		</div>
		<? }?>
		<div class=r_m>
			<div class=title>小编推荐</div>
			<?php 
			 $sql="select n.short_title,n.id,n.category_id,n.platform from smg_news n left join smg_category c on n.category_id=c.id where is_adopt=1 and n.id<>".$id." and tags='小编推荐' order by n.priority asc,n.created_at desc limit 8";
			 $xbjj=$db->query($sql);
			 for($i=0;$i<count($xbjj);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 		<?php if($xbjj[$i]->category_id==1||$xbjj[$i]->category_id==2){ ?>
						<div class=cl1><a  href="/<?php echo $xbjj[$i]->platform;?>/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else
					{?>
						<div class=cl1><a  href="/<?php echo $xbjj[$i]->platform;?>/news/news.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }
					}else{
						?>
						<div class=pic2>0<?php echo $i+1;?></div>
						<?php if($xbjj[$i]->category_id==1||$xbjj[$i]->category_id==2){ ?>
						<div class=cl2><a  href="/<?php echo $xbjj[$i]->platform;?>/news/news_head.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }else{?>
						<div class=cl2><a  href="/<?php echo $xbjj[$i]->platform;?>/news/news.php?id=<?php echo $xbjj[$i]->id;?>"><?php echo delhtml($xbjj[$i]->short_title);?></a></div>
					<?php }
					}?>				
				</div>
			<?php }?>
		</div>
		<div class=r_m>
			<div class=title>精彩视频</div>
			 <?php 
			 $sql="select id,title from smg_video where is_adopt=1 and category_id=36 order by priority asc,created_at desc limit 10";
			 $jcsp=$db->query($sql);
			 for($i=0;$i<count($jcsp);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<ul>
						<li>·<a  href="/show/video.php?id=<?php echo $jcsp[$i]->id;?>"><?php echo strfck($jcsp[$i]->title); ?></a></li>
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
			 			<li>·<a href="/blog/?uid-<?php echo $blog[$i]->uid;?>-action-viewspace-itemid-<?php echo $blog[$i]->itemid;?>"><?php echo $blog[$i]->subject; ?></a></li>		
					</ul>
				</div>
				<? }?>
			</div>
		</div>
		
	</div>
</div>
<? require_once('../inc/bottom.inc.php');?>

</body>
</html>

