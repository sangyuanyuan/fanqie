<?php
	include "../../frame.php";
	$category = new table_class('smg_gift_category');
	$category->update_attributes($_POST['category'],false);
	$category->id = $_REQUEST['category_id'] ? $_REQUEST['category_id'] : 0;
	if($_FILES['img_file']['name'] != ''){
		$uploader = new upload_file_class();
		$uploader->save_dir = '/upload/images/';
		$file_name = $uploader->handle('img_file');
		$category->img_src = '/upload/images/' . $file_name;	
	}
	$category->save();
	redirect('index.php');
?>