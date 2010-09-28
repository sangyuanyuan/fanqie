<?php
import("com.member.biz.Auth");

function SOAP_Login(&$soap, &$params)
{	
	global $db,$table;
	//print_r($params);
 	if(empty($params['UserName'])) {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "ActionReq Action [Login] Error: UserName is null";
		return false;
	} elseif(empty($params['Password'])) {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "ActionReq Action [Login] Error: Password is null";
		return false;
	
	} elseif(empty($params['Ip'])) {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "ActionReq Action [Login] Error: Ip is null";
		return false;
	
	}

	$UserName = $params["UserName"];
	$Password = $params["Password"];

	$Auth = new Auth();
	$Auth->Ip = $params["Ip"];

	if($Auth->login($UserName, $Password)) {
		$soap->Response_hRet = SOAP_OK;
		$soap->Response_FeatureStr = "Login success";
		$soap->addResponseElement("sId", $Auth->session['sId']);
		return true;
	} else {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;

		if($Auth->errorCode === CLS_Auth_USER_STOPPED) {
			$soap->Response_FeatureStr = "user stopped";
 		} elseif($Auth->errorCode === CLS_Auth_USERNAMEORPASSWORD_ERROR) {
			$soap->Response_FeatureStr = "login.username_password.error";
 		}
			
		return false;
 		
	}

}
?>