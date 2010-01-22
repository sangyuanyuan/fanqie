<?php require_once('../frame.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-CN>
	<title>SMG -颁奖盛典</title>
	<?php css_include_tag('vote_jiang','top','bottom','thickbox');
		use_jquery();
		js_include_tag('total','pubfun');
	?>
<script>
	total("颁奖盛典","show");
</script>
</head>
<body>
<? 
	require_once('../inc/top.inc.html');
	js_include_once_tag('thickbox');
	$db = get_db();
	$news=$db->query('SELECT id,src,title,flower FROM smg_images where is_adopt=1 and category_id=179 order by flower desc, priority asc,created_at desc');
?>
<div id=bodys>
	<div id=fqtglist><a href="/">首页</a>　>　<a href="#">获奖人</a></div>
	<div id=fqtglistcount>
		<div style="width:995px; color:red; line-height:30px; font-size:22px; font-weight:bold; text-align:center; float:left; display:inline;"><span style="font-size:25px;">首届上海广播电视台、上海东方传媒集团有限公司颁奖</span><br>获奖人物英雄榜<br><span style="font-size:12px;">(按鲜花数量自动排序)</span></div>
		<?php for($i=0;$i<5;$i++){?>
		<div class=context>
			<div class=cl>
				<div class=cl_top>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><img border=0 width=187 height=150 src="<? echo $news[$i]->src;?>" /></a><br>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><? echo $news[$i]->title;?></a>
				</div>
				<div class=flower name="<?php echo $news[$i]->id; ?>"></div>
				<?php $comment=$db->query('select * from smg_comment where resource_type="vote_flower" and resource_id='.$news[$i]->id.' order by created_at desc');?>
				<div style="width:187px; height:20px; float:left; display:inline;">共有<?php echo $news[$i]->flower; ?>人赠送鲜花</div>
				
				<div class="comment">
					<marquee direction=up behavior="scroll" SCROLLDELAY="200" height=100 width=175 style="margin-left:5px;">
							<?php  for($j=0;$j<count($comment);$j++){ ?>
							<span style="font-weight:bold;"><?php echo $comment[$j]->nick_name; ?></span>:<?php echo $comment[$j]->comment; ?><br>
							<?php } ?>
						</marquee>
				</div>
			
			</div>		
		</div>
		<? }?>
		<div class="line"></div>
		<?php for($i=5;$i<10;$i++){?>
		<div class=context>
			<div class=cl>
				<div class=cl_top>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><img border=0 width=187 height=150 src="<? echo $news[$i]->src;?>" /></a><br>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><? echo $news[$i]->title;?></a>
				</div>
				<div class=flower name="<?php echo $news[$i]->id; ?>"></div>
				<?php $comment=$db->query('select * from smg_comment where resource_type="vote_flower" and resource_id='.$news[$i]->id.' order by created_at desc');?>
				<div style="width:187px; height:20px; float:left; display:inline;">共有<?php echo $news[$i]->flower; ?>人赠送鲜花</div>
				
				<div class="comment">
					<marquee direction=up behavior="scroll" SCROLLDELAY="200" height=100 width=175 style="margin-left:5px;">
							<?php  for($j=0;$j<count($comment);$j++){ ?>
							<span style="font-weight:bold;"><?php echo $comment[$j]->nick_name; ?></span>:<?php echo $comment[$j]->comment; ?><br>
							<?php } ?>
						</marquee>
				</div>
			
			</div>		
		</div>
		<? }?>
		<div class="line"></div>
		<?php for($i=10;$i<15;$i++){?>
		<div class=context>
			<div class=cl>
				<div class=cl_top>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><img border=0 width=187 height=150 src="<? echo $news[$i]->src;?>" /></a><br>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><? echo $news[$i]->title;?></a>
				</div>
				<div class=flower name="<?php echo $news[$i]->id; ?>"></div>
				<?php $comment=$db->query('select * from smg_comment where resource_type="vote_flower" and resource_id='.$news[$i]->id.' order by created_at desc');?>
				<div style="width:187px; height:20px; float:left; display:inline;">共有<?php echo $news[$i]->flower; ?>人赠送鲜花</div>
				
				<div class="comment">
					<marquee direction=up behavior="scroll" SCROLLDELAY="200" height=100 width=175 style="margin-left:5px;">
							<?php  for($j=0;$j<count($comment);$j++){ ?>
							<span style="font-weight:bold;"><?php echo $comment[$j]->nick_name; ?></span>:<?php echo $comment[$j]->comment; ?><br>
							<?php } ?>
						</marquee>
				</div>
			
			</div>		
		</div>
		<? }?>
		<div class="line"></div>
		<?php for($i=15;$i<20;$i++){?>
		<div class=context>
			<div class=cl>
				<div class=cl_top>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><img border=0 width=187 height=150 src="<? echo $news[$i]->src;?>" /></a><br>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><? echo $news[$i]->title;?></a>
				</div>
				<div class=flower name="<?php echo $news[$i]->id; ?>"></div>
				<?php $comment=$db->query('select * from smg_comment where resource_type="vote_flower" and resource_id='.$news[$i]->id.' order by created_at desc');?>
				<div style="width:187px; height:20px; float:left; display:inline;">共有<?php echo $news[$i]->flower; ?>人赠送鲜花</div>
				
				<div class="comment">
					<marquee direction=up behavior="scroll" SCROLLDELAY="200" height=100 width=175 style="margin-left:5px;">
							<?php  for($j=0;$j<count($comment);$j++){ ?>
							<span style="font-weight:bold;"><?php echo $comment[$j]->nick_name; ?></span>:<?php echo $comment[$j]->comment; ?><br>
							<?php } ?>
						</marquee>
				</div>
			
			</div>		
		</div>
		<? }?>
		<div class="line"></div>
		<?php for($i=20;$i<25;$i++){?>
		<div class=context>
			<div class=cl>
				<div class=cl_top>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><img border=0 width=187 height=150 src="<? echo $news[$i]->src;?>" /></a><br>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><? echo $news[$i]->title;?></a>
				</div>
				<div class=flower name="<?php echo $news[$i]->id; ?>"></div>
				<?php $comment=$db->query('select * from smg_comment where resource_type="vote_flower" and resource_id='.$news[$i]->id.' order by created_at desc');?>
				<div style="width:187px; height:20px; float:left; display:inline;">共有<?php echo $news[$i]->flower; ?>人赠送鲜花</div>
				
				<div class="comment">
					<marquee direction=up behavior="scroll" SCROLLDELAY="200" height=100 width=175 style="margin-left:5px;">
							<?php  for($j=0;$j<count($comment);$j++){ ?>
							<span style="font-weight:bold;"><?php echo $comment[$j]->nick_name; ?></span>:<?php echo $comment[$j]->comment; ?><br>
							<?php } ?>
						</marquee>
				</div>
			
			</div>		
		</div>
		<? }?>
		<div class="line"></div>
		<?php for($i=25;$i<30;$i++){?>
		<div class=context>
			<div class=cl>
				<div class=cl_top>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><img border=0 width=187 height=150 src="<? echo $news[$i]->src;?>" /></a><br>
					<a target="_blank" href="<? echo $news[$i]->src;?>"><? echo $news[$i]->title;?></a>
				</div>
				<div class=flower name="<?php echo $news[$i]->id; ?>"></div>
				<?php $comment=$db->query('select * from smg_comment where resource_type="vote_flower" and resource_id='.$news[$i]->id.' order by created_at desc');?>
				<div style="width:187px; height:20px; float:left; display:inline;">共有<?php echo $news[$i]->flower; ?>人赠送鲜花</div>
				
				<div class="comment">
					<marquee direction=up behavior="scroll" SCROLLDELAY="200" height=100 width=175 style="margin-left:5px;">
							<?php  for($j=0;$j<count($comment);$j++){ ?>
							<span style="font-weight:bold;"><?php echo $comment[$j]->nick_name; ?></span>:<?php echo $comment[$j]->comment; ?><br>
							<?php } ?>
						</marquee>
				</div>
			
			</div>		
		</div>
		<? }?>
	</div>
</div>
<? include('../inc/bottom.inc.html');?>	
</body>
</html>
<script>
	$(function(){
		$(".flower").click(function(){
			$.post("/pub/pub.post.php",{'type':'flower','id':$(this).attr('name'),'db_table':'smg_images','digg_type':'vote_jiang'},function(data){
				if(data!=''){
					alert(data);
				}else{
					tb_show('送鲜花送祝福','flower2.php?height=300&width=300&modal=false&id='+$(this).attr('name'));
				}
			});
		});
	});
</script>