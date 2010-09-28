<?php
//package com.member.admin.action;

import("com.member.admin.biz.Auth");
import("com.member.admin.biz.Setting");

class SettingAction extends Action {

	function execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{
 		
		$errors = new ActionErrors();

		$Auth = new Auth();
		$Auth->init();
		if($Auth->isLogin()) {

  			$TPL->assign("Session", $Auth->session);
			$setting = new Setting();
			switch($IN["o"]) {
				case 'edit_submit':
					$setting->flushData();
					$setting->addData("TransactionAccessKey", $IN['TransactionAccessKey']);
					

					if($setting->makeSetting()) {
 						$ActionMapping->doForwardAction(ActionMapping_Referer, "setting.edit.success");
					} else {
						$ActionMapping->doForwardAction(ActionMapping_Referer, "setting.edit.fail");		
					}
	
					break;
				default:
				case 'edit':
					$Info = $setting->getInfo();
  					$TPL->assign_by_ref("RecordInfo", $Info);
					$ActionMapping->findForward("setting.edit");
					break;
 			}


		} else {
			$errors->add(ActionErrors_GLOBAL_ERROR, "login.notlogin" );
			return $errors;
		
		}

	}

}
?>