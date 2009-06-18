<?php
	require_once "../../frame.php";
	$smg_image = new smg_images_class();
	$smg_image->find($_POST['id']);
	if($_POST['type']!=="edit"|$_FILES['image']['name']!=null){
		//echo "aa";
		$upload = new upload_file_class();
		$upload->save_dir = "/upload/images/";
		$img = $upload->handle('image');
		
		
		if($img === false){
			alert('上传文件失败 !');
			redirect('picture_add.php');
		}
		
		$smg_image->src = "/upload/images/" .$img;
		$smg_image->create_thumb('middle',50);
		$smg_image->create_thumb('small',170,70);
	}
	
	$smg_image->update_attributes($_POST['picture']);
	//var_dump($_POST[picture]);
	redirect('picture_list.php');
?>