<?php
//package com.member.action;

import("com.member.biz.User");
import("com.member.admin.biz.UserProperty");

class UserAction extends Action {

	function &execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{

		$User = new User();

		switch($IN["o"]) {
			case 'active_user':			
				if(!empty($IN[UserID]) && $User->activeUser($IN[UserID])) {
					$ActionMapping->doForwardAction( ActionMapping_Referer, 'user.active.ok');		
				} else {
					$ActionMapping->doForwardAction( ActionMapping_Referer, 'user.active.fail');				
				}
				break;
			case 'stop_user':					
				if(!empty($IN[UserID]) &&$User->stopUser($IN[UserID])) {
					$ActionMapping->doForwardAction( ActionMapping_Referer, 'user.stop.ok');					
				} else {
					$ActionMapping->doForwardAction( ActionMapping_Referer, 'user.stop.fail');					
				}
				break;
			case 'search_user':
				$offset = empty($IN[offset]) ? 20 : $IN[offset];
				$num= $User->searchUserNum($IN['username']);

				$pagenum=ceil($num/$offset);

				if(empty($IN[Page])) {
					$ActionMapping->doForwardAction($_SERVER["REQUEST_URI"]."&keywords=".urlencode($IN['keywords'])."&Page=1", 'user.search.forward');	
				}
				
				$Page = empty($IN[Page]) ? 1 : $Page = $IN[Page];
				$start=($Page-1)*$offset;
				
				$recordInfo[currentPage] = $Page;
				$recordInfo[pageNum] = $pagenum;
				$recordInfo[recordNum] = $num;
				$recordInfo[offset] = $offset;
				$recordInfo[from] = $start;
				$recordInfo[to] = $start+$offset;
				$recordInfo[uri] = $_SERVER["REQUEST_URI"];

				$TPL->assign("pList", $User->searchUserLimit($IN['keywords'], $start, $offset));
				$TPL->assign("recordInfo", $recordInfo);
				$ActionMapping->findForward("user.list");
				break;
			case 'edit_user':
				if(empty($IN[UserID])) $ActionMapping->findForward("user.list");
				$GroupInfo = $User->getAllGroup();
				$UserInfo  = $User->getUserInfo($IN[UserID]);

				$Info = $UserInfo;
//assignEditData SubGroupIDs start {{{

				$Datas = explode(',', $Info['SubGroupIDs']);
				foreach($GroupInfo as $key=>$var) {
					if(in_array($var['GroupID'], $Datas)) $TargetSubGroupIDs[] = array("title"=> $var['GroupName'], "value"=> $var['GroupID']) ;
					else $SrcSubGroupIDs[] = array("title"=> $var['GroupName'], "value"=> $var['GroupID']) ;
				}
				$TPL->assign('SrcSubGroupIDs', $SrcSubGroupIDs);

				$TPL->assign('TargetSubGroupIDs', $TargetSubGroupIDs);

				unset($SrcSubGroupIDs);
				unset($TargetSubGroupIDs);
//assignEditData SubGroupIDs end  }}}


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
				$TPL->assign_by_ref("GroupInfo", $GroupInfo);
				$TPL->assign_by_ref('UserInfo', $UserInfo);



				$UserProperty = new UserProperty();
				$FieldsInfo = $UserProperty->getAllUserAccessFieldsInfo();
				$TPL->assign_by_ref("FieldsInfo", $FieldsInfo);


				$ActionMapping->findForward("user.edit");
				break;

			case 'edit_user_submit':
				//print_r($IN);exit;
				if($User->isUserNameExists($IN[UserName], $IN[UserID])) {
					$uInfo = $User->getUserInfo($IN[UserID]);
					$TPL->assign_by_ref("UserInfo", $uInfo);
					$errors->add(ActionErrors_GLOBAL_ERROR, "user.edit.usernameExists" );
					return $errors;
				}

				$User->addData("GroupID", $IN[GroupID]);
				$User->addData("SubGroupIDs", $IN[SubGroupIDs]);
				$User->addData("RoleID", $IN[RoleID]);
				$User->addData("SubRoleIDs", $IN[SubRoleIDs]);
				$User->addData("OpIDs", $IN[OpIDs]);
				$User->addData("Email", $IN[Email]);
				$User->addData("NickName", $IN["NickName"]);
				$User->addData("QQ", $IN["QQ"]);
				$User->addData("Gender", $IN["Gender"]);
				$User->addData("Birthday", $IN['Birthday']);
				$User->addData("Description", $IN['Description']);

				if(!empty($IN['Password']) && $IN['Password'] == $IN['Password2']) {
					$User->addData("Password", md5($IN['Password']));
				}

				if($User->update($IN[UserID])) {
					$UserProperty = new UserProperty();
					$FieldsInfo = $UserProperty->getAllUserAccessFieldsInfo();
					$User->flushData();
					if(!empty($FieldsInfo)) {
						foreach($FieldsInfo as $key=>$var) {
							$User->addData($var[FieldName], $IN[$var[FieldName]]);
						}
					}

					if($User->updateExtra($IN[UserID])) {
						$ActionMapping->doForwardAction( ActionMapping_Referer, "editprofile.success");
					} else {
						$errors->add(ActionErrors_GLOBAL_ERROR, "editprofile.fail.db" );
						return $errors;
					}


				} else {
					$errors->add(ActionErrors_GLOBAL_ERROR, "editprofile.fail.db" );
					return $errors;
				}

				break;
			case 'view_user':
				if(empty($IN[UserID])) $ActionMapping->findForward("user.list");

				$UserProperty = new UserProperty();
				$FieldsInfo = $UserProperty->getAllUserAccessFieldsInfo();
				$TPL->assign_by_ref("FieldsInfo", $FieldsInfo);

				$GroupInfo = $User->getAllGroup();
				$UserInfo  = $User->getUserInfo($IN[UserID]);

				$Info = $UserInfo;
				$TPL->assign_by_ref("UserInfo", $UserInfo );



//assignEditData SubGroupIDs start {{{

				$Datas = explode(',', $Info['SubGroupIDs']);
				foreach($GroupInfo as $key=>$var) {
					if(in_array($var['GroupID'], $Datas)) $TargetSubGroupIDs[] = array("title"=> $var['GroupName'], "value"=> $var['GroupID']) ;
					else $SrcSubGroupIDs[] = array("title"=> $var['GroupName'], "value"=> $var['GroupID']) ;
				}
				$TPL->assign('SrcSubGroupIDs', $SrcSubGroupIDs);

				$TPL->assign('TargetSubGroupIDs', $TargetSubGroupIDs);

				unset($SrcSubGroupIDs);
				unset($TargetSubGroupIDs);
//assignEditData SubGroupIDs end  }}}


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


				$ActionMapping->findForward("user.view");
				break;
			case 'del':

				if($User->del($IN['UserID'])) {
					$ActionMapping->doForwardAction(ActionMapping_Referer, "user.del.success");
				} else{
					$ActionMapping->doForwardAction(ActionMapping_Referer, "user.del.fail");
				
				}

				break;

			case 'list':
			default:
				$offset = empty($IN[offset]) ? 20 : $IN[offset];
				$Page = empty($IN[Page]) ? 1 : $Page = $IN[Page];
				$num= $User->getUserNum();

				$pagenum=ceil($num/$offset);
				$start=($Page-1)*$offset;
					
				$recordInfo[currentPage] = $Page;
				$recordInfo[pageNum] = $pagenum;
				$recordInfo[recordNum] = $num;
				$recordInfo[offset] = $offset;
				$recordInfo[from] = $start;
				$recordInfo[to] = $start+$offset;
				$recordInfo[uri] = $_SERVER["REQUEST_URI"];

				if(!empty($IN['order']) && !empty($IN['sort']) ) {
					$IN['order'] = ($IN['order']=='asc') ? "asc" : "desc";
					$sort = "u.".$IN['sort'].' '.$IN['order'];						 
				}
				$list = $User->getUserLimit( $start, $offset, $sort );
				$TPL->assign_by_ref("pList", $list);
				$TPL->assign_by_ref("recordInfo", $recordInfo);	
				$ActionMapping->findForward("user.list");
				break;

		}


	}

}
?>