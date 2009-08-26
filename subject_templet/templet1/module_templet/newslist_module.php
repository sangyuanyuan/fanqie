<?php if($name!=''){?>
<div class=title><?php echo $name;?></div>
<div style="<?php if($height!=''){?>height:<?php echo $height;?>px;<?php }?> line-height:15px;overflow:hidden; float:left; display:inline">
<?php }?>
	<?php
		for ($i=0;$i<count($items);$i++){
	?>	
		<div class="li_context">	
			<a target="_blank" href="news.php?id=<? echo $items[$i]->id;?>">
				<?php echo $items[$i]->short_title;?>
			</a>
		</div>
	<?php } ?>
<?php if(count($items)>0){?>
<div class=more><a target="_blank" href="news_list.php?id=<?php echo $category_id;?>">更多>></a></div>
<?php }?>
</div>