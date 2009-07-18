<?php
	require_once "../../frame.php";
	$smg_image = new smg_images_class();
	$smg_image->find($_POST['id']);
	//var_dump($_POST);
	//如果在编辑的情况下没有上传图片则不进入文件上传的过程
	if($_POST['type']!=="edit"||$_FILES['image']['name']!=null){
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
	$table_change = array('<p>'=>'');
	$table_change += array('</p>'=>'');
	$title = strtr($_POST['title'],$table_change);
	$smg_image->title = $title;
	if($_POST['picture']["priority"]==null){$smg_image->update_attribute("priority","100");}
	if($_POST['picture']["commentable"]==null){$smg_image->update_attribute("commentable","");}
	$smg_image->publisher = $_COOKIE['smg_user_nickname'];
	$smg_image->update_attributes($_POST['picture']);
	if($_POST['special_type']==""){
		redirect($_POST['url']);
	}elseif($_POST['special_type']=="总裁奖"){
		redirect('/admin/zongcai/zongcai_image.php');
	}
	
	
?>