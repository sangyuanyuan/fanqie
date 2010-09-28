<?php
//package com.member.admin.action;

import("com.member.admin.biz.Auth");
import("com.member.admin.biz.Operator");

class OperatorAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
 		
		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {

  			$TPL->assign("Session", $Auth->session);
			$operator = new Operator();
			switch($IN["o"]) {
				case 'add':
//assignAddData PID start {{{
					import("com.member.admin.biz.Privilege");
					$privilege = new Privilege();
					foreach($privilege->getAll() as $key=>$var) {
						$privilegeInfo[] = array("title"=> $var['PrivilegeName'], "value"=> $var['PID']) ;
					}
					$TPL->assign_by_ref('SrcPID', $privilegeInfo);
//assignAddData PID end  }}}

//assignAddData RID start {{{
					import("com.member.admin.biz.Resource");
					$resource = new Resource();
					foreach($resource->getAll() as $key=>$var) {
						$resourceInfo[] = array("title"=> $var['ResourceName'], "value"=> $var['RID']) ;
					}
					$TPL->assign_by_ref('SrcRID', $resourceInfo);
//assignAddData RID end  }}}


 					$ActionMapping->findForward("operator.add");
					break;
				case 'add_submit':
					$operator->flushData();
					$operator->addData("OpName", $IN['OpName']);
					$operator->addData("PID", $IN['PID']);
					$operator->addData("RID", $IN['RID']);
					$operator->addData("Enabled", $IN['Enabled']);
					
									

					if($operator->add()) {
						$ActionMapping->doForwardAction("operator", "operator.add.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "operator.add.fail");
					
					}
	
					break;
				case 'edit':
//assignEditData PID start {{{
					import("com.member.admin.biz.Privilege");
					$privilege = new Privilege();
					foreach($privilege->getAll() as $key=>$var) {
						$privilegeInfo[] = array("title"=> $var['PrivilegeName'], "value"=> $var['PID']) ;
					}
					$TPL->assign_by_ref('SrcPID', $privilegeInfo);

//assignEditData PID end  }}}

//assignEditData RID start {{{
					import("com.member.admin.biz.Resource");
					$resource = new Resource();
					foreach($resource->getAll() as $key=>$var) {
						$resourceInfo[] = array("title"=> $var['ResourceName'], "value"=> $var['RID']) ;
					}
					$TPL->assign_by_ref('SrcRID', $resourceInfo);

//assignEditData RID end  }}}


					$Info = $operator->getInfo($IN['OpID']);
 					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("operator.edit");
					break;
				case 'edit_submit':
					$operator->flushData();
					$operator->addData("OpName", $IN['OpName']);
					$operator->addData("PID", $IN['PID']);
					$operator->addData("RID", $IN['RID']);
					$operator->addData("Enabled", $IN['Enabled']);
					

					if($operator->update($IN['OpID'])) {
						$ActionMapping->doForwardAction("operator", "operator.edit.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "operator.edit.fail");
					
					}
	
					break;
				case 'del':
 
					if($operator->del($IN['OpID'])) {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "operator.del.success");
					} else{
						$ActionMapping->doForwardAction(ActionMapping_Referer, "operator.del.fail");
					
					}
	
					break;
				case 'view':
					$Info = $operator->getInfo($IN['OpID']);
					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("operator.view");
					break;

				case 'main':
				case 'list':
				default:
					$offset = empty($IN[offset]) ? 20 : $IN[offset];
					$Page = empty($IN[Page]) ? 1 : $Page = $IN[Page];
					$num= $operator->getRecordNum();

					$pagenum=ceil($num/$offset);
					$start=($Page-1)*$offset;
						
					$pageInfo[currentPage] = $Page;
					$pageInfo[pageNum] = $pagenum;
					$pageInfo[recordNum] = $num;
					$pageInfo[offset] = $offset;
					$pageInfo[from] = $start;
					$pageInfo[to] = $start+$offset;
					$pageInfo[uri] = $_SERVER["REQUEST_URI"];

			 
					$list = $operator->getRecordLimit( $start, $offset);
					$TPL->assign_by_ref("RecordList", $list);
					$TPL->assign_by_ref("pageInfo", $pageInfo);	
					$ActionMapping->findForward("operator.list");
					break;

 			}


		} else {
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>