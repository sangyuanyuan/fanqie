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
		<div style="width:995px; margin-bottom:20px; line-height:30px; font-size:25px; color:red; font-weight:bold; text-align:center; float:left; display:inline;">狼羊PK结果揭晓<br><span style="font-size:20px;">请获奖的筒子和参与的筒子们来上视26楼番茄网领取奖品</span></div>
		<?php 
		$db=get_db();
		$wolf=$db->query("select * from smg_images where id=4763 order by priority asc,created_at desc");
		?>
		<div style="width:995px; float:left; display:inline;">
			<div style="width:497px; height:746px; float:left; display:inline;"><a target="_blank" href="<?php echo $wolf[0]->src; ?>"><img border=0 width=497 height=746 src="<?php echo $wolf[0]->src; ?>"></a></div>
			<div style="width:490px; height:746px; margin-left:8px; line-height:20px; float:left; display:inline;">
				<div style="width:60px; float:left; display:inline;">姓名：</div><div style="width:430px; height:20px;  overflow:hidden; float:right; display:inline;"><?php echo $wolf[0]->publisher; ?></div>
				<div style="width:60px; float:left; display:inline;">留言：</div><div style="width:430px; height:740px; overflow:hidden; float:right; display:inline;"><?php echo get_fck_content($wolf[0]->description); ?></div>
			</div>
		</div>
		<div style="width:995px; text-align:center; float:left; display:inline;"><img src="/images/pkend.gif"></div>
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
