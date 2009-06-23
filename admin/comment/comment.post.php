<?php
    require_once('../../frame.php');
	$db = get_db();
	$sql = 'update smg_comment set comment="'.$_POST['comment'].'" where id='.$_POST['id'];
	$db ->execute($sql);
	close_db();
?>