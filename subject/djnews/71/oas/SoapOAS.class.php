<?php
/**
* @package cwps.oas
* $Id: SoapOAS.class.php,v 1.5 2006/09/10 05:27:18 Administrator Exp $
*/
define("SOAP_OK", 0);
define("SOAP_UNKNOWN_ERROR", 1);
define("SOAP_LOGIC_ERROR", 2);
define("SOAP_OAS_IP_Invalid",4000);
define("SOAP_TransactionAccessKey_Error", 4001);
define("SOAP_Action_Null", 4002);
define("SOAP_Action_NotRegistered", 4003);
define("SOAP_Action_NotExists", 4004);
define("SOAP_Response_TransactionID_Error", 4005);

define("SOAP_DB_ERROR", 9000);

function oas_encrypt($txt, $key) {
	srand((double)microtime() * 1000000);
	$encrypt_key = md5(rand(0, 32000));
	$ctr = 0;
	$tmp = '';
	for($i = 0;$i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
	}
	return base64_encode(oas_key($tmp, $key));
}

function oas_decrypt($txt, $key) {
	$txt = oas_key(base64_decode($txt), $key);
	$tmp = '';
	for ($i = 0;$i < strlen($txt); $i++) {
		$md5 = $txt[$i];
		$tmp .= $txt[++$i] ^ $md5;
	}
	return $tmp;
}

function oas_key($txt, $encrypt_key) {
	$encrypt_key = md5($encrypt_key);
	$ctr = 0;
	$tmp = '';
	for($i = 0; $i < strlen($txt); $i++) {
		$ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
		$tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
	}
	return $tmp;
}



/**
* OAS端开发包，OAS端开发人员通过使用该开发包只需要进行简单的编程，就可以实现与CWPS的交互,见下面的example示例
*
*
* @version 1.1.0
* @author Hawking (flyhawking#hotmail.com)
* @example oas_client.php 
* @access public
*/
class SoapOAS {
	/**
	*  @access private
	*/
	var $server_address;
	
	/**
	*  @access private
	*/
	var $Version = "1.5";
	
	/**
	*  @access private
	*/
	var $SoapDataforSend = "";
		
	/**
	*  @access private
	*/
	var $DataEncode= true; 	//默认所有数据都进行base64编码
		
	/**
	*  @access private
	*/
	var $TransactionID = "";
		
	/**
	*  @access private
	*/
	var $TransactionAccessKey = "";
		
	/**
	*  @access private
	*/
	var $doLog = false;
		
	/**
	*  @access private
	*/
	var $logFile = "oas.log.txt";
		
	/**
	*  @access private
	*/
	var $Response = array();
		
	/**
	*  @access private
	*/
	var $ReqCharset = "utf8";
		
	/**
	*  @access private
	*/
	var $RespCharset = "utf8";

	/**
	*  @access private
	*/
	var $errorCode = 0 ;

	var $ActionRespData = "";

	var $transferEncrypt = false;

	var $OASID = 0;

	/**
	* 构造函数
 	*
	* @param string $server_address CWPS地址
 	* @access public
	*/
	function SoapOAS($server_address)
	{
		$this->server_address = $server_address;

		$this->ActionReqTpl = 
							 "<?xml version=\"1.0\" encoding=\"utf-8\" ?>"
							."<SOAP-ENV:Envelope "
							." xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\""
							." xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\""
							." xmlns:SOAP-ENV=\"http://schemas.xmlsoap.org/soap/envelope/\""
							." xmlns:SOAP-ENC=\"http://schemas.xmlsoap.org/soap/encoding/\">"
							."<SOAP-ENV:Header>"
							."    <TransactionID xmlns=\"http://www.cmsware.com/passport/schemas/\">{TransactionID}</TransactionID>"
							."    <TransactionAccessKey xmlns=\"http://www.cmsware.com/passport/schemas/\">{TransactionAccessKey}</TransactionAccessKey>"
							."    <TransactionEncrypt xmlns=\"http://www.cmsware.com/passport/schemas/\">{TransactionEncrypt}</TransactionEncrypt>"
							."<TransactionOASID xmlns=\"http://www.cmsware.com/passport/schemas/\">{OASID}</TransactionOASID>"
							."</SOAP-ENV:Header>"
							."<SOAP-ENV:Body>"
							."<ActionReq xmlns=\"http://www.cmsware.com/passport/schemas/\">"
							."<Version>".$this->Version."</Version>"
							."<Encoding>{Encoding}</Encoding>"
							."<Action>{Action}</Action>"
							."<Params>{Params}</Params>"
							."<ReqCharset>{ReqCharset}</ReqCharset>"
							."<RespCharset>{RespCharset}</RespCharset>"
 							."</ActionReq>"
							."</SOAP-ENV:Body>"
							."</SOAP-ENV:Envelope>";
		

	}

