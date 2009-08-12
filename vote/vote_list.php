	<?php
    require_once('../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG-番茄网-服务-投票</title>
	<?php 
		css_include_tag('top.css','bottom.css','vote.css','vote_right.css');
		js_include_tag('total');
	?>
</head>
<script>
	total("投票列表","server");	
</script>
<body>
	<? require_once('../inc/top.inc.php');
		$db = get_db();
		$vote = $db->paginate('select * from smg_vote where is_sub_vote =0 and is_adopt=1 and category_id!=119 order by id desc',10);	
		$vote_count = count($vote);	
	?>
	<div id=answer>
		<div id=left>
			<div id=title>
				<div id=backup><a target="_blank" href="/">返回首页</a></div>
			</div>
			<div id=content>
				<div id=head>
					<div class=title1><span>最新投票</span></div>
					<div class=title2><span><a href="beginvote.php">发起投票</a></span></div>
					<div id=line></div>
				</div>
				<?php for($i=0;$i<$vote_count;$i++){
					$vote_photo = 	$vote[$i]->photo_url ? $vote[$i]->photo_url : '/images/pic/vote_default.jpg';
				?>
				<div class=context>
					<div class=l>
						<a target="_blank" href="#"><img border=0 width=65 height=65 src="<?php echo $vote_photo;?>"></a>
					</div>
					<div class=c>
						<span><h3 style="display:inline;line-height:25px;"><?php echo strip_tags($vote[$i]->name);?></h3></span><span>　<a target="_blank" href="vote.php?vote_id=<?php echo $vote[$i]->id;?>">参与投票</a>　<a target="_blank" href="vote_show.php?vote_id=<?php echo $vote[$i]->id;?>">查看结果</a></span>
						<div style="text-indent:15px;margin-top:5px;"><?php echo $vote[$i]->description;?><?php if($vote[$i]->publisher!=''){echo "（发起人：".$vote[$i]->publisher.")";}?></div>
					</div>
					<div class=r>
						
					</div>
				</div>
				<?php 
				} 
			
				?>
				<div style="float:right; margin-right:20px;"><?php 	paginate('');?></div>
			</div>
		</div>
		<?php include('../inc/vote_right.inc.php');?>
	</div>
	<? include('../inc/bottom.inc.php');?>
</body>
</html>

<script>
	$(function(){
	})
		
</script>
