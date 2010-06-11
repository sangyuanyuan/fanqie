<?php

class oas2cwpsAuth
{
	var $session = array();
	var $sId;
	var $fromCWPS = false;
	var $doLog = false;
	var $logFile = 'tmp/';
	var $reqCharset = 'utf8';
	var $respCharset = 'utf8';

	function oas2cwpsAuth()
	{
		global $SYS_ENV;

		session_start();

		$this->session = &$_SESSION;

		$this->cookie_name_sid = $SYS_ENV['CookiePre'] . 'sid';
 		$this->sId = isset($_GET['sId']) ? $_GET['sId'] : (isset($_POST['sId']) ? $_POST['sId'] : (isset($_COOKIE[$this->cookie_name_sid])) ? $_COOKIE[$this->cookie_name_sid] : $_SESSION['sId']);
		$this->Ip = $GLOBALS['IN']['IP_ADDRESS'];

		$this->doLog = $SYS_ENV['doLog']; 	//是否记录日志文件
		$this->logFile = $SYS_ENV['LogPath'] . "oas.log.".date("Y-m-d").".txt"; 	//日志文件路径名称

		$this->reqCharset = $SYS_ENV['ReqCharset'];	//OAS端发请求字符集
		$this->respCharset = $SYS_ENV['RespCharset'];	//CWPS端回应结果字符集

		if(substr($this->sId, 0, 6) == 'CWPS::')
		{
			$this->sId = substr($this->sId, 6);	//如果sId变量的前面有CWPS::字样,则表明此时是从CWPS返回的,并置formCWPS为true
			$this->fromCWPS = true;
		}

	}

	function isLogin()	//判断是否已经登录CWPS
	{
		if(!empty($this->sId))
		{
			if($this->queryUserSession($this->sId, $this->Ip))
			{
				$this->ActiveCWPSSession();
				return true;
			}
			else
			{
				session_destroy();
				return false;
			}
		}
		else
		{
			if(!$this->fromCWPS)
			{
				$this->isLoginCWPS();
			}
			else return false;
		}
	}

	function isLoginCWPS($referer = "")
	{
		global $SYS_ENV, $PageInterface;
		$this->goCWPS($PageInterface['IsLogin'] , $referer) ;
	}

	function login($referer = "")
	{
		global $SYS_ENV, $PageInterface;
		$this->goCWPS($PageInterface['Login'] , $referer);
 	}

	function register($referer = "")
	{
		global $SYS_ENV, $PageInterface;
		$this->goCWPS($PageInterface['Register'] , $referer);
 	}

	function logout($referer = "")
	{
		global $SYS_ENV, $PageInterface;
		session_destroy();

		$this->goCWPS($PageInterface['Logout'] , $referer) ;
	}

	function ActiveCWPSSession()	//激活CWPS的SESSION状态
	{
		global $SYS_ENV;

		$oas = new SoapOAS($SYS_ENV['CWPS_Address']);
		$oas->setTransferEncrypt($SYS_ENV['TransferEncrypt']); //设置是否启用传输数据加密，true为加密，false为不加密，默认为不加密。
		$oas->setOASID($SYS_ENV['OASID']);//设置OASID
		$oas->setTransactionAccessKey($SYS_ENV['TransactionAccessKey']);

		$oas->doLog = $this->doLog;
		$oas->logFile = $this->logFile;

		$oas->setReqCharset($this->reqCharset);
		$oas->setRespCharset($this->respCharset);

		$oas->setTransactionID(time());
		$Action = "ActiveSession";
		$params = array(
			"sId"=> $this->sId,
 			);

		$return = $oas->call($Action, $params);


		if($return === false)
		{
			return false;
		}
		else
		{
			$this->session['SessionActiveTime'] = time();
			return true;
		}
	}

	function queryUserSession($sId, $ip)
	{
		global $SYS_ENV;

		if(empty($sId)) return false;


		$oas = new SoapOAS($SYS_ENV['CWPS_Address']);
		$oas->setTransferEncrypt($SYS_ENV['TransferEncrypt']); //设置是否启用传输数据加密，true为加密，false为不加密，默认为不加密。
		$oas->setOASID($SYS_ENV['OASID']);//设置OASID
		$oas->setTransactionAccessKey($SYS_ENV['TransactionAccessKey']);

		$oas->doLog = $this->doLog;
		$oas->logFile = $this->logFile;

		$oas->setReqCharset($this->reqCharset);
		$oas->setRespCharset($this->respCharset);


		$oas->setTransactionID(time());
		$Action = "QueryUserSession";
		$params = array(
			"sId"=> $sId,
 			"Ip"=> $ip,
			);

		$return = $oas->call($Action, $params);

		if($return === false) {
			return false;
		} else {
			$this->session = array_merge($this->session,$return);
			$this->session['SessionActiveTime'] = time();
			return true;
		}
	}

	function updateCWPS($sId,$Action,$params)
	{
		global $SYS_ENV;

		if(empty($sId) or empty($Action)) return false;


		$oas = new SoapOAS($SYS_ENV['CWPS_Address']);
		$oas->setTransferEncrypt($SYS_ENV['TransferEncrypt']); //设置是否启用传输数据加密，true为加密，false为不加密，默认为不加密。
		$oas->setOASID($SYS_ENV['OASID']);//设置OASID
		$oas->setTransactionAccessKey($SYS_ENV['TransactionAccessKey']);

		$oas->doLog = $this->doLog;
		$oas->logFile = $this->logFile;

		$oas->setReqCharset($this->reqCharset);
		$oas->setRespCharset($this->respCharset);

		$oas->setTransactionID(time());

		$return = $oas->call($Action, $params);

		if($return === false)
		{
			return false;
		}
		else
		{
			return true;
		}


	}

	function goCWPS($url, $referer='')
	{
		if(empty($referer)) {
			$port = $_SERVER['SERVER_PORT']==80 ? "" : ":" . $_SERVER['SERVER_PORT'];
			$referer = "http://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
		}
		//echo "as";
		//die($referer);

		$pos = strpos($url, '?');
		if ($pos === false) {
			$url = $url."?&referer=OAS::".urlencode($referer);
		} else 	$url = $url."&referer=OAS::".urlencode($referer);

//echo $url;exit;

 		header("Location: $url");
		exit;

	}
}

?>