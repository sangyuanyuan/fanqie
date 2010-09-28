<?php
		require_once('../../frame.php');
		$db=get_db();
		css_include_tag('subject_wxh');
		use_jquery();
?>
<body>
<div class=b_title>热点问题</div>
<div class=b_title style="border-left:none;">人气榜</div>
<div class=b_content>
	<?php
	$question=$db->query("select * from smg_wxh_question where is_adopt=1 order by priority asc, created_at desc");
	 for($i=0;$i<10;$i++){ ?>
		<div class=cl><a class=thickbox href="question.php?height=255&width=320&id=<?php echo $question[$i]->id; ?>"><?php echo $question[$i]->nick_name."：".$question[$i]->title; ?></a></div><div class="flower"><img class="flowernum" param="<?php echo $question[$i]->id; ?>" src="/images/wxh_flower.gif">　<span style="display:none;"><?php echo $question[$i]->flowernum; ?></span></div>
	<?php } ?>
</div>
<div class=b_content style="border-left:none;">
	<?php 
	$question=$db->query("select * from smg_wxh_question where is_adopt=1 order by flowernum desc limit 10");
	for($i=0;$i<10;$i++){ ?>
		<div class=cl><a class=thickbox href="question.php?height=255&width=320&id=<?php echo $question[$i]->id; ?>"><?php echo $question[$i]->nick_name."：".$question[$i]->title; ?></a></div><div class="flower"><img class="flowernum" param="<?php echo $question[$i]->id; ?>" src="/images/wxh_flower.gif">　<span ><?php echo $question[$i]->flowernum; ?></span></div>
	<?php } ?>
</div>
</body>
<script>
	$('.flowernum').click(function(){
		var flowernum=$(this).next().html();
		flowernum=parseInt(flowernum)+1;
		$(this).next().html(flowernum);
		$.post("questionflower.post.php",{'id':$(this).attr('param')},function(data){
				alert('献花成功！');
			});
			total('专题DIGG','subject');
	});
</script>