<?php
	include "../../frame.php";
	judge_role('admin');
	$db = get_db();
	if($db->execute("update smg_user set password = '{$_POST['pwd']}' where id={$_POST['id']}")){
		echo '修改密码成功!';
	}else{
		echo '修改密码失败:' .$db->last_error;
	}
?>