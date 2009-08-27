<?php if($name!=''){?>
<div class=title><?php echo $name;?></div>
<?php }?>
<div style="width:203px; <?php if($height!=''){?>height:<?php echo $height;?>px;<?php }?> margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline">
	
	<?php
		$photo_width = isset($elment_width)?$elment_width:203;
		$photo_height = isset($element_height)?$element_height:120;
		for($i=0;$i<count($items);$i++){
	?>
	<div style="width:<?php echo $photo_width;?> text-align:center; float:left; display:inline;">
			<a style="float:left;display:inline;" href="/show/show.php?id=<?php echo $items[$i]->id;?>"><img width="<?php echo $photo_width;?>" height="<?php echo $photo_height;?>" src="<?php echo $items[$i]->src?>"></a>
			<a style="float:left;display:inline;" href="/show/show.php?id=<?php echo $items[$i]->id;?>"><?php echo $items[$i]->title;?></a>
	</div>
	<?php
		}
	?>
</div>