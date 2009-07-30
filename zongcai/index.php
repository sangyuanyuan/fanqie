<?php
	require_once('../frame.php');
	$db = get_db();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG   -总裁奖</title>
	<?php 
		css_include_tag('zongcai');
	?>
</head>
<body>
	<div id=subject_body>
		<div id=subject_logo>
		</div>
		<div class=subject_title>
			<a href="/">网站首页</a>|<a href="/news/newslist.php?id=49">最新动态</a>|<a href="/subject/subjectlist.php">候选作品</a>|<a href="/subject/subjectlist.php?state=2">历届参评节目</a>|<a href="/news/newslist.php?id=77">荣誉榜单</a>|<a href="cxjyt.php">创新经验坛</a>
		</div>
		<div id=subject_content1>
			<div id=top>
				
				<div id=left>
					<?php 
						$category_id = category_id_by_name('总裁图片','zongcai');
						$img = new smg_images_class();
						$record = $img->find('all',array('conditions' => 'is_adopt=1 and category_id='.$category_id,'order' => 'priority,created_at desc'));
					?>
					<img width=190 height=140 src="<?php echo $record[0]->src_path('small');?>" >
				</div>
				
				<div id=middle>
					<?php
						$category_id = category_id_by_name('参评提示','zongcai');
						$sql = 'select id,description,title from smg_news where category_id='.$category_id.' and is_adopt=1 order by priority,created_at desc';
						$record = $db->query($sql);
					?>
					<div id=title><a target="_blank" href="/news/news.php?id=<?php echo $record[0]->id; ?>"><?php echo $record[0]->title;?></a></div>
					<div id=center><?php echo $record[0]->description;?></div>
					<div id=bottom>
						<?php
							$category_id = category_id_by_name('评选说明','zongcai');
							$sql = 'select id from smg_news where category_id='.$category_id.' and is_adopt=1 order by priority,created_at desc';
							$record1 = $db->query($sql);
							$category_id = category_id_by_name('奖项设置','zongcai');
							$sql = 'select id from smg_news where category_id='.$category_id.' and is_adopt=1 order by priority,created_at desc';
							$record2 = $db->query($sql);
							$category_id = category_id_by_name('评选流程','zongcai');
							$sql = 'select id from smg_news where category_id='.$category_id.' and is_adopt=1 order by priority,created_at desc';
							$record3 = $db->query($sql);
						?>
						<a target="_blank" href="/news/news.php?id=<?php echo $record1[0]->id?>">评选说明</a>
						<a target="_blank" href="/news/news.php?id=<?php echo $record2[0]->id?>">奖项设置</a>
						<a target="_blank" href="/news/news.php?id=<?php echo $record3[0]->id?>">评选流程</a>
						<a target="_blank" href="/subject/zongcai_item.php">参评表格填写</a>
					</div>
				</div>
				<div id=right>
					<div id=top>
						<?php
						  $category_id = category_id_by_name('总裁视频','zongcai');
						  $sql = 'select photo_url,video_url from smg_video where category_id='.$category_id.' and is_adopt=1 order by priority,created_at desc';
						  $record = $db->query($sql);
						  show_video_player(190,120,$record[0]->photo_url,$record[0]->video_url);
						?>
					</div>
					<div id=bottom><div id=his>获奖节目</div><div id=more><a href="/video/videolist2.php?id=10">更多</a></div></div>
				</div>
			</div>
			
			<div id=bottom>
				<div id=left>
						<?php
							$category_id = category_id_by_name('最新动态','zongcai');
						?>
						<div class=title><div class=t1>最新动态</div><a href="/news/newslist.php?id=<?php echo $category_id; ?>">more</a></div>
						<div id=alist style="width:550px; border-right:1px solid #ffffff; border-bottom:1px solid #ffffff; border-left:1px solid #ffffff;">
							<?php 
								$sql = 'select id,title,short_title,created_at from smg_news where category_id='.$category_id.' and is_adopt=1 order by priority,created_at desc limit 5';
								$record = $db->query($sql);
								$count = count($record);
								for($i=0;$i<$count;$i++){
							?>
								<a target="_blank" style="width:350px; margin-top:5px; margin-left:10px; color:#7B3200; text-decoration:none; float:left; dispaly:inline;" title="<?php echo $record[$i]->title;?>" href="/news/news.php?id=<?php echo $record[$i]->id;?>"><?php echo $record[$i]->short_title;?></a>
								<div style="margin-top:5px; margin-right:10px; float:right; display:inline;"><?php echo $record[$i]->created_at; ?></div>
							<? }?>
						</div>	
						<?php
							$sql = 'select * from smg_zongcai_vote order by id desc limit 1';
							$vote = $db->query($sql);
							$sql = 'select t1.name,t1.id,t1.program_type from smg_zongcai_item t1,smg_zongcai_vote_item t2 where t1.id=t2.item_id and t2.vote_id='.$vote[0]->id;
							$item = $db->query($sql);
							$count = count($item);
							for($i=1;$i<=4;$i++){
						?>
						<div class=title>
							<div class=t1>
								<?php if ($i==1) echo '电视推荐';else if ($i==2) echo '电视自荐'; else if($i==3) echo '广播推荐'; else if ($i==4) echo '广播自荐'; ?>节目投票
							</div>
							<a target="_blank" href="/subject/subjectlist.php?state=2">more</a>
						</div>
						<div class=content>
							<?php
								if($i==1){
									
								}
								for($j=0;$j<$count;$j++){
									
							?>
							
							<?php
								}
							?>
						</div>						
					<? }?>	
				</div>
				
				<div id=right>
					<div class=title>
						<?php
							$category_id = category_id_by_name('创新经验坛','zongcai');
						?>
						<div class=t1>创新经验坛</div>
						<a target="_blank" href="list.php?id=<?php echo $category_id; ?>">more</a>
					</div>
					
					<div class=content>
						<?php
							$sql = 'select id,title,short_title  from smg_news where category_id='.$category_id.' and is_adopt=1 order by priority,created_at desc limit 10';
							$record = $db->query($sql);
							$count = count($record); 
							for($i=0;$i<$count;$i++){?>
							<div>
								<a target="_blank" title="<?php echo $record[$i]->title; ?>" href="/news/news.php?id=<? echo $record[$i]->id;?>">
									<?php echo $record[$i]->short_title;?>
								</a>
							</div>
						<? }?>
					</div>
					<div class=title>
						<?php
							$category_id = category_id_by_name('新闻图片','zongcai');
						?>
						<div class=t1>新闻图片</div>
						<a target="_blank" href="list.php?id=<?php echo $category_id; ?>">more</a>
					</div>
					
					<div class=content>
						<?php
							$sql = 'select id,title,short_title  from smg_news where category_id='.$category_id.' and is_adopt=1 and is_photo_news=1 order by priority,created_at desc limit 4';
							$record = $db->query($sql);
							$count = count($record); 
							for($i=0;$i<$count;$i++){?>
						<div class=left>
							<a href="/news/news.php?id=<?php echo $record[$i]->id;?>"><img border=0 width=90 height=70 src="<?php echo $record[$i]->photo_src;?>" ></a>
						</div>
						<div class=right>
							<div class=shang>・<? echo $record[$i]->short_title;?></div>
							<div class=xia>
								<a href="/news/news.php?id=<? echo $record[$i]->id;?>">查看详细>></a>
							</div>
						</div>
						<? }?>
					</div>
					
					<div class=title>
						<div class=t1>论坛</div><a href="/bbs/">more</a>
					</div>
					
					<div class=content>
						<script type="text/javascript" src="/bbs/api/javascript.php?key=threads_latesttop10%28subject%29"></script>
					</div>
				
				</div>
			</div>
			<div class=subject_title>发表评论<div id=more><a href="/comment/comment.php">更多评论>></a></div></div>
			<div id=context>
				
				<? 
				$pageindex = isset($_REQUEST['pageindex']) ?$_REQUEST['pageindex']:1;
				for($i=0;$i < $icount;$i++){?>
				<div class=comment>	
					<div class=title><div style="float:left; display:inline;"><? echo $comments[$i]->commenter;?></div><div style="margin-right:50px; float:right; display:inline"><? echo $comments[$i]->createtime;?></div></div>
					<? echo $comments[$i]->content;?>
				</div>
				<? }?>
				<div id=page>
				</div>
				<form name="commentform" method="post" action="/subject/createcomment.php">
				<div id=subject_comment>用户：<input type="text" name="commenter" id="commenter"/><br /><div id=comment>评论：</div><textarea id="commentcontent" name="comment"></textarea></div>
				<button id=btn onclick="javascript:commentform.submit();">评　论</button>
				</form>
			</div>
		</div>
		<div id=subject_bottom>Copyright 2005-2006 MotorTrend.com.cn Science and Technology</div>
	</div>
</body>
</html>
