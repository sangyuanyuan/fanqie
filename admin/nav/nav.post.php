<?php
  require_once('../../frame.php');
	judge_role('admin');
	$nav = new table_class('smg_nav');
	$nav -> find($_POST['edit_id']);
	$nav -> update_attributes($_POST['nav']);
	$nav -> save();
	echo "ok";
	
	
?>