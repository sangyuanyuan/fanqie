<?php
	require_once "../../frame.php";
	
	if($_POST['type']=='check_user'){
		$ids1 = explode(",", $_POST['id']);
		$ids2 = explode("，", $_POST['id']);
		$ids = count($ids1)>count($ids2)?$ids1:$ids2;
		$count = count($ids);
		$contents = '';
		for($i=0;$i<$count;$i++){
			$user = new table_class('smg_user');
			$user->find($ids[$i]);
			if($user->name==''){
				$contents = $contents.$ids[$i].':查无此人！';
			}else{
				$contents = $contents.$ids[$i].':'.$user->name.'!';
			}		
		}
		echo $contents;
		
	}elseif($_POST['type']=='edit_content'){
		$dialog = new table_class($_POST['db_table']);
		$dialog -> find($_POST['id']);
		$dialog -> content = $_POST['content'];
		$dialog -> save();
	}else{
		$dialog = new table_class('smg_dialog');
		if($_POST['collection']!=''){
			$dialog_collection = new table_class('smg_dialog_collection');
			$dialog_collection->find($_POST['collection']);
			$dialog_collection->is_used = 1;
			$dialog_collection->save();
		}
		if($_POST['id']!=''){
			$dialog->find($_POST['id']);
		}
	
		if($_FILES['image']['name']!=null){
			$upload = new upload_file_class();
			$upload->save_dir = '/upload/images/';
			$img = $upload->handle('image','filter_pic');
			if($img === false){
					alert('上传文件失败 !');				
					redirect('dialog_add.php');
			}
			$dialog->photo_url = "/upload/images/" .$img;
		}
		
		if($_FILES['video']['name']!=null){
			$upload = new upload_file_class();
			$upload->save_dir = "/upload/video/";
			$vid = $upload->handle('video','filter_video');
			if($vid === false){
				alert('上传视频失败 !');
				redirect('dialog_add.php');
			}
			$dialog->video_url = "/upload/video/" .$vid;
		}
		
		$table_change = array('<p>'=>'');
		$table_change += array('</p>'=>'');
		$title = strtr($_POST['title'],$table_change);
		$dialog->title = $title;
		$dialog->update_attributes($_POST['post']);
		
		redirect('dialog_list.php');
	}
?>