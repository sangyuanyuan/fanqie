<?php
	require_once "../../frame.php";
	
	$vote = new table_class('smg_vote');
	$upload = new upload_file_class();
	$upload->save_dir = '/upload/images/';
	
	if($_FILES[ajax_image][name]!=null){
		//var_dump($_FILES[ajax_image]);
			$img = $upload->handle('ajax_image','filter_pic');
			if($img === false){
					alert('上传文件失败!a');				
					//redirect('vote_add.php');
			}
			echo "/upload/images/" .$img;
	}//如果投票上传图片，做处理
	
	for($i=1;$i<11;$i++){
		if($_FILES[ajax_image.$i][name]!=null){
			//var_dump($_FILES);
			$img = $upload->handle('ajax_image'.$i,'filter_pic');
			if($img === false){
					alert('上传文件失败!');				
					//redirect('vote_add.php');
			}
			echo "/upload/images/" .$img;
			break;
		}
	}
	
	if('ajax_vote'==$_REQUEST['type']){	
		$vote->update_attributes($_POST['vote']);
		echo $vote->id;
	}elseif('ajax_item'==$_REQUEST['type']){
		//var_dump($_POST['vote_item']);
		$vote_item = new table_class('smg_vote_item');
		$vote_item->update_attributes($_POST['vote_item']);
	}

?>