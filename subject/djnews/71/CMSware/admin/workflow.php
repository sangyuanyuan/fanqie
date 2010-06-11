<?php
require_once 'common.php';


if(!$sys->isAdmin()) {
	goback('access_deny_module_workflow');

}

require_once INCLUDE_PATH."admin/workflowAdmin.class.php";

$workflow = new workflowAdmin();


switch($IN[o]) {

	case 'view':
		$TPL->assign('workflowInfo', $workflow->getAll());
		$TPL->assign('workflowState', $workflow->getAllState());
		$TPL->display("workflow_view.html");
		break;

	case 'add':
 		$TPL->display("workflow_add.html");
		break;

	case 'add_submit':
		$workflow->flushData();
		$workflow->addData("Name", $IN[Name]);
		$workflow->addData("Intro", $IN[Intro]);
		if($workflow->add()) { 

			goto("view", 'add_workflow_ok');

		} else {
			goto("view", 'add_workflow_fail');
		
		}

		break;
	case 'edit':
		if(empty($IN[wID])) goto('view');
		$data = $workflow->getInfo($IN[wID]);


		$TPL->assign('Info', $data);
 		$TPL->display("workflow_edit.html");
		break;

	case 'edit_submit':
		if(empty($IN[wID])) goto('view');

		$workflow->flushData();
		$workflow->addData("Name", $IN[Name]);
		$workflow->addData("Intro", $IN[Intro]);

 
		if($workflow->update($IN[wID])) { 
 			goto("view", 'edit_workflow_ok');

		} else {
			goto("view", 'edit_workflow_fail');
		
		}


		break;
	case 'del':
		if(empty($IN[wID])) goto('view');
		if($workflow->del($IN[wID])) {
			goto("view", 'del_workflow_ok');
			
		} else
			goto("view", 'del_workflow_fail');
		
		break;





	case 'add_state_submit':
		$workflow->flushData();
		$workflow->addData("Name", $IN[Name]);
		$workflow->addData("State", $IN[State]);
		$workflow->addData("System", 0);

		if($workflow->add_state()) { 

			goto("view", 'add_workflow_state_ok');

		} else {
			goto("view", 'add_workflow_state_fail');
		
		}

		break;
	case 'edit_state':
		if(empty($IN[ID])) goto('view');
		$data = $workflow->getStateInfo($IN[ID]);


		$TPL->assign('StateInfo', $data);
 		$TPL->display("workflow_state_edit.html");
		break;

	case 'edit_state_submit':
		if(empty($IN[ID])) goto('view');

		$workflow->flushData();
		$workflow->addData("Name", $IN[Name]);
		$workflow->addData("State", $IN[State]);

 
		if($workflow->update_state($IN[ID])) { 
 			goto("view", 'edit_workflow_state_ok');

		} else {
			goto("view", 'edit_workflow_state_fail');
		
		}


		break;

	case 'del_state':
		if(empty($IN[ID])) goto('view');
		if($workflow->del_state($IN[ID])) {
			goto("view", 'del_workflow_state_ok');
			
		} else
			goto("view", 'del_workflow_state_fail');
		
		break;


	case 'view_record':
		$TPL->assign('workflowInfo', $workflow->getInfo($IN[wID]));
		$TPL->assign('recordInfo', $workflow->getAllRecord($IN[wID]));
 		$TPL->assign('workflowState', $workflow->getAllState());
		$TPL->display("workflow_view_record.html");
		break;
	case 'add_record':
		require_once INCLUDE_PATH."admin/groupAdmin.class.php";
		$TPL->assign('gInfo',groupAdmin::getAll());
		$TPL->assign('workflowInfo', $workflow->getInfo($IN[wID]));
		$TPL->assign('workflowState', $workflow->getAllState());
 		$TPL->display("workflow_add_record.html");
		break;

	case 'add_record_submit':
		$workflow->flushData();
		$workflow->addData('wID', $IN[wID]);
		foreach($IN as $key=>$var) {
			$prefix = substr($key, 0, 5);
			$suffix = substr($key, 5);
			if($prefix == 'data_')
				$workflow->addData($suffix,$var);
			else
				continue;
		}
		if($workflow->add_record()) { 

			showmessage('add_workflow_record_ok', $base_url."o=view_record&wID=".$IN[wID]);

		} else {
			showmessage('add_workflow_record_fail', $base_url."o=view_record&wID=".$IN[wID]);
		
		}

		break;
 
	case 'edit_record':
		if(empty($IN[OpID])) goto('view');


		require_once INCLUDE_PATH."admin/groupAdmin.class.php";
		$TPL->assign('gInfo',groupAdmin::getAll());
		$data = $workflow->getRecordInfo($IN[OpID]);


		$TPL->assign('RecordInfo', $data);

		$TPL->assign('workflowInfo', $workflow->getInfo($IN[wID]));
		$TPL->assign('workflowState', $workflow->getAllState());
 		$TPL->display("workflow_edit_record.html");
		break;

	case 'edit_record_submit':
		if(empty($IN[OpID])) goto('view');
		$workflow->flushData();
 		foreach($IN as $key=>$var) {
			$prefix = substr($key, 0, 5);
			$suffix = substr($key, 5);
			if($prefix == 'data_')
				$workflow->addData($suffix,$var);
			else
				continue;
		}
		if($workflow->edit_record($IN[OpID])) { 

			showmessage('edit_workflow_record_ok', $base_url."o=view_record&wID=".$IN[wID]);
 
		} else {
			showmessage('edit_workflow_record_fail', $base_url."o=view_record&wID=".$IN[wID]);
		
		}

		break;

	case 'del_record':
		if(empty($IN[OpID])) goto('view');
		if($workflow->del_record($IN[OpID])) {
			showmessage('del_workflow_record_ok', $base_url."o=view_record&wID=".$IN[wID]);
			
		} else
			showmessage('del_workflow_record_fail', $base_url."o=view_record&wID=".$IN[wID]);
		
		break;
}

	
include MODULES_DIR.'footer.php' ;



?>
