<?php
//package com.member.action;

import("com.member.biz.Auth");

class MainAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {
 			//print_r($Auth->session);
			$TPL->assign("Session", $Auth->session);
 			$ActionMapping->findForward("main");
		} else {
			$errors = new ActionErrors();
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>