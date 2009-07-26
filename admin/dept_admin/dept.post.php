<?php
	include "../../frame.php";
	var_dump($_POST['dept']);
	$dept_id= $_REQUEST['dept_id'] ? $_REQUEST['dept_id'] : 0;
	$dept = new table_class('smg_dept');
	if($dept_id){
		$dept = $dept->find($dept_id);
	}
	$dept->update_attributes($_POST['dept'],false);
	$dept->priority = empty($dept->priority) ? 100 : $dept->priority;
	if($dept_id  <= 0){
		$dept->created_at = now();
	}
	$dept->save();
	#redirect('index.php');
?>