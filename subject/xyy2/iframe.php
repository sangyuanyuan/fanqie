<?php
	require_once('../../frame.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta http-equiv=Content-Language content=zh-cn>
	<? 	
		css_include_tag('wolfpksheep');
		use_jquery();
		js_include_once_tag('total');
  ?>
</head>

<body style="background:url('images/XINGXING<?php echo $_REQUEST['id']; ?>.gif') repeat;">
<div id=iframe>
	<?php 
		$db = get_db();
		$sql = 'select * from smg_images where category_id=168 and is_adopt=1 and parent_id='.$_REQUEST['id'].' order by priority asc,created_at desc';
		$records = $db->query($sql);
		$count = count($records);
		for($i=0;$i<$count;$i++){
	?>

	<div class=content>
		<div class=pic><a target="_blank" href="<?php echo $records[$i]->src; ?>"><img src="<?php echo $records[$i]->src;?>" width="150" height="170" border="0"></a></div>
		<div class=info>
		<div style="width:60px; float:left; display:inline;">姓名：</div><div style="width:190px; height:20px; overflow:hidden; float:right; display:inline;"><?php echo $records[$i]->publisher; ?></div>
		<div style="width:60px; float:left; display:inline;">留言：</div><div style="width:190px; height:100px; overflow:hidden; float:right; display:inline;"><?php echo $records[$i]->description; ?></div>
		</div>
		<div class="flower"><div class="digg" param="<?php echo $records[$i]->id;?>" style="width:29px; height:30px; float:left; display:inline;"><img src="images/flower<?php echo $_REQUEST['id']; ?>.gif"></div><div style="width:70px; height:30px; font-size:16px; font-weight:bold; line-height:30px; <?php if($_REQUEST['id']==1){ ?>color:#60C9FE;<?php }else if($_REQUEST['id']==2){ ?>color:#FF85C2;<?php } ?> float:right; display:inline;"><?php echo $records[$i]->flower;?>朵</div></div>
	</div>
	<?php } ?>
</div>
</body>
</html>
<script>
	$(function(){
		$(".digg").click(function(){
			var flowernum=$(this).next().html();
			flowernum=parseInt(flowernum)+1;
			$(this).next().html(flowernum+"朵");
			$.post("/pub/pub.post.php",{'type':'flower','id':$(this).attr('param'),'db_table':'smg_images','digg_type':'picture'},function(data){			
				if(data!=''){
				}
			});
			total('图片DIGG','news');
		});
	});
</script>