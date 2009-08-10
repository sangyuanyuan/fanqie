<?php
	require_once "../frame.php";
	$zongcai_item = new table_class('smg_zongcai_item');
	if($_POST['id']!=''){
		$zongcai_item->find($_POST['id']);
	}
	//var_dump($_POST);

	if($_FILES['upfile']['name']!=null){
		$upload = new upload_file_class();
		$upload->save_dir = "/upload/images/";
		$img = $upload->handle('upfile','filter_pic');
		
		
		if($img === false){
			alert('上传文件失败 !');
			redirect('zongcai_item.php');
		}
		$zongcai_item->photo_url = "/upload/images/" .$img;
	}
	

	
	$zongcai_item->update_attributes($_POST['post']);

	if($_POST['type']=='admin_edit'){
		redirect('/admin/zongcai/zongcai_item_list.php');
	}else{
		redirect('/zongcai/');
	}
	
	
	
?>