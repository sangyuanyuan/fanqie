<?php
//package com.member.action;

import("com.member.biz.Auth");
import("com.member.biz.OAS");

class DefaultAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$Auth = new Auth();
		$Auth->init();
		//print_r($_COOKIE);
		//print_r($Auth->session);
		if($Auth->isLogin()) {
			if($url = findFowardOAS($IN['referer'], $Auth->sId)) {
				$ActionMapping->doHeaderAction($url);
				//$ActionMapping->doForwardAction($url, "login.success");	
			} else {
				$TPL->assign("Session", $Auth->session);
				$ActionMapping->findForward("default");
			}
		} else {
	
 			$ActionMapping->findForward("login");	
		}

	}

}
?>