<div class=title><?php echo $name;?></div>
	<?php
	for ($i=0;$i<count($items);$i++){
	?>	
<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline">	
	<a target="_blank" href="djcontent.php?id=<? echo $items[$i]->id;?>">
		<? echo $items[$i]->short_title;?>
	</a>

</div>
	<?php } ?>

<div class=more><a target="_blank" href="djlist.php?id=<?php echo $category_id;?>">更多>></a></div>