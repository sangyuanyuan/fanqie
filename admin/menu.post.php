<?php
    require_once('../frame.php');
	$db=get_db();
	$url="menu_list.php";
	
	if("del_menu"===$_POST['type']){
		$sql='delete from smg_admin_menu where id="'.$_POST['del_id'].'"';
		if($db->execute($sql)){
			echo $_POST['del_id'];
			close_db();
		}else{
			echo "delect error<br>";
			echo $sql;
		}
	}else{	
			$menu = new table_class('smg_admin_menu');
			$menu->find($_POST['id']);
			$menu->update_attributes($_POST['menu']);
			$menu->save();
			redirect($url);
	}
	
	
	
?>