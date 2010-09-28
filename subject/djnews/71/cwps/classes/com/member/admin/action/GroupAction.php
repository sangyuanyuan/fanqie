<?php
//package com.member.admin.action;

import("com.member.admin.biz.Auth");
import("com.member.admin.biz.Group");

class GroupAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
 		
		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {

  			$TPL->assign("Session", $Auth->session);
			$group = new Group();
			switch($IN["o"]) {
				case 'add':
//assignAddData RoleID start {{{
					import("com.member.admin.biz.Role");
					$role = new Role();
					foreach($role->getAll() as $key=>$var) {
						$roleInfo[] = array("title"=> $var['RoleName'], "value"=> $var['RoleID']) ;
					}
					$TPL->assign('SrcRoleID', $roleInfo);
					unset($roleInfo);
//assignAddData RoleID end  }}}

//assignAddData SubRoleIDs start {{{
					import("com.member.admin.biz.Role");
					$role = new Role();
					foreach($role->getAll() as $key=>$var) {
						$roleInfo[] = array("title"=> $var['RoleName'], "value"=> $var['RoleID']) ;
					}
					$TPL->assign('SrcSubRoleIDs', $roleInfo);
					unset($roleInfo);
//assignAddData SubRoleIDs end  }}}

//assignAddData OpIDs start {{{
					import("com.member.admin.biz.Operator");
					$operator = new Operator();
					foreach($operator->getAll() as $key=>$var) {
						$operatorInfo[] = array("title"=> $var['OpName'], "value"=> $var['OpID']) ;
					}
					$TPL->assign('SrcOpIDs', $operatorInfo);
					unset($operatorInfo);
//assignAddData OpIDs end  }}}


 					$ActionMapping->findForward("group.add");
					break;
				case 'add_submit':
					$group->flushData();
					$group->addData("GroupName", $IN['GroupName']);
					$group->addData("RoleID", $IN['RoleID']);
					$group->addData("SubRoleIDs", $IN['SubRoleIDs']);
					$group->addData("OpIDs", $IN['OpIDs']);
					
									

					if($group->add()) {
						$ActionMapping->doForwardAction("group", "group.add.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "group.add.fail");
					
					}
	
					break;
				case 'edit':
					$Info = $group->getInfo($IN['GroupID']);
//assignEditData RoleID start {{{
					import("com.member.admin.biz.Role");
					$role = new Role();
					foreach($role->getAll() as $key=>$var) {
						$roleInfo[] = array("title"=> $var['RoleName'], "value"=> $var['RoleID']) ;
					}
					$TPL->assign('SrcRoleID', $roleInfo);
					unset($roleInfo);
//assignEditData RoleID end  }}}

//assignEditData SubRoleIDs start {{{
					import("com.member.admin.biz.Role");
					$role = new Role();
					$roleInfo = $role->getAll();
					$Datas = explode(',', $Info['SubRoleIDs']);
					foreach($roleInfo as $key=>$var) {
						if(in_array($var['RoleID'], $Datas)) $TargetSubRoleIDs[] = array("title"=> $var['RoleName'], "value"=> $var['RoleID']) ;
						else $SrcSubRoleIDs[] = array("title"=> $var['RoleName'], "value"=> $var['RoleID']) ;
					}
					$TPL->assign('SrcSubRoleIDs', $SrcSubRoleIDs);

					$TPL->assign('TargetSubRoleIDs', $TargetSubRoleIDs);

					unset($SrcSubRoleIDs);
					unset($TargetSubRoleIDs);
//assignEditData SubRoleIDs end  }}}

//assignEditData OpIDs start {{{
					import("com.member.admin.biz.Operator");
					$operator = new Operator();
					$operatorInfo = $operator->getAll();
					$Datas = explode(',', $Info['OpIDs']);
					foreach($operatorInfo as $key=>$var) {
						if(in_array($var['OpID'], $Datas)) $TargetOpIDs[] = array("title"=> $var['OpName'], "value"=> $var['OpID']) ;
						else $SrcOpIDs[] = array("title"=> $var['OpName'], "value"=> $var['OpID']) ;
					}
					$TPL->assign('SrcOpIDs', $SrcOpIDs);

					$TPL->assign('TargetOpIDs', $TargetOpIDs);

					unset($SrcOpIDs);
					unset($TargetOpIDs);
//assignEditData OpIDs end  }}}


 					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("group.edit");
					break;
				case 'edit_submit':
					$group->flushData();
					$group->addData("GroupName", $IN['GroupName']);
					$group->addData("RoleID", $IN['RoleID']);
					$group->addData("SubRoleIDs", $IN['SubRoleIDs']);
					$group->addData("OpIDs", $IN['OpIDs']);
					

					if($group->update($IN['GroupID'])) {
						$ActionMapping->doForwardAction("group", "group.edit.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "group.edit.fail");
					
					}
	
					break;
				case 'del':
 
					if($group->del($IN['GroupID'])) {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "group.del.success");
					} else{
						$ActionMapping->doForwardAction(ActionMapping_Referer, "group.del.fail");
					
					}
	
					break;
				case 'view':
					$Info = $group->getInfo($IN['GroupID']);
//assignEditData SubRoleIDs start {{{
					import("com.member.admin.biz.Role");
					$role = new Role();
					$roleInfo = $role->getAll();
					$Datas = explode(',', $Info['SubRoleIDs']);
					foreach($roleInfo as $key=>$var) {
						if(in_array($var['RoleID'], $Datas)) $TargetSubRoleIDs[] = array("title"=> $var['RoleName'], "value"=> $var['RoleID']) ;
						else $SrcSubRoleIDs[] = array("title"=> $var['RoleName'], "value"=> $var['RoleID']) ;
					}
					$TPL->assign('SrcSubRoleIDs', $SrcSubRoleIDs);

					$TPL->assign('TargetSubRoleIDs', $TargetSubRoleIDs);

					unset($SrcSubRoleIDs);
					unset($TargetSubRoleIDs);
//assignEditData SubRoleIDs end  }}}

//assignEditData OpIDs start {{{
					import("com.member.admin.biz.Operator");
					$operator = new Operator();
					$operatorInfo = $operator->getAll();
					$Datas = explode(',', $Info['OpIDs']);
					foreach($operatorInfo as $key=>$var) {
						if(in_array($var['OpID'], $Datas)) $TargetOpIDs[] = array("title"=> $var['OpName'], "value"=> $var['OpID']) ;
						else $SrcOpIDs[] = array("title"=> $var['OpName'], "value"=> $var['OpID']) ;
					}
					$TPL->assign('SrcOpIDs', $SrcOpIDs);

					$TPL->assign('TargetOpIDs', $TargetOpIDs);

					unset($SrcOpIDs);
					unset($TargetOpIDs);
//assignEditData OpIDs end  }}}
					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("group.view");
					break;

				case 'main':
				case 'list':
				default:
					$offset = empty($IN[offset]) ? 20 : $IN[offset];
					$Page = empty($IN[Page]) ? 1 : $Page = $IN[Page];
					$num= $group->getRecordNum();

					$pagenum=ceil($num/$offset);
					$start=($Page-1)*$offset;
						
					$pageInfo[currentPage] = $Page;
					$pageInfo[pageNum] = $pagenum;
					$pageInfo[recordNum] = $num;
					$pageInfo[offset] = $offset;
					$pageInfo[from] = $start;
					$pageInfo[to] = $start+$offset;
					$pageInfo[uri] = $_SERVER["REQUEST_URI"];

			 
					$list = $group->getRecordLimit( $start, $offset);
					$TPL->assign_by_ref("RecordList", $list);
					$TPL->assign_by_ref("pageInfo", $pageInfo);	
					$ActionMapping->findForward("group.list");
					break;

 			}


		} else {
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>