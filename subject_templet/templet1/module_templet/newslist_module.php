<?php 
	if($pos_name=="pos1"){
?>
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
			<a target="_blank" href="news.php?id=<? echo $items[$i]->id;?>">
				<?php echo $items[$i]->short_title;?>
			</a>
		</div>
	<?php } ?>
	<?php if($scroll_type!=0){?>
	</marquee>
	<?php }?>
<?php if(count($items)>0){?>
<div class=more><a target="_blank" href="news_list.php?id=<?php echo $category_id;?>">更多>></a></div>
<?php }?>
</div>
<?php
	}elseif($pos_name=="pos2"||$pos_name=="pos5"||$pos_name=="pos8"){
?>
<div class=gd <?php if($name!=''){?>style="background:url(/images/bg/djgd_bg.jpg) no-repeat;"<?php }?>>
	<?php if($name!=''){?>
	<div style="float:left;display:inline;">
	<table height=109 width=21>
		<tr valign="middle">
			<td>
				<div class=right_title><?php echo $name;?></div>
			</td>
		</tr>
	</table>
	</div>
	<?php }?>
	<div style="width:650px; height:90px; margin-left:5px; overflow:hidden; float:left; display:inline">
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
	<marquee direction="<?php echo $direction;?>" behavior="scroll" onmousemove=this.stop() onmouseout=this.start()>
	<?php }?>
	<?php
		for($i=0;$i<count($items);$i++){
	?>
	<div class="li_context">	
		<a target="_blank" href="news.php?id=<? echo $items[$i]->id;?>">
			<?php echo $items[$i]->short_title;?>
		</a>
	</div>
	<?php
		}
	?>
	<?php if($scroll_type!=0){?>
	</marquee>
	<?php }?>
	</div>
	<?php if(count($items)>0){?>
	<div class=more><a target="_blank" href="news_list.php?id=<?php echo $category_id;?>">更多>></a></div>
	<?php }?>
</div>
<?php
	}else{
?>
<div class=title><?php echo $name;?><div class=new_more><a target="_blank" href="news_list.php?id=<?php echo $category_id;?>">更多</a></div></div>

<?php
	}
?>
