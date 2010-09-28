<?php
  require_once('../frame.php');
  
	$dialog = new table_class('smg_dialog_collection');
	$dialog -> update_attributes($_POST['dialog'],false);

	$dialog->create_time = now();
	$dialog->ip = getenv('REMOTE_ADDR');
	$dialog -> save();

	echo "ok";
	
?>