<?php
	require "../frame.php";
	$db = get_db();
	$PostDiv="abderraf123123";
	list($name) = split ($PostDiv, $_POST["iptotal"]);
	$db->execute('insert into smg_ip_total(ip,created_at) value ("'.$name.'",now())');
?>