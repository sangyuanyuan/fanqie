<?php
	include "../../frame.php";
	if($_POST['name']){
		$sql = "select * from smg_user where name='{$_POST['name']}'";
		$db = get_db();
		$db->query($sql);
		if($db->record_count<=0){
			alert('找不到工号为 ' . $_POST['name'] .' 的用户!');
		    exit;
		}
		$db->execute("update smg_user set role_name='dept_admin' where name='{$_POST['name']}'");
	}else if($_POST['id']){
		$db = get_db();
		$db->execute("update smg_user set role_name='dept_admin' where id='{$_POST['id']}'");
	}
?>
<script>
	window.location.reload();
</script>