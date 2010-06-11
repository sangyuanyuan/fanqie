<?php
require_once 'common.php';
/*
if(!$sys->canAccess('cantpl')) {
	goback('access_deny_module_tpl');

}
*/

require_once INCLUDE_PATH."admin/tpl_cate_admin.class.php";
require_once INCLUDE_PATH."admin/groupAdmin.class.php";
require_once INCLUDE_PATH."admin/userAdmin.class.php";

$tpl_cate = new tpl_cate_admin();


switch($IN['o']) {

	case 'add':
		


		if(empty($IN[ParentTCID])) {
			//Access Detector
			if(!$sys->isAdmin()) goback('tpl_cate_permission_deny_notadmin');
			$TPL->assign('ParentTCID', 0);

		} else{
			$CateInfo = $tpl_cate->getCateInfo($IN[ParentTCID]);
			//Access Detector
			if(!$tpl_cate->canAccess($CateInfo, 'Manage')) {
				goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_manage'], $CateInfo['CateName']) ,1);
			}
			$TPL->assign('ParentTCID', $IN[ParentTCID]);
			$TPL->assign('ParentCateName', $tpl_cate->getCateInfo($IN[ParentTCID], "CateName"));
		
		}
 
		$TPL->assign('uInfo',userAdmin::getAll());
		$TPL->assign('gInfo',groupAdmin::getAll());
		$TPL->display("tpl_cate_add.html");
		break;

	case 'add_submit':
		if(empty($IN[data_ParentTCID])) {
			//Access Detector
			if(!$sys->isAdmin()) goback('tpl_cate_permission_deny_notadmin');
		} else{
			$CateInfo = $tpl_cate->getCateInfo($IN[data_ParentTCID]);
			//Access Detector
			if(!$tpl_cate->canAccess($CateInfo, 'Manage')) {
					goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_manage'], $CateInfo['CateName']) ,1);
			}
		
		}

		$tpl_cate->flushData();

		$tpl_cate->filterData($IN);
 		if($tpl_cate->add()) { //插入分类数据
 			showmessage('add_tpl_cate_ok', $referer);
		} else	
			showmessage( 'add_tpl_cate_fail', $referer);			

		break;

	case 'edit':
		if(!empty($IN[TCID])) {
			$CateInfo = $tpl_cate->getCateInfo($IN[TCID]);

			//Access Detector
			if(!$tpl_cate->canAccess($CateInfo, 'Manage')) {
					goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_manage'], $CateInfo['CateName']) ,1);
			}
			$uInfo = userAdmin::getAll();
			$gInfo = groupAdmin::getAll();

			$ReadG = explode(',', $CateInfo['ReadG']);
			$WriteG = explode(',', $CateInfo['WriteG']);
			$ManageG = explode(',', $CateInfo['ManageG']);

			$ReadU = explode(',', $CateInfo['ReadU']);
			$WriteU = explode(',', $CateInfo['WriteU']);
			$ManageU = explode(',', $CateInfo['ManageU']);

			foreach($gInfo as $var) {
				if(in_array($var['gId'], $ReadG)) $TargetReadG[] = $var;
				else $SrcReadG[] = $var;
			}

			foreach($gInfo as $var) {
				if(in_array($var['gId'], $WriteG)) $TargetWriteG[] = $var;
				else $SrcWriteG[] = $var;
			}
			foreach($gInfo as $var) {
				if(in_array($var['gId'], $ManageG)) $TargetManageG[] = $var;
				else $SrcManageG[] = $var;
			}


			foreach($uInfo as $var) {
				if(in_array($var['uId'], $ReadU)) $TargetReadU[] = $var;
				else $SrcReadU[] = $var;
			}
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $WriteU)) $TargetWriteU[] = $var;
				else $SrcWriteU[] = $var;
			}
			foreach($uInfo as $var) {
				if(in_array($var['uId'], $ManageU)) $TargetManageU[] = $var;
				else $SrcManageU[] = $var;
			}

 			$TPL->assign_by_ref('SrcReadG', $SrcReadG);
 			$TPL->assign_by_ref('TargetReadG', $TargetReadG);
 			$TPL->assign_by_ref('SrcWriteG', $SrcWriteG);
 			$TPL->assign_by_ref('TargetWriteG', $TargetWriteG);
 			$TPL->assign_by_ref('SrcManageG', $SrcManageG);
 			$TPL->assign_by_ref('TargetManageG', $TargetManageG);

 			$TPL->assign_by_ref('SrcReadU', $SrcReadU);
 			$TPL->assign_by_ref('TargetReadU', $TargetReadU);
 			$TPL->assign_by_ref('SrcWriteU', $SrcWriteU);
 			$TPL->assign_by_ref('TargetWriteU', $TargetWriteU);
 			$TPL->assign_by_ref('SrcManageU', $SrcManageU);
 			$TPL->assign_by_ref('TargetManageU', $TargetManageU);

 			$TPL->assign('ParentCateName', $tpl_cate->getCateInfo($CateInfo[ParentTCID], "CateName"));
 			$TPL->assign_by_ref('CateInfo', $CateInfo);
 			$TPL->display("tpl_cate_edit.html");	
		} else
			goto('view');

		break;

	case 'edit_submit':
		if(empty($IN[TCID])) goto('view');

		$CateInfo = $tpl_cate->getCateInfo($IN[TCID]);

		//Access Detector
		if(!$tpl_cate->canAccess($CateInfo, 'Manage')) {
				goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_manage'], $CateInfo['CateName']) ,1);
		}

		$tpl_cate->flushData();
		$tpl_cate->filterData($IN);
 	
 
		if($tpl_cate->update($IN[TCID])) {  
 			showmessage('edit_tpl_cate_ok', $referer);
		} else	
			showmessage('edit_tpl_cate_fail', $referer);
		
		break;

	case 'del':
		if(empty($IN[TCID])) goto('view');

		$CateInfo = $tpl_cate->getCateInfo($IN[TCID]);

		//Access Detector
		if(!$tpl_cate->isCreationUser($CateInfo)) {
				goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_notCreationUser'], $CateInfo['CateName']) ,1);
		}

		if($tpl_cate->haveSon($IN[TCID]) && $IN[action] != 'force') {
				confirm("del&TCID={$IN[TCID]}&action=force", $_LANG_ADMIN['del_tpl_cate_haveson']);
			
		} elseif($tpl_cate->haveSon($IN[TCID]) && $IN[action] == 'force') {

			if($tpl_cate->del($IN[TCID])) {
				alert('del_tpl_cate_haveson_ok','panelMenu');


			} else
				alert('del_tpl_cate_haveson_fail','panelMenu');

		} else {

			if($tpl_cate->del($IN[TCID])) {

				alert('del_tpl_cate_ok','panelMenu');
			
			} else
				alert('del_tpl_cate_fail','panelMenu');

	
		}
		break;

	case 'move':
		if(empty($IN[TCID])) goto('view');
		
		//Access Detector
		if(!$tpl_cate->isCreationUser($CateInfo)) {
				halt(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_notCreationUser'], $CateInfo['CateName']) ,1);
		}

		$tpl_cate->flushData();
		$tpl_cate->addData('ParentTCID', $IN[targetTCID]);

	


		if($IN[TCID] == $IN[targetTCID]) {
			alert('move_tpl_cate_id_conflict','panelMenu');
	
		} elseif($tpl_cate->update($IN[TCID])) { //更新分类数据
			alert('move_tpl_cate_ok','panelMenu');
		} else
			alert('move_tpl_cate_fail','panelMenu');

		break;
 

}


include MODULES_DIR.'footer.php' ;

?>
