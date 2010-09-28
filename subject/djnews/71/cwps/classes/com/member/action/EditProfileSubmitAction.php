<?php
//package com.member.action;

import("com.member.biz.Auth");
import("com.member.biz.User");
import("com.member.admin.biz.UserProperty");
import("com.member.biz.OAS");

class EditProfileSubmitAction extends Action {

	function &execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{	
		global $SYS_ENV;

		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();

 		$TPL->assign("Session", $Auth->session);

		if($Auth->isLogin()) {
			$User = new User();
			$UserInfo = $User->getUserInfo($Auth->session['UserID']);

			$User->addData("Email", $ActionForm->get("Email"));
			$User->addData("NickName", $ActionForm->get("NickName"));
			$User->addData("QQ", $ActionForm->get("QQ"));
			$User->addData("Gender", $ActionForm->get("Gender"));
			$User->addData("Birthday",$ActionForm->get("Year").'-'.$ActionForm->get("Month").'-'.$ActionForm->get("Day"));
			$User->addData("Description", $ActionForm->get("Description"));

			if($User->update($Auth->session['UserID'])) {
				$UserProperty = new UserProperty();
				$FieldsInfo = $UserProperty->getAllUserAccessFieldsInfo();
				$User->flushData();
 				if(!empty($FieldsInfo)) {
					foreach($FieldsInfo as $key=>$var) {
						$User->addData($var[FieldName], $IN[$var[FieldName]]);
					}
				}
				if($User->updateExtra($Auth->session['UserID'])) {
					if($url = findFowardOAS($IN['referer'], $Auth->sId)) {
						 $ActionMapping->doForwardAction($url, "editprofile.success");	
					} else {
						$ActionMapping->doForwardAction("main", "editprofile.success");
					}
					
				} else
					$errors->add(ActionErrors_GLOBAL_ERROR, "editprofile.fail.db" );
			} else {
				$errors->add(ActionErrors_GLOBAL_ERROR, "editprofile.fail.db" );
			}

			return $errors;
		
		} else {
 			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
 			$TPL->assign("Struts_Errors", $errors->errors);
			$ActionMapping->findForward("login");
 		
		}

	}

}
?>