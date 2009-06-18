<?php
	require_once "../../frame.php";
	$smg_image = new smg_images_class();
	if($_POST['type']=="del"){
		$smg_image->delete($_POST['del_id']);
		echo $_POST['del_id'];
	}else if($_POST['type']=="revocation"){
		$smg_image->find($_POST['id']);
		$smg_image->update_attribute("is_adopt","0");
		//echo "发布";
	}else if($_POST['type']=="publish"){
		$smg_image->find($_POST['id']);
		$smg_image->update_attribute("is_adopt","1");
		//echo "撤销";
	}else{
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
	}
	
?>