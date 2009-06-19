<?php
  require_once('../../frame.php');
	
	if("del"==$_POST['post_type'])
	{
		$post = new table_class($_POST['db_table']);
		$post -> delete($_POST['del_id']);
		echo $_POST['del_id'];
	}	
	elseif("edit"==$_POST['post_type'])
	{
		$post = new table_class($_POST['db_table']);
		$post -> find($_POST['id']);
		$post -> update_attributes($_POST['post']);
		$post -> save();
		redirect($_POST['url']);
		
	}
	elseif("revocation"==$_POST['type'])
	{
		$post = new table_class($_POST['db_table']);
		$post->find($_POST['id']);
		$post->update_attribute("is_adopt","0");	
	}
	elseif("publish"==$_POST['type'])
	{
		$post = new table_class($_POST['db_table']);
		$post->find($_POST['id']);
		$post->update_attribute("is_adopt","1");
	}
	
?>