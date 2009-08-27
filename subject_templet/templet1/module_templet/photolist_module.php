<?php if($name!=''){?>
<div class=title><?php echo $name;?></div>
<?php }?>
<div style="width:203px; <?php if($height!=''){?>height:<?php echo $height;?>px;<?php }?> margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline">
	<?php
		$photo_width = isset($elment_width)?$elment_width:203;
		$photo_height = isset($element_height)?$element_height:150;
	?>
	<img src="<?php echo $items[0]->src;?>" width="<?php echo $photo_width;?>" height="<?php echo $photo_height;?>">
</div>