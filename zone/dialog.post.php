<?php
  require_once('../frame.php');
 
 if($_POST['type']=="collection")
 { 
	$dialog = new table_class('smg_dialog_collection');
	$dialog -> update_attributes($_POST['dialog'],false);
	$dialog->create_time = now();
	$dialog->ip = getenv('REMOTE_ADDR');
	$dialog -> save();

	echo "ok";
  }
 
 if($_POST['type']=="digg")
 { 
	$collection = new table_class('smg_dialog_collection');
	$collection -> find($_POST['id']);
	$collection -> update_attributes($_POST['collection'],false);
	$collection-> dig = $collection->dig+1;
	$collection -> save();

	echo "ok";
  }	
?>