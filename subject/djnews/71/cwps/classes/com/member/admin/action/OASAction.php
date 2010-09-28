<?php
//package com.member.admin.action;

import("com.member.admin.biz.Auth");
import("com.member.admin.biz.OAS");

class OASAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
 		
		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {

  			$TPL->assign("Session", $Auth->session);
			$oas = new OAS();
			switch($IN["o"]) {
				case 'add':

 					$ActionMapping->findForward("oas.add");
					break;
				case 'add_submit':
					$oas->flushData();
					$oas->addData("OASName", $IN['OASName']);
					$oas->addData("OASUID", $IN['OASUID']);
					$oas->addData("IP", $IN['IP']);
					$oas->addData("CWPSPassword", $IN['CWPSPassword']);
					$oas->addData("ProvisionURL", $IN['ProvisionURL']);
					$oas->addData("ProvisionPassword", $IN['ProvisionPassword']);
					
									

					if($oas->add()) {
						$oas->makeSoapOAS();
						$ActionMapping->doForwardAction("oas", "oas.add.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "oas.add.fail");
					
					}
	
					break;
				case 'edit':
					$Info = $oas->getInfo($IN['OASID']);

 					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("oas.edit");
					break;
				case 'edit_submit':
					$oas->flushData();
					$oas->addData("OASName", $IN['OASName']);
					$oas->addData("OASUID", $IN['OASUID']);
					$oas->addData("IP", $IN['IP']);
					$oas->addData("CWPSPassword", $IN['CWPSPassword']);
					$oas->addData("ProvisionURL", $IN['ProvisionURL']);
					$oas->addData("ProvisionPassword", $IN['ProvisionPassword']);
					

					if($oas->update($IN['OASID'])) {
						$oas->makeSoapOAS();
						$ActionMapping->doForwardAction("oas", "oas.edit.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "oas.edit.fail");
					
					}
	
					break;
				case 'del':
 
					if($oas->del($IN['OASID'])) {
						$oas->makeSoapOAS();
						$ActionMapping->doForwardAction(ActionMapping_Referer, "oas.del.success");
					} else{
						$ActionMapping->doForwardAction(ActionMapping_Referer, "oas.del.fail");
					
					}
	
					break;
				case 'view':
					$Info = $oas->getInfo($IN['OASID']);
					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("oas.view");
					break;

				case 'main':
				case 'list':
				default:
					$offset = empty($IN[offset]) ? 20 : $IN[offset];
					$Page = empty($IN[Page]) ? 1 : $Page = $IN[Page];
					$num= $oas->getRecordNum();

					$pagenum=ceil($num/$offset);
					$start=($Page-1)*$offset;
						
					$pageInfo[currentPage] = $Page;
					$pageInfo[pageNum] = $pagenum;
					$pageInfo[recordNum] = $num;
					$pageInfo[offset] = $offset;
					$pageInfo[from] = $start;
					$pageInfo[to] = $start+$offset;
					$pageInfo[uri] = $_SERVER["REQUEST_URI"];

			 
					$list = $oas->getRecordLimit( $start, $offset);
					$TPL->assign_by_ref("RecordList", $list);
					$TPL->assign_by_ref("pageInfo", $pageInfo);	
					$ActionMapping->findForward("oas.list");
					break;

 			}


		} else {
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>