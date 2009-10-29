<?php
    require "../../frame.php";
	
	if($_POST['type']=='image'){
		$image = new smg_images_class();
		$image -> update_attributes($_POST['show'],false);
		if($_FILES['image']['name']!=''){
			$upload = new upload_file_class();
			$upload->save_dir = "/upload/images/";
			$img = $upload->handle('image','filter_pic');
			
			
			if($img === false){
				alert('上传文件失败 !');
				redirect($_SERVER['HTTP_REFERER']);
			}
			$image->src = "/upload/images/" .$img;
		}
		$image->category_id=category_id_by_name('秀一秀','picture');
		$image->commentable = 'on';
		$image->priority = 100;
		$image->is_recommend = 1;
		$image->created_at = date("Y-m-d H:i:s");
		$image->save();
	}else{
		$video = new table_class('smg_video');
		$video -> update_attributes($_POST['show'],false);
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
		$video->category_id=category_id_by_name('我要上传','video');
		$video->commentable = 'on';
		$video->is_recommend = 1;
		$video->priority = 100;
		$video->created_at = date("Y-m-d H:i:s");
		$video->save();
	}
	alert("上传成功！谢谢！");
	redirect($_SERVER['HTTP_REFERER']);
?>