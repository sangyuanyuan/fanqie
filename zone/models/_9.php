<?php 
	$db= get_db();
	$items = $db->query("select id,title,photo_url from smg_dialog where is_adopt=1 order by create_time desc limit 1");
	$item = $items[0];
?>
<style>
<!--
	.dialog_container{width:290px;text-align: center;}
		.dialog_container img{border: none;width: 280px;}
		.dialog_container .img{width:100%}
		.dialog_container .msg{text-align: center}
						  .msg a{text-decoration: none;}
-->
</style>
	<div class="dialog_container">
		<div class="img"><?php echo "<img src='{$item->photo_url}' />";?></div>
		<div class="msg"><?php echo "<a href='/zone/dialog.php?id={$item->id}' target='_blank'>{$item->title}</a>";?></div>
	</div>
