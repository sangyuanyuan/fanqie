<?php
//package com.member.action;

import("com.member.biz.Auth");
import("com.member.biz.User");
import("com.member.admin.biz.UserProperty");

class EditProfileAction extends Action {

	function &execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{	
		global $SYS_ENV;

		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();

 		$TPL->assign("Session", $Auth->session);

		if($Auth->isLogin()) {

			$UserProperty = new UserProperty();
			$FieldsInfo = $UserProperty->getAllUserAccessFieldsInfo();
			$TPL->assign_by_ref("FieldsInfo", $FieldsInfo);

			$User = new User();
			$UserInfo = $User->getUserInfo($Auth->session['UserID']);
			list($UserInfo[Year], $UserInfo[Month], $UserInfo[Day] ) = explode('-', $UserInfo['Birthday']);
			$TPL->assign_by_ref("UserInfo", $UserInfo);
			//print_r($UserInfo);
			$ActionMapping->findForward("editprofile");
		
		} else {
 			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
 			$TPL->assign("Struts_Errors", $errors->errors);
			$ActionMapping->findForward("login");
 		
		}

	}

}
?>