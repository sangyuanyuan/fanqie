<?php
    require_once('../frame.php');
	$db=get_db();
	$url="menu_list.php";
	
	if("add_menu"===$_POST['type']){
		if(""!==$_POST['main_menu_name']){	
			if(null<>$_POST['main_menu_href']){
				$link=$_POST['main_menu_href'];
			}else{
				$link="#";
			}
			$sql='insert into smg_admin_menu (name,href,description,priority,parent_id) values("'.$_POST['main_menu_name'].'","'.$link.'","'.$_POST['main_menu_descripion'].'","'.$_POST['main_menu_priority'].'","0")';
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
				$sql='insert into smg_admin_menu (name,href,description,priority,parent_id) values("'.$_POST['child_menu_name'].'","#","'.$_POST['child_menu_description'].'","'.$_POST['child_menu_priority'].'","'.$parent_id[0]->id.'")';
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
		if($_POST['menu_href']<>null){
			$link=$_POST['menu_href'];
		}else{
			$link="#";
		}
		$sql='update smg_admin_menu set name="'.$_POST['menu_name'].'",href="'.$link.'",parent_id="'.$parent_id.'",description="'.$_POST['menu_description'].'",priority="'.$_POST['menu_priority'].'" where id="'.$_POST['id'].'"';
		if($db->execute($sql)){
			redirect($url);
		}else{
			echo "update menu error<br>";
			echo $sql;
		}
	}else if("del_menu"===$_POST['type']){
		$sql='delete from smg_admin_menu where id="'.$_POST['del_id'].'"';
		if($db->execute($sql)){
			echo $_POST['del_id'];
		}else{
			echo "delect error<br>";
			echo $sql;
		}
	}
	
	
	
?>