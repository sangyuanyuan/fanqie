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
	<? 	
		css_include_tag('news_news','top','bottom');
		use_jquery();
		js_include_once_tag('pubfun','news','pub');
		$db = get_db();
		$sql="select n.*,c.id as cid,c.name as categoryname,d.name as deptname from smg_news n inner join smg_category c on n.category_id=c.id inner join smg_dept d on n.dept_id=d.id and is_adopt=1 and n.id=".$id;
		$record=$db->query($sql);
		$about=search_content($record[0]->keywords,'smg_news','',10);
		$sql="select *,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='flower' and file_type='comment') as flowernum,(select count(*) from smg_digg d where d.diggtoid=c.id and d.type='tomato' and file_type='comment') as tomatonum from smg_comment c where resource_type='news' and resource_id=".$id." order by created_at desc";
		$comment=$db->paginate($sql,5);
		$sql="select count(*) as flowernum,(select count(*) from smg_digg cd where cd.type='tomato' and cd.diggtoid=d.diggtoid and cd.file_type='comment') as tomatonum,c.* from smg_digg d left join smg_comment c on d.diggtoid=c.id and d.type='flower' and d.file_type='comment' group by d.diggtoid order by flowernum desc";
		$digg=$db->query($sql);
		if($record[0]->news_type==2)
		{
			redirect($record[0]->file_name);
		}
		else if($record[0]->news_type==3)
		{
			redirect($record[0]->target_url);
		}
  ?>
	
