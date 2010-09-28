<?php
//package com.member.admin.action;

import("com.member.admin.biz.Auth");

class DefaultAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{	
		global $SYS_ENV;
		$Auth = new Auth();
		$Auth->init();
		//print_r($_COOKIE);
		//print_r($Auth->session);
		if($Auth->isLogin()) {
 			$TPL->assign("Session", $Auth->session);
 			$ActionMapping->findForward("default");
		} else {
			$errors =& new ActionErrors();
			$login_ip = $IN['IP_ADDRESS'];
			if(!empty($SYS_ENV['admin']['AllowLoginIP'])) {
				$allow_login_ips = explode(",", $SYS_ENV['admin']['AllowLoginIP']);
				if(in_array($login_ip, $allow_login_ips)) {
 					$ActionMapping->findForward("login");
				} else {
 					$errors->add(ActionErrors_GLOBAL_ERROR, "login.ipdenied", array($login_ip));
					$TPL->assign("Struts_Errors", $errors->errors);
					$ActionMapping->findForward("deny_login");				
				}
			} else {
 				$ActionMapping->findForward("login");	
			}
		}

	}

}
?>