<?php
//package com.member.admin.action;

import("com.member.admin.biz.Auth");
import("com.member.admin.biz.Role");

class RoleAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
 		
		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {

  			$TPL->assign("Session", $Auth->session);
			$role = new Role();
			switch($IN["o"]) {
				case 'add':
//assignAddData OpIDs start {{{
					import("com.member.admin.biz.Operator");
					$operator = new Operator();
					foreach($operator->getAll() as $key=>$var) {
						$operatorInfo[] = array("title"=> $var['OpName'], "value"=> $var['OpID']) ;
					}
					$TPL->assign_by_ref('SrcOpIDs', $operatorInfo);
//assignAddData OpIDs end  }}}


 					$ActionMapping->findForward("role.add");
					break;
				case 'add_submit':
					$role->flushData();
					$role->addData("RoleName", $IN['RoleName']);
					$role->addData("RoleBaseUID", $IN['RoleBaseUID']);
					$role->addData("OpIDs", $IN['OpIDs']);
					
									

					if($role->add()) {
						$ActionMapping->doForwardAction("role", "role.add.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "role.add.fail");
					
					}
	
					break;
				case 'edit':
					$Info = $role->getInfo($IN['RoleID']);
//assignEditData OpIDs start {{{
					import("com.member.admin.biz.Operator");
					$operator = new Operator();
					$operatorInfo = $operator->getAll();
					$Datas = explode(',', $Info['OpIDs']);
					foreach($operatorInfo as $key=>$var) {
						if(in_array($var['OpID'], $Datas)) $TargetOpIDs[] = array("title"=> $var['OpName'], "value"=> $var['OpID']) ;
						else $SrcOpIDs[] = array("title"=> $var['OpName'], "value"=> $var['OpID']) ;
					}
					$TPL->assign_by_ref('SrcOpIDs', $SrcOpIDs);

					$TPL->assign_by_ref('TargetOpIDs', $TargetOpIDs);

//assignEditData OpIDs end  }}}


 					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("role.edit");
					break;
				case 'edit_submit':
					$role->flushData();
					$role->addData("RoleName", $IN['RoleName']);
					$role->addData("RoleBaseUID", $IN['RoleBaseUID']);
					$role->addData("OpIDs", $IN['OpIDs']);
					

					if($role->update($IN['RoleID'])) {
						$ActionMapping->doForwardAction("role", "role.edit.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "role.edit.fail");
					
					}
	
					break;
				case 'del':
 
					if($role->del($IN['RoleID'])) {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "role.del.success");
					} else{
						$ActionMapping->doForwardAction(ActionMapping_Referer, "role.del.fail");
					
					}
	
					break;
				case 'view':
					$Info = $role->getInfo($IN['RoleID']);
//assignEditData OpIDs start {{{
					import("com.member.admin.biz.Operator");
					$operator = new Operator();
					$operatorInfo = $operator->getAll();
					$Datas = explode(',', $Info['OpIDs']);
					foreach($operatorInfo as $key=>$var) {
						if(in_array($var['OpID'], $Datas)) $TargetOpIDs[] = array("title"=> $var['OpName'], "value"=> $var['OpID']) ;
						else $SrcOpIDs[] = array("title"=> $var['OpName'], "value"=> $var['OpID']) ;
					}
					$TPL->assign_by_ref('SrcOpIDs', $SrcOpIDs);

					$TPL->assign_by_ref('TargetOpIDs', $TargetOpIDs);

//assignEditData OpIDs end  }}}
					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("role.view");
					break;

				case 'main':
				case 'list':
				default:
					$offset = empty($IN[offset]) ? 20 : $IN[offset];
					$Page = empty($IN[Page]) ? 1 : $Page = $IN[Page];
					$num= $role->getRecordNum();

					$pagenum=ceil($num/$offset);
					$start=($Page-1)*$offset;
						
					$pageInfo[currentPage] = $Page;
					$pageInfo[pageNum] = $pagenum;
					$pageInfo[recordNum] = $num;
					$pageInfo[offset] = $offset;
					$pageInfo[from] = $start;
					$pageInfo[to] = $start+$offset;
					$pageInfo[uri] = $_SERVER["REQUEST_URI"];

			 
					$list = $role->getRecordLimit( $start, $offset);
					$TPL->assign_by_ref("RecordList", $list);
					$TPL->assign_by_ref("pageInfo", $pageInfo);	
					$ActionMapping->findForward("role.list");
					break;

 			}


		} else {
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>