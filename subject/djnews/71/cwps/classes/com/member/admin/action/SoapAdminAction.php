<?php
//package com.member.admin.action;

import("com.member.admin.biz.Auth");
import("com.member.admin.biz.SoapAdmin");

class SoapAdminAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
 		
		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {

  			$TPL->assign("Session", $Auth->session);
			$soapadmin = new SoapAdmin();
			switch($IN["o"]) {
				case 'add':
					$UnRegSoapIDs = $soapadmin->getUnRegSoapIDs();
					if($UnRegSoapIDs === false) {
						$errors->add(ActionErrors_GLOBAL_ERROR, "soapadmin.add.notUnRegSoapID" );
						return $errors;
					}
  					$TPL->assign_by_ref("UnRegSoapIDs", $UnRegSoapIDs);
  					$ActionMapping->findForward("soapadmin.add");
					break;
				case 'add_submit':
					$soapadmin->flushData();
					$soapadmin->addData("SoapID", $IN['SoapID']);
					$soapadmin->addData("SoapName", $IN['SoapName']);
					
									

					if($soapadmin->add()) {
						$soapadmin->makeSoapAction();
						$ActionMapping->doForwardAction("soapadmin", "soapadmin.add.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "soapadmin.add.fail");
					
					}
	
					break;
				case 'edit':
					$Info = $soapadmin->getInfo($IN['SoapID']);
  					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("soapadmin.edit");
					break;
				case 'edit_submit':
					$soapadmin->flushData();
					$soapadmin->addData("SoapName", $IN['SoapName']);
					

					if($soapadmin->update($IN['SoapID'])) {
						$soapadmin->makeSoapAction();
						$ActionMapping->doForwardAction("soapadmin", "soapadmin.edit.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "soapadmin.edit.fail");
					
					}
	
					break;
				case 'del':
 
					if($soapadmin->del($IN['SoapID'])) {
						$soapadmin->makeSoapAction();
						$ActionMapping->doForwardAction(ActionMapping_Referer, "soapadmin.del.success");
					} else{
						$ActionMapping->doForwardAction(ActionMapping_Referer, "soapadmin.del.fail");
					
					}
	
					break;
				case 'view':
					$Info = $soapadmin->getInfo($IN['SoapID']);
					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("soapadmin.view");
					break;

				case 'main':
				case 'list':
				default:
					$offset = empty($IN[offset]) ? 20 : $IN[offset];
					$Page = empty($IN[Page]) ? 1 : $Page = $IN[Page];
					$num= $soapadmin->getRecordNum();

					$pagenum=ceil($num/$offset);
					$start=($Page-1)*$offset;
						
					$pageInfo[currentPage] = $Page;
					$pageInfo[pageNum] = $pagenum;
					$pageInfo[recordNum] = $num;
					$pageInfo[offset] = $offset;
					$pageInfo[from] = $start;
					$pageInfo[to] = $start+$offset;
					$pageInfo[uri] = $_SERVER["REQUEST_URI"];

			 
					$list = $soapadmin->getRecordLimit( $start, $offset);
					$TPL->assign_by_ref("RecordList", $list);
					$TPL->assign_by_ref("pageInfo", $pageInfo);	
					$ActionMapping->findForward("soapadmin.list");
					break;

 			}


		} else {
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>