<?php
  require_once('../../frame.php');
	$url="menu_list.php?id=1";
	
	if("del_menu"==$_POST['type']){
		$menu = new table_class('smg_admin_menu');
		$menu -> delete($_POST['del_id']);
		echo $_POST['del_id'];
	}else{	
		$menu = new table_class('smg_admin_menu');
		$menu -> find($_POST['id']);
		$menu -> update_attributes($_POST['menu']);
		$menu -> save();
		//redirect($url);
	}
	
	
	
?>