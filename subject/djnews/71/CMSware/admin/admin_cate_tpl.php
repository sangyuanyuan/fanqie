<?php
require_once 'common.php';
/*
if(!$sys->canAccess('cantpl')) {
	goback('access_deny_module_tpl');

}
*/

require_once INCLUDE_PATH."admin/cate_tpl_admin.class.php";
require_once INCLUDE_PATH."admin/tpl_cate_admin.class.php";
require_once INCLUDE_PATH."admin/psn_admin.class.php";
require_once INCLUDE_PATH."admin/userAdmin.class.php";

$cate_tpl = new cate_tpl_admin();
$tpl_cate = new tpl_cate_admin();
$psn = new psn_admin();

if(!empty($IN[TCID])) {
	$CateInfo = $tpl_cate->getCateInfo($IN[TCID]);
} 

switch($IN['o']) {
	case 'list':

		if(!$tpl_cate->canAccess($CateInfo, 'Read')) {
			goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_read'], $CateInfo['CateName']) ,1);
		
		}

		$TPL->assign_by_ref('CateInfo', $CateInfo);
		$TPL->assign('list', $cate_tpl->getAll($IN[TCID]));
		$TPL->display("cate_tpl_list.html");

		break;


	case 'add':
		if(!$tpl_cate->canAccess($CateInfo, 'Write')) {
			goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_write'], $CateInfo['CateName']) ,1);
		
		}
 
		$TPL->assign_by_ref('CateInfo', $CateInfo);
		$TPL->display("tpl_add.html");
		break;
	case 'add_submit':
 		if(!$tpl_cate->canAccess($CateInfo, 'Write')) {
			goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_write'], $CateInfo['CateName']) ,1);
		
		}

		$cate_tpl->flushData();
		$cate_tpl->filterData($IN);
		$cate_tpl->addData('TCID', $IN[TCID]);
		
 		if($cate_tpl->add()) {  
			if($IN['mode_upload'] == 1) { //模板上传
				$psn->isLog = false;
				$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];
				$psn->connect($psnInfo[PSN]);
				$psn->upload(CACHE_DIR."tmp/".$IN['sId'].".upload", "/ROOT/".$IN[TCID]."/".$cate_tpl->db_insert_id.".tpl");
			
			} else { //编辑器录入
				$psn->isLog = false;
				$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];
				$psn->connect($psnInfo[PSN]);
				$tempFileName = CACHE_DIR."tmp/".$IN['sId'].$IN['TCID']."o".$IN['TID'].".tmp";

				if(file_exists($tempFileName)) {
					$content = getFile($tempFileName);
					unlink($tempFileName);
					
				} 

				$psn->put("/ROOT/".$IN[TCID]."/".$cate_tpl->db_insert_id.".tpl", $content);
				$psn->close();
			}

 			showmessage('add_cate_tpl_ok', $referer);
		} else	
			showmessage( 'add_cate_tpl_fail', $referer);			
		break;
	case 'edit':
		if(empty($IN[TCID])) {
			$TplInfo = $cate_tpl->getInfo($IN[TID]);
			$CateInfo = $tpl_cate->getCateInfo($TplInfo[TCID]);
		} else {
			$TplInfo = $cate_tpl->getInfo($IN[TID]);
	
		}

		if(!$tpl_cate->canAccess($CateInfo, 'Read')) {
			goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_read'], $CateInfo['CateName']) ,1);
		
		}
 
		$TPL->assign_by_ref('CateInfo', $CateInfo);
		$TPL->assign_by_ref('TplInfo', $TplInfo);
		$TPL->display("tpl_edit.html");


		break;

	case 'edit_submit':
		if(!$tpl_cate->canAccess($CateInfo, 'Write')) {
			goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_write'], $CateInfo['CateName']) ,1);
		
		}
		if(empty($IN[TID])) goto('list');

		$cate_tpl->flushData();
		$cate_tpl->filterData($IN);
 	
 
		if($cate_tpl->update($IN[TID])) { 
			$psn->isLog = false;
			$psnInfo[PSN] = 'file::'.$SYS_ENV['templatePath'];
			$psn->connect($psnInfo[PSN]);
			$tempFileName = CACHE_DIR."tmp/".$IN['sId'].$IN['TCID']."o".$IN['TID'].".tmp";
			//echo $tempFileName ;
			if(file_exists($tempFileName)) {
				$content = getFile($tempFileName);
				unlink($tempFileName);
				$psn->put("/ROOT/".$IN[TCID]."/".$IN[TID].".tpl", $content);
				$psn->close();
				
			} 

 			showmessage('edit_cate_tpl_ok', $referer);
		} else	
			showmessage('edit_cate_tpl_fail', $referer);
		
		break;
	case 'del':
		if(!$tpl_cate->canAccess($CateInfo, 'Write')) {
			goback(sprintf($_LANG_ADMIN['tpl_cate_permission_deny_write'], $CateInfo['CateName']) ,1);
		
		}


		if(!empty($IN[multi]) && !empty($IN[pData]) ) {
			foreach($IN[pData] as $var) {
 				$result = $cate_tpl->del($var);				
				delFile($SYS_ENV['templatePath']."/ROOT/".$IN[TCID]."/".$var.".tpl");
			}

			if($result) showmessage('del_cate_tpl_ok', $referer);
			else showmessage('del_cate_tpl_fail', $referer);

		} else {
			if(!empty($IN[TID]) && $cate_tpl->del($IN[TID])) {
				delFile($SYS_ENV['templatePath']."/ROOT/".$IN[TCID]."/".$IN[TID].".tpl");
				showmessage('del_cate_tpl_ok', $referer);
				
			} else
				showmessage('del_cate_tpl_fail', $referer);
		
		
		}


		break;


	case 'move':
		if(empty($IN[targetTCID]))
			showmessage('targetTCID_null', $referer);
							
		if(!empty($IN[multi]) && !empty($IN[pData]) ) {
			foreach($IN[pData] as $var) {
 					$result = $cate_tpl->move($var, $IN[targetTCID]);				
			}

			if($result) showmessage('move_cate_tpl_ok', $referer);
			else showmessage('move_cate_tpl_fail', $referer);

		} else showmessage('move_cate_tpl_fail', $referer);

		break;
	case 'copy':
		if(empty($IN[targetTCID]))
			showmessage('targetTCID_null', $referer);
							
		if(!empty($IN[multi]) && !empty($IN[pData]) ) {
			foreach($IN[pData] as $var) {
 					$result = $cate_tpl->copyTo($var, $IN[targetTCID]);				
			}

			if($result) showmessage('copy_cate_tpl_ok', $referer);
			else showmessage('copy_cate_tpl_fail', $referer);

		} else showmessage('copy_cate_tpl_fail', $referer);

		break;
 
}


include MODULES_DIR.'footer.php' ;

?>
