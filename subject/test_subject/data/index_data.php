<?php
	$path = explode('\\',dirname(__FILE__));
	$path = $path[count($path)-2];
	$db = get_db();
	$subject = $db->query("select * from smg_subject where identity='$path'");
	$subject = $subject[0];
	$modules = new smg_subject_module_class();
	$modules = $modules->find('all',array('conditions' => "subject_id = {$subject->id}",'order' => "priority asc,id desc"));
?>