<?php
	require_once "../frame.php";
	$upload = new upload_file_class();
	$upload->save_dir = "/upload/images/";
	$img = $upload->handle('image');
	if($img === false){
		alert('上传文件失败 !');
		redirect('/test/image_test.php');
	}
	$smg_image = new smg_images_class();
	$smg_image->src = "/upload/images/" .$img;
	$smg_image->create_thumb('middle',50);
	
	$smg_image->update_attributes($_POST[img]);
	var_dump($_POST[img]);
?>