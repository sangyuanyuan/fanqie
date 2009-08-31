<?php if($name!=''){?>
<div class=title><?php echo $name;?></div>
<?php }?>
<div style="<?php if($height!=''){?>height:<?php echo $height;?>px;<?php }?> line-height:15px;overflow:hidden; float:left; display:inline">
	<?php 
		if($scroll_type!=0){
		switch($scroll_type){
			case 1:
				$direction="left";
				break;
			case 2:
				$direction="up";
				break;
			case 3:
				$direction="right";
				break;
			case 4:
				$direction="down";
				break;
		}
	?>
	<marquee direction="<?php echo $direction;?>" behavior="scroll">
	<?php }?>
	<?php
		for ($i=0;$i<count($items);$i++){
	?>	
		<div class="li_context">	
			<a target="_blank" href="/show/video.php?id=<? echo $items[$i]->id;?>">
				<?php echo $items[$i]->title;?>
			</a>
		</div>
	<?php } ?>
	<?php if($scroll_type!=0){?>
	</marquee>
	<?php }?>
<?php if(count($items)>0){?>
<div class=more><a target="_blank" href="video_list.php?id=<?php echo $category_id;?>">更多>></a></div>
<?php }?>
</div>
