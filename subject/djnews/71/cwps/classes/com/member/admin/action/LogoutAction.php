<?php
//package com.member.action;

import("com.member.admin.biz.Auth");

class LogoutAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$Auth = new Auth();
		$Auth->init();
 		if($Auth->logout()) {
 			$ActionMapping->doForwardAction(0, "logout.success",2);
		} else {
 			$ActionMapping->doForwardAction(0, "logout.fail",2);
		}

	}

}
?>