<?php
//package com.member.action;

import("com.member.biz.Auth");
import("com.member.biz.User");
import("com.member.admin.biz.UserProperty");
import("com.member.biz.OAS");

class RegisterAction extends Action {

	function &execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{	
		global $SYS_ENV, $table, $db;

		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
 		$TPL->assign("Session", $Auth->session);

		$User = new User();
		
		if($User->isUserNameExists($ActionForm->get("UserName"))) {
			$errors->add(ActionErrors_GLOBAL_ERROR, "register.username.exists", array($ActionForm->get("UserName")) );
			return $errors;
		}
		$User->flushData();
 		$User->addData("UserName", $ActionForm->get("UserName"));
		$User->addData("Password", md5($ActionForm->get("Password")));
		$User->addData("GroupID", $SYS_ENV['user']['registerDefaultGroupID']);
 		$User->addData("Email", $ActionForm->get("Email"));
		$User->addData("QQ", $ActionForm->get("QQ"));
 		$User->addData("NickName", $ActionForm->get("NickName"));
 		$User->addData("Gender", $ActionForm->get("Gender"));
 		$User->addData("Birthday",$ActionForm->get("Year").'-'.$ActionForm->get("Month").'-'.$ActionForm->get("Day"));
 		$User->addData("Description", $ActionForm->get("Description"));
 		$User->addData("Status", 1);

		//Fixed 会员的注册日期和最后登陆时间没有写入的
 		$User->addData("LastLoginTime", time());
 		$User->addData("RegisterDate", time());
		 
		if($IN['OASUID'] == 'cmswareoas') {
			$maxResult = $db->getRow("select Max(UserID) as MaxUserID from $table->user ");
			$maxUserID = intval($maxResult['MaxUserID']);

			if($maxUserID >= 1000)  {
				$insert_user_id = $maxUserID + 1;
			} else $insert_user_id = 1000;
 		
			$User->addData("UserID", $insert_user_id);
		}

		if($User->add()) {
			$UserProperty = new UserProperty();
			$FieldsInfo = $UserProperty->getAllUserAccessFieldsInfo();
			$User->flushData();
	 		$User->addData("UserID", $User->db_insert_id);
			if(!empty($FieldsInfo)) {
				foreach($FieldsInfo as $key=>$var) {
	 				$User->addData($var[FieldName], $IN[$var[FieldName]]);
				}
			}
 			if($User->addExtra()) {
				$Auth = new Auth();
				$Auth->init();
				$Auth->login($ActionForm->get("UserName"), $ActionForm->get("Password"), 3600);

				if($url = findFowardOAS($IN['referer'], $Auth->sId)) {
					 $ActionMapping->doForwardAction($url, "register.success");	
				} else {
					$ActionMapping->doForwardAction("main", "register.success");	
				}
	 			
			
			} else
				$errors->add(ActionErrors_GLOBAL_ERROR, "register.fail.db" );
		} else {
			$errors->add(ActionErrors_GLOBAL_ERROR, "register.fail.db" );		
		}

		return $errors;

	}

}
?>