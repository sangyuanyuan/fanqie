<?php
    require_once('../frame.php');
	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
		$marry = new table_class('smg_marry');
		
		$marry->update_attributes($_POST['marry'],false);
		$marry->birthday = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
		if($_FILES['image']['name']!=''){
			$upload = new upload_file_class();
			$upload->save_dir = "/upload/images/";
			$img = $upload->handle('image','filter_pic');
			
			
			if($img === false){
				alert('上传文件失败 !');
				redirect($_SERVER['HTTP_REFERER']);
			}
			$marry->photo = "/upload/images/" .$img;
		}
		$marry->save();
	}
	else
	{
		die('请从网站入口提交！');	
	}
?>