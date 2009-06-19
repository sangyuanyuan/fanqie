<?php
	require_once "../../frame.php";
	$video = new table_class("smg_video");
	var_dump($_POST);
	$video->find($_POST['id']);
	
	
	if($_POST['type']!=="edit"||$_FILES['image']['name']!=null){
		//echo "aa";
		$upload = new upload_file_class();
		$upload->save_dir = "/upload/images/";
		$img = $upload->handle('image]');
		$upload->save_dir = "/upload/video/";
		$vid = $upload->handle('video');
		
		
		if($img === false){
			alert('上传图片失败 !');
			//redirect('video_add.php');
		}
		if($vid === false){
			alert('上传视频失败 !');
			//redirect('viideo_add.php');
		}
		
		$video->photourl = "/upload/images/" .$img;
		$video->videourl = "/upload/video/" .$vid;

	}
	
	$video->update_attributes($_POST['video']);
	
	//redirect('video_list.php');
	
	
?>