	/**
	* 执行ActionReq请求
	*
	* @param string $action Action名称
	* @param array $params 传递的参数数组
 	* @access public
	* @return mixed false on error,or array on success
	*/
	function call($action, $params=NULL)
	{
		$this->SoapDataforSend = $this->ActionReqTpl;
		$this->SoapDataforSend = str_replace("{TransactionID}", $this->TransactionID, $this->SoapDataforSend);
		$this->SoapDataforSend = str_replace("{TransactionAccessKey}", $this->oas_encode($this->TransactionAccessKey), $this->SoapDataforSend);
		$this->SoapDataforSend = str_replace("{Action}", $action, $this->SoapDataforSend);
		$this->SoapDataforSend = str_replace("{OASID}", $this->OASID, $this->SoapDataforSend);

		if($this->transferEncrypt) {
			$this->SoapDataforSend = str_replace("{TransactionEncrypt}", "1", $this->SoapDataforSend);
		} else {
			$this->SoapDataforSend = str_replace("{TransactionEncrypt}", "0", $this->SoapDataforSend);
		}

		//{{{add for 1.1
		$this->SoapDataforSend = str_replace("{ReqCharset}", $this->ReqCharset, $this->SoapDataforSend);
		$this->SoapDataforSend = str_replace("{RespCharset}", $this->RespCharset, $this->SoapDataforSend);
		//}}}add for 1.1

		if(!empty($params) && is_array($params)) {
			foreach($params as $key=>$var) {
				if($this->DataEncode)
					$tmp .= "<$key>".base64_encode($this->oas_encode($var)). "</$key>\n";
				else
					$tmp .= "<$key>".$this->oas_encode($var)."</$key>\n";

			}
		}

		if($this->DataEncode) $this->SoapDataforSend = str_replace("{Encoding}", 1, $this->SoapDataforSend);
		else $this->SoapDataforSend = str_replace("{Encoding}", 0, $this->SoapDataforSend);

		$this->SoapDataforSend = str_replace("{Params}", $tmp, $this->SoapDataforSend);

		return $this->sendSoapData($this->SoapDataforSend);

	}

	/**
	* 设置事务消息ID
 	*
	* @param string $TransactionID 事务消息ID
 	* @access public
	* @return void
	*/
	function setTransactionID($TransactionID)
	{
		$this->TransactionID = $TransactionID;
	
	}
	
	/**
	* 设置CWPS访问密码
 	*
	* @param string $TransactionAccessKey CWPS访问密码
 	* @access public
	* @return void
	*/
	function setTransactionAccessKey($TransactionAccessKey)
	{
		$this->TransactionAccessKey = $TransactionAccessKey;
		$this->publicKey = $TransactionAccessKey;
	
	}

	/**
	* 设置OASID
 	*
	* @param string $_oasid OASID
 	* @access public
	* @return void
	*/
	function setOASID($_oasid)
	{
		$this->OASID = $_oasid;
	}
	
	/**
	* 设置是否对params数据进行base64编码
 	* 默认所有params数据都进行base64编码,设为false的话，开发人员需要自行处理OAS端与CWPS端的数据编码与解码
 	*
	* @param boolean $_encode 
 	* @access public
	* @return void
	*/
	function setDataEncode($_encode = true)
	{
		$this->DataEncode = $_encode;
	}

	/**
	* 设置是否对SOAP数据包进行记录
 	* 默认为false
 	*
	* @param boolean $_dolog 
 	* @access public
	* @see setLogFile
	* @return void
	*/
	function setLog($_dolog = true)
	{
		$this->doLog = $_dolog;
	}

	/**
	* 设置是否对SOAP数据包进行记录
 	* 默认为oas.log.txt
 	*
	* @param string $_logfile 
	* @see setLog
 	* @access public
	* @return void
	*/
	function setLogFile($_logfile)
	{
		$this->logFile = $_logfile;
	}

	/**
	* 设置OAS发起ActionReq的数据编码<br>
 	* 比如gb2312、utf8，默认使用utf8编码<br>
	* 注意：要使用此设置，目标CWPS必须是安装在MySQL4.1以上版本的数据库上
 	*
	* @param string $_ReqCharset 
 	* @access public
	* @return void
	*/
	function setReqCharset($_ReqCharset)
	{
		$this->ReqCharset = $_ReqCharset;
	}

	/**
	* 设置OAS端请求CWPS的ActionResp返回的数据编码<br>
 	* 比如gb2312、utf8，默认使用utf8编码<br>
 	* 注意：要使用此设置，目标CWPS必须是安装在MySQL4.1以上版本的数据库上
 	* 
	* @param string $_RespCharset 
 	* @access public
	* @return void
	*/
	function setRespCharset($_RespCharset)
	{
		$this->RespCharset = $_RespCharset;
	}
	
	function setPublicEncryptKey($_key)
	{
		//$this->publicKey = $_key;
	}

