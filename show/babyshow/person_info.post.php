<?php
	require_once('../../frame.php');
	$person_id = $_POST['person_id'] ? $_POST['person_id'] : 0;
	$person = new table_class('smg_user');
	if($person_id!=0){
		$person->find($person_id);
	}
	$person->update_attributes($_POST['person'],false);
	$person->baby_birthday=$_POST['baby_birthday'];
	if($_FILES['head_photo']['name'] != ''){
		$upload = new upload_file_class();
		$upload->save_dir = '/upload/baby/';
		$person->head_photo = '/upload/baby/' .$upload->handle('head_photo','filter_pic');
	}
	$person->save();
	alert('更新成功！');
	redirect($_SERVER['HTTP_REFERER']);
?>