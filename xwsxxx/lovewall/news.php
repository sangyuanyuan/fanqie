<?php
	require_once('../../frame.php');
	$id=$_REQUEST['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-新闻-普通子页</title>
	<? 	
		css_include_tag('news_news','top','bottom');
		use_jquery();
		js_include_once_tag('pubfun','news','pub','total');
		$db = get_db();
		$sql="select * from centernews_love where hehun_id=".$id;
		$record=$db->query($sql);
		$sql="select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='newscenter_sxxx' and resource_id=".$id." order by created_at desc";
		alert($sql);
		$comment=$db->paginate($sql,5);
  ?>

<script>
	total("新闻中心三项学习教育","other");
</script>
</head>
<body>
<?php
require_once('../../inc/top.inc.html');
?>
<div id=ibody>
	<input type="hidden" id="newsid" value="<?php echo $id;?>">
	<div id=ibody_left>
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="#">新闻</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span>电视新闻中心三项学习教育
		</div>
		<div id=l_b>
			<input type="hidden" id="user_id" value="<?php echo $cookie;?>">
			<div id=title>我要推荐<?php echo delhtml($record[0]->hehun_head);?></div>
			<div id=content>
				<?php echo $record[0]->hehun_lr;?>
			</div>
			<div style="float:left; display:inline;"><a id="pinglun" name="pinglun">&nbsp;</a></div>
			<?php
				
				if(count($comment)>0){?>
			<div id=comment>
				<?php if(count($digg)>0){
				 for($i=0;$i<count($digg);$i++){ ?>
					<!--<div class=content>	
						<div class=title1>
							<div style="width:110px; height:20px; margin-left:118px; overflow:hidden; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><? echo $digg[$i]->nick_name;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<div style="width:220px; height:30px; float:left; display:inline;"><img title="送鲜花" class="flower" src="/images/news/news_flower.jpg" style="float:left; display:inline;"><input type="hidden" value="<?php echo $digg[$i]->id;?>" style="none"><div id="hidden_flower" style="width:65px; height:12px; margin-left:3px; margin-top:8px; color:#FF0000; font-weight:bold; float:left; display:inline;"><?php echo $digg[$i]->flowernum;?></div><img title="扔番茄" class="tomato" style="float:left; display:inline" src="/images/news/news_tomato.jpg"><input type="hidden" value="<?php echo $digg[$i]->id;?>" style="none"><div style="width:60px; height:15px; margin-top:8px; color:#FF0000; font-weight:bold; float:left; display:inline"><?php echo $digg[$i]->tomatonum;?></div></div>
								<div style="width:140px; line-height:20px;  color:#FF0000; float:right; display:inline;"><?php echo $digg[$i]->created_at; ?></div>
							</div>
						</div>
						<div class=context>
								<?php  echo strfck($digg[$i]->comment);?>
							</div>	
					</div>-->
				<?php }}
				
				  for($i=0;$i<count($comment);$i++){ ?>
					<div class=content>	
						<div class=title>
							<div style="width:230px; height:20px; margin-top:10px; margin-left:10px; overflow:hidden; line-height:20px; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><?php echo $comment[$i]->nick_name;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<div style="width:220px; float:left; display:inline;"><img title="送鲜花" class="flower" src="/images/news/news_flower.jpg" style="float:left; display:inline;"><input type="hidden" value="<?php echo $comment[$i]->id;?>" style="none"><div id="hidden_flower" style="width:65px; height:12px; margin-left:3px; margin-top:15px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline;"><?php echo $comment[$i]->flowernum;?></div><img title="扔番茄" class="tomato" style="float:left; display:inline" src="/images/news/news_tomato.jpg"><input type="hidden" value="<?php echo $comment[$i]->id;?>" style="none"><div style="width:60px; height:15px; margin-top:15px; line-height:15px; color:#FF0000; font-weight:bold; float:left; display:inline"><?php echo $comment[$i]->tomatonum;?></div></div>　
								<div style="width:140px; line-height:20px; color:#FF0000; float:right; display:inline"><?php echo $comment[$i]->created_at; ?></div>
							</div>
						</div>
						<div class=context>
							<?php echo strfck($comment[$i]->comment);?>
						</div>
					</div>
			</div>
			<div class=page><?php paginate('');?></div>
			<?php }?>
			<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
			<div class=abouttitle>发表评论</div>
			<div class=aboutcontent style="padding-bottom:10px;">
				<div class=title style="background:#ffffff;">现有<span style="color:#FF5800;"><?php $totalcoment=$db->query("select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='news' and resource_id=".$id." order by created_at desc"); echo count($totalcoment);?></span>人对本文进行了评论<?php if(count($totalcoment)>0){ ?>　　<a target="_blank" style="color:#1862A3"  href="/comment/comment_list.php?id=<?php echo $id;?>&type=news">查看更多评论</a><?php }?>　　<a target="_blank" style="color:#1862A3"  href="/comment/all_comment.php">查看所有评论</a></div>
				<input type="text" id="commenter" name="post[nick_name]">
				<input type="hidden" id="resource_id" name="post[resource_id]" value="<?php echo $id;?>">
				<input type="hidden" id="resource_type" name="post[resource_type]" value="newscenter_sxxx">
				<input type="hidden" id="target_url" name="post[target_url]" value="<?php  $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
				<input type="hidden" name="type" value="comment">
				<div style="margin-top:5px; margin-left:13px; float:left; display:inline;"><?php show_fckeditor('post[comment]','Title',false,'75','','617');?></div>
				<div id=fqbq></div>
				<button style="margin-top:10px; margin-right:15px; border:1px solid #cccccc; background:#ffffff; line-height:20px; float:right; display:inline;" id="comment_sub" >提交评论</button>
			</div>
			</form>
			<?php } ?>
			
			
		</div>
	</div>
	<div id=ibody_right>
		<div id=r_t>
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="298" height="88" id="FLVPlayer">
			 <param name="movie" value="/flash/news.swf" />
			 <param name="salign" value="lt" />
			 <param name="quality" value="high" />
			 <param name="wmode" value="opaque" />
			 <param name="scale" value="noscale" />
			 <param name="FlashVars" value="&image=<?php echo $_REQUEST['photo'] ?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" />
			 <embed src="/flash/news.swf" flashvars="&image=<?php echo $_REQUEST['photo']?>&file=<?php echo $_REQUEST['video'] ?>&displayheight=167&autostart=false" quality="high" scale="noscale" width="298" height="88" name="FLVPlayer" wmode="opaque" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
			</object>		
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
			 $sql="select n.short_title,n.id,n.category_id,n.platform from smg_news n left join smg_category c on n.category_id=c.id where is_adopt=1 and tags='小编推荐' order by n.priority asc,n.created_at desc limit 8";
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
			 $sql="select id,title from smg_video where is_adopt=1 order by priority asc,created_at desc limit 10";
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
			 			<li>·<a  href="/bbs/viewthread.php?tid=<?php echo $bbs[$i]->tid;?>"><?php echo $bbs[$i]->subject; ?></a></li>
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
<? require_once('../../inc/bottom.inc.php');?>

</body>
</html>

