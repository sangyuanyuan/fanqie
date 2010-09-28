<?php
	require_once "../../../frame.php";
    var_dump($_FILES); 
	$upload = new upload_file_class();
	$upload->save_dir = '/upload/images/';
	$img = $upload->handle('img','filter_pic');
	if($img === false){
			alert('上传文件失败 !');				
			redirect('vote_add.php');
	}
?>