	function setTransferEncrypt($_how = true) {
		$this->transferEncrypt = $_how;
	}

	function oas_encode($str)
	{
 
		if($this->transferEncrypt) {
			 return oas_encrypt($str, $this->publicKey);
		}

		return $str;
	}

	function oas_decode($str) {
 
		if($this->transferEncrypt) {
			 return oas_decrypt($str, $this->publicKey);
		} 

		return $str;
	
	}
	/**
	* 获得错误码
  	*
  	* @access public
	* @return string
	*/
	function getErrorCode()
	{
		return $this->errorCode;
	}

	/**
	* 获得ActionResp返回的信息
  	*
  	* @access public
	* @return mixed
	*/
	function getResponse()
	{
		return $this->Response;
	}

	/**
	 * 发送Soap包
	 *
	 * @param string $SoapData
	 * @access private 
	 * @return false if hRet!=0 or return decode Data if ok
	 */
	function sendSoapData(&$SoapData)
	{
 		$info = parse_url($this->server_address);
		$port = empty($info['port']) ? 80 : $info['port'];
		$host = $info[host];
		$path = $info[path];

		$msg = 
		"POST $path HTTP/1.0\r\n"
		."Host: $host\r\n"
		."Content-Type: application/x-www-form-urlencoded\r\n"
		."Content-Length: ".strlen($SoapData)."\r\n\r\n";

		 
		$ActionRespData="";
		$f = fsockopen($host, $port, $errno, $errstr, 1);
		if ($f) {
			fputs($f,$msg.$SoapData);
			while (!feof($f)) $ActionRespData .= fread($f,32000);
			fclose($f);
		}
		
		if($this->doLog) {
			$this->LogData($msg.$SoapData."\r\n\r\n\r\n".$ActionRespData);
		}

		$this->ActionRespData = $ActionRespData;

		$this->parseActionResp($ActionRespData);

		if($this->Response['TransactionID'] != $this->TransactionID) {
			$this->errorCode = SOAP_Response_TransactionID_Error;
			return false;
		} elseif($this->Response['hRet'] != SOAP_OK ) {
			$this->errorCode = $this->Response['hRet'];
			return false;
		} else {
			return $this->Response['Return'];
		}
	}

 	/**
	* 解析ActionReq内容
	*
	* @access private 
	*/
	function parseActionResp(&$str)
	{
		
		preg_match("/<TransactionID[^>]+>(.*)<\/TransactionID>/isU", $str, $TransactionIDMatch);
		$this->Response['TransactionID'] = $TransactionIDMatch[1];
 

		//manufacture the ActionResp
		if(preg_match("/<ActionResp[^>]+>(.*)<\/ActionResp>/isU", $str, $match)) {

			preg_match("/<Version>(.*)<\/Version>/isU", $match[1], $VersionMatch);
			$this->Response['Version'] = $VersionMatch[1];

			preg_match("/<hRet>(.*)<\/hRet>/isU", $match[1], $hRetMatch);
			$this->Response['hRet'] = $hRetMatch[1];

			preg_match("/<FeatureStr>(.*)<\/FeatureStr>/isU", $match[1], $FeatureStrMatch);
			$this->Response['FeatureStr'] = $FeatureStrMatch[1];
			
			preg_match("/<Encoding>(.*)<\/Encoding>/isU", $match[1], $EncodingMatch);
			$this->Response['Encoding'] = $EncodingMatch[1];


			if(preg_match("/<Return>(.*)<\/Return>/isU", $match[1], $ReturnMatch)) {
				if(preg_match_all("/<([^>]+)>([^><]*)<\/([^>]+)>/isU", $ReturnMatch[1], $matches)) {
					foreach($matches[0] as $key=>$var) {
						if($this->Response['Encoding'] == '1') {
							$this->Response['Return'][$matches[1][$key]] = $this->oas_decode(base64_decode($matches[2][$key]));
						} else {
							$this->Response['Return'][$matches[1][$key]] = $this->oas_decode($matches[2][$key]);
						
						}
											
					}	
				} return false;
			
			}
		} else return false;
	
	}

	/**
	* 记录Log
	*
	* @param string $data
 	* @access private
	* @return void
	*/
	function LogData($data)
	{
 		if ($handle = fopen($this->logFile, 'a')) {
			fwrite($handle, "- - - - - - - - - - - - - - - -\r\n".$data."\r\n- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ".date('Y-m-d H:i:s')." \r\n\r\n\r\n");
			fclose($handle);
		}
	}
	
	/**
	* 序列化数据解码
	*
	* @param string $_data
 	* @access private
	* @return void
	*/
	function unserialize($_data)
	{
		return unserialize($_data);
	}
	
	/**
	* 触发错误
	*
  	* @access public
	* @return void
	*/
	function error()
	{
		trigger_error("ActionReq Error : [".$this->errorCode."] ".$this->Response['FeatureStr'], E_USER_WARNING);
	}
}
?>