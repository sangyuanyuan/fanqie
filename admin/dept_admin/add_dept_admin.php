<?php
	include "../../frame.php";
	$role = $_REQUEST['dept_id'] == 7 || $_REQUEST['dept_id'] == 47 ? 'admin' : 'dept_admin';
	if($_POST['name']){
		$sql = "select * from smg_user where name='{$_POST['name']}'";
		$db = get_db();
		$db->query($sql);
		if($db->record_count<=0){
			alert('找不到工号为 ' . $_POST['name'] .' 的用户!');
		    exit;
		}
		$db->move_first();
		$user_id = $db->field_by_name('smg_real_id');
		$db->execute("update smg_user set role_name='$role' where name='{$_POST['name']}'");
		$db->execute("update smg_user_real set dept_id={$_POST['dept_id']} where id=$user_id");
	}else if($_POST['id']){
		$db = get_db();
		$db->execute("update smg_user set role_name='$role' where id='{$_POST['id']}'");
		$db->query("select smg_real_id from smg_user where id={$_POST['id']}");
		$db->move_first();
		$user_id = $db->field_by_name('smg_real_id');
		$db->execute("update smg_user_real set dept_id={$_POST['dept_id']} where id=$user_id");
	}
?>
<script>
	window.location.reload();
</script>