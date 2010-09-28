<?php
import("com.member.biz.Auth");

function SOAP_GetAllGroup(&$soap, &$params)
{	
	global $db,$table;
	$return = array();

	$result = $db->Execute("SELECT * FROM $table->group ");
	while(!$result->EOF) {
		$return[] = $result->fields;
		$result->MoveNext();
	}
 
	if($result) {
		$soap->Response_hRet = SOAP_OK;
		$soap->Response_FeatureStr = "success";
		$soap->setEncode(false);
		$soap->addResponseElement("List", serialize($return));
		return true;
	} else {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "nothing";
		return false;
 		
	}

}
?>