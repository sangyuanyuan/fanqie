<?php
	require_once "../../frame.php";
	$magazine = new table_class("smg_magazine");
	$magazine->find($_POST['id']);
	
	//var_dump($_POST);
	
	if($_POST['magazine']['online_url']==null){
		//如果在编辑的情况下没有上传文件则不进入文件上传的过程
		if($_POST['type']!=="edit"||$_FILES['image']['name']!=null||$_FILES['magazine']['name']!=null){
			$upload = new upload_file_class();
			//如果在编辑的情况下没有上传图片则不进入文件上传的过程
			if($_POST['type']!=="edit"||$_FILES['image']['name']!=null){
				$upload->save_dir = "/upload/images/";
				$img = $upload->handle('image','filter_pic');
				if($img === false){
					alert('上传图片失败 !');
					redirect('magazine_add.php');
				}
				$magazine->photo_url = "/upload/images/" .$img;
			}
			//如果在编辑的情况下没有上传视频则不进入文件上传的过程
			if($_POST['type']!=="edit"||$_FILES['magazine']['name']!=null){
				$upload->save_dir = "/upload/magazine/";
				$vid = $upload->handle('magazine');
				if($vid === false){
					alert('上传视频失败 !');
					redirect('magazine_add.php');
				}
				$magazine->magazine_url = "/upload/magazine/" .$vid;
			}
		}
	}else{
		//如果在编辑的情况下没有上传文件则不进入文件上传的过程
		if($_POST['type']!=="edit"||$_FILES['image']['name']!=null||$_FILES['magazine']['name']!=null){
			$upload = new upload_file_class();
			//如果在编辑的情况下没有上传图片则不进入文件上传的过程
			if($_POST['type']!=="edit"||$_FILES['image']['name']!=null){
				$upload->save_dir = "/upload/images/";
				$img = $upload->handle('image','filter_pic');
				if($img === false){
					alert('上传图片失败 !');
					redirect('magazine_add.php');
				}
				$magazine->photo_url = "/upload/images/" .$img;
			}
		}
	}
	$table_change = array('<p>'=>'');
	$table_change += array('</p>'=>'');
	$title = strtr($_POST['title'],$table_change);
	$magazine->title = $title;
	if($_POST['magazine']["priority"]==null){$magazine->update_attribute("priority","100");}
	if($_POST['magazine']["commentable"]==null){$magazine->update_attribute("commentable","");}
	$magazine->update_attributes($_POST['magazine']);
	
	redirect($_POST['url']);
	
	
?>