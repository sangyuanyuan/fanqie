<?php
//package com.member.admin.filter

class com_member_admin_filter_DefaultBeforeFilter extends kStruts_BeforeFilter
{
	function doFilter(&$ActionMapping, &$IN, &$TPL)
	{	
		$Auth = & get_singleton("com.member.admin.biz.Auth");
		$Auth->init();
		
		$IN['Auth'] = &$Auth;//inject $Auth into $IN context


 		if($IN['do'] == 'login'){
			return true;
		} elseif(empty($IN['do'])) {
			$ActionMapping->findForward("login");		
		} elseif($Auth->isLogin()) {
 			$TPL->assign("Session", $Auth->session);
		} else {
			$errors = new ActionErrors();
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
 			$TPL->assign("Struts_Errors", $errors->errors);
			$ActionMapping->findForward("login");
		
		}	

	}
}

?>