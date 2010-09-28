<?php
//package com.member.admin.action;

import("com.member.admin.biz.Auth");
import("com.member.admin.biz.Privilege");

class PrivilegeAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
 		
		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {

  			$TPL->assign("Session", $Auth->session);
			$privilege = new Privilege();
			switch($IN["o"]) {
				case 'add':
 					$ActionMapping->findForward("privilege.add");
					break;
				case 'add_submit':
					$privilege->flushData();
					$privilege->addData("PrivilegeName", $IN['PrivilegeName']);
					$privilege->addData("PrivilegeUID", $IN['PrivilegeUID']);
					
									

					if($privilege->add()) {
						$ActionMapping->doForwardAction("privilege", "privilege.add.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "privilege.add.fail");
					
					}
	
					break;
				case 'edit':
					$Info = $privilege->getInfo($IN['PID']);
 					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("privilege.edit");
					break;
				case 'edit_submit':
					$privilege->flushData();
					$privilege->addData("PrivilegeName", $IN['PrivilegeName']);
					$privilege->addData("PrivilegeUID", $IN['PrivilegeUID']);
					

					if($privilege->update($IN['PID'])) {
						$ActionMapping->doForwardAction("privilege", "privilege.edit.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "privilege.edit.fail");
					
					}
	
					break;
				case 'del':
 
					if($privilege->del($IN['PID'])) {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "privilege.del.success");
					} else{
						$ActionMapping->doForwardAction(ActionMapping_Referer, "privilege.del.fail");
					
					}
	
					break;
				case 'view':
					$Info = $privilege->getInfo($IN['PID']);
					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("privilege.view");
					break;

				case 'main':
				case 'list':
				default:
					$offset = empty($IN[offset]) ? 20 : $IN[offset];
					$Page = empty($IN[Page]) ? 1 : $Page = $IN[Page];
					$num= $privilege->getRecordNum();

					$pagenum=ceil($num/$offset);
					$start=($Page-1)*$offset;
						
					$pageInfo[currentPage] = $Page;
					$pageInfo[pageNum] = $pagenum;
					$pageInfo[recordNum] = $num;
					$pageInfo[offset] = $offset;
					$pageInfo[from] = $start;
					$pageInfo[to] = $start+$offset;
					$pageInfo[uri] = $_SERVER["REQUEST_URI"];

			 
					$list = $privilege->getRecordLimit( $start, $offset);
					$TPL->assign_by_ref("RecordList", $list);
					$TPL->assign_by_ref("pageInfo", $pageInfo);	
					$ActionMapping->findForward("privilege.list");
					break;

 			}


		} else {
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>