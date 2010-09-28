<?php
//package com.member.admin.action;

import("com.member.admin.biz.Auth");

class MainAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {
 			$TPL->assign("Session", $Auth->session);
			switch($IN['o']) {
				case 'nav':
 					$ActionMapping->findForward("main.nav");
					break;
				case 'home':
 					$ActionMapping->findForward("main.home");
					break;
				default:
 					$ActionMapping->findForward("main.frameset");
					break;
			}
		} else {
			$errors = new ActionErrors();
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>