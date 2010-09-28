<?php
	include "calendar.php";
	if($_REQUEST['send_id']){
		$db = get_db();
		$db->query('select * from smg_user_real where id=' .$_REQUEST['send_id']);
		$db->move_first();
		?>
		<script>
			$(function(){
				//tb_show('title','send_gift_day.php?width=600&height=400&date=<?php echo date("m-d"); ?>',false);	
				tb_show('title','send_gift.php?modal=true&hide_retdiv=1&date=<?php echo date("m-d"); ?>&nickname=<?php echo $db->field_by_name("nickname");?>&loginname=<?php echo $db->field_by_name("loginname");?>',false);	
			});
			
		</script>
		<?php				
	}
?>