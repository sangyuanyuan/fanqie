<?php
//package com.member.action;

import("com.member.admin.biz.Auth");

class InitSessionAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$Auth = new Auth();
		$Auth->init();
 		$TPL->assign("Session", $Auth->session);
 	}

}
?>