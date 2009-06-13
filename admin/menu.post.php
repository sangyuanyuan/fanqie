<?php
    require_once('../frame.php');
	$db=get_db();
	$url=admin.php;
	
	if("add_menu"===$_POST['type']){
		if(""!==$_POST['main_menu_name']){	
			$sql='insert into smg_admin_menu (name,href,description,priority,parent_id) values("'.$_POST['main_menu_name'].'","'.$_POST['main_menu_link'].'","'.$_POST['main_menu_descripion'].'","'.$_POST['main_menu_priority'].'","0")';
			if($db->execute($sql)){
			redirect($url);
			}else{
				echo "insert main_menu error<br>";
				echo $sql;
			}
		}else if(""!==$_POST['child_menu_name']&&""!==$_POST['child_menu_parent']){
			$sql='select id from smg_admin_menu where name="'.$_POST['child_menu_parent'].'"';
			if($db->query($sql)){
				$parent_id=$db->query($sql);
			}else{
				echo "select parent_id error<br>";
				echo $sql;
			}
			if(""!==$_POST['child_menu_link']){
				$sql='insert into smg_admin_menu (name,href,description,priority,parent_id) values("'.$_POST['child_menu_name'].'","'.$_POST['child_menu_link'].'","'.$_POST['child_menu_description'].'","'.$_POST['child_menu_priority'].'","'.$parent_id[0]->id.'")';
			}else{
				$sql='insert into smg_admin_menu (name,href,description,priority,parent_id) values("'.$_POST['child_menu_name'].'","#","'.$_POST['child_menu_description'].'","'.$_POST['child_menu_priority'].'","'.$_POST['child_menu_parent'].'")';
			}
			if($db->execute($sql)){
			redirect($url);
			}else{
				echo "insert child_menu error<br>";
				echo $sql;
			}
		}
	}else if("edit_menu"===$_POST['type']){
		if($_POST['menu_parent']<>null){
			$sql='select id from smg_admin_menu where name="'.$_POST['menu_parent'].'"';
			if($db->query($sql)){
				$parent_id=$db->query($sql);
				$parent_id=$parent_id[0]->id;
			}else{
				echo "select parent_id error<br>";
				echo $sql;
			}
		}else{
			$parent_id=0;
		}
		
		$sql='update smg_admin_menu set name="'.$_POST['menu_name'].'",href="'.$_POST['menu_href'].'",parent_id="'.$parent_id.'",description="'.$_POST['menu_description'].'",priority="'.$_POST['menu_priority'].'" where id="'.$_POST['id'].'"';
		if($db->execute($sql)){
			redirect($url);
		}else{
			echo "update menu error<br>";
			echo $sql;
		}
	}
	
	
	
?>