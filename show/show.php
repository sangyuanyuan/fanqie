<?php
	require_once('../frame.php');
	$id = $_REQUEST['id'];
	$image = new smg_images_class();
	$image->find($id);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-展示-我型我秀子页</title>
	<?php
		css_include_tag('show_show','top','bottom');
		use_jquery();
  	?>
	
</head>
<body>
<? require_once('../inc/top.inc.html');?>
<div id=ibody>	
 <div id=ibody_left>
 	  	<div id=l_t>
	 	  	<a target="_blank" href="#"><img border=0 src="/images/show/show_l_t.jpg"></a>
			  <a target="_blank" style="margin-left:5px;" href="#"><img border=0 width=140 height=70 src=""></a>
			  <a style="margin-left:5px;" target="_blank" href="#"><img border=0  width=140 height=70 src=""></a>
			  <a target="_blank" style="margin-left:5px;" href="#"><img border=0  width=140 height=70 src=""></a>
			  <a style="margin-left:5px;" target="_blank" href="#"><img border=0  width=140 height=70 src=""></a>
 	  	</div>
		<div class=l_m>
			<div class=title><div class=left>用户排行榜</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
			<? for($i=0;$i<5;$i++){?>
				<div class=content <?php if($i==4){?>style="border-bottom:none;"<?php }?>>
					<div class=left><? echo $i+1;?></div>
					<div class=middle><a target="_blank" href="#"><img border=0 width=40 height=40 src=""></a></div>
					<div class=right>
						<div class=top><a target="_blank" href="#">test</a></div>
						<div class=bottom><a target="_blank" href="#">test</a></div>
					</div>
				</div>
			<? }?>
		</div>
		<div class=l_m>
			<div class=title><div class=left>热门标签</div><div class="more"><a target="_blank" href="#">更多>></a></div></div>
			<div class=content style="border-bottom:none;"></div>
		</div>
 </div>
 <div id=ibody_right>
	  <div id=r_t><a target="_blank" href="<?php echo $image->src;?>"><img border=0 src="<?php echo $image->src_path('middle')?>"></a></div>
		<div id=flower><?php echo $image->flower;?></div>
		<div id=tomato><?php echo $image->tomato;?></div>
		<div id=r_b>
			<div id=r_b_l>
				<div class=title>网友评论</div>
				<div class=more><a target="_blank" href="#">更多>></a></div>
				<?php 
					$comments = get_comments($id,'picture',4);
					$count = count($comments);
					$records = get_comments($id,'picture');
					$t_count = count($records);
					for($i=0;$i<$count;$i++){
				?>
					<div class=content>
						<div class=l><a target="_blank" href="#"><img border=0 width=45 height=42 src=""></a></div>
						<div class=r>
							<div class=t><?php echo $comments[$i]->nick_name?></div>
							<div class=b><?php echo $comments[$i]->comment?></div>
						</div>
					</div>
				<?php }?>
				<div id=comment>
					现在有<span style="#FF5800"><?php echo $t_count;?></span>人对本文发表评论　<a target="_blank" href="#">查看所有评论</a>
					<br><input style="width:330px;" type="text"><br><textarea style="width:330px;" rows=5></textarea><br><br><br>
					<button style=" float:right;">提交评论</button>
				</div>
			</div>
			<div id=r_b_r>
				<div class=title>更多该用户的照片</div>
				<div class=more><a target="_blank" href="#">更多>></a></div>
				<?php for($i=0;$i<8;$i++){ ?>
					<div class=pic><a target="_blank" href="#"><img width=145 height=105 border=0 src=""></a></div>
				<?php }?>
			</div>
		</div>

 </div>
</div>
<? require_once('../inc/bottom.inc.php');?>


</body>
</html>