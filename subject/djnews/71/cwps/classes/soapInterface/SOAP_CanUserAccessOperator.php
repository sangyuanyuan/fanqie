<?php
import("com.member.biz.Auth");

function SOAP_CanUserAccessOperator(&$soap, &$params)
{	
	global $db,$table;
	//print_r($params);
 	if(empty($params['sId'])) {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "ActionReq Action [CanUserAccessOperator] Error: sId is null";
		return false;
	}

 	if(empty($params['operator'])) {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "ActionReq Action [CanUserAccessOperator] Error: operator is null";
		return false;
	}


	if(!empty($params['Ip'])) {
		$check_ip_sql = $this->CheckIP ? " AND Ip='{$params['Ip']}'" : "" ;
	}


	$result = $db->getRow("SELECT * FROM $table->sessions WHERE sId='{$params['sId']}' ".$check_ip_sql);
 
	if($result) {
		$SessionData = unserialize($result['SessionData']);
 		if(in_array($params['operator'], $SessionData['OWNED-OPERATORS'])) {
			$soap->addResponseElement("session", $result);
			$soap->Response_hRet = SOAP_OK;
			$soap->Response_FeatureStr = "can access";
			return true;
	
		} else {
			$soap->Response_hRet = SOAP_LOGIC_ERROR;
			$soap->Response_FeatureStr = "access denid";
			return false;
		}

		
	} else {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "session not exists";
		return false;
 		
	}

}
?>