<?php
	require_once('../frame.php');
	$db = get_db();
	$sql = 'select * from smg_zongcai_vote order by id desc limit 1';
	$vote = $db->query($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG   -总裁奖</title>
	<?php 
		css_include_tag('zongcai');
		use_jquery();
	?>
</head>
<body>
	<div id=subject_body>
		<div id=subject_logo>
		</div>
		<div class=subject_title>
			<a href="/">网站首页</a>|<a href="list.php?id=<?php echo category_id_by_name('最新动态','zongcai');?>">最新动态</a>|<a href="item_list.php?id=<?php echo $vote[0]->id; ?>">候选作品</a>|<a href="item_list.php">历届参评节目</a>|<a href="list.php?id=<?php echo category_id_by_name('荣誉榜单','zongcai');?>">荣誉榜单</a>|<a href="list.php?id=<?php echo category_id_by_name('创新经验坛','zongcai');?>">创新经验坛</a>
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
						<a target="_blank" href="zongcai_item.php">参评表格填写</a>
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
					<div id=bottom><div id=his>获奖节目</div><div id=more><a href="list.php?id=<?php echo category_id_by_name('获奖节目','zongcai');?>&type=video">更多</a></div></div>
				</div>
			</div>
			
			<div id=bottom>
				<div id=left>
						<?php
							$category_id = category_id_by_name('最新动态','zongcai');
						?>
						<div class=title><div class=t1>最新动态</div><a target="_blank" href="list.php?id=<?php echo $category_id; ?>">more</a></div>
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
							$sql = 'select t1.name,t1.id,t1.program_type from smg_zongcai_item t1 join smg_zongcai_vote_item t2 on t1.id=t2.item_id where t2.vote_id='.$vote[0]->id;
							$item = $db->query($sql);
							$count = count($item);
							for($i=1;$i<=4;$i++){
						?>
						<div class=title>
							<div class=t1>
								<?php if ($i==1) echo '电视推荐';else if ($i==2) echo '电视自荐'; else if($i==3) echo '广播推荐'; else if ($i==4) echo '广播自荐'; ?>节目投票
							</div>
							<a target="_blank" href="item_list.php?id=<?php echo $vote[0]->id; ?>">more</a>
						</div>
						<div class=content>
							<?php
								switch ($i) {
								    case 1:
								        $type = 'tv_recommend';
								        break;
								    case 2:
								        $type = 'tv_self';
								        break;
								    case 3:
								        $type = 'broadcast_recommend';
								        break;
									case 4:
								        $type = 'broadcast_self';
								        break;
								}
								
								$ip = getenv('REMOTE_ADDR');
								if($ip=="172.27.4.80"||$ip=="172.25.201.88"||$ip=="172.28.10.33"){
									if($_COOKIE[$type]==$vote[0]->id){
										$has_vote = 1;
									}else{
										$has_vote = 0;
									}
								}else{
									$sql = 'select * from smg_zongcai_vote_record where vote_id='.$vote[0]->id.' and type="'.$type.'" and ip="'.$ip.'"';
									$v_r = $db->query($sql);
									if(isset($v_r)){
										$has_vote = 1;
									}else{
										$has_vote = 0;
									}
								}

								for($j=0;$j<$count;$j++){
									if($item[$j]->program_type==$type){
							?>
							<input type="radio" class="<?php echo $type; ?>" name="<?php echo $type; ?>" value="<?php echo $item[$j]->id;?>">
							<a style="color:#000000;text-decoration:none;" href="show_item.php?id=<?php echo $item[$j]->id; ?>"><?php echo $item[$j]->name; ?></a><br>
							<?php
									}
								}
							?>
							
							<div style="margin-top:10px;"><input type="hidden" class="has_vote" value="<?php echo $has_vote;?>"><button name="<?php echo $type; ?>" class="vote">投票</button> 　<button name="<?php echo $type; ?>" class="view">查看</button></div>
						</div>
					<? }?>
					<input type="hidden" id="vote_id" value="<?php echo $vote[0]->id;?>">
					<input type="hidden" id="start_time" value="<?php echo $vote[0]->start_time;?>">
					<input type="hidden" id="end_time" value="<?php echo $vote[0]->end_time;?>">
					<input type="hidden" id="now" value="<?php echo date("Y-m-d H:i:s");?>">
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
							$sql = 'select id,title,short_title,photo_src from smg_news where category_id='.$category_id.' and is_adopt=1 and is_photo_news=1 order by priority,created_at desc limit 4';
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
						<div class=t1>论坛</div><a target="_blank" href="/bbs/">more</a>
					</div>
					
					<div class=content>
						<?php
							$sql = 'select tid,subject from bbs_posts where first=1 order by tid desc limit 10';
							$record = $db->query($sql);
							$count = count($record); 
							for($i=0;$i<$count;$i++){?>
							<div>
								<a target="_blank" title="<?php echo $record[$i]->subject; ?>" href="/bbs/viewthread.php?tid=<?php echo $record[$i]->tid;?>">
									<?php echo $record[$i]->subject;?>
								</a>
							</div>
						<? }?>
					</div>
				
				</div>
			</div>
			<div class=subject_title>发表评论</div>
			<div id=context>
				
				<?php
					$sql = 'select nick_name,comment,created_at from smg_comment where resource_type="zongcai" and resource_id=0 order by id desc';
					$coment_record = $db->paginate($sql,10,'comment');
					$icount = count($coment_record);
					for($i=0;$i<$icount;$i++){
				?>
				<div class=comment>	
					<div class=title><div style="float:left; display:inline;"><?php echo $coment_record[$i]->nick_name;?></div><div style="margin-right:50px; float:right; display:inline"><?php echo $coment_record[$i]->created_at;?></div></div>
					<?php echo $coment_record[$i]->comment;?>
				</div>
				<? }?>
				<div class=new_page>
					<?php paginate('',null,'comment');?>
				</div>
				<form id="comment_form" method="post" action="/pub/pub.post.php">
					<div id=subject_comment>用户：<input type="text" id="nick_name" name="post[nick_name]"/><br /><div id=comment>评论：</div><textarea id=comment_text name="post[comment]"></textarea></div>
					<input type="hidden" name="post[resource_id]" value="0">
					<input type="hidden" name="post[resource_type]" value="zongcai">
					<input type="hidden" name="type" value="comment">
					<button id=btn type="button">评　论</button>
				</form>
			</div>
		</div>
		<div id=subject_bottom>Copyright 2005-2006 MotorTrend.com.cn Science and Technology</div>
	</div>
</body>
</html>

<script>
	$(function(){
		$(".vote").click(function(){
			var s_time = $("#start_time").val();
			var e_time = $("#end_time").val();
			var n_time = $("#now").val();
			
			if(n_time<s_time){
				alert('投票还没开始！');
				return false;
			}
			if(n_time>e_time){
				alert('投票已过期！');
				return false;
			}
			if($(this).prev().val()==1){
				alert('你已经投过票了');
				return false;
			}
			var item = $('input[name='+$(this).attr('name')+'][checked]').val();
			if(item==undefined){
				alert('请选择一个选项后再进行投票！');
			}else{
				$.post('vote.post.php',{'vote_id':$("#vote_id").val(),'item_id':item,'type':$(this).attr('name')},function(data){
					if(data==''){
						alert('投票成功！');
						window.location.reload();
					}else{
						alert(data);
					}
				});
			}
		});
		
		$(".view").click(function(){
			window.location.href = 'vote_view.php?vote_id='+$("#vote_id").val()+'&type='+$(this).attr('name');
		})
		
		$("#btn").click(function(){
			if($("#nick_name").val().length>80){
				alert("昵称长度太长！");
				return false;
			}
			if($("#comment_text").val()==""){
				alert("请输入评论内容！");
				return false;
			}
			$("#comment_form").submit();
		})
	});
</script>
