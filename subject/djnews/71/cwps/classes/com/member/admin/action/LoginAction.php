<?php
//package com.member.action;

import("com.member.admin.biz.Auth");
import("com.member.biz.OAS");

class LoginAction extends Action {

	function &execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$errors = new ActionErrors();

		$Auth = new Auth();
		//$Auth->init();

		if($Auth->login($ActionForm->get("UserName"), $ActionForm->get("Password"), $ActionForm->get("IpSecurity"))) {
  			$ActionMapping->sId = $Auth->sId;

			if($url = findFowardAdminOAS($IN['referer'], $Auth->sId)) {
				 $ActionMapping->doForwardAction($url, "login.success");	
			} else {
 				$ActionMapping->doForwardAction("main", "login.success");	
			}

		} else {
			if($Auth->errorCode === CLS_Auth_USER_STOPPED) {
				$errors->add(ActionErrors_GLOBAL_ERROR, "login.user.stopped" );
			} elseif($Auth->errorCode === CLS_Auth_USERNAMEORPASSWORD_ERROR) {
				$errors->add(ActionErrors_GLOBAL_ERROR, "login.username_password.error" );
			} elseif($Auth->errorCode === CLS_Auth_NOT_Administrator_ERROR) {
				$errors->add(ActionErrors_GLOBAL_ERROR, "login.isNotAdmin.error" );
			}
			
			return $errors;
			//$TPL->assign("Struts_Errors", $errors->errors);
 			//$ActionMapping->doForwardAction(0, "login.fail",2);
		
		}
	}

}
?>