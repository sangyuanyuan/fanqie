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
	elseif("edit_priority"==$_POST['post_type'])
	{
		$post = new table_class($_POST['db_table']);
		$id_str=explode("|",$_POST['id_str']); 
		$priority_str=explode("|",$_POST['priority_str']); 
		$id_str_num=sizeof($id_str)-1;
		for($i=$id_str_num-1;$i>=0;$i--)
		{
			if($priority_str[$i]==""){$priority_str[$i]="100";}
			$db = get_db();
			$sql="update smg_dept_list set priority=".$priority_str[$i]." where id=".$id_str[$i];
			$db->execute($sql);
		}		
	}
	
	
?>