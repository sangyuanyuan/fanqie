<?php
  require_once('../frame.php');
  
	$dialog = new table_class('smg_dialog_collection');
	$dialog -> update_attributes($_POST['dialog'],false);
	$dialog->created_at = now();
	$dialog->save();
	//var_dump($dialog);
	#$dialog -> save();
	#echo $_POST['dialog[0]'];
	#echo $_POST['dialog[user_id]'];
	echo "ok";
	
?>