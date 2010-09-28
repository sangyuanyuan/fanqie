<?php
	require_once('../../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<title>SMG-番茄网-狼羊PK</title>
	<?php	
		css_include_tag('wolfpksheep','top','bottom');
		use_jquery();
	  js_include_once_tag('total','pubfun','pub');
  ?>
	
</head>
<script>
	total("狼羊PK","server");	
</script>
<body>
<?php 
	require_once('../../inc/top.inc.html');
?>
<div id=ibody>
	<div id=ibody_top>
		<div id=t_t><a target="_blank" href="index.php"><img width="995" height="267" border=0 src="/images/wolfandsheep_top.jpg"></a></div>
		<?php 
		$db=get_db();
		$wolfpksheep= $db->query("select * from smg_images where category_id=168 and is_adopt=1 order by priority asc,created_at desc");
		$wolf=$db->query("select * from smg_images where category_id=168 and is_adopt=1 and parent_id=1 order by priority asc,created_at desc");
		$sheep=$db->query("select * from smg_images where category_id=168 and is_adopt=1 and parent_id=2 order by priority asc,created_at desc");
		$count=sprintf('%.2f',count($wolf)/count($wolfpksheep));
		$count1=sprintf('%.2f',count($sheep)/count($wolfpksheep));
		?>
		<div class=wybm>
			<div style="width:70px; margin-top:10px; margin-left:40px; font-size:16px; line-height:20px; font-weight:bold; float:left; display:inline;">支持率：</div><div style="margin-top:15px; background:url('/images/votebg.gif') repeat-x; height:12px; width:<?php echo ceil($count * 100)*2;?>px; float:left; display:inline;"></div><div style=" height:12px; margin-left:10px; font-size:16px; margin-top:10px; line-height:20px; float:left; display:inline;"><?php echo ($count*100)."%"; ?></div>
			<a href="images_sub.php?id=1" target="_blank"><img src="/images/joinwolf.gif" border=0></a><br>		
		</div>
		<div id="pk"><img src="/images/pk.gif"></div>
		<div class=wybm>
			<div style="width:70px; margin-top:10px; margin-left:40px; font-size:16px; line-height:20px; font-weight:bold; float:left; display:inline;">支持率：</div><div style="margin-top:15px; background:url('/images/votebg.gif') repeat-x; height:12px; width:<?php echo ceil($count1 * 100)*2;?>px; float:left; display:inline;"></div><div style=" height:12px; margin-left:10px; font-size:16px; margin-top:10px; line-height:20px; float:left; display:inline;"><?php echo ($count1*100)."%"; ?></div>
			<a href="images_sub.php?id=2" target="_blank"><img src="/images/joinsheep.gif" border=0></a><br>
			
		</div>
		<div class=group>
			<iframe src="iframe.php?id=1" frameborder="0" width=497 height=706></iframe>
		</div>
		<div class=group>
			<iframe src="iframe.php?id=2" frameborder="0" width=497 height=706></iframe>
		</div>
	</div>
	<div id=ibody_middle>
		<?php
			
			$sql="select * from smg_comment where resource_type='wolfpksheep' order by created_at desc"; 
			$comment=$db->paginate($sql,5);
		?>
		<div id=comment>
			<?php for($i=0;$i<count($comment);$i++){ ?>
			<div class=content>	
				<div class=title>
					<div style="width:230px; height:20px; margin-left:10px; overflow:hidden; line-height:20px; float:left; display:inline;">
						<span style="color:#FF0000; text-decoration:underline;"><?php echo $comment[$i]->nick_name;?></span>
					</div>
					<div style="float:right; display:inline;">
						<div style="width:140px; line-height:20px; color:#FF0000;"><?php echo $comment[$i]->created_at; ?></div>
					</div>
				</div>
				<div class=context>
					<?php echo strfck($comment[$i]->comment);?>
				</div>
			</div>
			<?php } ?>
			<div class=page><?php paginate();?></div>
			<form id="subcomment" name="subcomment" method="post" action="/pub/pub.post.php">
				<div class=aboutcontent>
					<input type="hidden" id="resource_type" name="post[resource_type]" value="wolfpksheep">
					<input type="hidden" id="target_url" name="post[target_url]" value="<?php $string = 'http://' .$_SERVER[HTTP_HOST] .$_SERVER[REQUEST_URI]; echo $string;?>">
					<input type="hidden" name="type" value="comment">
					留 言 人：<input type="text" id="commenter" name="post[nick_name]"><br>
					留言内容：<?php show_fckeditor('post[comment]','Title',false,'75','','617');?><br>
					<div id=fqbq></div>
					<input type="submit" style="margin-left:50px;" value="发表留言">
				</div>
			</form>
		</div>
	</div>
	
</div>
<? require_once('../../inc/bottom.inc.php');?>

</body>
</html>

<script>
	$(function(){
		display_fqbq('fqbq','post[comment]');
	})
</script>
