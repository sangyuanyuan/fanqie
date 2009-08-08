<link href="css/top.css" rel="stylesheet" type="text/css">

<div id="top">
	<div id="search">
		<input type="text" name="textfield" id="textfield" />
		<input type="button" id=dept_search value="内容搜索">
	</div>
</div>

<div id="toplink">
	<div id="link">
		<?php
			$records = show_content('smg_link','link','电视新闻中心','头链接1');
			$count = count($records);
   		for($i=0;$i<$count;$i++) {
    ?>
		<li><a target="<? echo $records[$i]->target;?>" href="<?php echo $records[$i]->link;?>" ><?php echo $records[$i]->name;?></a></li>
		<?php }
			$records = show_content('smg_link','link','电视新闻中心','头链接2');
			$count = count($records);
   		for($i=0;$i<$count;$i++) {
		?>
		<li><a target="<?php echo $records[$i]->target;?>" href="<?php echo $records[$i]->link;?>" ><?php echo $records[$i]->name;?></a></li>
		<?php }?>
	</div>
</div>