<?php
//package com.member.action;

import("com.member.biz.Auth");
import("com.member.biz.OAS");

class LogoutAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$Auth = new Auth();
		$Auth->init();
 		if($Auth->logout()) {
			$Auth->sId="";
			if($url = findFowardOAS($IN['referer'], $Auth->sId)) {
				 $ActionMapping->doForwardAction($url, "logout.success");	
			} else {
 				$ActionMapping->doForwardAction(0, "logout.success",2);
			}


		} else {
 			$ActionMapping->doForwardAction(0, "logout.fail",2);
		}

	}

}
?>