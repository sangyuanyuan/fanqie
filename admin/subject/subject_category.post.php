<?php 
	include "../../frame.php";
	judge_role('admin');
	$category = new table_class('smg_subject_category');
	if($_REQUEST['id']){
		$category->find($_REQUEST['id']);		
	}
	$category->update_attributes($_POST['category']);
	redirect('subject_category.php?id=' .$category->subject_id);
	
?>