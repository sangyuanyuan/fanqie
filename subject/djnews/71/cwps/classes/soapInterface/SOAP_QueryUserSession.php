<?php
import("com.member.biz.Auth");

function SOAP_QueryUserSession(&$soap, &$params)
{	
	global $db,$table;
	//print_r($params);
 	if(empty($params['sId'])) {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "ActionReq Action [QueryUserSession] Error: sId is null";
		return false;
	}

	if(!empty($params['Ip'])) {
		$check_ip_sql = " AND Ip='{$params['Ip']}'" ;
	}


	$result = $db->getRow("SELECT s.*,u.*,g.*, ue.* FROM $table->sessions s, $table->user u, $table->group g,$table->user_extra ue WHERE s.UserID=u.UserID AND s.GroupID=g.GroupID AND ue.UserID=u.UserID AND s.sId='{$params['sId']}' ".$check_ip_sql);
 
	if($result) {
		$soap->Response_hRet = SOAP_OK;
		$soap->Response_FeatureStr = "session exists";
		$soap->addResponseElement("session", $result);
		return true;
	} else {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "session not exists";
		return false;
 		
	}

}
?>