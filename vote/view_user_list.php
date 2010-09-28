<?php 
	include "../frame.php";
	$db = get_db();
	$items = $db->paginate("select a.*,b.title from smg_vote_item_record a left join smg_vote_item  b on a.vote_item_id=b.id where vote_item_id={$_REQUEST['item_id']} order by id desc",12);
	
	if(!$_REQUEST['is_page']){
		echo '<div id="ret_div">';
	}
?>
<div id="item_list">
	<?php 
		for($i=0;$i<count($items);$i++){
			echo "<div class=\"list_div\" style=\"margin-top:5px;font-size:15px; \"><b>{$items[$i]->nick_name}</b> 投了 <span style=\"color:blue;\">{$items[$i]->title}</span> 一票 <span style=\"color:gray;\">{$items[$i]->created_at}</span></div>";
		}
	?>
	<div style="margin-top:30px;"><?php paginate("view_user_list.php?is_page=true&item_id={$_REQUEST['item_id']}",'ret_div'); ?></div>
</div>	
<?php
	if(!$_REQUEST['is_page']){
		echo '</div>';
	}
?>

