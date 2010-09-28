<?php
import("com.member.biz.Auth");

function SOAP_GetGroupInfo(&$soap, &$params)
{	
	global $db,$table;
	$return = array();

	$result = $db->getRow("SELECT * FROM $table->group where GroupID=".$params['GroupID']);
	 
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