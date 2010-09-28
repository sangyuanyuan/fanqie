<?php

import("com.member.admin.biz.UserProperty");

class com_member_admin_action_ResetPass extends Action
{
	function &execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{	
		$User = & get_singleton("com.member.biz.User");
		
		$Auth = &$IN['Auth']; 

		$UserInfo = $User->getUserInfo($IN['UserID']);
		switch($IN['o']) {
			case 'submit':
				$User->addData("Email", $IN['Email']);
				$User->update($IN['UserID']);

				$mailTpl = ROOT_PATH.$ActionMapping->strutsConfig['template-resources']."/mail/reset_password.txt";
				if($User->sendMail($Addresses, $Title, $Content)) {
					$ActionMapping->doForwardAction( ActionMapping_Referer, 'user.resetPass.ok',1, array($UserInfo['UserID']));					
				} else {
					$ActionMapping->doForwardAction( ActionMapping_Referer, 'user.resetPass.fail');		
				}
				break;
			default:
				$TPL->assign_by_ref('UserInfo', $UserInfo);
				$ActionMapping->findForward("user.resetPass");
				break;
		}




	}

}

?>