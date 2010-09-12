<?php 
	include('../../frame.php');
	$id=$_POST['id'];
	$db=get_db();
	$db->execute('delete from smg_jspd_jssh where id='.$id);
?>