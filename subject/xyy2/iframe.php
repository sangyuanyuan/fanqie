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
		<div class=pic><a target="_blank" href="/show/show.php?id=<?php echo $records[$i]->id; ?>"><img src="<?php echo $records[$i]->src;?>" width="102" height="102" border="0"></a></div>
		<div class=info>
		姓名：<?php echo $records[$i]->publisher; ?><br>
		留言：<span><?php echo $records[$i]->description; ?></span>
		</div>
		<div class="flower"><div class="digg" param="<?php echo $records[$i]->id;?>" style="width:23px; height:24px; float:left; display:inline;"><img src="images/flower<?php echo $_REQUEST['id']; ?>.gif"></div><div style="width:70px; height:24px; font-size:16px; font-weight:bold; line-height:24px; <?php if($_REQUEST['id']==1){ ?>color:#60C9FE;<?php }else if($_REQUEST['id']==2){ ?>color:#FF85C2;<?php } ?> float:right; display:inline;"><?php echo $records[$i]->flower;?>朵</div></div>
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