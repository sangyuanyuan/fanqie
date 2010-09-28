<?php
import("com.member.biz.Auth");
import("com.member.biz.User");
import("com.member.admin.biz.UserProperty");

function SOAP_Register(&$soap, &$params)
{	
	global $db,$table,$SYS_ENV;

	$User = new User();
		
	if($User->isUserNameExists($params["UserName"])) {
		$soap->Response_hRet = SOAP_LOGIC_ERROR;
		$soap->Response_FeatureStr = "register.username.exists";
		return false;
 	}

	$User->flushData();
 	$User->addData("UserName", $params["UserName"]);
	$User->addData("Password", md5($params["Password"]) );
	$User->addData("GroupID", $SYS_ENV['user']['registerDefaultGroupID']);
 	$User->addData("Email",  $params["Email"]);
	$User->addData("QQ", $params["QQ"]);
 	$User->addData("NickName", $params["NickName"]);
 	$User->addData("Gender", $params["Gender"]);
 	$User->addData("Birthday",$params["Birthday"]);
 	$User->addData("Description", $params["Description"]);
 	$User->addData("Status", 1);

	if($User->add()) {
		$UserProperty = new UserProperty();
		$FieldsInfo = $UserProperty->getAllUserAccessFieldsInfo();
		$User->flushData();
	 	$User->addData("UserID", $User->db_insert_id);
		if(!empty($FieldsInfo)) {
			foreach($FieldsInfo as $key=>$var) {
	 			$User->addData($var[FieldName], $params[$var[FieldName]]);
			}
		}

 		if($User->addExtra()) {
			$soap->Response_hRet = SOAP_OK;
			$soap->Response_FeatureStr = "register.success";
			return true;
		} else {
			$soap->Response_hRet = SOAP_DB_ERROR;
			$soap->Response_FeatureStr = "register.fail.db";
			return false;
		}
  	} else {
		$soap->Response_hRet = SOAP_DB_ERROR;
		$soap->Response_FeatureStr = "register.fail.db";
		return false;
	}
	
}
?>