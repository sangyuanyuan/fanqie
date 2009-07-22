<?php
  require_once('../../frame.php');
	
	$dialog = new table_class('smg_dialog_collection');
	$dialog -> update_attributes($_POST['dialog']);
	$dialog -> save();
	echo "ok";
	
	
?>