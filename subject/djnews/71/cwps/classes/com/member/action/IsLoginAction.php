<?php
//package com.member.action;

import("com.member.biz.Auth");
import("com.member.biz.OAS");

class IsLoginAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$Auth = new Auth();
		$Auth->init();
 		if($Auth->isLogin()) {
			if($url = findFowardOAS($IN['referer'], $Auth->sId)) {
				$ActionMapping->doHeaderAction($url);
 			}  
		} else {
 			if($url = findFowardOAS($IN['referer'], '')) {
				$ActionMapping->doHeaderAction($url);
 			}  
		}

	}

}
?>