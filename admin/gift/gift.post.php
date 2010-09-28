<?php
	include "../../frame.php";
	judge_role('admin');
	$gift = new table_class('smg_gift');
	$gift->update_attributes($_POST['gift'],false);
	$gift->id = $_REQUEST['gift_id'] ? $_REQUEST['gift_id'] : 0;
	if($_FILES['img_file']['name'] != ''){
		$uploader = new upload_file_class();
		$uploader->save_dir = '/upload/images/';
		$file_name = $uploader->handle('img_file');
		$gift->img_src = '/upload/images/' . $file_name;	
	}
	if($_REQUEST['category_id']){
		$gift->category_id = $_REQUEST['category_id'];
	}
	$gift->save();
	redirect('gift_list.php?category_id=' .$gift->category_id);
?>