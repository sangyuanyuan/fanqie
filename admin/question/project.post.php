<?php
	require_once "../../frame.php";
	
	if($_POST['post_type']=='del'){
		$db = get_db();
		$sql = 'delete from smg_problem where id='.$_POST['del_id'];
		$db -> execute($sql);
		$sql = 'delete from smg_question_item where question_id in(select id from smg_question where problem_id='.$_POST['del_id'].')';
		$db -> execute($sql);
		$sql = 'delete from smg_question where problem_id='.$_POST['del_id'];
		$db -> execute($sql);
		close_db();
		echo $_POST['del_id'];
	}else{
		//var_dump($_POST);
		$project = new table_class('smg_problem');
		if(""!=$_POST['id']){
			$project->find($_POST['id']);
		}
		
		if($_FILES['image'][name]!=null){
			$upload = new upload_file_class();
			$upload->save_dir = '/upload/images/';
			$img = $upload->handle('image','filter_pic');
			if($img === false){
				alert('上传文件失败 !');				
				redirect('project_add.php');
			}
			$project->photo_url = "/upload/images/" .$img;
		}
		
		if($_POST['start_time']==""){
			$project->start_time = "00-00-00";
		}else{
			$project->start_time = $_POST['start_time'];
		}
		if($_POST['end_time']==""){
			$project->end_time="00-00-00";
		}else{
			$project->end_time = $_POST['end_time'];
		}
		$table_change = array('<p>'=>'');
		$table_change += array('</p>'=>'');
		$title = strtr($_POST['title'],$table_change);
		$project->name = $title;
		$project->update_attributes($_POST['post']);
		
		redirect('project_list.php');
	}
?>