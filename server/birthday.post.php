<?php
     require_once "../frame.php";
	 
	 $db = get_db();
	 if($_POST['type']=='contrl'){
	 	$sql = 'update smg_user_real set hide_birthday='.$_POST['value'].' where loginname="'.$_POST['id'].'"';
		$db->execute($sql);
	 }
?>