<?php

function SOAP_updateMoney(&$soap, &$params)
{	
	global $db,$table;
  	if(empty($params['UserID'])) {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "ActionReq Action [Logout] Error: UserID is null";
		return false;
	} 

	$operator = $params['Operator'];
	$money = $params['Money'];

	$sql = "update $table->user_extra set Money=Money".$operator.$money." WHERE UserID = '".$params['UserID']."'";
	if($db->query($sql)) {
		$soap->Response_hRet = SOAP_OK;
		$soap->Response_FeatureStr = "update money  success";
 		return true;
	} else {
		$soap->Response_hRet = SOAP_DB_ERROR;
		$soap->Response_FeatureStr = "logout failed: db error";
		return false;	
	}
}
?>