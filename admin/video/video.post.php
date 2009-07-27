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
					redirect('video_add.php');
				}
				$video->photo_url = "/upload/images/" .$img;
			}
	}
	
	$table_change = array('<p>'=>'');
	$table_change += array('</p>'=>'');
	$title = strtr($_POST['title'],$table_change);
	$video->title = $title;
	$video->publisher = $_COOKIE['smg_user_nickname'];
	if($_POST['video']["priority"]==null){$video->update_attribute("priority","100");}
	if($_POST['video']["commentable"]==null){$video->update_attribute("commentable","");}
	$video->publisher = $_COOKIE['smg_user_nickname'];
	$video->update_attributes($_POST['video']);
	
	if($_POST['special_type']==""){
		if($video->category_id!=''){
			redirect($_POST['url'].'?category='.$video->category_id);
		}else{
			redirect($_POST['url']);
		}
	}elseif($_POST['special_type']=="总裁奖"){
		redirect('/admin/zongcai/zongcai_video.php');
	}
	
	
?>