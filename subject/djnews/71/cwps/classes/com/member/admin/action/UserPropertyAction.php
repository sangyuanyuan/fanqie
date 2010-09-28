<?php
//package com.member.action;

import("com.member.admin.biz.Auth");
import("com.member.admin.biz.UserProperty");

class UserPropertyAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$ReservedFieldName = array("UserID", "GroupID","SubGroupIDs", "RoleID","SubRoleIDs","OpIDs","UserName", "Password", "PassQuestion", "PassAnswer", "Email", "NickName", "Gender", "Birthday", "QQ", "Description", "Status", "RegisterDate", "LastLoginTime");
		
		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {

  			$TPL->assign("Session", $Auth->session);
			$UserProperty = new UserProperty();
			switch($IN["o"]) {
				case 'add_property':
					$ActionMapping->findForward("userProperty.add");
					break;
				case 'add_property_submit':
					$data['FieldName'] = $IN['FieldName'];
					$data['FieldTitle'] = $IN['FieldTitle'];
					$data['FieldType'] = $IN['FieldType'];
					$data['FieldSize'] = $IN['FieldSize'];
					$data['FieldInput'] = $IN['FieldInput'];
					$data['FieldDescription'] = $IN['FieldDescription'];
					$data['FieldAccess'] = $IN['FieldAccess'];
					$data['FieldDataSource'] = $IN['FieldDataSource'];
 
					if(in_array($data[FieldName], $ReservedFieldName)) {
						$errors->add(ActionErrors_GLOBAL_ERROR, "userProperty.add.error.reservedFieldName" );
						$TPL->assign("Struts_Errors", $errors->errors);
						$TPL->assign("Struts_BackInput", 1);
						$ActionMapping->findForward("userProperty.add");
						//return $errors;
					}

					if($UserProperty->addField($data)) {
						$ActionMapping->doForwardAction("userProperty", "userProperty.add.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "userProperty.add.fail");
					
					}
	
					break;
				case 'edit_property':
					$fInfo = $UserProperty->getFieldInfo($IN[FieldID]);
					$TPL->assign_by_ref("FieldInfo", $fInfo);
					$ActionMapping->findForward("userProperty.edit");
					break;
				case 'edit_property_submit':
					$data['FieldName'] = $IN['FieldName'];
					$data['FieldTitle'] = $IN['FieldTitle'];
					$data['FieldType'] = $IN['FieldType'];
					$data['FieldSize'] = $IN['FieldSize'];
					$data['FieldInput'] = $IN['FieldInput'];
					$data['FieldDescription'] = $IN['FieldDescription'];
 					$data['FieldAccess'] = $IN['FieldAccess'];
					$data['FieldDataSource'] = $IN['FieldDataSource'];

					if(in_array($data[FieldName], $ReservedFieldName)) {
						$errors->add(ActionErrors_GLOBAL_ERROR, "userProperty.add.error.reservedFieldName" );
						$TPL->assign("Struts_Errors", $errors->errors);
						$ActionMapping->goBack();
					}

					if($UserProperty->editField($IN[FieldID], $data)) {
						$ActionMapping->doForwardAction("userProperty", "userProperty.edit.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "userProperty.edit.fail");
					
					}
	
					break;
				case 'del_property':
 
					if($UserProperty->delField($IN['FieldID'])) {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "userProperty.del.success");
					} else{
						$ActionMapping->doForwardAction(ActionMapping_Referer, "userProperty.del.fail");
					
					}
	
					break;


				case 'main':
				default:
					$fInfo = $UserProperty->getAllFieldsInfo();
					$TPL->assign_by_ref("UserPropertys", $fInfo);
 					$ActionMapping->findForward("userProperty.main");
					break;

 			}


		} else {
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>