<?php
	require_once "../../frame.php";
	//var_dump($_POST['vote']);
	
	if("del"==$_POST['post_type'])
	{
		$post = new table_class($_POST['db_table']);
		$post -> delete($_POST['del_id']);
		$db = get_db();
		$sql = 'delete from smg_vote_item where vote_id='.$_POST['del_id'];
		$db->execute($sql);
		echo $_POST['del_id'];
	}else{
		$vote = new table_class('smg_vote');
		
		if($_FILES['image']!=null){
			$upload = new upload_file_class();
			$upload->save_dir = '/upload/images/';
			$img = $upload->handle('image','filter_pic');
			if($img === false){
					alert('上传文件失败 !');				
					redirect('vote_add.php');
			}
			$vote->photo_url = "/upload/images/" .$img;
		}//如果投票上传图片，做处理
		
		$vote->update_attributes($_POST['vote']);
		for($i=1;$i<=$_POST['vote_item_count'];$i++){
			$vote_item = new table_class('smg_vote_item');
			$vote_item->vote_id = $vote->id;
			if($_POST['vote']['vote_type']=='image_vote'){
				$upload = new upload_file_class();
				$upload->save_dir = '/upload/images/';
				$img = $upload->handle('item_image'.$i,'filter_pic');
				//var_dump($_FILES);
				
				if($img === false){
					alert('上传文件失败 !');				
					redirect('vote_add.php');
				}
				
				$vote_item->photo_url = "/upload/images/" .$img;
			}//投票项目图片处理
			
			$vote_item->update_attributes($_POST['vote_item'.$i]);
		}
		
		redirect('vote_list.php');
	}
	
	
?>