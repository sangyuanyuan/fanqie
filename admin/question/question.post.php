<?php
    require_once "../../frame.php";
	
	if($_POST['post_type']=='del'){
		$db = get_db();
		$sql = 'delete from smg_question where id='.$_POST['del_id'];
		$db -> execute($sql);
		$sql = 'delete from smg_question_item where question_id='.$_POST['del_id'];
		$db -> execute($sql);
		close_db();
		echo $_POST['del_id'];
	}elseif($_POST['post_type']=='del_item'){
		$question_item = new table_class('smg_question_item');
		$question_item->delete($_POST['del_id']);
	}else{
		//var_dump($_POST);
		
		$question = new table_class('smg_question');
		if(''!=$_POST['question_id']){
			$question->find($_POST['question_id']);
			$project_id = $question->problem_id;
		}else{
			$project_id = $_POST['question']['problem_id'];
		}
			
		$table_change = array('<p>'=>'');
		$table_change += array('</p>'=>'');
		$title = strtr($_POST['title'],$table_change);
		$question->title = $title;
		$question->update_attributes($_POST['question']);
		
		$question_item = new table_class('smg_question_item');
		$question_item->question_id = $question->id;
		if($_POST['item_num']==1){
			$question_item->update_attributes($_POST['item']);
		}else{
			$item_num = $_POST['item_num'];
			$count = 1;
			while($item_num>0){
				if($_POST['item'.$count]['name']!=null){
					$question_item = new table_class('smg_question_item');
					if($_POST['item'.$count.'_id']!=''){
						$question_item->find($_POST['item'.$count.'_id']);
					}else{
						$question_item->question_id = $question->id;
					}
					if('on'==$_POST['check'.$count]){
						$question_item->attribute = 1;
					}else{
						$question_item->attribute = 0;
					}
					$question_item->update_attributes($_POST['item'.$count]);
					$item_num--;	
				}
				$count++;
			}
		}
		
		//redirect('question_list.php?id='.$project_id);
	}
?>