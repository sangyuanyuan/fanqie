<?php
	require_once "../../frame.php";
	//var_dump($_POST);
	
	judge_role('admin');
	if($_POST['type']=='del_leader'){
		$db = get_db();
		$sql = 'delete from smg_dialog_leader where id='.$_POST['del_id'];
		$db->execute($sql);
		close_db();
		echo $_POST['del_id'];
	}elseif($_POST['type']=='del_dialog'){
		$db = get_db();
		$sql = 'delete from smg_dialog where id='.$_POST['del_id'];
		$db->execute($sql);
		$sql = 'delete from smg_dialog_leader where leader_id='.$_POST['del_id'];
		$db->execute($sql);
		close_db();
		echo $_POST['del_id'];
	}elseif($_POST['type']=='check_user'){
		$ids1 = explode(",", $_POST['id']);
		$ids2 = explode("，", $_POST['id']);
		$ids = count($ids1)>count($ids2)?$ids1:$ids2;
		$count = count($ids);
		$contents = '';
		for($i=0;$i<$count;$i++){
			$user = new table_class('smg_user');
			$user->find('first',array('conditions' => "name='{$ids[$i]}'"));
			
			if($user->nick_name==''){
				$contents = $contents.$ids[$i].':查无此人！';
			}else{
				$contents = $contents.$ids[$i].':'.$user->nick_name.'!';
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
		
		if($_FILES['image2']['name']!=null){
			$upload = new upload_file_class();
			$upload->save_dir = '/upload/images/';
			$img = $upload->handle('image2','filter_pic');
			if($img === false){
					alert('上传文件失败 !');				
					redirect('dialog_add.php');
			}
			$dialog->photo2_url = "/upload/images/" .$img;
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
		$content = strtr($_POST['content'],$table_change);
		$dialog->title = $title;
		$dialog->content = $content;
		$dialog->update_attributes($_POST['post']);
		
		
		for($i=1;$i<=$_POST['learder_count'];$i++){
			if($_POST['leader_id'.$i]!=''){
				$dialog_leader = new table_class('smg_dialog_leader');
				if($_POST['dialog_leader_id'.$i]!=''){
					$dialog_leader->find($_POST['dialog_leader_id'.$i]);
				}
				if($_FILES['learder_image'.$i]['name']!=null){
					$upload = new upload_file_class();
					$upload->save_dir = '/upload/images/';
					$img = $upload->handle('learder_image'.$i,'filter_pic');
					if($img === false){
							alert('上传领导文件失败 !');				
							redirect('dialog_add.php');
					}
					$dialog_leader->photo_src = "/upload/images/" .$img;
				}
				//echo $_POST['leader_id'.$i];
				$dialog_leader->dialog_id = $dialog->id;
				$dialog_leader->leader_id = $_POST['leader_id'.$i];
				$user = new table_class('smg_user');
				$user->find('first',array('conditions' => "name='".$_POST['leader_id'.$i] ."'"));
				$dialog_leader->name = $user->nick_name;
				$dialog_leader->leader_state = 1;
				$dialog_leader->save();
			}
			
			
		}
		
		redirect('dialog_list.php');
	}
?>