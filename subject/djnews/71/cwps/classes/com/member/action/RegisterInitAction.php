<?php
//package com.member.action;

import("com.member.biz.Auth");
import("com.member.admin.biz.UserProperty");

class RegisterInitAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
		$Auth = new Auth();
		$Auth->init();
 		$TPL->assign("Session", $Auth->session);

		$UserProperty = new UserProperty();
		$FieldsInfo = $UserProperty->getAllUserAccessFieldsInfo();
 		$TPL->assign_by_ref("FieldsInfo", $FieldsInfo);

 	}

}
?>