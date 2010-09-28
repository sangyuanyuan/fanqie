<?php
	require_once "../../frame.php";
	judge_role('admin');
	if($_POST['post_type']=='del_item'){
		$question_item = new table_class('smg_fhtg_item');
		$question_item->delete($_POST['del_id']);
	}else{
		#var_dump($_POST);
		$project = new table_class('smg_fhtg');
		if(""!=$_POST['id']){
			$project->find($_POST['id']);
		}
		if($_FILES['image'][name]!=null){
			$upload = new upload_file_class();
			$upload->save_dir = '/upload/images/';
			$img = $upload->handle('image','filter_pic');
			if($img === false){
				alert('上传文件失败 !');				
				redirect('fhtg_add.php');
			}
			$project->src = "/upload/images/" .$img;
		}
		if($_POST['fhtg']['priority']=="")
		{
			$_POST['fhtg']['priority']=100;	
		}
		$project->update_attributes($_POST['fhtg'],false);
		if($_POST['start_at']==""){
			$project->start_at = "00-00-00";
		}else{
			$project->start_at = $_POST['start_at'];
		}
		if($_POST['end_at']==""){
			$project->end_at="00-00-00";
		}else{
			$project->end_at = $_POST['end_at'];
		}
		$project->save();
		$question_item = new table_class('smg_fhtg_item');
		$question_item->fhtg_id = $project->id;
		if($_POST['item_num']==1){
			$question_item->update_attributes($_POST['item']);
		}else{
			$item_num = $_POST['item_num'];
			$count = 1;
			while($item_num>0){
				if($_POST['item'.$count]['name']!=null){
					$question_item = new table_class('smg_fhtg_item');
					if($_POST['item'.$count.'_id']!=''){
						$question_item->find($_POST['item'.$count.'_id']);
					}else{
						$question_item->fhtg_id = $project->id;
					}
					$question_item->update_attributes($_POST['item'.$count]);
					$item_num--;	
				}
				$count++;
			}
		}
		
		if($_POST['url']==''){
			redirect('fhtg.php');
		}else{
			redirect($_POST['url']);
		}
		
	}
	
?>