<?php
//package com.member.admin.action;

import("com.member.admin.biz.Auth");
import("com.member.admin.biz.Resource");

class ResourceAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
 		
		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {

  			$TPL->assign("Session", $Auth->session);
			$resource = new Resource();
			switch($IN["o"]) {
				case 'add':
					import("com.member.admin.biz.OAS");
					$oas = new OAS();
					foreach($oas->getAll() as $key=>$var) {
						$srcInfo[] = array("title"=> $var['OASName'], "value"=> $var['OASID']) ;
					}
					$TPL->assign_by_ref('SrcOASIDs', $srcInfo);
 					$ActionMapping->findForward("resource.add");
					break;
				case 'add_submit':
					$resource->flushData();
					$resource->addData("ResourceUID", $IN['ResourceUID']);
					$resource->addData("ResourceName", $IN['ResourceName']);
					$resource->addData("OASIDs", $IN['OASIDs']);
					
									

					if($resource->add()) {
						$ActionMapping->doForwardAction("resource", "resource.add.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "resource.add.fail");
					
					}
	
					break;
				case 'edit':
					$Info = $resource->getInfo($IN['RID']);
					import("com.member.admin.biz.OAS");
					$oas = new OAS();
					$oasInfo = $oas->getAll();
					$Datas = explode(',', $Info['OASIDs']);
					foreach($oasInfo as $var) {
						if(in_array($var['OASID'], $Datas)) $TargetOASIDs[] = array("title"=> $var['OASName'], "value"=> $var['OASID']) ;
						else $SrcOASIDs[] = array("title"=> $var['OASName'], "value"=> $var['OASID']) ;
					}
					$TPL->assign_by_ref('SrcOASIDs', $SrcOASIDs);
					$TPL->assign_by_ref('TargetOASIDs', $TargetOASIDs);
 					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("resource.edit");
					break;
				case 'edit_submit':
					$resource->flushData();
					$resource->addData("ResourceUID", $IN['ResourceUID']);
					$resource->addData("ResourceName", $IN['ResourceName']);
					$resource->addData("OASIDs", $IN['OASIDs']);
					

					if($resource->update($IN['RID'])) {
						$ActionMapping->doForwardAction("resource", "resource.edit.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "resource.edit.fail");
					
					}
	
					break;
				case 'del':
 
					if($resource->del($IN['RID'])) {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "resource.del.success");
					} else{
						$ActionMapping->doForwardAction(ActionMapping_Referer, "resource.del.fail");
					
					}
	
					break;
				case 'view':
					$Info = $resource->getInfo($IN['RID']);
					import("com.member.admin.biz.OAS");
					$oas = new OAS();
					$oasInfo = $oas->getAll();
					$Datas = explode(',', $Info['OASIDs']);
					foreach($oasInfo as $var) {
						if(in_array($var['OASID'], $Datas)) $TargetOASIDs[] = array("title"=> $var['OASName'], "value"=> $var['OASID']) ;
						else $SrcOASIDs[] = array("title"=> $var['OASName'], "value"=> $var['OASID']) ;
					}
					$TPL->assign_by_ref('SrcOASIDs', $SrcOASIDs);
					$TPL->assign_by_ref('TargetOASIDs', $TargetOASIDs);
					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("resource.view");
					break;

				case 'main':
				case 'list':
				default:
					$offset = empty($IN[offset]) ? 20 : $IN[offset];
					$Page = empty($IN[Page]) ? 1 : $Page = $IN[Page];
					$num= $resource->getRecordNum();

					$pagenum=ceil($num/$offset);
					$start=($Page-1)*$offset;
						
					$pageInfo[currentPage] = $Page;
					$pageInfo[pageNum] = $pagenum;
					$pageInfo[recordNum] = $num;
					$pageInfo[offset] = $offset;
					$pageInfo[from] = $start;
					$pageInfo[to] = $start+$offset;
					$pageInfo[uri] = $_SERVER["REQUEST_URI"];

			 
					$list = $resource->getRecordLimit( $start, $offset);
					$TPL->assign_by_ref("RecordList", $list);
					$TPL->assign_by_ref("pageInfo", $pageInfo);	
					$ActionMapping->findForward("resource.list");
					break;

 			}


		} else {
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>