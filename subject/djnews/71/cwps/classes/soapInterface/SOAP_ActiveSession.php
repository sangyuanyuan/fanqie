<?php
import("com.member.biz.Auth");

function SOAP_ActiveSession(&$soap, &$params)
{	
	global $db,$table;
	//print_r($params);
 	if(empty($params['sId'])) {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "ActionReq Action [ActiveSession] Error: sId is null";
		return false;
	}  

 
	$Auth = new Auth();
	$Auth->sId = $params["sId"];

	if($Auth->activeSession()) {
		$soap->Response_hRet = SOAP_OK;
		$soap->Response_FeatureStr = "activeSession success";
 		return true;
	} else {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
 		$soap->Response_FeatureStr = "activeSession error";
 		return false;
 		
	}

}
?>