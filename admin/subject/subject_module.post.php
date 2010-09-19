<?php
	#var_dump($_POST);
	require "../../frame.php";
	judge_role('admin');
	$module = new table_class('smg_subject_modules');
	$module->update_attributes($_POST['module'],false);
	$module->id = $_POST['id'];
	if($module->save()){
		echo 'ok';
	}else{
		echo 'fail';
	};
?>