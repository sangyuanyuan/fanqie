<?php
  require_once('../frame.php');
 	session_start();
	if($_SESSION['url']=="172.27.203.81:8080"||$_SESSION['url']=="172.27.203.83:8080")
	{
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
		$_SESSION['url']="";
	 }
	}
	else
	{
		die('请从网站入口提交！');	
	}
?>