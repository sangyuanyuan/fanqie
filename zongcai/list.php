<?php
	require_once('../frame.php');
	$db = get_db();
	$id = $_REQUEST['id'];
	$type = $_REQUEST['type'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-总裁奖列表</title>
	<?php 
		css_include_tag('zongcai');
		use_jquery();
		js_include_once_tag('total');
	?>
</head>
<script>
	total("总裁奖列表","news");	
</script>
<body>
	<?php
		$name = category_name_by_id($id);
		if($type=='video'){
			$sql = 'select id,title,created_at from smg_video where is_adopt=1 and category_id='.$id.' order by priority,created_at desc';
		}else{
			$sql = 'select id,title,short_title,created_at from smg_news where category_id='.$id.' and is_adopt=1 order by priority,created_at desc';
		}
		$programlist = $db->paginate($sql,15);
	?>
	<div id=subject_body>
		<div id=subject_logo></div>
		<div class=subject_title><a href="/" style="color:#FFFFFF;text-decoration:none"> 首页</a> >　<a href="/zongcai" style="color:#FFFFFF;text-decoration:none"> 总裁奖</a>  >　<?php echo $name; ?></div>
		<div id=subject_content1>
		<div id=bottom>
			<div id=subject_contenta style="width:550px; padding-top:20px;">
				<div id=listtitle style="font-size:15px; font-weight:bold; margin-left:20px;"><?php echo $name; ?></div>
				<div id=alist style="width:540px; margin-top:10px; margin-left:15px;">
					<? for($i=0;$i<count($programlist);$i++){?>
						<div style="width:370px; margin-top:5px; margin-left:10px; color:#7B3200; text-decoration:none; float:left; dispaly:inline;overflow:hidden;">
							 <?php if($type=='video'){
							 ?>
							  <a href="/show/video.php?id=<?php echo $programlist[$i]->id;?>" target="_blank" title="<?php echo $programlist[$i]->title;?>"><?php echo $programlist[$i]->title;?></a> <?php echo $programlist[$i]->created_at;?>
							 <?
							 }else{
							 ?>
							  <a href="/news/news.php?id=<?php echo $programlist[$i]->id;?>" target="_blank" title="<?php echo $programlist[$i]->title;?>"><?php echo $programlist[$i]->short_title;?></a> <?php echo $programlist[$i]->created_at;?>
							 <?php
							 } ?>
						</div>
					<? }?>
				</div>
			<div id=context1>
				<div class=new_page>
					<?php paginate();?>
				</div>
			</div>	
		</div>
					
			<div id=right>
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
		`	<div id=context>
				
				<?php
					$sql = 'select nick_name,comment,created_at from smg_comment where resource_type="zongcai" and resource_id=0';
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
					<div id=subject_comment>用户：<input type="text" id=nick_name name="post[nick_name]"/><br /><div id=comment>评论：</div><textarea id=comment_text name="post[comment]"></textarea></div>
					<input type="hidden" name="post[resource_id]" value="0">
					<input type="hidden" name="post[resource_type]" value="zongcai">
					<input type="hidden" name="type" value="comment">
					<button id=btn type="submit">评　论</button>
				</form>
			</div>
		</div>
		<div id=subject_bottom>Copyright 2005-2006 MotorTrend.com.cn Science and Technology</div>
		</div>
		
	</div>
</body>
</html>

<script>
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
</script>
