<?php
	require_once "../../frame.php";
	judge_role('admin');
	$smg_image = new smg_images_class();
	if($_POST['id']!=''){
		$smg_image->find($_POST['id']);
	}
	//var_dump($_POST);
	if($_FILES['image']['name']!=null){
		$upload = new upload_file_class();
		$upload->save_dir = "/upload/images/";
		$img = $upload->handle('image','filter_pic');
		
		
		if($img === false){
			alert('上传文件失败 !');
			redirect($_SERVER['HTTP_REFERER']);
		}
		$smg_image->src = "/upload/images/" .$img;
		$smg_image->create_thumb('middle',50);
		$smg_image->create_thumb('small',170,70);
	}
	$smg_image->publisher = $_COOKIE['smg_user_nickname'];
	$smg_image->created_at = date("Y-m-d H:i:s");
	if($_POST['picture']["commentable"]==null){$smg_image->commentable='';}
	$smg_image->update_attributes($_POST['picture']);
	redirect('zongcai_image.php?category='.$smg_image->category_id);
?>