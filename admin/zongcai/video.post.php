<?php
	require_once "../../frame.php";
	$video = new table_class("smg_video");
	if($_POST['id']!=''){
		$video->find($_POST['id']);
	}

	if($_POST['video']['online_url']==null){
			$upload = new upload_file_class();
			if($_FILES['image']['name']!=null){
				$upload->save_dir = "/upload/images/";
				$img = $upload->handle('image','filter_pic');
				if($img === false){
					alert('上传图片失败 !');
					redirect($_SERVER['HTTP_REFERER']);
				}
				$video->photo_url = "/upload/images/" .$img;
			}
			if($_FILES['video']['name']!=null){
				$upload->save_dir = "/upload/video/";
				$vid = $upload->handle('video','filter_video');
				if($vid === false){
					alert('上传视频失败 !');
					redirect($_SERVER['HTTP_REFERER']);
				}
				$video->video_url = "/upload/video/" .$vid;
			}
	}else{
			$upload = new upload_file_class();
			if($_FILES['image']['name']!=null){
				$upload->save_dir = "/upload/images/";
				$img = $upload->handle('image','filter_pic');
				if($img === false){
					alert('上传图片失败 !');
					redirect($_SERVER['HTTP_REFERER']);
				}
				$video->photo_url = "/upload/images/" .$img;
			}
	}
	
	$video->created_at = date("Y-m-d H:i:s");
	if($_POST['video']["commentable"]==null){$video->commentable='';}
	$video->publisher = $_COOKIE['smg_user_nickname'];
	$video->update_attributes($_POST['video']);
	
	redirect('/admin/zongcai/zongcai_video.php');
	
	
?>