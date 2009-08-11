<div class=title><?php echo $name;?></div>
<div style="width:170px; height:15px; line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline">
	<img width=5 height=5 src="/images/icon/blacksqu.jpg">　
	<?php
	for ($i=0;$i<count($items);$i++){
	?>		
	<a target="_blank" href="djcontent.php?id=<? echo $items[$i]->id;?>">
		<? echo $items[$i]->short_title;?>
	</a>
	<?php } ?>
</div>
<div class=tp>
	<div class=pic>
		<a target="_blank" target="_blank" href="djcontent.php?id=<? echo $news[0]->id;?>">
			<img border=0 width=90 height=70 src="<? if($news[0]->photourl!=""){echo $news[0]->photourl;}else {echo '/images/logo.jpg';}?>">
		</a>
	</div>
	<div class=pic>
		<a target="_blank" target="_blank" href="djcontent.php?id=<? echo $news[1]->id;?>">
			<img border=0 width=90 height=70 src="<? if($news[1]->photourl!=""){echo $news[1]->photourl;}else {echo '/images/logo.jpg';}?>">
		</a>
	</div>
</div>
<div class=more><a target="_blank" href="djlist.php?id=<?php $zxdt[0]->cid;?>">更多>></a></div>