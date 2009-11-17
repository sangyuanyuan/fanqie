<?php
	require_once "../../frame.php";
	
	if($_POST['post_type']=='del'){
		$db = get_db();
		$sql = 'delete from smg_xlcs_subject where id='.$_POST['del_id'];
		$db -> execute($sql);
		$sql = 'delete from smg_xlcs_item where xlcs_id in(select id from smg_xlcs where project_id='.$_POST['del_id'].')';
		$db -> execute($sql);
		$sql = 'delete from smg_xlcs where project_id='.$_POST['del_id'];
		$db -> execute($sql);
		close_db();
		echo $_POST['del_id'];
	}else{
		$project = new table_class('smg_xlcs_subject');
		if(""!=$_POST['id']){
			$project->find($_POST['id']);
		}
		$project->update_attributes($_POST['post'],false);
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
		
		redirect('project_list.php');
	}
?>