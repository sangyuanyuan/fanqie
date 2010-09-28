<?php 
	require "../../frame.php";
	
	$images = new table_class('smg_images');
	$images->update_attributes($_POST['images'],false);
	$images->priority = 100;
	$images->is_adopt = 1;
	$images->category_id='168';
	if($_FILES['video_pic']['name'] != ''){
		$upload = new upload_file_class();
		$upload->save_dir = '/upload/images/';
		$images->src = '/upload/images/' .$upload->handle('video_pic','filter_pic');
	}
	$images->created_at = date("Y-m-d H:i:s");
	$images->save();
	redirect('wolfpksheep.php');
?>