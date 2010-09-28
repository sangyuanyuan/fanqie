<?php
import("com.member.biz.Auth");

/**
* 用户是否存在
*
* @access public
* @return 用户存在返回UserID，否则返回0
*/
function SOAP_IsUserExists(&$soap, &$params)
{	
	global $db,$table;
	$return = array();

	$result = $db->getRow("SELECT UserID FROM $table->user where UserName='".$db->escape_string($params['UserName'])."'");
	 
	if(!empty($result['UserID'])) {
		$soap->Response_hRet = SOAP_OK;
		$soap->Response_FeatureStr = "exists :)";
		$soap->addResponseElement("ok", $result['UserID']);

 
		return true;
	} else {
		$soap->Response_hRet = SOAP_OK;
		$soap->Response_FeatureStr = "user not exists";
		$soap->addResponseElement("ok", 0);
		return false;
 		
	}

}
?>