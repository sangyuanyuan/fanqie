<?php
import("com.member.biz.Auth");

function SOAP_GetUserInfo(&$soap, &$params)
{	
	global $db,$table;

	$result = $db->getRow("SELECT * FROM $table->user where UserID=".$params['UserID']);
	 
	if($result) {
		$soap->Response_hRet = SOAP_OK;
		$soap->Response_FeatureStr = "success";
		$soap->setEncode(false);
		$soap->addResponseElement("Info", serialize($result));
		return true;
	} else {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "nothing";
		return false;
 		
	}

}
?>