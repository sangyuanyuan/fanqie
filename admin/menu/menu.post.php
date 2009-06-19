<?php
  require_once('../../frame.php');
	$url="menu_list.php?type=".$_POST['menu_type']."&flag=1";
	
	if("del_menu"==$_POST['type']){
		if("admin"==$_POST['menu_type'] || empty($_POST['menu_type'])) {
			$menu = new table_class('smg_admin_menu');
		}else if("dept"==$_POST['menu_type']) {
			$menu = new table_class('smg_admin_menu_dept');
		}
		$menu -> delete($_POST['del_id']);
		echo $_POST['del_id'];
	}else{	
		if("admin"==$_POST['menu_type']) {$menu = new table_class('smg_admin_menu');}
		else if("dept"==$_POST['menu_type']) {$menu = new table_class('smg_admin_menu_dept');}
		$menu -> find($_POST['id']);
		$menu -> update_attributes($_POST['menu']);
		$menu -> save();
		redirect($url);
	}
	
	
	
?>