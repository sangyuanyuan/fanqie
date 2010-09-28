<?php
//package com.member.action;

import("com.member.biz.User");

class ChangePassAction extends Action {

	function &execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{	
		global $SYS_ENV;

		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
		
		$User = new User();
		
 		$TPL->assign("Session", $Auth->session);

		if($Auth->isLogin()) {
			$UserInfo = $User->getUserInfo($Auth->session['UserID']);
			if($UserInfo['Password'] != md5($ActionForm->get("OldPassword"))) {
				$errors->add(ActionErrors_GLOBAL_ERROR, "login.changePass.fail.oldpassword_error" );
				return $errors;
			
			}

			$User->addData("Password", md5($ActionForm->get("NewPassword")));
			if($User->update($Auth->session['UserID'])) {
 				$ActionMapping->doForwardAction(ActionMapping_Referer, "login.changePass.success");
			} else {
				$errors->add(ActionErrors_GLOBAL_ERROR, "login.changePass.fail.db" );
				return $errors;
			}

		} else {
 			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
 			$TPL->assign("Struts_Errors", $errors->errors);
			$ActionMapping->findForward("login");
			//return $errors;
		
		}
		
	}

}
?>