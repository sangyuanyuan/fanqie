<?php
//package com.member.action;

import("com.member.biz.Auth");
import("com.member.biz.OAS");
import("com.member.biz.User");

class LoginAction extends Action {

	function &execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();

		if($Auth->login($ActionForm->get("UserName"), $ActionForm->get("Password"), $ActionForm->get("CookieTime"))) {
			//print_r($IN);exit;

			$User = new User();
 			$User->addData("LastLoginTime", time());
			$User->update( $Auth->session['UserID']);


			if($url = findFowardOAS($IN['referer'], $Auth->sId)) {
				 $ActionMapping->doForwardAction($url, "login.success");	
			} else {
 				$ActionMapping->doForwardAction("main", "login.success");	
			}

		} else {
			if($Auth->errorCode === CLS_Auth_USER_STOPPED) {
				$errors->add(ActionErrors_GLOBAL_ERROR, "login.user.stopped" );
			} elseif($Auth->errorCode === CLS_Auth_USERNAMEORPASSWORD_ERROR) {
				$errors->add(ActionErrors_GLOBAL_ERROR, "login.username_password.error" );
			}
			
			return $errors;
			//$TPL->assign("Struts_Errors", $errors->errors);
 			//$ActionMapping->doForwardAction(0, "login.fail",2);
		
		}
	}

}
?>