</head>
<body <?php if($record[0]->forbbide_copy == 1){ ?>onselectstart="return false" <?php }?>>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>
	<input type="hidden" id="newsid" value="<?php echo $id;?>">
	<div id=ibody_left>
		<div id=l_t>
			<img src="/images/news/news_l_t_icon.jpg">　　<a href="/">首页</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="#">新闻</a><span style="margin-left:20px; margin-right:20px; color:#B23200;">></span><a href="news_list.php?id=<? echo $record[0]->cid;?>"><?php echo $record[0]->categoryname;?></a>
		</div>
		<div id=l_b>
			<div id=title><?php echo delhtml($record[0]->title);?></div>
			<div id=comefrom>来源：<?php echo $record[0]->deptname;?>　浏览次数：<span style="color:#C2130E"><?php echo $record[0]->click_count;?></span>　时间：<?php echo $record[0]->last_edited_at;?></div>
			<div id=video><?php if($record[0]->video_src!=""){ show_video_player('529','435',$record[0]->video_photo_src,$record[0]->video_src);} ?></div>
			<div id=content>
				<?php echo get_fck_content($record[0]->content);?>
			</div>
			<?php 
			if($record[0]->vote_id!=""){
				$sql="select * from smg_vote where id=".$record[0]->vote_id;
				$record1=$db->query($sql);
				$sql="select * from smg_vote_item where vote_id=".$record1[0]->id;
				$record2=$db->query($sql);
				if($record1[0]->vote_type=="more_type"){
					for($i=0;$i<count($record2);$i++){
						$sql="select * from smg_vote where id=".$record2[$i]->vote_id;
						$record3=$db->query($sql);
						$sql="select * from smg_vote_item where vote_id=".$record[0]->vote_id;
						$record4=$db->query($sql);
				?>
					<div class=vote>
						<?php echo $record3[0]->name;?><br>
						<?php for($j=0;$j<count($record4);$j++){
						if($record3[0]->max_item_count>1){?>
							<div class=content><input name="cb" type="checkbox" value="<?php echo $record4[$i]->id;?>">
							<?php if($record3[0]->vote_type=="word_vote"){ 
								echo $record4[$j]->title;?></div>
								<?php }else{?>
								<img src="<?php echo $record4[$j]->photourl;?>">		
								<?php }?>
						<?php }
						else{?>
							<div class=content><input name="rb"  type="radio" value="<?php echo $record4[$i]->id;?>">
							<?php if($record3[0]->vote_type=="word_vote"){ 
								echo $record4[$j]->title;?></div>
								<?php }else{?>
								<img src="<?php echo $record4[$j]->photourl;?>">		
								<?php }
							?>
						<?php }
						}?>
						<input type="hidden" id="user_id" value="<?php echo $cookie;?>">
						<input type="hidden" id="limit_type" value="<?php echo $record1[0]->limit_type;?>">
						<button id="vote_submit" onclick="vote()">投票</button>
					</div>
				<? }
				}else{?>
				<div class=vote>
					<?php echo $record1[0]->name;?><br>
					<?php for($i=0;$i<count($record2);$i++){ 
						if($record1[0]->max_item_count>1){
					?>
							<div class=content>
								<input name="cb" type="checkbox" value="<?php echo $record2[$i]->id;?>">
								<?php if($record1[0]->vote_type=="word_vote"){ 
									echo $record2[$i]->title;?>
							</div>
						<?php }else{?>
							<img src="<?php echo $record2[$i]->photourl;?>">		
						<?php }
							?>
						<?php }
						else{?>
							<div class=content>
								<input name="rb" type="radio" value="<?php echo $record2[$i]->id;?>">
							<?php if($record1[0]->vote_type=="word_vote"){ 
								echo $record2[$i]->title;?></div>
							<?php }else{?>
								<img src="<?php echo $record2[$i]->photourl;?>">		
							<?php }
						}
						}?>
						<input type="hidden" id="user_id" value="<?php echo $cookie;?>">
						<input type="hidden" id="limit_type" value="<?php echo $record1[0]->limit_type;?>">
					<button id="vote_submit" onclick="vote()">投票</button>
				</div>
			<? }}?>
			<div id=contentpage><?php echo print_fck_pages($record[0]->content,"news_head.php?id=".$id); ?></div>
			<div id=more><a href="news_list.php?id=<?php echo $record[0]->cid;?>">查看更多新闻>></a></div>
			<div class=abouttitle>更多关于“<span style="text-decoration:underline;"><?php echo delhtml($record[0]->shorttile);?></span>”的新闻</div>
			<div class=aboutcontent>
				<div class=title>相关链接</div>
				<?php for($i=0;$i<count($about);$i++){ ?>
					<div class=content>
						<?php if($about[$i]->category_id=="1"||$about[$i]->category_id=="2"){ ?>
							·<a target="_blank" href="news_head.php?id=<?php echo $about[$i]->id; ?>">
								<?php echo delhtml($about[$i]->title); ?>  <span style="color:#838383">(<?php echo $about[$i]->last_edited_at; ?>)</span>
							</a>
						<?php }else if($about[$i]->video_src!=""){?>
							·<a target="_blank" href="news_video.php?id=<?php echo $about[$i]->id; ?>">
								<?php echo delhtml($about[$i]->title); ?>  <span style="color:#838383">(<?php echo $about[$i]->last_edited_at; ?>)</span>
							</a>
						<?php }else{?>
							·<a target="_blank" href="news.php?id=<?php echo $about[$i]->id; ?>">
								<?php echo delhtml($about[$i]->title); ?>  <span style="color:#838383">(<?php echo $about[$i]->last_edited_at; ?>)</span>
							</a>
						<?php }?>
					</div>
				<?php } ?>
					
			</div>
			<?php if($record[0]->is_commentable>0){ if(count($comment)>0){?>
			<div id=comment>
				<?php if(count($digg)>0){
					 for($i=0;$i<2;$i++){ ?>
					<div class=content>	
						<div class=title1>
							<div style="width:110px; line-height:20px; margin-left:118px; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><? echo $digg[$i]->title;?></span>
							</div>
							<div style="width:370px; line-height:20px;  float:right; display:inline;">
								<img onclick="digg('flower',<? echo $digg[$i]->id;?>)" src="/images/news/news_flower.jpg">　　<span style="color:#FF0000;"><?php echo $digg[$i]->flowernum;?></span><img onclick="digg('tomato',<? echo $digg[$i]->id;?>)" style="margin-left:100px;" src="/images/news/news_tomato.jpg">　　<span style="color:#FF0000;"><?php echo $digg[$i]->tomatonum;?></span>　<span style="color:#FF0000;"><?php echo $digg[$i]->created_at; ?></span>
							</div>
						</div>	
						<div class=context>
							<?php echo get_fck_content($digg[$i]->comment);?>
						</div>
					</div>
				<?php }}  for($i=0;$i<count($comment);$i++){ ?>
					<div class=content>	
						<div class=title>
							<div style="width:230px; float:left; display:inline;">
								<span style="color:#FF0000; text-decoration:underline;"><? echo $comment[$i]->title;?></span>
							</div>
							<div style="width:370px; float:right; display:inline;">
								<img onclick="digg('flower',<? echo $comment[$i]->id;?>)" src="/images/news/news_flower.jpg">　　<span style="color:#FF0000;"><?php echo $comment[$i]->flowernum;?></span><img onclick="digg('tomato',<? echo $comment[$i]->id;?>)" style="margin-left:100px;" src="/images/news/news_tomato.jpg">　　<span style="color:#FF0000;"><?php echo $comment[$i]->tomatonum;?></span>　<span style="color:#FF0000;"><?php echo $comment[$i]->created_at; ?></span>
							</div>
						</div>	
						<div class=context>
							<?php echo get_fck_content($comment[$i]->comment);?>
						</div>
					</div>
				<?php } ?>
				<div id=page><?php  paginate('news.php?id='.$id);?></div>
			</div>
			<?php }?>
			<div class=abouttitle>发表评论</div>
			<form method="post" action="/pub/pub.post.php">
			<div class=aboutcontent>
				<div class=title style="background:#ffffff;">现有<span style="color:#FF5800;"><?php echo count($comment);?></span>人对本文进行了评论　　<a href="comment_list.php?id=<?php echo $id;?>&type=news">查看所有评论</a></div>
				<input type="text" id="commenter" name="post[nick_name]">
				<input type="hidden" id="resource_id" name="post[resource_id]" value="<?php echo $id;?>">
				<input type="hidden" id="resource_type" name="post[resource_type]" value="news">
				<input type="hidden" name="target_url" value="news.php?id=<?php echo $id;?>">
				<input type="hidden" name="type" value="comment">
				<div style="margin-top:5px; margin-left:13px; float:left; display:inline;"><?php show_fckeditor('comment','Title',false,'75','','600');?></div>
				<div id=fqbq>
					
				</div>
				<button id="submit_comment">提交评论</button>
			</div>
			</form>
			<?php } ?>
		</div>
	</div>
	<div id=ibody_right>
		<div id=r_t></div>
		<? if($record[0]->related_videos!=""){?>
	<div id=ibody_right>
		<div id=r_t></div>
		<?php
		$keys = explode(',',$record[0]->related_videos);
		$sql="select * from smg_video where id=".$keys[0];
		$r_video=$db->query($sql);
		 if($record[0]->video_src==""){
		 	if($record[0]->low_quality==0){
			?>
			<div id=r_video><?php show_video_player('298','240',$r_video[0]->photo_url,$r_video[0]->video_url);?></div>
		<?php }
			else
			{?>
				<div id=r_video><?php show_video_player('150','120',$r_video[0]->photo_url,$r_video[0]->video_url);?></div>
			<?php }
		}} ?>
		<div id=r_m>
			<?php 
			 for($i=1;$i<count($keys);$i++){
			 	$sql="select * from smg_video where id=".$keys[$i];
			 	$morehead=$db->query($sql);
			 ?> 
			 	<div class="r_content">
			 		<?php if($i<3){?>
			 			<div class=pic1>0<?php echo $i+1;?></div>
			 			<div class=cl1><a starget="_blank" href="/show/video.php?id=<?php echo $morehead[0]->id;?>"><?php echo delhtml($morehead[0]->title);?></a></div>
					<?php }else{?>
						<div class=pic2>0<?php echo $i+1;?></div>
						<div class=cl2><a starget="_blank" href="/show/video.php?id=<?php echo $morehead[0]->id;?>"><?php echo delhtml($morehead[0]->title);?></a></div>
					<?php }?>				
				</div>
			<? }?>
		</div>
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
			 			<div class=cl1><a starget="_blank" href="/news/news_head.php?id=<?php echo $morehead[$i]->id;?>"><?php echo delhtml($morehead[$i]->short_title);?></a></div>
					<?php }else{?>
						<div class=pic2>0<?php echo $i+1;?></div>
						<div class=cl2><a starget="_blank" href="/news/news_head.php?id=<?php echo $morehead[$i]->id;?>"><?php echo delhtml($morehead[$i]->short_title);?></a></div>
					<?php }?>				
				</div>
			<?php }?>
		</div>
		<div id=r_b_t>
			<div class=b_t_title1 id=r_b_t_title1 onmouseover="ChangeTab1(1)">论坛新帖</div>
			<div class=b_t_title1 id=r_b_t_title2 onmouseover="ChangeTab1(2)">博客新帖</div>
			<div class=b_t_title2 id=r_b_t_title3 onmouseover="ChangeTab1(3)">精彩视频</div>
			<div id=b_t_1 style="display:none;">
			
			</div>
			<div id=b_t_2 style="display:none;">
			
			</div>
			<div id=b_t_3 style="display:block;">
			<?php 
			 $sql="select * from smg_video where is_adopt=1 order by priority asc,created_at desc";
			 $jcsp=$db->paginate($sql,10);
			 for($i=0;$i<count($jcsp);$i++){	 	
			 ?>
			 	<div class="r_content">
			 		<ul>
			 			<li><a href="/show/video.php?id=<?php $jcsp[$i]->id;?>"><?php echo get_fck_content($jcsp[$i]->title); ?></a></li>
			 		</ul>			
				</div>
			<? }?>
			</div>
		</div>
		<div id=r_b_b>
			<div class=b_b_title1 id=r_b_b_title1 onmouseover="ChangeTab(1)">部门发表量</div>
			<div class=b_b_title2 id=r_b_b_title2 onmouseover="ChangeTab(2)">部门点击排行榜</div>
			<div id=b_b_1 style="display:none;">
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
			
			<div id=b_b_2 style="display:block;">
			<?php 
			 $sql="select * from smg_dept order by click_count desc";
			 $clickcount=$db->paginate($sql,10);
			 $total=$db->query("select sum(click_count) as total from smg_dept");
			 for($i=0;$i<count($clickcount);$i++){	 	
			 ?>
			 	<div class="r_b2_content">
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