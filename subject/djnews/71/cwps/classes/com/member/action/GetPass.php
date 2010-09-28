<?php

class com_member_action_GetPass extends Action {
	function &execute(&$ActionMapping, &$ActionForm, &$IN, &$TPL)
	{	
		global $SYS_ENV, $STRUTS_CONFIG;
		$Auth = &$IN['Auth']; 
		$errors = new ActionErrors();

		switch($IN['o']) {
			case 'submit':
				$User = & get_singleton("com.member.biz.User");
				$UserInfo = $User->getUserInfoByUserName($IN['UserName']);

				if(empty($IN['UserName'])) {
					$errors->add(ActionErrors_GLOBAL_ERROR, "getPass.UserName.empty");
				
				} elseif(empty($IN['Email'])) {
					$errors->add(ActionErrors_GLOBAL_ERROR, "getPass.Email.empty");
				
				} elseif(empty($UserInfo)) {
					$errors->add(ActionErrors_GLOBAL_ERROR, "getPass.UserName.invalid");
				
				} else if($UserInfo['Email'] == $IN['Email']) {
					$mailTpl = ROOT_PATH.$ActionMapping->strutsConfig['template-resources']."/mail/get_password.txt";
					
					$ACODE = base64_encode(md5($UserInfo['UserName'].$UserInfo['Password'].$UserInfo['Email']));
					
					$url = $SYS_ENV['sys_url']."/"
					.$STRUTS_CONFIG['entrance']."?do=getPass&o=reset&UserID="
					.$UserInfo['UserID']."&ACODE=".$ACODE;

					$mailContent = getFileContent($mailTpl);
					foreach($UserInfo as $key=>$var) {
						$mailContent = str_replace("{".$key."}", $var, $mailContent);		
						
					}
					$mailContent = str_replace("{date}", date("Y-m-d"), $mailContent);
					$mailContent = str_replace("{url}", $url, $mailContent);

					if(preg_match("/<title>(.*)<\/title>.*<body>(.*)<\/body>/isU", $mailContent, $matches)) {
						$Title = $matches[1];
						$Content    = $matches[2];
					}
					
					if($User->sendMail($UserInfo['Email'], $Title, $Content)) {
 						$ActionMapping->doForwardAction( ActionMapping_Referer, 'user.getPass.ok');		
 					} else {
						$ActionMapping->doForwardAction( ActionMapping_Referer, 'user.getPass.fail');		
					}
				
				} else {
					$errors->add(ActionErrors_GLOBAL_ERROR, "getPass.Email.invalid");				
				}

				return $errors;				
				break;
			case 'reset':
				$User = & get_singleton("com.member.biz.User");
				$UserInfo = $User->getUserInfo($IN['UserID']);
				$ACODE = base64_encode(md5($UserInfo['UserName'].$UserInfo['Password'].$UserInfo['Email']));

				if($ACODE == $IN['ACODE']) {
					$TPL->assign("ACODE", $IN['ACODE']);
					$TPL->assign_by_ref("UserInfo", $UserInfo);
 					$ActionMapping->findForward("getPass.newPass");
				} else {
					$errors->add(ActionErrors_GLOBAL_ERROR, "getPass.ACODE.invalid");					
				}
				return $errors;				

				break;
			case 'reset_submit':
				$User = & get_singleton("com.member.biz.User");
				$UserInfo = $User->getUserInfo($IN['UserID']);
				$ACODE = base64_encode(md5($UserInfo['UserName'].$UserInfo['Password'].$UserInfo['Email']));

				if($ACODE == $IN['ACODE']) {
					$User->flushData();
					$User->addData("Password", md5($IN["NewPassword"]));
					if($User->update($IN['UserID'])) {
						$ActionMapping->doForwardAction("main", "getPass.success");	
					} else {
						$errors->add(ActionErrors_GLOBAL_ERROR, "login.changePass.fail.db" );
						return $errors;
					}

				} else {
					$errors->add(ActionErrors_GLOBAL_ERROR, "getPass.ACODE.invalid");					
				}
				return $errors;				

				break;
			default:
 				$ActionMapping->findForward("getPass");
				break;
		}

	}
}
?>