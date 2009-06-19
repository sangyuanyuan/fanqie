<?php
  require_once('../../frame.php');
	$post = new table_class($_POST['db_table']);
	if("del"==$_POST['post_type'])
	{
		$post -> delete($_POST['del_id']);
		echo $_POST['del_id'];
	}	
	elseif("edit"==$_POST['post_type'])
	{
		$post -> find($_POST['id']);
		$post -> update_attributes($_POST['post']);
		$post -> save();
		redirect($_POST['url']);
		
	}
	elseif("edit_priority"==$_POST['post_type'])
	{
		$id_str=explode("|",$_POST['id_str']); 
		$priority_str=explode("|",$_POST['priority_str']); 
		$id_str_num=sizeof($id_str)-1;
		for($i=$id_str_num-1;$i>=0;$i--)
		{
			if($priority_str[$i]==""){$priority_str[$i]="100";}
			$db = get_db();
			$sql="update ".$_POST['db_table']." set priority=".$priority_str[$i]." where id=".$id_str[$i];
			$db->execute($sql);
		}		
	}
	
	elseif("revocation"==$_POST['type'])
	{
		$post->find($_POST['id']);
		$post->update_attribute("is_adopt","0");	
	}
	elseif("publish"==$_POST['type'])
	{
		$post->find($_POST['id']);
		$post->update_attribute("is_adopt","1");
	}
	
?>