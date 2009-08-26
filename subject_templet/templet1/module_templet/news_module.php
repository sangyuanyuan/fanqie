<?php if($name!=''){?>
<div class=title><?php echo $name;?></div>
<?php }?>
<div style="width:200px; <?php if($height!=''){?>height:<?php echo $height;?>px;<?php }?> line-height:15px; margin-top:5px; margin-left:10px; overflow:hidden; float:left; display:inline">
	<div style="width:<?php echo isset($elment_width)?$elment_width:200;?>px; height:<?php echo isset($element_height)?$element_height:100;?>px; text-indent: 2em; line-height:15px; overflow:hidden; float:left; display:inline">
		<a title="<?php echo strip_tags($items[0]->description);?>" href="news.php?id=<? echo $items[0]->id;?>" target="_blank">
			<?php
				echo strip_tags($items[0]->description);
			?>
		</a>
	</div>
</div>

