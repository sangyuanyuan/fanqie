<?php
    require_once "../../frame.php";
	
	if($_POST['post_type']=='del'){
		$db = get_db();
		$sql = 'delete from smg_xlcs where id='.$_POST['del_id'];
		$db -> execute($sql);
		$sql = 'delete from smg_xlcs_item where xlcs_id='.$_POST['del_id'];
		$db -> execute($sql);
		close_db();
		echo $_POST['del_id'];
	}elseif($_POST['post_type']=='del_item'){
		$question_item = new table_class('smg_xlcs_item');
		$question_item->delete($_POST['del_id']);
	}else{
		#var_dump($_POST);
		
		$question = new table_class('smg_xlcs');
		if(''!=$_POST['xlcs_id']){
			$question->find($_POST['xlcs_id']);
			$project_id = $question->project_id;
		}else{
			$project_id = $_POST['xlcs']['project_id'];
		}
		$question->update_attributes($_POST['xlcs']);
		
		$question_item = new table_class('smg_xlcs_item');
		$question_item->question_id = $question->id;
		if($_POST['item_num']==1){
			$question_item->update_attributes($_POST['item']);
		}else{
			$item_num = $_POST['item_num'];
			$count = 1;
			while($item_num>0){
				if($_POST['item'.$count]['name']!=null){
					$question_item = new table_class('smg_xlcs_item');
					if($_POST['item'.$count.'_id']!=''){
						$question_item->find($_POST['item'.$count.'_id']);
					}else{
						$question_item->xlcs_id = $question->id;
					}
					$question_item->update_attributes($_POST['item'.$count]);
					$item_num--;	
				}
				$count++;
			}
		}
		
		if($_POST['url']==''){
			redirect('xlcs_list.php?id='.$project_id);
		}else{
			redirect($_POST['url']);
		}
		
	}
?>