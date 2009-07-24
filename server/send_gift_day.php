<?php
  include "../frame.php";
  $db = get_db();
  $date = $_REQUEST['date'];
  $birthday = $db->query("select a.nickname,a.loginname,b.name from smg_user_real a left join smg_org_dept b on a.org_id = b.orgid where birthday_short='$date'");
  
?>
<div id="send_gift_day">
	<div id="left_div">
		<?php 
		foreach ($birthday as $v) {?>
			<div class="list_item"><?php echo "$v->nickname[$v->name]";?></div>
		<?php }
		?>
	</div>
	<div id="right_div">
		
	</div>
</div>