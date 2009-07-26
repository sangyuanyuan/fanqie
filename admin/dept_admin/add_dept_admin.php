<?php
	include "../../frame.php";
	$sql = "select * from smg_user where name='{$_POST['name']}'";
	$db = get_db();
	$db->query($sql);
	if($db->record_count<=0){
		alert('找不到工号为 ' . $_POST['name'] .' 的用户!');
	    exit;
	}
	$db->execute("update smg_user set role_name='dept_admin' where name='{$_POST['name']}'");	
?>
<script>
	window.location.reload;
</script>