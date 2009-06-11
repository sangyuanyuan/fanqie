<?php
    require_once('../frame.php');
	$db=get_db();
	$url=admin.php;
	
	if(null<>$_POST['main_menu_name']){
		if(null<>$_POST['main_menu_link']){
			$sql='insert into smg_admin_menu (name,href,description,priority,parent_id) values("'.$_POST['main_menu_name'].'","'.$_POST['main_menu_link'].'","'.$_POST['main_menu_descripion'].'","'.$_POST['main_menu_priority'].'","0")';
		}else{
			$sql='insert into smg_admin_menu (name,href,description,priority,parent_id) values("'.$_POST['main_menu_name'].'","#","'.$_POST['main_menu_descripion'].'","'.$_POST['main_menu_priority'].'","0")';
		}
	}
	if($db->execute($sql)){
		redirect($url);
	}else{
		echo "error<br>";
		echo $sql;
	}
	
	
?>