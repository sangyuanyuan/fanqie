<?php
	require_once "../../frame.php";
	$item = new table_class('smg_subject_category');
	if($item->delete($_POST['id'])){
		echo 'ok';
	};
?>