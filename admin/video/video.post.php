<?php
	require_once "../../frame.php";
	$video = new table_class("smg_video");
	$video->find($_POST['id']);
	
	//如果在编辑的情况下没有上传文件则不进入文件上传的过程
	if($_POST['type']!=="edit"||$_FILES['image']['name']!=null||$_FILES['video']['name']!=null){
		$upload = new upload_file_class();
		//如果在编辑的情况下没有上传图片则不进入文件上传的过程
		if($_POST['type']!=="edit"||$_FILES['image']['name']!=null){
			$upload->save_dir = "/upload/images/";
			$img = $upload->handle('image','filter_pic');
			if($img === false){
				alert('上传图片失败 !');
				redirect('video_add.php');
			}
			$video->photourl = "/upload/images/" .$img;
		}
		//如果在编辑的情况下没有上传视频则不进入文件上传的过程
		if($_POST['type']!=="edit"||$_FILES['video']['name']!=null){
			$upload->save_dir = "/upload/video/";
			$vid = $upload->handle('video','filter_video');
			if($vid === false){
				alert('上传视频失败 !');
				redirect('video_add.php');
			}
			$video->videourl = "/upload/video/" .$vid;
		}
		

	}
	
	$video->update_attributes($_POST['video']);
	
	redirect('video_list.php');
	
	
?>