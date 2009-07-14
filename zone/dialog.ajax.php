<?php
	require "../../frame.php";
	switch ($_POST['optype']) {
		case 'add_question':
			$question = new table_class('smg_dialog_question');
		break;
		
		default:
			;
		break;
	}
?>