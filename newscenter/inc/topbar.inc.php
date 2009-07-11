<link href="css/top.css" rel="stylesheet" type="text/css">

<div id="top">
	<div id="search">
		<input type="text" name="textfield" id="textfield" />
		<input type="button" OnClick="searchnews('textfield')" value="内容搜索">
	</div>
</div>

<div id="toplink">
	<div id="link">
		<?php
			$link = new table_class('smg_link');
			$records = $link->show_content('电视新闻中心','头链接1');
			$count = count($records);
   		for($i=0;$i<$count;$i++) {
    ?>
		<li><a target="<? echo $records[$i]->target;?>" href="<?php echo $records[$i]->link;?>" ><?php echo $records[$i]->name;?></a></li>
		<?php }
			$records = $link->show_content('电视新闻中心','头链接2');
			$count = count($records);
   		for($i=0;$i<$count;$i++) {
		?>
		<li><a target="<?php echo $records[$i]->target;?>" href="<?php echo $records[$i]->link;?>" ><?php echo $records[$i]->name;?></a></li>
		<?php }?>
	</div>
</div>