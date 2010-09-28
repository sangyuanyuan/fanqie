<?php

function SOAP_Logout(&$soap, &$params)
{	
	global $db,$table;
  	if(empty($params['sId'])) {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "ActionReq Action [Logout] Error: sId is null";
		return false;
	} 

	$sql = "DELETE FROM $table->sessions WHERE sId = '".$params['sId']."'";
	if($db->query($sql)) {
		$soap->Response_hRet = SOAP_OK;
		$soap->Response_FeatureStr = "Logout success";
 		return true;
	} else {
		$soap->Response_hRet = SOAP_DB_ERROR;
		$soap->Response_FeatureStr = "logout failed: db error";
		return false;	
	}
}
?>